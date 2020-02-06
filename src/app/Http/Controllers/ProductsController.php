<?php declare(strict_types=1);

namespace App\Http\Controllers;

defined('APP_DIR') or die('No script kiddies please!');

use App\Support\Facades\Cart;

class ProductsController
{
    /**
     * All products.
     *
     * @return string
     */
    public function index(): void
    {
        view('store.html');
    }

    /**
     * Prodcut detail.
     *
     * @param  int    $id Product id
     * @return string
     */
    public function getProduct(int $id): void
    {
        Cart::addItem($id);
        //var_dump(Cart::items());

        view('product.html', ['product_id' => $id]);
    }
}
