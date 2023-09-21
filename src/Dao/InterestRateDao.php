<?php
namespace Cushon\Dao;

use Cushon\Model\Fund;
use Doctrine\DBAL\Connection;

/**
 * Database operations for fund interest rates
 */
class InterestRateDao {

    public function __construct(private readonly Connection $connection) {}

    /**
     * @return string[]
     */
    public function getDailyInterestRates(Fund $fund, \DatePeriod $datePeriod): array {
        return $this->connection->createQueryBuilder()
                ->select('fir.date', 'fir.rate')
                ->from('fund_interest_rate', 'fir')
                ->join('fir', 'fund', 'f', 'f.id = fir.fund_id')
                ->where('fir.date >= ?')
                ->andWhere('fir.date <= ?')
                ->andWhere('f.name = ?')
                ->orderBy('date', 'ASC')
                ->setParameter(0, $datePeriod->getStartDate()->format('Y-m-d'))
                ->setParameter(1, $datePeriod->getEndDate()->format('Y-m-d'))
                ->setParameter(2, $fund->value)
                ->executeQuery()
                ->fetchAllKeyValue();
    }
}
