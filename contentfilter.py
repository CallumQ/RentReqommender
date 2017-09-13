#!/usr/bin/env python

import pymysql
import copy
import getopt
import sys
from random import shuffle
from scipy.stats import spearmanr
from sklearn.metrics import jaccard_similarity_score


def main(argv):
    target_user = 0
    try:
        opts, args = getopt.getopt(argv,"u:")
    except getopt.Getopterror:
        print("error")
        sys.exit(2)
    for opt,arg in opts:
        if opt =='-u':
            target_user = arg
            target_user = int(target_user)
  
    conn = pymysql.connect(host='localhost', user='root', passwd='root', db='rentreq')
    cur = conn.cursor(pymysql.cursors.DictCursor)
    propertySimilarity = conn.cursor(pymysql.cursors.DictCursor)
    cur.execute("SELECT User_ID, ChildPreference, Furnished, Garden, DisabledAccess,Driveway,Smokerfriendly,PetFriendly,NoOfRooms,propertyType FROM tenant WHERE User_ID = " + str(target_user))
    sorteddict = {}
    propertyType = " "
    y_pred = []
    y_true = []
    for row in cur:
        if (row["User_ID"] == target_user):
            y_pred = [row["User_ID"],row["ChildPreference"],row["Furnished"],row["Garden"],row["DisabledAccess"],row["Driveway"],row["Smokerfriendly"],row["PetFriendly"],row["NoOfRooms"]]
            propertyType = row["propertyType"]  
    
    propertySimilarity.execute("SELECT * FROM advert where bedroom = 2 AND pricePerMonth  <= 500")
    for property in propertySimilarity:
        y_true.append([property["advert_ID"],property["childFriendly"],property["furnsihed"],property["garden"],property["disabled"],property["driveway"],property["smoker"],property["pet"],property["bedroom"]])
    
    
    
    
    
    
    
    
    for i in y_true:
        sorteddict[i[0]] = jaccard_similarity_score(i[1:],y_pred[1:])

        
        
        
        
        
        
        
        
        
        
        
        
        
        
    sorteddict = [(v, k) for k, v in sorteddict.items()]
    sorteddict.sort()
    sorteddict.reverse()
    sorteddict = [(k, v) for v, k in sorteddict]
    count = 0
    currentproperties =[]
    propertySuggestions = []
    sorteddict = sorteddict[0:100]    
    

    sorteddict = sorteddict[0:10]
  
   
    for item in sorteddict:
        print(item)
    print (y_pred)
    
    conn.close()     
if __name__ == "__main__":
    main(sys.argv[1:])