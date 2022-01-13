<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Appoints Model
 *
 * @property \App\Model\Table\PatientsTable&\Cake\ORM\Association\BelongsTo $Patients
 * @property \App\Model\Table\DoctorsTable&\Cake\ORM\Association\BelongsTo $Doctors
 *
 * @method \App\Model\Entity\Appoint newEmptyEntity()
 * @method \App\Model\Entity\Appoint newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Appoint[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Appoint get($primaryKey, $options = [])
 * @method \App\Model\Entity\Appoint findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Appoint patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Appoint[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Appoint|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Appoint saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Appoint[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Appoint[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Appoint[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Appoint[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class AppointsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('appoints');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Patients', [
            'foreignKey' => 'patient_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Doctors', [
            'foreignKey' => 'doctor_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Departments',[
            'setTable' => 'Doctors',
            'foreignKey' => 'department_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->dateTime('appoint_date')
            ->requirePresence('appoint_date', 'create')
            ->notEmptyDateTime('appoint_date');

        

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('patient_id', 'Patients'), ['errorField' => 'patient_id']);
        $rules->add($rules->existsIn('doctor_id', 'Doctors'), ['errorField' => 'doctor_id']);

        return $rules;
    }
}
