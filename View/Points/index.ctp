<div id="PointsIndex">
    <h2>淹水點</h2>
    <div class="btn-group pull-left">
        <?php
        if (empty($foreignId) && $groupValue == '1') {
            $class = 'btn-primary';
        } else {
            $class = 'btn-default';
        }
        echo $this->Html->link('全部', '/points/map/1', array('class' => 'btn ' . $class));
        foreach ($tags AS $tag) {
            if ($foreignId == $tag['Tag']['id']) {
                $class = 'btn-primary';
            } else {
                $class = 'btn-default';
            }
            echo $this->Html->link($tag['Tag']['name'], '/points/map/' . $tag['Tag']['group'] . '/' . $tag['Tag']['id'], array('class' => 'btn ' . $class));
        }
        ?>
    </div>
    <div class="btn-group pull-right"><?php
        echo $this->Html->link('地圖', '/points/map/' . $groupValue . '/' . $foreignId, array('class' => 'btn btn-default'));
        echo $this->Html->link('新增', '/points/add/1', array('class' => 'btn btn-default'));
        if (!isset($url)) {
            $url = array();
        }
        ?></div>
    <table class="table table-bordered" id="PointsIndexTable">
        <thead>
            <tr>
                <th>狀態</th>
                <th>名稱</th>
                <th>住址</th>
                <th>備註</th>
                <th><?php echo $this->Paginator->sort('Point.ref_time', '發生時間', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Point.modified', '更新時間', array('url' => $url)); ?></th>
                <th class="actions">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($items as $item) {
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = ' class="altrow"';
                }
                ?>
                <tr<?php echo $class; ?>>
                    <td><?php
                        if ($item['Point']['group'] === '1') {
                            echo $this->Olc->status[$item['Point']['status']];
                        } else {
                            echo $this->Olc->status2[$item['Point']['status']];
                        }
                        ?></td>
                    <td><?php
                    echo $item['Point']['name'];
                        ?></td>
                    <td><?php
                    echo $item['Point']['address'];
                        ?></td>
                    <td><?php
                    echo str_replace('\\n', '<br />', $item['Point']['comment']);
                        ?></td>
                    <td><?php
                    echo $item['Point']['ref_time'];
                        ?></td>
                    <td><?php
                    echo $item['Point']['modified'];
                        ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link('檢視', array('action' => 'view', $item['Point']['id']), array('class' => 'PointsIndexControl')); ?>
                    </td>
                </tr>
            <?php }; // End of foreach ($items as $item) {   ?>
        </tbody>
    </table>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
</div>