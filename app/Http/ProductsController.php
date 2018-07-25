<?php

namespace LinkAcademy\Gadgets\Commons\Http;

use LinkAcademy\Gadgets\Commons\Support\Facades\Cart;

class ProductsController extends AbstractController 
{
	/**
	 * Class constructor
	 * 
	 * @param \Twig_Environment $twig Twig template engine
	 */
	public function __construct(\Twig_Environment $twig)
	{
		$this->twig = $twig;
	}

	/**
	 * get home page
	 * 
	 * @return void
	 */
	public function index()
	{
		echo $this->twig->render('store.html');
	}

	public function getProduct(int $id)
	{
		// Cart::add(5);
		// Cart::remove(3);
		var_dump(Cart::getItems());
		echo $this->twig->render('product.html', ['product_id' => $id]);
	}	
}