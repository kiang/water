<div id="PointsMap">
    <div class="btn-group pull-right">
        <?php
        echo $this->Html->link('列表', '/points/index', array('class' => 'btn btn-default'));
        echo $this->Html->link('新增', '/points/add', array('class' => 'btn btn-primary'));
        ?>
    </div>
    <div id="mapCanvas" class="col-md-12" style="height: 600px;"></div>
</div>
<script>
    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('mapCanvas'), {
            center: {lat: 22.997196, lng: 120.211813},
            zoom: 10
        });
        $.getJSON('<?php echo $this->Html->url('/points/json'); ?>', {}, function (points) {
            $.each(points, function (k, p) {
                var marker = new google.maps.Marker({
                    map: map,
                    draggable: true,
                    position: {lat: parseFloat(p.Point.latitude), lng: parseFloat(p.Point.longitude)},
                    data: p.Point
                });

                marker.addListener('click', function () {
                    location.href = '<?php echo $this->Html->url('/points/view'); ?>/' + this.data.id;
                });
            })
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?language=zh-TW&callback=initMap"></script>