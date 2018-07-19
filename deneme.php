<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>

<?php

$string = file_get_contents("kombidukkani.json");
$json_store = json_decode($string, true);


foreach ($json_store as $store => $json_store) {
    $str1 = $json_store[0]['numberOfReviewsMonths']; ?>
    <p>Number of reviews: <?php echo $str1  ?></p>
   <?php $str1 = $json_store[0]['positiveScoreRate']; ?>
    <p>Name: <?php echo $str1  ?></p>
    <?php $str1 = $json_store[0]['criterias']['criteria']['label1']; ?>
    <p>Criter1: <?php echo $str1  ?></p>
    <?php $str1 = $json_store[0]['criterias']['criteria']['averagePoint1']; ?>
    <p>Criter1: <?php echo $str1  ?></p>
    <?php $str1 = $json_store[0]['criterias']['criteria']['numberOfReviews1']; ?>
    <p>Criter1: <?php echo $str1  ?></p>
    <?php $str1 = $json_store[0]['criterias']['criteria']['label2']; ?>
    <p>Criter2: <?php echo $str1  ?></p>
    <?php $str1 = $json_store[0]['criterias']['criteria']['averagePoint2']; ?>
    <p>Criter1: <?php echo $str1  ?></p>
    <?php $str1 = $json_store[0]['criterias']['criteria']['numberOfReviews2']; ?>
    <p>Criter1: <?php echo $str1  ?></p>
    <?php $str1 = $json_store[0]['criterias']['criteria']['label3']; ?>
    <p>Criter3: <?php echo $str1  ?></p>
    <?php $str1 = $json_store[0]['criterias']['criteria']['averagePoint3']; ?>
    <p>Criter1: <?php echo $str1  ?></p>
    <?php $str1 = $json_store[0]['criterias']['criteria']['numberOfReviews3']; ?>
    <p>Criter1: <?php echo $str1  ?></p>
    <?php $str1 = $json_store[0]['criterias']['criteria']['label4']; ?>
    <p>Criter4: <?php echo $str1  ?></p>
    <?php $str1 = $json_store[0]['criterias']['criteria']['averagePoint4']; ?>
    <p>Criter1: <?php echo $str1  ?></p>
    <?php $str1 = $json_store[0]['criterias']['criteria']['numberOfReviews4']; ?>
    <p>Criter1: <?php echo $str1  ?></p>
    <?php $str1 = $json_store[0]['criterias']['criteria']['label5']; ?>
    <p>Criter5: <?php echo $str1  ?></p>
    <?php $str1 = $json_store[0]['criterias']['criteria']['averagePoint5']; ?>
    <p>Criter1: <?php echo $str1  ?></p>
    <?php $str1 = $json_store[0]['criterias']['criteria']['numberOfReviews5']; ?>
    <p>Criter1: <?php echo $str1  ?></p>

<?php
  for($i=0; $i<67; $i++){
    echo "-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------";
    $str1 = $json_store[1]['products']['product'][$i]['name']; ?>
    <p>Name: <?php echo $str1  ?></p>
   <?php $str1 = $json_store[1]['products']['product'][$i]['category']; ?>
    <p>Category: <?php echo $str1  ?></p><?php
   $str1 = $json_store[1]['products']['product'][$i]['price']; ?>
    <p>Price: <?php echo $str1  ?><?php
    $str1 = $json_store[1]['products']['product'][$i]['shipment']; ?>
     <p>Shipment: <?php echo $str1  ?></p><?php
   }


  for($i=0; $i<7; $i++){
    echo "***********************************************************************************************************************************************************************************";
    $str1 = $json_store[2]['comments']['comment'][$i]['reviewer']; ?>
    <p>Reviewer: <?php echo $str1  ?></p>
   <?php $str1 = $json_store[2]['comments']['comment'][$i]['dateTime']; ?>
    <p>Datetime: <?php echo $str1  ?></p><?php
    $str1 = $json_store[2]['comments']['comment'][$i]['productName']; ?>
    <p>Productname: <?php echo $str1  ?></p><?php
   $str1 = $json_store[2]['comments']['comment'][$i]['mood']; ?>
    <p>Mood: <?php echo $str1  ?></p><?php
    $str1 = $json_store[2]['comments']['comment'][$i]['text']; ?>
     <p>Text: <?php echo $str1  ?></p><?php
   }
}
?>

</body>
</html>
