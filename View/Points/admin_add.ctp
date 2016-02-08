<div id="PointsAdminAdd">
    <?php echo $this->Form->create('Point', array('type' => 'file')); ?>
    <div class="Points form">
        <fieldset>
            <legend><?php
                echo __('Add Points', true);
                ?></legend>
            <?php
            echo $this->Form->input('Point.member_id', array(
                'type' => 'text',
                'label' => 'member_id',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
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
                'label' => 'comment',
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