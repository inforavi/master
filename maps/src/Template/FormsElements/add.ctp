<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Forms Elements'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Forms'), ['controller' => 'Forms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Form'), ['controller' => 'Forms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Elements'), ['controller' => 'Elements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Element'), ['controller' => 'Elements', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="formsElements form large-9 medium-8 columns content">
    <?= $this->Form->create($formsElement) ?>
    <fieldset>
        <legend><?= __('Add Forms Element') ?></legend>
        <?php
            echo $this->Form->input('form_id', ['options' => $forms]);
            echo $this->Form->input('element_id', ['options' => $elements]);
            echo $this->Form->input('caption');
            echo $this->Form->input('field_name');
            echo $this->Form->input('is_required');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
