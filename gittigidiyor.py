import requests
import json
from bs4 import BeautifulSoup
from selenium import webdriver

browser = webdriver.Safari()
browser.get("https://profil.gittigidiyor.com/teknorya")
soup = BeautifulSoup(browser.page_source, "html.parser")


review = soup.find("span", attrs={"class" : "total_evaluation"})
rate = soup.find("span", attrs={"class" : "positive_percentage"})
criteria = soup.find_all("div", attrs={"class" : "col width-8of16 color_8e"})[1]
badge = str(soup.find("div", attrs={"class" : "badge_container"}))

if badge.find("19") != -1:
    badge2 = "Cok basarili"
elif badge.find("18") != -1:
    badge2 = "Basarili"
else:
    badge2 = "Rozet yok"


numberOfReviews = review.text.strip()
rateScore = rate.text.strip()
criterias = criteria.text

file = open("output.json", "w")
output = {"Teknorya": {"Number of reviews":numberOfReviews, "Positive score rate":rateScore, "criterias":criterias, "badge": badge2}}
json.dump(output, file)
file.close()

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


print("Number of reviews in the last 12 months: {}\nPositive score rate during the last 12 months: {}\nCriterias: {}\nBadge: {}\nProducts: {}\nPrice: {}".format(
    numberOfReviews,
    rateScore,
    criterias,
    badge2,
    productName,
    productPrice
))
