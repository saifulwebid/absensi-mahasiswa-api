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


### GET /absensi/allabsensi/{nim}
Live :  http://api-v2-absensi-mahasiswa.azurewebsites.net/absensi/allabsensi/{nim}

Menampilkan riwayat absensi pada mahasiswa dengan nim tertentu. Digunakan untuk user mahasiswa.


### GET /absensi/totaljam/{nim}/keterangan/{keterangan}
Live :    http://api-v2-absensi-mahasiswa.azurewebsites.net/absensi/totaljam/{nim}/keterangan/{keterangan}

Memberikan total jam pada kategori absen tertentu (S/I/A) pada nim tertentu. Digunakan pada screen user mahasiswa.


### GET /absensi/totaljamperkelas/{id_kelas}/tanggal/{tanggal}
Live: http://api-v2-absensi-mahasiswa.azurewebsites.net/absensi/totaljamperkelas/{id_kelas}/tanggal/{tanggal}

memberikan list daftar nama pada kelas tertentu dengan total sakit izin dan alpha. Digunakan untuk screen user TU.

### GET /absensi/totaljamkeseluruhan/{nim}
Live :     http://api-v2-absensi-mahasiswa.azurewebsites.net/absensi/totaljamkeseluruhan/{nim}

Memberikan keterangan total jam akumulasi dari izin sakit dan alpha pada nim tertentu. Digunakan pada screen user mahasiswa.

### POST /absensi/allabsensi

Live: http://api-v2-absensi-mahasiswa.azurewebsites.net/absensi/allabsensi

Mencatat ketidakhadiran mahasiswa.

Format input sebagai berikut:

```json
{
	"nim": "141524020",
	"tanggal": "2016-06-14",
	"absensi": [
		{"jam": 3, "keterangan": "S"},
		{"jam": 4, "keterangan": "I"},
		{"jam": 5, "keterangan": "A"}
	]
}
```

Kalau hanya satu jam tidak masuknya, formatnya tetap array, sebagai berikut:

```json
{
	"nim": "141524020",
	"tanggal": "2016-06-14",
	"absensi": [
		{"jam": 3, "keterangan": "S"}
	]
}
```

Respon sistem jika berhasil adalah sebagai berikut:

```json
{
    "success": true,
    "message": "Absensi berhasil dicatat."
}
```

### GET /mahasiswa/{nim}

Live: http://api-v2-absensi-mahasiswa.azurewebsites.net/mahasiswa/{nim}

Digunakan untuk mengambil data pribadi mahasiswa beserta kelas yang sedang aktif saat ini.