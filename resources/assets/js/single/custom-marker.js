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
        this.map = null;
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
    var imgAvatar;
    var imgCrown;
    var imgTower;

    if (typeof(this.args.marker_id) !== 'undefined') {
        if (this.args.marker_id == 'tower') {
            imgTower = document.createElement('img');
        } else {
            imgAvatar = document.createElement('img');
            var name = 'avatar_' + this.args.marker_id;
            imgAvatar.classList.add(name);

            if(this.args.marker_id =='king')
                imgCrown = document.createElement('img');   
        };
    };

    //for debug
    //console.log('Adding new marker');
    //console.log(this.args.marker_id);

    if (imgTower) { //add tower icon
        imgTower.src = 'https://cdn4.iconfinder.com/data/icons/map1/502/Untitled-18-512.png';
        imgTower.style.height = '100%';
        imgTower.style.width = '100%';
        imgTower.style.position = 'absolute';
        div.appendChild(imgTower);

    } else { //if not tower
        //get avatar from gravatar
        var imgAvatarSrc = 'https://www.gravatar.com/avatar/' + this.hash + '?s=30';
        imgAvatar.src = imgAvatarSrc;
        imgAvatar.style.height = '100%';
        imgAvatar.style.width = '100%';
        imgAvatar.style.position = 'absolute';
        div.appendChild(imgAvatar);

        //add feature if (king)
        if (imgCrown) {
            imgCrown.src = 'https://d3ui957tjb5bqd.cloudfront.net/images/screenshots/products/2/22/22624/croen-f.jpg';
            imgCrown.style.height = '100%';
            imgCrown.style.width = '100%';
            imgCrown.style.position = 'relative';
            imgCrown.style.left = 0 + 'px';
            imgCrown.style.top = -40 + 'px';
            div.appendChild(imgCrown);
        };
    }

    //update div
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