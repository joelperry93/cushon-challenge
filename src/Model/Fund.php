<?php
namespace Cushon\Model;

/**
 * The different funds that customers can invest in from within their ISAs and pensions. We expect this to grow
 * over time.
 */
enum Fund: string {
    case CUSHON_EQUITIES = 'CUSHON_EQUITIES';
}
