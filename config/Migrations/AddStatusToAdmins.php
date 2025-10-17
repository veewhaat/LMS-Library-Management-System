<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddStatusToAdmins extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('admins');
        $table->addColumn('status', 'string', [
            'default' => 'Online',
            'limit' => 20,
            'null' => false,
        ]);
        $table->update();
    }
}