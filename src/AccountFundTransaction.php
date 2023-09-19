<?php
namespace Cushon;

use Money\Money;

/**
 * A single transaction of an amount of money being withdrawn or deposited into a fund.
 */
final readonly class AccountFundTransaction {

    public function __construct(
        public Fund $fund,
        public Money $amount,
        public \DateTime $time
    ) {}
}
