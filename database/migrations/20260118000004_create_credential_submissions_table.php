<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateCredentialSubmissionsTable extends AbstractMigration
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
        $table_name = 'mkt_credential_submissions';
        if ($this->hasTable($table_name)) {
            return;
        }
        $this->table($table_name, ['primary_key' => 'id', 'id' => false])
            ->addColumn('id', 'biginteger', ['identity' => true, 'signed' => false])
            ->addColumn('credential_credential_id', 'biginteger', ['null' => false, 'signed' => false])
            ->addColumn('credential_requirement_id', 'biginteger', ['null' => false, 'signed' => false])
            ->addColumn('parent_type', 'string', ['limit' => 50, 'null' => false])
            ->addColumn('parent_id', 'biginteger', ['null' => false])
            ->addColumn('submission_date', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('submitted_by', 'biginteger', ['null' => false])
            ->addColumn('approval_date', 'timestamp', ['null' => true])
            ->addColumn('approved_by', 'biginteger', ['null' => true])
            ->addColumn('rejection_date', 'timestamp', ['null' => true])
            ->addColumn('rejected_by', 'biginteger', ['null' => true])
            ->addColumn('status', 'string', ['limit' => 20, 'default' => 'pending'])
            ->addColumn('submission_notes', 'text', ['null' => true])
            ->addColumn('reviewer_notes', 'text', ['null' => true])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
            ])
            ->addIndex(['credential_credential_id'])
            ->addIndex(['credential_requirement_id'])
            ->addIndex(['status'])
            ->addIndex(['submission_date'])
            ->addIndex(['submitted_by'])
            ->addIndex(['credential_credential_id', 'credential_requirement_id'], ['unique' => true, 'name' => 'unique_submission'])
            ->addForeignKey('credential_credential_id', 'mkt_credential_credentials', 'id')
            ->addForeignKey('credential_requirement_id', 'mkt_credential_requirements', 'id')
            ->create();
    }
}
