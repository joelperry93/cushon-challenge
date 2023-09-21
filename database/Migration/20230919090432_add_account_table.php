<?php

declare(strict_types=1);

namespace Cushon\Database\Migration;

use Phinx\Migration\AbstractMigration;

final class AddAccountTable extends AbstractMigration {

    public function up(): void {
        $this->table('account')
            ->addColumn('type', 'enum', ['values' => ['ISA', 'Pension'], 'null' => false])
            ->create();
    }

    public function down(): void {
        $this->table('account')->drop()->save();
    }
}
