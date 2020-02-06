<?php declare(strict_types=1);

namespace LinkAcademy\Gadgets\Commons\Http\Controllers;

defined('APP_DIR') or die('No script kiddies please!');

use LinkAcademy\Gadgets\Commons\Support\Facades\Cart;

class ProductsController
{
    /**
     * Products
     *
     * @return string
     */
    public function index(): void
    {
        view('store.html');
    }

    /**
     * Prodcut detail
     *
     * @param  int    $id Product id
     * @return string
     */
    public function getProduct(int $id): void
    {
        view('product.html', ['product_id' => $id]);
    }
}
