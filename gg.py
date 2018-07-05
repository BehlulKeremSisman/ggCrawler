import requests
import json
from json import dumps, loads, JSONEncoder, JSONDecoder
from bs4 import BeautifulSoup
from selenium import webdriver

browser = webdriver.Safari()
browser.get("https://profil.gittigidiyor.com/teknorya")
soup5 = BeautifulSoup(browser.page_source, "html.parser")

criteria = soup5.find("div", attrs={"class" : "puan_ayrac"})

print("Criteria: {}".format(
    criteria
))
