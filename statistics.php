<!DOCTYPE html>
<html>
<head>
<title>Statistics</title>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 <div id="chart_div"></div>
</head>
<body>

  <?php
  $string = file_get_contents("kombidukkani.json");
  $json_store = json_decode($string, true);
  foreach ($json_store as $store => $json_store) {
    $size_products = sizeof($json_store[1]['products']['product']);
    for($i=0; $i<$size_products; $i++){
     $str1 = $json_store[1]['products']['product'][$i]['price'];
     $price_length = strlen($str1);
     echo $str1; ?> <br /> <?php
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
    echo $price_list[$i]; ?> <br /> <?php
    $price_list_int[$i] = (double)$price_list[$i];
    $price_list_int[$i] = $price_list_int[$i]/100.00;
    $total_price = $total_price + $price_list_int[$i];
    echo "total:".$total_price; ?> <br /> <?php
  }
  
?>

   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <script type="text/javascript">
       google.charts.load("current", {packages:['corechart']});
       google.charts.setOnLoadCallback(drawChart);
       function drawChart() {
         var data = google.visualization.arrayToDataTable([
           ["Element", "Number of Products", { role: "style" } ],
           ["0-100", 13, "#b87333"],
           ["100-200", 21, "silver"],
           ["200-300", 19, "gold"],
           ["300-400", 3, "color: #e5e4e2"],
           ["400-500", 8, "#b87333"],
           ["600-700", 10, "silver"],
           ["700-800", 19, "gold"],
           ["800-900", 49, "color: #e5e4e2"]
         ]);

         var view = new google.visualization.DataView(data);
         view.setColumns([0, 1,
                          { calc: "stringify",
                            sourceColumn: 1,
                            type: "string",
                            role: "annotation" },
                          2]);

         var options = {
           title: "Number of products",
           width: 1000,
           height: 600,
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

</body>
</html>
