<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Patients Model
 *
 * @property \App\Model\Table\AppointsTable&\Cake\ORM\Association\HasMany $Appoints
 *
 * @method \App\Model\Entity\Patient newEmptyEntity()
 * @method \App\Model\Entity\Patient newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Patient[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Patient get($primaryKey, $options = [])
 * @method \App\Model\Entity\Patient findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Patient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Patient[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Patient|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Patient saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Patient[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Patient[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Patient[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Patient[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PatientsTable extends Table
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

        $this->setTable('patients');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Appoints', [
            'foreignKey' => 'patient_id',
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('age')
            ->requirePresence('age', 'create')
            ->notEmptyString('age');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('password')
            ->minLength('password',5,__('Enter the valid Password'))
            ->maxLength('password', 20,__('Choose the password length between 5 to 20 characters'))
            ->requirePresence('password', 'create')
            ->notEmptyString('password',__('Password Field not be empty'));

        $validator
            ->requirePresence('phone', 'create')
            ->notEmptyString('phone');

        $validator
            ->scalar('address')
            ->requirePresence('address', 'create')
            ->notEmptyString('address');

        $validator
            ->dateTime('created_date')
            ->notEmptyDateTime('created_date');

             $validator->add('email', 'custom', [
                 'rule' => function ($value, $context) {

                if (!$value) {
                    return false;
                }
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    return "Invalid email format";
                }

                return true;
                },
                ]);

             $validator->add('name', 'custom', [
                 'rule' => function ($value, $context) {
                if (!$value) {
                    return "value Cannnot be Left empty";
                }
                if (is_numeric($value)) {
                    return 'Numeric value not accepted';
                }

                return true;
                },
                ]);

             $validator->add('phone', 'custom', [
                 'rule' => function ($value, $context) {

                if (!$value) {
                    return "value Cannnot be Left empty";
                }
                 if ($value <= 10) {
                    return 'Your Contact Has More Than 10 Values ';
                }
                if(strtolower($value) == 0000000000 || strtolower($value) == 1234567890){
                    return "Pls Enter Valid Value";
                }

                return true;
                },
                ]);

             $validator->add('age', 'custom', [
                 'rule' => function ($value, $context) {

                if (!$value) {
                    return "value Cannnot be Left empty";
                }
                 if ($value <= 3) {
                    return 'Your Contact Has More Than 10 Values ';
                }
                if(strtolower($value) == 0000000000 || strtolower($value) == 1234567890){
                    return "Pls Enter Valid Value";
                }

                return true;
                },
                ]);



             $validator->add('address', 'custom', [
                 'rule' => function ($value, $context) {
                if (!$value) {
                    return "value Cannnot be Left empty";
                }
                return true;
                },
                ]);

        return $validator;
    }
}
