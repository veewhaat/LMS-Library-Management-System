<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Book extends Entity
{
    protected array $_accessible = [
        'isbn' => true,
        'title' => true,
        'book_type' => true,
        'author_name' => true,
        'quantity' => true,
        'purchase_date' => true,
        'edition' => true,
        'price' => true,
        'pages' => true,
        'publisher' => true,
        'created' => false,
        'modified' => false,
        'created_by' => false,
        'modified_by' => false,
    ];
}