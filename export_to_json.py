#!/usr/bin/env python3

import sqlite3
import json
from datetime import datetime

db = sqlite3.connect('data/name-days.sqlite')
cursor = db.cursor()

try:
    cursor.execute("SELECT * FROM calendar")

    data = {}
    for row in cursor.fetchall():
        date = datetime.strptime(row[0], '%Y-%m-%d')
        month = date.strftime('%m')
        day = date.strftime('%d')
        names = row[1].split(', ')
        
        if month not in data:
            data[month] = {}
        data[month][day] = names

    with open('data/name-days.json', 'w', encoding='utf-8') as json_file:
        json.dump(data, json_file, ensure_ascii=False, indent=2)

    print("Done")

except sqlite3.Error as e:
    print("SQLite error:", e)

finally:
    db.close()
