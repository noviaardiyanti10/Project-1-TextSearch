import os
import mysql.connector as con #install dulu di terminal menggunakan command berikut : python -m pip install mysql-connector-python

#FILE BOLEH DITAMBAH DALAM FOLDER DOKUMENBASABALI DENGAN FORMAT NAMA YANG DILANJUTKAN (docX.txt), DAN PASTIKAN MENGGUNAKAN ENCODING "UTF-8"
#melakukan pengambilan file dan data file
cwd = os.getcwd() #path direktori program kita
len_dir = len(os.listdir('DokumenBasaBali')) #jumlah file dokumen
data = []
for i in range(1, len_dir + 1): #looping memasukkan data judul dan isi file ke array
    title = str(i) + ".txt" #mengambil judul
    path = cwd + "\DokumenBasaBali\doc" + str(i) + ".txt" #mengambil path
    f = open(path, 'r', encoding='utf8') #membaca file dalam path
    lines = f.readlines() #membaca semua isi file, kembalian dalam bentuk list tiap line
    content = ''.join(lines) #menggabungkan tiap line dalam yang berbentuk list
    f.close() 
    res = [title, content]
    data.append(res) #menambahkan ke list data
print('Berhasil mengambil semua data pada direktori ' + cwd + '\DokumenBasaBali\\')

class database: #membuat class untuk operasi dalam database

    def __init__(self,nama,data): 
        self.nama = nama
        self.data = data

    def create_db(self): #membuat database
        db = con.connect(
            host="localhost",
            user="root",
            password=""
        )
        cur = db.cursor()
        query = "CREATE DATABASE " + self.nama
        cur.execute(query)
        print("Database", self.nama, "was created.")
    
    def connection(self): #menyesuaikan koneksi dengan database yang telah dibuat
        self.db = con.connect(
            host="localhost",
            user="root",
            password="",
            database=str(self.nama)
        )
        self.cur = self.db.cursor()

    def create_table(self): #membuat tabel dokumen
        query = "CREATE TABLE dokumen (id INT AUTO_INCREMENT PRIMARY KEY, judul VARCHAR(255), isi TEXT)"
        self.cur.execute(query)
        print("Table dokumen was created.")

    def insert(self): #menambahkan data ke tabel dokumen
        query = "INSERT INTO dokumen (judul, isi) VALUES (%s, %s)"
        value = [tuple(d) for d in self.data]
        self.cur.executemany(query, value)
        self.db.commit()
        print(self.cur.rowcount, " record was inserted.")


nama_db = "text_search" #ganti nama db disini
mydb = database(nama_db, data)
mydb.create_db()
mydb.connection()
mydb.create_table()
mydb.insert()