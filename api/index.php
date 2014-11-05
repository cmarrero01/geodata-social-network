<?php
/**
 * Created by UN IDE MUY BUENO.
 * User: Claudio A. Marrero
 * Date: 03/11/2014
 * Time: 06:58 PM
 * @class OlaPicTest
 * @constructor
 */

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/core/config/config.php';
require_once __DIR__.'/core/model/places_model.php';
require_once __DIR__.'/core/libs/parse.php';

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OlaPicTest
{

    /**
     * Application Silex instance
     * @property app
     */
    public $app;

    /**
     * Get all data for make request to the differents apis
     * @property config
     */
    private $config;

    /**
     * Inital method for OlaPicTest class
     * @method __construct
     */
    public function __construct()
    {
        $this->app = new Silex\Application();
        $this->app->after(function (Request $request, Response $response) {
            $response->headers->set('Access-Control-Allow-Origin', '*');
        });
        $this->app['debug'] = true;
        $this->config = new OlaPic_Config();
    }

    /**
     * Public REST Endpoints
     * @method endpoints
     */
    public function endpoints()
    {
        $this->app->get('/', 'OlaPicTest::home');
        $this->app->get('/media/{id}', 'OlaPicTest::media');
        $this->app->run();
    }

    /**
     * Home request
     * @method home
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function home(Request $request, Application $app){
        $response = Array("result"=>"Very Good!!");
        return $app->json($response,200);
    }

    /**
     * Get the media information
     * @method media
     * @param Request $request
     * @param Application $app
     * @param Int $id Id of the media file
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function media(Request $request, Application $app, $id){
        
        $id = urlencode ($id);
        $endpoint = 'https://api.instagram.com/v1/media/'.$id.'?client_id='.$this->config->getInstId();

        $media = $this->GET($endpoint);
        $location = $this->LocationMedia($media);

        if(!$location){
            return $app->json("This media file, doesnt have a location",200);
        }

        $parse = new OlaPic_ParsePlaces();
        $venues =  $this->FoursquareVenues($location);
        $parse->foursParse($venues);

        $places = $this->GooglePlaces($location);
        $parse->gooParse($places);

        $location->places = $parse->places;

        return $app->json($location,200);
    }

    /**
     * Get foursquare venues by a location media.
     * @param $location
     * @return mixed
     */
    private function FoursquareVenues($location){

        $endpoint = "https://api.foursquare.com/v2/venues/search?client_id=".$this->config->getFourId()."&client_secret=".$this->config->getFourSecret();
        $endpoint.= "&ll=".$location->latitude.",".$location->longitude;
        $endpoint.= "&v=20140806%20&m=foursquare";

        $venues = $this->GET($endpoint);
        $venues = $this->ValidateVenues($venues);

        return $venues;
    }

    /**
     * Validate the geolocation of the media file.
     * @param $media
     * @return mixed
     */
    private function LocationMedia($media){
        if(!$media || !isset($media->data) || !$media->data->location){
            return;
        }
        return $media->data->location;
    }

    /**
     * Validate the Foursquares venues
     * @param $venues
     * @return mixed
     */
    private function ValidateVenues($venues){
        if(!$venues || !isset($venues->meta) || $venues->meta->code != 200){
            return Array("");
        }
        return $venues->response->venues;
    }

    /**
     * Get places from google api
     * @param $location
     * @return mixed
     */
    private function GooglePlaces($location){
        $endpoint = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=".$location->latitude.",".$location->longitude."&radius=500&key=".$this->config->getGooKey();
        $places = $this->GET($endpoint);
        $places = $this->ValidatePlaces($places);
        return $places;
    }

    /**
     * Validate google places locatiosn
     * @param $places
     * @return mixed
     */
    private function ValidatePlaces($places){
        if(!$places || !isset($places->results) || empty($places->results)){
            return;
        }
        return $places->results;
    }

    /**
     * Make a GET request to the server
     * @param $endpoint
     * @return mixed
     */
    private function GET($endpoint){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);
        curl_setopt($ch, CURLOPT_TIMEOUT, '3');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $content = trim(curl_exec($ch));
        curl_close($ch);
        return json_decode($content);
    }
}

/**
 * Instace the OlaPicTest class, the constructor make the initialization of $app object
 * for silex aplication, and then, you need to expose the enpoints to the browser.
 */
$int = new OlaPicTest();
$int->endpoints();
return $int->app;