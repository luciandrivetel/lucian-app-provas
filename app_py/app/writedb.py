import sqlite3

db = "./database/database.db"

def use_db(action: str, table: str, params: tuple = None):
    try:
        conn = sqlite3.connect(db)
        cursor = conn.cursor()
        if action == "create":
            cursor.execute(f"""
            CREATE TABLE IF NOT EXISTS {table} (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nome TEXT NOT NULL,
            referencia TEXT NOT NULL,
            data DATE NOT NULL,
            comment TEXT)""")
            conn.commit()
            return "Base de dados criada."
        elif action == "write" and (params is not None):
            cursor.execute(f"""
            INSERT INTO {table} VALUES(NULL, ?, ?, ?, ?)""", params)
            conn.commit()
            return 0
        elif action == "read" and (params is not None):
            cursor.execute(f"""
            SELECT nome, referencia, data, comment FROM {table} WHERE STRFTIME('%Y-%m', data) = ?""", params)        #('03', ) exemplu params pt luna martie
            rows = cursor.fetchall()
            return rows
        elif action == "search" and (params is not None):
            cursor.execute(f"SELECT * FROM {table} WHERE nome LIKE ? OR referencia LIKE ?", params)
            rows = cursor.fetchall()
            return rows
    except sqlite3.Error as error:
        return 1
    finally:
        if conn: conn.close()


