<?php
namespace App\Model\Table;

use App\Model\Entity\Block;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Blocks Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Copies
 * @property \Cake\ORM\Association\HasMany $BlockRegions
 * @property \Cake\ORM\Association\BelongsToMany $Roles
 */
class BlocksTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('blocks');
        $this->displayField('title');
        $this->primaryKey('id');
        $this->belongsTo('Copies', [
            'foreignKey' => 'copy_id'
        ]);
        $this->hasMany('BlockRegions', [
            'foreignKey' => 'block_id'
        ]);
        $this->belongsToMany('Roles', [
            'foreignKey' => 'block_id',
            'targetForeignKey' => 'role_id',
            'joinTable' => 'blocks_roles'
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
            ->requirePresence('handler', 'create')
            ->notEmpty('handler');
            
        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');
            
        $validator
            ->allowEmpty('description');
            
        $validator
            ->allowEmpty('body');
            
        $validator
            ->requirePresence('visibility', 'create')
            ->notEmpty('visibility');
            
        $validator
            ->allowEmpty('pages');
            
        $validator
            ->allowEmpty('locale');
            
        $validator
            ->allowEmpty('settings');
            
        $validator
            ->add('status', 'valid', ['rule' => 'boolean'])
            ->requirePresence('status', 'create')
            ->notEmpty('status');

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
        $rules->add($rules->existsIn(['copy_id'], 'Copies'));
        return $rules;
    }
}
