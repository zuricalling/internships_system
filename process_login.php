<?php
session_start(); // เริ่ม Session ก่อนทำอย่างอื่น
require_once 'includes/db_connect.php'; // ดึงไฟล์เชื่อมต่อ (อยู่นอกสุดไม่ต้องใช้ ../)

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // 1. ลองเช็คในตารางนิสิตก่อน (Student)
    $sql_student = "SELECT * FROM student WHERE student_code = '$username' AND password = '$password'";
    $result_student = mysqli_query($conn, $sql_student);

    if (mysqli_num_rows($result_student) == 1) {
        $row = mysqli_fetch_assoc($result_student);
        $_SESSION['user_role'] = 'student';
        $_SESSION['user_id']   = $row['student_id'];
        $_SESSION['full_name'] = $row['first_name'] . " " . $row['last_name'];
        
        header("Location: student/view_status.php"); // ล็อกอินผ่าน เด้งไปหน้าเด็ก
        exit();
    }

    // 2. ถ้าไม่เจอนิสิต ให้ลองเช็คในตารางอาจารย์ (Teacher)
    $sql_teacher = "SELECT * FROM teacher WHERE username = '$username' AND password = '$password'";
    $result_teacher = mysqli_query($conn, $sql_teacher);

    if (mysqli_num_rows($result_teacher) == 1) {
        $row = mysqli_fetch_assoc($result_teacher);
        $_SESSION['user_role'] = 'teacher';
        $_SESSION['user_id']   = $row['teacher_id'];
        $_SESSION['full_name'] = $row['first_name'] . " " . $row['last_name'];

        header("Location: staff/view_all.php"); // ล็อกอินผ่าน เด้งไปหน้าอาจารย์
        exit();
    }

    // 3. ถ้าไม่เจออาจารย์ ให้ลองเช็คในตารางเจ้าหน้าที่ (Faculty Staff)
    $sql_staff = "SELECT * FROM faculty_staff WHERE username = '$username' AND password = '$password'";
    $result_staff = mysqli_query($conn, $sql_staff);

    if (mysqli_num_rows($result_staff) == 1) {
        $row = mysqli_fetch_assoc($result_staff);
        $_SESSION['user_role'] = 'staff'; // กำหนด Role เป็น staff
        $_SESSION['user_id']   = $row['faculty_staff_id'];
        $_SESSION['full_name'] = $row['first_name'] . " " . $row['last_name'];

        header("Location: staff/view_all.php"); // เด้งไปหน้าจัดการรวมของเจ้าหน้าที่
        exit();
}

    // 4. ถ้าไม่เจอใครเลยค่อยแจ้ง Error
    echo "<script>alert('Username หรือ Password ไม่ถูกต้อง!'); window.location='login.php';</script>";
}
?>