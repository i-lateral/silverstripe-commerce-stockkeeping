<?php

/**
 * Extension to the order object to allow us to perform a stock update
 * on save (if the order status has been set correctly).
 * 
 * @author i-lateral (http://www.i-lateral.com)
 * @package commerce-stockkeeping
 */
class StockKeepingOrderExtension extends DataExtension {
    
    public function onBeforeWrite() {
        parent::onBeforeWrite();
        
        $status = CommerceStockKeeping::config()->completion_status;
        $allow_negative = CommerceStockKeeping::config()->allow_negative;
        
        // If we have just changed the order status and it matches loop
        // all products and update quantities.
        if($this->owner->isChanged("Status") && $this->owner->Status == $status) {
            foreach($this->owner->Items() as $order_item) {
                $product = $order_item->Product();
                
                if($order_item->Quantity && $product->ID) {
                    $product->StockLevel = ($product->StockLevel - $order_item->Quantity);
                    if(!$allow_negative && $product->StockLevel < 0) $product->StockLevel == 0;
                    $product->write();
                }
            }
        }
    }
    
}
