<?php

use Phinx\Migration\AbstractMigration;

class CreateSwipesTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('swipes');
        $table->addColumn('user_id', 'integer')
              ->addColumn('ripple_id', 'integer')
              ->addColumn('like', 'boolean')
              ->addColumn('created_at', 'datetime')
              ->addColumn('updated_at', 'datetime')
              ->create();
    }
}
