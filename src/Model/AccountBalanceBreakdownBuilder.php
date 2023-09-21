<?php
namespace Cushon\Model;

use Money\Money;

/**
 * Given a set of transactions, build a breakdown by fund of the amount deposited, the interest gained, and
 * the total balance by adding those two values
 */
final readonly class AccountBalanceBreakdownBuilder {

    public function __construct(
        private FundDepositTotalCalculator $fundDepositTotalCalculator,
        private InterestRateCalculator $interestRateCalculator
    ) {}

    /**
     * @param AccountFundTransaction[] $transactions
     * @return Money[][]
     */
    public function buildAccountBalanceBreakdown(array $transactions): array {
        $breakdown = [];

        $fundSummaries = $this->fundDepositTotalCalculator->calculateFundDepositTotals($transactions);
        $interests = $this->interestRateCalculator->calculateInterest($transactions);

        foreach ($fundSummaries as $fundValue => $fundDepositedAmount) {
            $breakdown[$fundValue] = [
                'deposited' => $fundDepositedAmount,
                'interest'  => $interests[$fundValue],
                'total'     => $fundDepositedAmount->add($interests[$fundValue])
            ];
        }

        return $breakdown;
    }
}
