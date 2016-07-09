<?php

use Phinx\Migration\AbstractMigration;

class MakeImagesPublicIdString extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('images');
        $table->removeColumn('public_id')
              ->addColumn('public_id', 'string', array('limit' => 50))
              ->update();
    }
}
