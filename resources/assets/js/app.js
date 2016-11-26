function initMap() {
    var $map = $('#map');
    window.ResMap = $map.GoogleMap({
        lat: $map.data('lat'),
        lng: $map.data('lng'),
        input: $('#input')
    });

    var geoInterval = setInterval(function(){
        navigator.geolocation.getCurrentPosition(success);
    }, 3000);
}

function success(position) {
    $.ajax({
        type: "POST",
        url: '/users/' + window.userId + '/location',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            lati: position.coords.latitude,
            long: position.coords.longitude
        },
        dataType: 'json',
        success: function(data) {
            console.log(data);
        }
    });
}

function error() {
    console.log("error");
}