<?php
declare(strict_types=1);

namespace App\View;

use Cake\View\View;

class AppView extends View
{
    /**
     * Initialization hook method.
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->loadHelper('Identity');
    }
}