<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('View Patient Medical History'), ['action' => 'medical_history']) ?></li>
    </ul>
</nav>

<div class="formsElements form large-9 medium-8 columns content">
    <?= $this->Form->create(null, [
    'url' => ['controller' => 'FormsElements', 'action' => 'saveDynamicForm']
    ]); ?>
    <fieldset>
        <legend><?php echo $finalResult[0]['form_name']; ?></legend>
        <?php echo $this->Form->input('patient_id', ['type'=>'hidden', 'value'=>'120']); ?>
        <?php foreach($finalResult as $key=>$element){ ?>
        <?php echo $this->Form->input($element['field_name'].'__'.$element['from_element_id'], ['type'=>$element['field_type'], 'required'=>$element['required']]); ?>
        <?php } ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
