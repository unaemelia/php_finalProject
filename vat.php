<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Kloud AB - Monthly Subscription</h1>
    <form method="post">
        <h3>Please enter the amount of GB you want to use per month to calculate your price</h3>
        <input type="text" name="price">
        <br>
        <button name="submit" value="submit" type="submit">Calculate your price</button>
    </form>
    <p><b>Your price is: </b></p>
    <br>
    <?php
    if (isset($_POST['submit'])) {
        $price = $_POST['price'];
        $vat = 25;
        if($price >= 0 && $price <= 100){
            $incVat = $price * 5;
            echo "Price excluding VAT: ".$incVat." SEK<br><br>";
            $excVat = ($incVat / 100)*$vat;
            echo "Price including VAT: ".$incVat + $excVat." SEK";
        } elseif($price >= 100 && $price <= 200){
            $incVat = $price * 3;
            echo "Price excluding VAT: ".$incVat." SEK<br><br>";
            $excVat = ($incVat / 100)*$vat;
            echo "Price including VAT: ".$incVat + $excVat." SEK";
        } elseif($price >= 200 && $price <= 300){
            $incVat = $price * 2;
            echo "Price excluding VAT: ".$incVat." SEK<br><br>";
            $excVat = ($incVat / 100)*$vat;
            echo "Price including VAT: ".$incVat + $excVat." SEK";
        } else {
            $incVat = $price * 1;
            echo "Price excluding VAT: ".$incVat." SEK<br><br>";
            $excVat = ($incVat / 100)*$vat;
            echo "Price including VAT: ".$incVat + $excVat." SEK";
        }
    }
    ?>

</body>

</html>