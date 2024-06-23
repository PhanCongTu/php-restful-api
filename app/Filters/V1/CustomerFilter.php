<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class CustomerFilter extends ApiFilter
{
      // Mảng các parameter được phép truy vấn.
      // Mỗi parameter có 1 mảng các toán tử được phép sử dụng.

      protected $safeParms = [
            'name' => ['eq'],
            'type' => ['eq'],
            'email' => ['eq'],
            'address' => ['eq'],
            'city' => ['eq'],
            'state' => ['eq'],
            'postalCode' => ['eq', 'gt', 'lt'],
      ];

      // Mảng ánh xạ tên column từ tên parameter.
      protected $columnMap = [
            'postalCode' => 'postal_code',
      ];

      // Mảng ánh xạ các toán tử từ chuỗi.
      protected $operatorMap = [
            'eq' => '=',
            'gt' => '>',
            'lt' => '<',
            'lte' => '<=',
            'gte' => '>=',
      ];

}
