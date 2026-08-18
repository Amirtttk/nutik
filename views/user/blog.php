<?php
$getInformation = getInformation();
?>
<main class="my-4 xl:my-10 mx-2 lg:mx-10">
    <!-- hero image -->
    <a href="<?php echo $getInformation['link_blog'] ?? '' ?>">
        <img class="rounded-2xl" src="../../public/images/blog/<?= $getInformation['imges_blogs']; ?>" alt="">
    </a>
    <!-- search and count -->
    <div class="flex justify-between mt-10">
        <div class="relative">
            <form action="/blogSearch" method="get">
          <input name="q" class="rounded-2xl text-zinc-600 bg-white border border-zinc-200 pr-14 pl-[5.25rem] py-4 w-11/12 xl:w-2xl placeholder:text-zinc-400 focus:outline-0 placeholder:text-xs text-sm relative" type="text" placeholder="جستجو در مقالات..." autocomplete="off">
          <button class="top-1.5 absolute right-2 bg-primary-500 p-2.5 rounded-xl">
              <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path opacity="0.8" d="M11.5 21C16.7467 21 21 16.7467 21 11.5C21 6.25329 16.7467 2 11.5 2C6.25329 2 2 6.25329 2 11.5C2 16.7467 6.25329 21 11.5 21Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                <path opacity="0.8" d="M22 22L20 20" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
          </button>
            </form>
        </div>
        <div class="xl:text-lg flex flex-col xl:flex-row gap-x-1 items-center">
            <span class="font-PeydaBlack text-zinc-800 text-xl xl:text-2xl">
                <?php
                $getAllBlogByCount = getAllBlogByCount();
                if($getAllBlogByCount){
              echo count($getAllBlogByCount);
                }
                ?>
            </span>
            مقاله
        </div>
    </div>
    <!-- new blogs -->
    <div class="rounded-4xl mt-10">
      <!-- top -->
        <?php
        $getAllBlogTop = getAllBlogTop();
        if ($getAllBlogTop){
        ?>
      <div class="flex justify-between items-center px-4">
        <p class="text-lg lg:text-xl text-zinc-700 font-yekanBakhExtraBlack">
          جدیدترین
          <span class="text-primary-500">
            مقالات
          </span>
          نوتیک
        </p>
        <a href="/blogSearch?cat=" class="bg-primary-500 hover:opacity-80 flex items-center gap-x-1 shadow-custom2 w-fit rounded-xl py-1.5 lg:py-2 pl-2.5 pr-3.5 lg:pl-2 lg:pr-3 text-x lg:text-sm text-white font-yekanBakhRegular">
          مشاهده همه مقالات
          <svg class="rotate-90 size-4 lg:size-4.5" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none">
            <path class="" d="M7.53269 9.47204C7.24111 9.17784 6.76624 9.17573 6.47204 9.46731C6.17784 9.75889 6.17573 10.2338 6.46731 10.528L8.2461 12.3227C8.91604 12.9987 9.46359 13.5511 9.95146 13.9429C10.4588 14.3504 10.9737 14.6453 11.5918 14.7241C11.8629 14.7586 12.1371 14.7586 12.4082 14.7241C13.0263 14.6453 13.5412 14.3504 14.0485 13.9429C14.5364 13.5511 15.084 12.9987 15.7539 12.3227L17.5327 10.528C17.8243 10.2338 17.8222 9.75889 17.528 9.46731C17.2338 9.17573 16.7589 9.17784 16.4673 9.47204L14.72 11.235C14.0109 11.9505 13.5228 12.4413 13.1093 12.7734C12.7076 13.096 12.4496 13.2067 12.2185 13.2361C12.0734 13.2546 11.9266 13.2546 11.7815 13.2361C11.5504 13.2067 11.2924 13.096 10.8907 12.7734C10.4772 12.4413 9.98914 11.9505 9.28 11.235L7.53269 9.47204Z" fill="#ffffff"></path>
          </svg>
        </a>
      </div>
        <?php
        }
        ?>
      <!-- main -->
      <div class="pb-4">
        <div class="swiper blogs">
          <div class="swiper-wrapper px-2 py-14">
              <?php
              foreach ($getAllBlogTop as $AllBlogTop){
                  $date1 = jdate("r", (dateToTimestamp($AllBlogTop['createAt'])));
                  $createAt2 = $date1 ;
                  ?>
                  <a href="/blogSingle?trak=<?= $AllBlogTop['id'] ?>&slug=<?= $AllBlogTop['slug'] ?>" class="swiper-slide product-card h-auto bg-white relative p-2 rounded-3xl transform transition-all duration-300 hover:-translate-y-1 overflow-hidden shadow-custom2">
                      <div class="text-white bg-primary-500 absolute top-5 right-5 rounded-full px-2 py-1 text-xs font-yekanBakhRegular shadow-custom2">
                          <?= $createAt2; ?>
                      </div>
                      <div class="p-2">
                          <img class="rounded-2xl" src="../../public/images/blog/<?= $AllBlogTop['image_name']; ?>" alt="">
                      </div>
                      <div class="text-sm xl:text-s mt-2 text-zinc-700 font-yekanBakhBold flex gap-x-2 items-center text-justify">
                          <div class="h-10 w-1 bg-primary-500 rounded-lg"></div>
                          <span class="leading-6">
                        <?= $AllBlogTop['title'] ?>
                          </span>
                      </div>
                      <div class="text-smm xl:text-sm text-zinc-400 text-justify mt-2 font-yekanBakhRegular leading-6">
                          <?= mb_strlen($AllBlogTop['description']) > 150 ? mb_substr($AllBlogTop['description'], 0, 150) . '...' : $AllBlogTop['description'] ?>
                      </div>
                      <div class="h-[1px] w-full bg-gradient-to-r from-white via-zinc-200 to-white my-3">
                      </div>
                      <div class="flex justify-between items-center px-1.5 pb-2 md:pb-1.5">
                          <div class="flex items-center text-zinc-400 text-smm xl:text-sm font-yekanBakhRegular gap-x-1">
                              <svg class="fill-zinc-400 size-5 xl:size-5.5" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#000000" viewBox="0 0 256 256"><path d="M232,136.66A104.12,104.12,0,1,1,119.34,24,8,8,0,0,1,120.66,40,88.12,88.12,0,1,0,216,135.34,8,8,0,0,1,232,136.66ZM120,72v56a8,8,0,0,0,8,8h56a8,8,0,0,0,0-16H136V72a8,8,0,0,0-16,0Zm40-24a12,12,0,1,0-12-12A12,12,0,0,0,160,48Zm36,24a12,12,0,1,0-12-12A12,12,0,0,0,196,72Zm24,36a12,12,0,1,0-12-12A12,12,0,0,0,220,108Z"></path></svg>
                              <?php
                              if ($AllBlogTop['reading_time']){
                                  echo $AllBlogTop['reading_time'] . 'دقیقه ';
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
              ?>
          </div>
        </div>
      </div>
    </div>
    <!-- blog category -->
    <?php
    $getAllBlogCategories = getAllBlogCategories();
    if ($getAllBlogCategories){
        ?>
        <div class="xl:mt-6">
            <div class="containerPSlider swiper pb-4">
                <div class="categorySlider">
                    <div class="card-wrapper swiper-wrapper py-10">
                        <?php
                        foreach ($getAllBlogCategories as $AllBlogCategories){
                            ?>
                            <a href="/blogSearch?cat=<?= $AllBlogCategories['id'] ?>" class="card swiper-slide h-auto text-center">
                                <div class="flex items-center card bg-white rounded-3xl p-3
                                        transition-all duration-300
                                        hover:-translate-y-1 hover:shadow-custom
                                        border border-zinc-100">
                                    <span class="w-1/3">
                                      <img class="" src="../../public/images/blog_categories/<?= $AllBlogCategories['image_name']; ?>" alt="">
                                    </span>
                                    <div class="flex flex-col items-start gap-y-3 mr-2">
                                        <div class="text-s font-yekanBakhBlack text-zinc-800">
                                            <?= $AllBlogCategories['title'] ?>
                                        </div>
                                        <div class="text-xs font-yekanBakhRegular text-zinc-600">
                                            مشاهده مقالات
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

    <!-- best blogs -->
    <div class="mt-16 xl:mt-20 rounded-4xl">
      <!-- top -->
      <div class="flex justify-between items-center px-4">
        <p class="text-lg lg:text-xl text-zinc-700 font-yekanBakhExtraBlack">
          محبوب‌ترین
          <span class="text-primary-500">
            مقالات
          </span>
          نوتیک
        </p>
        <a href="/blogSearch?cat=" class="bg-primary-500 hover:opacity-80 flex items-center gap-x-1 shadow-custom2 w-fit rounded-xl py-1.5 lg:py-2 pl-2.5 pr-3.5 lg:pl-2 lg:pr-3 text-x lg:text-sm text-white font-yekanBakhRegular">
          مشاهده همه مقالات
          <svg class="rotate-90 size-4 lg:size-4.5" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none">
            <path class="" d="M7.53269 9.47204C7.24111 9.17784 6.76624 9.17573 6.47204 9.46731C6.17784 9.75889 6.17573 10.2338 6.46731 10.528L8.2461 12.3227C8.91604 12.9987 9.46359 13.5511 9.95146 13.9429C10.4588 14.3504 10.9737 14.6453 11.5918 14.7241C11.8629 14.7586 12.1371 14.7586 12.4082 14.7241C13.0263 14.6453 13.5412 14.3504 14.0485 13.9429C14.5364 13.5511 15.084 12.9987 15.7539 12.3227L17.5327 10.528C17.8243 10.2338 17.8222 9.75889 17.528 9.46731C17.2338 9.17573 16.7589 9.17784 16.4673 9.47204L14.72 11.235C14.0109 11.9505 13.5228 12.4413 13.1093 12.7734C12.7076 13.096 12.4496 13.2067 12.2185 13.2361C12.0734 13.2546 11.9266 13.2546 11.7815 13.2361C11.5504 13.2067 11.2924 13.096 10.8907 12.7734C10.4772 12.4413 9.98914 11.9505 9.28 11.235L7.53269 9.47204Z" fill="#ffffff"></path>
          </svg>
        </a>
      </div>
      <!-- main -->
      <div class="pb-4">
        <div class="swiper blogs">
          <div class="swiper-wrapper px-2 py-14">
            <a href="#" class="swiper-slide product-card h-auto bg-white relative p-2 rounded-3xl transform transition-all duration-300 hover:-translate-y-1 overflow-hidden shadow-custom2">
              <div class="p-2">
                <img class="rounded-2xl" src="./../../assets/user/image/blog/1.jpg" alt="">
              </div>
              <div class="text-sm xl:text-s mt-2 text-zinc-700 font-yekanBakhBold flex gap-x-2 items-center text-justify">
                <div class="h-10 w-1 bg-primary-500 rounded-lg"></div>
                <span class="leading-6">
                  آموزش استفاده از مکمل های ورزشی
                </span>
              </div>
              <div class="text-smm xl:text-sm text-zinc-400 text-justify mt-2 font-yekanBakhRegular leading-6">
                باشگاه فوتبال نوتیک فقط جایی برای تمرین فوتبال نیست؛ جایی است که استعدادها کشف می‌شوند، شخصیت‌ها ساخته می‌شوند
              </div>
              <div class="h-[1px] w-full bg-gradient-to-r from-white via-zinc-200 to-white my-3">
              </div>
              <div class="flex justify-between items-center px-1.5 pb-2 md:pb-1.5">
                <div class="flex items-center text-zinc-400 text-smm xl:text-sm font-yekanBakhRegular gap-x-1">
                  <svg class="fill-zinc-400 size-5 xl:size-5.5" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#000000" viewBox="0 0 256 256"><path d="M232,136.66A104.12,104.12,0,1,1,119.34,24,8,8,0,0,1,120.66,40,88.12,88.12,0,1,0,216,135.34,8,8,0,0,1,232,136.66ZM120,72v56a8,8,0,0,0,8,8h56a8,8,0,0,0,0-16H136V72a8,8,0,0,0-16,0Zm40-24a12,12,0,1,0-12-12A12,12,0,0,0,160,48Zm36,24a12,12,0,1,0-12-12A12,12,0,0,0,196,72Zm24,36a12,12,0,1,0-12-12A12,12,0,0,0,220,108Z"></path></svg>
                  4 دقیقه
                </div>
                <button class="bg-primary-600 hover:bg-white group rounded-2xl p-2.5 xl:p-3 transition-all duration-300 hover:shadow-custom2 cursor-pointer flex gap-x-1">
                  <span class="text-white text-smm xl:text-sm font-yekanBakhBold group-hover:text-primary-600 transition-all duration-300">
                    مشاهده مقاله
                  </span>
                  <svg class="group-hover:fill-primary-600" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffffff" viewBox="0 0 256 256"><path d="M197.66,197.66a8,8,0,0,1-11.32,0L72,83.31V168a8,8,0,0,1-16,0V64a8,8,0,0,1,8-8H168a8,8,0,0,1,0,16H83.31L197.66,186.34A8,8,0,0,1,197.66,197.66Z"></path></svg>
                </button>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </main>

