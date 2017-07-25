<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Map'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="maps index large-9 medium-8 columns content">
    <h3><?= __('Maps') ?></h3>
    <input type="text" id="txtPlaces" placeholder="Search cultral home in india">
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('descr') ?></th>
                <th scope="col"><?= $this->Paginator->sort('lat') ?></th>
                <th scope="col"><?= $this->Paginator->sort('lon') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Distance(Km.)') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($maps as $map): ?>
                <tr>
                    <td><?= $this->Number->format($map['id']) ?></td>
                    <td><?= h($map['name']) ?></td>
                    <td><?= h($map['descr']) ?></td>
                    <td><?= h($map['lat']) ?></td>
                    <td><?= h($map['lon']) ?></td>
                    <td><?= $this->Number->format($map['distance']) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $map['id']]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $map['id']]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $map['id']], ['confirm' => __('Are you sure you want to delete # {0}?', $map['id'])]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <div id="map_canvas" style="width: 700px; height: 500px;"></div>

        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAMwlCs4nq-MpgGjRDKIWTWzrIJaLb_CEw&libraries=places"></script>
        <script>
            var map;

            function initialize() {
                var myLatlng = new google.maps.LatLng(28.713956, 77.006653);
                var myOptions = {
                    zoom: 12,
                    center: myLatlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

                <?php foreach ($maps as $map) { ?>
                    var location = new google.maps.LatLng(<?php echo $map['lat']; ?>, <?php echo $map['lon']; ?>);
                    var marker = new google.maps.Marker({
                        position: location,
                        title: "<?php echo $map['name'] . '-' . $map['descr']; ?>",
                        map: map
                    });
                <?php } ?>
                var locationCenter = new google.maps.LatLng(<?php echo $fLat; ?>, <?php echo $fLon; ?>);
                map.setCenter(locationCenter);
            }
            google.maps.event.addDomListener(window, "load", initialize());
        </script>
        <script>
            google.maps.event.addDomListener(window, 'load', function () {
                var places = new google.maps.places.Autocomplete(document.getElementById('txtPlaces'));
                google.maps.event.addListener(places, 'place_changed', function () {
                    var place = places.getPlace();
                    console.log(place);
                    var address = place.formatted_address;
                    var latitude = place.geometry.location.lat();
                    var longitude = place.geometry.location.lng();
                    window.location.href = window.location.href+"?lat="+latitude+"&lon="+longitude;
                });
            });
        </script>

        </tbody>
    </table>
    
</div>
