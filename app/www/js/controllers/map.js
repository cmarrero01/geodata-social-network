/**
 * Created by Administrador on 04/11/2014.
 */
Olapic.Map = (function(){

    var map;
    var markers = [];
    var latLng = [];
    var mediaList = [];
    var businessMarkers = [];
    var businesssLatLng = [];
    var business = [];

    function initialization(){
        var opt = {
            zoom: 14,
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

        for(var index in res.data){
            var media = res.data[index];
            var location = media.location;

            if(!location){
                continue;
            }

            if(latLng.indexOf(media.location.latitude+media.location.longitude) === -1){
                newMarketMedia(media);
            }
        }
    }

    function newMarketMedia(media){

        if(media.type !== 'image' || !media.images || media.images.length <= 0){
            return;
        }

        var thumbnail = media.images.thumbnail;
        if(!thumbnail){
            return;
        }

        var mediaLatLng = new google.maps.LatLng(media.location.latitude,media.location.longitude);

        var image = {
            url: thumbnail.url,
            // This marker is 20 pixels wide by 32 pixels tall.
            size: new google.maps.Size(50,50),
            // The origin for this image is 0,0.
            origin: new google.maps.Point(0,0),
            // The anchor for this image is the base of the flagpole at 0,32.
            anchor: new google.maps.Point(25,25)
        };

        var marker = new google.maps.Marker({
            position: mediaLatLng,
            map: map,
            title: media.name,
            id:media.id,
            icon:image
        });

        markers.push(marker);
        latLng.push(media.location.latitude+media.location.longitude);
        mediaList[media.id] = media;

        google.maps.event.addListener(marker, 'click', OnMarker);

    }

    function OnMarker(ev){
        var $this = $(this);
        if($this.length <= 0){
            return;
        }
        var id = $this[0].id;
        if(!confirm("You want to show the business near of this image?")){
            return;
        }
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

        var image = {
            url: '/img/location-business.png',
            // This marker is 20 pixels wide by 32 pixels tall.
            size: new google.maps.Size(40,51),
            // The origin for this image is 0,0.
            origin: new google.maps.Point(0,0),
            // The anchor for this image is the base of the flagpole at 0,32.
            anchor: new google.maps.Point(20,25)
        };

        var marker = new google.maps.Marker({
            position: placeLatLng,
            map: map,
            title: place.name,
            id:place.place_id,
            icon:image
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