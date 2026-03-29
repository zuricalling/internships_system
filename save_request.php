<?php
// Show errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 1. เริ่มต้น Session และตั้งค่าแสดง Error เพื่อการ Debug
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 2. เชื่อมต่อฐานข้อมูล
require_once 'connect.php';

// 3. ตรวจสอบสิทธิ์ (Security Check)
if (!isset($_SESSION['student_id'])) {
    die("Error: คุณไม่มีสิทธิ์เข้าถึงหน้านี้ กรุณาล็อกอินก่อน");
}

// เช็คว่ามีค่าส่งมาไหม
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("กรุณาส่งข้อมูลผ่านฟอร์มเท่านั้น!");
}

// และเช็คว่ามีค่าส่งมาครบไหม
if (empty($_POST['company_id']) || empty($_POST['start_date'])) {
    die("กรุณากรอกข้อมูลให้ครบถ้วนก่อนส่ง");
}
// 4. รับค่าจากฟอร์ม (ต้องตั้งชื่อ name ใน HTML ให้ตรงกับใน $_POST)
$student_id = $_SESSION['student_id']; // ดึงจาก Session ของคนที่ Login
$company_id = mysqli_real_escape_string($conn, $_POST['company_id']);
$start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
$end_date   = mysqli_real_escape_string($conn, $_POST['end_date']);
$position   = mysqli_real_escape_string($conn, $_POST['position']);
$status_id  = 1; // สถานะเริ่มต้นคือ 1 (รับเรื่อง) ตาม Master Data

// 5. เริ่มกระบวนการบันทึกข้อมูล (Step 1: บันทึกใบคำขอหลัก)
$sql_request = "INSERT INTO Internships_Request (student_id, company_id, start_date, end_date, position, status_id) 
                VALUES ('$student_id', '$company_id', '$start_date', '$end_date', '$position', '$status_id')";

if (mysqli_query($conn, $sql_request)) {
    
    // ดึงเลข ID ล่าสุดที่เพิ่งรัน AUTO_INCREMENT ออกมา
    $new_request_id = mysqli_insert_id($conn);
    
    // 6. บันทึกประวัติลงตาราง Log (Step 2: บันทึก Status_Log)
    // old_status_id ส่งเป็น NULL เพราะเป็นการยื่นครั้งแรก
    $log_remarks = "นิสิตยื่นคำขอฝึกงานใหม่ผ่านระบบ";
    $sql_log = "INSERT INTO Status_Log (request_id, old_status_id, new_status_id, remarks) 
                VALUES ('$new_request_id', NULL, 1, '$log_remarks')"; 
    
    if (mysqli_query($conn, $sql_log)) {
        // บันทึกสำเร็จทั้ง 2 ตาราง
        echo "<script>
                alert('ยื่นคำขอฝึกงานสำเร็จ! เลขที่คำขอของคุณคือ: $new_request_id');
                window.location.href = 'request_form.php'; 
              </script>";
    } else {
        // พังที่ตาราง Log (อาจติด Foreign Key)
        echo "บันทึกประวัติ (Log) ล้มเหลว: " . mysqli_error($conn);
    }

} else {
    //  พังที่ตารางหลัก (อาจใส่ข้อมูลผิดประเภท หรือหา ID ไม่เจอ)
    echo "เกิดข้อผิดพลาดในการบันทึกคำขอ: " . mysqli_error($conn);
}

// 7. ปิดการเชื่อมต่อ
mysqli_close($conn);
?>