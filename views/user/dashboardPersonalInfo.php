<?php
$getOneInfoUser = getOneInfoUser($_SESSION['user_sending'], TYPES_USERS[4][0]);
$getInfoUser = getInfoUser($_SESSION['user_sending']);
?>
<main class="mt-4 lg:mt-10 pb-10 lg:mx-6">
    <div class="flex flex-col lg:flex-row gap-5">
      <?php
      include "views/layouts/userProfile.php";
      ?>
      <div class="lg:w-9/12 bg-white shadow-custom lg:rounded-2xl p-4 h-fit order-1 lg:order-2">
        <p class="text-lg lg:text-xl text-zinc-700 font-yekanBakhExtraBlack">
            مشخصات
            <span class="text-primary-500">
                فردی
            </span>
        </p>
        <div class="mx-2 lg:mx-auto">
          <div class="sm:flex gap-x-5 mt-8">
              <div class="sm:w-1/2 mb-2 sm:mb-0 flex flex-col gap-y-1">
                  <label class="text-zinc-700 flex text-sm font-yekanBakhBold mb-1">
                     نام و نام خانوادگی
                    <svg class="fill-red-500" xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="#4d4d4d" viewBox="0 0 256 256"><path d="M210.23,101.57l-72.6,29,51.11,65.71a6,6,0,0,1-9.48,7.36L128,137.77,76.74,203.68a6,6,0,1,1-9.48-7.36l51.11-65.71-72.6-29a6,6,0,1,1,4.46-11.14L122,119.14V40a6,6,0,0,1,12,0v79.14l71.77-28.71a6,6,0,1,1,4.46,11.14Z"></path></svg>
                  </label>
                  <input name="userFullName" value="<?= $getInfoUser['userFullName'] ?>" class="placeholder:text-right text-right text-sm block w-full rounded-2xl px-4 py-3 md:py-5 focus:ring-0 focus:ring-transparent placeholder:text-zinc-400 placeholder:text-smm placeholder:font-yekanBakhBold border border-zinc-200 bg-white text-gray-700 transition-all outline-2 outline-transparent focus:outline-primary-500" type="text" placeholder="علی">
              </div>
              <div class="sm:w-1/2 mb-2 sm:mb-0 flex flex-col gap-y-1">
                  <label class="text-zinc-700 flex text-sm font-yekanBakhBold mb-1">
                  شماره موبایل :
                    <svg class="fill-red-500" xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="#4d4d4d" viewBox="0 0 256 256"><path d="M210.23,101.57l-72.6,29,51.11,65.71a6,6,0,0,1-9.48,7.36L128,137.77,76.74,203.68a6,6,0,1,1-9.48-7.36l51.11-65.71-72.6-29a6,6,0,1,1,4.46-11.14L122,119.14V40a6,6,0,0,1,12,0v79.14l71.77-28.71a6,6,0,1,1,4.46,11.14Z"></path></svg>
                  </label>
                  <input disabled value="09<?= $getInfoUser['userMobile'] ?>" class="placeholder:text-right text-right text-sm block w-full rounded-2xl px-4 py-3 md:py-5 focus:ring-0 focus:ring-transparent placeholder:text-zinc-400 placeholder:text-smm placeholder:font-yekanBakhBold border border-zinc-200 bg-white text-gray-700 transition-all outline-2 outline-transparent focus:outline-primary-500" type="text" placeholder="اسدی">
              </div>
          </div>
          <div class="sm:flex gap-x-5 mt-8">
             <div class="sm:w-1/2 mb-2 sm:mb-0 flex flex-col gap-y-1">
                <label class="text-zinc-700 flex text-sm font-yekanBakhBold mb-1">
                    جنسیت
                    <svg class="fill-red-500" xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="#4d4d4d" viewBox="0 0 256 256"><path d="M210.23,101.57l-72.6,29,51.11,65.71a6,6,0,0,1-9.48,7.36L128,137.77,76.74,203.68a6,6,0,1,1-9.48-7.36l51.11-65.71-72.6-29a6,6,0,1,1,4.46-11.14L122,119.14V40a6,6,0,0,1,12,0v79.14l71.77-28.71a6,6,0,1,1,4.46,11.14Z"></path></svg>
                </label>
                <select name="gender"  class="appearance-none placeholder:text-right text-right text-sm block w-full rounded-2xl px-4 py-3 md:py-5 focus:ring-0 focus:ring-transparent placeholder:text-zinc-400 placeholder:text-smm placeholder:font-yekanBakhBold border border-zinc-200 bg-white text-gray-700 transition-all outline-2 outline-transparent focus:outline-primary-500">
                    <?php
                    if ($getInfoUser['gender'] == 1) {
                        ?>
                        <option value="1">مرد</option>
                        <option value="2">زن</option>
                        <?php
                    } else {
                        ?>
                        <option value="2">زن</option>
                        <option value="1">مرد</option>
                        <?php
                    }
                    ?>
                </select>
            </div>
          </div>
        </div>
        <a onclick="updateInfoUser()" id="btnUpdateInfo" class="block bg-primary-500 hover:bg-primary-400 text-white text-center w-8/12 mx-auto mt-10 px-5 py-3 rounded-xl shadow-lg transition-all font-yekanBakhBold">
         ویرایش اطلاعات
        </a>
      </div>
    </div>
  </main>
