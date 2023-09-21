<?php
namespace Cushon\Database\Seeder;

use Phinx\Seed\AbstractSeed;

final class AccountFundSeeder extends AbstractSeed {

    public function getDependencies(): array {
        return [
            AccountSeeder::class,
            FundSeeder::class
        ];
    }

    public function run(): void {
        $this->insert('account_fund', ['account_id' => 1, 'fund_id' => 1]);
        $this->insert('account_fund', ['account_id' => 2, 'fund_id' => 1]);
    }
}
