<div id="PointLogsAdminAdd">
    <?php
    $url = array();
    if (!empty($foreignId) && !empty($foreignModel)) {
        $url = array('action' => 'add', $foreignModel, $foreignId);
    } else {
        $url = array('action' => 'add');
        $foreignModel = '';
    }
    echo $this->Form->create('PointLog', array('type' => 'file', 'url' => $url));
    ?>
    <div class="PointLogs form">
        <fieldset>
            <legend><?php
                echo __('Add point_logs', true);
                ?></legend>
            <?php
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