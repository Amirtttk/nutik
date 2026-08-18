<!DOCTYPE html>
<html lang="fa" dir="rtl" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نوتیک</title>

    <link rel="stylesheet" href="./../../assets/user/css/main.css">

</head>
<body class="max-w-[1700px] mx-auto bg-[#F5F7Fa]">
<?= $_SESSION['page']['content'] ?>
<!-- Footer -->
</body>
<script src="../../assets/user/js/main.js"></script>
<script src='../../assets/user/js/jquery-3.2.1.min.js'></script>
<script src='./../../assets/user/js/sweetalert.js'></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            document.getElementById('btnSearchProduct').click();
        }
    });
</script>
</html>
<?= $_SESSION['page']['script'] ?>
<?php
$pageTitle = "ورود | ثبت نام ";
$pageScript = "
 

 
";
$pageLink = " <link rel='stylesheet' href='./../../assets/user/css/main.css'>"
?>



