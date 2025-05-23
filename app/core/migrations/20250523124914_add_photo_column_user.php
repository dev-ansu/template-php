<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddPhotoColumnUser extends AbstractMigration
{
   public function up(): void{
        $table = $this->table('usuarios');
        $table
            ->addColumn('foto', 'text')->save()
        ;
    }

    public function down():void{
        $this->table("usuarios")->removeColumn('foto')->save();
    }
}
