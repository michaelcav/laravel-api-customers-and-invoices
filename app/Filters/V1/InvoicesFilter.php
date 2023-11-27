<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\V1\ApiFilter;


class InvoicesFilter extends ApiFilter
{


    protected $safeParms = [
        'customerId' => ['eq'],
        'amount' => ['eq', 'lt', 'gt', 'gte'],
        'status' => ['eq', 'ne'],
        'billed_dated' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'paid_dated' => ['eq', 'lt', 'gt', 'lte', 'gte'],
    ];

    protected $columnMap = [
        'customerId' => 'customer_id',
        'billedDated' => 'billed_dated',
        'paidDated' => 'paid_dated',
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'gt' => '>',
        'lte' => '=<',
        'gte' => '>=',
        'ne' => '!='
    ];
}
