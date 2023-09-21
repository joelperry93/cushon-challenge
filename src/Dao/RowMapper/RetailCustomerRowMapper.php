<?php
namespace Cushon\Dao\RowMapper;

use Cushon\Model\RetailCustomer;

/**
 * Transforms associative array DB rows into RetailCustomer objects
 */
final readonly class RetailCustomerRowMapper {

    /**
     * @param string[][] $rows
     * @return RetailCustomer[]
     */
    public function map(array $rows): array {
        return array_map(
            fn (array $row): RetailCustomer => new RetailCustomer(
                id: $row['id'],
                name: $row['name'],
                email: $row['email']
            ),
            $rows
        );
    }
}