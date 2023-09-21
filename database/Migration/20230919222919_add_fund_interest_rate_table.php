<?php

declare(strict_types=1);

namespace Cushon\Database\Migration;

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

final class AddFundInterestRateTable extends AbstractMigration {
    public function up(): void {
        $this->table('fund_interest_rate')
            ->addColumn(
                'fund_id',
                'integer',
                [
                    'null' => false,
                    'limit' => MysqlAdapter::INT_REGULAR,
                    'signed' => false
                ]
            )
            ->addColumn(
                'date',
                'date',
                [
                    'null' => false
                ]
            )
            ->addColumn(
                'rate',
                'decimal',
                ['null' => false, 'precision' => 10, 'scale' => 2]
            )
            ->addForeignKey(
                'fund_id',
                'fund',
                'id',
                [
                    'constraint' => 'fk_fund_interest_rate_fund_id',
                    'update' => 'RESTRICT',
                    'delete' => 'CASCADE'
                ]
            )
            ->create();
    }

    public function down(): void {
        $this->table('fund_interest_rate')->drop()->save();
    }
}
