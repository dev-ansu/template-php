<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class AddUser extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $data = [
            [
                'nome' => 'Anderson',
                'email' => 'anderson@gmail.com',
                'senha' => password_hash('123', PASSWORD_DEFAULT),
                'nivel' => 'Administrador',
                'ativo' => 'Sim',
                'telefone' => '558599999999',
                'rua' => 'ali',
                'numero' => 3333,
                'bairro' => 'acolá'
            ]
        ];
        $users = $this->table("usuarios");
        $users->insert($data)->save();
    }
}
