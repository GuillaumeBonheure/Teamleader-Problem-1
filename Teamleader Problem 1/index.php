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
        
        require 'discounts.php';
        
        function getDiscounts($order_file, $customer_file, $product_file) 
        {
            $order = getData($order_file);
            $customers = getData($customer_file);
            $products = getData($product_file);
            $customerID = $order['customer-id'];
            $customer = $customers[$customerID - 1];
            
            $discounts = array();
            $discounts['customer-id'] = $customerID;
            $discounts['name'] = $customer['name'];
            
            $available_discounts = ['spent_over_1000','five_of_cat_2','two_of_cat_1'];
                        
            foreach($available_discounts as $discount)
            {
                $discounts['discounts'][$discount] = 
                        $discount($customer, $order, $products);
            }
            
            echo '<pre>' . print_r($discounts, true) . '</pre>';
        }
        
        function getData($data_file)
        {
            $file = file_get_contents($data_file);
            
            $data = json_decode($file, true);
            echo '<pre>' . print_r($data, true) . '</pre>';
            return $data;
        }
        
        #getData("customers.json");
        #getData("products.json");
        #getData("order1.json");
        getDiscounts("order1.json", "customers.json", "products.json");
        ?>
    </body>
</html>
