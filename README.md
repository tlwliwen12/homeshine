# HomeShine House Cleaning Appointment System

## 1. Project Introduction

HomeShine is a web-based house cleaning appointment system developed with Laravel. The system connects customers, cleaners, and administrators in one platform. Customers can browse cleaning services, book appointments, make payments, view booking status, and submit reviews. Cleaners can view available or assigned jobs, accept or reject booking requests, update job progress, and check their transaction records. Administrators can manage users, services, bookings, refunds, cleaner payouts, customer account status, reviews, notifications, and financial reports.

This project is suitable for a Web Application Development, Database System, Software Engineering, or Final Year Project demonstration. It shows the main workflow of a real appointment platform, including user authentication, role-based access control, profile management, service management, booking management, online payment, notifications, reviews, refunds, payouts, and report export.

---

## 2. Project Objectives

The main objectives of this system are:

1. To provide a convenient platform for customers to book house cleaning services.
2. To allow cleaners to receive, manage, and update cleaning jobs.
3. To allow administrators to manage users, services, bookings, and financial records.
4. To organize the project using Laravel MVC architecture for better maintainability.
5. To store users, services, bookings, payments, reviews, and transactions in MySQL.
6. To implement role-based access control so each user type can only access related pages.
7. To provide a complete business workflow that can be clearly demonstrated to a lecturer.

---

## 3. User Roles

The system contains three main user roles.

### 3.1 Customer

A customer is the user who books cleaning services. Customers can register an account, log in, edit their profile, view services, book cleaning services, make payments, cancel or reschedule bookings, check payment status, and submit reviews after a service is completed.

### 3.2 Cleaner

A cleaner is the user who provides cleaning services. After registration, a cleaner must verify their email and wait for administrator approval. Once approved, the cleaner can log in, view booking requests, accept or reject bookings, view job lists, update job status, manage personal and bank details, and check transaction records.

### 3.3 Administrator

An administrator is the system manager. Administrators can view the admin dashboard, manage cleaner applications, manage customers, manage services, view bookings, process refunds, process cleaner payouts, view transactions, export finance reports as PDF, and manage reviews and system notifications.

---

## 4. Technologies Used

| Item | Technology |
| --- | --- |
| Backend Framework | Laravel 12 |
| Programming Language | PHP 8.2 or above |
| Database | MySQL |
| Frontend | HTML5, CSS3, JavaScript |
| Styling | Bootstrap, Tailwind / Vite assets |
| Local Server | XAMPP Apache |
| Package Manager | Composer, npm |
| Payment Integration | ToyyibPay |
| PDF Export | barryvdh/laravel-dompdf |
| Hosting | InfinityFree |

---

## 5. System Requirements

Before installing and running the system, make sure the following software is installed:

1. XAMPP, including Apache and MySQL.
2. PHP 8.2 or above.
3. Composer.
4. Node.js and npm.
5. A web browser such as Google Chrome, Microsoft Edge, or Firefox.
6. Stable internet connection for installing Composer and npm dependencies.

The recommended local environment is Windows with XAMPP. Example project path:

```text
C:\xampp\htdocs\homeshine
```

---

## 6. Project Folder Structure

Important folders and files in this project:

```text
homeshine/
+-- app/
|   +-- Http/Controllers/       Controllers for page requests and business logic
|   +-- Models/                 Models connected to database tables
|   +-- Notifications/          Laravel notification classes
|   +-- Services/               Payment, refund, payout, and booking service classes
+-- config/                     Laravel configuration files
+-- database/
|   +-- migrations/             Database table structure files
|   +-- seeders/                Initial or test data files
+-- public/                     Public assets and index.php entry point
+-- resources/
|   +-- views/                  Blade template files
|   +-- css/                    Frontend CSS files
|   +-- js/                     Frontend JavaScript files
+-- routes/
|   +-- web.php                 Web route definitions
+-- storage/                    Uploaded files, cache, and logs
+-- .env                        Local environment configuration
+-- composer.json               PHP dependency configuration
+-- package.json                Frontend dependency configuration
+-- README.md                   Project documentation
```

---

## 7. Installation Guide

### Step 1: Place the Project Files

Put the project folder inside the XAMPP `htdocs` directory.

Example:

```text
C:\xampp\htdocs\homeshine
```

If your project folder name is not `homeshine`, adjust the path in the following commands based on your actual folder name.

### Step 2: Start XAMPP

Open XAMPP Control Panel and start:

1. Apache
2. MySQL

If Apache cannot start, port 80 may already be used by another program. Close the conflicting program or change the Apache port in XAMPP.

