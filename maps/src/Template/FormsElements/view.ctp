<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Forms Element'), ['action' => 'edit', $formsElement->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Forms Element'), ['action' => 'delete', $formsElement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $formsElement->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Forms Elements'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Forms Element'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Forms'), ['controller' => 'Forms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Form'), ['controller' => 'Forms', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Elements'), ['controller' => 'Elements', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Element'), ['controller' => 'Elements', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="formsElements view large-9 medium-8 columns content">
    <h3><?= h($formsElement->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Form') ?></th>
            <td><?= $formsElement->has('form') ? $this->Html->link($formsElement->form->name, ['controller' => 'Forms', 'action' => 'view', $formsElement->form->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Element') ?></th>
            <td><?= $formsElement->has('element') ? $this->Html->link($formsElement->element->name, ['controller' => 'Elements', 'action' => 'view', $formsElement->element->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Caption') ?></th>
            <td><?= h($formsElement->caption) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Field Name') ?></th>
            <td><?= h($formsElement->field_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($formsElement->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Is Required') ?></h4>
        <?= $this->Text->autoParagraph(h($formsElement->is_required)); ?>
    </div>
</div>
