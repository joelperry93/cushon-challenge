<?php
namespace Cushon;

use Cushon\Dao\InterestRateDao;
use Money\Money;
use Psr\Clock\ClockInterface;

/**
 * Given a list of transactions, and the daily interest rates for a given fund, calculate the compound interest gained.
 */
final readonly class InterestRateCalculator {

    public function __construct(
        private InterestRateDao $interestRateDao,
        private ClockInterface $clock
    ) {}

    /**
     * @param AccountFundTransaction[] $transactions
     */
    public function calculateInterest(array $transactions): Money {
        if (sizeof($transactions) === 0) {
            return Money::GBP(0);
        }

        $fund = $transactions[0]->fund;
        $periodStart = clone $transactions[0]->time;
        $periodStart->setTime(0, 0, 0);
        $periodEnd = $this->clock->now();
        $periodEnd->setTime(0, 0, 0);
        $periodRange = new \DatePeriod($periodStart, new \DateInterval('P1D'), $periodEnd);
        $dailyInterestRates = $this->interestRateDao->getDailyInterestRates($fund, $periodRange);
        $totalWithInterest = Money::GBP(0);
        $totalWithoutInterest = Money::GBP(0);

        foreach ($transactions as $transaction) {
            $totalWithInterest = $totalWithInterest->add($transaction->amount);
            $totalWithoutInterest = $totalWithoutInterest->add($transaction->amount);
            $totalWithInterest = $totalWithInterest->multiply($dailyInterestRates[$transaction->time->format('Y-m-d')]);
        }

        return $totalWithInterest->subtract($totalWithoutInterest);
    }
}
