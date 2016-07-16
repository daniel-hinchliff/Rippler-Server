<?php

use Rippler\Models\Users;
use Phinx\Migration\AbstractMigration;

class SplitFirstAndLastName extends AbstractMigration
{
    public function change()
    {
        $this->execute('TRUNCATE TABLE users RESTART IDENTITY;');

        $table = $this->table('users');
        $table->addColumn('first_name', 'string')
              ->addColumn('last_name', 'string')
              ->removeColumn('name')
              ->update();
    }
}
