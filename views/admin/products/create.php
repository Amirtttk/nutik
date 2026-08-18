<style>
    .image-container {
        position: relative;
        display: inline-block;
        margin: 10px;
    }

    .image-container img {
        width: 140px;
        height: 140px;
        object-fit: cover;
        border-radius: 6px;
        border: 2px solid #ccc;
    }

    .remove-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background: red;
        color: white;
        border: none;
        border-radius: 50%;
        width: 22px;
        height: 22px;
        line-height: 20px;
        text-align: center;
        cursor: pointer;
        font-size: 14px;
    }

    .main-label {
        position: absolute;
        bottom: 6px;
        left: 6px;
        background: rgba(0, 128, 0, 0.7);
        color: white;
        font-size: 11px;
        padding: 2px 6px;
        border-radius: 4px;
    }

    .image-container input[type="radio"] {
        position: absolute;
        bottom: 6px;
        right: 6px;
        transform: scale(1.2);
    }
</style>
<!--begin::Content-->
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::زیر هدر-->
    <!--begin::زیر هدر-->
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::اطلاعات-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="card-label">ایجاد محصول </h5>
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
                            <h3 class="card-label">ایجاد محصول جدید </h3>
                        </div>
                        <div class="card-toolbar">
                            <ul class="nav nav-tabs nav-tabs-line">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1">
                                        <span class="nav-icon"><i class="fa fa-info"></i></span>
                                        اطلاعات محصول
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2">
                                        <span class="nav-icon"><i class="fa fa-info"></i></span>
                                        اطلاعات سئو
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3">
                                        <span class="nav-icon"><i class="fa fa-info"></i></span>
                                        اطلاعات ارسال
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <form id="productForm" class="tab-content mt-5 p-5 needs-validation"  enctype="multipart/form-data">
                        <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                            <div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>عنوان محصول:</label>
                                        <input name="title" type="text" class="form-control"
                                               data-v-message="عنوان محصول نمی‌تواند خالی باشد" required
                                               placeholder="عنوان محصول را وارد کنید" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>عنوان انگلیسی : </label>
                                        <input type="text" name="english_title" class="form-control"
                                               data-v-message="عنوان انگلیسی نمی‌تواند خالی باشد" required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>دسته‌بندی اصلی:</label>
                                        <select class="form-control" name="category_id" id="parentSelect" data-v-message="لطفا دسته اصلی را انتخاب کنید" required>
                                            <option value="">انتخاب کنید</option>
                                            <?php
                                            $parentCategories = getAllCategoriesByParentId();
                                            foreach ($parentCategories as $parent) {
                                                echo '<option value="' . $parent['id'] . '">' . $parent['title'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>دسته پدر:</label>
                                        <select name="parent_id" id="parentSelectChild" class="form-control" >
                                            <option value="">لطفا دسته اصلی را انتخاب نمایید</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>زیر دسته :</label>
                                        <select name="child_id" id="childSelect" class="form-control" >
                                            <option value="">لطفا دسته پدر را انتخاب نمایید</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>برند  :</label>
                                        <select name="brand_id"  class="form-control">
                                            <option value="">لطفا برند را انتخاب نمایید</option>
                                            <?php
                                            $getAllBrandsByStatus = getAllBrandsByStatus();
                                            foreach ($getAllBrandsByStatus as $Brands) {
                                                echo '<option value="' . $Brands['id'] . '">' . $Brands['title'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-1 col-12" id="price">
                                        <label>چند قیمتی؟</label>
                                        <input id="multiPrice" type="checkbox" style="width:25px; height:25px; margin-right:10px;" name="feature_names[]">
                                    </div>
                                    <div class="col-lg-7" id="box1" style="display: flex;">
                                        <div class="col-lg-7">
                                            <label>قیمت محصول:</label>
                                            <input type="text" name="price" class="form-control" data-v-message="قیمت محصول نمی‌تواند خالی باشد" required />
                                        </div>
                                        <div class="col-lg-5">
                                            <label>درصد تخفیف : </label>
                                            <input type="text" name="token" class="form-control" data-v-message="درصد تخفیف نمی‌تواند خالی باشد" required />
                                        </div>
                                    </div>
                                    <div class="form-group row w-100 mt-4">
                                        <div class="col-lg-12" id="box2" style="display: none;">
                                            <div class="w-100">
                                                <label>ویژگی محصول:</label>
                                                <div id="exerciseContainer1" class=""></div>

                                                <button type="button" id="addExerciseBtn" class="btn btn-primary mt-2">
                                                    افزودن ویژگی +
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>تصاویر محصول (حداکثر ۵ عدد):</label>
                                        <input type="file" name="images[]" id="imageInput" accept="image/*" multiple class="form-control" />
                                        <div id="imagePreview" class="row mt-3"></div>
                                        <input type="hidden" name="main_image_index" id="mainImageIndex" value="0">
                                    </div>
                                    <div class="col-lg-6">
                                        <label>نکته محصول:</label>
                                        <input name="tip" value="" type="text" class="form-control"
                                               data-v-message="نکته محصول نمی‌تواند خالی باشد" required
                                               placeholder="نکته محصول را وارد کنید" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4" id="stockProduct">
                                        <label>موجودی:</label>
                                        <input type="number" name="stock" class="form-control" data-v-message="موجودی نمی‌تواند خالی باشد" required />
                                    </div>
                                    <div class="col-lg-4" id="maxProduct">
                                        <label>تعداد حداکثر افزودن به سبد خرید  :(اختیاری)</label>
                                        <input type="text" name="max_purchases" class="form-control"
                                               required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <!--                                            <div class="col-lg-6 col-12">-->
                                    <!--                                                <label>تعداد ویژگی ها:</label>-->
                                    <!--                                                <select id="exerciseSelect1" class="form-control exerciseSelect" data-container="exerciseContainer1" data-day="1">-->
                                    <!--                                                    <option value="">انتخاب کنید</option>-->
                                    <!--                                                    <option value="1">1 ویژگی</option>-->
                                    <!--                                                    <option value="2">2 ویژگی</option>-->
                                    <!--                                                    <option value="3">3 ویژگی</option>-->
                                    <!--                                                    <option value="4">4 ویژگی</option>-->
                                    <!--                                                    <option value="5">5 ویژگی</option>-->
                                    <!--                                                    <option value="6">6 ویژگی</option>-->
                                    <!--                                                    <option value="7">7 ویژگی</option>-->
                                    <!--                                                    <option value="8">8 ویژگی</option>-->
                                    <!--                                                    <option value="9">9 ویژگی</option>-->
                                    <!--                                                    <option value="10">10 ویژگی</option>-->
                                    <!--                                                </select>-->
                                    <!--                                        </div>-->
                                    <div id="exerciseContainer1" class="exerciseContainer mt-3 col-12"></div>
                                    <div class="mt-5 w-100">
                                        <label>مشخصات محصول:</label>
                                        <div id="featuresContainer" class=""></div>

                                        <button type="button" id="addFeatureBtn" class="btn btn-primary mt-2">
                                            افزودن مشخصه +
                                        </button>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <label>توضیحات کوتاه محصول:</label>
                                        <textarea name="short_description" class="summernote" id="productDescription" rows="10"
                                                  data-v-message="توضیحات نمی‌تواند خالی باشد" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <label>توضیحات محصول:</label>
                                        <textarea name="description" class="summernote" id="productDescription" rows="10"
                                                  data-v-message="توضیحات نمی‌تواند خالی باشد" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>عنوان صفحه:</label>
                                    <input name="title" type="text" class="form-control"
                                           data-v-message="عنوان صفحه نمی‌تواند خالی باشد" required
                                           placeholder="عنوان محصول را وارد کنید" />
                                </div>
                                <div class="col-lg-6">
                                    <label>کلمات کلیدی:</label>
                                    <input name="keywords" type="text" id="wordInput" class="form-control" placeholder="کلمه را وارد کنید و Enter را بزنید" />
                                    <div id="wordContainer" class="mt-3 d-flex flex-wrap">
                                        <ul id="wordList" class="list-group list-group-horizontal" style="flex-wrap:wrap;"></ul>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>توضیحات سئو:</label>
                                    <textarea name="seo_description" class="form-control" id="exampleTextarea" rows="5" placeholder="توضیحات کوتاهی درباره محصول وارد کنید"></textarea>
                                </div>
                                <div class="col-lg-6">
                                    <label>تگ canonical:</label>
                                    <input name="canonical" type="text" class="form-control" placeholder="به صورت لینک وارد کنید، وگرنه به صورت خودکار پر میشود" />
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                            <label class="text-danger">اطلاعات زیر برای محاسبه هزینه ارسال می باشد لطفا همه را به درستی وارد نمایید:</label>
                            <div class="form-group row">

                                <div class="col-lg-3">
                                    <label>طول محصول با کارتن :</label>
                                    <input type="text" name="length" class="form-control"
                                           required />
                                </div>
                                <div class="col-lg-3">
                                    <label>عرض محصول با کارتن :</label>
                                    <input type="text" name="width" class="form-control"
                                           required />
                                </div>
                                <div class="col-lg-3">
                                    <label>ارتفاع محصول با کارتن :</label>
                                    <input type="text" name="height" class="form-control"
                                           required />
                                </div>
                                <div class="col-lg-3">
                                    <label>وزن واقعی محصول با کارتن(گرم) :</label>
                                    <input type="text" name="actualWeight" class="form-control"
                                           required />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label> وضعیت محصول:</label>
                                    <select class="form-control" name="status">
                                        <option value="1">منتشر کردن</option>
                                        <option value="2">ذخیره به صورت پیشنویس</option>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <label>محصول ویژه؟</label>
                                    <select class="form-control" name="special">
                                            <option value="1">بله</option>
                                            <option value="2">خیر</option>
                                    </select>
                                </div>
                                <div class="col-lg-2" style="margin-top: 26px;">
                                    <button type="button" class="btn btn-primary mr-2" onclick="createBlog()">ایجاد</button>
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
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->
<script>
    const imageInput = document.getElementById('imageInput');
    const previewContainer = document.getElementById('imagePreview');
    const mainImageIndexInput = document.getElementById('mainImageIndex');
    let imageFiles = [];

    imageInput.addEventListener('change', function () {
        const newFiles = Array.from(this.files);

        // فقط تا 5 تصویر نگه داریم
        if (imageFiles.length + newFiles.length > 5) {
            alert("حداکثر ۵ تصویر قابل انتخاب است.");
            return;
        }

        imageFiles = imageFiles.concat(newFiles);
        renderImages();
        updateInputFiles();
        this.value = ''; // reset input تا اجازه بده دوباره همون فایل انتخاب بشه
    });

    function renderImages() {
        previewContainer.innerHTML = '';

        imageFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const container = document.createElement('div');
                container.className = 'image-container';

                const img = document.createElement('img');
                img.src = e.target.result;

                const removeBtn = document.createElement('button');
                removeBtn.className = 'remove-btn';
                removeBtn.innerHTML = '&times;';
                removeBtn.onclick = function () {
                    imageFiles.splice(index, 1);

                    if (parseInt(mainImageIndexInput.value) === index) {
                        mainImageIndexInput.value = 0;
                    } else if (parseInt(mainImageIndexInput.value) > index) {
                        mainImageIndexInput.value = parseInt(mainImageIndexInput.value) - 1;
                    }

                    renderImages();
                    updateInputFiles();
                };

                const radio = document.createElement('input');
                radio.type = 'radio';
                radio.name = 'mainImage';
                radio.checked = parseInt(mainImageIndexInput.value) === index;
                radio.onclick = function () {
                    mainImageIndexInput.value = index;
                    renderImages();
                };

                container.appendChild(img);
                container.appendChild(removeBtn);
                container.appendChild(radio);

                if (parseInt(mainImageIndexInput.value) === index) {
                    const label = document.createElement('span');
                    label.className = 'main-label';
                    label.textContent = 'تصویر اصلی';
                    container.appendChild(label);
                }

                previewContainer.appendChild(container);
            };
            reader.readAsDataURL(file);
        });
    }

    function updateInputFiles() {
        const dt = new DataTransfer();
        imageFiles.forEach(file => dt.items.add(file));
        imageInput.files = dt.files;
    }
</script>
<script src='../../assets/admin/js/jquery.js'></script>
<script>
    $(document).ready(function () {
        $(".exerciseSelect").change(function () {
            var count = parseInt($(this).val());
            var containerId = $(this).data("container");
            var container = $("#" + containerId);
            container.empty();

            let day = $(this).data("day");

            if (count && count > 0) {
                for (let index = 0; index < count; index++) {
                    const uid = Date.now() + "-" + Math.random().toString(36).substring(2, 7); // ID یکتا

                    var html = `
              <div class="form-group row exercise-block mt-2" id="${uid}">
                  <input type="hidden" name="exercise_id[]" value="${index + 1}">

                  <div class="col-lg-4 col-12">
                      <label>قیمت :</label>
                      <input type="text" class="form-control" name="feature_names[]" placeholder="قیمت را وارد کنید">
                  </div>
                  <div class="col-lg-4 col-12">
                      <label>قیمت با تخفیف:</label>
                      <input name="feature_prices[]" type="text" class="form-control" placeholder="قیمت با تخفیف وارد کنید">
                  </div>
                  <div class="col-lg-3 col-12">
                      <label>کد رنگ :</label>
                      <input name="feature_delivery_times[]" type="color" class="form-control" placeholder="مثلا 1fd456#">
                  </div>
                  <div class="col-lg-1 col-12 d-flex align-items-end">
                      <button type="button" class="btn btn-danger remove-exercise w-100" data-id="${uid}" data-select="#${$(this).attr("id")}">
                        حذف
                      </button>
                  </div>
              </div>`;
                    container.append(html);
                }
            }
        });

        $(document).on("click", ".remove-exercise", function () {
            var blockId = $(this).data("id");
            var selectId = $(this).data("select");
            $("#" + blockId).remove();

            // کم کردن تعداد انتخاب شده در select، بدون trigger("change")
            var selectElement = $(selectId);
            var currentVal = parseInt(selectElement.val());
            if (currentVal > 1) {
                selectElement.val(currentVal - 1);
            } else {
                selectElement.val("");
            }
        });
    });
    $(document).ready(function () {

        $("#addExerciseBtn").click(function () {

            
            const uid = Date.now() + "-" + Math.random().toString(36).substr(2, 6);

            let row = `
        <div class="row exercise-block mt-2" id="${uid}">
            <input type="hidden" name="exercise_id[]" value="${uid}">
            <div class="col-lg-2 col-12" id="price">
                <label>عنوان رنگ:</label>
                <input type="text" class="form-control" name="feature_title_color[]" placeholder="عنوان رنگ را وارد کنید">
            </div>
            <div class="col-lg-2 col-12" id="price">
                <label>قیمت:</label>
                <input type="text" class="form-control" name="feature_price[]" placeholder="قیمت به تومان">
            </div>

            <div class="col-lg-2 col-12" id="priceOff">
                <label>قیمت با تخفیف:</label>
                <input name="feature_prices_discount[]" type="text" class="form-control" placeholder="قیمت با تخفیف به تومان">
            </div>
            <div class="col-lg-2 col-12" id="priceOff">
                <label>حداکثر افزودن به سبد خرید:</label>
                <input name="feature_max_purchase[]" type="text" class="form-control" placeholder="حداکثر افزودن به سبد خرید">
            </div>
            <div class="col-lg-2 col-12" id="priceOff">
                <label>موجودی:</label>
                <input name="feature_count[]" type="text" class="form-control" placeholder="موجودی محصول">
            </div>

            <div class="col-lg-1 col-12">
                <label>رنگ:</label>
                <input name="feature_color[]" type="color" class="form-control">
            </div>
            <div class="col-lg-1 col-12 d-flex align-items-end">
                <button type="button" class="btn btn-danger remove-exercise" data-id="${uid}">
                    حذف
                </button>
            </div>
        </div>
        `;
            $("#exerciseContainer1").append(row);
        });

        // حذف ردیف
        $(document).on("click", ".remove-exercise", function () {
            const id = $(this).data("id");
            $("#" + id).remove();
        });

    });
    $(document).ready(function () {

        $("#addFeatureBtn").click(function () {
            const uid = Date.now() + "-" + Math.random().toString(36).substr(2, 6);

            let row = `
        <div class="row feature-row w-full" id="${uid}">
            <div class="col-lg-5 col-12">
                <label>عنوان :</label>
                <input type="text" name="feature_names[]" class="form-control" placeholder="مثلا جنس بدنه">
            </div>

            <div class="col-lg-6 col-12">
                <label>مقدار:</label>
                <input type="text" name="feature_values[]" class="form-control" placeholder="مثلا شیشه">
            </div>

            <div class="col-lg-1 col-12 d-flex align-items-end">
                <button type="button" class="btn btn-danger remove-feature w-100" data-id="${uid}">
                    حذف
                </button>
            </div>
        </div>
        `;

            $("#featuresContainer").append(row);
        });

        // حذف هر ردیف ویژگی
        $(document).on("click", ".remove-feature", function () {
            const id = $(this).data("id");
            $("#" + id).remove();
        });
    });
</script>
<script>
    const checkbox = document.getElementById('multiPrice');
    const stockProduct = document.getElementById('stockProduct');
    const maxProduct = document.getElementById('maxProduct');
    const box1 = document.getElementById('box1');
    const box2 = document.getElementById('box2');

    checkbox.addEventListener('change', () => {
        if (checkbox.checked) {
            box1.style.display = 'none'; // نمایش دیو اول
            box2.style.display = 'flex';  // مخفی کردن دیو دوم
            stockProduct.style.display = 'none'; // نمایش دیو اول
            maxProduct.style.display = 'none'; // نمایش دیو اول
        } else {
            box1.style.display = 'flex';
            box2.style.display = 'none';
            stockProduct.style.display = 'block'; // نمایش دیو اول
            maxProduct.style.display = 'block'; // نمایش دیو اول
        }
    });
</script>
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
$pageTitle = "ایجاد  محصول جدید ";
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