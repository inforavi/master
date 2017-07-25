<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Maps'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<style> html, body, #map_canvas {
        margin: 0;
        padding: 0;
        height: 100%
    }
</style>
<div class="maps form large-9 medium-8 columns content">
    <input type="text" id="pac-input" size="6"/>
    <div id="map-canvas" style="width:700px; height: 500px;"></div>
    <?= $this->Form->create($map) ?>
    <fieldset>
        <legend><?= __('Add Map') ?></legend>
        <?php
        echo $this->Form->input('name');
        echo $this->Form->input('descr');
        echo $this->Form->input('lat', ['id' => 'lat']);
        echo $this->Form->input('lon', ['id' => 'long']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAMwlCs4nq-MpgGjRDKIWTWzrIJaLb_CEw&libraries=places"></script>
<script>
    function initialize() {
        var markers = [];
        var map = new google.maps.Map(document.getElementById('map-canvas'), {
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var defaultBounds = new google.maps.LatLngBounds(new google.maps.LatLng(28.00000, 77.0000),new google.maps.LatLng(28.1000, 77.1000));
        map.fitBounds(defaultBounds);
        var input = document.getElementById('pac-input');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        var searchBox = new google.maps.places.SearchBox(input);
        
        google.maps.event.addListener(searchBox, 'places_changed', function () {
            var places = searchBox.getPlaces();
            if (places.length == 0) {
                return;
            }
            for (var i = 0, marker; marker = markers[i]; i++) {
                marker.setMap(null);
            }
            markers = [];
            var bounds = new google.maps.LatLngBounds();
            for (var i = 0, place; place = places[i]; i++) {
                var image = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };
                var marker = new google.maps.Marker({
                    draggable: true,
                    map: map,
                    icon: image,
                    title: place.name,
                    position: place.geometry.location
                });
                // drag response
                google.maps.event.addListener(marker, 'dragend', function (e) {
                    displayPosition(this.getPosition());
                });
                // click response
                google.maps.event.addListener(marker, 'click', function (e) {
                    displayPosition(this.getPosition());
                });
                markers.push(marker);
                bounds.extend(place.geometry.location);
            }
            map.fitBounds(bounds);
        });
        google.maps.event.addListener(map, 'bounds_changed', function () {
            var bounds = map.getBounds();
            searchBox.setBounds(bounds);
        });
        // displays a position on two <input> elements
        function displayPosition(pos) {
            document.getElementById('lat').value = pos.lat();
            document.getElementById('long').value = pos.lng();
        }
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>