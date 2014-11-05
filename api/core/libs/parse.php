<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 04/11/2014
 * Time: 10:42 PM
 * Parse places into a model
 * Class OlaPic_ParsePlaces
 * @class OlaPic_ParsePlaces
 */
require_once __DIR__.'/../model/places_model.php';

class OlaPic_ParsePlaces {

    /**
     * Array of each places that the enpoints find.
     * @property $places
     * @var array
     */
    public $places = Array();

    /**
     * Parse Foursquare Venues
     * @method foursParse
     * @param $venues
     * @return array
     */
    public function foursParse($venues){
        $type = "foursquare";
        foreach($venues as $venue){
            $place = new OlaPic_Places();
            $place->place_id = $venue->id;
            $place->location = $venue->location;
            $place->name = $venue->name;
            $place->type = $type;
            $this->places[] = $place;
        }

        return $this->places;
    }

    /**
     * Parse Google Places venues
     * @method gooParse
     * @param $venues
     * @return array
     */
    public function gooParse($venues){
        $type = "google";
        foreach($venues as $venue){
            $place = new OlaPic_Places();
            $place->place_id = $venue->id;
            $place->location = $venue->geometry->location;
            $place->name = $venue->name;
            $place->type = $type;
            $this->places[] = $place;
        }
        return $this->places;
    }

    /**
     * Reset the memory for places var.
     * @method reset
     */
    public function reset(){
        $this->places = Array();
    }
}