/**
 * Created by Administrador on 04/11/2014.
 */
var Olapic = (function(){

    function init(){
        Olapic.Map.init();
    }

    function event(){
        if (navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry)/)) {
            document.addEventListener("deviceready", init, false);
            return;
        }

        $(document).ready(function(){
            init();
        });
    }

    return {
        init:init,
        event:event
    }
})();