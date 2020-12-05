<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PackageRequests Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\PackagesTable&\Cake\ORM\Association\BelongsTo $Packages
 * @property \App\Model\Table\StatusesTable&\Cake\ORM\Association\BelongsTo $Statuses
 *
 * @method \App\Model\Entity\PackageRequest get($primaryKey, $options = [])
 * @method \App\Model\Entity\PackageRequest newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PackageRequest[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PackageRequest|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PackageRequest saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PackageRequest patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PackageRequest[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PackageRequest findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PackageRequestsTable extends Table
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

        $this->setTable('package_requests');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
        $this->belongsTo('Packages', [
            'foreignKey' => 'package_id',
        ]);
        $this->belongsTo('Statuses', [
            'foreignKey' => 'status_id',
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

        // $validator
        //     ->scalar('payment_reference')
        //     ->maxLength('payment_reference', 400)
        //     ->requirePresence('payment_reference', 'create')
        //     ->notEmptyString('payment_reference');

        // $validator
        //     ->scalar('payment_image')
        //     ->maxLength('payment_image', 400)
        //     ->requirePresence('payment_image', 'create')
        //     ->notEmptyFile('payment_image');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['package_id'], 'Packages'));
        $rules->add($rules->existsIn(['status_id'], 'Statuses'));

        return $rules;
    }
}
