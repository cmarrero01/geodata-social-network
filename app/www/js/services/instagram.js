/**
 * Created by Administrador on 04/11/2014.
 */
Olapic.Instagram = (function(){

    function search(lat,lon,callback){
        var endpoint = 'https://api.instagram.com/v1/media/search?lat='+lat+'&lng='+lon+'&client_id='+Olapic.Config.inst+'&callback=?';
        $.getJSON(endpoint,callback);
    }
    return {
        search:search
    };
})();