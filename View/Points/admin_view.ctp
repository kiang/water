<div id="PointsAdminView">
    <h3><?php echo __('View Points', true); ?></h3><hr />
    <div class="col-md-12">

        <div class="col-md-2">status</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['Point']['status']) {

                echo $this->data['Point']['status'];
            }
            ?>&nbsp;
        </div>
        <div class="col-md-2">address</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['Point']['address']) {

                echo $this->data['Point']['address'];
            }
            ?>&nbsp;
        </div>
        <div class="col-md-2">latitude</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['Point']['latitude']) {

                echo $this->data['Point']['latitude'];
            }
            ?>&nbsp;
        </div>
        <div class="col-md-2">longitude</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['Point']['longitude']) {

                echo $this->data['Point']['longitude'];
            }
            ?>&nbsp;
        </div>
        <div class="col-md-2">comment</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['Point']['comment']) {

                echo $this->data['Point']['comment'];
            }
            ?>&nbsp;
        </div>
        <div class="col-md-2">created</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['Point']['created']) {

                echo $this->data['Point']['created'];
            }
            ?>&nbsp;
        </div>
        <div class="col-md-2">modified</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['Point']['modified']) {

                echo $this->data['Point']['modified'];
            }
            ?>&nbsp;
        </div>
    </div>
    <hr />
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Point.id')), null, __('Delete the item, sure?', true)); ?></li>
            <li><?php echo $this->Html->link(__('Points List', true), array('action' => 'index')); ?> </li>
            <li><?php echo $this->Html->link(__('View Related point_logs', true), array('controller' => 'point_logs', 'action' => 'index', 'Point', $this->data['Point']['id']), array('class' => 'PointsAdminViewControl')); ?></li>
            <li><?php echo $this->Html->link(__('View Related Tags', true), array('controller' => 'tags', 'action' => 'index', 'Point', $this->data['Point']['id']), array('class' => 'PointsAdminViewControl')); ?></li>
            <li><?php echo $this->Html->link(__('Set Related Tags', true), array('controller' => 'tags', 'action' => 'index', 'Point', $this->data['Point']['id'], 'set'), array('class' => 'PointsAdminViewControl')); ?></li>
        </ul>
    </div>
    <div id="PointsAdminViewPanel"></div>
    <?php
    echo $this->Html->scriptBlock('

');
    ?>
    <script type="text/javascript">
        //<![CDATA[
        $(function () {
            $('a.PointsAdminViewControl').click(function () {
                $('#PointsAdminViewPanel').parent().load(this.href);
                return false;
            });
        });
        //]]>
    </script>
</div>