<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Product([
            'code'     => $row[1],
            'product_name'    => $row[2],
            'category_id' => $row[3],
            'unit_id'     => $row[4],
            'stock'     => $row[5],
            'buy_price'     => $row[6],
            'sell_price'     => $row[7],
        ]);
    }
}
