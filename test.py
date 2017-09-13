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
  
    conn = pymysql.connect(host='localhost', user='example3_rentrec', passwd='password1234', db='example3_rentreq')
    cur = conn.cursor(pymysql.cursors.DictCursor)
    propertySimilarity = conn.cursor(pymysql.cursors.DictCursor)
    cur.execute("SELECT User_ID, ChildPreference, Furnished, Garden, DisabledAccess,Driveway,Smokerfriendly,PetFriendly,NoOfRooms,propertyType FROM tenant")
    sorteddict = {}
    propertyType = " "
    y_pred = []
    y_true = []
    for row in cur:
        if (row["User_ID"] == target_user):
            y_pred = [row["User_ID"],row["ChildPreference"],row["Furnished"],row["Garden"],row["DisabledAccess"],row["Driveway"],row["Smokerfriendly"],row["PetFriendly"],row["NoOfRooms"]]
            
            propertyType = row["propertyType"]
        else:
            y_true.append( [row["User_ID"],row["ChildPreference"],row["Furnished"],row["Garden"],row["DisabledAccess"],row["Driveway"],row["Smokerfriendly"],row["PetFriendly"],row["NoOfRooms"]])  
    for i in y_true:
        sorteddict[i[0]] = jaccard_similarity_score(i[1:],y_pred[1:])

    sorteddict = [(v, k) for k, v in sorteddict.items()]
    sorteddict.sort()
    sorteddict.reverse()
    sorteddict = [(k, v) for v, k in sorteddict]
    count = 0
    currentproperties =[]
    propertySuggestions = []
    sorteddict = sorteddict[0:10]    
    for key in sorteddict:
        propertySimilarity.execute("SELECT advert.advert_ID, advert.bedroom FROM shortlist JOIN advert ON shortlist.advert_ID = advert.advert_ID WHERE shortlist.user_ID = "+str(key[0])+ " AND advert.propertyType ="+'"'+propertyType+'" AND advert.bedroom BETWEEN 3 AND 4')
        
        for propertyreturned in propertySimilarity:
               
            if not propertyreturned["advert_ID"] in currentproperties:  
                count = count + 1
                propertySuggestions.append(propertyreturned)
                currentproperties.append(propertyreturned)
    shuffle(propertySuggestions)
    print(len(propertySuggestions))
  	

    conn.close()     
if __name__ == "__main__":
    main(sys.argv[1:])