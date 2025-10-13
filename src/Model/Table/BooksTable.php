<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Date;

class BooksTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('books');
        $this->setDisplayField('title');
        $this->setPrimaryKey('isbn');

        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('isbn')
            ->maxLength('isbn', 13)
            ->minLength('isbn', 13, 'ISBN must be exactly 13 digits')
            ->requirePresence('isbn', 'create')
            ->notEmptyString('isbn', 'ISBN is required')
            ->add('isbn', 'unique', [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => 'This ISBN already exists'
            ])
            ->add('isbn', 'numeric', [
                'rule' => ['custom', '/^[0-9]{13}$/'],
                'message' => 'ISBN must contain exactly 13 digits'
            ]);

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title', 'Book Title is required');

        $validator
            ->scalar('book_type')
            ->maxLength('book_type', 100)
            ->requirePresence('book_type', 'create')
            ->notEmptyString('book_type', 'Book Type is required');

        $validator
            ->scalar('author_name')
            ->maxLength('author_name', 255)
            ->requirePresence('author_name', 'create')
            ->notEmptyString('author_name', 'Author Name is required');

        $validator
            ->integer('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmptyString('quantity', 'Quantity is required')
            ->greaterThanOrEqual('quantity', 0, 'Quantity must be 0 or greater');

        $validator
            ->date('purchase_date')
            ->requirePresence('purchase_date', 'create')
            ->notEmptyDate('purchase_date', 'Purchase Date is required');

        $validator
            ->scalar('edition')
            ->maxLength('edition', 50)
            ->allowEmptyString('edition');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmptyString('price', 'Price is required')
            ->greaterThan('price', 0, 'Price must be greater than 0');

        $validator
            ->integer('pages')
            ->requirePresence('pages', 'create')
            ->notEmptyString('pages', 'Number of pages is required')
            ->greaterThan('pages', 0, 'Number of pages must be greater than 0');

        $validator
            ->scalar('publisher')
            ->maxLength('publisher', 255)
            ->requirePresence('publisher', 'create')
            ->notEmptyString('publisher', 'Publisher is required');

        return $validator;
    }
}