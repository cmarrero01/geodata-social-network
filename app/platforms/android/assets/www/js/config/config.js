/**
 * Created by Administrador on 04/11/2014.
 */
Olapic.Config = (function(){

    /**
     * The client ID for instagram
     * @property client_id
     * @var string
     * @private
     */
    var instagram_client_id = "5278ecf3b07d4c999859e64497793a55";

    /**
     * Foursquare client ID
     * @property foursquare_client_id
     * @var string
     * @private
     */
    var foursquare_client_id = "WXUQVZWBYHWGHPRJXWKOIIXARJLODZ3D2S1GR3IF0UEHYYPE";

    /**
     * Foursquare secret ID
     * @property foursquare_secret_id
     * @var string
     * @private
     */
    var foursquare_secret_id = "XIDYLCEEI2EGSQQ4F1UZA1DPFLRINCGJMWBFES0AGLZ2JSRL";

    /**
     * Google API key
     * @property google_places_key
     * @var string
     * @private
     */
    var google_places_key = "AIzaSyDmhtVYByke72YjaFSAoaiYKxvWgUjVq28";

    var base_endpoint = "http://192.237.166.152/_olapic/api/media/";

    return {
        inst:instagram_client_id,
        base_endpoint:base_endpoint
    };
})();