<?php

/**
 * @author i-lateral (http://www.i-lateral.com)
 * @package commerce-stockkeeping
 */
class StockKeepingCatalogueProductExtension extends DataExtension {
    
    private static $db = array(
        "StockLevel" => "Int"
    );
    
    public function updateCMSFields(FieldList $fields) {
        $fields->addFieldToTab(
            "Root.Settings",
            NumericField::create("StockLevel", $this->owner->FieldLabel("StockLevel")),
            "TaxRateID"
        );
    }
    
}
