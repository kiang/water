<div id="PointLogsAdminView">
    <h3><?php echo __('View point_logs', true); ?></h3><hr />
    <div class="col-md-12">
        <div class="col-md-2">Points</div>
        <div class="col-md-9">&nbsp;<?php
            if (empty($this->data['Point']['id'])) {
                echo '--';
            } else {
                echo $this->Html->link($this->data['Point']['id'], array(
                    'controller' => 'points',
                    'action' => 'view',
                    $this->data['Point']['id']
                ));
            }
            ?></div>

        <div class="col-md-2">status</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['PointLog']['status']) {

                echo $this->data['PointLog']['status'];
            }
            ?>&nbsp;
        </div>
        <div class="col-md-2">comment</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['PointLog']['comment']) {

                echo $this->data['PointLog']['comment'];
            }
            ?>&nbsp;
        </div>
        <div class="col-md-2">created</div>
        <div class="col-md-9">&nbsp;<?php
            if ($this->data['PointLog']['created']) {

                echo $this->data['PointLog']['created'];
            }
            ?>&nbsp;
        </div>
    </div>
    <hr />
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('PointLog.id')), null, __('Delete the item, sure?', true)); ?></li>
            <li><?php echo $this->Html->link(__('point_logs List', true), array('action' => 'index')); ?> </li>
        </ul>
    </div>
    <div id="PointLogsAdminViewPanel"></div>
    <?php
    echo $this->Html->scriptBlock('

');
    ?>
    <script type="text/javascript">
        //<![CDATA[
        $(function () {
            $('a.PointLogsAdminViewControl').click(function () {
                $('#PointLogsAdminViewPanel').parent().load(this.href);
                return false;
            });
        });
        //]]>
    </script>
</div>