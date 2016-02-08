<?php
if (!isset($url)) {
    $url = array();
}
?>
<div id="PointsAdminIndex">
    <h2><?php echo __('Points', true); ?></h2>
    <div class="btn-group">
        <?php echo $this->Html->link(__('Add', true), array('action' => 'add'), array('class' => 'btn dialogControl')); ?>
    </div>
    <div><?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?></div>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <table class="table table-bordered" id="PointsAdminIndexTable">
        <thead>
            <tr>
                <?php
                if (!empty($op)) {
                    echo '<th>&nbsp;</th>';
                }
                ?>

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
                    <?php
                    if (!empty($op)) {
                        echo '<td>';
                        $options = array('value' => $item['Point']['id'], 'class' => 'habtmSet');
                        if ($item['option'] == 1) {
                            $options['checked'] = 'checked';
                        }
                        echo $this->Form->checkbox('Set.' . $item['Point']['id'], $options);
                        echo '<div id="messageSet' . $item['Point']['id'] . '"></div></td>';
                    }
                    ?>

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
                        <?php echo $this->Html->link(__('View', true), array('action' => 'view', $item['Point']['id']), array('class' => 'dialogControl')); ?>
                        <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $item['Point']['id']), array('class' => 'dialogControl')); ?>
                        <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $item['Point']['id']), null, __('Delete the item, sure?', true)); ?>
                    </td>
                </tr>
            <?php } // End of foreach ($items as $item) {  ?>
        </tbody>
    </table>
    <div class="paging"><?php echo $this->element('paginator'); ?></div>
    <div id="PointsAdminIndexPanel"></div>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('#PointsAdminIndexTable th a, #PointsAdminIndex div.paging a').click(function() {
                $('#PointsAdminIndex').parent().load(this.href);
                return false;
            });
<?php
if (!empty($op)) {
    $remoteUrl = $this->Html->url(array('action' => 'habtmSet', $foreignModel, $foreignId));
    ?>
                $('#PointsAdminIndexTable input.habtmSet').click(function() {
                    var remoteUrl = '<?php echo $remoteUrl; ?>/' + this.value + '/';
                    if (this.checked == true) {
                        remoteUrl = remoteUrl + 'on';
                    } else {
                        remoteUrl = remoteUrl + 'off';
                    }
                    $('div#messageSet' + this.value) . load(remoteUrl);
                });
    <?php
}
?>
    });
    //]]>
    </script>
</div>