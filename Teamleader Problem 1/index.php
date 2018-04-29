<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        /**
         * This file can be used by calling getDiscounts() with an order file,
         * a customers file and a products file. This will print a summary of
         * the order, followed by any discounts this order may merit.
         * 
         * This file requires discounts.php to be present in the working directory
         * in order to properly function, otherwise no output will be generated.
         * 
         * One can add additional discounts by coding them in discounts.php
         * and adding the name of the function that returns the discount to
         * the variable $available_discounts.
         * 
         * @author Guillaume Bonheure
         */
        $available_discounts = ['spent_over_1000','five_of_cat_2','two_of_cat_1'];
                                
        require 'discounts.php';
        
        function getDiscounts($order_file, $customer_file, $product_file) 
        {
            /**
             * Iterates through every discount in $available_discounts.
             * 
             * @param   JSON File   $order_file     Specifies the file containing the order to be processed
             * @param   JSON File   $customer_file  Specifies the file containing the customers
             * @param   JSON File   $product_file   Specifies the file containing the available products
             * 
             * @return  Whatever the discount functions from discount.php generate.
             *          Currently everything is simply printed, but this can be
             *          modified to return an array of discounts, for example.
             */
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
                $discount($customers[$order['customer-id'] - 1], $order, $products);
            }
        }
        
        function getData($data_file)
        {
            /**
             * Extracts the contents of a given file and uses the JSON decoder
             * to put the data in an array.
             * 
             * @param   JSON File   $data_file  Specifies the file to extract the data from
             * @return  array       The array containing data from $data_file
             */
            $file = file_get_contents($data_file);
            
            $data = json_decode($file, true);
            
            return $data;
        }
        ?>
    </body>
</html>