### Step 3: Create the Database

Open phpMyAdmin in your browser:

```text
http://localhost/phpmyadmin
```

Create a new database named:

```text
homeshine
```

Recommended collation:

```text
utf8mb4_general_ci
```

If the project includes an SQL backup file such as `homeshine.sql`, select the `homeshine` database in phpMyAdmin and use the Import function to import the file.

If there is no SQL file, the database tables can be created using Laravel migrations. The command is shown in Step 8.

### Step 4: Install PHP Dependencies

Open Command Prompt or PowerShell and go to the project folder:

```bash
cd C:\xampp\htdocs\homeshine
```

Run:

```bash
composer install
```

This command installs Laravel and other PHP packages based on `composer.json`.

### Step 5: Install Frontend Dependencies

Run:

```bash
npm install
```

To build frontend assets, run:

```bash
npm run build
```

For development mode, run:

```bash
npm run dev
```

### Step 6: Create the `.env` File

If the `.env` file does not exist, copy `.env.example`:

```bash
copy .env.example .env
```

Open `.env` and confirm the database settings:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homeshine
DB_USERNAME=root
DB_PASSWORD=
```

The default MySQL username in XAMPP is usually `root`, and the password is usually empty. If your MySQL has a password, update `DB_PASSWORD`.

### Step 7: Generate the Application Key

Run:

```bash
php artisan key:generate
```

This command generates `APP_KEY` inside `.env`. Without `APP_KEY`, Laravel session, encryption, and login functions may not work correctly.

### Step 8: Create Database Tables

If you already imported a complete SQL file, you may skip this step.

If you did not import an SQL file, run:

```bash
php artisan migrate
```

To rebuild all tables from the beginning, run:

```bash
php artisan migrate:fresh
```

Warning: `migrate:fresh` deletes existing tables and data. Use it only when you are sure the current data is not needed.

### Step 9: Create the Storage Link

Run:

```bash
php artisan storage:link
```

This allows uploaded images or public storage files to be accessed from `public/storage`.

### Step 10: Clear Laravel Cache

If the system still reads old settings after editing `.env`, run:

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### Step 11: Run the Application

Run:

```bash
php artisan serve
```

The system will be available at:

```text
http://127.0.0.1:8000
```

Open the URL in your browser to use the system.

---

## 8. Login Credentials

The following accounts can be used for demonstration. If the actual database credentials are different, follow the records in the database.

### Administrator

```text
Email: dspd27940@gmail.com
Password: Admin123!
```

### Customer

```text
Email: tohliwen@graduate.utm.my
Password: Liwen@0808
```

### Cleaner

```text
Email: tlwliwen12@gmail.com
Password: Liwen@0610
```

---

## 9. Feature Description

### 9.1 Home Page

The home page introduces the HomeShine platform and its cleaning services. Visitors can go to the login page, registration page, or send an inquiry through the contact form.

Related routes:

```text
/
/contact/send
```

### 9.2 Registration and Login

The system provides registration, login, logout, forgot password, and reset password features. Users are directed to different workflows based on their roles. Cleaner accounts require email verification and administrator approval before full access is allowed.

Related routes:

```text
/register
/login
/logout
/forgot-password
/reset-password/{token}
/email/verify
```

### 9.3 Customer Features

After logging in, a customer can:

1. View the customer dashboard.
2. Browse all cleaning services.
3. View details of a selected service.
4. Choose a service and enter booking date, time, address, and notes.
5. View booking history and booking status.
6. Cancel or reschedule a booking.
7. Go to the payment page and complete payment.
8. View payment records.
9. Submit a review after the service is completed.
10. Edit profile, address, phone number, and password.
11. View and mark notifications as read.

Main pages:

```text
/customer/dashboard
/customer/services
/customer/bookings
/customer/payments
/customer/profile
```

### 9.4 Cleaner Features

After logging in, a cleaner can:

1. View the cleaner dashboard.
2. View new booking requests.
3. Accept or reject booking requests.
4. View accepted or assigned jobs.
5. Update job status.
6. Edit profile and bank details.
7. Update password.
8. View transaction records and earnings.
9. View and mark notifications as read.

Main pages:

```text
/cleaner/dashboard
/cleaner/bookings
/cleaner/jobs
/cleaner/profile
/cleaner/transactions
```

### 9.5 Administrator Features

After logging in, an administrator can:

1. View the admin dashboard.
2. View all bookings and booking details.
3. Manage cleaner accounts, including approval, rejection, and deletion.
4. Manage customer accounts, including viewing details, suspending, activating, and deleting.
5. View customer statistics.
6. Create, edit, and delete cleaning services.
7. View all reviews.
8. View transaction records.
9. Export finance reports as PDF.
10. Process refunds.
11. Process cleaner payouts.
12. View and mark notifications as read.

Main pages:

```text
/admin/dashboard
/admin/bookings
/admin/cleaners
/admin/customers
/admin/services
/admin/reviews
/admin/transactions
/admin/refunds
```

---

## 10. Main Business Workflows

### 10.1 Customer Booking Workflow

1. The customer registers or logs in.
2. The customer opens the services page.
3. The customer selects a service and enters the booking page.
4. The customer fills in date, time, address, and notes.
5. The system creates a booking record.
6. The customer goes to the payment page and completes payment.
7. The system updates the payment status.
8. The cleaner receives a booking request or job assignment.
9. The cleaner accepts the booking and performs the service.
10. The cleaner updates the job status.
11. After the service is completed, the customer can submit a review.

### 10.2 Cleaner Registration and Approval Workflow

1. The cleaner creates an account on the registration page.
2. The system sends an email verification notification.
3. The cleaner verifies the email address.
4. The administrator receives a cleaner registration notification.
5. The administrator opens the cleaner management page.
6. The administrator approves or rejects the cleaner.
7. An approved cleaner can log in and receive jobs.

### 10.3 Refund Workflow

1. The customer cancels an eligible booking.
2. The system records the refund status.
3. The administrator opens the refund page.
4. The administrator reviews and processes the refund.
5. The system saves the refund reference number and refund date.
6. The user receives the related notification.

### 10.4 Cleaner Payout Workflow

1. The cleaner completes the assigned job.
2. The system records cleaner earnings and company commission.
3. The administrator opens the payout page.
4. The administrator processes the cleaner payout.
5. The system saves the payout reference number and payout date.
6. The cleaner can view the payout status in transaction records.

---

## 11. Database Description

The system mainly uses the following tables:

| Table | Purpose |
| --- | --- |
| users | Stores customer, cleaner, and administrator accounts |
| services | Stores cleaning service information |
| bookings | Stores booking, payment, refund, payout, and cleaner assignment information |
| reviews | Stores customer reviews |
| notifications | Stores system notifications |
| finance_transactions | Stores financial transaction records |
| booking_cleaner_status | Stores cleaner accept or reject status for bookings |
| jobs | Stores Laravel queue job data |
| cache | Stores Laravel cache data |

### 11.1 `users` Table

The `users` table stores all user accounts. The system uses the `role` field to identify user type:

```text
admin
customer
cleaner
```

Cleaner accounts also use `approval_status` to indicate whether they have been approved by an administrator.

### 11.2 `bookings` Table

The `bookings` table is the core table of the system. It stores booking details such as customer, service, date, time, address, notes, booking status, payment status, refund status, assigned cleaner, cleaner earnings, company commission, refund reference, and payout reference.

### 11.3 `services` Table

The `services` table stores cleaning service information, such as service name, price, category, duration, description, and image.

### 11.4 `reviews` Table

The `reviews` table stores customer reviews for completed services. These reviews help administrators monitor service quality and customer feedback.

---

## 12. Payment and Third-Party Service Setup

This project includes ToyyibPay payment integration. Payment-related service classes are located in:

```text
app/Services/ToyyibPayService.php
app/Services/PaymentService.php
app/Services/RefundService.php
app/Services/PayoutService.php
```

To use ToyyibPay in a real environment, configure the API URL, secret key, category code, or other payment settings in `.env`. The exact values should match the ToyyibPay account settings.

Example:

```env
TOYYIBPAY_URL=https://dev.toyyibpay.com
TOYYIBPAY_SECRET_KEY=your_secret_key
TOYYIBPAY_CATEGORY_CODE=your_category_code
```

For classroom demonstration, a test environment can be used. If payment credentials are not available, the payment page and booking flow can still be shown as part of the system demonstration.

---

## 13. Email and Notification Setup

The system uses Laravel notifications for email verification, password reset, booking notifications, payment notifications, refund notifications, and cleaner approval notifications.

To send real emails, configure SMTP settings in `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=dspd27940@gmail.com
MAIL_PASSWORD=ndyjpwbobgstlvrp
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=dspd27940@gmail.com
MAIL_FROM_NAME="HomeShine"
```

If SMTP is not available in the local environment, use Laravel log mail for testing:

```env
MAIL_MAILER=log
```

The email content will be written to:

```text
storage/logs/laravel.log
```

---

## 14. Routes and Access Control

The main web routes are defined in:

```text
routes/web.php
```

The system uses middleware to control access for different roles:

```text
role:customer
role:cleaner
role:admin
```

The role middleware is located at:

```text
app/Http/Middleware/RoleMiddleware.php
```

This ensures that:

1. Customers cannot access the administrator backend.
2. Cleaners cannot access customer booking pages.
3. Administrators are separated from normal user features.
4. Guests must log in before accessing protected pages.

---

## 15. Suggested Demonstration Flow

When presenting the system to a lecturer, the following flow is recommended:

1. Open the home page and introduce the system topic and objectives.
2. Log in using the customer account.
3. Show the service list and create a booking.
4. Show the customer's booking records and payment page.
5. Log out and log in using the cleaner account.
6. Show cleaner booking requests, job list, and job status update.
7. Log out and log in using the administrator account.
8. Show the admin dashboard, booking management, service management, customer management, and cleaner management.
9. Show transaction records and PDF finance report export.
10. Explain how role-based access control protects pages for different users.

---

## 16. Common Problems and Solutions

### 16.1 `composer install` Fails

Possible reasons:

1. Composer is not installed.
2. PHP version is lower than required.
3. Internet connection is unstable.

Check with:

```bash
php -v
composer -V
composer install
```

Make sure PHP version is 8.2 or above.

### 16.2 `php artisan serve` Cannot Start

Make sure you are in the project root folder:

```bash
cd C:\xampp\htdocs\homeshine
php artisan serve
```

If port 8000 is already used, run the application on another port:

```bash
php artisan serve --port=8001
```

Then open:

```text
http://127.0.0.1:8001
```

### 16.3 Database Connection Fails

Check the following:

1. XAMPP MySQL is running.
2. The database name in `.env` is `homeshine`.
3. MySQL username and password are correct.
4. The database has been created in phpMyAdmin.

After editing `.env`, run:

```bash
php artisan config:clear
```

### 16.4 Page Style Does Not Display

Run:

```bash
npm install
npm run build
```

For development mode, open another terminal and run:

```bash
npm run dev
```

### 16.5 Images or Uploaded Files Do Not Display

Run:

```bash
php artisan storage:link
```

Also confirm that the image files are stored in the correct public directory.

### 16.6 Emails Are Not Sent

Check mail settings in `.env`. If SMTP is not available, use:

```env
MAIL_MAILER=log
```

Then check:

```text
storage/logs/laravel.log
```

---

## 17. Testing and Final Checking

The project includes basic Laravel test configuration. To run tests:

```bash
php artisan test
```

You can also use the Composer test script:

```bash
composer test
```

Before submitting the project, check the following:

1. The home page can be opened successfully.
2. Customer, cleaner, and administrator accounts can log in.
3. Different roles are redirected to different dashboards.
4. Customers can create bookings.
5. Cleaners can view and manage jobs.
6. Administrators can manage services, users, and bookings.
7. Database records are created or updated correctly.
8. Images, CSS, and JavaScript load correctly.
9. The `.env` file should not be shared publicly because it may contain passwords or API keys.

---

## 18. Hosting Information

This project can also be deployed to online hosting. The current README records InfinityFree as the hosting platform.

Hosted URL:

```text
http://homeshine.infinityfreeapp.com/
```

Deployment notes:

1. Upload project files to the hosting server.
2. Create an online MySQL database.
3. Update online `.env` database settings.
4. Set `APP_URL` to the live website URL.
5. Run migrations or import the SQL file.
6. Make sure the website entry point is the `public` directory.
7. If the hosting platform does not support `php artisan serve`, use the hosting Apache / Nginx server to point to the `public` directory.

---

## 19. Project Limitations

The project already implements the main appointment management workflow, but it can still be improved in the following areas:

1. Add more complete automated tests.
2. Add stricter booking time conflict validation.
3. Add more detailed administrator charts and statistics.
4. Improve error handling for failed payments, failed refunds, and network issues.
5. Add multilingual support, such as English, Malay, and Chinese.
6. Add detailed service area management.
7. Add cleaner rating and recommendation features.

---

## 20. Conclusion

HomeShine House Cleaning Appointment System is a complete house cleaning appointment platform. It uses Laravel as the backend framework, MySQL as the database, and Blade templates for role-based interfaces. The system includes user management, booking management, service management, payment, refund, payout, notification, review, and report features. It demonstrates the major development workflow and database design of a real appointment management system.

---

## 21. Author Information

Student Name:

```text
Toh Li Wen
Tiong Yong Hern
Yong Wai Keat
```

Project Title:

```text
HomeShine House Cleaning Appointment System
```
