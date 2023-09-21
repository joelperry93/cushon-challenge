<?php
namespace Cushon\Model;

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
     * From an array of transactions for any number of funds, calculate the interest gained for each fund
     *
     * @param AccountFundTransaction[] $transactions
     * @return Money[]
     */
    public function calculateInterest(array $transactions): array {
        $fundTransactions = [];

        // Group transactions into each fund
        foreach ($transactions as $transaction) {
            $fundTransactions[$transaction->fund->value] ??= [];
            $fundTransactions[$transaction->fund->value][] = $transaction;
        }

        $fundInterests = [];

        foreach ($fundTransactions as $fundValue => $fundTransaction) {
            $fundInterests[$fundValue] = $this->getInterestRateForFundTransactions(
                Fund::from($fundValue),
                $fundTransaction
            );
        }

        return $fundInterests;
    }

    private function getInterestRateForFundTransactions(Fund $fund, array $fundTransactions): Money {
        $periodStart = clone $fundTransactions[0]->time;
        $periodStart->setTime(0, 0, 0);
        $periodEnd = $this->clock->now();
        $periodEnd->setTime(0, 0, 0);
        $periodRange = new \DatePeriod($periodStart, new \DateInterval('P1D'), $periodEnd);
        $dailyInterestRates = $this->interestRateDao->getDailyInterestRates($fund, $periodRange);
        $totalWithInterest = Money::GBP(0);
        $totalWithoutInterest = Money::GBP(0);

        foreach ($fundTransactions as $transaction) {
            $totalWithInterest = $totalWithInterest->add($transaction->amount);
            $totalWithoutInterest = $totalWithoutInterest->add($transaction->amount);
            $totalWithInterest = $totalWithInterest->multiply($dailyInterestRates[$transaction->time->format('Y-m-d')]);
        }

        return $totalWithInterest->subtract($totalWithoutInterest);
    }
}
