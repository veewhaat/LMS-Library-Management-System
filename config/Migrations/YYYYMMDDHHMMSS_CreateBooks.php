<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateBooks extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('books');
        $table->addColumn('book_no', 'string', [
            'limit' => 50,
            'null' => false,
        ])
        ->addColumn('title', 'string', [
            'limit' => 255,
            'null' => false,
        ])
        ->addColumn('type', 'string', [
            'limit' => 100,
            'null' => false,
        ])
        ->addColumn('author', 'string', [
            'limit' => 255,
            'null' => false,
        ])
        ->addColumn('quantity', 'integer', [
            'null' => false,
            'default' => 0,
        ])
        ->addColumn('purchase_date', 'date', [
            'null' => false,
        ])
        ->addColumn('edition', 'string', [
            'limit' => 50,
            'null' => true,
        ])
        ->addColumn('price', 'decimal', [
            'precision' => 10,
            'scale' => 2,
            'null' => true,
        ])
        ->addColumn('pages', 'integer', [
            'null' => true,
        ])
        ->addColumn('publisher', 'string', [
            'limit' => 255,
            'null' => true,
        ])
        ->addColumn('created', 'datetime', [
            'default' => null,
            'null' => true,
        ])
        ->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ])
        ->create();
    }
}