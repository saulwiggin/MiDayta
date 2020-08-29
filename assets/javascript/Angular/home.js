app.controller("home", [ '$scope', '$rootScope', '$http', function($scope, $rootScope, $http) {

    var map;
    var geocoder = new google.maps.Geocoder();

        var address = 'cv31 3ay';

        geocoder.geocode( { 'address' : address }, function( results, status ) {
            if( status == google.maps.GeocoderStatus.OK ) {

                map.setCenter( results[0].geometry.location );
                var marker = new google.maps.Marker( {
                    map     : map,
                    position: results[0].geometry.location
                } );
            } else {
                console.log( 'Geocode was not successful for the following reason: ' + status );
            }
        } );
    //}

    map = new google.maps.Map(document.getElementById('map'), {
      //center: {lat: 40.714224, lng: -73.961452},
      zoom: 14
    });

}]);