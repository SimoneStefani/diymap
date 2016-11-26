function initMap() {
    var $map = $('#map');
    window.ResMap = $map.GoogleMap({
        lat: $map.data('lat'),
        lng: $map.data('lng'),
        input: $('#input')
    });
}

$('#invite-user').on('click', function() {
    alertify
        .defaultValue("Default Value")
        .prompt("This is a prompt dialog", function (val, ev) {
            // The click event is in the event variable, so you can use it here.
            ev.preventDefault();

            // The value entered is availble in the val variable.
            alertify.success("You've clicked OK and typed: " + val);

        }, function(ev) {

            // The click event is in the event variable, so you can use it here.
            ev.preventDefault();

            alertify.error("You've clicked Cancel");

        });
});