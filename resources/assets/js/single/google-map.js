/*
 *  GoogleMap.js
 */
;(function( $, window, document, undefined){
    "use strict";

    var defaults = {
        lat: 0,
        lng: 0,
        input: null,
        radius: 17,
        callback: function() {}
    };

    // constructor
    function GoogleMap(element, options) {
        this.element = element;
        this.$element = $(this.element);
        this.settings = $.extend({}, defaults, options);
        this._defaults = defaults;
        this._name = 'google_map';
        this.init();
    }

    // methods
    $.extend(GoogleMap.prototype, {
        isInProgress: false,
        currentState: 0,
        map: null,
        search: null,
        activeMarkers: [],

        init: function() {
            var app = this;
            var position = new google.maps.LatLng({lat: this.settings.lat, lng: this.settings.lng});
            //var position = {lat: this.settings.lat, lng: this.settings.lng};

            this.map = new google.maps.Map(this.element, {
                zoom: this.settings.radius,
                center: position,
                disableDefaultUI: true
            });

            //########## AJAX TRY #######

            $.ajax({
                type: 'GET',
                url: 'http://localhost:8888/boards/4/users',
                dataType: 'json',
                success: function(data) {
                    var mapOwner = data.id;
                    var marker_id;
                    var hash;

                    //wipe canvas of markers if any
                    if (app.activeMarkers.length > 0) {
                        for (var i=0; i<app.activeMarkers.length; i++) {
                            app.activeMarkers[i].removeMarker();
                        };
                    };
                    

                    //add new/current participants
                    for (var i = 0; i < data.participants.length; i++) {
                        var location = data.participants[i].locations[0];
                        position = new google.maps.LatLng({lat: location.lati, lng: location.long});
                        var userID = data.participants[i].id;
                        if (mapOwner == userID) {
                            marker_id = 'king';
                        } else {
                            marker_id = 'slave'
                        }
                        hash = data.participants[i].hash;
                        app.activeMarkers.push(new CustomMarker(position,app.map,{marker_id: marker_id},hash));
                    }
                    console.log('SUCCESS');
                    console.log(data);

                },
                error: function() {
                    console.log('ERROR');
                }
            });


            //add marker
            this.activeMarkers.push(new CustomMarker(position,this.map,{marker_id: 'slave'}));

            //add another marker
            var newPosition = new google.maps.LatLng({lat: -40, lng: 140});
            this.activeMarkers.push(new CustomMarker(newPosition,this.map,{marker_id: 'king'}));

            //update locations like so...
            //this.activeMarkers[0].updateLocation(newPosition);
        },

        addMarker: function(pos, title) {
            //this.activeMarkers.push(new CustomMarker(pos,this.map,{}));
            //console.log(this.activeMarkers[0].getPosition());
        },

        initSearchBar: function() {
            var app = this;
            this.search = new google.maps.places.SearchBox(this.settings.input.get(0), {});
            this.search.addListener('places_changed', function() {
                app.updateMapCenter();
            });
        },

        updateMapCenter: function() {
            var places = this.search.getPlaces();
            var bounds = new google.maps.LatLngBounds();
            bounds.extend(places[0].geometry.location);
            this.map.fitBounds(bounds);
        }
    });

    // lightweight wrapper
    $.fn['GoogleMap'] = function(options) {
        return this.each(function() {
            if (!$.data(this, 'google_map')){
                $.data(this, 'google_map', new GoogleMap(this, options));
            }
        });
    };

})(jQuery, window, document);