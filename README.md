# TP3DPBO2024C2
TP3DPBO2024C2

Tugas Praktikum 3 DPBO

Saya Marvel Ravindra Dioputra [2200481] TP3 dalam Mata Kuliah DPBO untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

Tugas praktikum membuat kode yang dapat melakukan CRUD menggunakan framework PHP dengan tema Data Masyarakat/Penduduk. Struktur folder:

  1. Folder template: Berisi skin HTML atau tampilan aplikasi.
  2. Folder classes: Berisi class untuk melakukan operasi CRUD dan koneksi database. Kelas-kelas yang akan dibuat antara lain: DB, Kecamatan, Penghasilan, Penduduk, dan Template.
  3. File PHP: Berfungsi untuk mengambil data dari database dan mengirimkannya ke tampilan/skin HTML.

Fitur:
  1. Menambah penduduk: Mengisi data penduduk (nama, NIK, foto, kecamatan, penghasilan) yang akan disimpan di tabel penduduk. Data yang diinput akan dilempar sebagai parameter dan menjalankan fungsi addPenduduk pada class Penduduk.
  2. Update penduduk: Mengubah data penduduk (nama, NIK, foto, kecamatan, penghasilan) yang akan disimpan di tabel penduduk. Data yang diinput akan dilempar sebagai parameter dan menjalankan fungsi updatePenduduk pada class Penduduk berdasarkan id.
  3. Delete penduduk: Menghapus data penduduk berdasarkan id penduduk yang dipilih.
  4. Fitur pencarian: Pada halaman index.php, terdapat fitur pencarian untuk mencari penduduk berdasarkan nama, NIK, atau kecamatan.

Tabel-tabel yang digunakan dalam database adalah sebagai berikut:
![design_database](https://github.com/rdmrvl/TP3DPBO2024C2/assets/64513644/26b83375-d87d-452f-bc78-323d11e74c76)
Tabel Penghasilan dan Kecamatan tidak dapat ditambah, diubah, atau dihapus karena data kecamatan sudah terdaftar semua dan pilihan penghasilan telah ditentukan.


