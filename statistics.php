<!DOCTYPE html>
<html>
<head>
<title>Statistics</title>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 <div id="chart_div"></div>
</head>
<body>

  <?php
  $isim = $_POST['magazaGrafik'].".json";
  $string = file_get_contents($isim);
  $json_store = json_decode($string, true);
  foreach ($json_store as $store => $json_store) {
    $size_products = sizeof($json_store[1]['products']['product']);
    for($i=0; $i<$size_products; $i++){
     $str1 = $json_store[1]['products']['product'][$i]['price'];
     $price_length = strlen($str1);
     //echo $str1;<?php
     for($k=0; $k<$price_length; $k++){
        if($str1[$k] == "0" || $str1[$k] == "1" || $str1[$k] == "2" || $str1[$k] == "3" || $str1[$k] == "4" ||
            $str1[$k] == "5" || $str1[$k] == "6" || $str1[$k] == "7" || $str1[$k] == "8" || $str1[$k] == "9"){
          $price = $price.$str1[$k];
        }
      }
      $price_list[$i] = $price;
      $price="";
    }
  }

  for($i=0; $i<sizeof($price_list); $i++){
    //echo $price_list[$i];<?php
    $price_list_int[$i] = (double)$price_list[$i];
    $price_list_int[$i] = $price_list_int[$i]/100.00;
    $total_price = $total_price + $price_list_int[$i];
    //echo "total:".$total_price; <?php
  }
  $min = min($price_list_int);
  $max = max($price_list_int);
  $diff = $max - $min;
  $flag = $diff / 8;
  //echo "max: ".$max;
  $flag = (int) $flag;
  for($i=0; $i<sizeof($price_list_int); $i++){
    if($price_list_int[$i] < $flag)
      $first = $first + 1;
    if($price_list_int[$i] > $flag && $price_list_int[$i] < $flag*2)
      $second = $second + 1;
    if($price_list_int[$i] > $flag*2 && $price_list_int[$i] < $flag*3)
      $third = $third + 1;
    if($price_list_int[$i] > $flag*3 && $price_list_int[$i] < $flag*4)
      $forth = $forth + 1;
    if($price_list_int[$i] > $flag*4 && $price_list_int[$i] < $flag*5)
      $fifth = $fifth + 1;
    if($price_list_int[$i] > $flag*5 && $price_list_int[$i] < $flag*6)
      $sixth = $sixth + 1;
    if($price_list_int[$i] > $flag*6 && $price_list_int[$i] < $flag*7)
      $seventh = $seventh + 1;
    $eight = sizeof($price_list_int) - ($first+$second+$third+$forth+$fifth+$sixth+$seventh);
  }
