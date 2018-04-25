<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        function getDiscounts($order_file, $customer_file, $product_file) 
        {
            $customers = getData($customer_file);
            $products = getData($product_file);
            $order = getData($order_file);
            
            $discounts = array();
            
            foreach ($customers as $customer => $property)
            {
                if ($property["revenue"] >= 1000)
                {
                    $entry = array();
                    $entry['id'] = $property['id'];
                    $entry['name'] = $property['name'];
                    $entry['discount'] = "10% off";
                    $discounts[] = $entry;
                }
            }
            
            foreach ($order['items'] as $item => $item_prop)
            {
                $product_id = $item_prop['product-id'];
                $customer_id = $item['customer-id'];
                
                foreach ($products as $product => $product_prop)
                {
                    if ($product_prop['id'] == $product_id)
                    {
                        break;
                    }
                }
                
                if ($product_prop['category'] == 2)
                {
                    $amount_free = intdiv($product_prop['quantity'], 6);
                    $entry = array();
                    $entry['id'] = $customer_id;
                    $entry['name'] = getCustomer($customer_id, $customers);
                    $entry['discount'] = $amount_free + " free category 2 items";
                    $discounts[] = $entry;
                }
            }
            
            echo '<pre>' . print_r($discounts, true) . '</pre>';
        }
        
        function getData($data_file)
        {
            $file = file_get_contents($data_file);
            
            $data = json_decode($file, true);
            #echo '<pre>' . print_r($data, true) . '</pre>';
            return $data;
        }
        
        function getCustomer($id, $customers)
        {
            return $customers[$id - 1]['name'];
        }
        
        #getData("customers.json");
        #getData("products.json");
        #getData("order1.json");
        getDiscounts("order1.json", "customers.json", "products.json");
        ?>
    </body>
</html>
