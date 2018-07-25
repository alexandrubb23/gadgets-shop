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
		if (! in_array($item, $this->getAll())) {
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
		$items = $this->getAll();
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
	public function getAll(): array
	{
		$items = $_SESSION[self::CART] ?? [];
		sort($items, SORT_REGULAR);

		return $items;
	}

	/**
	 * Get all items separated by comma (e.g MySQL IN())
	 * 
	 * @return string
	 */
	public function getItems()
	{
		return implode(",", $this->getAll());
	}

	/**
	 * Refresh basket
	 * 
	 * @param  array  $items Items
	 * 
	 * @return void
	 */
	private function refresh(array $items)
	{
		$_SESSION[self::CART] = $items;
	}
}