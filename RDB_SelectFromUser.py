import mysql.connector


# User names and passwords for db connection
dbuser="u413142534_robotworks"
dbpwd="two1x/Y9"
dbaddress="srv557.hstgr.io"
dbname="u413142534_robotworksdb"
#make connection
cnx = mysql.connector.connect(user=dbuser, password=dbpwd,
                              host=dbaddress,
                              database=dbname)

print("Select all from User table")

#need to have this in a try block in case the connect didn't work
try:
    #start a database cursor
   cursor = cnx.cursor()

   #send in SQL
   cursor.execute("""
      SELECT * from User;
   """)
   tables = cursor.fetchall()
   if tables:
      print(f"Data in User Table:")
      for table in tables:
         print(table[0], table[1], table[2])
   else:
      print(f"Error connecting to DB.")

   
#always execute the finally block even if the try breaks
       #(There are a limited number of db connections per hour on the system --I think 500 for my Hostinger site)
       # Always close the connection to free up connections on the DB.
finally:
    cnx.close()
