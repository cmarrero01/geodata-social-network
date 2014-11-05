<?php
/**
 * Created
 * User: Claudio A. Marrero
 * Date: 04/11/2014
 * Time: 09:58 PM
 * @class OlaPic_Config
 */

class OlaPic_Config
{
    /**
     * The client ID for instagram
     * @property $client_id
     * @var string
     * @private
     */
    private $instagram_client_id = "5278ecf3b07d4c999859e64497793a55";

    /**
     * Foursquare client ID
     * @property $foursquare_client_id
     * @var string
     * @private
     */
    private $foursquare_client_id = "WXUQVZWBYHWGHPRJXWKOIIXARJLODZ3D2S1GR3IF0UEHYYPE";

    /**
     * Foursquare secret ID
     * @property $foursquare_secret_id
     * @var string
     * @private
     */
    private $foursquare_secret_id = "XIDYLCEEI2EGSQQ4F1UZA1DPFLRINCGJMWBFES0AGLZ2JSRL";

    /**
     * Google API key
     * @property $google_places_key
     * @var string
     * @private
     */
    private $google_places_key = "AIzaSyDmhtVYByke72YjaFSAoaiYKxvWgUjVq28";

    /**
     * Geter for instagram client id
     * @return string
     */
    public function getInstId(){
        return $this->instagram_client_id;
    }

    /**
     * Geter for Foursquare client id
     * @return string
     */
    public function getFourId(){
        return $this->foursquare_client_id;
    }

    /**
     * Geter for foursquare secret id
     * @return string
     */
    public function getFourSecret(){
        return $this->foursquare_secret_id;
    }

    /**
     * Geter for google api key for google places.
     * @return string
     */
    public function getGooKey(){
        return $this->google_places_key;
    }
}
