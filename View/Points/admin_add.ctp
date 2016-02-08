<div id="PointsAdminAdd">
        <?php echo $this->Form->create('Point', array('type' => 'file')); ?>
    <div class="Points form">
        <fieldset>
            <legend><?php
                echo __('Add Points', true);
                ?></legend>
            <?php
            echo $this->Form->input('Point.status', array(
                'label' => 'status',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Point.address', array(
                'label' => 'address',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Point.latitude', array(
                'label' => 'latitude',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Point.longitude', array(
                'label' => 'longitude',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Point.comment', array(
                'rows' => '5',
                'cols' => '',
                'label' => 'comment',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Point.created', array(
                'label' => 'created',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Point.modified', array(
                'label' => 'modified',
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