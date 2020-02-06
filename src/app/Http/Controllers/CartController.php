<?php declare(strict_types=1);

namespace App\Http\Controllers;

defined('APP_DIR') or die('No script kiddies please!');

use App\Services\Products;
use App\Support\Facades\Cart;

use Acme\Test;

class CartController
{
	/**
	 * Class constructor.
	 * 
	 * @param Products $products
	 */
	public function __construct(Products $products)
	{
		$this->products = $products;
	}

    /**
     * Cart.
     *
     * @return void
     */
    public function index(): void
    {
        $products = $this->products->getAll();
        $products = array_intersect_key($products, array_flip(Cart::items()));

        view('checkout.html', ['products' => $products]);
    }
}
