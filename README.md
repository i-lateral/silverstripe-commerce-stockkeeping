# NOTICE: This module is depreciated, merged into the core commerce module and will shortly be removed from Packagist

Silverstripe Commerce Stock Keeping
===================================

Module designed to add basic stock keeping to the CMS. All products can
be given a "stock level". Once a user pays for the particular
product the stock level is reduced by the quantity of the ordered items. 

At the moment this is pretty rudimentory and only updates stock levels
when an order object is saved. This probably should be improved in the
future, maybe one mechanism that can be linked to from whenever a user
places an order. 

## Dependancies

* SilverStripe Framework 3.1.x
* Silverstripe Commerce 2.0

## Installation

Install this module either by downloading and adding to:

    [silverstripe-root]/commerce-stockkeeping

Then run: dev/build/?flush=all

Or alternativly add use composer:

    i-lateral/silverstripe-commerce-stockkeeping
    
## Usage

By default this module allows you to set a "StockLevel" on a product via
the admin, attempts to detect if a product can be added to the shopping
cart (based on the stock level and quantity set) and decreases the stock
level when a user makes a purchase.

**NOTE** If you do not wish for the add to cart form to appear when an
item is out of stock, you will need to add the following to your Product
templates:

    <% if $StockLevel < 1 %>
        <div class="form">
            $Form
        </div>
    <% end_if %>
    
### How to set when an order auto updates stock

By default when an order is set to "paid" the stock levels are updated.

You can change this behaviour by using the config variable:

    CommerceStockKeeping.completion_status

### Negative stock

By default, this module will reduce stock levels to negative numbers
when an order is complete.

If you want the stock levels to not go below 0, you can use the
following config variable:

    CommerceStockKeeping.allow_negative
    
### Adding items to the cart without enough stock

Be default trying to add an items with not enough stock to the cart
(or updating the cart beyond a level of stock allowed) is not allowed
and will throw a ValidationException (to be caught by the product form).

If you want to enable users purchase more items than are in stock, then
use the following conig variable:

    CommerceStockKeeping.allow_adding
