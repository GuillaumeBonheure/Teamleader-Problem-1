# Teamleader-Problem-1

This solution contains a few files:
1) **index.php**, which contains the main function that runs the order through all the checks in the second file
2) **discounts.php**, which contains the all functions that check if the given order merits a certain discount
3) Sample order, customer and product files

### Usage
To use this solution, one must call the function *getDiscounts()*, found in **index.php**, and supply it with the following parameters in this order:
1) A path to the order file
2) A path to the customers file 
3) A path to the products file

The output (as of now) simply prints the current order, followed by any discounts the customer may get on that order.

### Adding discounts
To add a discount, one must code a function that returns (in this case, prints) the discount in **discounts.php**, and add the name of that function to the variable *$available_discounts*, found in **index.php**. The function *getDiscounts()* will then automatically check the newly added discount as well.
