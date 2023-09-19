<?php
namespace Cushon\Database\Seeder;

use Phinx\Seed\AbstractSeed;

final class CustomerRetailAccountSeeder extends AbstractSeed {

    public function getDependencies(): array {
        return [
            CustomerRetailSeeder::class,
            AccountSeeder::class
        ];
    }

    public function run(): void {
        $this->insert('customer_retail_account', ['customer_retail_id' => 1, 'account_id' => 1]);
        $this->insert('customer_retail_account', ['customer_retail_id' => 2, 'account_id' => 2]);
    }
}
