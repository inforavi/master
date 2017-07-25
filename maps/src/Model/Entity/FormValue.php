<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FormValue Entity
 *
 * @property int $id
 * @property int $patient_id
 * @property int $form_id
 * @property int $form_element_id
 * @property string $field_name
 * @property string $field_value
 * @property \Cake\I18n\Time $created
 *
 * @property \App\Model\Entity\Patient $patient
 * @property \App\Model\Entity\Form $form
 * @property \App\Model\Entity\FormElement $form_element
 */
class FormValue extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
