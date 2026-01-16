# DOKUMENTASI LENGKAP - MANAJEMEN PRODUK

**Project:** Happy Puppy Product Management System  
**Version:** 1.0  
**Last Updated:** January 16, 2026  
**Status:** Production Ready 

---

## DAFTAR ISIasdasd asdsad

1. [Ringkasan Project](#ringkasan-project)
2. [Requirement](#requirement)
3. [Teknologi](#teknologi)
4. [Setup & Instalasi](#setup--instalasi)
5. [Struktur Database](#struktur-database)
6. [Struktur Project](#struktur-project)
7. [Helper Functions](#helper-functions)
8. [Controller Documentation](#controller-documentation)
9. [Model Documentation](#model-documentation)
10. [API Endpoints](#api-endpoints)
11. [User Guide](#user-guide)
12. [Troubleshooting](#troubleshooting)

---

## RINGKASAN PROJECT

**Sistem Manajemen Produk** adalah aplikasi web untuk mengelola daftar produk toko dengan fitur:

- ✅ Login & Autentikasi Admin
- ✅ CRUD Produk (Create, Read, Update, Delete)
- ✅ Filter Produk berdasarkan Nama & Kategori
- ✅ Pagination dengan DataTables
- ✅ Inline Edit untuk Harga & Stok
- ✅ Input Validation
- ✅ Flash Message (Toast Alert)
- ✅ Responsive Design

**Target User:** Admin toko untuk manage inventory produk

---

## REQUIREMENT

### Functional Requirements
| No | Requirement | Status | Detail |
|----|-------------|--------|--------|
| 1 | Login Admin | ✅ | Username + Password authentication |
| 2 | Session Management | ✅ | Session check di setiap halaman |
| 3 | List Produk | ✅ | DataTables dengan 10 produk per halaman |
| 4 | Filter Kategori | ✅ | Dropdown filter kategori |
| 5 | Search Produk | ✅ | Search input di DataTables |
| 6 | Add Produk | ✅ | Form modal untuk input produk |
| 7 | Edit Produk | ✅ | Modal edit + inline edit harga/stok |
| 8 | Delete Produk | ✅ | Delete dengan confirmation dialog |
| 9 | Validasi Input | ✅ | Backend validation lengkap |
| 10 | Toast Alert | ✅ | Success/Error/Warning messages |

### Non-Functional Requirements
| Requirement | Status | Detail |
|-------------|--------|--------|
| Security | ✅ | Input sanitization, SQL injection prevention |
| Performance | ✅ | Database indexing, efficient queries |
| Usability | ✅ | Responsive UI, intuitive design |
| Maintainability | ✅ | Clean code, proper MVC pattern |
| Documentation | ✅ | Complete documentation |

---

## TEKNOLOGI

### Backend
- **Framework:** CodeIgniter 3.x
- **Language:** PHP 5.6+
- **Database:** MySQL/MariaDB

### Frontend
- **HTML5, CSS3, JavaScript (ES5)**
- **jQuery** - DOM manipulation & AJAX
- **DataTables** - Advanced table plugin
- **Bootstrap 4** - CSS framework (via AdminLTE)
- **AdminLTE 2** - Admin template
- **Font Awesome 5** - Icon library
- **SweetAlert2** - Alert/Modal dialogs

### Server
- **Apache/Nginx** - Web server
- **XAMPP** - Development environment

---

## SETUP & INSTALASI
### Step 1: Persiapan Database
- import database **db_happy**

### Step 2: Konfigurasi CodeIgniter
Ubah konfigurasi database di `application/config/database.php` menjadi:
```php
<?php
$db['default'] = array(
  'dsn'   => '',
  'hostname' => 'localhost', // sesuaikan 
  'username' => 'root', // sesuaikan 
  'password' => '', // sesuaikan 
  'database' => 'db_puppy', // sesuaikan 
  'dbdriver' => 'mysqli',
  'dbprefix' => '',
  'pconnect' => FALSE,
  'db_debug' => (ENVIRONMENT !== 'production'),
  'cache_on' => FALSE,
  'cachedir' => '',
  'char_set' => 'utf8mb4',
  'dbcollat' => 'utf8mb4_unicode_ci',
  'swap_pre' => '',
  'encrypt' => FALSE,
  'compress' => FALSE,
  'stricton' => FALSE,
  'failover' => array(),
  'save_queries' => TRUE
);
```

### Step 3: Autoload Configuration
Ubah autoload di `application/config/autoload.php` menjadi:
```php
<?php
$autoload['libraries'] = array('database','session','form_validation','pagination');
$autoload['helper'] = array('url', 'form', 'toast', 'main');
```
 ### Step 4: Config Configuration
Ubah config di `application/config/autoload.php` menjadi:
```php
<?php
$config['base_url'] = 'http://localhost/happy';
```
### Step 5: Akses Aplikasi
```
http://localhost/happy/auth/login
```

---

## STRUKTUR DATABASE

### Tabel: users
| Field          | Type         | Null | Key | Default | Extra          |
|----------------|--------------|------|-----|---------|----------------|
| id_user             | int(11)      | NO   | PRI | NULL    | auto_increment |
| username        | varchar(50)  | NO   | UNI | NULL    |                |
| password        | varchar(255) | NO   |     | NULL    |                |
| created_at     | timestamp    | NO   |     | CURRENT_TIMESTAMP |        |
| updated_at     | timestamp    | YES  |     | NULL    | on update CURRENT_TIMESTAMP |

### Tabel: categories
| Field          | Type         | Null | Key | Default | Extra          |
|----------------|--------------|------|-----|---------|----------------|
| id             | int(11)      | NO   | PRI | NULL    | auto_increment |
| name           | varchar(100) | NO   |     | NULL    |                |

### Tabel: products
| Field          | Type         | Null | Key | Default | Extra          |
|----------------|--------------|------|-----|---------|----------------|
| id             | int(11)      | NO   | PRI | NULL    | auto_increment |
| category_id    | int(11)      | NO   | MUL | NULL    |                |
| name           | varchar(100) | NO   |     | NULL    |                |
| price          | decimal(10,2)| NO   |     | NULL    |                |
| stock          | int(11)      | NO   |     | NULL    |                |
| created_at     | timestamp    | NO   |     | CURRENT_TIMESTAMP |        |
| updated_at     | timestamp    | YES  |     | NULL    | on update CURRENT_TIMESTAMP |

## STRUKTUR PROJECT

```
application
├── config
│   ├── autoload.php
│   ├── config.php
│   └── database.php
├── controllers
│   ├── Auth.php
│   └── Products.php
├── core
│   ├── MY_Controller.php
├── models
│   ├── User_model.php
│   ├── Categories_model.php
│   └── Products_model.php
├── views
│   ├── auth
│   │   ├── login.php
│   ├── products
│   │   ├── index.php
│   └── layouts
│       ├── header.php
│       ├── footer.php
│       └── sidebar.php
└── helpers
    ├── toast_helper.php
    └── url_helper.php
```

---

## HELPER FUNCTIONS

### 🐘 toast_helper.php

**Lokasi:**  
`application/helpers/toast_helper.php`

**Fungsi:** Menyimpan flash message ke session dan ditampilkan.

**Function:** `toast()`

```php
<?php
toast($type = 'info', $message = '')
```
**Parameter:** 
- `$type` (string) - Tipe message: `success`, `error`, `warning`, `info`, `question`
- `$message` (string) - Pesan yang ingin ditampilkan

**Return:** Void

**Contoh Penggunaan:**

```php
//Di controller
public function login()
{
   //... validasi ...
   if(!$login){
      toast('error', 'Username / Password salah!');
   }
}
```
Implementasi di View:

File: `footer.php:`
```javascript
<!-- start toast -->
<script>
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end', // pojok kanan atas
    showConfirmButton: false,
    timer: 2500,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer);
      toast.addEventListener('mouseleave', Swal.resumeTimer);
    }
  });

  function showToast(type, message) {
    Toast.fire({
      icon: type,
      title: message
    });
  }
</script>

<?php $toast = $this->session->flashdata('toast'); ?>
<?php if (!empty($toast) && !empty($toast['type']) && !empty($toast['message'])): ?>
<script>
  showToast("<?= $toast['type']; ?>", "<?= addslashes($toast['message']); ?>");
</script>
<?php endif; ?>
<!-- end toast -->
```

### 🐘 main_helper.php

**Lokasi:**  
`application/helpers/toast_helper.php`

**Fungsi:** Memuat view dengan layout `header` `sidebar` `footer` secara otomatis

**Function:**

```php
<?php
load_view($obj, $view, $data = array())
```

**Parameter:**

- $obj (object) - Controller instance ($this)
- $view (string) - Nama view file (tanpa .php)
- $data (array) - Data yang akan dikirim ke view

**Return:** Void

**Contoh Penggunaa:**:
```php
  public function index()
  {
    $data['title'] = 'Data Products';
    $data['categories'] = $this->category->all();

    load_view($this, 'products/index',$data);
  }
```

**Proses:**
1. Load `header.php`
2. Load `sidebar.php`
3. Load view yang diminta
4. Load `footer.php`

---

## CONTROLLER DOCUMENTATION

### 🐘 Auth.php
**Fungsi:** Handle login dan logout secara fungsional

### Method: `login()`
```php

public function login()
{
    if ($this->session->userdata('user_logged_in')) {
        redirect('products');
    }

    if ($this->input->post()) {

        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        $admin = $this->user->find(['username' => $username]);

        if ($admin && password_verify($password, $admin->password)) {

            $this->session->set_userdata([
                'user_logged_in' => true,
                'user_id'       => $admin->id,
                'user_username' => $admin->username
            ]);

            toast('info', 'Selamat datang, semangat bekerja!');
            redirect('products');

        } else {
            toast('error', 'Username / Password salah!');
            redirect('auth/login');
        }
    }

    $this->load->view('auth/login');
}
```
**Deskripsi:**
- Menampilkan halaman login
- Proses form login (POST)
- Sistem mengambil data user berdasarkan email
- Password diverifikasi dengan `password_verify()` 
- Jika valid → session dibuat
 → tampil pesan success
 - User diarahkan ke halaman product
- Jika gagal → tampil pesan error dan tetap dihalaman login

**Flow:**
```
1. GET /auth/login
   → Tampilkan form login

2. POST /auth/login
   → Validasi username & password
   → Jika valid: set session + redirect /products
   → Jika invalid: show error message
```
**Session Var yang di simpan:**
```php
$this->session->set_userdata([
   'user_logged_in' => true,
   'user_id'       => $admin->id,
   'user_username' => $admin->username
]);
```

### Method: `logout()`

```php
public function logout()
{
   $this->session->unset_userdata([
      'user_logged_in',
      'user_id',
      'user_username'
   ]);

   $this->session->sess_destroy();

   toast('info', 'Logout !');
   redirect('auth/login');
}
```
**Deskripsi:**
- Menghapus semua session 
- tampilkan success message 
- redirect ke login page

### 🐘 MY_Controller.php
**Fungsi:**
**base controller** yang digunakan sebagai **parent class** untuk controller lain di CodeIgniter 3.  
Controller ini berfungsi untuk **memproteksi halaman** agar hanya dapat diakses oleh user yang sudah login.

**Code:**
```php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    if(!$this->session->userdata('user_logged_in')) redirect('login');
  }
}
```

**Deskripsi:** Mmelakukan pengecekan **status login user** melalui session pada saat controller diinisialisasi.  
Jika user **belum login**, maka akan otomatis melakukan **redirect ke halaman login**.
Dengan extends `MY_Controller`, developer tidak perlu menulis ulang logic pengecekan login di setiap controller.

**Flow:**
```
1. Controller dipanggil
2. Constructor MY_Controller dijalankan
3. Sistem mengecek session user_logged_in
4. Jika false → redirect ke halaman login
5. Jika true → controller dilanjutkan
```
**Cara Penggunaan:**
```php
<?php

class Products extends MY_Controller {
   public function index(){
      ----
   }
}
```
**Return:** Void

**Best Practice:** 
- Gunakan MY_Controller untuk proteksi global
- Hindari duplikasi logic auth di banyak controller
- Untuk halaman public, gunakan CI_Controller biasa

---

### 🐘 Products.php

**Fungsi:**Controller `Products` digunakan untuk mengelola **data produk**. Menampilkan data dengan **DataTables server side**, serta **CRUD berbasis ajax**.

**Lokasi:**
`application/controllers/Products.php`

**Deskripsi**
- Menampilkan halaman daftar produk
- Menyediakan data **DataTables Server-Side**
- CRUD produk melalui AJAX
- Update field tertentu secara inline (price, stock)
- Validasi data sebelum disimpan ke database

Semua response AJAX dikembalikan dalam format **JSON**.

**Parent Class:**

`MY_Controller`

> Seluruh method di controller ini **terproteksi login** melalui `MY_Controller`.

**Code:**

```php
class Products extends MY_Controller {
    ...
}
```
**Dependency**

| Model | Alias | Fungsi |
|-----|------|-------|
| `Product_model` | `product` | Pengelolaan data produk & DataTables |
| `Category_model` | `category` | Mengambil kategori produk |

**Helper:**
- `load_view()` – untuk memuat layout header, konten, dan footer

**View:** `products/view`
### Response API (Format JSON)

helper internal untuk response JSON.

**Source:**
```php
private function _json($status, $message, $data = null)
  {
```
| Parameter  | Tipe    | Keterangan             |
| ---------- | ------- | ---------------------- |
| `$status`  | boolean | status sukses/gagal    |
| `$message` | string  | pesan keterangan       |
| `$data`    | mixed   | optional data tambahan |

**Tujuan:**
Standarisasi response JSON agar konsisten.

**Format output:**
```json
{
  "status": true|false,
  "message": "string",
  "data": "mixed"
}
```
**Implementasi:**
```php
if (empty($category_id)) {
   return $this->_json(false, 'Kategori wajib dipilih');
}

```
### Method: `index()`
```php
public function index()
{
   $data['title'] = 'Data Products';
   $data['categories'] = $this->category->all();

   load_view($this, 'products/index', $data);
}

```
**Flow**
```
1. Menetapkan judul halaman ke dalam variabel $data['title'].
Mengambil seluruh data kategori dari model category menggunakan method all().
2. Menyimpan data kategori ke dalam $data['categories'].
3. Memanggil fungsi load_view() untuk menampilkan view products/index beserta data yang telah disiapkan.
```
**Response:** HTML view
**Data yang dikirim ke view:**
| Key        | Tipe Data      | Keterangan           |
| ---------- | -------------- | -------------------- |
| title      | string         | Judul halaman        |
| categories | array / object | Data kategori produk |


---
### Method: `ajax_list()`

**Sourcecode:**
```php
public function ajax_list()
```
**Deskripsi:** Method ajax_list() digunakan sebagai endpoint AJAX server-side DataTables untuk menampilkan daftar produk.
Method ini menangani parameter DataTables, memfilter data berdasarkan category_id, dan mengembalikan response dalam format JSON yang sesuai dengan request DataTables.

**HTTP Request**
- Method: POST
- Content-Type: application/x-www-form-urlencoded
- Response-Type: application/json

**Parameter Request**
| Parameter       | Tipe   | Wajib | Deskripsi                                                     |
| --------------- | ------ | ----- | ------------------------------------------------------------- |
| `draw`          | int    | Ya    | Counter dari DataTables untuk sinkronisasi request & response |
| `start`         | int    | Ya    | Offset data (digunakan oleh DataTables)                       |
| `length`        | int    | Ya    | Jumlah data per halaman                                       |
| `search[value]` | string | Tidak | Keyword pencarian                                             |
| `order`         | array  | Tidak | Informasi sorting DataTables                                  |
| `category_id`   | int    | Tidak | Filter data berdasarkan kategori                              |

**Proses Internal**
1. Mengambil category_id dari request POST
2. Mengambil data produk menggunakan:
```php
$list = $this->product->get_datatables($category_id);
```
3. Melakukan formatting setiap baris data untuk DataTables:
```php
$this->product->format_datatables_row($p);
```

**Struktur Response JSON**
```json
{
  "draw": 1,
  "recordsTotal": 100,
  "recordsFiltered": 25,
  "data": [
    [
      "1",
      "Nama Produk",
      "Kategori",
      "Harga",
      "Aksi"
    ]
  ]
}
```
**Keterangan Response**
| Field             | Tipe  | Deskripsi                       |
| ----------------- | ----- | ------------------------------- |
| `draw`            | int   | Nilai draw dari request         |
| `recordsTotal`    | int   | Total seluruh data tanpa filter |
| `recordsFiltered` | int   | Total data setelah filter       |
| `data`            | array | Data rows untuk DataTables      |

Contoh Inisialisasi DataTables (Frontend)
```javascript
$('#table-product').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: '/product/ajax_list',
    type: 'POST',
    data: function (d) {
      d.category_id = $('#category').val();
    }
  }
});

```
### Method: ajax_update_field()

**Fungsi:**

Mengupdate field tertentu (inline edit)

**Source:**
```php
public function ajax_update_field()
{
**Input POST**

```
| Key     | Tipe       | Keterangan              |
| ------- | ---------- | ----------------------- |
| `id`    | int        | id produk               |
| `field` | string     | kolom yang mau diupdate |
| `value` | string/int | nilai baru              |

**Validasi:**

1. Field harus masuk whitelist:
```php
$allowed = ['price','stock'];
```

2. Value harus numeric dan >= 0. Jika tidak valid → return:
```json
{"status":false,"message":"Field tidak valid"}
```
atau:
```json
{"status":false,"message":"Value harus angka >= 0"}
```
**Update Query:**
```php 
$this->db->where('id',$id)->update('products', [
  $field => (int)$value
]);
```
**Output JSON sukses:**
```json
{
  "status": true,
  "data": {
    "id": 1,
    "name": "Nama",
    "category_id": 2,
    "price": 12000,
    "stock": 4
  }
}
```
**Output JSON gagal:**

```json
{
  "status": false,
  "message": "Produk tidak ditemukan"
}
```
---
### Method: ajax_save()
**Fungsi:**
- proses insert dan uopdate data

**Source:**
```php
public function ajax_save()
```
**Input POST**
| Key           | Tipe   | Keterangan                              |
| ------------- | ------ | --------------------------------------- |
| `id`          | int    | jika ada → update, jika kosong → insert |
| `name`        | string | nama produk                             |
| `category_id` | int    | kategori                                |
| `price`       | int    | harga                                   |
| `stock`       | int    | stok                                    |

**Validasi**
| Field         | Rule                            |
| ------------- | ------------------------------- |
| `name`        | wajib, minimal 3 karakter       |
| `category_id` | wajib dipilih                   |
| `price`       | numeric, >= 0                   |
| `stock`       | numeric, >= 0                   |
| kategori      | harus ada di table `categories` |

Jika gagal validasi → return `_json(false, "...")`

**Return data:**
```php
$payload = [
  'name' => $name,
  'category_id' => $category_id,
  'price' => (int)$price,
  'stock' => (int)$stock,
];
```
**Return pesan Json**
```php
{"status": true, "message": "Produk berhasil ditambahkan", "data": null}
```
### Method: ajax_delete($id)
**Fungsi:**
Menghapus produk berdasarkan id.

**Validasi:**
cek produk ada atau tidak
kalau tidak ada:
```php
{"status": false, "message": "Produk tidak ditemukan"}
```php

**Delete query:**
```php
$this->db->where('id', $id)->delete('products');
```

**Output JSON:**
```php
{"status": true, "message": "Produk berhasil dihapus", "data": null}
```
## 📖 MODEL DOCUMENTATION

### User_model.php

`User_model` adalah model yang digunakan untuk mengakses table user, khususnya untuk:
- mengambil 1 data user berdasarkan filter (`find`)

### Properti / Variabel Model
untuk memudahkan pemanggilan nama table, dan bila jika suatu saat ada pergantian nama table tinggal ganti di `$table`  
```php 
private $table = 'user';
```
### Method find()
**Fungsi:** mengambil 1 data user berdasarkan filter array
**Source code:**
```php
public function find($filter=[]){
  $this->db->where($filter);    
  $query = $this->db->get($this->table);
  return $query->row();
}
```
**Parameter:**
| Parameter | Tipe  | Default | Keterangan                               |
| --------- | ----- | ------- | ---------------------------------------- |
| `$filter` | array | `[]`    | kolom yang difilter, contoh: `['username'=>'admin` |

**Return:**
- object user (1 row) jika ditemukan
- null jika tidak ditemukan

**Implementasi**
```php
$user = $this->user->find(['id' => 1]);
//atau
$user = $this->user->find(['username' => 'admin']);
```
### Category_model.php
`Category_model` digunakan untuk mengambil data kategori dari table `categories`.
Model digunkan untuk:
- tampilan dropdown filter kategori.
- dropdown kategori pada form create/edit product.

### method: all()
**Fungsi:**
Mengambil seluruh data kategori dari table categories dengan urutan nama kategori A-Z.

Source
```php 
public function all(){
  return $this->db->order_by('name','ASC')->get($this->table)->result();
}
```
**Return:**

`array<object>` berisi semua kategori dari table categories.

**Implementasi pada Controller:**
```php
$data['categories'] = $this->category->all();
```
**Implementasi pada view(dropdown):**
```php
<select name="category_id">
  <?php foreach($categories as $c): ?>
    <option value="<?= $c->id ?>"><?= $c->name ?></option>
  <?php endforeach; ?>
</select>
```
### Product_model

Model ini menangatur **DataTables Server-side** untuk list produk dengan fitur:
- Search (nama produk/kategori)
- Order/sort
- Filter kategori (`category_id`)
- Pagination DataTables (`start`, `length`)
- Formatting row (badge kategori, inline editing price/stock, tombol hapus/edit)
### Struktur table yang digunakan
### `products`
- `id` (INT)
- `name` (VARCHAR)
- `category_id` (INT)
- `price` (INT)
- `stock` (INT)

### `categories`
- `id` (INT)
- `name` (VARCHAR)

> Relasi: `products.category_id` -> `categories.id`

### Properties
- `$table = 'products'`
- `$column_search = ['products.name', 'categories.name']`
- `$order = ['products.id' => 'DESC']`

**Keterangan:**
- $table: nama tabel utama (products)
- $column_search: daftar kolom yang bisa dicari (DataTables Search)
-$order: default sorting jika DataTables tidak mengirim order

### methods private `_query($category_id = null)`
**Fungsi:** Membangun query utama untuk DataTables.
**Source**
```php
  private function _query($category_id = null)
  {
```
**Flow:**
```
1. Select produk + join kategori
2. Filter kategori (jika dipilih)
3. Search berdasarkan input DataTables
4. Ordering berdasarkan request DataTables atau default
```
**Query yang dibangun seperti:**
- SELECT `products.*` + `categories.name as category_name`
- JOIN `categories`
- Filter kategori (optional)
- Search dari DataTables: `search[value]`
- Sorting dari DataTables: `order`

### Method: `get_datatables($category_id = null)`
Mengambil data produk untuk kebutuhan **DataTables Server-side Processing**.

**Fungsi:** Mengembalikan list data produk sesuai pagination DataTables, termasuk filter kategori dan hasil pencarian/sorting yang sudah disiapkan oleh method `_query()`.

**Source:**
```php
public function get_datatables($category_id = null)
{
  $this->_query($category_id);
  $length = (int)$this->input->post('length');
  $start  = (int)$this->input->post('start');
  if ($length != -1) $this->db->limit($length, $start);
  return $this->db->get()->result();
}
```

**Parameter:**
- `$category_id` *(int|null)*
- ID kategori untuk filtering data.  
- Jika `null` / kosong → tampilkan semua kategori.

**Flow:**
```
1. Memanggil `_query($category_id)` untuk menyiapkan query utama (JOIN categories, search, order, filter).
2. Mengambil parameter DataTables dari request POST:
   - `length`: jumlah data per halaman
   - `start`: offset data awal
3. Jika `length != -1`, query diberi limit:
   - $this->db->limit($length, $start);
```
**Return**: `array<object>`

### Method count_filtered($category_id = null)

Menghitung jumlah data **setelah proses filter/search** untuk kebutuhan DataTables Server-side.
**Source Code**
```php
public function count_filtered($category_id = null)
{
  $this->_query($category_id);
  return $this->db->get()->num_rows();
}
```
**Fungsi:**
Dipakai untuk mengisi nilai `recordsFiltered` pada response JSON DataTables, yaitu jumlah total data yang sesuai dengan:
- filter kategori (`category_id`)
- keyword pencarian DataTables (`search[value]`)

**Parameter:**
- `$category_id` *(int|null)*  
  Jika diisi → menghitung jumlah produk pada kategori tersebut.  
  Jika `null` / kosong → menghitung semua kategori.

**Flow:**
```
1. Memanggil `_query($category_id)` untuk membangun query utama (JOIN, filter, search, order).
2. Menjalankan query menggunakan `$this->db->get()`.
3. Mengembalikan jumlah baris hasil query menggunakan `num_rows()`.
```
**Return:** `int` jumlah data hasil filter/search

### count_all()
Menghitung jumlah total data pada tabel `products` tanpa filter/search.

**Tujuan**
Dipakai untuk mengisi nilai `recordsTotal` pada response JSON DataTables, yaitu jumlah seluruh data produk yang ada di database.

```php
public function count_all()
{
  return $this->db->count_all($this->table);
}
```
**Return**: `int`
## format_datatables_row($product)
Memformat 1 data produk menjadi **format row DataTables** (array kolom) yang siap dimasukkan ke response JSON DataTables (`data`).

**Source Code**
```php
public function format_datatables_row($product)
{
  return [
    $product->id,
    html_escape($product->name),
    '<span class="badge badge-info">'.html_escape($product->category_name).'</span>',
    '<input type="number" class="form-control form-control-sm edit-inline"
      data-field="price"
      data-id="'.$product->id.'"
      value="'.$product->price.'">',
    '<input type="number" class="form-control form-control-sm edit-inline"
      data-field="stock"
      data-id="'.$product->id.'"
      value="'.$product->stock.'">',
    $this->get_action_buttons($product->id)
  ];
}
```

**Tujuan**
Agar output dari server-side DataTables sudah berbentuk:
- kolom teks (ID, nama)
- badge kategori (HTML)
- input inline editing untuk `price` dan `stock`
- tombol aksi (edit/delete)

Sehingga di frontend DataTables tinggal render tanpa proses tambahan.

**Parameter**
- `$product` *(object)*  
  Object hasil query dari database, minimal memiliki field:
  - `id`
  - `name`
  - `category_name`
  - `price`
  - `stock`

**Output Kolom DataTables**
Function ini mengembalikan array dengan 6 kolom:

1. **ID Produk** → `$product->id`
2. **Nama Produk** → `html_escape($product->name)`
3. **Kategori** → badge HTML `<span class="badge badge-info">...</span>`
4. **Harga** → `<input type="number" ... data-field="price">` (inline edit)
5. **Stok** → `<input type="number" ... data-field="stock">` (inline edit)
6. **Aksi** → HTML tombol dari `get_action_buttons($product->id)`

**Return**
- `Array` kolom DataTables untuk 1 row.

### method `get_action_buttons($product_id)`
Generate HTML tombol aksi untuk setiap row DataTables (**Edit** & **Delete**).

**Tujuan**
Memisahkan pembuatan HTML action buttons agar:
- kode lebih rapi
- mudah maintenance jika tombol/tampilan diubah

**Source code:**
```php
private function get_action_buttons($product_id)
{
   return '
   <div class="btn-group btn-group-sm">
   <button type="button" class="btn btn-info btn-sm" onclick="openEditModal('.$product_id.')">
      <i class="fas fa-edit"></i>
   </button>
   <button type="button" class="btn btn-danger btn-sm" onclick="deleteProduct('.$product_id.')">
      <i class="fas fa-trash"></i>
   </button>
   </div>
   ';
}
```
**Parameter**
- `$product_id` *(int)*  
  ID produk yang akan digunakan sebagai parameter pada event JS.

**Output**
Menghasilkan HTML berupa button group berisi 2 tombol:

1. **Edit**
   - class: `btn btn-info btn-sm`
   - action: `onclick="openEditModal(product_id)"`
   - icon: `<i class="fas fa-edit"></i>`

2. **Delete**
   - class: `btn btn-danger btn-sm`
   - action: `onclick="deleteProduct(product_id)"`
   - icon: `<i class="fas fa-trash"></i>`

**Dependency (Frontend JS)**

Function ini membutuhkan JS berikut di `view`:
- `openEditModal(id)` → membuka modal edit + load data via AJAX
- `deleteProduct(id)` → konfirmasi hapus + AJAX delete

**Return:** `string` HTML tombol aksi untuk DataTables column.

---

## API ENDPOINTS

| Endpoint                | Method | Auth | Description                     |
|-------------------------|--------|------|---------------------------------|
| /api/auth/login         | POST   | No   | Login admin                     |
| /api/auth/logout        | POST   | Yes  | Logout admin                    |
| /api/categories         | GET    | Yes  | Get all categories              |
| /api/categories         | POST   | Yes  | Create new category             |
| /api/categories/{id}    | GET    | Yes  | Get category by ID              |
| /api/categories/{id}    | PUT    | Yes  | Update category by ID           |
| /api/categories/{id}    | DELETE | Yes  | Delete category by ID           |
| /api/products           | GET    | Yes  | Get all products                |
| /api/products           | POST   | Yes  | Create new product              |
| /api/products/{id}      | GET    | Yes  | Get product by ID               |
| /api/products/{id}      | PUT    | Yes  | Update product by ID            |
| /api/products/{id}      | DELETE | Yes  | Delete product by ID            |

---

## USER GUIDE

1. **Login sebagai Admin**
   - Akses halaman login di `/auth/login`
   - Masukkan username `admin` dan password `admin`
   - Klik tombol "Login"

2. **Kelola Produk**
   - Akses menu "Products Uniqlo" di sidebar
   - Tambah, edit, atau hapus produk

3. **Logout**
   - Klik tombol "Logout" di header

---

## TROUBLESHOOTING

- **404 Not Found** - Pastikan URL benar dan server berjalan
- **500 Internal Server Error** - Cek file `.htaccess` dan konfigurasi server
- **Database Connection Error** - Pastikan kredensial database benar di `application/config/database.php`

