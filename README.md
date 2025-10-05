# 🎓 Exam Form & Payment Portal (Laravel 11)

A backend system built with **Laravel 11** for managing exam forms and payments.
Users can register/login, fill exam forms, pay via **Stripe** or **Razorpay**, and download PDF receipts.
Admins can manage forms, submissions, and payments.

---

## 🚀 Features

* User registration & login (Laravel Sanctum).
* Dynamic exam forms & custom fields.
* Submission flow: Draft → Pending Payment → Paid.
* Payment integration with **Stripe** & **Razorpay** (webhook verified).
* PDF receipt generation after successful payment.
* Admin panel for managing forms, submissions & payments.

---

## 📂 Project Setup

### 1. Clone Repository

```bash
git clone https://github.com/Humty-Sharma/Exam-form.git
cd exam-form-portal
```

### 2. Install Dependencies

```bash
composer install
npm install && npm run build
```

### 3. Environment Setup

Copy `.env.example` → `.env` and update your configuration:

```env
APP_NAME="Exam Form Portal"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=exam_portal
DB_USERNAME=root
DB_PASSWORD=

# Razorpay
RAZORPAY_KEY=your_razorpay_key
RAZORPAY_SECRET=your_razorpay_secret
RAZORPAY_WEBHOOK_SECRET=your_razorpay_webhook_secret

```

### 4. Generate App Key

```bash
php artisan key:generate
```

### 5. Run Migrations

```bash
php artisan migrate
```

### 6. Start Server

```bash
php artisan serve
```

Visit `http://127.0.0.1:8000`

---

## 📝 PDF Receipts

* Generated using **Dompdf**.
* Stored in `storage/app/receipts/{submission_id}.pdf`.
* Automatically emailed to users after payment success.

---

## 🛠 Development Notes

* **Queues**: Use `php artisan queue:work` for background jobs (PDF generation, emails).
* **Webhooks**: Expose your local server using [ngrok](https://ngrok.com/) for testing payments.
* **Testing**: Use Stripe & Razorpay test keys.

---

## 👨‍💻 Admin Access

Admin features (forms, submissions, payments) are available for users with role = `admin`.

Seed an admin user:

```php
php artisan tinker
>>> \App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
    'role' => 'admin'
]);
```

---

## 📦 Deployment

1. Set environment variables in production.
2. Run migrations: `php artisan migrate --force`.
3. Set up Supervisor/Queue worker for jobs.
4. Configure Stripe & Razorpay webhooks → `https://your-domain/api/webhooks/...`.

---

## ✅ Requirements

* PHP 8.2+
* Composer 2.x
* MySQL 8+ / MariaDB
* Node.js 18+
* Redis (recommended for queues)

---

## 📜 License

This project is open-sourced under the [MIT license](LICENSE).

---
