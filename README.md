install library https://docs.guzzlephp.org/en/stable/quickstart.html untuk client

## Dokumentasi API: `getall.php`

### Deskripsi
Skrip PHP ini menangani permintaan HTTP GET untuk mengambil data pengguna dari basis data. Skrip ini juga memverifikasi keberadaan dan validitas kunci API (API key) sebelum memberikan akses data.

### Endpoints
- **URL**: `localhost://restful-api-php-mysql/latihan/getall.php`
- **Metode HTTP**: GET

### Header
- `Content-Type`: `application/json` — Menentukan bahwa respons akan dikembalikan dalam format JSON.
- `Access-Control-Allow-Methods`: `GET` — Mengizinkan metode HTTP GET.
- `Access-Control-Allow-Origin`: `*` — Mengizinkan akses dari semua domain.

### Parameter

**Header Request:**
- `api-key` — Kunci API yang digunakan untuk otentikasi. = key-thoriq

### Respon

**Jika permintaan berhasil:**
- **Status Code**: `200 OK`
- **Isi Respons**:
  ```json
  [
    {
      "id": 1,
      "name": "John Doe",
      "email": "john.doe@example.com"
    },
    ...
  ]
  ```
  - Tipe data: Array of Objects.
  - Setiap objek mewakili pengguna dengan atribut seperti `id`, `name`, dan `email`.

**Jika metode HTTP bukan GET:**
- **Status Code**: `405 Method Not Allowed`
- **Isi Respons**:
  ```json
  {
    "message": "Method Harus Get"
  }
  ```

**Jika kunci API tidak valid:**
- **Status Code**: `403 Forbidden`
- **Isi Respons**:
  ```json
  {
    "message": "api-key tidak valid"
  }
  ```

**Jika tidak ada pengguna ditemukan:**
- **Status Code**: `404 Not Found`
- **Isi Respons**:
  ```json
  {
    "message": "User not found"
  }
  ```



Berikut adalah dokumentasi untuk skrip PHP yang menangani permintaan POST untuk menambahkan pengguna ke dalam basis data.

---

## Dokumentasi API: `create.php`

### Deskripsi
Skrip PHP ini menangani permintaan HTTP POST untuk menambahkan data pengguna baru ke dalam basis data. Skrip ini juga memverifikasi keberadaan dan validitas kunci API (API key) sebelum melakukan operasi penyimpanan data.

### Endpoints
- **URL**: `localhost://restful-api-key/latihan/create.php`
- **Metode HTTP**: POST

### Header
- `Content-Type`: `application/json` — Menentukan bahwa respons akan dikembalikan dalam format JSON.
- `Access-Control-Allow-Methods`: `POST` — Mengizinkan metode HTTP POST.
- `Access-Control-Allow-Origin`: `*` — Mengizinkan akses dari semua domain.

### Body Request
**Format**: JSON
- **`name`**: String — Nama pengguna yang akan ditambahkan.
- **`email`**: String — Alamat email pengguna yang akan ditambahkan.

**Contoh Request Body**:
```json
{
  "name": "John Doe",
  "email": "john.doe@example.com"
}
```

### Respon

**Jika permintaan berhasil:**
- **Status Code**: `201 Created`
- **Isi Respons**:
  ```json
  {
    "id": 123
  }
  ```
  - Tipe data: Objek.
  - Atribut `id` berisi ID pengguna yang baru ditambahkan.

**Jika metode HTTP bukan POST:**
- **Status Code**: `405 Method Not Allowed`
- **Isi Respons**:
  ```json
  {
    "message": "Method Not Allowed"
  }
  ```

**Jika kunci API tidak valid:**
- **Status Code**: `403 Forbidden`
- **Isi Respons**:
  ```json
  {
    "message": "api-key tidak valid"
  }
  ```

**Jika input tidak valid:**
- **Status Code**: `400 Bad Request`
- **Isi Respons**:
  ```json
  {
    "message": "invalid input"
  }
  ```

**Jika gagal menambah data:**
- **Status Code**: `500 Internal Server Error`
- **Isi Respons**:
  ```json
  {
    "message": "gagal menambah data"
  }
  ```

Berikut adalah dokumentasi untuk skrip PHP yang menangani permintaan PUT untuk memperbarui data pengguna di basis data.

---

## Dokumentasi API: `update.php`

### Deskripsi
Skrip PHP ini menangani permintaan HTTP PUT untuk memperbarui data pengguna yang ada di basis data. Skrip ini juga memverifikasi keberadaan dan validitas kunci API (API key) sebelum melakukan operasi pembaruan data.

### Endpoints
- **URL**: `localhost://restful-api-php-mysql/latihan/update.php`
- **Metode HTTP**: PUT

### Header
- `Content-Type`: `application/json` — Menentukan bahwa respons akan dikembalikan dalam format JSON.
- `Access-Control-Allow-Methods`: `PUT` — Mengizinkan metode HTTP PUT.
- `Access-Control-Allow-Origin`: `*` — Mengizinkan akses dari semua domain.

### Body Request
**Format**: JSON
- **`id`**: Integer — ID pengguna yang akan diperbarui.
- **`name`**: String — Nama pengguna baru.
- **`email`**: String — Alamat email pengguna baru.

**Contoh Request Body**:
```json
{
  "id": 123,
  "name": "Jane Doe",
  "email": "jane.doe@example.com"
}
```

### Respon

**Jika permintaan berhasil:**
- **Status Code**: `200 OK`
- **Isi Respons**:
  ```json
  {
    "message": "Berhasil updated"
  }
  ```
  - Tipe data: Objek.
  - Atribut `message` berisi konfirmasi bahwa data pengguna berhasil diperbarui.

