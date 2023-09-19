<?php
namespace Unit;

use Cushon\AccountFundTransaction;
use Cushon\Fund;
use Cushon\View\TransactionsViewPresenter;
use Money\Money;
use PHPUnit\Framework\TestCase;

final class TransactionsViewPresenterTest extends TestCase {

    public function testViewPresenter(): void {
        $presenter = new TransactionsViewPresenter();

        $this->assertEquals(
            expected: [
                [
                    'fund'  => 'CUSHON_EQUITIES',
                    'money' => ['amount' => 10, 'currency' => 'GBP'],
                    'time'  => '2023-01-01T06:00:00+00:00'
                ],
                [
                    'fund'  => 'CUSHON_EQUITIES',
                    'money' => ['amount' => 15, 'currency' => 'GBP'],
                    'time'  => '2023-01-01T08:00:00+00:00'
                ]
            ],
            actual: $presenter->present([
                new AccountFundTransaction(
                    Fund::CUSHON_EQUITIES,
                    Money::GBP(10),
                    time: new \DateTime('2023-01-01T06:00:00')
                ),
                new AccountFundTransaction(
                    Fund::CUSHON_EQUITIES,
                    Money::GBP(15),
                    time: new \DateTime('2023-01-01T08:00:00')
                )
            ])
        );
    }
}
