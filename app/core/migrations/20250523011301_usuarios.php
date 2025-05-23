<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Usuarios extends AbstractMigration
{
    public function up(): void{
        $table = $this->table('usuarios');
        $table
            ->addColumn("nome", "string", ['limit' => 100])
            ->addColumn('email', 'string', ['limit' => 250])
            ->addColumn('senha', 'text')
            ->addColumn('nivel', 'string', ['limit' => 20])
            ->addColumn('ativo', 'string', ['limit' => 5])
            ->addColumn('telefone','string', ['limit' => 20])
            ->addColumn('rua', 'string', ['limit' => 50])
            ->addColumn('numero', 'integer', ['limit' => 50])
            ->addColumn('bairro', 'string', ['limit' => 50])
            ->addTimestamps()
            ->save()
        ;
    }

    public function down():void{
        $this->table("usuarios")->drop()->save();
    }
}
