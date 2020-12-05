<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $ParentUsers
 * @property \App\Model\Table\ActivationCodesTable&\Cake\ORM\Association\HasMany $ActivationCodes
 * @property \App\Model\Table\PackageRequestsTable&\Cake\ORM\Association\HasMany $PackageRequests
 * @property &\Cake\ORM\Association\HasMany $PayoutRequests
 * @property \App\Model\Table\PostCommentsTable&\Cake\ORM\Association\HasMany $PostComments
 * @property \App\Model\Table\PostsTable&\Cake\ORM\Association\HasMany $Posts
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\HasMany $ChildUsers
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree', [
            'level' => 'level'
        ]);

        $this->belongsTo('ParentUsers', [
            'className' => 'Users',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('ActivationCodes', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('PackageRequests', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('PayoutRequests', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('PostComments', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Posts', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('ChildUsers', [
            'className' => 'Users',
            'foreignKey' => 'parent_id',
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
            ->scalar('first_name')
            ->maxLength('first_name', 140)
            ->allowEmptyString('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 140)
            ->allowEmptyString('last_name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table', 'Email already registered']);

        $validator
            ->scalar('password')
            ->maxLength('password', 100)
            ->requirePresence('password', 'create')
            ->notEmptyString('password')
            ->sameAs('password', 'password2', 'Passwords do not match');;

        $validator
            ->decimal('coins_balance')
            ->allowEmptyString('coins_balance');

        $validator
            ->scalar('contact_no')
            ->maxLength('contact_no', 45)
            ->allowEmptyString('contact_no');

        $validator
            ->allowEmptyString('is_admin');

        $validator
            ->scalar('activation_token')
            ->maxLength('activation_token', 500)
            ->allowEmptyString('activation_token');

        $validator
            ->scalar('reset_token')
            ->maxLength('reset_token', 500)
            ->allowEmptyString('reset_token');

        $validator
            ->allowEmptyString('is_active');

        $validator
            ->scalar('invite_code')
            ->maxLength('invite_code', 45)
            ->allowEmptyString('invite_code');

        $validator
            ->scalar('avatar_image')
            ->maxLength('avatar_image', 500)
            ->allowEmptyFile('avatar_image');

        $validator
            ->integer('level')
            ->allowEmptyString('level');

        $validator
            ->scalar('userscol')
            ->maxLength('userscol', 45)
            ->allowEmptyString('userscol');

        $validator
            ->integer('invited_by')
            ->allowEmptyString('invited_by');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['parent_id'], 'ParentUsers'));

        return $rules;
    }

    public function afterSave ($event, $entity) {
        if ($entity->isNew()) {
            $invite_code = str_pad($entity->id, 5,'0', STR_PAD_LEFT);
            $entity->invite_code = $invite_code . '-' . $this->stringGenerator(8);
            $this->save($entity);
        }
    }

    private function stringGenerator ($length) {
        $characters = 'abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $randomString = '';
        for ($i=0; $i < $length; $i++) { 
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    public function getUserId ($invite_code) {
        $query = $this->findByInviteCode($invite_code);
        $user = null;
        if ($query->first()) {
            $rs = $query->first();
            $user = $rs->id;
        }
        return $user;
    }

    public function adjustCoins ($parent_id) {
        $data = [];
        $first_level = $this->get($parent_id);
        $first_level->coins_balance += 50;
        $data[] = $first_level;
        if ($first_level->parent_id) {
            $second_level = $this->get($first_level->parent_id);
            $second_level->coins_balance += 30;
            $data[] = $second_level;
            if ($second_level->parent_id) {
                $third_level = $this->get($second_level->parent_id);
                $third_level->coins_balance += 10;
                $data[] = $third_level;
            }
        }
        $this->saveMany($data);
    }

    public function adjustCoinsByPairing ($parent_id) {
        $data = [];
        if ($parent_id) {
            $first_p = $this->get($parent_id);
            if ($this->childCount($first_p) % 2 === 0) {
                $first_p->coins_balance += 200;
                $data[] = $first_p;
                if ($first_p->parent_id) {
                    $second_p = $this->get($first_p->parent_id);
                    $second_p->coins_balance += 200;
                    $data[] = $second_p;
                    if ($second_p->parent_id) {
                        $third_p = $this->get($second_p->parent_id);
                        $third_p->coins_balance += 200;
                        $data[] = $third_p;
                        if ($third_p->parent_id) {
                            $fourth_p = $this->get($third_p->parent_id);
                            $fourth_p->coins_balance += 200;
                            $data[] = $fourth_p;
                        }
                    }
                }
            }
        }
        $this->saveMany($data);
    }
}