**Jika metode HTTP bukan PUT:**
- **Status Code**: `400 Bad Request`
- **Isi Respons**:
  ```json
  {
    "message": "Method Harus Put"
  }
  ```

**Jika kunci API tidak valid:**
- **Status Code**: `403 Forbidden`
- **Isi Respons**:
  ```json
  {
    "message": "api-key tidak valid"
  }
  ```

**Jika data input tidak lengkap:**
- **Status Code**: `400 Bad Request`
- **Isi Respons**:
  ```json
  {
    "message": "data tidak ada"
  }
  ```

**Jika gagal memperbarui data:**
- **Status Code**: `500 Internal Server Error`
- **Isi Respons**:
  ```json
  {
    "message": "Failed to update user"
  }
  ```

### Alur Kerja

1. **Verifikasi Metode HTTP:**
   - Skrip memeriksa apakah metode permintaan adalah PUT. Jika tidak, skrip mengembalikan kode status `400` dan pesan kesalahan.

2. **Verifikasi Kunci API:**
   - Skrip memeriksa header permintaan untuk `api-key`. Jika kunci API tidak ada atau tidak valid (tidak ditemukan di basis data), skrip mengembalikan kode status `403` dan pesan kesalahan.

3. **Baca dan Validasi Data Input:**
   - Skrip membaca data JSON dari body permintaan. Memeriksa apakah parameter `id`, `name`, dan `email` ada dalam data input. Jika salah satu dari parameter ini tidak ada, skrip mengembalikan kode status `400` dan pesan kesalahan.

4. **Update Data Pengguna:**
   - Jika data valid, skrip menjalankan kueri untuk memperbarui data pengguna yang ada di tabel `users` di basis data berdasarkan `id`.

5. **Respons Setelah Pembaruan Data:**
   - Jika operasi pembaruan berhasil, skrip mengembalikan pesan konfirmasi dengan kode status `200`.
   - Jika terjadi kesalahan saat memperbarui data, skrip mengembalikan kode status `500` dan pesan kesalahan.

Berikut adalah dokumentasi untuk skrip PHP yang menangani permintaan DELETE untuk menghapus data pengguna dari basis data.

---

## Dokumentasi API: `delete.php`

### Deskripsi
Skrip PHP ini menangani permintaan HTTP DELETE untuk menghapus data pengguna dari basis data. Skrip ini juga memverifikasi keberadaan dan validitas kunci API (API key) sebelum melakukan operasi penghapusan data.

### Endpoints
- **URL**: `localhost://restful-api-php-mysql/latihan/delete.php`
- **Metode HTTP**: DELETE

### Header
- `Content-Type`: `application/json` — Menentukan bahwa respons akan dikembalikan dalam format JSON.
- `Access-Control-Allow-Methods`: `DELETE`
- `Access-Control-Allow-Origin`: `*` — Mengizinkan akses dari semua domain (Namun, ada kesalahan penulisan `Acces-COntrol-Allow-Origin`).

### Body Request
**Format**: JSON
- **`id`**: Integer — ID pengguna yang akan dihapus.

**Contoh Request Body**:
```json
{
  "id": 123
}
```

### Respon

**Jika permintaan berhasil:**
- **Status Code**: `201 Created`
- **Isi Respons**:
  ```json
  {
    "message": "Berhasil Menghapus"
  }
  ```
  - Tipe data: Objek.
  - Atribut `message` berisi konfirmasi bahwa data pengguna berhasil dihapus.

**Jika metode HTTP bukan DELETE:**
- **Status Code**: `405 Method Not Allowed`
- **Isi Respons**:
  ```json
  {
    "message": "Method harus DELETE"
  }
  ```

**Jika kunci API tidak valid:**
- **Status Code**: `403 Forbidden`
- **Isi Respons**:
  ```json
  {
    "message": "api-key tidak valid"
  }
  ```

**Jika ID tidak disediakan:**
- **Status Code**: `400 Bad Request`
- **Isi Respons**:
  ```json
  {
    "message": "tidak ada id"
  }
  ```

**Jika gagal menghapus data:**
- **Status Code**: `500 Internal Server Error`
- **Isi Respons**:
  ```json
  {
    "message": "Gagal Menghapus"
  }
  ```

### Alur Kerja

1. **Verifikasi Metode HTTP:**
   - Skrip memeriksa apakah metode permintaan adalah DELETE. Jika tidak, skrip mengembalikan kode status `405` dan pesan kesalahan.

2. **Verifikasi Kunci API:**
   - Skrip memeriksa header permintaan untuk `api-key`. Jika kunci API tidak ada atau tidak valid (tidak ditemukan di basis data), skrip mengembalikan kode status `403` dan pesan kesalahan.

3. **Baca dan Validasi Data Input:**
   - Skrip membaca data JSON dari body permintaan. Memeriksa apakah parameter `id` ada dalam data input. Jika ID tidak ada, skrip mengembalikan kode status `400` dan pesan kesalahan.

4. **Hapus Data Pengguna:**
   - Jika ID valid, skrip menjalankan kueri untuk menghapus data pengguna dari tabel `users` di basis data berdasarkan ID.

5. **Respons Setelah Penghapusan Data:**
   - Jika operasi penghapusan berhasil, skrip mengembalikan pesan konfirmasi dengan kode status `201`.
   - Jika terjadi kesalahan saat menghapus data, skrip mengembalikan kode status `500` dan pesan kesalahan.

