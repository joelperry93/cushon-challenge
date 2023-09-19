<?php
namespace Unit;

use Cushon\RetailCustomer;
use Cushon\View\RetailCustomerViewPresenter;
use PHPUnit\Framework\TestCase;

final class RetailCustomerViewPresenterTest extends TestCase {

    public function testViewPresenter(): void {
        $presenter = new RetailCustomerViewPresenter();

        $this->assertEquals(
            expected: [
                'name'  => 'John P',
                'email' => 'johnp@example.com'
            ],
            actual: $presenter->present(new RetailCustomer(id: 10, name: 'John P', email: 'johnp@example.com'))
        );
    }
}
