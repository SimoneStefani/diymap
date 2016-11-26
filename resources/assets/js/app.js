function initMap() {

    var $map = $('#map');
    window.ResMap = $map.GoogleMap({
        lat: $map.data('lat'),
        lng: $map.data('lng')
    });
}
