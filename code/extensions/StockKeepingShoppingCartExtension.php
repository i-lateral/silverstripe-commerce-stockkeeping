<?php

/**
 * Extension responsible for dealing with making sure that objects are
 * not added to the cart if they are out of stock (or not enough are
 * in stock).
 * 
 * @author Morven Lewis-Everley
 */
class StockKeepingShoppingCartExtension extends Extension {
    
    public function onBeforeAdd($cart_item) {
        // Check that item is not out of stock or has enough stock
        if($cart_item->Quantity) {
            $item = $cart_item->FindStockItem();
            $stock = ($item->StockLevel) ? $item->StockLevel : 0;
            
            if($stock < $cart_item->Quantity && !CommerceStockKeeping::config()->allow_adding) {
                throw new ValidationException(_t(
                    "StockKeeping.NotEnoughStock",
                    "There are not enough '{title}' in stock",
                    "Message to show that an item hasn't got enough stock",
                    array('title' => $item->Title)
                ));
            }
        }
    }
    
    
    public function onBeforeUpdate($cart_item) {
        
        // Check that item is not out of stock or has enough stock
        if($cart_item->Quantity) {
            $item = $cart_item->FindStockItem();
            $stock = ($item->StockLevel) ? $item->StockLevel : 0;
            
            if($stock < $cart_item->Quantity && !CommerceStockKeeping::config()->allow_adding) {
                // Set quantity to the level we have in stock
                $cart_item->Quantity = $stock;
                
                throw new ValidationException(_t(
                    "StockKeeping.NotEnoughStock",
                    "There are not enough '{title}' in stock",
                    "Message to show that an item hasn't got enough stock",
                    array('title' => $item->Title)
                ));
            }
        }
    }
    
} 
