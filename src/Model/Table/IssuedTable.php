<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class IssuedTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('issued');
        $this->setDisplayField('book_title');
        $this->setPrimaryKey('issued_id');

        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('issued_id')
            ->allowEmptyString('issued_id', null, 'create');

        $validator
            ->scalar('member')
            ->maxLength('member', 255)
            ->requirePresence('member', 'create')
            ->notEmptyString('member', 'Member name is required');

        $validator
            ->scalar('number')
            ->maxLength('number', 50)
            ->requirePresence('number', 'create')
            ->notEmptyString('number', 'Member number is required');

        $validator
            ->scalar('book_number')
            ->maxLength('book_number', 50)
            ->requirePresence('book_number', 'create')
            ->notEmptyString('book_number', 'Book number is required');

        $validator
            ->scalar('book_title')
            ->maxLength('book_title', 255)
            ->requirePresence('book_title', 'create')
            ->notEmptyString('book_title', 'Book title is required');

        $validator
            ->date('issue_date')
            ->requirePresence('issue_date', 'create')
            ->notEmptyDate('issue_date', 'Issue date is required');

        $validator
            ->date('due_date')  // Changed from return_date
            ->allowEmptyDate('due_date')  // Changed from return_date
            ->add('due_date', 'valid', [  // Changed from return_date
                'rule' => function ($value, $context) {
                    if (empty($value)) {
                        return true;
                    }
                    $issueDate = $context['data']['issue_date'] ?? null;
                    if (!$issueDate) {
                        return true;
                    }
                    return new \DateTime($value) >= new \DateTime($issueDate);
                },
                'message' => 'Due date must be on or after the issue date'
            ]);

        $validator
            ->scalar('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status', 'Status is required')
            ->inList('status', ['Issued', 'Returned', 'Not Returned'], 'Please select a valid status');

        return $validator;
    }
}