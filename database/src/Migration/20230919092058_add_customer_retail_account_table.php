<?php
namespace Cushon\Database\Migration;

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

final class AddCustomerRetailAccountTable extends AbstractMigration {
    public function up(): void {
        $this->table('customer_retail_account')
            ->addColumn(
                'customer_retail_id',
                'integer',
                [
                    'null' => false,
                    'limit' => MysqlAdapter::INT_REGULAR,
                    'signed' => false
                ]
            )
            ->addColumn(
                'account_id',
                'integer',
                [
                    'null' => false,
                    'limit' => MysqlAdapter::INT_REGULAR,
                    'signed' => false
                ]
            )
            ->addForeignKey(
                'account_id',
                'account',
                'id',
                [
                    'constraint' => 'fk_customer_retail_account_account_id',
                    'update' => 'RESTRICT',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'customer_retail_id',
                'customer_retail',
                'id',
                [
                    'constraint' => 'fk_customer_retail_account_customer_retail_id',
                    'update' => 'RESTRICT',
                    'delete' => 'CASCADE'
                ]
            )
            ->create();
    }

    public function down(): void {
        $this->table('customer_retail_account')->drop()->save();
    }
}
