<?php include 'db_connect.php'; if(!isset($_SESSION['user_id']) || $_SESSION['role']!='teacher') { header("Location: portal.php"); exit(); }
if(isset($_POST['app'])) { $conn->query("UPDATE internship_requests SET status=2 WHERE id='{$_POST['app']}'"); }
if(isset($_POST['ev'])) { $conn->query("UPDATE internship_requests SET evaluation='{$_POST['ev_txt']}', status=4 WHERE id='{$_POST['ev']}'"); }
$res = $conn->query("SELECT * FROM internship_requests ORDER BY id DESC");
?>
<!DOCTYPE html><html lang="th"><head><meta charset="UTF-8"><title>ระบบอาจารย์</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" href="style.css"></head>
<body class="dash-body p-0">
    <div class="dash-topbar d-flex justify-content-between" style="background:#1a2232;"><span class="fs-5 fw-bold text-white">ระบบพิจารณา (Teacher)</span><span>Teacher | <a href="logout.php" class="text-danger fw-bold text-decoration-none">ออกจากระบบ</a></span></div>
    <div class="container-fluid px-5 py-4"><div class="card card-table"><div class="card-header py-3" style="background:#343a40;">พิจารณาอนุมัติและนิเทศน์</div><div class="card-body bg-white p-0"><table class="table table-bordered text-center m-0 align-middle"><thead class="table-light"><tr><th>นักศึกษา</th><th>สถานะ</th><th>อนุมัติ (Req 5.2)</th><th>นิเทศน์ (Req 5.3)</th></tr></thead><tbody>
        <?php while($r=$res->fetch_assoc()): ?><tr><td class="text-primary fw-bold"><?php echo $r['student_id'];?></td><td><span class="status-badge bs-<?php echo $r['status'];?>">Status: <?php echo $r['status'];?></span></td>
        <td><?php if($r['status']==1):?><form method="POST"><input type="hidden" name="app" value="<?php echo $r['id'];?>"><button class="btn btn-primary btn-sm">อนุมัติ</button></form><?php else: ?>-<?php endif; ?></td>
        <td><form method="POST" class="d-flex w-75 mx-auto"><input type="hidden" name="ev" value="<?php echo $r['id'];?>"><input type="text" name="ev_txt" class="form-control form-control-sm me-2" value="<?php echo $r['evaluation'];?>" required><button class="btn btn-success btn-sm">เซฟ</button></form></td>
        </tr><?php endwhile;?>
    </tbody></table></div></div></div>
</body></html>