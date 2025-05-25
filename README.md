<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 📚 Learning Management System (LMS)

A lightweight and cross-platform online school system designed to simplify how teachers manage tasks and how students submit and track their assignments.

## ✨ Features

- 📝 **Teacher Dashboard**
  - Create, assign, and grade student tasks
  - View and manage submissions

- 🎓 **Student Portal**
  - Submit assignments with file uploads
  - Track submission status and grades

- 🧠 **Cross-Platform Compatibility**
  - Works on Linux, Windows, and macOS

- 📄 **Automatic Office to PDF Conversion**
  - Uses LibreOffice to convert `.doc`, `.docx`, `.odt`, and similar formats to `.pdf` for standardized submissions and grading

## 🚧 Technologies Used

- **Backend:** Laravel
- **Frontend:** Tailwind
- **File Conversion:** LibreOffice CLI

## 📦 Installation

> Requirements:
> - Composer
> - PHP 8.4
> - NPM
> - LibreOffice installed and added to `PATH`

```bash
# Clone the repo
git clone https://github.com/FairusKN/lms.git
cd lms

# Install dependencies
composer install
npm install && run build

# Run the application
composer run build
