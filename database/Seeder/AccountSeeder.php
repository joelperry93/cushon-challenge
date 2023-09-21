<?php
namespace Cushon\Database\Seeder;

use Phinx\Seed\AbstractSeed;

final class AccountSeeder extends AbstractSeed {

    public function run(): void {
        $this->insert('account', ['type' => 'ISA']); // ID: 1
        $this->insert('account', ['type' => 'ISA']); // ID: 2
    }
}
