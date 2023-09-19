<?php
namespace Cushon\Database\Migration;

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

final class AddAccountFundTransactionTable extends AbstractMigration {
    public function up(): void {
        $this->table('account_fund_transaction')
            ->addColumn(
                'account_fund_id',
                'integer',
                [
                    'null' => false,
                    'limit' => MysqlAdapter::INT_REGULAR,
                    'signed' => false
                ]
            )
            ->addColumn('amount_gbp', 'decimal', ['null' => false, 'precision' => 10, 'scale' => 2])
            ->addColumn('time', 'datetime', ['null' => false])
            ->addForeignKey(
                'account_fund_id',
                'account_fund',
                'id',
                [
                    'constraint' => 'fk_account_fund_transaction_account_fund_id',
                    'update' => 'RESTRICT',
                    'delete' => 'CASCADE'
                ]
            )
            ->create();
    }

    public function down(): void {
        $this->table('account_fund')->drop()->save();
    }
}
