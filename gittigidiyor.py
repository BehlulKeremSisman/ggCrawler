import requests
from bs4 import BeautifulSoup

r = requests.get("https://profil.gittigidiyor.com/arcelik")
soup = BeautifulSoup(r.content, "lxml")

storeName = soup.find("div", attrs={"class" : "short_info"})

print(storeName.span.text)
