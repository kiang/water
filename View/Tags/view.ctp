<div id="TagsView">
    <h3><?php echo __('View Tags', true); ?></h3><hr />
    <div class="col-md-12">

        <div class="col-md-2">Name</div>
        <div class="col-md-9"><?php
            if ($this->data['Tag']['name']) {

                echo $this->data['Tag']['name'];
            }
?>&nbsp;
        </div>
    </div>
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('Tags List', true), array('action' => 'index')); ?> </li>
            <li><?php echo $this->Html->link(__('View Related Points', true), array('controller' => 'points', 'action' => 'index', 'Tag', $this->data['Tag']['id']), array('class' => 'TagsViewControl')); ?></li>
        </ul>
    </div>
    <div id="TagsViewPanel"></div>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            $('a.TagsViewControl').click(function() {
                $('#TagsViewPanel').parent().load(this.href);
                return false;
            });
        });
        //]]>
    </script>
</div>