<div id="PointsAdminAdd">
    <?php echo $this->Form->create('Point', array('type' => 'file')); ?>
    <div class="Points form">
        <fieldset>
            <legend><?php
                echo __('Add Points', true);
                ?></legend>
            <?php
            echo $this->Form->input('Point.name', array(
                'type' => 'text',
                'label' => '名稱',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Point.member_id', array(
                'type' => 'text',
                'label' => '會員編號',
                'value' => '0',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Point.status', array(
                'type' => 'select',
                'options' => $this->Olc->status,
                'label' => '狀態',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Point.address', array(
                'label' => '住址',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Point.latitude', array(
                'label' => '緯度(latitude)',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Point.longitude', array(
                'label' => '經度(longitude)',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Point.contact', array(
                'label' => '聯絡人',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Point.phone', array(
                'label' => '聯絡電話',
                'div' => 'form-group',
                'class' => 'form-control',
            ));
            echo $this->Form->input('Point.comment', array(
                'rows' => '5',
                'label' => '備註',
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