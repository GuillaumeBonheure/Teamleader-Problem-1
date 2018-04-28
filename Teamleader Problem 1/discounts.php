<?php

function spent_over_1000($customer, $order, $products)
{
    if($customer['revenue'] > 1000)
    {
        return 'Yes';
    }
    else
    {
        return 'No';
    }
}

function five_of_cat_2($customer, $order, $products)
{
    $items = array();
    
    foreach($order['items'] as $index => $item)
    {
        if(getCategory($item, $products) == 2 && getAmountFree($item) > 0)
        {
            $items[$item['product-id']] = getAmountFree($item) . ' free';
        }
    }
    
    if(count($items) == 0)
    {
        return 'No';
    }
    else
    {
        return $items;
    }
}

function two_of_cat_1($customer, $order, $products)
{
    $items = array();
    
    foreach($order['items'] as $index => $item)
    {
        if(getCategory($item, $products) == 1 && $item['quantity'] >= 2)
        {
            
        }
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
    return intdiv($item['quantity'], 6);
}