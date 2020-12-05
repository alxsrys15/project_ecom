<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Packages Model
 *
 * @method \App\Model\Entity\Package get($primaryKey, $options = [])
 * @method \App\Model\Entity\Package newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Package[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Package|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Package saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Package patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Package[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Package findOrCreate($search, callable $callback = null, $options = [])
 */
class PackagesTable extends Table
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

        $this->setTable('packages');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('PackageRequests', [
            'foreignKey' => 'package_id',
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
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 45)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('qty')
            ->requirePresence('qty', 'create')
            ->notEmptyString('qty');

        $validator
            ->allowEmptyString('is_active');

        $validator
            ->decimal('price')
            ->allowEmptyString('price');

        $validator
            ->scalar('description')
            ->maxLength('description', 500)
            ->allowEmptyString('description');

        return $validator;
    }
}
