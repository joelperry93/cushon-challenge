<?php
namespace Cushon\Database\Seeder;

use Cushon\Fund;
use Phinx\Seed\AbstractSeed;

final class FundSeeder extends AbstractSeed {

    public function run(): void {
        foreach (Fund::cases() as $fund) {
            $this->insert('fund', ['name' => $fund->value]);
        }
    }
}
