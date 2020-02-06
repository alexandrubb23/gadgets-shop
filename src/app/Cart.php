<?php declare(strict_types=1);

namespace App;

defined('APP_DIR') or die('No script kiddies please!');

use AlxCart\Support\Arr;

class Cart
{
    /**
     * Cart.
     *
     * @var string
     */
    const CART = 'cart';

    /**
     * Add a new item.
     *
     * @param int $item
     */
    public function addItem(int $item): bool
    {
        // item should be positive
        if ($item < 1) {
            return false;
        }

        $items = $this->items();
        if (! in_array($item, $items)) {
            $_SESSION[self::CART][] = $item;
        }

        return in_array($item, $items);
    }

    /**
     * Add a collection of items.
     *
     * This method illustrate uses of 
     * variadics operator, that's all.
     * 
     * @param void
     */
    public function addItems(...$items): void
    {
        $items = Arr::flatten($items);
        foreach ($items as $item) {
            $this->addItem($item);
        }
    }

    /**
     * Remove an item.
     *
     * @param int $item
     *
     * @return void
     */
    public function removeItem(int $item): void
    {
        $items = $this->items();
        if (false !== $key = array_search($item, $items)) {
            unset($items[$key]);
        }

        $this->update($items);
    }

    /**
     * Get all items.
     *
     * @return array
     */
    public function items(): array
    {
        return $_SESSION[self::CART] ?? [];
    }

    /**
     * Remove all.
     * 
     * @return void
     */
    public function empty(): void
    {
        unset($_SESSION[self::CART]);
    }

    /**
     * Cart update.
     *
     * @param array  $items
     *
     * @return void
     */
    private function update(array $items): void
    {
        $_SESSION[self::CART] = $items;
    }
}
