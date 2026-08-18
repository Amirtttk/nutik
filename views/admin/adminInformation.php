<?php
$getOneInfoUser = getOneInfoUser($_SESSION['admin_info']['userID'], TYPES_USERS[$_SESSION['admin_info']['userType']][0]);
$getUserLastLogin = getUserLastLogin($getOneInfoUser['userID']);
$time = jdate("B", (dateToTimestamp($getUserLastLogin['date'])));
$date = jdate("r", (dateToTimestamp($getUserLastLogin['date'])));
$lastLogin = $date . ' ساعت ' . $time; 
?>
<!--begin::Content-->
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::زیر هدر-->
    <div class="subheader py-2 py-lg-6  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::اطلاعات-->
            <div class="d-flex align-items-center flex-wrap mr-2">

                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">پروفایل</h5>
                <!--end::Page Title-->

                <!--begin::اقدامات-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <!--end::اقدامات-->

                <span class="text-muted font-weight-bold mr-4">نمایش اطلاعات ، تغییر اطلاعات و کلمه عبور</span>

            </div>
            <!--end::اطلاعات-->
        </div>
    </div>
    <!--end::زیر هدر-->

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container ">
            <!--begin::تحصیلات-->
            <div class="d-flex flex-row">
                <!--begin::Aside-->
                <div class="flex-row-auto offcanvas-mobile w-300px w-xl-325px" id="kt_profile_aside">
                    <!--begin::Nav Panel Widget 1-->
                    <div class="card card-custom gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Wrapper-->
                            <div class="d-flex justify-content-between flex-column pt-4 h-100">
                                <!--begin::Container-->
                                <div class="pb-5">
                                    <!--begin::Header-->
                                    <div class="d-flex flex-column flex-center">


                                        <!--begin::نام کاربری-->
                                        <p id="showFullNameProfile"
                                            class="card-title font-weight-bolder text-dark-75 text-hover-primary font-size-h4 m-0 pt-7 pb-1">
                                            <?= $_SESSION['admin_info']['userFullName'] ?>
                                        </p>
                                        <!--end::نام کاربری-->

                                        <!--begin::اطلاعات-->
                                        <div class="font-weight-bold text-dark-50 font-size-sm pb-6">سمت :
                                            <?= TYPES_USERS[$_SESSION['admin_info']['userType']][2] ?>
                                        </div>
                                        <!--end::اطلاعات-->
                                    </div>
                                    <!--end::Header-->

                                    <!--begin::Body-->
                                    <div class="pt-1">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center pb-9">
                                            <!--begin::سیمبل-->
                                            <div class="symbol symbol-45 symbol-light mr-4">
                                                <span class="symbol-label">
                                                    <span
                                                        class="svg-icon svg-icon-2x svg-icon-dark-50"><!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg--><svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <rect fill="#000000" opacity="0.3" x="13" y="4"
                                                                    width="3" height="16" rx="1.5" />
                                                                <rect fill="#000000" x="8" y="9" width="3" height="11"
                                                                    rx="1.5" />
                                                                <rect fill="#000000" x="18" y="11" width="3" height="9"
                                                                    rx="1.5" />
                                                                <rect fill="#000000" x="3" y="13" width="3" height="7"
                                                                    rx="1.5" />
                                                            </g>
                                                        </svg><!--end::Svg Icon--></span> </span>
                                            </div>
                                            <!--end::سیمبل-->

                                            <!--begin::متن-->
                                            <div class="d-flex flex-column flex-grow-1">
                                                <a href="#"
                                                    class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">آخرین
                                                    ورود به پنل <?= TYPES_USERS[$_SESSION['admin_info']['userType']][1] ?></a>
                                                <span
                                                    class="text-muted font-weight-bold"><?= $getUserLastLogin ? $lastLogin  : 'هیچ ورودی انجام نشده' ?></span>
                                            </div>
                                             <!-- jdate("B", (dateToTimestamp($getUserLastLogin['date']))) -->
                                            <!--end::متن-->

                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--eng::Container-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Nav Panel Widget 1-->
                </div>
                <!--end::Aside-->

                <!--begin::Content-->
                <div class="flex-row-fluid ml-lg-8">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-bs">
                        <!--Begin::Header-->
                        <div class="card-header card-header-tabs-line">
                            <div class="card-toolbar">
                                <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x "
                                    role="tablist">
                                    <li class="nav-item mr-3">
                                        <a class="nav-link active" data-toggle="tab" href="#kt_apps_مخاطبs_view_tab_2">
                                            <span class="nav-icon mr-2">
                                                <span class="svg-icon mr-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path
                                                                d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z"
                                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                            <path
                                                                d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z"
                                                                fill="#000000" />
                                                        </g>
                                                    </svg>
                                                </span>
                                            </span>
                                            <span class="nav-text font-weight-bold">اطلاعات من</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--end::Header-->

                        <!--Begin::Body-->
                        <div class="card-body px-0">
                            <div class="tab-content pt-5" style="overflow-x: hidden;">
                                <!--begin::Tab Content-->
                                <div class="tab-pane active" id="kt_apps_مخاطبs_view_tab_2" role="tabpanel">
                                    <form class="needs-validation" id="resetPasswordByOldPassword">
                                        <div id="divShowError" class="row d-none">
                                            <div class="col-lg-9 col-xl-6 offset-xl-3">
                                                <div class="alert alert-custom alert-light-danger fade show mb-9"
                                                    role="alert">
                                                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                                    <div class="alert-text" id="showError">

                                                    </div>
                                                    <div class="alert-close">
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="نزدیک">
                                                            <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--begin::Heading-->
                                        <div class="row">

                                            <div class="col-lg-9 col-xl-6 offset-xl-3">
                                                <h3 class="font-size-h6 mb-5">اطلاعات شما:</h3>
                                            </div>
                                        </div>
                                        <!--end::Heading-->

                                        <div class="form-group row">

                                            <label class="col-xl-3 col-lg-3 text-right col-form-label">نام و نام
                                                خانوادگی</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input data-v-message="نام و نام خانوادگی نمیتواند خالی بماند" required
                                                    name="userFullName"
                                                    class="form-control form-control-lg form-control-solid" type="text"
                                                    placeholder="نام و نام خانوادگی را وارد کنید ..."
                                                    value="<?= $_SESSION['admin_info']['userFullName'] ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-right col-form-label">نام
                                                کاربری</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input
                                                    data-v-message="نام کاربری نمیتواند خالی بماند و باید حداقل 3 کاراکتر و با حروف لاتین باشد"
                                                    minlength="3" required name="userName"
                                                    class="form-control form-control-lg form-control-solid" type="text"
                                                    placeholder="نام کاربری را وارد کنید ..."
                                                    value="<?= $getOneInfoUser['userName'] ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-right col-form-label">تاریخ
                                                تولد</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input data-v-message="تاریخ تولد نمیتواند خالی بماند" required
                                                    name="dateBirth"
                                                    class="form-control form-control-lg form-control-solid" type="text"
                                                    data-jdp placeholder="تاریخ تولد را وارد کنید (کلیک کنید)"
                                                    value="<?= $getOneInfoUser['dateBirth'] ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-right col-form-label">جنسیت</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <select data-v-message="جنسیت نمیتواند خالی بماند" required
                                                    name="gender"
                                                    class="form-control form-control-lg form-control-solid">
                                                    <option <?= $getOneInfoUser['gender'] == 1 ? "selected" : "" ?>
                                                        value="1">آقا</option>
                                                    <option <?= $getOneInfoUser['gender'] == 2 ? "selected" : "" ?>
                                                        value="2">خانم</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="d-flex">
                                            <button id="btnUpdateInfo" type="button" onclick="updateInfoUser()"
                                                style="margin: 0px auto;"
                                                class="btn btn-primary font-weight-bolder font-size-sm py-3 px-14">
                                                ویرایش اطلاعات
                                            </button>
                                        </div>
                                    </form>

                                    <div class="separator separator-dashed my-10"></div>

                                    <!--begin::Heading-->
                                    <form class="needs-validation" id="changePasswordNow">
                                        <div id="divShowError2" class="row d-none">
                                            <div class="col-lg-9 col-xl-6 offset-xl-3">
                                                <div class="alert alert-custom alert-light-danger fade show mb-9"
                                                    role="alert">
                                                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                                    <div class="alert-text" id="showError2">

                                                    </div>
                                                    <div class="alert-close">
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="نزدیک">
                                                            <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-9 col-xl-6 offset-xl-3">
                                                <h3 class="font-size-h6 mb-5">تغییر رمز عبور:</h3>
                                            </div>
                                        </div>
                                        <!--end::Heading-->

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-right col-form-label">رمز عبور
                                                فعلی</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input
                                                    data-v-message="رمز عبور نمیتواند خالی بماند و باید حداقل 8 کاراکتر باشد"
                                                    minlength="8" required name="password"
                                                    class="form-control form-control-lg form-control-solid" type="text"
                                                    placeholder="رمز عبور فعلی را وارد کنید ..." />
                                                <a href="javascript:void(0);"
                                                    onclick="changeFormForgotPassword(document.getElementById('changePasswordNow'), document.getElementById('changeForgotPassword'))">رمز
                                                    عبورم را فراموش کردم</a>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-right col-form-label">رمز عبور
                                                جدید</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input
                                                    data-v-message="رمز عبور جدید نمیتواند خالی بماند و باید حداقل 8 کاراکتر باشد"
                                                    minlength="8" required name="newPassword"
                                                    class="form-control form-control-lg form-control-solid" type="text"
                                                    placeholder="رمز عبور جدید را وارد کنید ..." />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-right col-form-label">تکرار رمز
                                                عبور
                                                جدید</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input
                                                    data-v-message="تکرار رمز عبور جدید نمیتواند خالی بماند و باید حداقل 8 کاراکتر باشد"
                                                    minlength="8" required name="repeatNewPassword"
                                                    class="form-control form-control-lg form-control-solid" type="text"
                                                    placeholder="تکرار رمز عبور جدید را وارد کنید ..." />
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <button id="btnResetPassword" type="button" onclick="resetPassword()"
                                                style="margin: 0px auto;"
                                                class="btn btn-primary font-weight-bolder font-size-sm py-3 px-14">
                                                ویرایش رمز عبور
                                            </button>
                                        </div>
                                    </form>

                                    <form class="needs-validation" id="changeForgotPassword" style="display: none;">
                                        <div id="divShowError3" class="row d-none">
                                            <div class="col-lg-9 col-xl-6 offset-xl-3">
                                                <div class="alert alert-custom alert-light-danger fade show mb-9"
                                                    role="alert">
                                                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                                    <div class="alert-text" id="showError3">

                                                    </div>
                                                    <div class="alert-close">
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="نزدیک">
                                                            <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-9 col-xl-6 offset-xl-3">
                                                <h3 class="font-size-h6 mb-5">فراموشی رمز عبور:</h3>
                                            </div>
                                        </div>
                                        <!--end::Heading-->

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-right col-form-label">شماره
                                                تماس</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input
                                                    data-v-message="شماره تماس نمیتواند خالی بماند و باید 11 کاراکتر باشد"
                                                    minlength="11" maxlength="11" required name="mobile"
                                                    class="form-control form-control-lg form-control-solid" type="text"
                                                    placeholder="شماره تماس را وارد کنید ..." />
                                                <a href="javascript:void(0);"
                                                    onclick="changeFormForgotPassword(document.getElementById('changeForgotPassword'),document.getElementById('changePasswordNow'))">تغییر
                                                    با
                                                    رمز عبور فعلی</a>
                                            </div>
                                        </div>

                                        <div class="d-flex">
                                            <button id="btnResetPasswordWithMobile" type="button"
                                                onclick="resetPasswordWithMobile()" style="margin: 0px auto;"
                                                class="btn btn-primary font-weight-bolder font-size-sm py-3 px-14">
                                                بعدی
                                            </button>
                                        </div>
                                    </form>

                                    <form class="needs-validation" id="changeMobile" style="display: none;">
                                        <div id="divShowError4" class="row d-none">
                                            <div class="col-lg-9 col-xl-6 offset-xl-3">
                                                <div class="alert alert-custom alert-light-danger fade show mb-9"
                                                    role="alert">
                                                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                                    <div class="alert-text" id="showError4">

                                                    </div>
                                                    <div class="alert-close">
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="نزدیک">
                                                            <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-9 col-xl-6 offset-xl-3">
                                                <h3 class="font-size-h6 mb-5">کد تایید:</h3>
                                                <p id="showCode"></p>
                                            </div>
                                        </div>
                                        <!--end::Heading-->

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-right col-form-label">کد
                                                تایید</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input
                                                    data-v-message="کد تایید نمیتواند خالی بماند و باید 6 کاراکتر باشد"
                                                    minlength="6" maxlength="6" required name="code"
                                                    class="form-control form-control-lg form-control-solid" type="text"
                                                    placeholder="کد تایید را وارد کنید ..." />
                                                <a href="javascript:void(0);"
                                                    onclick="changeFormForgotPassword(document.getElementById('changeMobile'), document.getElementById('changeForgotPassword'))">تغییر
                                                    شماره تماس
                                                </a>
                                            </div>
                                        </div>

                                        <div class="d-flex">
                                            <button id="btnResetPasswordCheckCode" type="button" onclick="confirmCode()"
                                                style="margin: 0px auto;"
                                                class="btn btn-primary font-weight-bolder font-size-sm py-3 px-14">
                                                تایید کد
                                            </button>
                                        </div>
                                    </form>

                                    <form class="needs-validation" id="submitNewPassword" style="display: none;">
                                        <div id="divShowError5" class="row d-none">
                                            <div class="col-lg-9 col-xl-6 offset-xl-3">
                                                <div class="alert alert-custom alert-light-danger fade show mb-9"
                                                    role="alert">
                                                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                                    <div class="alert-text" id="showError5">

                                                    </div>
                                                    <div class="alert-close">
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="نزدیک">
                                                            <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-lg-9 col-xl-6 offset-xl-3">
                                                <h3 class="font-size-h6 mb-5">تعریف رمز عبور:</h3>
                                            </div>
                                        </div>
                                        <!--end::Heading-->

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-right col-form-label">رمز عبور
                                                جدید</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input
                                                    data-v-message="رمز عبور جدید نمیتواند خالی بماند و باید حداقل 8 کاراکتر باشد"
                                                    minlength="8" required name="newPasswordSubmit"
                                                    class="form-control form-control-lg form-control-solid" type="text"
                                                    placeholder="رمز عبور جدید را وارد کنید ..." />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 text-right col-form-label">تکرار رمز
                                                عبور
                                                جدید</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input
                                                    data-v-message="تکرار رمز عبور جدید نمیتواند خالی بماند و باید حداقل 8 کاراکتر باشد"
                                                    minlength="8" required name="repeatNewPasswordSubmit"
                                                    class="form-control form-control-lg form-control-solid" type="text"
                                                    placeholder="تکرار رمز عبور جدید را وارد کنید ..." />
                                            </div>
                                        </div>

                                        <div class="d-flex">
                                            <button id="btnSubmitPassword" type="button" onclick="submitPassword()"
                                                style="margin: 0px auto;"
                                                class="btn btn-primary font-weight-bolder font-size-sm py-3 px-14">
                                                ثبت رمز عبور جدید
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!--end::Tab Content-->
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::تحصیلات-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->

