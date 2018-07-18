import sys
import requests
import json
from pprint import pprint
from bs4 import BeautifulSoup
import os
from selenium import webdriver

storename = str(sys.argv[1])
dateInput = str(sys.argv[2])

gun = dateInput[:2]
ay = dateInput[3:5]
yıl = dateInput[6:]

#--------------------------------------------------------------    stores    --------------------------------------------------------------

browser = webdriver.Safari()
storelink = "https://profil.gittigidiyor.com/" + storename
browser.get(storelink)
soup = BeautifulSoup(browser.page_source, "html.parser")

review = soup.find("span", attrs={"class" : "total_evaluation"})
rate = soup.find("span", attrs={"class" : "positive_percentage"})
numberOfReviewsMonths = review.text.strip()
rateScore = rate.text.strip()

numReviews_array, avgPoints_array, criteria_array = [], [], []
numCriteria = soup.find_all("div", attrs={"class" : "col width-4of16 puan_count"})
print("Mağazanın puanlama, değerlendirme ve kriterleri işleniyor..")

k=0
for k in range(len(numCriteria)):
    criteria = soup.find_all("div", attrs={"class" : "col width-8of16 color_8e"})[k]
    avgPoint = soup.find_all("div", attrs={"class" : "col width-4of16 puan_y"})[k]
    numReview = soup.find_all("div", attrs={"class" : "col width-4of16 puan_count"})[k]
    criteria_array.append(criteria.text)
    avgPoints_array.append(avgPoint.text)
    numReviews_array.append(numReview.text)

filename_store = storename + "_store" + ".json"
file_store = open(filename_store, "w")

json_data_store = { storelink: {
                "numberOfReviewsMonths" : numberOfReviewsMonths,
                "positiveScoreRate" : rateScore,
                "criterias": {
                    "criteria": {
                        "label1" : criteria_array[0], "averagePoint1" : avgPoints_array[0], "numberOfReviews1" : numReviews_array[0],
                        "label2" : criteria_array[1], "averagePoint2" : avgPoints_array[1], "numberOfReviews2" : numReviews_array[1],
                        "label3" : criteria_array[2], "averagePoint3" : avgPoints_array[2], "numberOfReviews3" : numReviews_array[2],
                        "label4" : criteria_array[3], "averagePoint4" : avgPoints_array[3], "numberOfReviews4" : numReviews_array[3],
                        "label5" : criteria_array[4], "averagePoint5" : avgPoints_array[4], "numberOfReviews5" : numReviews_array[4]
                    }
                }
             }
         }

json.dump(json_data_store, file_store)
file_store.close()

#--------------------------------------------------------------    products    --------------------------------------------------------------

arama = "/arama/?satici="
urlProducts = "https://www.gittigidiyor.com" + arama + storename
r2 = requests.get(urlProducts)
soup2 = BeautifulSoup(r2.content, "lxml")
filename_products = storename + "_products" + ".json"
productCount = soup2.find_all("p", attrs={"itemprop" : "price"})


#1.page name,price
productNames, productPrices = [], []
i=0
for i in range(len(productCount)):
    productName = soup2.find_all("span", attrs={"itemprop" : "name"})[i].text
    productPrice = soup2.find_all("p", attrs={"itemprop" : "price"})[i].text.strip()
    productNames.append(productName)
    productPrices.append(productPrice)


#1.page category,shipment
count=0
productCategories, productShipments = [], []
urlProduct = soup2.find("ul", attrs={"class" : "catalog-view clearfix products-container"})
for a in urlProduct.find_all('a', href=True):
    urlEachProduct = "https:" + a['href']
    r3 = requests.get(urlEachProduct)
    soup3 = BeautifulSoup(r3.content, "lxml")
    productCategory = soup3.find("ul", attrs={"class" : "clearfix hidden-m hidden-breadcrumb robot-productPage-breadcrumb-hiddenBreadCrumb"}).text.strip()
    productCategories.append(productCategory)
    productShipment = soup3.find("div", attrs={"class" : "clearfix CargoInfos"}).text.strip()
    productShipments.append(productShipment)
    count = count + 1
    print("1.sayfadaki " + str(count) + ". ürün işleniyor..")
print(count)


#nextpages for name,category,shipment,price
urlNewPage = soup2.find("li", attrs={"class" : "next-link"})
next_page = urlNewPage.find('a', href=True)
next_page_str = next_page['href']
print (next_page_str)
sayfa = next_page_str.split(storename,1)[1]
print (sayfa)

