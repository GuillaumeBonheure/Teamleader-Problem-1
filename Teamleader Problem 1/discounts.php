<?php

function spent_over_1000($customer, $order, $products)
{
    if($customer['revenue'] > 1000)
    {
        return '10% off the total order price';
    }
}

function five_of_cat_2($customer, $order, $products)
{   
    $result = "";
    foreach($order['items'] as $index => $item)
    {
        if(getCategory($item, $products) == 2 and getAmountFree($item) > 0)
        {
            $result .= getAmountFree($item) . ' extra ' . $item['product-id'] . " for free\n";
        }
    }
    return $result;
}

function two_of_cat_1($customer, $order, $products)
{
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
        return '20% off on one ' . getCheapest($prices);
    }
    elseif(count($prices) == 1)
    {
        return '20% off on one ' . $item['product-id'];
    }
}

function getCategory($item, $products)
{
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
    return intdiv($item['quantity'], 5);
}

function getCheapest($prices)
{
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