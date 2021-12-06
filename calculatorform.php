<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator HTML form - not the php-code</title>
</head>
<body>
    <h1>Product Cost Calculator</h1>
    <h2>Please fill out this form to calculate your total cost</h2>
    <form action="form-calculations.php" method="post">
    <fieldset>
        <legend>Calculate the cost</legend>
        <label for="price">Price</label>
        <input type="text" id="price" name="price">
        <br>
        <label for="quantity">Quantity</label>
        <input type="number" id="quantity" name="price" min="1" value="1">
        <br>
        <label for="discount">Discount</label>
        <input type="text" id="discount" name="discount">$
        <br>
        <label for="tax">Tax</label>
        <input type="text" id="tax" name="tax" min="1">%
        <br>
        <label for="shipping">Shipping Method:</label>
        <select name="shipping" id="shipping">
            <option value="5.00">Slow and steady</option>
            <option value="8.95">Put a move on it</option>
            <option value="19.50">I need it yesterday!</option>
        </select>
        <br>
        <label for="payments">Number of payments to make:</label>
        <input type="number" id="payments" name="payments" min="1" value="1">
        <br>
        <input type="submit" name="submit" value="Calculate">
    </fieldset>
    </form>
</body>
</html>