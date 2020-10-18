<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EBooks Model
 *
 * @method \App\Model\Entity\EBook get($primaryKey, $options = [])
 * @method \App\Model\Entity\EBook newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EBook[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EBook|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EBook saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EBook patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EBook[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EBook findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EBooksTable extends Table
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

        $this->setTable('e_books');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('title')
            ->maxLength('title', 100)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('author')
            ->maxLength('author', 100)
            ->requirePresence('author', 'create')
            ->notEmptyString('author');

        $validator
            ->scalar('year_published')
            ->maxLength('year_published', 4)
            ->allowEmptyString('year_published');

        $validator
            ->scalar('description')
            ->maxLength('description', 500)
            ->allowEmptyString('description');

        $validator
            ->scalar('cover_images')
            ->maxLength('cover_images', 500)
            ->requirePresence('cover_images', 'create')
            ->notEmptyFile('cover_images');

        $validator
            ->scalar('pdf_file')
            ->maxLength('pdf_file', 500)
            ->requirePresence('pdf_file', 'create')
            ->notEmptyFile('pdf_file');

        $validator
            ->decimal('cash_price')
            ->requirePresence('cash_price', 'create')
            ->notEmptyString('cash_price');

        $validator
            ->decimal('coins_price')
            ->requirePresence('coins_price', 'create')
            ->notEmptyString('coins_price');

        return $validator;
    }
}
