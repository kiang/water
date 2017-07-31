<div id="PointsMap">
    <div class="btn-group pull-left">
        <?php
        if (empty($tagId) && $groupValue == '1') {
            $class = 'btn-primary';
        } else {
            $class = 'btn-default';
        }
        echo $this->Html->link('全部', '/points/map/1', array('class' => 'btn ' . $class));
        foreach ($tags AS $tag) {
            if ($tagId == $tag['Tag']['id']) {
                $class = 'btn-primary';
            } else {
                $class = 'btn-default';
            }
            echo $this->Html->link($tag['Tag']['name'], '/points/map/' . $tag['Tag']['group'] . '/' . $tag['Tag']['id'], array('class' => 'btn ' . $class));
        }
        ?>
    </div>
    <div class="btn-group pull-right">
        <?php
        echo $this->Html->link('列表', '/points/index/' . $groupValue . '/Tag/' . $tagId, array('class' => 'btn btn-default'));
        echo $this->Html->link('新增', '/points/add/1', array('class' => 'btn btn-default'));
        ?>
    </div>
    <input id="pac-input" class="mapControls" type="text" placeholder="搜尋住址">
    <div id="mapCanvas" class="col-md-12" style="height: 600px;"></div>
</div>
<script>
    var map, baseUrl = '<?php echo $this->Html->url('/'); ?>';
    function initMap() {
        map = new google.maps.Map(document.getElementById('mapCanvas'), {
            center: {lat: 22.997196, lng: 120.211813},
            zoom: 10
        });
        var infowindow = new google.maps.InfoWindow();

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function () {
            searchBox.setBounds(map.getBounds());
        });

        // [START region_getplaces]
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function () {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            map.setCenter(places[0].geometry.location);
            map.setZoom(17);
        });
        // [END region_getplaces]

        $.getJSON('<?php echo $this->Html->url('/points/json/' . $groupValue . '/' . $tagId); ?>', {}, function (points) {
            var markers = [];
            $.each(points, function (k, p) {
                var marker = new google.maps.Marker({
                    position: {lat: parseFloat(p.Point.latitude), lng: parseFloat(p.Point.longitude)},
                    data: p
                });

                marker.addListener('click', function () {
                    var info = '<a href="' + baseUrl + 'points/view/' + this.data.Point.id + '">';
                    info += this.data.Point.name + '(' + this.data.Point.address + ')</a><br />';
                    for (k in this.data.Tag) {
                        info += ' [' + this.data.Tag[k].name + '] '
                    }
                    infowindow.setContent(info);
                    infowindow.open(map, this);
                });
                markers.push(marker);
            })
            var markerCluster = new MarkerClusterer(map, markers);
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?language=zh-TW&libraries=places&callback=initMap&key=AIzaSyBpay28e5O56jgsNKsKsoocC54hNihULGc"></script>
<?php echo $this->Html->script('markerclusterer/src/markerclusterer.js'); ?>