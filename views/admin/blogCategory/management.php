<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    مدیریت دسته مقالات
                </h5>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <span class="card-icon"><i class="flaticon2-favourite text-primary"></i></span>
                        <h3 class="card-label">
                            مدیریت دسته مقالات
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="/admin/category/create" class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md">
                                <i class="la la-plus"></i>
                            </span>
                            افزودن دسته جدید
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="kt_tab_pane_7_3" role="tabpanel">
                            <table class="table table-bordered table-hover table-checkable" id="manager" style="margin-top: 13px !important">
                                <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>تصویر</th>
                                    <th>عنوان</th>
                                    <th>وضعیت</th>
                                    <th>غیر فعال | فعال</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $keyNumber = 1;
                                $getAllCategories = getAllBlogCategories();
                                if ($getAllCategories) {
                                    foreach ($getAllCategories as $category) {
                                        ?>
                                        <tr id="deleteCategory<?php echo $category['id']?>">
                                            <td><?= $keyNumber++ ?></td>
                                            <td>
                                                   <img width="100" height="70" src="../../public/images/blog_categories/<?= $category['image_name']; ?>">
                                            </td>
                                            <td><?= $category['title'] ?></td>
                                            <td style="min-width:80px;" id="statusShow<?= $category['id'] ?>">
                                                <?php
                                                if ($category['status'] == 1) {
                                                    ?>
                                                    <span class="label label-lg font-weight-bold label-light-success label-inline">فعال</span>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <span class="label label-lg font-weight-bold label-light-warning label-inline">غیر فعال</span>
                                                    <?php
                                                }
                                                ?>
                                            </td>

                                            <td id="statusCategory<?= $category['id'] ?>">
                                                <?php
                                                if ($category['status'] == 2) {
                                                    ?>
                                                    <span class="switch switch-icon">
                                                        <label>
                                                            <input id="changeStatusInput<?= $category['id'] ?>" onclick="statusCategory(<?= $category['id'] ?>, 1)" type="checkbox" name="select">
                                                            <span></span>
                                                        </label>
                                                    </span>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <span class="switch switch-icon">
                                                        <label>
                                                            <input id="changeStatusInput<?= $category['id'] ?>" onclick="statusCategory(<?= $category['id'] ?>, 2)" type="checkbox" checked="checked" name="select">
                                                            <span></span>
                                                        </label>
                                                    </span>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td style="min-width:110px;">
                                                <a href="<?= url("/admin/blogCategory/update?id={$category['id']}") ?>" class="btn btn-icon btn-primary mr-2 btn-sm" data-toggle="tooltip" title="ویرایش" data-theme="dark">
                                                    <span class="svg-icon svg-icon-dark svg-icon-2x">
                                                        <i class="la la-edit"></i>
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
                                            هیچ دسته‌ای وجود ندارد
                                        </h3>
                                    </div>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--end::Content-->
<?php
$pageTitle = "دسته بندی مقالات";
$pageScript = "
    <script src='../../../assets/admin/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.6'></script>
    <script src='../../../assets/admin/js/pages/widgets.js?v=7.0.6'></script>
    <script src='../../../assets/admin/plugins/custom/datatables/datatables.bundle.js?v=7.0.6'></script>
    <script src='../../../assets/admin/js/pages/crud/datatables/basic/paginations.js?v=7.0.6'></script>
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
";
$pageLink = "
    <link href='../../assets/admin/css/style.bundle.rtl.css' rel='stylesheet' type='text/css' />
    <link href='../../assets/admin/css/themes/layout/header/base/light.rtl.css' rel='stylesheet'
        type='text/css' />
    <link href='../../assets/admin/css/themes/layout/aside/dark.rtl.css' rel='stylesheet' type='text/css' />
";
?>
