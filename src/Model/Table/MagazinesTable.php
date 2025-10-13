<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class MagazinesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('magazines');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('type')
            ->maxLength('type', 100)
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->date('date_of_receipt')
            ->requirePresence('date_of_receipt', 'create')
            ->notEmptyDate('date_of_receipt');

        $validator
            ->date('date_published')
            ->requirePresence('date_published', 'create')
            ->notEmptyDate('date_published');

        $validator
            ->integer('pages')
            ->requirePresence('pages', 'create')
            ->notEmptyString('pages')
            ->greaterThan('pages', 0);

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmptyString('price')
            ->greaterThanOrEqual('price', 0);

        $validator
            ->scalar('publisher')
            ->maxLength('publisher', 255)
            ->requirePresence('publisher', 'create')
            ->notEmptyString('publisher');

        return $validator;
    }
}