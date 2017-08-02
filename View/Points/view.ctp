<div id="PointsView">
    <h3><?php echo $this->data['Point']['name']; ?></h3>
    <div class="btn-group pull-right">
        <?php
        echo $this->Html->link('列表', '/points/index/' . $this->data['Point']['group'], array('class' => 'btn btn-default'));
        echo $this->Html->link('地圖', '/points/map/' . $this->data['Point']['group'], array('class' => 'btn btn-default'));
        echo $this->Html->link('新增', '/points/add/' . $this->data['Point']['group'], array('class' => 'btn btn-default'));
        ?>
    </div>

    <hr />
    <?php
    if ($this->data['Point']['group'] === '1') {
        $options = $this->Olc->status;
    } else {
        $options = $this->Olc->status2;
    }
    if (!empty($this->data['Tag'])) {
        echo '類型：<div class="btn-group">';
        foreach ($this->data['Tag'] AS $tag) {
            echo $this->Html->link($tag['name'], '/points/map/' . $tag['group'] . '/' . $tag['id'], array('class' => 'btn btn-default'));
        }
        echo '</div><div class="clearfix"></div>';
    }
    ?>
    <div id="mapCanvas" class="col-md-12" style="height: 300px;"></div>
    <div class="col-md-12">
        <div class="col-md-2">狀態</div>
        <div class="col-md-9"><?php
            echo $options[$this->data['Point']['status']];
            ?>&nbsp;
        </div>
        <div class="col-md-2">住址</div>
        <div class="col-md-9"><?php
            echo $this->data['Point']['address'];
            ?>&nbsp;
        </div>
        <div class="col-md-2">備註</div>
        <div class="col-md-9"><?php
            echo str_replace('\\n', '<br />', $this->data['Point']['comment']);
            ?>&nbsp;
        </div>
        <div class="col-md-2">發生時間</div>
        <div class="col-md-9"><?php
            echo $this->data['Point']['ref_time'];
            ?>&nbsp;
        </div>
        <div class="col-md-2">參考網址</div>
        <div class="col-md-9"><?php
            if (!empty($this->data['Point']['ref_url'])) {
                echo $this->Html->link($this->data['Point']['ref_url'], $this->data['Point']['ref_url'], array('target' => '_blank'));
            }
            ?>&nbsp;
        </div>
        <div class="col-md-2">建立時間</div>
        <div class="col-md-9"><?php
            echo $this->data['Point']['created'];
            ?>&nbsp;
        </div>
        <div class="col-md-2">更新時間</div>
        <div class="col-md-9"><?php
            echo $this->data['Point']['modified'];
            ?>&nbsp;
        </div>
    </div>
    <div class="col-md-12 PointLogs form">
        <h3>更新狀態</h3>
        <?php
        echo $this->Form->create('PointLog', array('url' => '/points/status/' . $this->data['Point']['id']));
        echo $this->Form->input('PointLog.status', array(
            'type' => 'select',
            'options' => $options,
            'value' => $this->data['Point']['status'],
            'label' => '狀態',
            'div' => 'form-group',
            'class' => 'form-control',
        ));
        echo $this->Form->input('PointLog.comment', array(
            'type' => 'textarea',
            'rows' => '5',
            'label' => '備註',
            'div' => 'form-group',
            'class' => 'form-control',
        ));
        echo $this->Form->end('更新');
        ?>
    </div>
    <div class="col-md-12 PointLogs list">
        <h3>更新記錄</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>時間</th>
                    <th>狀態</th>
                    <th>備註</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->data['PointLog'] AS $pointLog) { ?>
                    <tr>
                        <td><?php echo $pointLog['created']; ?></td>
                        <td><?php echo $options[$pointLog['status']]; ?></td>
                        <td><?php echo str_replace('\\n', '<br />', $pointLog['comment']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php if (!empty($this->data['Point']['latitude'])) { ?>
    <script>
        var map, p = {lat: parseFloat('<?php echo $this->data['Point']['latitude']; ?>'), lng: parseFloat('<?php echo $this->data['Point']['longitude']; ?>')};
        function initMap() {
            map = new google.maps.Map(document.getElementById('mapCanvas'), {
                center: p,
                zoom: 15
            });
            var marker = new google.maps.Marker({
                map: map,
                position: p
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?language=zh-TW&callback=initMap&key=AIzaSyBpay28e5O56jgsNKsKsoocC54hNihULGc"></script>
<?php } ?>
