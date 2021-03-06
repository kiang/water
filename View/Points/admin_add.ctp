<div id="PointsAdminAdd">
    <?php echo $this->Form->create('Point', array('type' => 'file')); ?>
    <div class="Points form">
        <fieldset>
            <legend><?php
                echo __('Add Points', true);
                ?></legend>
            <?php
            echo $this->Form->input('Tag.group', array(
                'type' => 'select',
                'options' => $this->Olc->groups,
                'label' => 'Group',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Point.name', array(
                'type' => 'text',
                'label' => '名稱',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Point.member_id', array(
                'type' => 'text',
                'label' => '會員編號',
                'value' => '0',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Point.status', array(
                'type' => 'select',
                'options' => $this->Olc->status,
                'label' => '狀態',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Point.address', array(
                'label' => '住址',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Point.latitude', array(
                'type' => 'text',
                'label' => '緯度(latitude)',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Point.longitude', array(
                'type' => 'text',
                'label' => '經度(longitude)',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            ?>
            <div class="btn-group">
                <a href="#" id="btnAddressToPoint" class="btn btn-default">住址轉座標</a>
                <a href="#" id="btnCopyAddress" class="btn btn-default">使用標示住址</a>
                <span style="line-height: 32px;padding: 5px;">標示住址：</span>
                <span id="spanAddress" style="line-height: 32px;padding: 5px;"></span>
            </div>
            <div id="mapCanvas" class="col-md-12" style="height: 300px;"></div>
            <?php
            echo $this->Form->input('Point.ref_time', array(
                'type' => 'text',
                'label' => '發生時間',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Point.ref_url', array(
                'label' => '參考網址',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Point.comment', array(
                'rows' => '5',
                'label' => '備註',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            ?>
        </fieldset>
    </div>
    <?php
    echo $this->Form->end(__('Submit', true));
    ?>
</div>
<script>
    var map, geocoder, marker;
    function initMap() {
        geocoder = new google.maps.Geocoder();
        map = new google.maps.Map(document.getElementById('mapCanvas'), {
            center: {lat: 22.997196, lng: 120.211813},
            zoom: 10
        });
        marker = new google.maps.Marker({
            map: map,
            draggable: true,
            position: {lat: 22.997196, lng: 120.211813}
        });

        marker.addListener('dragend', function () {
            var newPosition = marker.getPosition();
            geocoder.geocode({'location': newPosition}, function (results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                    $('#spanAddress').html(results[0].formatted_address);
                }
            });
            updatePosition();
        });
        function updatePosition() {
            var newPosition = marker.getPosition();
            $('#PointLongitude').val(newPosition.lng());
            $('#PointLatitude').val(newPosition.lat());
        }
        $('#btnAddressToPoint').click(function () {
            var address = $('#PointAddress').val();
            if (address !== '') {
                geocoder.geocode({'address': address}, function (results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        map.setCenter(results[0].geometry.location);
                        marker.setPosition(results[0].geometry.location);
                        $('#spanAddress').html(results[0].formatted_address);
                        updatePosition();
                    } else {
                        alert('找不到適合座標，系統訊息： ' + status);
                    }
                });
            }
            return false;
        });
        $('#btnCopyAddress').click(function () {
            $('#PointAddress').val($('#spanAddress').text());
            return false;
        });
        $('#PointRefTime').datetimepicker({
            "dateFormat": "yy-mm-dd",
            "timeFormat": "HH:mm"
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?language=zh-TW&callback=initMap&key=AIzaSyBpay28e5O56jgsNKsKsoocC54hNihULGc"></script>