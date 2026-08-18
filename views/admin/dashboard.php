<div class="subheader py-2 py-lg-4 subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">

            <div class="d-flex align-items-center flex-wrap mr-2">

                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">داشبورد</h5>

                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>

                <span class="text-muted font-weight-bold mr-4">نمایش اطلاعات کلی سایت</span>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon"><i class="flaticon2-favourite text-primary"></i></span>
                    <h3 class="card-label">داشبورد<span class="text-danger"></span></h3>
                </div>
            </div>

    </div>
</div>
<?php
$pageTitle = " داشبورد پنل " . TYPES_USERS[$_SESSION['admin_info']['userType']][1];
$pageScript = "
    <script src='../../assets/admin/js/pages/widgets.js'></script>
    <script src='../../assets/admin/js/sweetalert.js'></script>
    <script src='../../assets/admin/js/main.js'></script>
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
    </script>
    
            <script>
            setTimeout(MyReload, 60000);
            function MyReload(){
                Swal.fire({
                title: 'در حال بروزرسانی اطلاعات ',
                html: 'لطفا منتظر بمانید',
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                  Swal.showLoading()
                  const b = Swal.getHtmlContainer().querySelector('b')
                  timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
                  }, 1000)
                },
                willClose: () => {
                  clearInterval(timerInterval)
                }
              }).then(()=>{
                   location.reload(); 
              }) 
            }
             
            </script>
 
";
$pageLink = "
    <link href='../../assets/admin/css/style.bundle.rtl.css' rel='stylesheet' type='text/css' />
    <link href='../../assets/admin/css/themes/layout/header/base/light.rtl.css' rel='stylesheet'
        type='text/css' />
    <link href='../../assets/admin/css/themes/layout/aside/dark.rtl.css' rel='stylesheet' type='text/css' />
";
?>