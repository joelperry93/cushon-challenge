<?php
namespace Cushon\Dao;

use Cushon\Dao\RowMapper\RetailCustomerRowMapper;
use Cushon\Model\RetailCustomer;
use Doctrine\DBAL\Connection;

/**
 * Account DB operations
 */
final readonly class AccountDao {

    public function __construct(
        private Connection $connection,
        private RetailCustomerRowMapper $retailCustomerRowMapper
    ) {}

    public function getAccountOwner(int $accountId): RetailCustomer {
        return $this->retailCustomerRowMapper->map(
            $this->connection
                    ->createQueryBuilder()
                    ->select('cr.*')
                    ->from('customer_retail_account', 'cra')
                    ->join('cra', 'customer_retail', 'cr', 'cr.id = cra.customer_retail_id')
                    ->where('cra.account_id = ?')
                    ->setParameter(0, $accountId)
                    ->executeQuery()
                    ->fetchAllAssociative()
        )[0];
    }
}
