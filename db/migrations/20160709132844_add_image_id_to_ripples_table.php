<?php

use Phinx\Migration\AbstractMigration;

class AddImageIdToRipplesTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('ripples');
        $table->addColumn('image_id', 'integer', array('null' => true))
              ->removeColumn('image_path')
              ->update();
    }
}
