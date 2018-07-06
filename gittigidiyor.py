import sys
import requests
import json
from bs4 import BeautifulSoup
from selenium import webdriver

storename = str(sys.argv[1])

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
