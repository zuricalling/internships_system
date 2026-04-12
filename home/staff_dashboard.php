<?php include 'db_connect.php'; if(!isset($_SESSION['user_id']) || $_SESSION['role']!='staff') { header("Location: portal.php"); exit(); }
if($_SERVER['REQUEST_METHOD']=='POST') { $conn->query("UPDATE internship_requests SET status='{$_POST['s']}' WHERE id='{$_POST['id']}'"); }
$res = $conn->query("SELECT * FROM internship_requests ORDER BY id DESC");
?>
<!DOCTYPE html><html lang="th"><head><meta charset="UTF-8"><title>ระบบเจ้าหน้าที่</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" href="style.css"></head>
<body class="dash-body p-0">
    <div class="dash-topbar d-flex justify-content-between" style="background:#c4122d;"><span class="fs-5 fw-bold text-white">ระบบจัดการ (Staff)</span><span>Admin | <a href="logout.php" class="text-white fw-bold text-decoration-none">ออกจากระบบ</a></span></div>
    <div class="container-fluid px-5 py-4"><div class="card card-form"><div class="card-header py-3">คำขอฝึกงานทั้งหมด</div><div class="card-body bg-white p-0"><table class="table table-hover text-center m-0 align-middle"><thead class="table-light"><tr><th>นักศึกษา</th><th>บริษัท</th><th>สถานะ</th><th>อัปเดต</th></tr></thead><tbody>
        <?php while($r=$res->fetch_assoc()): ?><tr><td class="text-danger fw-bold"><?php echo $r['student_id'];?></td><td><?php echo $r['company_name'];?></td><td><span class="status-badge bs-<?php echo $r['status'];?>">Status: <?php echo $r['status'];?></span></td><td><form method="POST" class="d-flex justify-content-center gap-2"><input type="hidden" name="id" value="<?php echo $r['id'];?>"><select name="s" class="form-select form-select-sm" style="width:130px;"><option value="1">1: รับเรื่อง</option><option value="3">3: ออกใบส่งตัว</option><option value="9">9: ยกเลิก</option></select><button class="btn btn-dark btn-sm">บันทึก</button></form></td></tr><?php endwhile;?>
    </tbody></table></div></div></div>
</body></html>