<?php

namespace App\Http\Services\V1;

use Illuminate\Http\Request;

class CustomerQuery
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

      /**
       * Đây là 1 method biến đổi các query paramter từ http request thành 1 mảng các diều kiện truy vấn.
       */
      public function transform(Request $request)
      {
            $eloQuery = [];
            foreach ($this->safeParms as $parm => $operators) {
                  // Lấy giá trị của tham số $parm từ HTTP request.
                  $query = $request->query($parm); // ['eq'=>'I']

                  // Nếu nó không được gửi trong request thì bỏ qua tham số này và tiếp tục vòng lặp.
                  if (!isset($query)) {
                        continue;
                  }
                  
                  // Lấy tên column tương ứng với parameter.
                  // Nếu nó không có trong map thì sử dụng luôn tên param làm tên column.
                  $column = $this->columnMap[$parm] ?? $parm;

                  // Kiểm tra các toán tử được phép sử dụng với param này.
                  foreach ($operators as $operator) {
                        // Kiểm tra xem request param này có toán tử nào không.
                        if (isset($query[$operator])) {
                              // Nếu có
                              // Tạo 1 mảng chứa ['tên cột', 'toán tử', 'giá trị']
                              // Thêm mảng mới đó vô eloQuery
                              $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                        }
                  }
            }
            return $eloQuery;
      }
}
