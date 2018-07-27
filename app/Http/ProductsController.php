<?php declare(strict_types=1);

namespace LinkAcademy\Gadgets\Commons\Http;

use LinkAcademy\Gadgets\Commons\Support\Facades\Cart;

class ProductsController
{
    /**
     * Products
     *
     * @return void
     */
    public function index()
    {
        return view('store.html');
    }

    /**
     * Prodcut detail
     *
     * @param  int    $id Product id
     * @return void
     */
    public function getProduct(int $id)
    {
        // Cart::add(3);
        // Cart::remove(3);
        // var_dump(Cart::getAll());
        return view('product.html', ['product_id' => $id]);
    }
}
