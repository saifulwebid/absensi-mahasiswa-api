# API Gateway

API Gateway dapat diakses di [http://api-v2-absensi-mahasiswa.azurewebsites.net/](http://api-v2-absensi-mahasiswa.azurewebsites.net/).

## Endpoints

### GET /kelas

Live: http://api-v2-absensi-mahasiswa.azurewebsites.net/kelas/

Menampilkan semua kelas yang aktif di semester ini.

### GET /kelas/{id}/mahasiswa

Live: http://api-v2-absensi-mahasiswa.azurewebsites.net/kelas/{id}/mahasiswa

Menampilkan semua kelas yang aktif di semester ini.

{id} diambil dari ID kelas yang diperoleh dari **GET /kelas**.

### POST /login

Live: http://api-v2-absensi-mahasiswa.azurewebsites.net/login

Melakukan login. Request harus berupa format berikut:

```JSON
{
	"username": "141524020",
	"password": "contohPassword"
}
```

Jika username benar dan user tersebut merupakan mahasiswa, balasannya sebagai berikut:

```JSON
{
    "success": true,
    "type": "mahasiswa"
}
```

Jika username benar dan user tersebut merupakan staf TU, balasannya sebagai berikut:

```json
{
    "success": true,
    "type": "tu"
}
```

Jika username dan/atau password salah, balasannya sebagai berikut:

```json
{
    "success": false,
    "message": "Username dan/atau password tidak ditemukan"
}
```

### GET /status

Live: http://api-v2-absensi-mahasiswa.azurewebsites.net/status

Menunjukkan status apakah sekarang sedang login atau tidak.

Format jika sedang login sebagai mahasiswa, sebagai TU, atau tidak login akan berbeda-beda. Tetapi semua punya kesamaan: ada atribut status.

Silakan dicoba dengan kondisi sudah login atau belum.

### GET /logout

Live: http://api-v2-absensi-mahasiswa.azurewebsites.net/logout

Melakukan logout dari sistem.

Response sistem tidak penting, tetapi boleh dilihat.

### GET /me/absensi

Live: http://api-v2-absensi-mahasiswa.azurewebsites.net/me/absensi

Wajib dilakukan setelah **login sebagai mahasiswa**.


### GET  /absensi/rekapsemester/{id_kelas}/idsemester/{id_semester}
Live : http://api-v2-absensi-mahasiswa.azurewebsites.net/absensi/rekapsemester/{id_kelas}/idsemester/{id_semester}

Menampilkan hasil rekap absen satu semester pada kelas tertentu berdasarkan parameter id kelas dan id semesternya. Dipaggil untuk format user TU.
contoh keluaran :

[{"nim":"141524001","nama":"Andre Febrianto S","totaljam":1},{"nim":"141524002","nama":"Anggi Nur Damayanty","totaljam":0},{"nim":"141524003","nama":"Eki Fauzi Firdaus","totaljam":0},{"nim":"141524004","nama":"Eva Danti Rahmanita","totaljam":0},{"nim":"141524005","nama":"Fadhlan Ridwanallah","totaljam":0},{"nim":"141524006","nama":"Fahmi Ramadhan","totaljam":0},{"nim":"141524007","nama":"Fariz Aotearoa Rasyid","totaljam":0},{"nim":"141524008","nama":"Hendro Saputro","totaljam":0},{"nim":"141524009","nama":"Hilda Annisa Nur Mauludin","totaljam":0},{"nim":"141524010","nama":"Ibnu Ali Mukhtarom","totaljam":0},{"nim":"141524011","nama":"Ifan Dhani Prasojo","totaljam":0},{"nim":"141524012","nama":"M Imam Fauzan PPN","totaljam":0},{"nim":"141524013","nama":"Maulana Kahfi","totaljam":0},{"nim":"141524014","nama":"Moch Arief Febriansyah","totaljam":0},{"nim":"141524015","nama":"Muhammad Rakasiwi Makkah","totaljam":0},{"nim":"141524016","nama":"Muhammad Ganjar Immanudin","totaljam":0},{"nim":"141524017","nama":"Muhammad Husain Fadhlullah","totaljam":0},{"nim":"141524018","nama":"Muhammad Ihyaul Khair","totaljam":0},{"nim":"141524019","nama":"Muhammad Rubiyanto Permana","totaljam":0}]


### GET /absensi/allabsensi/{nim}
Live :  http://api-v2-absensi-mahasiswa.azurewebsites.net/absensi/allabsensi/{nim}

Menampilkan riwayat absensi pada mahasiswa dengan nim tertentu. Digunakan untuk user mahasiswa.
contoh keluaran :

[{"tanggal":"2017-06-13","jam":1,"keterangan":"S"},{"tanggal":"2017-06-13","jam":1,"keterangan":"I"},{"tanggal":"2017-06-13","jam":2,"keterangan":"A"}]


### GET /absensi/totaljam/{nim}/keterangan/{keterangan}
Live :    http://api-v2-absensi-mahasiswa.azurewebsites.net/absensi/totaljam/{nim}/keterangan/{keterangan}

Memberikan total jam pada kategori absen tertentu (S/I/A) pada nim tertentu. Digunakan pada screen user mahasiswa.
contoh keluaran :

{"jam":1}


### GET /absensi/totaljamperkelas/{id_kelas}/tanggal/{tanggal}
Live :     http://api-v2-absensi-mahasiswa.azurewebsites.net/absensi/totaljamperkelas/{id_kelas}/tanggal/{tanggal}

memberikan list daftar nama pada kelas tertentu dengan total sakit izin dan alpha. Digunakan untuk screen user TU.
contoh keluaran :
[{"nim":"141524001","nama":"Andre Febrianto S","kelas":"3A","totaljamsakit":0,"totaljamijin":0,"totaljamalpha":0},{"nim":"141524002","nama":"Anggi Nur Damayanty","kelas":"3A","totaljamsakit":0,"totaljamijin":0,"totaljamalpha":0},{"nim":"141524003","nama":"Eki Fauzi Firdaus","kelas":"3A","totaljamsakit":0,"totaljamijin":0,"totaljamalpha":0},{"nim":"141524004","nama":"Eva Danti Rahmanita","kelas":"3A","totaljamsakit":1,"totaljamijin":1,"totaljamalpha":1},{"nim":"141524005","nama":"Fadhlan Ridwanallah","kelas":"3A","totaljamsakit":0,"totaljamijin":0,"totaljamalpha":0},{"nim":"141524006","nama":"Fahmi Ramadhan","kelas":"3A","totaljamsakit":0,"totaljamijin":0,"totaljamalpha":0},{"nim":"141524007","nama":"Fariz Aotearoa Rasyid","kelas":"3A","totaljamsakit":0,"totaljamijin":0,"totaljamalpha":0},{"nim":"141524008","nama":"Hendro Saputro","kelas":"3A","totaljamsakit":0,"totaljamijin":0,"totaljamalpha":0},{"nim":"141524009","nama":"Hilda Annisa Nur Mauludin","kelas":"3A","totaljamsakit":0,"totaljamijin":0,"totaljamalpha":0},{"nim":"141524010","nama":"Ibnu Ali Mukhtarom","kelas":"3A","totaljamsakit":0,"totaljamijin":0,"totaljamalpha":0},{"nim":"141524011","nama":"Ifan Dhani Prasojo","kelas":"3A","totaljamsakit":0,"totaljamijin":0,"totaljamalpha":0},{"nim":"141524012","nama":"M Imam Fauzan PPN","kelas":"3A","totaljamsakit":0,"totaljamijin":0,"totaljamalpha":0},{"nim":"141524013","nama":"Maulana Kahfi","kelas":"3A","totaljamsakit":0,"totaljamijin":0,"totaljamalpha":0},{"nim":"141524014","nama":"Moch Arief Febriansyah","kelas":"3A","totaljamsakit":0,"totaljamijin":0,"totaljamalpha":0},{"nim":"141524015","nama":"Muhammad Rakasiwi Makkah","kelas":"3A","totaljamsakit":0,"totaljamijin":0,"totaljamalpha":0},{"nim":"141524016","nama":"Muhammad Ganjar Immanudin","kelas":"3A","totaljamsakit":0,"totaljamijin":0,"totaljamalpha":0},{"nim":"141524017","nama":"Muhammad Husain Fadhlullah","kelas":"3A","totaljamsakit":0,"totaljamijin":0,"totaljamalpha":0},{"nim":"141524018","nama":"Muhammad Ihyaul Khair","kelas":"3A","totaljamsakit":0,"totaljamijin":0,"totaljamalpha":0},{"nim":"141524019","nama":"Muhammad Rubiyanto Permana","kelas":"3A","totaljamsakit":0,"totaljamijin":0,"totaljamalpha":0}]



### GET /absensi/totaljamkeseluruhan/{nim}
Live :     http://api-v2-absensi-mahasiswa.azurewebsites.net/absensi/totaljamkeseluruhan/{nim}

Memberikan keterangan total jam akumulasi dari izin sakit dan alpha pada nim tertentu. Digunakan pada screen user mahasiswa.

contoh keluaran :
{"jam":3}