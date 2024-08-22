

## Dokumentasi API: `getall.php`

### Deskripsi
Skrip PHP ini menangani permintaan HTTP GET untuk mengambil data pengguna dari basis data. Skrip ini juga memverifikasi keberadaan dan validitas kunci API (API key) sebelum memberikan akses data.

### Endpoints
- **URL**: `localhost://latihan/getall.php`
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
