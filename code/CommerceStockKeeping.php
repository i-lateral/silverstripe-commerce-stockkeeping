<?php

/**
 * Core config class for this module
 */
class CommerceStockKeeping extends ViewableData {
    
    /**
     * The status which an order must be given in order for it to
     * perform a stock update.
     * 
     * @var string
     * @config
     */
    private static $completion_status = "paid"; 
    
    /**
     * Should be track stock levels into the negative, if this is
     * turned off, all product stock gets set to 0.
     * 
     * @var boolean
     * @config
     */
    private static $allow_negative = true;
    
}
