## 🚀 Installation Guide

Follow these steps to run the project locally:

### 1. Clone Repository

```bash
git clone https://github.com/your-username/your-repo.git
cd your-repo
```

---

### 2. Install Dependencies

Make sure you have **PHP**, **Composer**, and **Node.js** installed.

```bash
composer install
npm install
```

---

### 3. Setup Environment File

Copy `.env.example` to `.env`:

```bash
cp .env.example .env
```

---

### 4. Generate Application Key

```bash
php artisan key:generate
```

---

### 5. Setup Database

Create a new database (for example: `news_db`), then update your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=news_db
DB_USERNAME=root
DB_PASSWORD=
```

---

### 6. Run Migration

```bash
php artisan migrate
```

If you have seeders:

```bash
php artisan db:seed
```

---

### 7. Build Frontend Assets

```bash
npm run dev
```

---

### 8. Run Development Server

```bash
php artisan serve
```

Open in browser:

```
http://127.0.0.1:8000
```

---

## 🔐 Default Login (Optional)

If your project includes authentication:

```
Email: admin@example.com
Password: password
```

---

## 🛠 Requirements

* PHP >= 8.x
* Composer
* MySQL / MariaDB
* Node.js & NPM

---

## 📌 Notes

* Make sure your database is running before migration
* If error occurs, try:

```bash
php artisan config:clear
php artisan cache:clear
```
