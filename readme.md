# API Gateway

API Gateway dapat diakses di [http://api-v2-absensi-mahasiswa.azurewebsites.net/](http://api-v2-absensi-mahasiswa.azurewebsites.net/).

## Endpoints

### GET /kelas

Menampilkan semua kelas yang aktif di semester ini.

Live: http://api-v2-absensi-mahasiswa.azurewebsites.net/kelas/

### GET /kelas/{id}/mahasiswa

Menampilkan semua kelas yang aktif di semester ini.

Live: http://api-v2-absensi-mahasiswa.azurewebsites.net/kelas/{id}/mahasiswa

{id} diambil dari ID kelas yang diperoleh dari **GET /kelas**.

