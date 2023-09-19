<?php
namespace Cushon\View;

use Cushon\AccountFundTransaction;

/**
 * Turns an array of AccountFundTransaction objects into a format that can be displayed to the user. Separates the
 * responsibility of viewing a transaction from the responsibility of modelling one.
 */
final readonly class TransactionsViewPresenter {

    public function present(array $transactions): array {
        return array_map(
            fn (AccountFundTransaction $transaction): array => [
                'time'   => $transaction->time->format(\DateTimeInterface::ATOM),
                'fund'   => $transaction->fund->name,
                'money'  => [
                    'amount'   => $transaction->amount->getAmount(),
                    'currency' => $transaction->amount->getCurrency()->getCode()
                ]
            ],
            $transactions
        );
    }
}