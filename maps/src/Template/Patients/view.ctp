<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Patient'), ['action' => 'edit', $patient->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Patient'), ['action' => 'delete', $patient->id], ['confirm' => __('Are you sure you want to delete # {0}?', $patient->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Patients'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Patient'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Form Values'), ['controller' => 'FormValues', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Form Value'), ['controller' => 'FormValues', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="patients view large-9 medium-8 columns content">
    <h3><?= h($patient->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $patient->has('user') ? $this->Html->link($patient->user->name, ['controller' => 'Users', 'action' => 'view', $patient->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($patient->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($patient->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dob') ?></th>
            <td><?= h($patient->dob) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($patient->created) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Form Values') ?></h4>
        <?php if (!empty($patient->form_values)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Patient Id') ?></th>
                <th scope="col"><?= __('Form Id') ?></th>
                <th scope="col"><?= __('Form Element Id') ?></th>
                <th scope="col"><?= __('Field Name') ?></th>
                <th scope="col"><?= __('Field Value') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($patient->form_values as $formValues): ?>
            <tr>
                <td><?= h($formValues->id) ?></td>
                <td><?= h($formValues->patient_id) ?></td>
                <td><?= h($formValues->form_id) ?></td>
                <td><?= h($formValues->form_element_id) ?></td>
                <td><?= h($formValues->field_name) ?></td>
                <td><?= h($formValues->field_value) ?></td>
                <td><?= h($formValues->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'FormValues', 'action' => 'view', $formValues->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'FormValues', 'action' => 'edit', $formValues->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'FormValues', 'action' => 'delete', $formValues->id], ['confirm' => __('Are you sure you want to delete # {0}?', $formValues->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
