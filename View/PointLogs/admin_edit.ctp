<div id="PointLogsAdminEdit">
    <?php echo $this->Form->create('PointLog', array('type' => 'file')); ?>
    <div class="PointLogs form">
        <fieldset>
            <legend><?php
                echo __('Edit point_logs', true);
                ?></legend>
            <?php
            echo $this->Form->input('PointLog.id');
            foreach ($belongsToModels AS $key => $model) {
                echo $this->Form->input('PointLog.' . $model['foreignKey'], array(
                    'type' => 'select',
                    'label' => $model['label'],
                    'options' => $$key,
                    'div' => 'form-group',
                    'class' => 'form-control',
                ));
            }
            echo $this->Form->input('PointLog.status', array(
                'label' => 'status',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('PointLog.comment', array(
                'rows' => '5',
                'cols' => '',
                'label' => 'comment',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('PointLog.created', array(
                'label' => 'created',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            ?>
        </fieldset>
    </div>
            <?php
            echo $this->Form->end(__('Submit', true));
            ?>
</div>