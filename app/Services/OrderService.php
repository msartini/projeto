<?php

namespace App\Services;

use App\Order;
use App\Product;

class OrderService {

    public function stockValidation()
    {
        $product_id = request()->get("product_id");
        $quantity = request()->get("quantity");
        $product = Product::find($product_id);
          
        $new_stock = $product->stock - $quantity;
         
        if ($new_stock < 0) {
            return false;
        }

        $product->stock = $new_stock;
        $product->save();

        return true;
    }
    /**
     * Devolve produto para o estoque.
     * 
     * @param  int $id
     * @return boolean (true/false)
     */
    public function backStock(int $id)
    {
        $order = Order::find($id);
        if (! $order) {
            return false;
        }

        $product = Product::find($order->product_id);
        if (! $product) {
            return false;
        }

        $quantity = $order->quantity;
        $stock = $product->stock;
        $product->stock = ($stock + $quantity);
        $product->save();

        return true;
    }
}