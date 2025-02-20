## 📌 **Sistem Pencatatan Zakat dengan Laravel & Filament**  

### **📖 Deskripsi**  
Proyek ini adalah **Sistem Pencatatan Zakat** berbasis web yang dibangun menggunakan **Laravel** dan **Filament Admin Panel**. Sistem ini bertujuan untuk mencatat data zakat yang diberikan oleh pemberi zakat serta mendistribusikannya kepada penerima zakat berdasarkan kategori penerima yang telah ditentukan.  

---

### **⚡ Fitur Utama**  

✅ **Manajemen User & Role**  
- Autentikasi pengguna menggunakan Laravel  
- Role-based access control (RBAC) dengan **Filament Shield**  
- Manajemen pengguna & peran  

✅ **Manajemen Lingkungan & Penanggung Jawab**  
- Pencatatan lingkungan (RT/RW, )  untuk *Desa,Kecamatan, Kabupaten tambah sendiri pada file migrasi
- Penanggung jawab setiap lingkungan  

✅ **Pencatatan Zakat**  
- Jenis zakat yang diberikan (Zakat Fitrah, Zakat Mal)  
- Pemberi zakat dan jumlah yang diberikan  
- Pencatatan berdasarkan lingkungan  

✅ **Distribusi Zakat**  
- Kategori penerima zakat sesuai asnaf (Fakir, Miskin, Amil, dsb.)  
- Jumlah zakat yang diterima (Beras atau Uang)  

✅ **Laporan Tahunan**  
- Total zakat terkumpul  
- Jumlah pemberi dan penerima  
- Rekapitulasi per tahun  

---

### **🛠️ Teknologi yang Digunakan**  
- **Laravel** 11.x (Backend & API)  
- **Filament Admin** (Dashboard Admin)  
- **Filament Shield** (Manajemen Hak Akses)  
- **MySQL** (Database)  
- **PHP 8.x**  
- **Composer**  

---

### **📂 Struktur Database**  

1️⃣ **Users** → Menyimpan data pengguna  
2️⃣ **Roles & User Roles** → Manajemen peran pengguna  
3️⃣ **Lingkungans & User Lingkungans** → Manajemen lingkungan dan penanggung jawab  
4️⃣ **Jenis Zakat** → Daftar jenis zakat (Zakat Fitrah & Zakat Mal)  
5️⃣ **Zakats** → Pencatatan zakat yang diberikan  
6️⃣ **Kategori Pembagian Zakat** → Daftar kategori penerima zakat  
7️⃣ **Distribusi Zakat** → Data distribusi zakat kepada penerima  
8️⃣ **Laporan Zakat** → Laporan tahunan  

---

### **🚀 Cara Install & Menjalankan Proyek**  

#### **1️⃣ Clone Repository**  
```bash
git clone https://github.com/azharmlnf/laravel-sistem-zakat.git

cd laravel-sistem-zakat
```

#### **2️⃣ Install Dependencies**  
```bash
composer install
npm install
```

#### **3️⃣ Konfigurasi `.env`**  
```bash
cp .env.example .env
php artisan key:generate
```
Atur koneksi database di file `.env`.

#### **4️⃣ Jalankan Migrasi & Seeder**  
```bash
php artisan migrate --seed
```

#### **5️⃣ Jalankan Server Laravel**  
```bash
php artisan serve
```

#### **6️⃣ Akses Dashboard Filament**  
Buka **`http://127.0.0.1:8000/admin`**  
Gunakan user yang telah dibuat dari seeder untuk login.

---

### **🔐 Manajemen Hak Akses dengan Filament Shield**  
Gunakan Filament Shield untuk mengatur hak akses di Filament Panel:  
```bash
php artisan shield:generate
```
Edit permission sesuai kebutuhan, lalu jalankan:  
```bash
php artisan migrate
```

---

### **📜 Lisensi**  
Proyek ini dibuat untuk keperluan **manajemen zakat** dan bersifat **open-source**.  

---

🔥 **Sekarang, sistem pencatatan zakat berbasis Laravel dan Filament siap digunakan!** 🚀
