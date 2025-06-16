<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function delete(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.product.index');
    }
}
