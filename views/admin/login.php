<?php
$type_admin_now = 0;
if (GET('secret') == whirlpool(SECRET_TOKEN['senior_manager'])) {
    $type_admin_now = 1;
} elseif (GET('secret') == whirlpool(SECRET_TOKEN['adminstrators'])) {
    $type_admin_now = 2;
} elseif (GET('secret') == whirlpool(SECRET_TOKEN['agent'])) {
    $type_admin_now = 3;
} else {
    abort();
}
?>
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-5 login-signin-on d-flex flex-row-fluid" id="kt_login">
        <div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid"
            style="background-image: url(../../assets/admin/media/bg/bg-2.jpg);">
            <div class="login-form text-center text-white p-7 position-relative overflow-hidden">
                <!--begin::Login Header-->
                <div class="d-flex flex-center mb-15">
                    <a href="#">
                        <img src="../../assets/admin/media/logos/logo-letter-13.png" class="max-h-75px" alt="" />
                    </a>
                </div>
                <!--end::Login Header-->

                <!--begin::Login Sign in form-->
                <div class="login-signin">
                    <div class="mb-20">
                        <h3 class="opacity-40 font-weight-normal">ورود به پنل <?= TYPES_USERS[$type_admin_now][1] ?>
                        </h3>
                        <p class="opacity-40">نام کاربری و کلمه عبور خود را وارد کنید</p>
                    </div>
                    <form class="needs-validation">
                        <div class="form-group">
                            <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
                                type="text" placeholder="نام کاربری" name="userName" autocomplete="off"
                                data-v-message="نام کاربری نمیتواند خالی بماند و باید حداقل 3 کاراکتر و با حروف لاتین باشد"
                                minlength="3" required />
                        </div>
                        <div class="form-group">
                            <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
                                type="password" placeholder="کلمه عبور" name="password"
                                data-v-message="رمز عبور نمیتواند خالی بماند و باید حداقل 8 کاراکتر باشد" minlength="8"
                                required />
                        </div>
                        <div>
                            <span id="userNameAlert" class="text-danger"></span>
                        </div>
                        <div class="form-group text-center mt-10">
                            <button type="button" onclick="login(<?= $type_admin_now ?>)"
                                class="btn btn-pill btn-primary opacity-90 px-15 py-3">ورود</button>
                        </div>
                    </form>
                </div>
                <!--end::Login Sign in form-->
            </div>
        </div>
    </div>
    <!--end::Login-->
</div>
<?php
$pageTitle = " ورود به پنل " . TYPES_USERS[$type_admin_now][1];
$pageScript = "
    <script src='../../assets/admin/js/jquery.js'></script>
    <script src='../../assets/admin/plugins/global/plugins.bundle.js'></script>
    <script src='../../assets/admin/js/main.js'></script>
    <script src='../../assets/admin/js/jbvalidator.js'></script>
    <script>
        $(function () {
            let validator = $('form.needs-validation').jbvalidator({
                errorMessage: true,
                successClass: true,
            });
        })
    </script>
";
$pageLink = "
    <link href='../../assets/admin/css/pages/login/classic/login.css' rel='stylesheet' type='text/css' />
    <link href='../../assets/admin/css/style.bundle.rtl.css' rel='stylesheet' type='text/css' />
";
?>