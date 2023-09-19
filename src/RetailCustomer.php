<?php
namespace Cushon;

/**
 * A retail customer can set up a ISAs directly, similarly to employer and employee customers but retail customers
 * cannot set up pensions.
 */
final readonly class RetailCustomer {

    public function __construct(
        public int $id,
        public string $name,
        public string $email
    ) {}
}
