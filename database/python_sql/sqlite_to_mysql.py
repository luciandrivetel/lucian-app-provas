import pymysql
import sqlite3
from datetime import datetime

sqlitedb = r"C:\Projetos\AppProofs\database\database.sqlite"

with sqlite3.connect(sqlitedb) as conn:
    cursorlite = conn.cursor()

query = "SELECT * FROM proofs"

data = cursorlite.execute(query).fetchall()

new_lines = [(line[1], line[2], datetime.strptime(line[3], "%Y-%m-%d").strftime("%Y-%m-%d %H:%M:%S"), line[3]) for line in data]

for line in new_lines:
    print(line)




# conn = pymysql.connect(
#     host="127.0.0.1",
#     port=3306,
#     user="username",
#     password="userpass",
#     database="provas",
#     charset="utf8mb4"
# )

