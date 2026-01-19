<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateCredentialTypesTable extends AbstractMigration
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
        $table_name = 'mkt_credential_types';
        if ($this->hasTable($table_name)) {
            return;
        }
        $table = $this->table($table_name);
        $table
            ->addColumn('name', 'string', ['limit' => 100, 'null' => false])
            ->addColumn('label', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('description', 'text', ['null' => true])
            ->addColumn('is_active', 'boolean', ['default' => true])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
            ])
            ->addIndex(['name'], ['unique' => true])
            ->addIndex(['is_active'])
            ->create();
    }
}
