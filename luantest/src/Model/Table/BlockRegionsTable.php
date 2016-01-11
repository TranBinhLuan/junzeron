<?php
namespace App\Model\Table;

use App\Model\Entity\BlockRegion;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BlockRegions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Blocks
 */
class BlockRegionsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('block_regions');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Blocks', [
            'foreignKey' => 'block_id',
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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');
            
        $validator
            ->requirePresence('theme', 'create')
            ->notEmpty('theme');
            
        $validator
            ->allowEmpty('region');
            
        $validator
            ->add('ordering', 'valid', ['rule' => 'numeric'])
            ->requirePresence('ordering', 'create')
            ->notEmpty('ordering');

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
        $rules->add($rules->existsIn(['block_id'], 'Blocks'));
        return $rules;
    }
}
