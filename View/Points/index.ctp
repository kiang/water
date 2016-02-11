<div id="PointsIndex">
    <h2>供水點</h2>
    <div class="btn-group pull-left">
        <?php
        foreach ($tags AS $k => $v) {
            if($foreignId == $k) {
                $class = 'btn-primary';
            } else {
                $class = 'btn-default';
            }
            echo $this->Html->link($v, '/points/index/Tag/' . $k, array('class' => 'btn ' . $class));
        }
        ?>
    </div>
    <div class="btn-group pull-right"><?php
        echo $this->Html->link('地圖', '/points/map', array('class' => 'btn btn-default'));
        echo $this->Html->link('新增', '/points/add', array('class' => 'btn btn-primary'));
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
                        echo $this->Olc->status[$item['Point']['status']];
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
                        echo $item['Point']['modified'];
                        ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link('檢視', array('action' => 'view', $item['Point']['id']), array('class' => 'PointsIndexControl')); ?>
                    </td>
                </tr>
            <?php }; // End of foreach ($items as $item) {  ?>
        </tbody>
    </table>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
</div>