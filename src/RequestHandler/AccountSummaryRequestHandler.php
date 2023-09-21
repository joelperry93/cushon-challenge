<?php
namespace Cushon\RequestHandler;

use Cushon\AccountBalanceBreakdownBuilder;
use Cushon\Dao\AccountDao;
use Cushon\Dao\AccountTransactionDao;
use Cushon\View\RetailCustomerViewPresenter;
use Cushon\View\TransactionsViewPresenter;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * JSON endpoint that gives an overview of an account, including the owner of the account, totals for each fund,
 * and account transactions.
 */
final readonly class AccountSummaryRequestHandler implements RequestHandlerInterface {

    public function __construct(
        private TransactionsViewPresenter $transactionsViewPresenter,
        private AccountTransactionDao $accountTransactionDao,
        private AccountDao $accountDao,
        private RetailCustomerViewPresenter $customerViewPresenter,
        private AccountBalanceBreakdownBuilder $accountBalanceBreakdownBuilder
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface {
        $accountId = $request->getQueryParams()['account-id']; // ACL and validation checks will be needed
        $transactions = $this->accountTransactionDao->getAccountTransactions($accountId);

        return new JsonResponse([
            'holder'        => $this->customerViewPresenter->present($this->accountDao->getAccountOwner($accountId)),
            'fund_balances' => $this->accountBalanceBreakdownBuilder->buildAccountBalanceBreakdown($transactions),
            'transactions'  => $this->transactionsViewPresenter->present($transactions)
        ]);
    }
}
