CustomMarker.prototype = new google.maps.OverlayView();//subClass Overlay instance

//Constructor function for CustomMarker object
function CustomMarker(latlng,map,args,hash) {
    this.latlng = latlng;
    this.map_ = map;
    this.div_ = null;
    this.args = args;
    this.setMap(map);
    this.hash = hash;

    this.removeMarker = function() {
        this.setMap(null);
    };

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
    var imgAvatarSrc = 'https://www.gravatar.com/avatar/' + this.hash + '?s=30';
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