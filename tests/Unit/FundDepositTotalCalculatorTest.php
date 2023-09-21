<?php
namespace Unit;

use Cushon\AccountFundTransaction;
use Cushon\Fund;
use Cushon\FundDepositTotalCalculator;
use Money\Money;
use PHPUnit\Framework\TestCase;

final class FundDepositTotalCalculatorTest extends TestCase {

    public function testNonZeroSummary(): void {
        $builder = new FundDepositTotalCalculator();

        $this->assertEquals(
            expected: [
                Fund::CUSHON_EQUITIES->value => Money::GBP(40)
            ],
            actual: $builder->calculateFundDepositTotals([
                new AccountFundTransaction(
                    Fund::CUSHON_EQUITIES,
                    Money::GBP(10),
                    new \DateTime('2023-06-01T01:00:00')
                ),
                new AccountFundTransaction(
                    Fund::CUSHON_EQUITIES,
                    Money::GBP(-10),
                    new \DateTime('2023-06-01T01:00:00')
                ),
                new AccountFundTransaction(
                    Fund::CUSHON_EQUITIES,
                    Money::GBP(20),
                    new \DateTime('2023-06-01T01:00:00')
                ),
                new AccountFundTransaction(
                    Fund::CUSHON_EQUITIES,
                    Money::GBP(20),
                    new \DateTime('2023-06-01T01:00:00')
                ),
            ])
        );
    }

    public function testZeroSummary(): void {
        $builder = new FundDepositTotalCalculator();
        $this->assertEquals(expected: [], actual: $builder->calculateFundDepositTotals([]));
    }
}