while(next_page != None):
    urlEachProduct = urlProducts + sayfa
    r2_next = requests.get(urlEachProduct)
    soup2_next = BeautifulSoup(r2_next.content, "lxml")
    i_next=0
    productCount = soup2_next.find_all("p", attrs={"itemprop" : "price"})
    for i_next in range(len(productCount)):
        productName = soup2_next.find_all("span", attrs={"itemprop" : "name"})[i_next].text
        productPrice = soup2_next.find_all("p", attrs={"itemprop" : "price"})[i_next].text.strip()
        productNames.append(productName)
        productPrices.append(productPrice)

    urlEachProduct = urlProducts + sayfa
    r_next = requests.get(urlEachProduct)
    soup_next = BeautifulSoup(r_next.content, "lxml")
    urlProduct_next = soup_next.find("ul", attrs={"class" : "catalog-view clearfix products-container"})
    for a in urlProduct_next.find_all('a', href=True):
            urlEachProduct_next = "https:" + a['href']
            r7 = requests.get(urlEachProduct_next)
            soup7 = BeautifulSoup(r7.content, "lxml")
            productCategory = soup7.find("ul", attrs={"class" : "clearfix hidden-m hidden-breadcrumb robot-productPage-breadcrumb-hiddenBreadCrumb"}).text.strip()
            productCategories.append(productCategory)
            productShipment = soup7.find("div", attrs={"class" : "clearfix CargoInfos"}).text.strip()
            productShipments.append(productShipment)
            count = count + 1
            print(str(sayfa) + ". sayfadaki " + str(count) + ". ürün işleniyor..")
    urlNewPage = soup_next.find("li", attrs={"class" : "next-link"})
    if urlNewPage == None:
        break
    next_page = urlNewPage.find('a', href=True)
    next_page_str = next_page['href']
    print (next_page_str)
    sayfa = next_page_str.split(storename,1)[1]
    print (str(sayfa) + ". ürün sayfasına geçildi.")


#store json
json_data_product = { "products" : {"product" : [{"name" : n, "price" : p, "category" : c, "shipment" : s} for n,p,c,s in zip(productNames,productPrices,productCategories,productShipments)]}}
with open(filename_products, 'w') as f:
    json.dump(json_data_product, f,ensure_ascii=False)


#--------------------------------------------------------------    comments    --------------------------------------------------------------
sayfaSayisi = 0
var = 1
daTeSayisi = 0 #2018 içeren Date sayisi


'''
filename = storename + "_comments" + ".json"

if os.path.isfile(filename):
	with open(filename) as data_file:
		dataArray = []
		dataArray = json.load(data_file)
			
		print(dataArray['comments']['comment'][12]['dateTime'])
'''			

while var < 1000:
	x = str(var)
	url_Comments= "https://profil.gittigidiyor.com/"+storename+"/aldigi-yorumlar/satis?sf=" + x + "#yorum"
	r_Comments = requests.get(url_Comments)
	soup_Comments = BeautifulSoup(r_Comments.content, "lxml")
	dates_kontrol = soup_Comments.find_all("p",attrs={"class":"mt10"})
	for daTe in dates_kontrol:
		daTe_str = str(daTe.text)
		if "/2017" in daTe_str:
			var = 1000
			break
		if "/2018" not in daTe_str:
			continue
		else:
			daTeSayisi = daTeSayisi + 1
			continue
	sayfaSayisi = sayfaSayisi + 1
	var = var + 1
print("Son 6 aylık yorum sayısı:"+str(daTeSayisi))
#print(sayfaSayisi)


comments_array, reviewers_array, dates_array,productsName_array, mood_array = [], [], [], [],[]
j=1 #sayfa
q=0 #dateler için
p=0 #productName için
while j < sayfaSayisi:
	m = str(j)
	url= "https://profil.gittigidiyor.com/"+storename+"/aldigi-yorumlar/satis?sf=" + m + "#yorum"
	#print(url)
	r = requests.get(url)
	soup = BeautifulSoup(r.content, "lxml")
	dates = soup.find_all("p",attrs={"class":"mt10"})
	productNames = soup.find_all("a",attrs={"class":"bold"})
	print(m + ". yorum sayfası işleniyor")
	j = j + 1
	for i in range(20):
		mood = soup.find_all("div",attrs={"class":"col width-1of24 mt5"})[i]
		reviewer = soup.find_all("p", attrs={"class":"bold"})[i].text
		comment = soup.find_all("p",attrs={"class":"comment_content"})[i].text
		comments_array.append(comment)
		reviewers_array.append(reviewer)
		stringMood = str(mood)
		if stringMood.find('prf09') != -1:
			mood_array.append("Mutlu")
		elif stringMood.find('prf10') != -1:
			mood_array.append("Üzgün")
		else:
			mood_array.append("Kızgın")

	while q < len(dates):
		date = soup.find_all("p",attrs={"class":"mt10"})[q].text
		q = q + 1
		if "Profil" in date:
			continue
		if "/2018" not in date:
			continue	
		dateGun = date[:2]
		dateAy = date[3:5]
		dateYıl = date[6:]
		if dateYıl >= yıl:
			if dateAy > ay:
				dates_array.append(str(date))
				continue
			if dateAy == ay:
				if dateGun >= gun:
					dates_array.append(str(date))
					continue
		j = sayfaSayisi
		break

					

	while p < len(productNames):
		productName = soup.find_all("a",attrs={"class":"bold"})[p].text
		p = p + 1
		if "Tüm" in productName:
			continue
		productsName_array.append(productName)
	q=0
	p=0

filename_comments = storename + "_comments" + ".json"
file_comments = open(filename_comments, "w")

json_data_comments = { "comments": { "comment" : [{"reviewer": r, "dateTime": d, "productName": p , "mood" : m, "text": t} for r,d,p,m,t in zip (reviewers_array,dates_array,productsName_array,mood_array,comments_array)]}}
with open(filename_comments,'w') as f:
	json.dump(json_data_comments, f,ensure_ascii=False)

