<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Form Value'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Patients'), ['controller' => 'Patients', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Patient'), ['controller' => 'Patients', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Forms'), ['controller' => 'Forms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Form'), ['controller' => 'Forms', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="formValues index large-9 medium-8 columns content">
    <h3><?= __('Form Values') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('patient_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('form_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('form_element_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('field_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('field_value') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($formValues as $formValue): ?>
            <tr>
                <td><?= $this->Number->format($formValue->id) ?></td>
                <td><?= $formValue->has('patient') ? $this->Html->link($formValue->patient->name, ['controller' => 'Patients', 'action' => 'view', $formValue->patient->id]) : '' ?></td>
                <td><?= $formValue->has('form') ? $this->Html->link($formValue->form->name, ['controller' => 'Forms', 'action' => 'view', $formValue->form->id]) : '' ?></td>
                <td><?= $this->Number->format($formValue->form_element_id) ?></td>
                <td><?= h($formValue->field_name) ?></td>
                <td><?= h($formValue->field_value) ?></td>
                <td><?= h($formValue->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $formValue->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $formValue->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $formValue->id], ['confirm' => __('Are you sure you want to delete # {0}?', $formValue->id)]) ?>
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
