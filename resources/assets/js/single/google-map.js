/*
 *  GoogleMap.js
 */
;(function( $, window, document, undefined){
    "use strict";

    var defaults = {
        lat: 1,
        lng: 2,
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

        init: function() {
            var app = this;
            var position = {lat: this.settings.lat, lng: this.settings.lng};
            this.map = new google.maps.Map(this.element, {
                zoom: 4,
                center: position
            });

            this.addMarker(position, 'Hello!');
        },

        addMarker: function(pos, title) {
            var marker = new google.maps.Marker({
                position: pos,
                map: this.map,
                title: title
            });
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