<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ReturnedTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('returned');
        $this->setDisplayField('book_title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('book_number')
            ->maxLength('book_number', 50)
            ->requirePresence('book_number', 'create')
            ->notEmptyString('book_number');

        $validator
            ->scalar('book_title')
            ->maxLength('book_title', 255)
            ->requirePresence('book_title', 'create')
            ->notEmptyString('book_title');

        $validator
            ->date('issue_date')
            ->requirePresence('issue_date', 'create')
            ->notEmptyDate('issue_date');

        $validator
            ->date('due_date')
            ->requirePresence('due_date', 'create')
            ->notEmptyDate('due_date');

        $validator
            ->date('return_date')
            ->requirePresence('return_date', 'create')
            ->notEmptyDate('return_date');

        $validator
            ->scalar('member')
            ->maxLength('member', 255)
            ->requirePresence('member', 'create')
            ->notEmptyString('member');

        $validator
            ->scalar('number')
            ->maxLength('number', 50)
            ->requirePresence('number', 'create')
            ->notEmptyString('number');

        $validator
            ->decimal('fine')
            ->allowEmptyString('fine')
            ->greaterThanOrEqual('fine', 0);

        $validator
            ->scalar('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status')
            ->inList('status', ['Pending', 'Cleared']);

        return $validator;
    }
}