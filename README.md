# 📊 Record MTN

> Dashboard monitoring dan pencatatan utilisasi dengan tampilan data yang lebih informatif dan interaktif.

---

## ✨ About The Project

**Record MTN** adalah aplikasi yang digunakan untuk membantu pencatatan, monitoring, dan visualisasi data utilisasi melalui dashboard yang sederhana dan informatif.

Project ini dikembangkan berdasarkan source code dari:

👤 **[satriowisnuwardono](https://github.com/satriowisnuwardono)**

Saya melakukan beberapa perbaikan dan pengembangan pada project ini, terutama pada sisi **DataTable** dan penambahan **Dashboard Utilisasi**.

---

## 🚀 Improvements

Beberapa perubahan yang saya lakukan pada project ini:

### 🗂️ DataTable Fix

Melakukan perbaikan pada fitur **DataTable**, termasuk:

* Perbaikan tampilan tabel
* Perbaikan pagination
* Perbaikan sorting
* Perbaikan filtering/search
* Perbaikan responsive table
* Optimalisasi tampilan data agar lebih mudah digunakan

### 📈 Dashboard Utilisasi

Menambahkan **Chart Utilisasi** pada menu Dashboard untuk memberikan visualisasi data yang lebih mudah dipahami.

Dengan adanya chart, pengguna dapat melihat:

* 📊 Data utilisasi
* 📈 Perubahan utilisasi
* 📅 Tren berdasarkan periode
* 🔎 Perbandingan data secara visual

---

## 🖥️ Dashboard

Dashboard dirancang untuk memberikan informasi secara cepat melalui kombinasi **summary data** dan **visualisasi chart**.

```text
┌─────────────────────────────────────────────┐
│                 DASHBOARD                   │
├─────────────┬─────────────┬─────────────────┤
│   Total     │  Utilisasi  │     Status      │
│    Data     │     (%)     │     System      │
├─────────────┴─────────────┴─────────────────┤
│                                             │
│           📈 CHART UTILISASI                │
│                                             │
│     ╭────╮                                  │
│     │    ╰────╮                             │
│ ╭───╯         ╰────╮                        │
│╯                    ╰───                    │
│                                             │
└─────────────────────────────────────────────┘
```

---

## 🛠️ Tech Stack

Project ini menggunakan teknologi sesuai dengan source code original.

| Technology      | Usage                |
| --------------- | -------------------- |
| PHP             | Backend              |
| CodeIgniter4    | Web Framework        |
| MySQL / MariaDB | Database             |
| JavaScript      | Frontend Interaction |
| DataTables      | Data Management      |
| Chart.js        | Data Visualization   |
| HTML5           | Interface            |
| CSS3            | Styling              |

---

## 📌 Main Features

* 📊 Dashboard monitoring
* 📈 Chart utilisasi
* 🗃️ Data management
* 🔍 Data search & filtering
* 📑 DataTable
* 📱 Responsive interface
* 📊 Visualisasi data
* ⚡ Fast data access

---

## 📂 Project Structure

Struktur project mengikuti struktur framework dan source code original.

```text
record-mtn/
├── app/
├── public/
├── writable/
├── system/
├── tests/
├── .env
├── composer.json
└── README.md
```

> Struktur dapat berbeda tergantung versi dan konfigurasi aplikasi.

---

## ⚙️ Installation

Clone repository:

```bash
git clone git@github.com:adiferianto/record-mtn.git
```

Masuk ke directory:

```bash
cd record-mtn
```

Install dependency:

```bash
composer install
```

Copy environment configuration:

```bash
cp env .env
```

Sesuaikan konfigurasi database pada:

```text
.env
```

Kemudian jalankan aplikasi sesuai konfigurasi server/web server yang digunakan.

---

## 🔐 Environment

Pastikan file `.env` **tidak di-commit ke repository** apabila berisi credential atau konfigurasi production.

Contoh konfigurasi:

```env
database.default.hostname = localhost
database.default.database = record_mtn
database.default.username = username
database.default.password = password
database.default.DBDriver = MySQLi
```

---

## 👨‍💻 Credits

Project ini menggunakan source code yang dikembangkan oleh:

**[@satriowisnuwardono](https://github.com/satriowisnuwardono)**

Pengembangan pada repository ini berfokus pada:

* Fix DataTable
* Improvement tampilan data
* Penambahan Chart Utilisasi pada Dashboard
* Penyesuaian beberapa bagian aplikasi

Terima kasih kepada **satriowisnuwardono** atas kontribusi dan source code yang menjadi dasar pengembangan project ini. 🙏

---

## 🤝 Contributors

Contributions, issues, dan improvement sangat terbuka.

Jika ingin berkontribusi:

1. Fork repository
2. Buat branch baru

```bash
git checkout -b feature/nama-fitur
```

3. Commit perubahan

```bash
git add .
git commit -m "Add: nama fitur"
```

4. Push branch

```bash
git push origin feature/nama-fitur
```

5. Buat Pull Request

---

## 📜 License

Silakan sesuaikan bagian license ini dengan **license dari source code original**.

Jika source code original tidak memiliki license yang jelas, sebaiknya jangan menambahkan license baru sebelum memastikan hak penggunaannya.

---

## ⭐ Support

Jika project ini bermanfaat, jangan lupa berikan ⭐ pada repository.

**Built with ❤️ for better monitoring & utilization visualization.**
