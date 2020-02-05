<?php declare(strict_types=1);

namespace LinkAcademy\Gadgets\Commons;

class Cart
{
    /**
     * Cart.
     *
     * @var string
     */
    const CART = 'cart';

    /**
     * Add item to the shopping basket
     *
     * @param int $item
     */
    public function add(int $item): bool
    {
        if (! in_array($item, $this->items())) {
            $_SESSION[self::CART][] = $item;
        }

        return in_array($item, $_SESSION[self::CART]);
    }

    /**
     * Remove an item from shopping basket
     *
     * @param  int    $item Item to be removed
     *
     * @return void
     */
    public function remove(int $item): void
    {
        $items = $this->getAll();
        if (false !== $key = array_search($item, $items)) {
            unset($items[$key]);
        }

        $this->update($items);
    }

    /**
     * Get all items
     *
     * @return array
     */
    public function items(): array
    {
        $items = $_SESSION[self::CART] ?? [];
        sort($items, SORT_REGULAR);

        return $items;
    }

    /**
     * Remove all items from the cart.
     * 
     * @return [type] [description]
     */
    public function removeAll(): void
    {
        unset($_SESSION[self::CART]);
    }

    /**
     * Cart update
     *
     * @param  array  $items
     *
     * @return void
     */
    private function update(array $items): void
    {
        $_SESSION[self::CART] = $items;
    }
}
