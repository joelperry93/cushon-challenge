<?php
namespace Cushon\RequestHandler;

use Cushon\Dao\AccountDao;
use Cushon\Dao\AccountTransactionDao;
use Cushon\FundSummaryBuilder;
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
final readonly class AccountBalanceRequestHandler implements RequestHandlerInterface {

    public function __construct(
        private TransactionsViewPresenter $transactionsViewPresenter,
        private AccountTransactionDao $accountTransactionDao,
        private FundSummaryBuilder $fundSummaryBuilder,
        private AccountDao $accountDao,
        private RetailCustomerViewPresenter $customerViewPresenter
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface {
        $accountId = $request->getQueryParams()['account-id']; // ACL and validation checks will be needed
        $transactions = $this->accountTransactionDao->getAccountTransactions($accountId);

        return new JsonResponse([
            'owner'        => $this->customerViewPresenter->present($this->accountDao->getAccountOwner($accountId)),
            'totals'       => $this->fundSummaryBuilder->buildSummary($transactions),
            'transactions' => $this->transactionsViewPresenter->present($transactions)
        ]);
    }
}
