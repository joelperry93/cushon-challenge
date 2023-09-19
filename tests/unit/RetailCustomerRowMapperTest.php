<?php
namespace unit;

use Cushon\Dao\RowMapper\RetailCustomerRowMapper;
use Cushon\RetailCustomer;
use PHPUnit\Framework\TestCase;

final class RetailCustomerRowMapperTest extends TestCase {

    public function testMapping(): void {
        $mapper = new RetailCustomerRowMapper();

        $this->assertEquals(
            expected: [
                new RetailCustomer(id: 10, name: 'John P', email: 'johnp@example.com'),
                new RetailCustomer(id: 11, name: 'John X', email: 'johnx@example.com'),
                new RetailCustomer(id: 12, name: 'Jill T', email: 'jillt@example.com')
            ],
            actual: $mapper->map([
                ['id' => '10', 'name' => 'John P', 'email' => 'johnp@example.com'],
                ['id' => '11', 'name' => 'John X', 'email' => 'johnx@example.com'],
                ['id' => '12', 'name' => 'Jill T', 'email' => 'jillt@example.com']
            ])
        );
    }
}
