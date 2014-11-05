/**
 * Created by Administrador on 04/11/2014.
 */
Olapic.OlapicTest = (function(){

    function media(id,callback){
        var endpoint = 'http://localhost:8000/media/'+id;
        $.getJSON(endpoint,function(r){
            callback(r);
        });
    }

    return {
        media:media
    };
})();