<?php
if (!isset($url)) {
    $url = array();
}

if (!empty($foreignId) && !empty($foreignModel)) {
    $url = array($foreignModel, $foreignId);
}
?>
<div id="PointLogsAdminIndex">
    <h2><?php echo __('point_logs', true); ?></h2>
    <div class="btn-group">
        <?php echo $this->Html->link(__('Add', true), array_merge($url, array('action' => 'add')), array('class' => 'btn dialogControl')); ?>
    </div>
    <div><?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?></div>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <table class="table table-bordered" id="PointLogsAdminIndexTable">
        <thead>
            <tr>
                <?php if (empty($scope['PointLog.Point_id'])): ?>
                    <th><?php echo $this->Paginator->sort('PointLog.Point_id', 'Points', array('url' => $url)); ?></th>
                <?php endif; ?>

                <th><?php echo $this->Paginator->sort('PointLog.status', 'status', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('PointLog.comment', 'comment', array('url' => $url)); ?></th>
                <th><?php echo $this->Paginator->sort('PointLog.created', 'created', array('url' => $url)); ?></th>
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
                    <?php if (empty($scope['PointLog.Point_id'])): ?>
                        <td><?php
                            if (empty($item['Point']['id'])) {
                                echo '--';
                            } else {
                                echo $this->Html->link("{$item['Point']['name']} ({$item['Point']['address']})", array(
                                    'controller' => 'points',
                                    'action' => 'view',
                                    $item['Point']['id']
                                ));
                            }
                            ?></td>
                    <?php endif; ?>

                    <td><?php
                        echo $this->Olc->status[$item['PointLog']['status']];
                        ?></td>
                    <td><?php
                        echo $item['PointLog']['comment'];
                        ?></td>
                    <td><?php
                        echo $item['PointLog']['created'];
                        ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View', true), array('action' => 'view', $item['PointLog']['id']), array('class' => 'dialogControl')); ?>
                        <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $item['PointLog']['id']), array('class' => 'dialogControl')); ?>
                        <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $item['PointLog']['id']), null, __('Delete the item, sure?', true)); ?>
                    </td>
                </tr>
            <?php } // End of foreach ($items as $item) {  ?>
        </tbody>
    </table>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <div id="PointLogsAdminIndexPanel"></div>
    <script type="text/javascript">
        //<![CDATA[
        $(function () {
            $('#PointLogsAdminIndexTable th a, #PointLogsAdminIndex div.paging a').click(function () {
                $('#PointLogsAdminIndex').parent().load(this.href);
                return false;
            });
        });
        //]]>
    </script>
</div>