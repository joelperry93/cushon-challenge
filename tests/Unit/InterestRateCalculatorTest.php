<?php
namespace Unit;

use Cushon\AccountFundTransaction;
use Cushon\Dao\InterestRateDao;
use Cushon\Fund;
use Cushon\InterestRateCalculator;
use Money\Money;
use PHPUnit\Framework\TestCase;
use Psr\Clock\ClockInterface;

final class InterestRateCalculatorTest extends TestCase {

    public function testInterestRatesWithThreeTransactions(): void {
        $interestRateCalculator = new InterestRateCalculator(
            \Mockery::mock(InterestRateDao::class)
                    ->shouldReceive('getDailyInterestRates')
                    ->andReturn([
                        '2023-06-01' => '1.01',
                        '2023-06-02' => '1.02',
                        '2023-06-03' => '1.03'
                    ])
                    ->getMock(),
            \Mockery::mock(ClockInterface::class)
                    ->shouldReceive('now')
                    ->andReturn(new \DateTimeImmutable('2023-06-03'))
                    ->getMock()
        );

        $this->assertEquals(
            expected: Money::GBP('14'), // ((100*1.01+100)*1.02+100)*1.03 = 314.1706
            actual: $interestRateCalculator->calculateInterest(
                transactions: [
                    new AccountFundTransaction(Fund::CUSHON_EQUITIES, Money::GBP(100), new \DateTime('2023-06-01')),
                    new AccountFundTransaction(Fund::CUSHON_EQUITIES, Money::GBP(100), new \DateTime('2023-06-02')),
                    new AccountFundTransaction(Fund::CUSHON_EQUITIES, Money::GBP(100), new \DateTime('2023-06-03')),
                ]
            )
        );
    }

    public function testInterestRateNoTransactions(): void {
        $interestRateCalculator = new InterestRateCalculator(
            \Mockery::mock(InterestRateDao::class)
                ->shouldReceive('getDailyInterestRates')
                ->andReturn([
                    '2023-06-01' => '1.01',
                    '2023-06-02' => '1.02',
                    '2023-06-03' => '1.03'
                ])
                ->getMock(),
            \Mockery::mock(ClockInterface::class)
                ->shouldReceive('now')
                ->andReturn(new \DateTimeImmutable('2023-06-03'))
                ->getMock()
        );

        $this->assertEquals(
            expected: Money::GBP('0'),
            actual: $interestRateCalculator->calculateInterest([])
        );
    }
}
