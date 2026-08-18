<!--begin::Content-->
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::زیر هدر-->
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::اطلاعات-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    گزارشات روزانه
                </h5>
                <!--end::Page Title-->
            </div>
            <!--end::اطلاعات-->
            <!--end::اطلاعات-->
        </div>
    </div>
    <!--end::زیر هدر-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="card card-custom">
                <div class="">
                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                                <span class="card-icon"><i class="flaticon2-favourite text-primary"></i></span>
                                <h3 class="card-label">
                                    گزارشات روزانه
                                </h3>
                            </div>
                         <!--   <div class="card-toolbar">
                                <a href="/admin/orders/management" class="btn btn-danger font-weight-bolder font-size-sm">گرفتن خروجی pdf</a>
                            </div>-->

                        </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="kt_tab_pane_7_3" role="tabpanel">
                                        <table class="table table-bordered table-hover table-checkable" id="manager"
                                               style="margin-top: 13px !important">
                                            <thead>
                                            <tr>
                                                <th>ردیف</th>
                                                <th>کد پیگیری </th>
                                                <th>کد رهگیری پستی </th>
                                                <th>تاریخ</th>
                                                <th>خریدار</th>
                                                <th>مبلغ کل</th>
                                                <th>هزینه ارسال</th>
                                                <th>وضعیت</th>
                                                <th>  وضعیت ارسال</th>
                                                <th>عملیات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $keyNumber = 1;
                                            $getAllOrders = getLast30DaysOrdersByStatus();
                                            if ($getAllOrders) {
                                                foreach ($getAllOrders as $key => $AllOrders) {
                                                    $getInfoUser = getInfoUser($AllOrders['user_id']);
                                                    ?>
                                                    <tr>
                                                        <td><?= $keyNumber++ ?></td>
                                                        <td>#<?= $AllOrders['tracking_code'] ?></td>
                                                        <td id="shipping_code<?= $AllOrders['id'] ?>"><?=  $AllOrders['shipping_code'] ?? '' ?></td>
                                                        <td><?= jdate("r", (dateToTimestamp($AllOrders['create_at']))) ?></td>
                                                        <td><?= $getInfoUser['userFullName'] . ' | 09'.$getInfoUser['userMobile']  ?></td>
                                                        <td><?= number_format($AllOrders['amount_payable']) ?> تومان</td>
                                                        <td><?= number_format($AllOrders['shipping_cost']) ?> تومان</td>
                                                        <td>
                                                            <?php
                                                            if ($AllOrders['status'] == 10) {
                                                                ?>
                                                                <span
                                                                        class="label label-lg font-weight-bold label-light-success label-inline">موفق</span>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <span
                                                                        class="label label-lg font-weight-bold label-light-warning label-inline">نا موفق</span>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td id="statusShow<?= $AllOrders['id'] ?>">
                                                            <?php
                                                            if ($AllOrders['type'] == 1 ){
                                                                echo '<span class="label label-lg font-weight-bold label-light-success label-inline">مرسوله رسیده</span>';
                                                            } elseif ($AllOrders['type'] == 2 ){
                                                                echo '<span class="label label-lg font-weight-bold label-light-primary label-inline">مرسوله در دست پست </span>';
                                                            } elseif ($AllOrders['type'] == 3 ){
                                                                echo '<span class="label label-lg font-weight-bold label-light-danger label-inline">درحال بسته بندی</span>';
                                                            } elseif ($AllOrders['type'] == 4 ){
                                                                echo '<span class="label label-lg font-weight-bold label-light-info label-inline">منتظر تایید</span>';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td style="min-width:110px;">
                                                            <!-- Button trigger modal-->
                                                            <?php
                                                            if ($AllOrders['status'] == 10) {
                                                                ?>
                                                                <a class="btn p-0" href="#" data-toggle="tooltip" title="ثبت کد رهگیری" data-theme="dark">
                                                                    <button type="button" class="btn btn-icon btn-success btn-sm" data-toggle="modal" data-target="#modal<?= $AllOrders['id'] ?>">
                                                            <span class="svg-icon  svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\فروشگاه\Box3.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                    <path d="M20.4061385,6.73606154 C20.7672665,6.89656288 21,7.25468437 21,7.64987309 L21,16.4115967 C21,16.7747638 20.8031081,17.1093844 20.4856429,17.2857539 L12.4856429,21.7301984 C12.1836204,21.8979887 11.8163796,21.8979887 11.5143571,21.7301984 L3.51435707,17.2857539 C3.19689188,17.1093844 3,16.7747638 3,16.4115967 L3,7.64987309 C3,7.25468437 3.23273352,6.89656288 3.59386153,6.73606154 L11.5938615,3.18050598 C11.8524269,3.06558805 12.1475731,3.06558805 12.4061385,3.18050598 L20.4061385,6.73606154 Z" fill="#000000" opacity="0.3"/>
                                                                    <polygon fill="#000000" points="14.9671522 4.22441676 7.5999999 8.31727912 7.5999999 12.9056825 9.5999999 13.9056825 9.5999999 9.49408582 17.25507 5.24126912"/>
                                                                </g>
                                                            </svg><!--end::Svg Icon--></span>
                                                                    </button>
                                                                </a>
                                                                <?php
                                                            }
                                                            ?>
                                                            <!-- Modal-->
                                                            <div class="modal fade" id="modal<?= $AllOrders['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">ثبت کد رهگیری</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <i aria-hidden="true" class="ki ki-close"></i>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body  " style="gap:8px;">
                                                                            <div id="getErrors"></div>
                                                                            <div class="form-group row">
                                                                                <label> کد رهگیری:</label>
                                                                                <input name="shipping_code" type="text" class="form-control" data-v-message="" required="" placeholder="کد رهگیری مرسوله را وارد کنید">
                                                                            </div>
                                                                            <div class="d-flex" style="margin-top: 26px;">
                                                                                <button onclick="createShippingPost(<?= $AllOrders['id'] ?>)" type="button" class="btn btn-primary mr-2">ثبت</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Button trigger modal-->
                                                            <a class="btn p-0" href="#" data-toggle="tooltip" title="وضعیت ارسال" data-theme="dark">
                                                                <button type="button" class="btn btn-icon btn-danger mr-2 user-des btn-sm" data-toggle="modal" data-target="#exampleModal">
                                                            <span class="svg-icon svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Done-circle.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                                    <path d="M16.7689447,7.81768175 C17.1457787,7.41393107 17.7785676,7.39211077 18.1823183,7.76894473 C18.5860689,8.1457787 18.6078892,8.77856757 18.2310553,9.18231825 L11.2310553,16.6823183 C10.8654446,17.0740439 10.2560456,17.107974 9.84920863,16.7592566 L6.34920863,13.7592566 C5.92988278,13.3998345 5.88132125,12.7685345 6.2407434,12.3492086 C6.60016555,11.9298828 7.23146553,11.8813212 7.65079137,12.2407434 L10.4229928,14.616916 L16.7689447,7.81768175 Z" fill="#000000" fill-rule="nonzero"/>
                                                                </g>
                                                            </svg><!--end::Svg Icon--></span>
                                                                </button>
                                                            </a>
                                                            <!-- Modal-->
                                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">وضعیت</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <i aria-hidden="true" class="ki ki-close"></i>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body d-flex" style="gap:8px;">
                                                                            <button type="button" class="btn btn-success w-50" onclick="changeOrderStatus(<?= $AllOrders['id'] ?>, 1)">مرسوله رسیده</button>
                                                                            <button type="button" class="btn btn-warning w-50" onclick="changeOrderStatus(<?= $AllOrders['id'] ?>, 2)">مرسوله در دست پست </button>
                                                                            <button type="button" class="btn btn-danger w-50" onclick="changeOrderStatus(<?= $AllOrders['id'] ?>, 3)">درحال بسته بندی</button>
                                                                            <button type="button" class="btn btn-info w-50" onclick="changeOrderStatus(<?= $AllOrders['id'] ?>, 4)">منتظر تایید</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="<?= url("/admin/orders/details?tracking_code={$AllOrders['tracking_code']}") ?>"
                                                               class="btn btn-icon btn-primary mr-2 user-des btn-sm"
                                                               data-toggle="tooltip" title="مشاهده سفارشات" data-theme="dark">
                                                               <span
                                                                       class="svg-icon svg-icon-dark svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\ارتباطات\Write.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                         viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path
                                                                    d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                                                                    fill="#000000" opacity="0.3" />
                                                            <path
                                                                    d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                                                                    fill="#000000" />
                                                            <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2"
                                                                  rx="1" />
                                                            <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2"
                                                                  rx="1" />
                                                            <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2"
                                                                  rx="1" />
                                                            <rect fill="#000000" opacity="0.3" x="10" y="13" width="7"
                                                                  height="2" rx="1" />
                                                            <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2"
                                                                  rx="1" />
                                                            <rect fill="#000000" opacity="0.3" x="10" y="17" width="7"
                                                                  height="2" rx="1" />
                                                        </g>
                                                    </svg>
                                                </span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="alert alert-warning col-12 col-md-12">
                                                    <h3 class="text-center">
                                                        هیچ سفارشی وجود ندارد
                                                    </h3>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <br>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    <!--begin: جدول داده ها-->
                    <!--end: جدول داده ها-->
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->

</div>

<?php
$pageTitle = "فروش های ماهانه ";
$pageScript = "
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