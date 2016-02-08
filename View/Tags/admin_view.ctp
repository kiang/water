<div id="TagsAdminView">
    <h3><?php echo __('View Tags', true); ?></h3><hr />
    <div class="col-md-12">

        <div class="col-md-2">Name</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['Tag']['name']) {

                echo $this->data['Tag']['name'];
            }
?>&nbsp;
        </div>
    </div>
    <hr />
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Tag.id')), null, __('Delete the item, sure?', true)); ?></li>
            <li><?php echo $this->Html->link(__('Tags List', true), array('action' => 'index')); ?> </li>
            <li><?php echo $this->Html->link(__('View Related Points', true), array('controller' => 'points', 'action' => 'index', 'Tag', $this->data['Tag']['id']), array('class' => 'TagsAdminViewControl')); ?></li>
            <li><?php echo $this->Html->link(__('Set Related Points', true), array('controller' => 'points', 'action' => 'index', 'Tag', $this->data['Tag']['id'], 'set'), array('class' => 'TagsAdminViewControl')); ?></li>
        </ul>
    </div>
    <div id="TagsAdminViewPanel"></div>
<?php
echo $this->Html->scriptBlock('

');
?>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('a.TagsAdminViewControl').click(function() {
                $('#TagsAdminViewPanel').parent().load(this.href);
                return false;
            });
        });
        //]]>
    </script>
</div>