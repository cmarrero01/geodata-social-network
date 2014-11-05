/**
 * Created by Administrador on 04/11/2014.
 */
Olapic.Instagram = (function(){

    var call;

    function search(lat,lon,callback){
        call = callback;
        var endpoint = 'https://api.instagram.com/v1/locations/search?lat='+lat+'&lng='+lon+'&client_id='+Olapic.Config.inst+'&callback=?';
        $.getJSON(endpoint,OnSearch);
    }

    function OnSearch(r){
        call(r);
        call = null;
    }

    return {
        search:search
    };
})();