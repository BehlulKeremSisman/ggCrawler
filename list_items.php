<!DOCTYPE html>
<html>
<head>
<title>List Items</title>
</head>
<body>

<?php
$isim = $_POST['magazaIsmi'].".json";
$string = file_get_contents($isim);
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
  $size_products = sizeof($json_store[1]['products']['product']);
  for($i=0; $i<$size_products; $i++){
    echo "-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------";
    $str1 = $json_store[1]['products']['product'][$i]['name']; ?>
    <p><?php echo ($i+1).". ürün;" ?> <br><br />Name: <?php echo $str1  ?></p>
   <?php $str1 = $json_store[1]['products']['product'][$i]['category']; ?>
    <p>Category: <?php echo $str1  ?></p><?php
   $str1 = $json_store[1]['products']['product'][$i]['price']; ?>
    <p>Price: <?php echo $str1  ?><?php
    $str1 = $json_store[1]['products']['product'][$i]['shipment']; ?>
     <p>Shipment: <?php echo $str1  ?></p><?php
   }

   for($k=2; $k<20; $k++){
     $size_comments = sizeof($json_store[$k]['comments']['comment']);
     if($json_store[$k] != NULL){
      for($i=0; $i<$size_comments; $i++){
        echo "***********************************************************************************************************************************************************************************";
        $str1 = $json_store[$k]['comments']['comment'][$i]['reviewer']; ?>
        <p><?php echo ($i+1).". yorum;" ?> <br><br />Reviewer: <?php echo $str1  ?></p>
       <?php $str1 = $json_store[$k]['comments']['comment'][$i]['dateTime']; ?>
        <p>Datetime: <?php echo $str1  ?></p><?php
        $str1 = $json_store[$k]['comments']['comment'][$i]['productName']; ?>
        <p>Productname: <?php echo $str1  ?></p><?php
       $str1 = $json_store[$k]['comments']['comment'][$i]['mood']; ?>
        <p>Mood: <?php echo $str1  ?></p><?php
        $str1 = $json_store[$k]['comments']['comment'][$i]['text']; ?>
         <p>Text: <?php echo $str1  ?></p><?php
       }
     }
   }
}
?>

</body>
</html>
