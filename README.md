# Logistics Management System

## Overview

This project is part of the final project to graduate from the Mec to learn programming course in backend development. The project was built using Laravel 10, JavaScript, OOP (Object-Oriented Programming), and other modern web development practices.

**Repository:** [Marwan Yasser's Backend Repository](https://github.com/marwanyasser227/Backend.git)

---

## Features

- **User Management**: Handle client and admin user accounts.
- **Shipment Management**: Manage shipment details, including creation, tracking, and status updates.
- **Profits and Losses Calculation**: Calculate profits, losses, and track financial metrics related to shipments.
- **Admin Dashboard**: Provides an admin interface to view, edit, and delete user and shipment data.
- **Dynamic Tables**: Display data in well-structured tables with pagination, sorting, and filtering.
- **Notifications System**: Real-time notifications and alerts for various actions.
- **City & Governate and Area Relationships**: Manage shipments based on cities, areas, and their respective governates.
- **CRUD Operations**: Full Create, Read, Update, Delete (CRUD) operations for users, shipments, and other related entities.

---

## Installation

Follow these steps to set up the project on your local development environment:

### Prerequisites

- **PHP** (minimum version 8.0+)
- **Laravel 10** (minimum version 10.x)
- **Composer**: Dependency manager for PHP.
- **Database**: MySQL or PostgreSQL.

### Steps

1. **Clone the Repository**  
   
   git clone https://github.com/marwanyasser227/Backend.git
   cd Backend

2. **composer install**

    composer install
    npm install

3. **Copy the .env file and Generate the Key**
    copy .env.example to .env
    then write in termianl : php artisan key:generate

4. **Update the .Env database records**
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=logisticssystems
    DB_USERNAME=your_db_username
    DB_PASSWORD=your_db_password

5. **Migrate the data**
    php artisan migrate

6. **Seeding Data --optinal --**
    php artisan db:seed

    we only use one seeder and factory for admin only for test; so make sure you register and admin account using UI or seeder.
    
7. **Start Server**
    php artisan serve


### Usage
    Admin Panel: Access the admin dashboard at http://localhost:8000/dashboard/main or customize your base URL.
    User Panel: Users can access their profile page for managing shipments and tracking.
    Shipment Tracking: Users can track shipments, view shipment details.
    Notifications: Receive normal notifications based on shipment statuses and updates, login, register and logout.

### License
    License
    This project is licensed under a Private License. Permission to access and use the project is required. For inquiries or access requests, please contact [marwanoffical098@gmail.com].

    Let me know if further adjustments are needed!
