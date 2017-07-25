<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FormsElements Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Forms
 * @property \Cake\ORM\Association\BelongsTo $Elements
 *
 * @method \App\Model\Entity\FormsElement get($primaryKey, $options = [])
 * @method \App\Model\Entity\FormsElement newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FormsElement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FormsElement|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FormsElement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FormsElement[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FormsElement findOrCreate($search, callable $callback = null)
 */
class FormsElementsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->table('forms_elements');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Forms', [
            'foreignKey' => 'form_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Elements', [
            'foreignKey' => 'element_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('caption', 'create')
            ->notEmpty('caption');

        $validator
            ->requirePresence('field_name', 'create')
            ->notEmpty('field_name');

        $validator
            ->requirePresence('is_required', 'create')
            ->notEmpty('is_required');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['form_id'], 'Forms'));
        $rules->add($rules->existsIn(['element_id'], 'Elements'));

        return $rules;
    }
}
