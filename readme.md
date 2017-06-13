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



