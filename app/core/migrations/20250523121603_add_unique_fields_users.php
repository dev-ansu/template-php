<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddUniqueFieldsUsers extends AbstractMigration
{
    public function up(): void{
        $table = $this->table('usuarios');
        $table
            ->addIndex(['email'], [
                'unique' => true,
            ])
            ->save()
        ;
    }

    public function down():void{
        $this->table("usuarios")->removeIndex(['email'])->save();
    }
}
