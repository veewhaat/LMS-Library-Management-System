<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Activity extends Entity
{
    protected $_accessible = [
        'action' => true,
        'description' => true,
        'user' => true,
        'created' => true,
    ];
}