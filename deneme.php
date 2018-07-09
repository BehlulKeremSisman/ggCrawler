<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>

<?php

$string = file_get_contents("kombidukkani_comments.json");
$json_a = json_decode($string, true);

foreach ($json_a as $person_name => $person_a) {

/*
    $str1 = $person_a['numberOfReviewsMonths']; ?>
    <p>Number of reviews: <?php echo $str1  ?></p>
   <?php $str1 = $person_a['positiveScoreRate']; ?>
    <p>Positive score rate: <?php echo $str1  ?></p>
    <?php $str1 = $person_a['criterias']['criteria']['label1']; ?>
    <p>Criter1: <?php echo $str1  ?></p>
    <?php $str1 = $person_a['criterias']['criteria']['averagePoint1']; ?>
    <p>Criter1: <?php echo $str1  ?></p>
    <?php $str1 = $person_a['criterias']['criteria']['numberOfReviews1']; ?>
    <p>Criter1: <?php echo $str1  ?></p>
    <?php $str1 = $person_a['criterias']['criteria']['label2']; ?>
    <p>Criter2: <?php echo $str1  ?></p>
    <?php $str1 = $person_a['criterias']['criteria']['averagePoint2']; ?>
    <p>Criter1: <?php echo $str1  ?></p>
    <?php $str1 = $person_a['criterias']['criteria']['numberOfReviews2']; ?>
    <p>Criter1: <?php echo $str1  ?></p>
    <?php $str1 = $person_a['criterias']['criteria']['label3']; ?>
    <p>Criter3: <?php echo $str1  ?></p>
    <?php $str1 = $person_a['criterias']['criteria']['averagePoint3']; ?>
    <p>Criter1: <?php echo $str1  ?></p>
    <?php $str1 = $person_a['criterias']['criteria']['numberOfReviews3']; ?>
    <p>Criter1: <?php echo $str1  ?></p>
    <?php $str1 = $person_a['criterias']['criteria']['label4']; ?>
    <p>Criter4: <?php echo $str1  ?></p>
    <?php $str1 = $person_a['criterias']['criteria']['averagePoint4']; ?>
    <p>Criter1: <?php echo $str1  ?></p>
    <?php $str1 = $person_a['criterias']['criteria']['numberOfReviews4']; ?>
    <p>Criter1: <?php echo $str1  ?></p>
    <?php $str1 = $person_a['criterias']['criteria']['label5']; ?>
    <p>Criter5: <?php echo $str1  ?></p>
    <?php $str1 = $person_a['criterias']['criteria']['averagePoint5']; ?>
    <p>Criter1: <?php echo $str1  ?></p>
    <?php $str1 = $person_a['criterias']['criteria']['numberOfReviews5']; ?>
    <p>Criter1: <?php echo $str1  ?></p>



  for($i=0; $i<234; $i++){
    $str1 = $person_a['product'][$i]['name']; ?>
    <p>Name: <?php echo $str1  ?></p>
   <?php $str1 = $person_a['product'][$i]['category']; ?>
    <p>Category: <?php echo $str1  ?></p><?php
    $str1 = $person_a['product'][$i]['price']; ?>
    <p>Price: <?php echo $str1  ?></p><?php
   $str1 = $person_a['product'][$i]['shipment']; ?>
    <p>Shipment: <?php echo $str1  ?></p><?php

   }
?>

*/

for($i=0; $i<200; $i++){
  $str1 = $person_a['comment'][$i]['reviewer']; ?>
  <p>Reviewer: <?php echo $str1  ?></p>
 <?php $str1 = $person_a['comment'][$i]['dateTime']; ?>
  <p>Datetime: <?php echo $str1  ?></p><?php
  $str1 = $person_a['comment'][$i]['productName']; ?>
  <p>Productname: <?php echo $str1  ?></p><?php
 $str1 = $person_a['comment'][$i]['mood']; ?>
  <p>Mood: <?php echo $str1  ?></p><?php
  $str1 = $person_a['comment'][$i]['text']; ?>
   <p>Text: <?php echo $str1  ?></p><?php

 }

}

?>

</body>
</html>
