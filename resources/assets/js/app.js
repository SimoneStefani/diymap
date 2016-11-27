var $map = $('#map');
window.ResMap = $map.GoogleMap({
    lat: $map.data('lat'),
    lng: $map.data('lng'),
    input: $('#input')
});


$('#invite-user').on('click', function() {
    alertify
        .defaultValue("Email...")
        .logPosition("bottom right")
        .prompt("Invite another user by email:", function (val, ev) {
            ev.preventDefault();

            $.ajax({
                type: "POST",
                url: '/boards/3/add-user',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    email: val
                },
                dataType: 'json',
                success: function(data) {
                    alertify.success("User " + val + " added!");
                    console.log(data);
                },
                error: function(data) {
                    console.log(data);
                    alertify.error("Whoops! Something went wrong.");
                }
            });
        }, function(ev) {
            ev.preventDefault();
        });
});

var $where = $('#where'),
    $lati = $('#lati'),
    $long = $('#long');

if ($where.length > 0) {
    var search = new google.maps.places.SearchBox($where.get(0), {});
    search.addListener('places_changed', function() {
        var places = search.getPlaces();
        $lati.val(places[0].geometry.location.lat);
        $long.val(places[0].geometry.location.lng);
    });
}

// import Echo from "laravel-echo"
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: config('PUSHER_KEY'),
//     cluster: 'eu',
//     encrypted: true
// });
