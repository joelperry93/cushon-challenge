<?php
namespace Cushon\Dao\RowMapper;

use Cushon\Model\AccountFundTransaction;
use Cushon\Model\Fund;
use Money\Money;

/**
 * Maps DB rows into AccountFundTransaction objects
 */
final readonly class AccountFundTransactionRowMapper {

    /**
     * @param string[][] $rows
     * @return AccountFundTransaction[]
     */
    public function map(array $rows): array {
        return array_map(
            fn (array $row): AccountFundTransaction => new AccountFundTransaction(
                Fund::from($row['fund']),
                Money::GBP($row['amount_gbp']),
                new \DateTime($row['time'])
            ),
            $rows
        );
    }
}
