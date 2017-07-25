<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FormValues Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Patients
 * @property \Cake\ORM\Association\BelongsTo $Forms
 * @property \Cake\ORM\Association\BelongsTo $FormElements
 *
 * @method \App\Model\Entity\FormValue get($primaryKey, $options = [])
 * @method \App\Model\Entity\FormValue newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FormValue[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FormValue|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FormValue patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FormValue[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FormValue findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FormValuesTable extends Table
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

        $this->table('form_values');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Patients', [
            'foreignKey' => 'patient_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('Forms', [
            'foreignKey' => 'form_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('FormsElements', [
            'foreignKey' => 'form_element_id',
            'joinType' => 'LEFT'
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
            ->requirePresence('field_name', 'create')
            ->notEmpty('field_name');

        $validator
            ->requirePresence('field_value', 'create')
            ->notEmpty('field_value');

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
        $rules->add($rules->existsIn(['patient_id'], 'Patients'));
        $rules->add($rules->existsIn(['form_id'], 'Forms'));
        $rules->add($rules->existsIn(['form_element_id'], 'FormElements'));

        return $rules;
    }
    
    public function saveData($params) {
        foreach ($params as $param) {
            $entity = $this->newEntity($param);
            if ($this->save($entity)) {
                echo 'DONE';
            }
        }
        die('saved');
    }

    public function getData($id) {
        $formsElement = $this->find($id, [
            'conditions'
        ]);
    }
}
