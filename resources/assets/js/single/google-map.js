/*
 *  GoogleMap.js
 */
;(function( $, window, document, undefined){
    "use strict";

    var defaults = {
        lat: 0,
        lng: 0,
        input: null,
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
                zoom: 4,
                center: position
            });


            //################# CUSTOM MARKER CLASS #################

            CustomMarker.prototype = new google.maps.OverlayView();//subClass Overlay instance

            //Constructor function for CustomMarker object
            function CustomMarker(latlng,map,args) {
                this.latlng = latlng;
                this.map_ = map;
                this.div_ = null;
                this.setMap(map);

                this.updateLocation = function(latLng) {
                    this.latlng = latLng
                };
            };

            CustomMarker.prototype.onAdd = function() {
                var div = document.createElement('div');
                div.style.position = 'absolute';
                div.style.cursor = 'pointer';
                div.style.width = '20px';
                div.style.height = '20px';
                div.style.background = 'blue';
                this.div_ = div;

                var panes = this.getPanes();
                panes.overlayLayer.appendChild(div);
            };

            CustomMarker.prototype.draw = function() {
                var overlayProjection = this.getProjection();
                var point = overlayProjection.fromLatLngToDivPixel(this.latlng);
                var div = this.div_;

                div.style.left = (point.x-20) + 'px';
                div.style.top = (point.y-20) + 'px';
            };

            CustomMarker.prototype.onRemove = function() {
                if (this.div) {
                    this.div_.parentNode.removeChild(this.div_);
                    this.div_ = null;
                }   
            };

            CustomMarker.prototype.getPosition = function() {
                return this.latlng;
            };


            //################# END OF CLASS #################

            //this.addMarker(position, 'Hello!');
            this.activeMarkers.push(new CustomMarker(position,this.map,{}));
            console.log(this.activeMarkers[0].getPosition());

            if (this.settings.input != null) {
                this.initSearchBar();
            }
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