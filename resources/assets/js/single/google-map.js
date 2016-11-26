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
                center: position,
                disableDefaultUI: true
            });


            //################# CUSTOM MARKER CLASS #################

            CustomMarker.prototype = new google.maps.OverlayView();//subClass Overlay instance

            //Constructor function for CustomMarker object
            function CustomMarker(latlng,map,args) {
                this.latlng = latlng;
                this.map_ = map;
                this.div_ = null;
                this.args = args;
                this.setMap(map);

                this.updateLocation = function(latLng) {
                    if(latLng) {
                        this.latlng = latLng
                    };
                };
            };

            CustomMarker.prototype.onAdd = function() {
                var div = document.createElement('div');
                div.style.borderStyle = 'none';
                div.style.borderWidth = '0px';
                div.style.position = 'absolute';
                div.style.width = '30px';
                div.style.height = '30px';

                //create image element and add it to div + class for styling
                var imgAvatar = document.createElement('img');
                var imgCrown;
                if (typeof(this.args.marker_id) !== 'undefined') {
                    var name = 'avatar_' + this.args.marker_id;
                    imgAvatar.classList.add(name);
                    if (name == 'avatar_king') {
                        imgCrown = document.createElement('img');
                    }
                };
                //get avatar from gravatar
                var imgAvatarSrc = 'https://www.gravatar.com/avatar/' + window.userHash + '?s=30';
                imgAvatar.src = imgAvatarSrc;
                imgAvatar.style.height = '100%';
                imgAvatar.style.width = '100%';
                imgAvatar.style.position = 'absolute';
                div.appendChild(imgAvatar);

                //add feature if user is king
                if (imgCrown) {
                    imgCrown.src = 'https://d3ui957tjb5bqd.cloudfront.net/images/screenshots/products/2/22/22624/croen-f.jpg';
                    imgCrown.style.height = '100%';
                    imgCrown.style.width = '100%';
                    imgCrown.style.position = 'relative';
                    imgCrown.style.left = 0 + 'px';
                    imgCrown.style.top = -40 + 'px';
                    div.appendChild(imgCrown);
                }

                this.div_ = div;
                //add elements to "overlayLayer" pane
                var panes = this.getPanes();
                panes.overlayLayer.appendChild(div);
            };

            CustomMarker.prototype.draw = function() {
                var overlayProjection = this.getProjection();
                var point = overlayProjection.fromLatLngToDivPixel(this.latlng);
                var div = this.div_;
                div.style.left = (point.x-30) + 'px';
                div.style.top = (point.y-30) + 'px';
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

            //add marker
            this.activeMarkers.push(new CustomMarker(position,this.map,{marker_id: 'slave'}));

            //add another marker
            var newPosition = new google.maps.LatLng({lat: -40, lng: 140});
            this.activeMarkers.push(new CustomMarker(newPosition,this.map,{marker_id: 'king'}));

            //update locations like so...
            //this.activeMarkers[0].updateLocation(newPosition);

            if (this.settings.input != null && this.settings.input.length > 0) {
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