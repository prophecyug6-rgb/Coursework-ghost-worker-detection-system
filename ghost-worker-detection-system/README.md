# Ghost Worker Detection System (GWDS)

A student web-based payroll verification prototype built with **HTML5, CSS3, PHP and MySQL**.

## 1. Main purpose
GWDS compares payroll entries with the institution's employee register and flags records that need human review. The prototype flags:
- Payroll employee numbers that do not exist in the employee register.
- Payroll entries linked to employees whose status is inactive, terminated or retired.

A flag is an exception for investigation, **not proof of fraud**.

## 2. Technology stack
- HTML5 for page structure and forms
- CSS3 for responsive styling
- PHP 8+ for server-side processing
- MySQL 8+ for persistent storage
- PDO for database access

No Python, Flask, JavaScript framework or PHP framework is used.

## 3. Repository structure
```text
ghost-worker-detection-system/
├── assets/
│   └── css/
│       └── style.css
├── database/
│   └── schema.sql
├── docs/
│   ├── PROJECT_OVERVIEW.md
│   └── TEST_PLAN.md
├── includes/
│   └── config.php
├── audit.php
├── change_password.php
├── detect.php
├── employees.php
├── import.php
├── index.php
├── investigations.php
├── login.php
├── logout.php
├── payroll.php
├── reports.php
├── setup.php
├── users.php
├── .gitignore
└── README.md
```

## 4. Run locally on Windows using XAMPP
1. Install XAMPP with Apache, PHP and MySQL.
2. Copy this folder into `C:\xampp\htdocs\`.
3. Start **Apache** and **MySQL** in XAMPP Control Panel.
4. Open `http://localhost/phpmyadmin`.
5. Import `database/schema.sql`.
6. Open `includes/config.php` and set the MySQL username/password to match your local setup. XAMPP commonly uses `root` with an empty password on a fresh local installation.
7. Visit `http://localhost/ghost-worker-detection-system/setup.php` once to create demo users and sample records.
8. Delete `setup.php` after successful setup.
9. Open `http://localhost/ghost-worker-detection-system/login.php`.

## 5. user accounts
| Role | Username | Password |
|---|---|---|
| Administrator | `admin` | `ghostworker#21` |
| HR Officer | `hr_officer` | `ghostworker#21` |
| Payroll Officer | `payroll_officer` | `ghostworker#21` |
| Auditor | `auditor` | `ghostworker#21` |

These are demonstration credentials only. Change them before any deployment. Do not use this prototype with real payroll or national identification data until it has undergone security review.

## 6. Features
- Login and role-based page access
- Administrator self-service password change with current-password verification and secure password hashing
- Employee register and employee creation/update
- Payroll record entry and listing
- Rule-based payroll anomaly detection
- Investigation status and review notes
- CSV import for employee and payroll data
- Payroll summary and CSV investigation report
- User creation and audit log
- Responsive CSS for smaller screens

## 7. CSV import formats
Employee CSV header:
```csv
employee_no,full_name,national_id,department,job_title,employment_status,appointment_date,bank_account
```
Payroll CSV header:
```csv
employee_no,pay_period,gross_amount,payment_reference,payment_date
```
Save Excel workbooks as CSV before importing. Use dummy data for demonstrations.

## 8. GitHub upload
1. Create a GitHub account and sign in.
2. Select **New repository**.
3. Name it `ghost-worker-detection-system`.
4. Choose Public or Private according to your lecturer's instructions.
5. Do not initialize with a README if you are uploading this existing folder with its README.
6. Upload the project files/folders, or use Git from your computer.
7. Confirm that the repository shows `README.md`, `database`, `includes`, `assets` and the PHP pages.

## 9. Limitations and future improvements
This is an academic prototype. It currently uses basic rule-based checks and does not integrate with national identity, bank, biometric or government HR databases. Before real institutional deployment, add stronger account administration, password reset and lockout, server-side upload validation and size limits, secure production configuration, HTTPS, backups, privacy controls, comprehensive tests and independent security testing.
