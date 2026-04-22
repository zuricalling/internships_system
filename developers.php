<?php include('includes/db_connect.php'); ?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>คณาจารย์ประจำหลักสูตร - IS SWU</title>
    <!-- ไฟล์ CSS Bootstrap และ FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">

    <style>
    .teacher-hero {
        background: linear-gradient(135deg, rgba(196, 18, 45, 0.9), rgba(33, 37, 41, 0.9)), url('./img/berner.jpg') center/cover;
        padding: 80px 0;
        color: white;
        text-align: center;
        margin-top: 0;
        /* <--- เปลี่ยนตรงนี้เป็น 0 (แบนเนอร์จะชิดขอบพอดี) */
        margin-bottom: 40px;
    }

    /* ตกแต่งการ์ดอาจารย์ ให้เมาส์เป็นรูปนิ้วมือเวลาชี้ */
    .teacher-card {
        background: white;
        border: 1px solid #eaeaea;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        padding: 80px 20px;
        text-align: center;
        transition: all 0.3s ease;
        height: 100%;
        cursor: pointer;
    }

    .teacher-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(196, 18, 45, 0.15);
        border-color: #c4122d;
    }

    .profile-img-wrapper {
        width: 140px;
        height: 140px;
        background-color: #f8f9fa;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px auto;
        overflow: hidden;
        border: 3px solid white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .profile-img-wrapper img {
        width: 85%;
        height: 85%;
        object-fit: cover;
        border-radius: 50%;
    }

    .click-hint {
        font-size: 11px;
        color: #c4122d;
        margin-top: 15px;
        font-weight: bold;
    }

    /* ตกแต่งใน Modal (Popup) */
    .modal-profile-img {
        width: 100%;
        max-width: 200px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .info-list {
        list-style: none;
        padding-left: 0;
        font-size: 14px;
        line-height: 2;
        color: #444;
        text-align: left;
    }

    .info-list i {
        color: #c4122d;
        width: 25px;
        text-align: center;
    }
    </style>
</head>

<body class="bg-light">

    <?php include 'navbar.php'; ?>

    <div class="teacher-hero pb-5">
        <div class="container py-4">
            <h1 class="fw-bold mb-3">
                <i class="fas fa-chalkboard-teacher mb-2"></i>
                <br>คณะผู้จัดทำ
            </h1>
            <p class="fs-6 fw-light mb-0">รายชื่อนิสิตผู้จัดทำและพัฒนาเว๊บไซต์</p>
        </div>
    </div>
    <div class="container py-5 mt-4" id="showcase">

        <h3 class="fw-bold text-danger mb-4 border-start border-4 border-danger ps-3">
            <i class="fa-solid fa-user"></i> รายชื่อ
        </h3>
        <div class="container py-3 mb-2" style="max-width: 1100px;">
            <div class="row g-4 justify-content-center">

                <!-- ================ อาจารย์ dit ================ -->
                <div class="col-12 mb-4">
                    <div class="teacher-card" data-bs-toggle="modal" data-bs-target="#modalTeacher1">
                        <div class="profile-img-wrapper">
                            <img src="./img/t_Dit.jpg">
                        </div>
                        <h6 class="fw-bold fs-6 text-dark mb-1">ธฤษณัช ภานุกาญจน์</h6>
                        <p class="text-secondary fw-bold mb-2" style="font-size: 12px;">ฟีฟ่า</p>
                        <p class="text-muted small" style="line-height: 1.5; height: 40px;">67101010128</p>
                    
                    </div>
                </div>

                <!-- ================ อาจารย์ thiti================ -->
                <div class="col-12 col-md-8 col-lg-5">
                    <div class="teacher-card" data-bs-toggle="modal" data-bs-target="#modalTeacher2">
                        <div class="profile-img-wrapper">
                            <img src="./img/t_thiti.jpg">
                        </div>
                        <h6 class="fw-bold fs-6 text-dark mb-1">สุนัดดา แสงแก้ว</h6>
                        <p class="text-secondary fw-bold mb-2" style="font-size: 12px;">ใบเตย</p>
                        <p class="text-muted small" style="line-height: 1.5; height: 40px;">67101010132</p>
                        
                    </div>
                </div>

                <!-- ================ อาจารย์ vipakorn ================ -->
                <div class="col-12 col-md-8 col-lg-5">
                    <div class="teacher-card" data-bs-toggle="modal" data-bs-target="#modalTeacher3">
                        <div class="profile-img-wrapper">
                            <img src="./img/t_Vipakorn.jpg">
                        </div>
                        <h6 class="fw-bold fs-6 text-dark mb-1"> ชลธิชา คุณเพิ่มศิริ</h6>
                        <p class="text-secondary fw-bold mb-2" style="font-size: 12px;">เนเน่</p>
                        <p class="text-muted small" style="line-height: 1.5; height: 40px;">67101010617</p>
                        
                    </div>
                </div>

                <!-- ================ อาจารย์ chok ================ -->
                <div class="col-12 col-md-8 col-lg-5">
                    <div class="teacher-card" data-bs-toggle="modal" data-bs-target="#modalTeacher4">
                        <div class="profile-img-wrapper">
                            <img src="./img/t_Chokthamrong.jpg">
                        </div>
                        <h6 class="fw-bold fs-6 text-dark mb-1"> ณัฏฐณิชา พลาธรณ์</h6>
                        <p class="text-secondary fw-bold mb-2" style="font-size: 12px;">ไอโกะ </p>
                        <p class="text-muted small" style="line-height: 1.5; height: 40px;">67101010619</p>
                        
                    </div>
                </div>

                <!-- ================ อาจารย์ chotima ================ -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="teacher-card" data-bs-toggle="modal" data-bs-target="#modalTeacher5">
                        <div class="profile-img-wrapper">
                            <img src="./img/t_Chotima.jpg">
                        </div>
                        <h6 class="fw-bold fs-6 text-dark mb-1">ณิชาภัทร จันทร์เอี่ยม</h6>
                        <p class="text-secondary fw-bold mb-2" style="font-size: 12px;">พลอย</p>
                        <p class="text-muted small" style="line-height: 1.5; height: 40px;">67101010620</p>
                        
                    </div>
                </div>
                <!-- ================ อาจารย์ dussadee ================ -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="teacher-card" data-bs-toggle="modal" data-bs-target="#modalTeacher6">
                        <div class="profile-img-wrapper">
                            <img src="./img/t_Dussadee.jpg">
                        </div>
                        <h6 class="fw-bold fs-6 text-dark mb-1">ภูรินท์ กูลมนุญ</h6>
                        <p class="text-secondary fw-bold mb-2" style="font-size: 12px;">โต๋</p>
                        <p class="text-muted small" style="line-height: 1.5; height: 40px;">67101010641</p>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>


    

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>