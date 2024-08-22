

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

pertanyaan tambahan, jangan ragu untuk bertanya!
