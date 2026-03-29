<?php
// ==========================================
// ไฟล์เชื่อมต่อฐานข้อมูล (Database Connection)
// ==========================================

// 1. ตั้งค่าตัวแปรสำหรับเชื่อมต่อ XAMPP / MySQL
$servername = "localhost";   // ชื่อ Server (รันในเครื่องตัวเองใช้ localhost)
$username   = "root";        // ชื่อ Username เริ่มต้นของ XAMPP
$password   = "";            // รหัสผ่าน (XAMPP ค่าเริ่มต้นจะไม่มีรหัสผ่าน ให้เว้นว่างไว้)
$dbname     = "internships"; // ชื่อฐานข้อมูลที่ตั้งไว้ใน DBeaver / phpMyAdmin

// 2. คำสั่งเชื่อมต่อฐานข้อมูล
$conn = mysqli_connect($servername, $username, $password, $dbname);

// 3. ตรวจสอบว่าเชื่อมต่อสำเร็จหรือไม่
if (!$conn) {
    // ถ้าพัง ให้หยุดการทำงานและโชว์ข้อความ Error
    die("เชื่อมต่อฐานข้อมูลล้มเหลว (Connection failed): " . mysqli_connect_error());
}

// 4. ตั้งค่าให้รองรับภาษาไทย ป้องกันภาษาต่างดาว
mysqli_set_charset($conn, "utf8mb4");

// 5. ตั้งค่า Timezone ให้เป็นเวลาประเทศไทย
date_default_timezone_set('Asia/Bangkok');
