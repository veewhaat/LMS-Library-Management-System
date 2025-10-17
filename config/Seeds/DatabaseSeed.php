<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

class DatabaseSeed extends AbstractSeed
{
    public function run(): void
    {
        $this->call('AdminsSeed');
        $this->call('BooksSeed');
        $this->call('MagazinesSeed');
        $this->call('NewspapersSeed');
        $this->call('IssuedSeed');
        $this->call('ReturnedSeed');
    }
}