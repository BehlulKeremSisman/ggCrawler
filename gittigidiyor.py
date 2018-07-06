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
criterias = soup.find_all("div", attrs={"class" : "col width-8of16 color_8e"})
avgPoints = soup.find_all("div", attrs={"class" : "col width-4of16 puan_y"})
numReviews = soup.find_all("div", attrs={"class" : "col width-4of16 puan_count"})

numberOfReviewsMonths = review.text.strip()
rateScore = rate.text.strip()
criteria_array = []
countCriteria = 0
for criteria in criterias:
    criteria_array.append(criteria.text)
    countCriteria = countCriteria + 1
avgPoints_array = []
countavgPoint = 0
for avgPoint in avgPoints:
    avgPoints_array.append(avgPoint.text)
    countavgPoint = countavgPoint + 1
numReviews_array = []
countnumReview = 0
for numReview in numReviews:
    numReviews_array.append(numReview.text)
    countnumReview = countnumReview + 1

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

urlProduct = "https://www.gittigidiyor.com/arama/?satici=" + storename
r2 = requests.get(urlProduct)
soup2 = BeautifulSoup(r2.content, "lxml")
filename_products = storename + "_products" + ".json"
productCount = soup2.find_all("p", attrs={"itemprop" : "price"})

productNames, productPrices, productShipments = [], [], []
i=0
for i in range(len(productCount)):
    productName = soup2.find_all("span", attrs={"itemprop" : "name"})[i].text
    productPrice = soup2.find_all("p", attrs={"itemprop" : "price"})[i].text.strip()
    #productShipment = soup2.find_all("li", attrs={"class" : "shippingFree"})[i].text.strip()
    productNames.append(productName)
    productPrices.append(productPrice)
    #productShipments.append(productShipment)


json_data_product = { "products" : {"product" : [{"name" : n, "price" : p} for n,p in zip(productNames,productPrices)]}}
with open(filename_products, 'w') as f:
    json.dump(json_data_product, f,ensure_ascii=False)
