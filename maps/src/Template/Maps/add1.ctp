<style>
html, body, #map_canvas {
    height: 100%;
    width: 100%;
    margin: 0px;
    padding: 0px
}
</style>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Maps'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="maps form large-9 medium-8 columns content">
    <div id="map" style="width: 750px; height: 250px; background-color: Black;">
    <?php
        echo $this->Form->input('name', ['id' => 'pac-input']);
    ?>
    
    </div>
    <?= $this->Form->create($map) ?>
    <fieldset>
        <legend><?= __('Add Map') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('descr');
            echo $this->Form->input('lat', ['id' => 'lat']);
            echo $this->Form->input('lon', ['id' => 'lng']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMwlCs4nq-MpgGjRDKIWTWzrIJaLb_CEw"></script>-->
<html>
  <head>
    <title>Geocoding service</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
    </style>
  </head>
  <body>
    
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMwlCs4nq-MpgGjRDKIWTWzrIJaLb_CEw&callback=initMap">
    </script>
    <script>
      function initialize() {
        var markers = [];
        var map = new google.maps.Map(document.getElementById('map'), {
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var defaultBounds = new google.maps.LatLngBounds(
            new google.maps.LatLng(-33.8902, 151.1759),
            new google.maps.LatLng(-33.8474, 151.2631));
        map.fitBounds(defaultBounds);
        var input = /** @type {HTMLInputElement} */(
          document.getElementById('pac-input')
        );
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        var searchBox = new google.maps.places.SearchBox(
          /** @type {HTMLInputElement} */(input));
        google.maps.event.addListener(searchBox, 'places_changed', function() {
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
            google.maps.event.addListener(marker, 'dragend', function(e) {
              displayPosition(this.getPosition());
            });
            // click response
            google.maps.event.addListener(marker, 'click', function(e) {
              displayPosition(this.getPosition());
            });
            markers.push(marker);
            bounds.extend(place.geometry.location);
          }
          map.fitBounds(bounds);
        });
        google.maps.event.addListener(map, 'bounds_changed', function() {
          var bounds = map.getBounds();
          searchBox.setBounds(bounds);
        });
        // displays a position on two <input> elements
        function displayPosition(pos) {
          document.getElementById('lat').value = pos.lat();
          document.getElementById('lng').value = pos.lng();
        }
      }  
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    
  </body>
</html>