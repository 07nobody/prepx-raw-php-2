# prepx-raw-php-2
---

**PrepX** is a lightweight, **raw PHP** online mock test platform designed for **exam preparation**. It features a **modern UI (Mentor Bootstrap)**, an **Admin Dashboard (SB Admin)**, and a **MySQL database** for exam management.  

## 🎯 **Project Highlights**  
✅ **Mentor Bootstrap** for the user interface.  
✅ **SB Admin Dashboard** for exam and user management.  
✅ **Raw PHP (No Frameworks)** for lightweight performance.  
✅ **Secure User Authentication** with sessions.  
✅ **MySQL Database** for data storage.  
✅ **Bootstrap 5 + FontAwesome** for a modern UI.  
✅ **Runs Locally on Ubuntu** with Apache and MySQL.  

---

## 📂 **Project Folder Structure**  
```
/prepX
│── /admin               # Admin Dashboard (SB Admin)
│    ├── index.php       # Admin Dashboard Home
│    ├── users.php       # Manage Users
│    ├── tests.php       # Manage Tests
│    ├── results.php     # View Results
│    ├── assets/         # Admin CSS, JS, Images
│── /assets              # Global CSS, JS, Images
│── /includes            # Common Components (Header, Footer, Config)
│── /templates           # Reusable UI Components
│── /database            # Database Connection & Queries
│── index.php            # Homepage (Mentor Bootstrap)
│── login.php            # User Login
│── register.php         # User Registration
│── dashboard.php        # User Dashboard
│── start-test.php       # Start an Exam
│── results.php          # Show Exam Results
│── db.php               # Database Connection
│── .htaccess            # Security Rules
│── README.md            # Project Documentation
```

---

## 🛠️ **Installation Guide (Ubuntu 22.04+)**  

### **1️⃣ Install Apache, PHP, and MySQL**  
```bash
sudo apt update && sudo apt upgrade -y
sudo apt install apache2 php php-mysql mysql-server unzip -y
```

### **2️⃣ Clone the Repository**  
```bash
cd /var/www/html/
git clone <repo-url> prepX
cd prepX
```

### **3️⃣ Set Up Database**  
```bash
sudo mysql -u root -p
CREATE DATABASE prepX_db;
exit
```
Now import the database schema:  
```bash
mysql -u root -p prepX_db < database.sql
```

### **4️⃣ Configure Database Connection**  
Edit `db.php` and set your MySQL details:  
```php
<?php
$host = "localhost";
$user = "root";
$pass = "yourpassword";
$db = "prepX_db";
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```

### **5️⃣ Set File Permissions**  
```bash
sudo chown -R www-data:www-data /var/www/html/prepX
sudo chmod -R 755 /var/www/html/prepX
```

### **6️⃣ Restart Apache and Open in Browser**  
```bash
sudo systemctl restart apache2
```
Now, open **http://localhost/prepX** in your browser.

---

## 🎨 **Frontend (Mentor Bootstrap Template)**  
- The user interface is powered by **[Mentor Bootstrap](https://builder.bootstrapmade.com/demo/Mentor/)**.  
- Modify UI files inside:  
  ```
  /templates/
  ```
- Customize **colors, fonts, and layouts** in `/assets/css/`.

## 🔥 **Admin Panel (SB Admin Dashboard)**  
- The backend is powered by **[SB Admin](https://startbootstrap.com/previews/sb-admin/)**.  
- Manage users, tests, and results via:  
  ```
  /admin/
  ```
- Modify dashboard elements inside `/admin/js/` and `/admin/css/`.

---

## 🚀 **Features & Upcoming Enhancements**  
✔️ User Registration & Login with Sessions  
✔️ Create, Edit & Delete Exams  
✔️ Take Mock Tests with Timer  
✔️ Auto-Calculate Results & Rankings  
✔️ Secure Authentication & Data Encryption  

🔜 **Upcoming Enhancements**  
- [ ] Secure JWT Authentication  
- [ ] Payment Gateway for Paid Exams  
- [ ] Timed Exam with Auto-Submit  
- [ ] AI-Based Performance Analysis  

---

## 📜 **License**  
This project is **open-source** and follows the **MIT License**.  

