<?php
namespace unit;

use Cushon\AccountFundTransaction;
use Cushon\Fund;
use Cushon\FundSummaryBuilder;
use Money\Money;
use PHPUnit\Framework\TestCase;

final class FundSummaryBuilderTest extends TestCase {

    public function testNonZeroSummary(): void {
        $builder = new FundSummaryBuilder();

        $this->assertEquals(
            expected: [
                Fund::CUSHON_EQUITIES->value => Money::GBP(40)
            ],
            actual: $builder->buildSummary([
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
        $builder = new FundSummaryBuilder();
        $this->assertEquals(expected: [], actual: $builder->buildSummary([]));
    }
}
