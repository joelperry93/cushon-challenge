<?php
namespace Cushon\Model;

use Money\Money;

/**
 * Calculates how much money has been deposited in each fund, given a list of transactions.
 */
final readonly class FundDepositTotalCalculator {

    /**
     * @param AccountFundTransaction[] $transactions
     * @return Money[]
     */
    public function calculateFundDepositTotals(array $transactions): array {
        $summary = [];

        foreach ($transactions as $transaction) {
            $summary[$transaction->fund->value] ??= Money::GBP(0);
            $summary[$transaction->fund->value] = $summary[$transaction->fund->value]->add($transaction->amount);
        }

        return $summary;
    }
}
