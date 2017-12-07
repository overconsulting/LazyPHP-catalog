<?php

namespace Catalog\models;

use Core\Model;
use Core\Session;

class CartItem
{
    /**
     * @var \Catalog\models\Product
     */
    public $product = null;

    /**
     * @var int
     */
    public $quantity = 0;

    public function __construct($product, $quantity = 1)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function getTotal()
    {
        return $this->product->price * $this->quantity;
    }
}

class Cart
{
    /**
     * @var CartItem[]
     */
    public $items = array();

    public static function load()
    {
        $cart = Session::get('cart');
        if ($cart === null) {
            $cart = new Cart();
        }
        return $cart;
    }

    public function save()
    {
        Session::set('cart', $this);
    }

    /**
     * Add an item (product + quantity) to the cart
     * @param \Catalog\models\Product $product
     * @param int $quantity
     */
    public function addItem($product, $quantity = 1)
    {
        $itemIndex = false;
        foreach ($this->items as $index => $item) {
            if ($item->product->id == $product->id) {
                $itemIndex = $index;
                break;
            }
        }

        if ($itemIndex === false) {
            $this->items[] = new CartItem($product, $quantity);
        } else {
            $this->items[$itemIndex]->quantity = $this->items[$itemIndex]->quantity + $quantity;
        }
    }

    /**
     * Delete an item from the cart
     * @param \Catalog\models\Product $product
     */
    public function deleteItem($product)
    {
        var_dump($product);
        foreach ($this->items as $index => $item) {
            if ($item->product->id == $product->id) {
                array_splice($this->items, $index, 1);
                break;
            }
        }
    }

    /**
     * Set quantity of an item
     * @param \Catalog\models\Product $product
     * @param int $quantity
     */
    public function setItemQuantity($product, $quantity)
    {
        $itemIndex = false;
        foreach ($this->items as $index => $item) {
            if ($item->product->id == $product->id) {
                $itemIndex = $index;
                break;
            }
        }

        if ($itemIndex === false) {
            $this->addItem($product, $quantity);
        } else {
            if ($quantity > 0) {
                $this->items[$itemIndex]->quantity = $quantity;
            } else {
                $this->deleteItem($product);
            }
        }
    }

    /**
     * Get the total price of the cart
     * @return float
     */
    public function getTotal()
    {
        $total = 0.0;

        foreach ($this->items as $index => $item) {
            $total = $total + $item->getTotal();
        }

        return $total;
    }
}
