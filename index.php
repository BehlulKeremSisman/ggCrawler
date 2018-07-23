<!DOCTYPE HTML>
<html>
<head>
<title>Ana Sayfa</title>

<style>

input {

	 text-align: left;
	 margin-top: 5%;
	 width: 20%;
	 padding: 12px 20px;
}

div.magaza {

	 text-align: center;
	 margin-top: 5%;
}

div.magazaGrafik {

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
<h>www.gittigidiyor.com Mağazalar ve Ürünlerinin İstatistiksel Analizi</h>
</div>

<form action="list_items.php" method="post">
<div class = "magaza">
<input type="text" name="magazaIsmi" value="Magaza Giriniz...">
<input type="submit" name="submit" value="Magaza Verileri" class="btn btn-primary btn-lg" id="list" onClick="document.location.href='list_items.php'" />
</div>
</form>

<form action="statistics.php" method="post">
<div class = "magazaGrafik">
<input type="text" name="magazaGrafik" value="Magaza Giriniz...">
<input type="submit" name="submit" value="Grafiksel Analiz" class="btn btn-primary btn-lg" id="Statistics" onClick="document.location.href='statistics.php'" />
</div>

<div class = "aciklama">
<p>Mağaza Verileri Tıklanarak Mağazanın Verilerine Ulaşılabilir...</p>
<p>Grafiksel Analiz Buttonuna Tıklanarak Ürünlerin Fiyatlarına Göre Grafiksel Analizine Ulaşılabilir...</p>
</div>

</body>
</html>
