# Vue 3 Project Structure Documentation

Dokumentasi ini menjelaskan struktur folder dan fungsi masing-masing
bagian pada project laravel & Vue 3.

------------------------------------------------------------------------

## 📦 Root Structure

    my-vue-app/
    │
    ├── public/
    ├── resources/
    ├── .env
    ├── package.json
    ├── vite.config.ts
    └── README.md

------------------------------------------------------------------------

## 📂 public/

Folder untuk file statis yang tidak diproses oleh bundler.

Digunakan untuk: - Favicon - Asset statis tanpa import

------------------------------------------------------------------------

## 📂 resources/js

Folder utama source code aplikasi.

    resources/js
     ├── components/
     ├── views/
     ├── routes/
     ├── stores/     
     ├── services/
     ├── types/
     ├── plugins/
     └── main.ts

------------------------------------------------------------------------

## 📂 components/

Berisi komponen UI yang reusable.

Contoh:
- Form
- Modal
- DataTable
- Button
- Label
- File Upload
- Loader
- Pagination
- dll

Tujuan:
- Memisahkan tampilan menjadi bagian kecil yang bisa digunakan ulang
- Menghindari duplikasi kode

---

------------------------------------------------------------------------

## 📂 views/

Berisi halaman utama yang digunakan oleh router.

Setiap file biasanya mewakili satu route.

------------------------------------------------------------------------

## 📂 routes/

Konfigurasi routing aplikasi: - Daftar route - Navigation guard -
Middleware auth (jika ada)

------------------------------------------------------------------------

## 📂 stores/

State management (Pinia / Vuex): - State global - Session login - Data
lintas halaman

------------------------------------------------------------------------

## 📂 src/services/

Layer untuk komunikasi API: - Axios instance - API function -
Interceptor

------------------------------------------------------------------------

## 📂 types/

Berisi TypeScript type / interface global.

Contoh:
- API response type
- Model interface
- Enum

Tujuan:
- Menjaga konsistensi tipe data
- Memudahkan scaling project

------------------------------------------------------------------------

## 📄 plugins/

Berisi helper function.

Contoh:
- Format Uang
- Axios Handling Error
- Truncate

Digunakan untuk:
- Logic kecil yang bisa digunakan berulang kali

---

------------------------------------------------------------------------

## 📄 main.ts

Entry point aplikasi.

------------------------------------------------------------------------

# 🚀 Conclusion

Struktur ini dirancang agar: - Mudah dikembangkan - Mudah di-maintain -
- Memisahkan logic, UI, dan data layer
dengan jelas
