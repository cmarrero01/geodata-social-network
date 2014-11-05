/**
 * Created by Administrador on 04/11/2014.
 */
Olapic.OlapicTest = (function(){

    function media(id,callback){
        var endpoint = Olapic.Config.base_endpoint+id;
        $.getJSON(endpoint,function(r){
            callback(r);
        });
    }

    return {
        media:media
    };
})();