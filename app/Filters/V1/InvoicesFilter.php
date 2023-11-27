<?php

namespace App\Filters\V1;

use App\Filters\V1\ApiFilter\ApiFilter;
use Illuminate\Http\Request;

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

    public function  transform(Request $request)
    {
        $eloQuery = [];

        foreach ($this->safeParms as $parm => $operators) {
            $query = $request->query($parm);

            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$parm] ?? $parm;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }
        return $eloQuery;
    }
}
