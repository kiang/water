<div id="PointsIndex">
    <h2><?php echo __('Points', true); ?></h2>
    <div class="clear actions">
        <ul>
        </ul>
    </div>
    <p>
        <?php
        $url = array();

        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?></p>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <table class="table table-bordered" id="PointsIndexTable">
        <thead>
            <tr>

                <th><?php echo $this->Paginator->sort('Point.status', 'status', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Point.address', 'address', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Point.latitude', 'latitude', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Point.longitude', 'longitude', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Point.comment', 'comment', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Point.created', 'created', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('Point.modified', 'modified', array('url' => $url)); ?></th>
                <th class="actions"><?php echo __('Action', true); ?></th>
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
                        echo $item['Point']['status'];
                        ?></td>
                    <td><?php
                        echo $item['Point']['address'];
                        ?></td>
                    <td><?php
                        echo $item['Point']['latitude'];
                        ?></td>
                    <td><?php
                        echo $item['Point']['longitude'];
                        ?></td>
                    <td><?php
                        echo $item['Point']['comment'];
                        ?></td>
                    <td><?php
                        echo $item['Point']['created'];
                        ?></td>
                    <td><?php
                        echo $item['Point']['modified'];
                        ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View', true), array('action' => 'view', $item['Point']['id']), array('class' => 'PointsIndexControl')); ?>
                    </td>
                </tr>
            <?php }; // End of foreach ($items as $item) {  ?>
        </tbody>
    </table>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <div id="PointsIndexPanel"></div>
    <script type="text/javascript">
        //<![CDATA[
        $(function () {
            $('#PointsIndexTable th a, div.paging a, a.PointsIndexControl').click(function () {
                $('#PointsIndex').parent().load(this.href);
                return false;
            });
        });
        //]]>
    </script>
</div>