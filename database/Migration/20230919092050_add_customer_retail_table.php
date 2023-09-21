<?php
namespace Cushon\Database\Migration;

use Phinx\Migration\AbstractMigration;

final class AddCustomerRetailTable extends AbstractMigration {

    public function up(): void {
        $this->table('customer_retail')
            ->addColumn('name', 'string', ['null' => false])
            ->addColumn('email', 'string', ['null' => false])
            ->addColumn('created_time', 'datetime', ['null' => false])
            ->create();
    }

    public function down(): void {
        $this->table('customer_retail')->drop()->save();
    }
}
