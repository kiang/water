<div id="PointsIndex">
    <h2>供水點</h2>
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
                <th><?php echo $this->Paginator->sort('Point.status', '狀態', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Point.address', '住址', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Point.comment', '備註', array('url' => $url)); ?></th>
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
                        echo $item['Point']['address'];
                        ?></td>
                    <td><?php
                        echo nl2br($item['Point']['comment']);
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