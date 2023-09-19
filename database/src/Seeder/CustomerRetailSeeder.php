<?php
namespace Cushon\Database\Seeder;

use Phinx\Seed\AbstractSeed;
use Psr\Clock\ClockInterface;

final class CustomerRetailSeeder extends AbstractSeed {

    public function __construct(private readonly ClockInterface $clock) {}

    public function run(): void {
        $this->insert(
            'customer_retail',
            [
                'name'         => 'John T',
                'email'        => 'johnt@example.com',
                'created_time' => $this->clock->now()->format(\DateTimeInterface::ATOM)
            ]
        );

        $this->insert(
            'customer_retail',
            [
                'name'         => 'Jill P',
                'email'        => 'jillp@example.com',
                'created_time' => $this->clock->now()->format(\DateTimeInterface::ATOM)
            ]
        );
    }
}
