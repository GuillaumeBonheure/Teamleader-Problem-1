<?php
/**
 * This file contains all the functions used to check the given order for
 * potential discounts the given customer may get. Every function receives the
 * same input, being a customer, an order and the set of products. All these
 * inputs are arrays.
 * 
 * The functions that actually return the discounts should be called the same
 * as the elements of $available_discounts in the main file.
 * 
 * As of now, the output simply consists of print statements, but this can be
 * changed to actually return a value.
 * 
 * @param   array   $customer
 * @param   array   $order
 * @param   array   $products
 */
function spent_over_1000($customer, $order, $products)
{
    /**
     * Checks if the given customer has already spent over €1000.
     * If so, a discount of 10% is awarded on the entire order. 
     */
    if($customer['revenue'] > 1000)
    {
        echo '<pre>10% off the total order price</pre>';
    }
}

function five_of_cat_2($customer, $order, $products)
{   
    /**
     * Checks if the given order contains 5 of the same items from category 2.
     * If so, a sixth such item is added to the order for free.
     */
    foreach($order['items'] as $index => $item)
    {
        if(getCategory($item, $products) == 2 and getAmountFree($item) > 0)
        {
            echo '<pre>' . getAmountFree($item) . ' extra ' . $item['product-id'] . " for free</pre>";
        }
    }
}

function two_of_cat_1($customer, $order, $products)
{
    /**
     * Checks if the given order contains at least 2 items from category 1.
     * If so, a 20% discount is awarded on the cheapest item.
     */
    $prices = array();
    
    foreach($order['items'] as $index => $item)
    {
        if(getCategory($item, $products) == 1)
        {
            $prices[$item['product-id']] = $item['unit-price'];
        }
    }
    
    if(count($prices) >= 2)
    { 
        echo '<pre>20% off on one ' . getCheapest($prices) . '</pre>';
    }
    elseif(count($prices) == 1)
    {
        echo '<pre>20% off on one ' . $item['product-id'] . '</pre>';
    }
}

function getCategory($item, $products)
{
    /**
     * Gets the category of a given item.
     * 
     * @param   array   $item       The item to get the category from
     * @param   array   $products   The list of products which stores the categories
     * @return  integer The category of the item
     */
    $productID = $item['product-id'];
    foreach($products as $index => $product)
    {
        if($productID == $product['id'])
        {
            return $product['category'];
        }
    }
    return 0;
}

function getAmountFree($item)
{
    /**
     * Gets the amount of free items of a certain kind of category 2
     * 
     * @param   array   $item   The item of which the customer may get some extra for free
     * @return  integer The extra amount the customer would get of a certain item for free
     */
    return intdiv($item['quantity'], 5);
}

function getCheapest($prices)
{
    /**
     * Gets the cheapest item ID from a list of given ID's and corresponding prices
     * 
     * @param   array   $prices The list with item ID's and corresponding unit prices
     * @return  integer The item ID of the cheapest item in the list
     */
    $cheapestPrice = 0;
    $cheapestID = 0;
    foreach($prices as $id => $price)
    {
        if($cheapestPrice == 0 or $cheapestPrice > $price)
        {
            $cheapestPrice = $price;
            $cheapestID = $id;
        }
    }
    return $cheapestID;
}