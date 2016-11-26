function initMap() {

    var $map = $('#map');
    window.ResMap = $map.GoogleMap({
        lat: $map.data('lat'),
        lng: $map.data('lng')
    });
}

import Echo from "laravel-echo"

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: config('PUSHER_KEY'),
    cluster: 'eu',
    encrypted: true
});