?>

   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <script type="text/javascript">
       google.charts.load("current", {packages:['corechart']});
       google.charts.setOnLoadCallback(drawChart);
       function drawChart() {
         var data = google.visualization.arrayToDataTable([
           ["Element", "Number of Products", { role: "style" } ],
           ["<?php echo "0-".$flag; ?>", <?php echo $first; ?>, "#b87333"],
           ["<?php echo $flag."-".$flag*2; ?>", <?php echo $second; ?>, "silver"],
           ["<?php echo 2*$flag."-".$flag*3; ?>", <?php echo $third; ?>, "gold"],
           ["<?php echo 3*$flag."-".$flag*4; ?>", <?php echo $forth; ?>, "color: #e5e4e2"],
           ["<?php echo 4*$flag."-".$flag*5; ?>", <?php echo $fifth; ?>, "#b87333"],
           ["<?php echo 5*$flag."-".$flag*6; ?>", <?php echo $sixth; ?>, "silver"],
           ["<?php echo 6*$flag."-".$flag*7; ?>", <?php echo $seventh; ?>, "gold"],
           ["<?php echo 7*$flag."-".$flag*8; ?>", <?php echo $eight; ?>, "color: #e5e4e2"]
         ]);

         var view = new google.visualization.DataView(data);
         view.setColumns([0, 1,
                          { calc: "stringify",
                            sourceColumn: 1,
                            type: "string",
                            role: "annotation" },
                          2]);

         var options = {
           title: "Number of Products at a Certain Price Range",
           width: 1300,
           height: 800,
           bar: {groupWidth: "95%"},
           legend: { position: "none" },
           vAxis: {
             title: 'Number of Products'
           },
           hAxis: {
             title: 'Price Range (TL)'
           }
         };
         var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
         chart.draw(view, options);
     }
     </script>
   <div id="columnchart_values" style="width: 900px; height: 300px;"></div>
   <br> <br />
   <br> <br />
   <br> <br />
   <br> <br />
   <br> <br />
   <br> <br />
   <br> <br />
   <br> <br />
   <br> <br />
   <br> <br />
   <br> <br />
   <br> <br />
   <br> <br />
   <br> <br />
   <?php echo "------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------"; ?>
   <br> <br />
   <br> <br />


   <?php
   $july=0;
   $june=0;
   $may=0;
   $april=0;
   $march=0;
   $february=0;
   $july_sad=0;
   $june_sad=0;
   $may_sad=0;
   $april_sad=0;
   $march_sad=0;
   $february_sad=0;
   $july_angry=0;
   $june_angry=0;
   $may_angry=0;
   $april_angry=0;
   $march_angry=0;
   $february_angry=0;

   $json_store = json_decode($string, true);
   foreach ($json_store as $store => $json_store) {
     for($k=2; $k<20; $k++){
       $size_comments = sizeof($json_store[$k]['comments']['comment']);
       if($json_store[$k] != NULL){
        for($i=0; $i<$size_comments; $i++){
          $str1 = $json_store[$k]['comments']['comment'][$i]['dateTime'];
          $month = substr($str1,3,2);
          if($json_store[$k]['comments']['comment'][$i]['mood']=="Mutlu"){
            if($month == "07")
              $july = $july + 1;
            if($month == "06")
              $june = $june + 1;
            if($month == "05")
              $may = $may + 1;
            if($month == "04")
              $april = $april + 1;
            if($month == "03")
              $march = $march + 1;
            if($month == "02")
              $february = $february + 1;
           }
           if($json_store[$k]['comments']['comment'][$i]['mood']=="Uzgun"){
             if($month == "07")
               $july_sad = $july_sad + 1;
             if($month == "06")
               $june_sad = $june_sad + 1;
             if($month == "05")
               $may_sad = $may_sad + 1;
             if($month == "04")
               $april_sad = $april_sad + 1;
             if($month == "03")
               $march_sad = $march_sad + 1;
             if($month == "02")
               $february_sad = $february_sad + 1;
            }
            if($json_store[$k]['comments']['comment'][$i]['mood']=="Kizgin"){
              if($month == "07")
                $july_angry = $july_angry + 1;
              if($month == "06")
                $june_angry = $june_angry + 1;
              if($month == "05")
                $may_angry = $may_angry + 1;
              if($month == "04")
                $april_angry = $april_angry + 1;
              if($month == "03")
                $march_angry = $march_angry + 1;
              if($month == "02")
                $february_angry = $february_angry + 1;
             }
         }
       }
     }
    }
    ?>
     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <script type="text/javascript">
       google.charts.load('current', {'packages':['bar']});
       google.charts.setOnLoadCallback(drawChart);

       function drawChart() {
         var data = google.visualization.arrayToDataTable([
           ['Months', 'Happy', 'Sad', 'Angry'],
           ['July', '<?php echo $july; ?>', '<?php echo $july_sad; ?>', '<?php echo $july_angry; ?>'],
           ['June', '<?php echo $june; ?>', '<?php echo $june_sad; ?>', '<?php echo $june_angry; ?>'],
           ['May', '<?php echo $may; ?>', '<?php echo $may_sad; ?>', '<?php echo $may_angry; ?>'],
           ['April', '<?php echo $april; ?>', '<?php echo $april_sad; ?>', '<?php echo $april_angry; ?>'],
           ['March', '<?php echo $march; ?>', '<?php echo $march_sad; ?>', '<?php echo $march_angry; ?>'],
           ['February', '<?php echo $february; ?>', '<?php echo $february_sad; ?>', '<?php echo $february_angry; ?>']
         ]);


         var options = {
           title: 'Monthly Number of Comments Based on Mood',
           width: 900,
           height: 500,
           bar: {groupWidth: "45%"},
           vAxis: {
             title: 'Number of Comments Based on Mood'
           },
           hAxis: {
             title: 'Months'
           }
         };

         var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

         chart.draw(data, google.charts.Bar.convertOptions(options));
       }
     </script>
     <div id="columnchart_material" style="width: 900px; height: 300px; margin-left:200px;"></div>
     <br> <br />
     <br> <br />
     <br> <br />
     <br> <br />
     <br> <br />
     <br> <br />
     <br> <br />

</body>
</html>
