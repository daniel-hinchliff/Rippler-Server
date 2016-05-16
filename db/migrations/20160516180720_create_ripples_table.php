<?php

use Phinx\Migration\AbstractMigration;

class CreateRipplesTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('ripples');
        $table->addColumn('user_id', 'integer')
              ->addColumn('image_path', 'string')
              ->addColumn('longitude', 'float')
              ->addColumn('latitude', 'float')
              ->addColumn('radius', 'integer')
              ->addColumn('creation_time', 'datetime')
              ->addColumn('end_time', 'datetime')
              ->addColumn('description', 'text')
              ->create();
    }
}
