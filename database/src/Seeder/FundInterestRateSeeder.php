<?php
namespace Cushon\Database\Seeder;

use Phinx\Seed\AbstractSeed;

final class FundInterestRateSeeder extends AbstractSeed {

    public function run(): void {
        $this->insert(
            'fund_interest_rate',
            [
                'fund_id' => 1,
                'date'    => '2023-06-01',
                'rate'    => 1.01
            ]
        );
        $this->insert(
            'fund_interest_rate',
            [
                'fund_id' => 1,
                'date'    => '2023-06-02',
                'rate'    => 1.02
            ]
        );
    }
}
