<?php
namespace Tests\Acceptance;

use Tests\Support\ApiTester;

final readonly class AccountSummaryCest {

    public function testFirstAccount(ApiTester $I): void {
        $I->sendGet('/account-summary', ['account-id' => 1]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseEquals(
            json_encode([
                'holder' => [
                    'name' => 'John T',
                    'email' => 'johnt@example.com'
                ],
                'fund_totals' => [
                    'CUSHON_EQUITIES' => [
                        'amount' => '25000',
                        'currency' => 'GBP'
                    ]
                ],
                'interest' => [
                    'amount' => '602',
                    'currency' => 'GBP'
                ],
                'transactions' => [
                    [
                        'time' => '2023-06-01T19:00:00+00:00',
                        'fund' => 'CUSHON_EQUITIES',
                        'money' => [
                            'amount' => '10000',
                            'currency' => 'GBP'
                        ]
                    ],
                    [
                        'time' => '2023-06-02T19:00:00+00:00',
                        'fund' => 'CUSHON_EQUITIES',
                        'money' => [
                            'amount' => '15000',
                            'currency' => 'GBP'
                        ]
                    ]
                ]
            ])
        );
    }

    public function testSecondAccount(ApiTester $I): void {
        $I->sendGet('/account-summary', ['account-id' => 2]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseEquals(
            json_encode([
                'holder' => [
                    'name' => 'Jill P',
                    'email' => 'jillp@example.com'
                ],
                'fund_totals' => [
                    'CUSHON_EQUITIES' => [
                        'amount' => '4000',
                        'currency' => 'GBP'
                    ]
                ],
                'interest' => [
                    'amount' => '80',
                    'currency' => 'GBP'
                ],
                'transactions' => [
                    [
                        'time' => '2023-06-02T19:00:00+00:00',
                        'fund' => 'CUSHON_EQUITIES',
                        'money' => [
                            'amount' => '4000',
                            'currency' => 'GBP'
                        ]
                    ]
                ]
            ])
        );
    }
}
