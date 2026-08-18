<!--begin::Content-->
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::زیر هدر-->
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::اطلاعات-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    مدیریت دسته بندی
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
                                    مدیریت دسته بندی </h3>
                            </div>
                            <div class="card-toolbar">
                                <a href="/admin/blog/create"
                                   class="btn btn-primary font-weight-bolder">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="la la-plus"></i>
                                    </span>
                                    افزودن دسته بندی جدید
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="kt_tab_pane_7_3" role="tabpanel">
                                    <table class="table table-bordered table-hover table-checkable" style="margin-top: 13px !important">
                                        <thead>
                                        <tr>
                                            <th>ردیف</th>
                                            <th>تصویر</th>
                                            <th>عنوان</th>
                                            <th>والد</th>
                                            <th>سطح</th>
                                            <th>ترتیب نمایش</th>
                                            <th>وضعیت</th>
                                            <th>فعال/غیرفعال</th>
                                            <th>عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $categories = getAllCategories();

                                        if ($categories) {
                                            $categoriesById = [];
                                            $mainCategories = [];
                                            $parentCategories = [];
                                            $childCategories = [];

                                            foreach ($categories as $category) {
                                                $categoriesById[$category['id']] = $category;

                                                if ((int)$category['level'] === 0) {
                                                    $mainCategories[] = $category;
                                                } elseif ((int)$category['level'] === 1) {
                                                    $parentId = $category['parent_id'] ?? 0;
                                                    $parentCategories[$parentId][] = $category;
                                                } elseif ((int)$category['level'] === 2) {
                                                    $parentId = $category['parent_id'] ?? 0;
                                                    $childCategories[$parentId][] = $category;
                                                }
                                            }

                                            usort($mainCategories, function ($a, $b) {
                                                $sortA = isset($a['sort']) && $a['sort'] !== null ? (int)$a['sort'] : 999999;
                                                $sortB = isset($b['sort']) && $b['sort'] !== null ? (int)$b['sort'] : 999999;

                                                if ($sortA === $sortB) {
                                                    return (int)$a['id'] <=> (int)$b['id'];
                                                }

                                                return $sortA <=> $sortB;
                                            });

                                            $keyNumber = 1;

                                            foreach ($mainCategories as $mainCategory) {
                                                $mainId = $mainCategory['id'];
                                                $hasParents = !empty($parentCategories[$mainId]);
                                                ?>
                                                <tr class="main-row"
                                                    data-id="<?= $mainCategory['id'] ?>"
                                                    data-sort="<?= $mainCategory['sort'] ?>"
                                                    id="deleteCategory<?= $mainCategory['id'] ?>">

                                                    <td><?= $keyNumber++ ?></td>

                                                    <td>
                                                        <?php if ($mainCategory['image_name']): ?>
                                                            <img width="100" height="70" src="../../public/images/category/<?= $mainCategory['image_name']; ?>">
                                                        <?php else: ?>
                                                            —
                                                        <?php endif; ?>
                                                    </td>

                                                    <td>
                                                        <div style="display: flex; align-items: center; gap: 8px;">
                                                            <?php if ($hasParents): ?>
                                                                <button type="button"
                                                                        class="btn btn-sm btn-light-primary"
                                                                        onclick="toggleMainCategory(<?= $mainId ?>)"
                                                                        id="toggleMainBtn<?= $mainId ?>"
                                                                        style="min-width: 32px; padding: 2px 8px;">
                                                                    +
                                                                </button>
                                                            <?php else: ?>
                                                                <span style="display:inline-block; width:32px; text-align:center;">—</span>
                                                            <?php endif; ?>

                                                            <span><strong><?= $mainCategory['title'] ?></strong></span>
                                                        </div>
                                                    </td>

                                                    <td class="text-primary">---</td>
                                                    <td>اصلی</td>

                                                    <td>
                                                        <input type="number"
                                                               class="form-control text-center"
                                                               style="width:80px"
                                                               value="<?= $mainCategory['sort'] ?>"
                                                               data-id="<?= $mainCategory['id'] ?>"
                                                               onchange="updateCategorySort(<?= $mainCategory['id'] ?>, this.value)">
                                                    </td>

                                                    <td id="statusShow<?= $mainCategory['id'] ?>">
                                                        <?php if ($mainCategory['status'] == 1): ?>
                                                            <span class="label label-lg font-weight-bold label-light-success label-inline">فعال</span>
                                                        <?php else: ?>
                                                            <span class="label label-lg font-weight-bold label-light-warning label-inline">غیرفعال</span>
                                                        <?php endif; ?>
                                                    </td>

                                                    <td id="statusCategory<?= $mainCategory['id'] ?>">
                    <span class="switch switch-icon">
                        <label>
                            <input type="checkbox"
                                   id="changeStatusInput<?= $mainCategory['id'] ?>"
                                   <?= $mainCategory['status'] == 1 ? 'checked' : '' ?>
                                   onclick="statusCategory(<?= $mainCategory['id'] ?>, <?= $mainCategory['status'] == 1 ? 2 : 1 ?>)">
                            <span></span>
                        </label>
                    </span>
                                                    </td>

                                                    <td>
                                                        <a href="<?= url("/admin/category/update?id={$mainCategory['id']}") ?>"
                                                           class="btn btn-icon btn-primary btn-sm"
                                                           data-toggle="tooltip"
                                                           title="ویرایش"
                                                           data-theme="dark">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                                <?php
                                                if ($hasParents) {
                                                    foreach ($parentCategories[$mainId] as $parentCategory) {
                                                        $parentCategoryId = $parentCategory['id'];
                                                        $hasChildren = !empty($childCategories[$parentCategoryId]);
                                                        ?>
                                                        <tr class="parent-row parent-of-<?= $mainId ?>"
                                                            data-main-id="<?= $mainId ?>"
                                                            data-id="<?= $parentCategory['id'] ?>"
                                                            id="deleteCategory<?= $parentCategory['id'] ?>"
                                                            style="display: none; background: #fafafa;">

                                                            <td><?= $keyNumber++ ?></td>
                                                            <td>—</td>

                                                            <td>
                                                                <div style="display: flex; align-items: center; gap: 8px; padding-right: 25px;">
                                                                    <?php if ($hasChildren): ?>
                                                                        <button type="button"
                                                                                class="btn btn-sm btn-light-success"
                                                                                onclick="toggleParentCategory(<?= $parentCategoryId ?>)"
                                                                                id="toggleParentBtn<?= $parentCategoryId ?>"
                                                                                style="min-width: 32px; padding: 2px 8px;">
                                                                            +
                                                                        </button>
                                                                    <?php else: ?>
                                                                        <span style="display:inline-block; width:32px; text-align:center;">—</span>
                                                                    <?php endif; ?>

                                                                    <span><?= $parentCategory['title'] ?></span>
                                                                </div>
                                                            </td>

                                                            <td class="text-primary"><?= $categoriesById[$parentCategory['parent_id']]['title'] ?? '---' ?></td>
                                                            <td>پدر</td>
                                                            <td>---</td>

                                                            <td id="statusShow<?= $parentCategory['id'] ?>">
                                                                <?php if ($parentCategory['status'] == 1): ?>
                                                                    <span class="label label-lg font-weight-bold label-light-success label-inline">فعال</span>
                                                                <?php else: ?>
                                                                    <span class="label label-lg font-weight-bold label-light-warning label-inline">غیرفعال</span>
                                                                <?php endif; ?>
                                                            </td>

                                                            <td id="statusCategory<?= $parentCategory['id'] ?>">
                            <span class="switch switch-icon">
                                <label>
                                    <input type="checkbox"
                                           id="changeStatusInput<?= $parentCategory['id'] ?>"
                                           <?= $parentCategory['status'] == 1 ? 'checked' : '' ?>
                                           onclick="statusCategory(<?= $parentCategory['id'] ?>, <?= $parentCategory['status'] == 1 ? 2 : 1 ?>)">
                                    <span></span>
                                </label>
                            </span>
                                                            </td>

                                                            <td>
                                                                <a href="<?= url("/admin/category/update?id={$parentCategory['id']}") ?>"
                                                                   class="btn btn-icon btn-primary btn-sm"
                                                                   data-toggle="tooltip"
                                                                   title="ویرایش"
                                                                   data-theme="dark">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                            </td>
                                                        </tr>

                                                        <?php
                                                        if ($hasChildren) {
                                                            foreach ($childCategories[$parentCategoryId] as $childCategory) {
                                                                ?>
                                                                <tr class="child-row child-of-<?= $parentCategoryId ?> child-of-main-<?= $mainId ?>"
                                                                    data-main-id="<?= $mainId ?>"
                                                                    data-parent-id="<?= $parentCategoryId ?>"
                                                                    data-id="<?= $childCategory['id'] ?>"
                                                                    id="deleteCategory<?= $childCategory['id'] ?>"
                                                                    style="display: none; background: #f3f6f9;">

                                                                    <td><?= $keyNumber++ ?></td>
                                                                    <td>—</td>

                                                                    <td>
                                                                        <div style="padding-right: 55px;">
                                                                             <?= $childCategory['title'] ?>
                                                                        </div>
                                                                    </td>

                                                                    <td class="text-primary"><?= $categoriesById[$childCategory['parent_id']]['title'] ?? '---' ?></td>
                                                                    <td>فرزند</td>
                                                                    <td>---</td>

                                                                    <td id="statusShow<?= $childCategory['id'] ?>">
                                                                        <?php if ($childCategory['status'] == 1): ?>
                                                                            <span class="label label-lg font-weight-bold label-light-success label-inline">فعال</span>
                                                                        <?php else: ?>
                                                                            <span class="label label-lg font-weight-bold label-light-warning label-inline">غیرفعال</span>
                                                                        <?php endif; ?>
                                                                    </td>

                                                                    <td id="statusCategory<?= $childCategory['id'] ?>">
                                    <span class="switch switch-icon">
                                        <label>
                                            <input type="checkbox"
                                                   id="changeStatusInput<?= $childCategory['id'] ?>"
                                                   <?= $childCategory['status'] == 1 ? 'checked' : '' ?>
                                                   onclick="statusCategory(<?= $childCategory['id'] ?>, <?= $childCategory['status'] == 1 ? 2 : 1 ?>)">
                                            <span></span>
                                        </label>
                                    </span>
                                                                    </td>

                                                                    <td>
                                                                        <a href="<?= url("/admin/category/update?id={$childCategory['id']}") ?>"
                                                                           class="btn btn-icon btn-primary btn-sm"
                                                                           data-toggle="tooltip"
                                                                           title="ویرایش"
                                                                           data-theme="dark">
                                                                            <i class="fas fa-edit"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        } else {
                                            echo '<tr><td colspan="9" class="text-center">هیچ دسته‌بندی‌ای یافت نشد</td></tr>';
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    <script>
                                        function toggleMainCategory(mainId) {
                                            const parentRows = document.querySelectorAll('.parent-of-' + mainId);
                                            const childRows = document.querySelectorAll('.child-of-main-' + mainId);
                                            const btn = document.getElementById('toggleMainBtn' + mainId);

                                            let isHidden = true;

                                            if (parentRows.length > 0) {
                                                isHidden = parentRows[0].style.display === 'none';
                                            }

                                            parentRows.forEach(function (row) {
                                                row.style.display = isHidden ? '' : 'none';
                                            });

                                            if (!isHidden) {
                                                childRows.forEach(function (row) {
                                                    row.style.display = 'none';
                                                });

                                                const parentButtons = document.querySelectorAll('[id^="toggleParentBtn"]');
                                                parentButtons.forEach(function (button) {
                                                    const parentId = button.id.replace('toggleParentBtn', '');
                                                    const parentRow = document.querySelector('tr[data-id="' + parentId + '"]');
                                                    if (parentRow && parentRow.getAttribute('data-main-id') == mainId) {
                                                        button.innerHTML = '+';
                                                    }
                                                });
                                            }

                                            btn.innerHTML = isHidden ? '-' : '+';
                                        }

                                        function toggleParentCategory(parentId) {
                                            const childRows = document.querySelectorAll('.child-of-' + parentId);
                                            const btn = document.getElementById('toggleParentBtn' + parentId);

                                            let isHidden = true;

                                            if (childRows.length > 0) {
                                                isHidden = childRows[0].style.display === 'none';
                                            }

                                            childRows.forEach(function (row) {
                                                row.style.display = isHidden ? '' : 'none';
                                            });

                                            btn.innerHTML = isHidden ? '-' : '+';
                                        }
                                    </script>
                                </div>
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
<!--end::Content-->
<?php
$pageTitle = "مدیریت دسته بندی ها";
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