<?php
namespace Cushon;

use Money\Money;

/**
 * Builds a summary of how much money is currently in each fund, given a list of transactions.
 */
final readonly class FundSummaryBuilder {

    /**
     * @param AccountFundTransaction[] $transactions
     * @return string[]
     */
    public function buildSummary(array $transactions): array {
        $summary = [];

        foreach ($transactions as $transaction) {
            $summary[$transaction->fund->value] ??= Money::GBP(0);
            $summary[$transaction->fund->value] = $summary[$transaction->fund->value]->add($transaction->amount);
        }

        return $summary;
    }
}
