<!DOCTYPE HTML>
<html>
<head>
<title>Ana Sayfa</title>

<style>

div.buttonlar {
	
	 text-align: center;
	 margin-top: 5%;
}

div.aciklama {
	 text-align: center;
	 margin-top: 8%;
	font-size: 125%;

} 

div.baslik {
      font-size: 175%;
      color: blue;
      text-align: center;
      margin-top: 4%;	
}


</style>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>


<body>

<div class = "baslik">
<h>www.gittigidiyor.com Mağazalar Ve Ürünlerinin İstatistiksel Analizi</h>
</div>
<div class = "buttonlar">
<input type="button" value="Tüm ürünler" class="btn btn-primary btn-lg" id="list" onClick="document.location.href='list_items.php'" />
<input type="button" value="Grafiksel Analiz" class="btn btn-primary btn-lg" id="Statistics" onClick="document.location.href='statistics.php'" />
</div>

<div class = "aciklama">
<p>Tüm Ürünler Buttonuna Tıklanarak Mağazanın Tüm Ürünlerine Ulaşılabilir...</p>
<p>Grafiksel Analiz Buttonuna Tıklanarak Ürünlerin Fiyatlarına Göre Grafiksel Analizine Ulaşılabilir...</p>
</div>

</body>
</html>
