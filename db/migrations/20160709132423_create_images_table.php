<?php

use Phinx\Migration\AbstractMigration;

class CreateImagesTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('images');
        $table->addColumn('public_id', 'integer')
              ->addColumn('created_at', 'datetime')
              ->addColumn('updated_at', 'datetime')
              ->create();
    }
}
