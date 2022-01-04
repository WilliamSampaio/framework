<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Usuario extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        // create the table
        $table = $this->table('usuario');
        $table
            ->addColumn('nome', 'string', ['limit' => 100, 'null' => false])
            ->addColumn('email', 'string', ['limit' => 100, 'null' => false])
            ->addColumn('senha', 'string', ['limit' => 32, 'null' => false])
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addIndex(['email'], ['unique' => true])
            ->create();

        // insert in table
        $builder = $this->getQueryBuilder();
        $builder
            ->insert(['nome', 'email', 'senha'])
            ->into('usuario')
            ->values(['nome' => 'usuario_1', 'email' => 'usuario1@mail.com', 'senha' => md5('123456789')])
            ->values(['nome' => 'usuario_2', 'email' => 'usuario2@mail.com', 'senha' => md5('123456789')])
            ->execute();
    }
}
