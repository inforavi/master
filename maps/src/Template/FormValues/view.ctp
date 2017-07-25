<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Form Value'), ['action' => 'edit', $formValue->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Form Value'), ['action' => 'delete', $formValue->id], ['confirm' => __('Are you sure you want to delete # {0}?', $formValue->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Form Values'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Form Value'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Patients'), ['controller' => 'Patients', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Patient'), ['controller' => 'Patients', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Forms'), ['controller' => 'Forms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Form'), ['controller' => 'Forms', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="formValues view large-9 medium-8 columns content">
    <h3><?= h($formValue->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Patient') ?></th>
            <td><?= $formValue->has('patient') ? $this->Html->link($formValue->patient->name, ['controller' => 'Patients', 'action' => 'view', $formValue->patient->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Form') ?></th>
            <td><?= $formValue->has('form') ? $this->Html->link($formValue->form->name, ['controller' => 'Forms', 'action' => 'view', $formValue->form->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Field Name') ?></th>
            <td><?= h($formValue->field_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Field Value') ?></th>
            <td><?= h($formValue->field_value) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($formValue->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Form Element Id') ?></th>
            <td><?= $this->Number->format($formValue->form_element_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($formValue->created) ?></td>
        </tr>
    </table>
</div>
