<?php
/**
 * Created by UN IDE MUY BUENO.
 * User: Claudio A. Marrero
 * Date: 03/11/2014
 * Time: 06:58 PM
 * Model for places
 * @class OlaPic_Places
 */
class OlaPic_Places
{
    /**
     * The ID of the place
     * @var $place_id
     * @property $place_id;
     */
    public $place_id;

    /**
     * Name of the place
     * @var $name
     * @property $name;
     */
    public $name;

    /**
     * Geolocation, latitude and longitude of the place
     * @var $location
     * @property $location;
     */
    public $location;

    /**
     * If is foursquare or google places
     * @var $type
     * @property $type;
     */
    public $type;
}
