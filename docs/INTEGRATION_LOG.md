# Evaluasi Integrasi Tim Sijayam (Minggu 11)

**Topik Diskusi:** 
Apakah ada kendala keamanan saat membuka akses CORS?

**Hasil Evaluasi Tim:**
Ya, ada kendala dan risiko keamanan yang cukup besar jika akses CORS dibuka secara sembarangan. 

Jika Backend mengizinkan semua domain dengan menggunakan konfigurasi wildcard (`origin: '*'`), maka aplikasi pihak ketiga atau *website* asing bisa dengan mudah menembak Endpoint API kami, mencuri data, atau melakukan aksi berbahaya (rentan terhadap serangan CSRF/XSS).

**Solusi yang Tim Kami Lakukan:**
Untuk mengatasi kendala keamanan tersebut, tim Backend kami tidak menggunakan wildcard `*`. Kami membatasi (*restrict*) izin CORS hanya secara spesifik untuk URL/Domain Frontend aplikasi Sijayam kami saja (misalnya `http://localhost/projeksijayamweb`). Dengan konfigurasi ini, Frontend dan Backend bisa saling terhubung dengan lancar, sementara pintu untuk pihak luar tetap tertutup rapat dan aman.