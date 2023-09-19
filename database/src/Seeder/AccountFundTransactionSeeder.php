<?php
namespace Cushon\Database\Seeder;

use DateTimeInterface;
use Money\Money;
use Phinx\Seed\AbstractSeed;
use Psr\Clock\ClockInterface;

final class AccountFundTransactionSeeder extends AbstractSeed {

    public function __construct(private readonly ClockInterface $clock) {}

    public function getDependencies(): array {
        return [
            AccountFundSeeder::class
        ];
    }

    public function run(): void {
        $this->insert(
            'account_fund_transaction',
            [
                'account_fund_id' => 1,
                'amount_gbp'      => Money::GBP(10_000)->getAmount(),
                'time'            => $this->clock->now()->format(DateTimeInterface::ATOM)
            ]
        );
        $this->insert(
            'account_fund_transaction',
            [
                'account_fund_id' => 1,
                'amount_gbp'      => Money::GBP(15_000)->getAmount(),
                'time'            => $this->clock->now()->format(DateTimeInterface::ATOM)
            ]
        );

        $this->insert(
            'account_fund_transaction',
            [
                'account_fund_id' => 2,
                'amount_gbp'      => Money::GBP(4_000)->getAmount(),
                'time'            => $this->clock->now()->format(DateTimeInterface::ATOM)
            ]
        );
    }
}
