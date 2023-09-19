<?php
namespace unit;

use Cushon\AccountFundTransaction;
use Cushon\Dao\RowMapper\AccountFundTransactionRowMapper;
use Cushon\Fund;
use Money\Money;
use PHPUnit\Framework\TestCase;

final class TransactionRowMapperTest extends TestCase {

    public function testMapping(): void {
        $mapper = new AccountFundTransactionRowMapper();

        $this->assertEquals(
            expected: [
                new AccountFundTransaction(
                    fund: Fund::CUSHON_EQUITIES,
                    amount: Money::GBP(100),
                    time: new \DateTime('2023-09-10T04:53:00')
                ),
                new AccountFundTransaction(
                    fund: Fund::CUSHON_EQUITIES,
                    amount: Money::GBP(200),
                    time: new \DateTime('2023-09-10T04:54:00')
                )
            ],
            actual: $mapper->map([
                ['fund' => 'CUSHON_EQUITIES', 'amount_gbp' => '100', 'time' => '2023-09-10T04:53:00+00:00'],
                ['fund' => 'CUSHON_EQUITIES', 'amount_gbp' => '200', 'time' => '2023-09-10T04:54:00+00:00'],
            ])
        );
    }
}
