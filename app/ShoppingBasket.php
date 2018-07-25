<?php

namespace LinkAcademy\Gadgets\Commons;

class ShoppingBasket
{
	const CART = 'cart';

	/**
	 * Add item to the shopping basket
	 * 
	 * @param int $item Item
	 */
	public function add(int $item): bool
	{
		if (! in_array($item, $this->getItems())) {
			$_SESSION[self::CART][] = $item;
		}

		return true;
	}

	/**
	 * Remove an item from shopping basket
	 * 
	 * @param  int    $item Item to be removed
	 * 
	 * @return void
	 */
	public function remove(int $item)
	{
		$items = $this->getItems();
		if (false !== $key = array_search($item, $items)) {
			unset($items[$key]);
		}

		$this->refresh($items);
	}

	/**
	 * Get all items
	 * 
	 * @return array
	 */
	public function getItems(): array
	{
		return $_SESSION[self::CART] ?? [];
	}

	private function refresh(array $items)
	{
		$_SESSION[self::CART] = $items;
	}
}