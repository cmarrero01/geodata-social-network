/**
 * Created by Administrador on 04/11/2014.
 */
Olapic.Map = (function(){

    var map;
    var markers = [];
    var latLng = [];
    var businessMarkers = [];
    var businesssLatLng = [];
    var business = [];

    function initialization(){
        var opt = {
            zoom: 8,
            center: new google.maps.LatLng(40.762814257, -73.987614559)
        };
        map = new google.maps.Map(document.getElementById('map'),opt);
        Olapic.Instagram.search(40.762814257,-73.987614559,OnSearch);
    }

    function OnSearch(res){
        if(!res || !res.data || res.data.length <= 0){
            alert("This location doesnt have any media yet");
            return;
        }
        for(var media in res.data){
            var item = res.data[media];
            if(latLng.indexOf(item.latitude+item.longitude) === -1){
                newMedia(item);
            }
        }
    }

    function newMedia(media){

        var mediaLatLng = new google.maps.LatLng(media.latitude,media.longitude);
        var marker = new google.maps.Marker({
            position: mediaLatLng,
            map: map,
            title: media.name,
            id:media.id
        });

        markers.push(marker);
        latLng.push(media.latitude+media.longitude);
        google.maps.event.addListener(marker, 'click', OnMarker);

    }

    function OnMarker(ev){
        var $this = $(this);
        if($this.length <= 0){
            return;
        }
        var id = $this[0].id;
        Olapic.OlapicTest.media(id,OnGetLocations);
    }

    function OnGetLocations(res){

        if(!res || !res.places || res.places.length <= 0){
            alert("This media doesnt have a location");
            return;
        }

        for(var place in res.places){
            var item = res.places[place];
            if(businesssLatLng.indexOf(item.location.lat+item.location.lng) === -1){
                newBusiness(item);
            }
        }

        var latLngToPan = new google.maps.LatLng(res.places[0].location.lat,res.places[0].location.lng);
        map.panTo(latLngToPan);
    }

    function newBusiness(place){

        var placeLatLng = new google.maps.LatLng(place.location.lat,place.location.lng);
        var marker = new google.maps.Marker({
            position: placeLatLng,
            map: map,
            title: place.name,
            id:place.place_id
        });

        business[place.place_id] = place.name;
        businessMarkers.push(marker);
        businesssLatLng.push(place.location.lat+place.location.lng);

        google.maps.event.addListener(marker, 'click', OnBusinessMarker);
    }

    function OnBusinessMarker(ev){
        var $this = $(this);
        if($this.length <= 0){
            return;
        }

        var id = $this[0].id;
        alert(business[id]);
    }

    return {
        init:initialization
    };
})();