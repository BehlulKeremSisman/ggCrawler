import requests
import json
from bs4 import BeautifulSoup
from selenium import webdriver

browser = webdriver.Safari()
storename = "https://profil.gittigidiyor.com/teknorya"
browser.get(storename)

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



file = open("stores.json", "w")

output = {"stores": {
             storename: {
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
         }}


json.dump(output, file)
file.close()


#Product
urlProduct = "https://www.gittigidiyor.com/arama/?satici=teknorya"
r2 = requests.get(urlProduct)
soup2 = BeautifulSoup(r2.content, "lxml")
file = open("urunler.json", "w")
productCount = soup2.find_all("p", attrs={"itemprop" : "price"})
i=0
for i in range(len(productCount)):
    productName = soup2.find_all("span", attrs={"itemprop" : "name"})[i].text
    productPrice = soup2.find_all("p", attrs={"itemprop" : "price"})[i].text.strip()
    urunler = {"TeknoryaUrunler": {"Name":productName, "Price":productPrice}}
    json.dump(urunler, file)

file.close()
