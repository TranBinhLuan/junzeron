<?php
namespace Exchange\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Exchange\Model\Entity\Exchange;

/**
 * Exchanges Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ExchangeTypes
 */
class ExchangesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('exchanges');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('ExchangeTypes', [
            'foreignKey' => 'exchange_type_id',
            'joinType' => 'INNER',
            'className' => 'Exchange.ExchangeTypes'
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
            ->requirePresence('currency', 'create')
            ->notEmpty('currency');
            
        $validator
            ->add('cur_buy', 'valid', ['rule' => 'numeric'])
            ->requirePresence('cur_buy', 'create')
            ->notEmpty('cur_buy');
            
        $validator
            ->add('cur_sell', 'valid', ['rule' => 'numeric'])
            ->requirePresence('cur_sell', 'create')
            ->notEmpty('cur_sell');
            
        $validator
            ->requirePresence('slug', 'create')
            ->notEmpty('slug');
            
        $validator
            ->add('deleted_at', 'valid', ['rule' => 'datetime'])
            ->requirePresence('deleted_at', 'create')
            ->notEmpty('deleted_at');

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
        $rules->add($rules->existsIn(['exchange_type_id'], 'ExchangeTypes'));
        return $rules;
    }
}
