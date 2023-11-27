<?php

namespace App\Filters\V1;

use App\Filters\V1\ApiFilter\ApiFilter;
use Illuminate\Http\Request;

class InvoicesFilter extends ApiFilter
{

    // $table->id();
    // $table->foreignId('customer_id')->constrained();
    // $table->integer('amount');
    // $table->string('status');
    // $table->datetime('billed_dated'); // Corrigindo o nome da coluna aqui
    // $table->datetime('paid_dated')->nullable();
    // $table->timestamps();

    protected $safeParms = [
        'name' => ['eq'],
        'type' => ['eq'],
        'email' => ['eq'],
        'address' => ['eq'],
        'city' => ['eq'],
        'state' => ['eq'],
        'postalCode' => ['eq', 'gt', 'lt'],
    ];

    protected $columnMap = [
        'postalCode' => 'postal_code',
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'gt' => '>',
        'lte' => '=<',
        'gte' => '>=',
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
