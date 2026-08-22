<main class="mt-4 lg:mt-10 pb-10 lg:mx-6">
    <div class="flex flex-col lg:flex-row gap-5">
        <?php
        include "views/layouts/userProfile.php";
        ?>
      <div class="lg:w-9/12 bg-white shadow-custom lg:rounded-2xl p-4 h-fit order-1 lg:order-2">
        <p class="text-lg lg:text-xl text-zinc-700 font-yekanBakhExtraBlack">
            آدرس های
            <span class="text-primary-500">
                من
            </span>
        </p>
        <div class="px-2">
          <a href="#" data-modal="modalSelectAddress" class="open-modal mr-auto text-primary-500 text-xs lg:text-smm flex items-center w-fit">
            افزودن آدرس
             <svg class="fill-primary-600 rotate-90 size-3.5 lg:size-5" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
               <path class="fill-primary-600" d="M7.53269 9.47204C7.24111 9.17784 6.76624 9.17573 6.47204 9.46731C6.17784 9.75889 6.17573 10.2338 6.46731 10.528L8.2461 12.3227C8.91604 12.9987 9.46359 13.5511 9.95146 13.9429C10.4588 14.3504 10.9737 14.6453 11.5918 14.7241C11.8629 14.7586 12.1371 14.7586 12.4082 14.7241C13.0263 14.6453 13.5412 14.3504 14.0485 13.9429C14.5364 13.5511 15.084 12.9987 15.7539 12.3227L17.5327 10.528C17.8243 10.2338 17.8222 9.75889 17.528 9.46731C17.2338 9.17573 16.7589 9.17784 16.4673 9.47204L14.72 11.235C14.0109 11.9505 13.5228 12.4413 13.1093 12.7734C12.7076 13.096 12.4496 13.2067 12.2185 13.2361C12.0734 13.2546 11.9266 13.2546 11.7815 13.2361C11.5504 13.2067 11.2924 13.096 10.8907 12.7734C10.4772 12.4413 9.98914 11.9505 9.28 11.235L7.53269 9.47204Z" fill="#52525c"></path>
             </svg>
          </a>
          <!-- add address modal -->
          <div id="modalSelectAddress" class="modal fixed inset-0 bg-black/20 bg-opacity-50 hidden flex items-center justify-center transition-opacity duration-300 z-[99]">
            <div class="modal-box bg-white p-2 rounded-xl shadow-lg w-11/12 md:w-6/12 opacity-0 scale-90 transition-transform duration-300 max-h-[90vh] overflow-y-auto">
              <div class="flex justify-between items-center p-4 border-b border-zinc-300">
                <h3 class="text-gray-700">افزودن آدرس</h3>
              </div>
                <div id="getErrors"></div>
              <form id="formAddressForEmpty" class="space-y-6 px-2 lg:px-8 pb-4 sm:pb-6 pt-4 text-xs md:text-base">
                  <div class="sm:flex gap-x-5 mt-4 md:mt-8">
                      <div class="sm:w-1/2 mb-3 sm:mb-0">
                          <label class="text-xs text-zinc-600 mb-1 flex items-center gap-x-1" for="">
                              نام:
                              <svg class="fill-red-500" xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="#4d4d4d" viewBox="0 0 256 256"><path d="M210.23,101.57l-72.6,29,51.11,65.71a6,6,0,0,1-9.48,7.36L128,137.77,76.74,203.68a6,6,0,1,1-9.48-7.36l51.11-65.71-72.6-29a6,6,0,1,1,4.46-11.14L122,119.14V40a6,6,0,0,1,12,0v79.14l71.77-28.71a6,6,0,1,1,4.46,11.14Z"></path></svg>
                          </label>
                          <input name="name" class="rounded-xl text-sm text-zinc-600 border border-zinc-200 w-full bg-white px-5 py-3.5 placeholder:text-zinc-400 placeholder:text-xs placeholder:font-yekanBakhBold focus:outline-1 focus:border-zinc-400" type="text" placeholder="مثلا علی">
                      </div>
                      <div class="sm:w-1/2">
                          <label class="text-xs text-zinc-600 mb-1 flex items-center gap-x-1" for="">
                              نام خانوادگی:
                          </label>
                          <input name="family" class="rounded-xl text-sm text-zinc-600 border border-zinc-200 w-full bg-white px-5 py-3.5 placeholder:text-zinc-400 placeholder:text-xs placeholder:font-yekanBakhBold focus:outline-1 focus:border-zinc-400" type="text" placeholder="مثلا احمدی">
                      </div>
                  </div>
                <div class="sm:flex gap-x-5 mt-4 md:mt-8">
                  <div class="sm:w-1/2 mb-4 sm:mb-0">
                    <label class="text-xs text-zinc-600 mb-1 flex items-center gap-x-1" for="">
                      استان:
                      <svg class="fill-red-500" xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="#4d4d4d" viewBox="0 0 256 256"><path d="M210.23,101.57l-72.6,29,51.11,65.71a6,6,0,0,1-9.48,7.36L128,137.77,76.74,203.68a6,6,0,1,1-9.48-7.36l51.11-65.71-72.6-29a6,6,0,1,1,4.46-11.14L122,119.14V40a6,6,0,0,1,12,0v79.14l71.77-28.71a6,6,0,1,1,4.46,11.14Z"></path></svg>
                    </label>
                      <?php
                      $provinces = getAllProvinces();
                      ?>
                      <div id="getErrors1"></div>
                      <select id="province-select" name="province_id" onclick="loadCitiesByProvince()" class="appearance-none rounded-2xl rounded-tr-sm text-sm text-zinc-600 w-full bg-[#f0f0f0] px-5 py-3.5 placeholder:text-zinc-400 placeholder:text-xs focus:outline-1 focus:outline-zinc-300">
                          <option value="">انتخاب استان</option>
                          <?php
                          if ($provinces) {
                              foreach ($provinces as $province) {
                                  echo '<option value="'. $province['id'] .'">'. $province['name'] .'</option>';
                              }
                          }
                          ?>
                      </select>
                  </div>
                  <div class="sm:w-1/2">
                    <label class="text-xs text-zinc-600 mb-1 flex items-center gap-x-1" for="">
                      شهر:
                      <svg class="fill-red-500" xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="#4d4d4d" viewBox="0 0 256 256"><path d="M210.23,101.57l-72.6,29,51.11,65.71a6,6,0,0,1-9.48,7.36L128,137.77,76.74,203.68a6,6,0,1,1-9.48-7.36l51.11-65.71-72.6-29a6,6,0,1,1,4.46-11.14L122,119.14V40a6,6,0,0,1,12,0v79.14l71.77-28.71a6,6,0,1,1,4.46,11.14Z"></path></svg>
                    </label>
                      <select id="city-select" name="city_id" class="appearance-none rounded-2xl rounded-tr-sm text-sm text-zinc-600 w-full bg-[#f0f0f0] px-5 py-3.5 placeholder:text-zinc-400 placeholder:text-xs focus:outline-1 focus:outline-zinc-300" disabled>
                          <option value="">ابتدا استان را انتخاب کنید</option>
                      </select>
                  </div>
                </div>
                <div class="mt-4 md:mt-8">
                  <label class="text-xs text-zinc-600 mb-1 flex items-center gap-x-1" for="">
                    آدرس کامل:
                    <svg class="fill-red-500" xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="#4d4d4d" viewBox="0 0 256 256"><path d="M210.23,101.57l-72.6,29,51.11,65.71a6,6,0,0,1-9.48,7.36L128,137.77,76.74,203.68a6,6,0,1,1-9.48-7.36l51.11-65.71-72.6-29a6,6,0,1,1,4.46-11.14L122,119.14V40a6,6,0,0,1,12,0v79.14l71.77-28.71a6,6,0,1,1,4.46,11.14Z"></path></svg>
                  </label>
                  <input name="address" class="rounded-xl text-sm text-zinc-600 border border-zinc-200 w-full bg-white px-5 py-3.5 placeholder:text-zinc-400 placeholder:text-xs placeholder:font-yekanBakhBold focus:outline-1 focus:border-zinc-400" type="text" placeholder="مثلا تهران، ستارخان، خیابان ستارخان 3، پلاک 418">
                </div>
                <div class="sm:flex gap-x-5 mt-4 md:mt-8">
                  <div class="sm:w-1/2 mb-3 sm:mb-0">
                    <label class="text-xs text-zinc-600 mb-1 flex items-center gap-x-1" for="">
                      موبایل:
                      <svg class="fill-red-500" xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="#4d4d4d" viewBox="0 0 256 256"><path d="M210.23,101.57l-72.6,29,51.11,65.71a6,6,0,0,1-9.48,7.36L128,137.77,76.74,203.68a6,6,0,1,1-9.48-7.36l51.11-65.71-72.6-29a6,6,0,1,1,4.46-11.14L122,119.14V40a6,6,0,0,1,12,0v79.14l71.77-28.71a6,6,0,1,1,4.46,11.14Z"></path></svg>
                    </label>
                    <input name="mobile" class="rounded-xl text-sm text-zinc-600 border border-zinc-200 w-full bg-white px-5 py-3.5 placeholder:text-zinc-400 placeholder:text-xs placeholder:font-yekanBakhBold focus:outline-1 focus:border-zinc-400" type="text" placeholder="">
                  </div>
                  <div class="sm:w-1/2">
                    <label class="text-xs text-zinc-600 mb-1 flex items-center gap-x-1" for="">
                      کد پستی:
                    </label>
                    <input name="post_code" class="rounded-xl text-sm text-zinc-600 border border-zinc-200 w-full bg-white px-5 py-3.5 placeholder:text-zinc-400 placeholder:text-xs placeholder:font-yekanBakhBold focus:outline-1 focus:border-zinc-400" type="text" placeholder="">
                  </div>
                </div>
                <div class="mt-4 md:mt-8 flex">
                  <textarea placeholder="نکات مهم درباره تحویل محصول" name="description" cols="30" rows="7" class="rounded-xl text-sm text-zinc-600 border border-zinc-200 w-full bg-white px-5 py-3.5 placeholder:text-zinc-400 placeholder:text-xs placeholder:font-yekanBakhBold focus:outline-1 focus:border-zinc-400"></textarea>
                </div>
                <a onclick="createAddress()" class="block bg-primary-500 hover:bg-primary-400 text-white text-center w-8/12 mx-auto mt-10 px-5 py-3 rounded-xl shadow-lg transition-all font-yekanBakhBold">
                   ثبت آدرس
                </a>
              </form>
            </div>
          </div>
          <ul id="addAddressBox" data-dt-panel="current" class="dt-tab-panel grid p-3">
              <?php
              $selectAdressByUserId = selectAdressByUserId($_SESSION['user_sending']);
              if ($selectAdressByUserId){
              foreach ($selectAdressByUserId as $AdressByUserId){
              ?>
                  <li id="deleteAddres<?php echo $AdressByUserId['id']?>" class="group py-4">
                      <input type="radio" id="1" name="send" value="1" class="hidden peer group" requiblue="" checked="">
                      <label for="1" class="cursor-pointer peer-checked:shadow-md text-zinc-600 peer-checked:text-primary-500 block bg-white border border-zinc-200 peer-checked:border-primary-400 p-5 rounded-xl">
                          <div class="flex justify-between">
                              <div class="text-xs">
                                  <div class="flex gap-x-2 items-center">
                      <span class="text-xs lg:text-sm text-zinc-400 font-yekanBakhRegular">
                        نام آدرس:
                      </span>
                                      <span class="text-smm lg:text-base font-yekanBakhBold">
                      <?php
                      $getCityAndProvinceByCityId = getCityAndProvinceByCityId($AdressByUserId['city_id']);
                      if($getCityAndProvinceByCityId){
                          echo "شهر: " . $getCityAndProvinceByCityId['city_name'] . "\n".
                              ' - '
                              .
                              "استان: " . $getCityAndProvinceByCityId['province_name'] . "\n";
                      } else {
                          echo "شهر پیدا نشد یا خطا رخ داده.";
                      }
                      ?>
                      </span>
                                  </div>
                                  <div class="flex gap-x-2 items-center mt-3 text-zinc-600">
                      <span class="text-xs lg:text-sm text-zinc-400 font-yekanBakhRegular">
                        آدرس کامل:
                      </span>
                                      <span class="text-smm lg:text-base font-yekanBakhRegular">
                         <?php
                         if($getCityAndProvinceByCityId){
                             echo "شهر: " . $getCityAndProvinceByCityId['city_name'] . "\n".
                                 ' - '
                                 .
                                 "استان: " . $getCityAndProvinceByCityId['province_name'] . "\n".
                                 ' - '.
                                 $AdressByUserId['address'];
                         }
                         ?>
                      </span>
                                  </div>
                                  <div class="flex gap-x-2 items-center mt-3 text-zinc-600">
                      <span class="text-xs lg:text-sm text-zinc-400 font-yekanBakhRegular">
                        کد پستی:
                      </span>
                                      <span class="text-smm lg:text-base font-yekanBakhRegular">
                         <?= $AdressByUserId['post_code'] ?>
                      </span>
                                  </div>
                                  <div class="flex gap-x-2 items-center mt-3 text-zinc-600">
                      <span class="text-xs lg:text-sm text-zinc-400 font-yekanBakhRegular">
                        گیرنده:
                      </span>
                                      <span class="text-smm lg:text-base font-yekanBakhRegular">
                        <?= $AdressByUserId['name']. ' ' .$AdressByUserId['family']. ' ' . $AdressByUserId['mobile'] ?>
                      </span>
                                  </div>
                              </div>
                              <div class="group/edit relative">
                                  <svg class="size-5.5 lg:size-6.5 rotate-90" xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 24 24" fill="none">
                                      <path class="fill-zinc-700" d="M7 12C7 13.1046 6.10457 14 5 14C3.89543 14 3 13.1046 3 12C3 10.8954 3.89543 10 5 10C6.10457 10 7 10.8954 7 12Z" fill="#1C274C"/>
                                      <path class="fill-zinc-700" d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z" fill="#1C274C"/>
                                      <path class="fill-zinc-700" d="M21 12C21 13.1046 20.1046 14 19 14C17.8954 14 17 13.1046 17 12C17 10.8954 17.8954 10 19 10C20.1046 10 21 10.8954 21 12Z" fill="#1C274C"/>
                                  </svg>
                                  <div class="z-50 group-hover/edit:block left-0 lg:-left-2 top-5 lg:top-8 w-40 rounded-2xl bg-white shadow-custom2 hidden absolute">
                                      <ul class="py-3">
                                          <li onclick="delteAddress(<?= $AdressByUserId['id'] ?>)" class="group/edit flex items-center gap-x-2 py-3 px-4 transition hover:bg-gray-100 text-sm text-red-500 font-yekanBakhRegular">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
                                                  <path class="stroke-red-500" fill-rule="evenodd" clip-rule="evenodd" d="M15.7628 9H7.63719C7.18864 9 6.82501 9.37295 6.82501 9.833V16.5C6.82501 17.8807 7.91632 19 9.26251 19H14.1375C14.784 19 15.404 18.7366 15.8611 18.2678C16.3182 17.7989 16.575 17.163 16.575 16.5V9.833C16.575 9.37295 16.2114 9 15.7628 9Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                  <path class="stroke-red-500" fill-rule="evenodd" clip-rule="evenodd" d="M14.625 7L13.9191 5.553C13.7541 5.21427 13.4167 5.0002 13.0475 5H10.3526C9.98338 5.0002 9.64596 5.21427 9.48092 5.553L8.77502 7H14.625Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                  <path class="fill-red-500" d="M10.8247 12.333C10.8247 11.9188 10.4889 11.583 10.0747 11.583C9.66047 11.583 9.32469 11.9188 9.32469 12.333H10.8247ZM9.32469 15.666C9.32469 16.0802 9.66047 16.416 10.0747 16.416C10.4889 16.416 10.8247 16.0802 10.8247 15.666H9.32469ZM14.0753 12.333C14.0753 11.9188 13.7396 11.583 13.3253 11.583C12.9111 11.583 12.5753 11.9188 12.5753 12.333H14.0753ZM12.5753 15.666C12.5753 16.0802 12.9111 16.416 13.3253 16.416C13.7396 16.416 14.0753 16.0802 14.0753 15.666H12.5753ZM14.625 6.25C14.2108 6.25 13.875 6.58579 13.875 7C13.875 7.41421 14.2108 7.75 14.625 7.75V6.25ZM16.575 7.75C16.9892 7.75 17.325 7.41421 17.325 7C17.325 6.58579 16.9892 6.25 16.575 6.25V7.75ZM8.77501 7.75C9.18923 7.75 9.52501 7.41421 9.52501 7C9.52501 6.58579 9.18923 6.25 8.77501 6.25V7.75ZM6.82501 6.25C6.4108 6.25 6.07501 6.58579 6.07501 7C6.07501 7.41421 6.4108 7.75 6.82501 7.75V6.25ZM9.32469 12.333V15.666H10.8247V12.333H9.32469ZM12.5753 12.333V15.666H14.0753V12.333H12.5753ZM14.625 7.75H16.575V6.25H14.625V7.75ZM8.77501 6.25H6.82501V7.75H8.77501V6.25Z" fill="#000000"></path>
                                              </svg>
                                              حذف
                                          </li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                      </label>
                  </li>
                  <?php
              }
              }else {
                  ?>
                  <div id="messegeAddress" class="text-zinc-700 text-center text-base lg:text-2xl py-10 flex justify-center items-center gap-x-1">
                    <svg class="size-7.5 lg:size-10" width="21" height="21" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path class="group-hover:stroke-primary-500" d="M12.0001 3C7.02956 3 2.99997 7 4.00012 12C4.66541 15.3259 7.98533 18.4306 10.1339 20.1367C10.8361 20.6944 11.1873 20.9732 11.7325 21.0468C11.8836 21.0672 12.1166 21.0672 12.2678 21.0468C12.813 20.9732 13.1641 20.6944 13.8664 20.1368C16.015 18.4306 19.335 15.3259 20.0001 12C21 7 16.9707 3 12.0001 3Z" stroke="#52525C" stroke-width="1.5" stroke-linejoin="round"></path>
                      <path class="group-hover:stroke-primary-500" d="M15 11.15C15 12.8069 13.6569 14.15 12 14.15C10.3431 14.15 9 12.8069 9 11.15C9 9.49315 10.3431 8.15 12 8.15C13.6569 8.15 15 9.49315 15 11.15Z" stroke="#52525C" stroke-width="1.5" stroke-linejoin="round"></path>
                    </svg>
                    هیچ آدرسی ثبت نشده است!
                  </div>
              <?php
              }
              ?>

          </ul>
        </div>
      </div>
    </div>
  </main>
