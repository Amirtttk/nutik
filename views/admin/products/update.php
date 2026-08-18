<?php
$getOneProduct = getOneProduct(GET('id'));
// محاسبه ایندکس تصویر اصلی برای مقداردهی اولیه
$oldImagesForIndex = json_decode($getOneProduct['images'], true) ?? [];
$mainImageRaw = $getOneProduct['main_image'] ?? '';
$initialMainIndex = 0;
if ($mainImageRaw && !empty($oldImagesForIndex)) {
    $idx = array_search($mainImageRaw, $oldImagesForIndex, true);
    if ($idx === false) {
        foreach ($oldImagesForIndex as $i => $img) {
            if (basename($img) === basename($mainImageRaw)) {
                $idx = $i;
                break;
            }
        }
    }
    if ($idx !== false) {
        $initialMainIndex = $idx;
    }
}
?>
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
                                        <input name="title" value="<?= $getOneProduct['title'] ?>" type="text" class="form-control"
                                               data-v-message="عنوان محصول نمی‌تواند خالی باشد" required
                                               placeholder="عنوان محصول را وارد کنید" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>عنوان انگلیسی : </label>
                                        <input type="text" value="<?= $getOneProduct['english_title'] ?>" name="english_title" class="form-control"
                                               data-v-message="عنوان انگلیسی نمی‌تواند خالی باشد" required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <?php
                                    // دریافت دسته فعلی (همون زیر‌دسته ذخیره‌شده در محصول)
                                    $currentCategory = getCategoryById($getOneProduct['category_id']);

                                    // دریافت دسته پدر
                                    $parentCategory = $currentCategory && $currentCategory['parent_id']
                                        ? getCategoryById($currentCategory['parent_id'])
                                        : null;

                                    // دریافت دسته اصلی (پدربزرگ)
                                    $mainCategory = ($parentCategory && $parentCategory['parent_id'])
                                        ? getCategoryById($parentCategory['parent_id'])
                                        : ($parentCategory ?: $currentCategory);
                                    ?>
                                    <div class="col-lg-4">
                                        <label>دسته‌بندی اصلی:</label>
                                        <select name="category_id" id="parentSelect" class="form-control" required>
                                            <?php
                                            $mainCategories = getAllCategoriesByParentId(0); // تمام دسته‌های سطح اول

                                            foreach ($mainCategories as $cat) {
                                                $selected = ($mainCategory && $mainCategory['id'] == $cat['id']) ? 'selected' : '';
                                                echo '<option value="'.$cat['id'].'" '.$selected.'>'.htmlspecialchars($cat['title']).'</option>';
                                            }
                                            ?>
                                        </select>                                    </div>

                                    <div class="col-lg-4">
                                        <label>دسته پدر:</label>
                                        <select name="parent_id" id="parentSelectChild" class="form-control" required>
                                            <?php
                                            if ($mainCategory) {
                                                $parentCategories = getChildCategoriesByParentId($mainCategory['id']);
                                                foreach ($parentCategories as $cat) {
                                                    $selected = ($parentCategory && $parentCategory['id'] == $cat['id']) ? 'selected' : '';
                                                    echo '<option value="'.$cat['id'].'" '.$selected.'>'.htmlspecialchars($cat['title']).'</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-lg-4">
                                        <label>زیر دسته:</label>
                                        <select name="child_id" id="childSelect" class="form-control" required>
                                            <?php
                                            if ($parentCategory) {
                                                $childCategories = getChildCategoriesByParentId($parentCategory['id']);
                                                foreach ($childCategories as $cat) {
                                                    $selected = ($cat['id'] == $currentCategory['id']) ? 'selected' : '';
                                                    echo '<option value="'.$cat['id'].'" '.$selected.'>'.htmlspecialchars($cat['title']).'</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>برند  :</label>
                                        <select name="brand_id"  class="form-control">
                                            <?php
                                            $getCategoriesActive = getAllBrand();
                                            if($getCategoriesActive) {
                                                ?>
                                                <?php
                                                foreach ($getCategoriesActive as $CategoriesActive) {
                                                    if($CategoriesActive['id'] == $getOneProduct['brand_id']) {
                                                        ?>
                                                        <option value="<?php echo $CategoriesActive['id'] ?>"><?php echo $CategoriesActive['title'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                foreach ($getCategoriesActive as $CategoriesActive) {
                                                    if($CategoriesActive['id'] != $getOneProduct['brand_id']) {
                                                        ?>
                                                        <option value="<?php echo $CategoriesActive['id'] ?>"><?php echo $CategoriesActive['title'] ?></option>
                                                        <?php
                                                    }
                                                }
                                            } else {
                                                ?>
                                                <option value="">دسته فعالی وجود ندارد</option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <?php
                                    // بررسی وجود کلید price و مقدار آن
                                    $priceJson = isset($getOneProduct['price']) && !is_null($getOneProduct['price']) ? $getOneProduct['price'] : '[]'; // مقدار پیش‌فرض آرایه خالی

                                    $prices = json_decode($priceJson, true);
                                    if (json_last_error() !== JSON_ERROR_NONE) {
                                        // مدیریت خطا
                                        echo 'خطا در تجزیه JSON: ' . json_last_error_msg();
                                        $prices = []; // یا مقدار پیش‌فرض دلخواه
                                    }

                                    // بررسی اینکه آیا قیمت چندگانه وجود دارد یا نه
                                    $isMultiplePrices = is_array($prices) && count($prices) > 1;
                                    ?>
                                    <div class="col-lg-1 col-12" id="price">
                                        <label>چند قیمتی؟</label>
                                        <input id="multiPrice" type="checkbox" style="width:25px; height:25px; margin-right:10px;" name="multiPrice"
                                            <?php echo $isMultiplePrices ? 'checked' : ''; ?>>
                                    </div>
                                    <div class="col-lg-7" id="box1" style="display: <?= $isMultiplePrices ? 'none' : 'flex'; ?>;">
                                        <div class="col-lg-7">
                                            <label>قیمت محصول:</label>
                                            <input type="text" name="price" class="form-control" data-v-message="قیمت محصول نمی‌تواند خالی باشد" required
                                                   value="<?= htmlspecialchars($getOneProduct['price'] ?? ''); ?>" />
                                        </div>
                                        <div class="col-lg-5">
                                            <label>درصد تخفیف:</label>
                                            <input type="text" name="token" class="form-control" data-v-message="درصد تخفیف نمی‌تواند خالی باشد" required
                                                   value="<?= htmlspecialchars($getOneProduct['token'] ?? ''); ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12" id="box2" style="display: <?= $isMultiplePrices ? 'flex' : 'none'; ?>;">
                                        <div class="w-100">
                                            <label>ویژگی محصول:</label>
                                            <div id="exerciseContainer1">
                                                <?php if ($isMultiplePrices): ?>
                                                    <?php foreach ($prices as $price): ?>
                                                        <?php
                                                            $uid = uniqid( true);
                                                        ?>
                                                        <div class="row exercise-block mt-2" id="<?= $uid; ?>">
                                                            <input type="hidden" name="exercise_id[]" value="<?= $uid; ?>">
                                                            <div class="col-lg-2 col-12">
                                                                <label>عنوان رنگ:</label>
                                                                <input type="text" class="form-control" name="feature_title_color[]" placeholder="عنوان رنگ را وارد کنید"
                                                                       value="<?= htmlspecialchars($price['titleColor'] ?? ''); ?>" />
                                                            </div>
                                                            <div class="col-lg-2 col-12">
                                                                <label>قیمت:</label>
                                                                <input type="text" class="form-control" name="feature_price[]" placeholder="قیمت را وارد کنید"
                                                                       value="<?= htmlspecialchars($price['price'] ?? ''); ?>" />
                                                            </div>
                                                            <div class="col-lg-2 col-12">
                                                                <label>قیمت با تخفیف:</label>
                                                                <input name="feature_prices_discount[]" type="text" class="form-control" placeholder="قیمت با تخفیف وارد کنید"
                                                                       value="<?= htmlspecialchars($price['discount'] ?? ''); ?>" />
                                                            </div>
                                                            <div class="col-lg-2 col-12" id="priceOff">
                                                                <label>حداکثر افزودن به سبد خرید:</label>
                                                                <input name="feature_max_purchase[]" value="<?= htmlspecialchars($price['max_purchase'] ?? ''); ?>" type="text" class="form-control" placeholder="حداکثر افزودن به سبد خرید">
                                                            </div>
                                                            <div class="col-lg-2 col-12" id="priceOff">
                                                                <label>موجودی:</label>
                                                                <input name="feature_count[]" value="<?= htmlspecialchars($price['count'] ?? ''); ?>" type="text" class="form-control" placeholder="موجودی محصول">
                                                            </div>
                                                            <div class="col-lg-1 col-12">
                                                                <label>کد رنگ:</label>
                                                                <input name="feature_color[]" type="color" class="form-control" value="<?= htmlspecialchars($price['color'] ?? ''); ?>" />
                                                            </div>

                                                            <div class="col-lg-1 col-12 d-flex align-items-end">
                                                                <button type="button" class="btn btn-danger remove-exercise" data-id="<?= $uid; ?>">
                                                                    حذف
                                                                </button>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                            <button type="button" id="addExerciseBtn" class="btn btn-primary mt-2">
                                                افزودن ویژگی +
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>تصاویر محصول (حداکثر ۵ عدد):</label>
                                        <input type="file" name="images[]" id="imageInput" accept="image/*" multiple class="form-control" />
                                        <div id="imagePreview" class="row mt-3"></div>
                                        <input type="hidden" name="main_image_index" id="mainImageIndex"
                                               value="<?= $initialMainIndex ?>">
                                        <input type="hidden" name="deleted_images" id="deletedImages" value="">
                                    </div>
                                    <div class="col-lg-6">
                                        <label>نکته محصول:</label>
                                        <input name="tip" value="<?= $getOneProduct['tip'] ?>" type="text" class="form-control"
                                               data-v-message="نکته محصول نمی‌تواند خالی باشد" required
                                               placeholder="نکته محصول را وارد کنید" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>موجودی:</label>
                                        <input value="<?= $getOneProduct['stock'] ?>" type="number" name="stock" class="form-control" data-v-message="موجودی نمی‌تواند خالی باشد" required />
                                    </div>
                                    <div class="col-lg-4" id="maxProduct" style="display:none;">
                                        <label>تعداد حداکثر افزودن به سبد خرید  :(اختیاری)</label>
                                        <input value="<?= $getOneProduct['max_purchases'] ?>" type="text" name="max_purchases" class="form-control"
                                               required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="mt-5 w-100">
                                        <label>مشخصات محصول:</label>
                                        <div id="featuresContainer">
                                            <?php
                                            $technicalFeaturesJson = isset($getOneProduct['technical']) ? $getOneProduct['technical'] : '[]';
                                            $technicalFeatures = json_decode($technicalFeaturesJson, true);
                                            $key = 0;
                                            if (is_array($technicalFeatures) && !empty($technicalFeatures)):
                                                foreach ($technicalFeatures as $feature):
                                                    $key++;
                                                    ?>
                                                    <div class="row feature-row w-full" id="<?= $key ?>">
                                                        <div class="col-lg-5 col-12">
                                                            <label>عنوان :</label>
                                                            <input type="text" name="feature_names[]" class="form-control" placeholder="مثلا جنس بدنه" value="<?php echo htmlspecialchars($feature['name'] ?? ''); ?>" required>
                                                        </div>
                                                        <div class="col-lg-6 col-12">
                                                            <label>مقدار:</label>
                                                            <input type="text" name="feature_values[]" class="form-control" placeholder="مثلا شیشه" value="<?php echo htmlspecialchars($feature['value'] ?? ''); ?>" required>
                                                        </div>
                                                        <div class="col-lg-1 col-12 d-flex align-items-end">
                                                            <button type="button" class="btn btn-danger remove-feature w-100" data-id="<?= $key ?>">
                                                                حذف
                                                            </button>
                                                        </div>
                                                    </div>
                                                <?php
                                                endforeach;
                                            else:
                                                $key++;
                                                ?>
                                                <div class="row feature-row w-full" id="<?= $key ?>">
                                                    <div class="col-lg-5 col-12">
                                                        <label>عنوان :</label>
                                                        <input type="text" name="feature_names[]" class="form-control" placeholder="مثلا جنس بدنه" required>
                                                    </div>
                                                    <div class="col-lg-6 col-12">
                                                        <label>مقدار:</label>
                                                        <input type="text" name="feature_values[]" class="form-control" placeholder="مثلا شیشه" required>
                                                    </div>
                                                    <div class="col-lg-1 col-12 d-flex align-items-end">
                                                        <button type="button" class="btn btn-danger remove-feature w-100">
                                                            حذف
                                                        </button>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <button type="button" id="addFeatureBtn" class="btn btn-primary mt-2">
                                            افزودن مشخصه +
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <label>توضیحات کوتاه محصول:</label>
                                        <textarea name="short_description" class="summernote" id="productDescription" rows="10"
                                                  data-v-message="توضیحات نمی‌تواند خالی باشد" required>
                                            <?= $getOneProduct['short_description'] ?>
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <label>توضیحات محصول:</label>
                                        <textarea name="description" class="summernote" id="productDescription" rows="10"
                                                  data-v-message="توضیحات نمی‌تواند خالی باشد" required>
                                            <?= $getOneProduct['description'] ?>
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                            <?php
                            $seoJson = isset($getOneProduct['seo']) && !is_null($getOneProduct['seo']) ? $getOneProduct['seo'] : '{}'; // مقدار پیش‌فرض به عنوان یک شیء خالی
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
                                    <input name="title" type="text" class="form-control" data-v-message="عنوان صفحه نمی‌تواند خالی باشد" required placeholder="عنوان محصول را وارد کنید" value="<?php echo htmlspecialchars($getOneProduct['title']); ?>" />
                                </div>
                                <div class="col-lg-6">
                                    <label>کلمات کلیدی:</label>
                                    <input name="keywords" type="text" id="wordInput" class="form-control" placeholder="کلمه را وارد کنید و Enter را بزنید"
                                           value="<?php echo htmlspecialchars(implode(', ', $keywordsArray)); ?>" />
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
                        <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                            <label class="text-danger">اطلاعات زیر برای محاسبه هزینه ارسال می باشد لطفا همه را به درستی وارد نمایید:</label>
                            <div class="form-group row">

                                <div class="col-lg-3">
                                    <label>طول محصول با کارتن :</label>
                                    <input value="<?= $getOneProduct['length'] ?>" type="text" name="length" class="form-control"
                                           required />
                                </div>
                                <div class="col-lg-3">
                                    <label>عرض محصول با کارتن :</label>
                                    <input value="<?= $getOneProduct['width'] ?>" type="text" name="width" class="form-control"
                                           required />
                                </div>
                                <div class="col-lg-3">
                                    <label>ارتفاع محصول با کارتن :</label>
                                    <input value="<?= $getOneProduct['height'] ?>" type="text" name="height" class="form-control"
                                           required />
                                </div>
                                <div class="col-lg-3">
                                    <label>وزن واقعی محصول با کارتن(گرم) :</label>
                                    <input value="<?= $getOneProduct['actualWeight'] ?>" type="text" name="actualWeight" class="form-control"
                                           required />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label> وضعیت محصول:</label>
                                    <select class="form-control" name="status">
                                        <?php
                                        if ($getOneProduct['status'] ==1){
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
                                <div class="col-lg-2">
                                    <label>محصول ویژه؟</label>
                                    <select class="form-control" name="special">
                                        <?php
                                        if ($getOneProduct['special'] == 1){
                                        ?>
                                        <option value="1">بله</option>
                                        <option value="2">خیر</option>
                                            <?php
                                        }else{
                                        ?>
                                            <option value="2">خیر</option>
                                            <option value="1">بله</option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-2" style="margin-top: 26px;margin-right:auto;">
                                    <button type="button" class="btn btn-primary mr-2" onclick="updateProduct(<?= GET('id') ?>)">ویرایش</button>
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
<?php
    $oldImagesRaw = json_decode($getOneProduct['images'], true) ?? [];
    $oldImagesForJs = [];
    foreach ($oldImagesRaw as $img) {
        $path = str_replace('\\', '/', (string)$img);
        $oldImagesForJs[] = ['path' => $path, 'url' => getProductImageUrl($img)];
    }
    $mainImageForJs = str_replace('\\', '/', (string)($getOneProduct['main_image'] ?? ''));
    $productImagesData = ['oldImages' => $oldImagesForJs, 'mainImage' => $mainImageForJs];
?>
<script type="application/json" id="productImagesData"><?= json_encode($productImagesData, JSON_UNESCAPED_UNICODE) ?></script>
<script>
    var _imgData = JSON.parse(document.getElementById('productImagesData').textContent);
    const imageInput = document.getElementById('imageInput');
    const previewContainer = document.getElementById('imagePreview');
    const mainImageIndexInput = document.getElementById('mainImageIndex');
    var imageFiles = [];   // تصاویر جدید (برای main.js)
    let oldImages = _imgData.oldImages || [];
    let mainImage = _imgData.mainImage || '';
    var deletedImages = []; // تصاویر حذف شده (برای main.js)

    // تغییر فایل
    imageInput.addEventListener('change', function () {
        const newFiles = Array.from(this.files);
        if (oldImages.length + imageFiles.length + newFiles.length > 5) {
            alert("حداکثر ۵ تصویر قابل انتخاب است.");
            return;
        }
        imageFiles = imageFiles.concat(newFiles);
        renderImages();
        updateInputFiles();
        this.value = ''; // پاک کردن ورودی
    });

    // نمایش تصاویر
    function renderImages() {
        previewContainer.innerHTML = '';

        // تصاویر قدیمی
        oldImages.forEach((imgObj, index) => {
            createImageContainer(imgObj, index, true);
        });

        // تصاویر جدید
        imageFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                createImageContainer(e.target.result, oldImages.length + index, false, file);
            };
            reader.readAsDataURL(file);
        });
    }

    function pathMatches(a, b) {
        if (!a || !b) return false;
        if (a === b) return true;
        var getBase = function(p) {
            var s = String(p);
            var i = Math.max(s.lastIndexOf('/'), s.lastIndexOf(String.fromCharCode(92)));
            return i >= 0 ? s.slice(i + 1) : s;
        };
        return getBase(a) === getBase(b);
    }

    function createImageContainer(srcOrObj, totalIndex, isOldImage, newImageFile) {
        const container = document.createElement('div');
        container.className = 'col-md-3 mb-2 position-relative';

        const path = isOldImage ? srcOrObj.path : null;
        const displaySrc = isOldImage ? ('/' + srcOrObj.url) : srcOrObj;

        const img = document.createElement('img');
        img.src = displaySrc;
        img.className = "img-thumbnail";
        img.style = "height:140px;object-fit:cover;";

        const radio = document.createElement('input');
        radio.type = 'radio';
        radio.name = 'mainImage';
        radio.className = 'position-absolute';
        radio.style = "top:5px;right:5px;";
        radio.checked = isOldImage ? pathMatches(mainImage, path) : (parseInt(mainImageIndexInput.value, 10) === totalIndex);
        radio.onclick = function () {
            mainImageIndexInput.value = totalIndex;
            mainImage = isOldImage ? path : totalIndex;
            renderImages();
        };

        if ((isOldImage && pathMatches(mainImage, path)) || (!isOldImage && parseInt(mainImageIndexInput.value, 10) === totalIndex)) {
            const badge = document.createElement('span');
            badge.className = "badge badge-primary position-absolute";
            badge.style = "top:5px;left:5px;";
            badge.textContent = "تصویر اصلی";
            container.appendChild(badge);
        }

        const removeBtn = document.createElement('button');
        removeBtn.type = "button";
        removeBtn.className = "btn btn-danger btn-sm position-absolute";
        removeBtn.style = "bottom:5px;right:5px;";
        removeBtn.innerHTML = "حذف";
        removeBtn.onclick = function () {
            if (isOldImage) {
                deletedImages.push(path);
                oldImages = oldImages.filter(img => img.path !== path);
            } else {
                const idx = imageFiles.indexOf(newImageFile);
                if (idx > -1) imageFiles.splice(idx, 1);
            }

            const wasMain = isOldImage ? pathMatches(mainImage, path) : (parseInt(mainImageIndexInput.value, 10) === totalIndex);
            if (wasMain) {
                mainImage = oldImages.length > 0 ? oldImages[0].path : (imageFiles.length > 0 ? oldImages.length : "");
                mainImageIndexInput.value = oldImages.length > 0 ? 0 : (imageFiles.length > 0 ? oldImages.length : "");
            }
            renderImages();
            updateInputFiles();
        };

        container.appendChild(img);
        container.appendChild(radio);
        container.appendChild(removeBtn);
        previewContainer.appendChild(container);
    }

    function updateInputFiles() {
        const dt = new DataTransfer();
        imageFiles.forEach(file => dt.items.add(file));
        imageInput.files = dt.files;
    }

    renderImages();
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
                <div class="col-lg-2 col-12" id="price">
                <label>عنوان رنگ:</label>
                <input type="text" class="form-control" name="feature_title_color[]" placeholder="عنوان رنگ را وارد کنید">
            </div>
                  <div class="col-lg-2 col-12">
                      <label>قیمت :</label>
                      <input type="text" class="form-control" name="feature_names[]" placeholder="قیمت را وارد کنید">
                  </div>
                  <div class="col-lg-2 col-12">
                      <label>قیمت با تخفیف:</label>
                      <input name="feature_prices[]" type="text" class="form-control" placeholder="قیمت با تخفیف وارد کنید">
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
            <div class="col-lg-2 col-12" id="titleColor">
                <label>عنوان رنگ:</label>
                <input type="text" class="form-control" name="feature_title_color[]" placeholder="عنوان رنگ را وارد کنید">
            </div>
            <div class="col-lg-2 col-12" id="price">
                <label>قیمت:</label>
                <input type="text" class="form-control" name="feature_price[]" placeholder="قیمت به تومان">
            </div>
            <div class="col-lg-2 col-12" id="priceOff">
                <label>قیمت با تخفیف:</label>
                <input name="feature_max_purchase[]" type="text" class="form-control" placeholder="قیمت با تخفیف به تومان">
            </div>
            <div class="col-lg-2 col-12" id="priceOff">
                    <label>حداکثر افزودن به سبد خرید:</label>
                    <input name="feature_prices_discount[]" type="text" class="form-control" placeholder="حداکثر افزودن به سبد خرید">
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
                <input type="text" name="feature_names[]" class="form-control" placeholder="مثلا جنس بدنه" required>
            </div>
            <div class="col-lg-6 col-12">
                <label>مقدار:</label>
                <input type="text" name="feature_values[]" class="form-control" placeholder="مثلا شیشه" required>
            </div>
            <div class="col-lg-1 col-12 d-flex align-items-end">
                <button type="button" class="btn btn-danger remove-feature w-100" data-id="<?= $price['id']; ?>">
                    حذف
                </button>
            </div>
        </div>
        `;

            $("#featuresContainer").append(row);
        });

        $(document).on("click", ".remove-feature", function () {
            $(this).closest('.feature-row').remove();
        });

        $("#productForm").submit(function(event) {
            let isValid = true;

            $("input[name='feature_names[]']").each(function() {
                if ($(this).val() === '') {
                    isValid = false;
                    return false; // متوقف کردن حلقه
                }
            });

            $("input[name='feature_values[]']").each(function() {
                if ($(this).val() === '') {
                    isValid = false;
                    return false; // متوقف کردن حلقه
                }
            });

            if (!isValid) {
                alert('لطفا همه مشخصات را پر کنید.');
                event.preventDefault(); // جلوگیری از ارسال فرم
            }
        });
    });
</script>
<script>
    const checkbox = document.getElementById('multiPrice');
    const box1 = document.getElementById('box1');
    const box2 = document.getElementById('box2');
    const maxProduct = document.getElementById('maxProduct');

    checkbox.addEventListener('change', () => {
        if (checkbox.checked) {
            box1.style.display = 'none'; // نمایش دیو اول
            box2.style.display = 'flex';  // مخفی کردن دیو دوم
            maxProduct.style.display = 'none'; // نمایش دیو اول
        } else {
            box1.style.display = 'flex';
            box2.style.display = 'none';
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
$pageTitle = "ویرایش  محصول";
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