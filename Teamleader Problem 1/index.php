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
        
        $available_discounts = ['spent_over_1000','five_of_cat_2','two_of_cat_1'];
                                
        require 'discounts.php';
        
        function getDiscounts($order_file, $customer_file, $product_file) 
        {
            global $available_discounts;
            $order = getData($order_file);
            $customers = getData($customer_file);
            $products = getData($product_file);

            echo "<pre>Order ID: " . $order['id'] .
                "\nCustomer ID: " . $order['customer-id'] .
                "\nName: " . $customers[$order['customer-id'] - 1]['name'] .
                "\nOrder:</pre>";
            
            foreach($order['items'] as $item => $property)
            {
                echo "<pre>Item ID: " . $property['product-id'] .
                    "\nUnit price: " . $property['unit-price'] .
                    "\nQuantity: " . $property['quantity'] .
                    "\nTotal price: " . $property['total'] . '</pre><br/>';
            }
            
            echo '<pre>Discounts:</pre>';
                        
            foreach($available_discounts as $discount)
            {
                echo '<pre>' . $discount($customers[$order['customer-id'] - 1], $order, $products) . '</pre>';
            }
        }
        
        function getData($data_file)
        {
            $file = file_get_contents($data_file);
            
            $data = json_decode($file, true);
            
            return $data;
        }
        
        getDiscounts("order4.json", "customers.json", "products.json");
        ?>
    </body>
</html>
