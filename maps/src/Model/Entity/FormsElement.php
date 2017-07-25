<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FormsElement Entity
 *
 * @property int $id
 * @property int $form_id
 * @property int $element_id
 * @property string $caption
 * @property string $field_name
 * @property string $is_required
 *
 * @property \App\Model\Entity\Form $form
 * @property \App\Model\Entity\Element $element
 */
class FormsElement extends Entity
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