<?php
$pageTitle = " پروفایل " . TYPES_USERS[$_SESSION['admin_info']['userType']][1];
$pageScript = "
    <script src='../../assets/admin/js/sweetalert.js'></script>
    <script src='../../assets/admin/js/main.js'></script>
    <script src='../../assets/admin/js/jbvalidator.js'></script>
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
        $(function () {
            let validator = $('form.needs-validation').jbvalidator({
                errorMessage: true,
                successClass: true,
            });
        })
        jalaliDatepicker.startWatch({
            minDate: 'attr',
            maxDate: 'attr',
            minTime: 'attr',
            maxTime: 'attr',
            hideAfterChange: false,
            autoHide: true,
            showTodayBtn: true,
            showEmptyBtn: true,
            topSpace: 10,
            bottomSpace: 30,
            dayRendering(opt, input) {
                return {
                    isHollyDay: opt.day == 1
                }
            }
        });
    </script>
";
$pageLink = "
    <link href='../../assets/admin/plugins/global/plugins.bundle.rtl.css' rel='stylesheet' type='text/css' />
    <link href='../../assets/admin/css/style.bundle.rtl.css' rel='stylesheet' type='text/css' />
    <link href='../../assets/admin/css/themes/layout/header/base/light.rtl.css' rel='stylesheet'
        type='text/css' />
    <link href='../../assets/admin/css/themes/layout/aside/dark.rtl.css' rel='stylesheet' type='text/css' />
    <link rel='stylesheet' href='../../assets/admin/css/jalalidatepicker.css'>
    <script type='text/javascript' src='../../assets/admin/js/jalalidatepicker.js'></script>
";
?>