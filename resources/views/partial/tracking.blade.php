<script>
    @if(!Auth::guest())
        var geoInterval = setInterval(function(){
            navigator.geolocation.getCurrentPosition(success);
        }, 3000);

        function success(position) {
            $.ajax({
                type: "POST",
                url: '/users/{{ Auth::user()->id }}/location',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    lati: position.coords.latitude,
                    long: position.coords.longitude
                },
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                }
            });
        }

        function error() {
            console.log("error");
        }
    @endif
</script>