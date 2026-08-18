<?php
// page logic
$page     = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage  = 10;
$offset   = ($page - 1) * $perPage;

$keyword  = $_GET['q']   ?? '';
$category = $_GET['cat'] ?? 0;

// count all results
$totalProducts = countBlog($keyword, $category);
$totalPages    = ceil($totalProducts / $perPage);

// get paginated results
$products = searchBlog($keyword, $category, $perPage, $offset);

// دسته‌های موجود در نتایج جستجو (برای باز کردن سایدبار وقتی فقط q داریم و cat نداریم)
$categoryIdsFromResults = [];
if (!empty($products) && !$category) {
    $categoryIdsFromResults = array_values(array_unique(array_filter(array_map('intval', array_column($products, 'category_id')))));
}
$category = (int) $category;
?>
<main class="my-4 xl:my-10 mx-2 lg:mx-10">
    <!-- result search -->
    <p class="text-lg lg:text-2xl text-zinc-700 font-yekanBakhBold">
        <?php
        if (!empty($keyword)) {
            echo 'نتیجه جستجو برای "' . htmlspecialchars($keyword) . '"';
        } elseif ($category > 0) {
            $catInfo = getCategoryById($category);
            echo $catInfo ? ('محصولات دسته‌ی «' . htmlspecialchars($catInfo['title']) . '»') : 'محصولات';
        } else {
            echo 'همه‌ی محصولات';
        }
        ?>
    </p>
    <!-- search and count -->
    <div class="flex justify-between mt-10">
        <div class="relative">
            <form action="/blogSearch" method="get">
                  <input name="q" class="rounded-2xl text-zinc-600 bg-white border border-zinc-200 pr-14 pl-[5.25rem] py-4 w-11/12 xl:w-2xl placeholder:text-zinc-400 focus:outline-0 placeholder:text-xs text-sm relative" type="text" placeholder="جستجو در مقالات..." autocomplete="off">
                  <a href="#" class="top-1.5 absolute right-2 bg-primary-500 p-2.5 rounded-xl">
                      <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path opacity="0.8" d="M11.5 21C16.7467 21 21 16.7467 21 11.5C21 6.25329 16.7467 2 11.5 2C6.25329 2 2 6.25329 2 11.5C2 16.7467 6.25329 21 11.5 21Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path opacity="0.8" d="M22 22L20 20" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                      </svg>
                  </a>
            </form>
        </div>
        <div class="xl:text-lg flex flex-col xl:flex-row items-center">
            <span class="font-PeydaBlack text-zinc-800 text-xl xl:text-2xl">
                <?php echo $totalProducts ?? '0'; ?>
            </span>
            مقاله
        </div>
    </div>
    <!-- new blogs -->
    <div class="mt-10 grid md:grid-cols-2 xl:grid-cols-4 gap-5">
        <?php
        if($products){
            foreach ($products as $product){
                $date1 = jdate("r", (dateToTimestamp($product['createAt'])));
                $createAt2 = $date1 ;
                ?>
                <a href="/blogSingle?trak=<?= $product['id'] ?>&slug=<?= $product['slug'] ?>" class="swiper-slide product-card h-auto bg-white relative p-2 rounded-3xl transform transition-all duration-300 hover:-translate-y-1 overflow-hidden shadow-custom2">
                    <div class="text-white bg-primary-500 absolute top-5 right-5 rounded-full px-2 py-1 text-xs font-yekanBakhRegular shadow-custom2">
                        <?= $createAt2; ?>
                    </div>
                    <div class="p-2">
                        <img class="rounded-2xl" src="../../public/images/blog/<?= $product['image_name']; ?>" alt="">
                    </div>
                    <div class="text-sm xl:text-s mt-2 text-zinc-700 font-yekanBakhBold flex gap-x-2 items-center text-justify">
                        <div class="h-10 w-1 bg-primary-500 rounded-lg"></div>
                        <span class="leading-6">
                  <?php
                  echo $product['title']
                  ?>
                </span>
                    </div>
                    <div class="text-smm xl:text-sm text-zinc-400 text-justify mt-2 font-yekanBakhRegular leading-6">
                        <?= mb_strlen($product['description']) > 150 ? mb_substr($product['description'], 0, 150) . '...' : $product['description'] ?>
                    </div>
                    <div class="h-[1px] w-full bg-gradient-to-r from-white via-zinc-200 to-white my-3">
                    </div>
                    <div class="flex justify-between items-center px-1.5 pb-2 md:pb-1.5">
                        <div class="flex items-center text-zinc-400 text-smm xl:text-sm font-yekanBakhRegular gap-x-1">
                            <svg class="fill-zinc-400 size-5 xl:size-5.5" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#000000" viewBox="0 0 256 256"><path d="M232,136.66A104.12,104.12,0,1,1,119.34,24,8,8,0,0,1,120.66,40,88.12,88.12,0,1,0,216,135.34,8,8,0,0,1,232,136.66ZM120,72v56a8,8,0,0,0,8,8h56a8,8,0,0,0,0-16H136V72a8,8,0,0,0-16,0Zm40-24a12,12,0,1,0-12-12A12,12,0,0,0,160,48Zm36,24a12,12,0,1,0-12-12A12,12,0,0,0,196,72Zm24,36a12,12,0,1,0-12-12A12,12,0,0,0,220,108Z"></path></svg>
                            <?php
                            if ($product['reading_time']){
                                echo $product['reading_time'] . 'دقیقه ';
                            }
                            ?>
                        </div>
                        <button class="bg-primary-600 hover:bg-white group rounded-2xl p-2.5 xl:p-3 transition-all duration-300 hover:shadow-custom2 cursor-pointer flex gap-x-1">
                  <span class="text-white text-smm xl:text-sm font-yekanBakhBold group-hover:text-primary-600 transition-all duration-300">
                    مشاهده مقاله
                  </span>
                            <svg class="group-hover:fill-primary-600" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffffff" viewBox="0 0 256 256"><path d="M197.66,197.66a8,8,0,0,1-11.32,0L72,83.31V168a8,8,0,0,1-16,0V64a8,8,0,0,1,8-8H168a8,8,0,0,1,0,16H83.31L197.66,186.34A8,8,0,0,1,197.66,197.66Z"></path></svg>
                        </button>
                    </div>
                </a>

                <?php
            }

        }
        ?>
    </div>
    <!-- pagination -->
    <?php if ($totalPages > 1): ?>
        <div class="flex justify-center mt-10 lg:mt-20">
            <?php
            // ساخت پایه URL برای حفظ پارامترهای جستجو و دسته‌بندی
            $baseUrl = '?q=' . urlencode($keyword);
            if (isset($category) && $category) {
                $baseUrl .= '&cat=' . urlencode($category);
            }
            // --- دکمه قبلی (Prev) ---
            if ($page > 1): ?>
                <a href="<?php echo $baseUrl; ?>&page=<?php echo ($page - 1); ?>"
                   class="flex items-center justify-center px-3.5 md:px-4 py-2 mx-1 text-gray-700 transition-colors duration-300 transform bg-white rounded-md -scale-x-100 hover:bg-primary-500 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4 md:size-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </a>
            <?php endif; ?>
            <?php
            // --- منطق رندر کردن شماره صفحات و سه نقطه ---
            $range = 1; // تعداد صفحات قبل و بعد از صفحه فعلی که نمایش داده شود
            $dotsShown = false;
            for ($i = 1; $i <= $totalPages; $i++):
                // شرط نمایش: صفحه اول، صفحه آخر، یا صفحات اطراف صفحه فعلی
                if ($i == 1 || $i == $totalPages || ($i >= $page - $range && $i <= $page + $range)):
                    // تعیین کلاس فعال یا معمولی
                    $isActive = ($i == $page)
                        ? 'bg-primary-500 text-white'
                        : 'text-gray-700 bg-white hover:bg-primary-500 hover:text-white';
                    ?>
                    <a href="<?php echo $baseUrl; ?>&page=<?php echo $i; ?>"
                       class="border border-zinc-100 text-sm md:text-base px-3.5 md:px-4 py-2 mx-1 transition-colors duration-300 transform <?php echo $isActive; ?> rounded-md">
                        <?php echo $i; ?>
                    </a>
                    <?php
                    $dotsShown = false; // ریست کردن وضعیت سه نقطه در صورت نمایش شماره
                else:
                    // نمایش سه نقطه اگر قبلاً نمایش داده نشده باشد
                    if (!$dotsShown): ?>
                        <a href="#" class="border border-zinc-100 text-sm md:text-base px-3.5 md:px-4 py-2 mx-1 text-gray-400 cursor-default">
                            ...
                        </a>
                        <?php
                        $dotsShown = true;
                    endif;
                endif;
            endfor;
            ?>
            <?php // --- دکمه بعدی (Next) --- --- ?>
            <?php if ($page < $totalPages): ?>
                <a href="<?php echo $baseUrl; ?>&page=<?php echo ($page + 1); ?>"
                   class="flex items-center justify-center px-3.5 md:px-4 py-2 mx-1 text-gray-700 transition-colors duration-300 transform bg-white rounded-md -scale-x-100 hover:bg-primary-500 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4 md:size-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </a>
            <?php endif; ?>

        </div>
    <?php endif; ?>

</main>