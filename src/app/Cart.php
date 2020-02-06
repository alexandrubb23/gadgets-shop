<?php declare(strict_types=1);

namespace LinkAcademy\Gadgets\Commons;

defined('APP_DIR') or die('No script kiddies please!');

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
        if (! in_array($item, $this->items())) {
            $_SESSION[self::CART][] = $item;
        }

        return in_array($item, $_SESSION[self::CART]);
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
        $items = $this->getAll();
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
    public function remove(): void
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
