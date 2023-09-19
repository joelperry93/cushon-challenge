<?php
namespace Cushon\Database\Migration;

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

final class AddAccountFundTable extends AbstractMigration {
    public function up(): void {
        $this->table('account_fund')
                ->addColumn(
                    'account_id',
                    'integer',
                    [
                        'null' => false,
                        'limit' => MysqlAdapter::INT_REGULAR,
                        'signed' => false
                    ]
                )
                ->addColumn(
                    'fund_id',
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
                        'constraint' => 'fk_account_fund_account_id',
                        'update' => 'RESTRICT',
                        'delete' => 'CASCADE'
                    ]
                )
                ->addForeignKey(
                    'fund_id',
                    'fund',
                    'id',
                    [
                        'constraint' => 'fk_account_fund_fund_id',
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
