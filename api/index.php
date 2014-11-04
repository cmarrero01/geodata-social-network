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
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;


class OlaPicTest
{
    /**
     * Initialization
     * @property $app
     */
    public $app;

    /**
     * The client ID for instagram
     * @property $client_id
     * @var string
     * @private
     */
    private $client_id = "5278ecf3b07d4c999859e64497793a55";

    /**
     * Inital method for OlaPicTest class
     * @method __construct
     */
    public function __construct()
    {
        $this->app = new Silex\Application();
        $this->app['debug'] = true;
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

        $endpoint = 'https://api.instagram.com/v1/media/'.$id.'?client_id='.$this->client_id;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);
        curl_setopt($ch, CURLOPT_TIMEOUT, '3');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $content = trim(curl_exec($ch));
        curl_close($ch);

        $content = json_decode($content);

        return $app->json($content,200);
    }
}

/**
 * Instace the OlaPicTest class, the constructor make the initialization of $app object
 * for silex aplication, and then, you need to expose the enpoints to the browser.
 */
$int = new OlaPicTest();
$int->endpoints();
return $int->app;