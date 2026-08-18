<?php
$getOneBlog = getOneBlog(GET('id'));

$image_name = $getOneBlog['image_name'] ?? '';

// ساخت آدرس دقیق مطابق نمونه‌ای که دادی
// اگر تصویر وجود داشت، آدرس کامل ساخته می‌شود، در غیر این صورت خالی می‌ماند
$image_url = !empty($image_name) ? "../../public/images/blog/" . $image_name : '';

// آماده‌سازی برای ارسال به جاوااسکریپت (اگر نیاز داری در فرم نمایش دهی)
$blogImageData = [
    'name' => $image_name,
    'url'  => $image_url
];

?>
    <!--begin::Content-->
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::زیر هدر-->
        <!--begin::زیر هدر-->
        <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
            <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::اطلاعات-->
                <div class="d-flex align-items-center flex-wrap mr-2">

                    <!--begin::Page Title-->
                    <h5 class="card-label">ویرایش اطلاعات مقاله </h5>

                    <!--end::Page Title-->
                </div>
                <!--end::اطلاعات-->
            </div>
        </div>
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <div class="card card-custom">
                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                                <span class="card-icon"><i class="flaticon2-favourite text-primary"></i></span>
                                <h3 class="card-label">ویرایش مقاله</h3>
                            </div>
                            <div class="card-toolbar">
                                <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                    <li class="nav-item">
                                        <a class="nav-link show active" data-toggle="tab" href="#kt_tab_pane_7_1">
                                            <span class="nav-icon"><i class="fa fa-info"></i></span>
                                            ویرایش اطلاعات  مقاله
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2">
                                            <span class="nav-icon"><i class="fa fa-info"></i></span>
                                            اطلاعات سئو
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content mt-5 p-5 needs-validation">
                                <div class="tab-pane fade show active" id="kt_tab_pane_7_1" role="tabpanel" aria-labelledby="kt_tab_pane_7_1">
                                    <form id="productForm" class="tab-content mt-5 p-5 needs-validation"  enctype="multipart/form-data">
                                        <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                                            <div>
                                                <div class="form-group row">
                                                    <div class="col-lg-6">
                                                        <label>عنوان محصول:</label>
                                                        <input name="title" value="<?= $getOneBlog['title'] ?>" type="text" class="form-control"
                                                               data-v-message="عنوان محصول نمی‌تواند خالی باشد" required
                                                               placeholder="عنوان محصول را وارد کنید" />
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label>نویسنده مقاله  : </label>
                                                        <input type="text" value="<?= $getOneBlog['author'] ?>" name="author" class="form-control" data-v-message="نویسنده مقاله نمی‌تواند خالی باشد" required />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-6">
                                                        <label>برچسب  مقاله : </label>
                                                        <input name="label" type="text" value="<?= $getOneBlog['label'] ?>" class="form-control"
                                                               data-v-message="برچسب مقاله نمیتواند خالی بماند" required
                                                               placeholder="برچسب مقاله را وارد کنید" />
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label>تصویر مقاله:</label>
                                                        <input type="file" name="image" id="inputFile" accept="image/*" class="form-control" />

                                                        <!-- نمایش نام فایل فعلی یا فایل انتخاب شده -->
                                                        <div class="mt-2">
                                                            <small id="uploadedFileName" class="text-muted">
                                                                <?= !empty($image_url) ? 'تصویر فعلی: ' . basename($image_url) : 'تصویری انتخاب نشده است' ?>
                                                            </small>
                                                        </div>

                                                        <!-- پیش‌نمایش تصویر فعلی (اگر وجود داشت) -->
                                                        <?php if (!empty($image_url)): ?>
                                                            <div class="mt-3">
                                                                <img src="<?= $image_url ?>" alt="Blog Image" class="img-thumbnail" style="max-height: 150px;">
                                                            </div>
                                                        <?php endif ?>

                                                        <div id="imagePreview" class="mt-2"></div>
                                                    </div>

                                                </div>
                                                <div class="form-group row">
                                                <div class="col-lg-6">
                                                    <label> دسته بندی محصول :</label>
                                                    <select name="blog_categories_id" class="form-control" data-v-message="دسته بندی محصول نمیتواند خالی بماند" required>
                                                        <?php
                                                        $getOneCategories = getOneBlogCategories($getOneBlog['blog_categories_id']);
                                                        $getCategoriesActive = getAllBlogCategoriesByStatus();
                                                        if($getOneCategories) {
                                                            ?>
                                                            <option value="<?php echo $getOneCategories['id'] ?>"><?php echo $getOneCategories['title'] ?></option>
                                                            <?php
                                                        }
                                                        if($getCategoriesActive) {
                                                            foreach($getCategoriesActive as $Categories) {
                                                                if($Categories['id'] != $getOneCategories['id']) {
                                                                    ?>
                                                                    <option value="<?php echo $Categories['id'] ?>"><?php echo $Categories['title'] ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-lg-12">
                                                        <label>توضیحات محصول:</label>
                                                        <textarea name="description" class="summernote" id="productDescription" rows="10"
                                                                  data-v-message="توضیحات نمی‌تواند خالی باشد" required>
                                            <?= $getOneBlog['description'] ?>
                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                                            <?php
                                            $seoJson = isset($getOneBlog['seo']) && !is_null($getOneBlog['seo']) ? $getOneBlog['seo'] : '{}'; // مقدار پیش‌فرض به عنوان یک شیء خالی
                                            $seoData = json_decode($seoJson, true);
                                            if (json_last_error() !== JSON_ERROR_NONE) {
                                                // مدیریت خطا
                                                echo 'خطا در تجزیه JSON: ' . json_last_error_msg();
                                                $seoData = ['keywords' => [], 'seo_description' => '', 'canonical' => '']; // مقدار پیش‌فرض
                                            }
                                            $keywordsArray = array_key_exists('keywords', $seoData) && is_array($seoData['keywords']) ? $seoData['keywords'] : []; // مقدار پیش‌فرض آرایه خالی
                                            ?>
                                            <div class="form-group row">
                                                <div class="col-lg-6">
                                                    <label>عنوان صفحه:</label>
                                                    <input name="title" type="text" class="form-control" data-v-message="عنوان صفحه نمی‌تواند خالی باشد" required placeholder="عنوان محصول را وارد کنید" value="<?php echo htmlspecialchars($seoData['title'] ?? ''); ?>" />
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>کلمات کلیدی:</label>
                                                    <input name="keywords" type="text" id="wordInput" class="form-control" placeholder="کلمه را وارد کنید و Enter را بزنید" value="<?php echo htmlspecialchars(implode(', ', $keywordsArray)); ?>" />
                                                    <div id="wordContainer" class="mt-3 d-flex flex-wrap">
                                                        <ul id="wordList" class="list-group list-group-horizontal" style="flex-wrap:wrap;">
                                                            <?php if (!empty($keywordsArray)): ?>
                                                                <?php foreach ($keywordsArray as $keyword): ?>
                                                                    <li class="list-group-item"><?php echo htmlspecialchars($keyword); ?> <button type="button" class="btn btn-danger btn-sm remove-word" data-keyword="<?php echo htmlspecialchars($keyword); ?>">حذف</button></li>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-6">
                                                    <label>توضیحات سئو:</label>
                                                    <textarea name="seo_description" class="form-control" id="exampleTextarea" rows="5" placeholder="توضیحات کوتاهی درباره محصول وارد کنید"><?php echo htmlspecialchars($seoData['seo_description'] ?? ''); ?></textarea>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>تگ canonical:</label>
                                                    <input name="canonical" type="text" class="form-control" placeholder="به صورت لینک وارد کنید، وگرنه به صورت خودکار پر میشود" value="<?php echo htmlspecialchars($seoData['canonical'] ?? ''); ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <label> وضعیت محصول:</label>
                                                    <select class="form-control" name="status">
                                                        <?php
                                                        if ($getOneBlog['status'] ==1){
                                                            ?>
                                                            <option value="1">منتشر کردن</option>
                                                            <option value="2">ذخیره به صورت پیشنویس</option>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <option value="2">ذخیره به صورت پیشنویس</option>
                                                            <option value="1">منتشر کردن</option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2" style="margin-top: 26px;margin-right:auto;">
                                                    <button type="button" class="btn btn-primary mr-2" onclick="updateBlog(<?= GET('id') ?>)">ویرایش</button>
                                                    <a href="http://home.test/admin/agent/management" class="btn btn-secondary">لغو</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="#kt_tab_pane_7_1" role="tabpanel"
                                                 aria-labelledby="#kt_tab_pane_7_1">
                                                <div id="getErrors"></div>
                                            </div>
                                            <div class="tab-pane fade" id="#kt_tab_pane_7_2" role="tabpanel"
                                                 aria-labelledby="#kt_tab_pane_7_2">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const imageInput = document.getElementById('inputFile');
                const previewContainer = document.getElementById('imagePreview');
                const fileNameDisplay = document.getElementById('uploadedFileName');

                if (imageInput) {
                    imageInput.addEventListener('change', function() {
                        const file = this.files[0];

                        if (file) {
                            // 1. به‌روزرسانی متن نمایش نام فایل
                            fileNameDisplay.textContent = "فایل انتخاب شده: " + file.name;
                            fileNameDisplay.classList.replace('text-muted', 'text-primary'); // تغییر رنگ برای جلب توجه کاربر

                            // 2. بررسی حجم فایل (اختیاری اما توصیه شده - مثلاً حداکثر 2 مگابایت)
                            const maxSize = 2 * 1024 * 1024;
                            if (file.size > maxSize) {
                                alert("حجم فایل نباید بیشتر از 2 مگابایت باشد.");
                                this.value = ""; // ریست کردن اینپوت
                                fileNameDisplay.textContent = "خطا: حجم فایل بسیار زیاد است!";
                                previewContainer.innerHTML = "";
                                return;
                            }

                            // 3. نمایش پیش‌نمایش تصویر جدید
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                // جایگزین کردن محتوای دیو با تصویر جدید
                                previewContainer.innerHTML = `
                        <div class="mt-2">
                            <p class="small mb-1 text-success">پیش‌نمایش تصویر جدید:</p>
                            <img src="${e.target.result}"
                                 alt="New Image Preview"
                                 class="img-thumbnail"
                                 style="max-height: 200px; width: auto; display: block; border: 2px solid #28a745;">
                        </div>
                    `;
                            };
                            reader.readAsDataURL(file);

                        } else {
                            // اگر کاربر انتخاب را لغو کرد
                            fileNameDisplay.textContent = "تصویری انتخاب نشده است";
                            previewContainer.innerHTML = "";
                        }
                    });
                }
            });
        </script>

        <script type="application/json" id="productImagesData">    <?= json_encode($blogImageData, JSON_UNESCAPED_UNICODE) ?></script>

        <?php
$pageTitle = "ویرایش  مقاله";
$pageScript = "
    <script src='../../assets/admin/js/sweetalert.js'></script>
    <script src='../../assets/admin/js/main.js'></script>
    <script src='../../assets/admin/js/jbvalidator.js'></script>
    <script src='../../assets/admin/js/pages/crud/forms/editors/summernote.js'></script>
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

