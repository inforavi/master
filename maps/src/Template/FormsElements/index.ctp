<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Forms Element'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Forms'), ['controller' => 'Forms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Form'), ['controller' => 'Forms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Elements'), ['controller' => 'Elements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Element'), ['controller' => 'Elements', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="formsElements index large-9 medium-8 columns content">
    <h3><?= __('Forms Elements') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('form_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('element_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('caption') ?></th>
                <th scope="col"><?= $this->Paginator->sort('field_name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($formsElements as $formsElement): ?>
            <tr>
                <td><?= $this->Number->format($formsElement->id) ?></td>
                <td><?= $formsElement->has('form') ? $this->Html->link($formsElement->form->name, ['controller' => 'Forms', 'action' => 'view', $formsElement->form->id]) : '' ?></td>
                <td><?= $formsElement->has('element') ? $this->Html->link($formsElement->element->name, ['controller' => 'Elements', 'action' => 'view', $formsElement->element->id]) : '' ?></td>
                <td><?= h($formsElement->caption) ?></td>
                <td><?= h($formsElement->field_name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $formsElement->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $formsElement->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $formsElement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $formsElement->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
