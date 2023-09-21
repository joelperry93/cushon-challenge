<?php
namespace Cushon\Database\Migration;

use Phinx\Migration\AbstractMigration;

final class AddFundTable extends AbstractMigration {
    public function up(): void {
        $this->table('fund')
            ->addColumn('name', 'string', ['null' => false, 'limit' => 30])
            ->create();
    }

    public function down(): void {
        $this->table('fund')->drop()->save();
    }
}
