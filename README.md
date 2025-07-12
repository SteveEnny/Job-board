
# WorkBridge API

**WorkBridge** is a Laravel-based Job Board Application API that connects **freelancers** with **employers**. It enables employers to post job opportunities and freelancers to apply for them with ease. The system supports full authentication, role-based access, and profile management.

---

## 🔧 Features

### 🔐 Authentication
- User Registration & Login
- Google Sign-In
- Logout

### 👥 User Roles
- **Employer**
- **Freelancer**

### 💼 Jobs
- View all available jobs
- View individual job with employer details
- View jobs by specific employer
- Employers can:
  - Create jobs
  - Edit jobs
  - Delete jobs
  - Accept applicant requests
  - Send emails to hired freelancers

### 📝 Job Applications
- Freelancers can:
  - Apply for a job (only once per job)
  - Edit their applications
  - View their submitted applications
- Employers can:
  - View all applications for their job listings

### 👤 User Profiles
- View user profiles
- Update own profile

---

## 🧱 Models

- `User`: Base user model (can be an employer or freelancer)
- `Employer`: Details related to employers
- `Freelancer`: Details related to freelancers
- `Job`: Job posts created by employers
- `JobApplication`: Applications submitted by freelancers

---

## 📁 Project Structure

```
app/
├── Models/
│   ├── User.php
│   ├── Employer.php
│   ├── Freelancer.php
│   ├── Job.php
│   └── JobApplication.php
├── Http/
│   └── Controllers/
│       ├── AuthController.php
│       ├── JobController.php
│       ├── EmployerController.php
│       └── JobApplicationController.php
```

---

## 🚀 Getting Started

### Prerequisites

- PHP >= 8.0
- Composer
- Laravel
- MySQL or PostgreSQL
- Node.js & NPM (optional for front-end)

---

### Installation

```bash
# Clone the repository
git clone https://github.com/your-username/workbridge-api.git
cd workbridge-api

# Install dependencies
composer install

# Copy and configure environment variables
cp .env.example .env

# Generate application key
php artisan key:generate

# Set up your database in .env and run migrations
php artisan migrate

# (Optional) Install passport or sanctum for auth if used
# php artisan passport:install

# Start development server
php artisan serve
```

---

## 🔐 API Authentication

This API supports:
- Email/Password login
- Google OAuth login
- Token-based authentication using Laravel Sanctum or Passport

Make sure to include your token in the `Authorization` header as:

```
Authorization: Bearer <your-token>
```

---

## 📌 Future Enhancements

- Admin dashboard
- Job filtering and search
- Messaging between users
- Application status tracking
- Notifications

## 📄 License

This project is licensed under the [MIT License](LICENSE).
