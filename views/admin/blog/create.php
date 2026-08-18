
<!--begin::Content-->
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::زیر هدر-->
    <!--begin::زیر هدر-->
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::اطلاعات-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="card-label">ایجاد مقاله </h5>
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
                            <h3 class="card-label">ایجاد مقاله جدید </h3>
                        </div>
                        <div class="card-toolbar">
                            <ul class="nav nav-tabs nav-tabs-line">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1">
                                        <span class="nav-icon"><i class="fa fa-info"></i></span>
                                        اطلاعات مقاله
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
                    <form id="blogId"
                          class="tab-content mt-5 p-5 needs-validation"
                          enctype="multipart/form-data"
                          novalidate>

                        <!-- اطلاعات اصلی مقاله -->
                        <div class="tab-pane fade show active"
                             id="kt_tab_pane_1"
                             role="tabpanel"
                             aria-labelledby="kt_tab_pane_1">

                            <div class="form-group row">

                                <div class="col-lg-4">
                                    <label for="blogTitle">عنوان مقاله:</label>

                                    <input id="blogTitle"
                                           name="title"
                                           type="text"
                                           class="form-control"
                                           data-v-message="عنوان مقاله نمی‌تواند خالی باشد"
                                           required
                                           placeholder="عنوان مقاله را وارد کنید">

                                    <div class="invalid-feedback">
                                        عنوان مقاله نمی‌تواند خالی باشد.
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <label for="author">نویسنده مقاله:</label>

                                    <input id="author"
                                           name="author"
                                           type="text"
                                           class="form-control"
                                           data-v-message="نویسنده مقاله نمی‌تواند خالی باشد"
                                           required
                                           placeholder="نویسنده مقاله را وارد کنید">

                                    <div class="invalid-feedback">
                                        نویسنده مقاله نمی‌تواند خالی باشد.
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <label for="blogCategory">دسته‌بندی مقاله:</label>

                                    <select id="blogCategory"
                                            class="form-control selectpicker"
                                            name="blog_categories_id"
                                            required>

                                        <option value="">
                                            دسته‌بندی مقاله را انتخاب کنید
                                        </option>

                                        <?php
                                        $items = getAllBlogCategoriesByStatus();

                                        if ($items) {
                                            foreach ($items as $item) {
                                                ?>
                                                <option value="<?php echo htmlspecialchars($item['id']); ?>">
                                                    <?php echo htmlspecialchars($item['title']); ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>

                                    <div class="invalid-feedback">
                                        دسته‌بندی مقاله را انتخاب کنید.
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row mt-4">

                                <div class="col-lg-4">
                                    <label for="inputFile">تصویر مقاله:</label>

                                    <label class="upload-file p-3 w-100 d-flex align-items-center"
                                           style="column-gap: 10px; cursor: pointer;">

                                        <i class="fa fa-camera"></i>

                                        <input id="inputFile"
                                               name="image"
                                               class="form-control custom-file-input"
                                               accept=".png,.jpg,.jpeg,.webp,.gif"
                                               type="file"
                                               required>

                                        <span id="uploadedFileName">
                        تصویر را انتخاب کنید.
                    </span>
                                    </label>

                                    <div class="invalid-feedback d-block" id="imageError"></div>
                                </div>

                                <div class="col-lg-4">
                                    <label for="label">برچسب مقاله:</label>

                                    <input id="label"
                                           name="label"
                                           type="text"
                                           class="form-control"
                                           data-v-message="برچسب مقاله نمی‌تواند خالی باشد"
                                           required
                                           placeholder="برچسب مقاله را وارد کنید">

                                    <div class="invalid-feedback">
                                        برچسب مقاله نمی‌تواند خالی باشد.
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label for="label">زمان مطالعه :</label>

                                    <input id="label"
                                           name="reading_time"
                                           type="text"
                                           class="form-control"
                                           data-v-message="زمان مطالعه نمی‌تواند خالی باشد"
                                           required
                                           placeholder="زمان مطالعه را وارد کنید">

                                    <div class="invalid-feedback">
                                        زمان مطالعه نمی‌تواند خالی باشد.
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row mt-4">
                                <div class="col-lg-12">
                                    <label for="productDescription">توضیحات مقاله:</label>

                                    <textarea id="productDescription"
                                              name="description"
                                              class="summernote"
                                              rows="10"></textarea>
                                </div>
                            </div>

                        </div>

                        <!-- تنظیمات سئو -->
                        <div class="tab-pane fade"
                             id="kt_tab_pane_2"
                             role="tabpanel"
                             aria-labelledby="kt_tab_pane_2">

                            <div class="form-group row">

                                <div class="col-lg-6">
                                    <label for="metaTitle">عنوان صفحه:</label>

                                    <input id="metaTitle"
                                           name="meta_title"
                                           type="text"
                                           class="form-control"
                                           placeholder="عنوان صفحه را وارد کنید">
                                </div>

                                <div class="col-lg-6">
                                    <label for="wordInput">کلمات کلیدی:</label>

                                    <input id="wordInput"
                                           name="keywords"
                                           type="text"
                                           class="form-control"
                                           placeholder="کلمه را وارد کنید و Enter را بزنید">

                                    <div id="wordContainer"
                                         class="mt-3 d-flex flex-wrap">

                                        <ul id="wordList"
                                            class="list-group list-group-horizontal"
                                            style="flex-wrap: wrap;">
                                        </ul>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row mt-4">

                                <div class="col-lg-6">
                                    <label for="exampleTextarea">توضیحات سئو:</label>

                                    <textarea id="exampleTextarea"
                                              name="seo_description"
                                              class="form-control"
                                              rows="5"
                                              placeholder="توضیحات کوتاهی درباره مقاله وارد کنید"></textarea>
                                </div>

                                <div class="col-lg-6">
                                    <label for="canonical">تگ Canonical:</label>

                                    <input id="canonical"
                                           name="canonical"
                                           type="url"
                                           class="form-control"
                                           placeholder="لینک Canonical را وارد کنید">
                                </div>

                            </div>

                        </div>

                        <div id="getErrors" class="text-danger mt-3"></div>

                        <div class="card-footer mt-5">
                            <button type="button"
                                    class="btn btn-primary mr-2"
                                    onclick="createBlog()">

                                ایجاد مقاله
                            </button>

                            <a href="http://home.test/admin/agent/management"
                               class="btn btn-secondary">
                                لغو
                            </a>
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
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->
<script src='../../assets/admin/js/jquery.js'></script>
<script>
    $(document).ready(function () {
        const keywords = []; // آرایه برای ذخیره کلمات کلیدی

        $('#wordInput').on('keypress', function (e) {
            if (e.which === 13) { // اگر کلید Enter فشرده شد
                e.preventDefault(); // جلوگیری از رفتار پیش‌فرض
                const word = $(this).val().trim(); // دریافت کلمه و حذف فضای خالی
                if (word) {
                    keywords.push(word); // اضافه کردن کلمه به آرایه
                    const listItem = $(`<li class="list-group-item d-flex justify-content-between align-items-center" style="column-gap:8px;">${word}
                    <button class="btn btn-danger btn-sm remove-key-word" style="padding:0px;">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="white" fill-rule="evenodd">
                            <path d="M10.5857864,14 L9.17157288,12.5857864 C8.78104858,12.1952621 8.78104858,11.5620972 9.17157288,11.1715729 C9.56209717,10.7810486 10.1952621,10.7810486 10.5857864,11.1715729 L12,12.5857864 L13.4142136,11.1715729 C13.8047379,10.7810486 14.4379028,10.7810486 14.8284271,11.1715729 C15.2189514,11.5620972 15.2189514,12.1952621 14.8284271,12.5857864 L13.4142136,14 L14.8284271,15.4142136 C15.2189514,15.8047379 15.2189514,16.4379028 14.8284271,16.8284271 C14.4379028,17.2189514 13.8047379,17.2189514 13.4142136,16.8284271 L12,15.4142136 L10.5857864,16.8284271 C10.1952621,17.2189514 9.56209717,17.2189514 9.17157288,16.8284271 C8.78104858,16.4379028 8.78104858,15.8047379 9.17157288,15.4142136 L10.5857864,14 Z" fill="#white"></path>
                        </g>
                    </svg>
                    </button></li>`); // ایجاد آیتم لیست با دکمه حذف
                    $('#wordList').append(listItem); // اضافه کردن کلمه به لیست
                    $(this).val(''); // پاک کردن ورودی
                    // به‌روزرسانی فیلد مخفی
                    $('input[name="keywords"]').val(keywords.join(',')); // ذخیره کلمات کلیدی در فیلد
                }
            }
        });
        // حذف کلمه
        $('#wordList').on('click', '.remove-key-word', function () {
            const word = $(this).closest('li').text().trim(); // دریافت کلمه
            keywords.splice(keywords.indexOf(word), 1); // حذف کلمه از آرایه
            $(this).closest('li').remove(); // حذف آیتم لیست

            // به‌روزرسانی فیلد مخفی
            $('input[name="keywords"]').val(keywords.join(',')); // ذخیره کلمات کلیدی در فیلد
        });
    });
</script>
<?php
$pageTitle = "ایجاد  مقاله جدید ";
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