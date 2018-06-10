import requests
import json
from bs4 import BeautifulSoup

url = "https://profil.gittigidiyor.com/bayanjasmin"
r = requests.get(url)
soup = BeautifulSoup(r.content, "html.parser")

review = soup.find("span", attrs={"class" : "total_evaluation"})
rate = soup.find("span", attrs={"class" : "positive_percentage"})
criteria = soup.find("div", attrs={"class" : "col_width-8of16_color_8e"})

#ornek kullanim: filmTablosu = soup.find("table".attrs={"class:"ustcizgi"}).select("tr:nth-of-type(2) > td > table:nth-of-type(3) > tr")
#bu ornek class degeri ustcizgi olan table altindaki 2.tr'nin altindaki td'nin altindaki 3.table'in altindaki tr'yi cekmeye yarar
numberOfReviews = review.text.strip()
rateScore = rate.text.strip()
criterias = criteria

print("Number of reviews in the last 12 months: {}\nPositive score rate during the last 12 months: {}\nCriterias: {}".format(
    numberOfReviews,
    rateScore,
    criterias
))

file = open("output.json", "w")
output = {"magaza": [{"Number of reviews":numberOfReviews, "Positive score rate":rateScore, "criterias":criterias}]}
json.dump(output, file)
file.close()
