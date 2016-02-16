<div id="TagsAdminAdd">
    <?php echo $this->Form->create('Tag', array('type' => 'file')); ?>
    <div class="Tags form">
        <fieldset>
            <legend><?php
                echo __('Add Tags', true);
                ?></legend>
            <?php
            echo $this->Form->input('Tag.group', array(
                'type' => 'select',
                'options' => $this->Olc->groups,
                'label' => 'Group',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Tag.name', array(
                'label' => 'Name',
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