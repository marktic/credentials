<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateCredentialRequirementsTable extends AbstractMigration
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
        $table_name = 'mkt_credential_requirements';
        if ($this->hasTable($table_name)) {
            return;
        }
        $this->table($table_name, ['primary_key' => 'id', 'id' => false])
            ->addColumn('id', 'biginteger', ['identity' => true, 'signed' => false])
            ->addColumn('credential_type_id', 'integer', ['null' => false, 'signed' => false])
            ->addColumn('tenant_type', 'string', ['limit' => 50, 'null' => false])
            ->addColumn('tenant_id', 'biginteger', ['null' => false])
            ->addColumn('parent_type', 'string', ['limit' => 50, 'null' => false])
            ->addColumn('parent_id', 'biginteger', ['null' => false])
            ->addColumn('name', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('lead', 'text', ['null' => true])
            ->addColumn('is_mandatory', 'boolean', ['default' => true])
            ->addColumn('requires_approval', 'boolean', ['default' => true])
            ->addColumn('is_active', 'boolean', ['default' => true])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
            ])
            ->addIndex(['tenant_type', 'tenant_id'])
            ->addIndex(['parent_type', 'parent_id'])
            ->addIndex(['credential_type_id'])
            ->addIndex(['tenant_type', 'tenant_id', 'parent_type', 'parent_id'])
            ->addForeignKey('credential_type_id', 'mkt_credential_types', 'id')
            ->create();
    }
}
