<?php
namespace Cushon\View;

use Cushon\RetailCustomer;

/**
 * Turns a retail customer object into a format that can be displayed to the user. It's important to separate the
 * responsibility of presenting a customer from the model, so that one can change without affecting the other.
 */
final readonly class RetailCustomerViewPresenter {

    public function present(RetailCustomer $retailCustomer): array {
        return [
            'name'  => $retailCustomer->name,
            'email' => $retailCustomer->email
        ];
    }
}