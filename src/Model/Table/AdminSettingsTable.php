<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AdminSettings Model
 *
 * @method \App\Model\Entity\AdminSetting get($primaryKey, $options = [])
 * @method \App\Model\Entity\AdminSetting newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AdminSetting[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AdminSetting|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AdminSetting saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AdminSetting patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AdminSetting[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AdminSetting findOrCreate($search, callable $callback = null, $options = [])
 */
class AdminSettingsTable extends Table
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

        $this->setTable('admin_settings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->scalar('settings_name')
            ->maxLength('settings_name', 45)
            ->allowEmptyString('settings_name');

        $validator
            ->integer('value')
            ->allowEmptyString('value');

        $validator
            ->scalar('label')
            ->maxLength('label', 45)
            ->allowEmptyString('label');

        return $validator;
    }
}
