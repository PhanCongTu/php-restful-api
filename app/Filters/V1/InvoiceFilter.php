<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class InvoiceFilter extends ApiFilter
{
      // Mảng các parameter được phép truy vấn.
      // Mỗi parameter có 1 mảng các toán tử được phép sử dụng.

      protected $safeParms = [
            'customerId' => ['eq'],
            'amount' => ['eq', 'gt', 'lt', 'gte', 'lte'],
            'status' => ['eq', 'ne'],
            'billedDate' => ['eq', 'gt', 'lt', 'gte', 'lte'],
            'paidDate' => ['eq', 'gt', 'lt', 'gte', 'lte'],
      ];

      // Mảng ánh xạ tên column từ tên parameter.
      protected $columnMap = [
            'customerId' => 'customer_id',
            'billedDate' => 'billed_date',
            'paidDate' => 'paid_date',
      ];

      // Mảng ánh xạ các toán tử từ chuỗi.
      protected $operatorMap = [
            'eq' => '=',
            'gt' => '>',
            'lt' => '<',
            'lte' => '<=',
            'gte' => '>=',
            'ne' => '!=',
      ];

}
