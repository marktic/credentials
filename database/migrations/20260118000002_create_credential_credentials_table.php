<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateCredentialCredentialsTable extends AbstractMigration
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
        $table_name = 'mkt_credential_credentials';
        if ($this->hasTable($table_name)) {
            return;
        }
        $table = $this->table($table_name);
        $table
            ->addColumn('user_id', 'biginteger', ['null' => false])
            ->addColumn('credential_type_id', 'biginteger', ['null' => false])
            ->addColumn('valid_from', 'date', ['null' => false])
            ->addColumn('valid_to', 'date', ['null' => true])
            ->addColumn('issuer', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('issuer_reference', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('credential_number', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('url', 'string', ['limit' => 500, 'null' => true])
            ->addColumn('notes', 'text', ['null' => true])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
            ])
            ->addIndex(['user_id'])
            ->addIndex(['credential_type_id'])
            ->addIndex(['valid_from', 'valid_to'])
            ->addIndex(['user_id', 'credential_type_id'])
            ->addForeignKey('credential_type_id', 'mkt_credential_types', 'id')
            ->create();
    }
}
