<?php
namespace Cushon\Dao;

use Cushon\AccountFundTransaction;
use Cushon\Dao\RowMapper\AccountFundTransactionRowMapper;
use Doctrine\DBAL\Connection;
use Psr\Clock\ClockInterface;

/**
 * Database operations relating to account transactions
 */
final readonly class AccountTransactionDao {

    public function __construct(
        private Connection $connection,
        private AccountFundTransactionRowMapper $accountFundTransactionRowMapper
    ) {}

    /**
     * @return AccountFundTransaction[]
     */
    public function getAccountTransactions(int $accountId): array {
        return $this->accountFundTransactionRowMapper->map(
            $this->connection
                    ->createQueryBuilder()
                    ->select('f.name as fund', 'aft.amount_gbp', 'aft.time')
                    ->from('account_fund_transaction', 'aft')
                    ->join('aft', 'account_fund', 'af', 'af.id = aft.account_fund_id')
                    ->join('af', 'fund', 'f', 'af.fund_id = f.id')
                    ->where('af.account_id = ?')
                    ->setParameter(0, $accountId)
                    ->executeQuery()
                    ->fetchAllAssociative()
        );
    }
}
