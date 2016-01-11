<?php
namespace App\Model\Table;

use App\Model\Entity\ExchangeType;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ExchangeTypes Model
 *
 * @property \Cake\ORM\Association\HasMany $Exchanges
 */
class ExchangeTypesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('exchange_types');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->hasMany('Exchanges', [
            'foreignKey' => 'exchange_type_id'
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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');
            
        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');
            
        $validator
            ->allowEmpty('descriptions');
            
        $validator
            ->requirePresence('slug', 'create')
            ->notEmpty('slug');
            
        $validator
            ->allowEmpty('settings');

        return $validator;
    }
}
