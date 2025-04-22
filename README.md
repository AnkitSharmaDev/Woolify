# 🐑 Woolify - Transparent Wool Journey Tracking System

## 📌 Overview

**Woolify** is a Laravel-based application that tracks the entire journey of wool — from farms to finished fabric — ensuring **transparency**, **real-time updates**, and **quality control**.  
Designed with a highly **interactive**, **animated** UI, Woolify makes it easy for farmers, processors, and distributors to collaborate seamlessly.

---

## 🚀 Features

- 🏠 Farm Registration and Profile Management
- 🔢 Batch Tracking from Production to Distribution
- 📈 Real-Time Updates at Every Stage
- 📊 Analytics Dashboard with Visual Insights
- 🛡️ Secure Authentication (Laravel Breeze)
- 🖥️ Admin Panel with AdminLTE Styling
- 🎨 Animated, Interactive UI
- 📄 Report Generation (PDF/TXT Exports)
- ⚡ Error Handling and Deadlock-Safe Operations

---

## 🛠️ Tech Stack

| Frontend               | Backend                  | Authentication  | Database  | UI Frameworks      | Others                      |
|:-----------------------|:--------------------------|:-----------------|:----------|:--------------------|:----------------------------|
| HTML5, CSS3, Tailwind CSS | PHP (Laravel Framework)  | Laravel Breeze   | MySQL     | AdminLTE, Tailwind CSS | Chart.js, Animate.css        |

---

## 🧩 Architecture Overview

- **User Roles**: Admin, Farm Owner, Processor, Distributor
- **Core Entities**:
  - Farms
  - Batches
  - Processing Stages
  - Quality Reports
  - Final Product Records
- **Flow**:
  1. Farms register and create wool batches.
  2. Batches are processed (cleaning ➡️ spinning ➡️ weaving).
  3. Each stage updates status with handler info and timestamp.
  4. Final products are linked back to farms for full traceability.

---

## 🖼️ UI/UX Highlights

- Dynamic dashboards with real-time batch stats
- Color-coded process stages
- Mobile-responsive design
- Modal popups and smooth page transitions
- Clean animations and loaders

---

## 📋 Installation Guide

> **Requirements**: PHP >= 8.x, Composer, Node.js, MySQL, Laravel CLI

```bash
# 1. Clone the repository
git clone https://github.com/yourusername/woolify.git
cd woolify

# 2. Install PHP dependencies
composer install

# 3. Install Node.js dependencies
npm install
npm run dev

# 4. Create environment file
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Set up your database in .env

# 7. Run migrations
php artisan migrate

# 8. Start the development server
php artisan serve
