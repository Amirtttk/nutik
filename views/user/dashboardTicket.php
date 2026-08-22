<?php
$getTickets = getTickets($_SESSION['user_sending']);
$getTicketsByStatus = getTicketsByStatus($_SESSION['user_sending']);
?>
<main class="mt-4 lg:mt-10 pb-10 lg:mx-6">
    <div class="flex flex-col lg:flex-row gap-5">
        <?php
        include "views/layouts/userProfile.php";
        ?>
      <div class="lg:w-9/12 bg-white shadow-custom lg:rounded-2xl p-4 h-fit order-1 lg:order-2">
        <div class="flex justify-between">
          <p class="text-lg lg:text-xl text-zinc-700 font-yekanBakhExtraBlack">
              تیکت های
              <span class="text-primary-500">
                  من
              </span>
          </p>
          <a href="#" data-modal="modalSelectAddress" class="open-modal text-primary-500 text-xs lg:text-smm flex items-center gap-x-1 w-fit underline underline-offset-2">
            تیکت جدید
             <svg class="fill-primary-500 size-3.5 lg:size-4" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256"><path d="M228,128a12,12,0,0,1-12,12H140v76a12,12,0,0,1-24,0V140H40a12,12,0,0,1,0-24h76V40a12,12,0,0,1,24,0v76h76A12,12,0,0,1,228,128Z"></path></svg>
          </a>
          <div id="modalSelectAddress" class="modal fixed inset-0 bg-black/20 bg-opacity-50 flex items-center justify-center transition-opacity duration-300 z-[99] hidden">
            <div class="modal-box bg-white p-2 rounded-xl shadow-lg w-11/12 md:w-6/12 transition-transform duration-300 max-h-[90vh] overflow-y-auto opacity-0 scale-90">
              <div class="flex justify-between items-center p-4 border-b border-zinc-300">
                <h3 class="text-gray-700">
                  تیکت جدید
                </h3>
              </div>
                <div id="errors"></div>
              <form enctype="multipart/form-data" class="space-y-6 px-2 lg:px-8 pb-4 sm:pb-6 pt-4 text-xs md:text-base">
                  <div class="flex flex-col lg:flex-row gap-4">
                      <div class="sm:flex gap-x-5 lg:w-9/12">
                          <div class="w-full mb-4 sm:mb-0">
                              <label class="text-xs text-zinc-600 mb-1 flex items-center gap-x-1" for="">
                                  موضوع تیکت:
                                  <svg class="fill-red-500" xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="#4d4d4d" viewBox="0 0 256 256"><path d="M210.23,101.57l-72.6,29,51.11,65.71a6,6,0,0,1-9.48,7.36L128,137.77,76.74,203.68a6,6,0,1,1-9.48-7.36l51.11-65.71-72.6-29a6,6,0,1,1,4.46-11.14L122,119.14V40a6,6,0,0,1,12,0v79.14l71.77-28.71a6,6,0,1,1,4.46,11.14Z"></path></svg>
                              </label>
                              <input name="title"  class="w-full rounded-lg border border-zinc-200 bg-white px-3 py-3 mt-1 text-gray-700 transition-all outline-2 outline-transparent focus:outline-primary-500" type="text" placeholder="موضوع تیکت">
                          </div>
                      </div>
                      <div class="w-16 h-16 order-2 w-full lg:w-3/12">
                          <div class="w-full mb-4 sm:mb-0">
                              <label class="text-xs text-zinc-600 mb-1 flex items-center gap-x-1" for="">
                                    آپلود فایل:
                                  <svg class="fill-red-500" xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="#4d4d4d" viewBox="0 0 256 256"><path d="M210.23,101.57l-72.6,29,51.11,65.71a6,6,0,0,1-9.48,7.36L128,137.77,76.74,203.68a6,6,0,1,1-9.48-7.36l51.11-65.71-72.6-29a6,6,0,1,1,4.46-11.14L122,119.14V40a6,6,0,0,1,12,0v79.14l71.77-28.71a6,6,0,1,1,4.46,11.14Z"></path></svg>
                              </label>
                              <label for="dropzone-file" class="flex flex-col items-center justify-center w-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                  <div class="flex flex-col items-center justify-center px-2 py-1.5">
                                      <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"></path>
                                      </svg>
                                  </div>
                                  <input id="dropzone-file" type="file" class="hidden">
                              </label>
                          </div>
                      </div>
                  </div>
                <div class="sm:flex gap-x-5">
                  <div class="w-full mb-4 sm:mb-0">
                    <label class="text-xs text-zinc-600 mb-1 flex items-center gap-x-1" for="">
                      متن تیکت:
                      <svg class="fill-red-500" xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="#4d4d4d" viewBox="0 0 256 256"><path d="M210.23,101.57l-72.6,29,51.11,65.71a6,6,0,0,1-9.48,7.36L128,137.77,76.74,203.68a6,6,0,1,1-9.48-7.36l51.11-65.71-72.6-29a6,6,0,1,1,4.46-11.14L122,119.14V40a6,6,0,0,1,12,0v79.14l71.77-28.71a6,6,0,1,1,4.46,11.14Z"></path></svg>
                    </label>
                    <textarea name="text"  class="w-full rounded-lg border border-zinc-200 bg-white px-3 py-3 mt-1 text-gray-700 transition-all outline-2 outline-transparent focus:outline-primary-500" placeholder="متن پیام شما..." cols="30" rows="5"></textarea>
                  </div>
                </div>
                <a onclick="AddNewTicket()" class="block bg-primary-500 hover:bg-primary-400 text-white text-center w-8/12 mx-auto mt-10 px-5 py-3 rounded-xl shadow-lg transition-all font-yekanBakhBold">
                   ثبت تیکت
                </a>
              </form>
            </div>
          </div>
        </div>
        <div class="dt-tabs w-full mt-8">
          <!-- tabs -->
          <div class="dt-tabs__nav flex gap-6 whitespace-nowrap overflow-x-auto overflow-y-hidden pb-2 px-2" style="scrollbar-width: none;">
            <button class="dt-tab-btn group cursor-pointer flex items-center gap-x-2 pb-2 text-xs lg:text-sm text-zinc-600 border-b-2 border-transparent
                     data-[active=true]:text-primary-400
                     data-[active=true]:border-primary-400" data-dt-tab="current" data-active="true">
              باز
              <div class="bg-zinc-400 group-data-[active=true]:bg-primary-400 text-white rounded-md size-5 flex justify-center items-center">
                <?php if ($getTickets) {
                    echo count($getTickets);
                }else{
                    echo 0 ;
                } ?>
              </div>
            </button>
            <button class="dt-tab-btn group cursor-pointer flex items-center gap-x-2 pb-2 text-xs lg:text-sm text-zinc-600 border-b-2 border-transparent
                     data-[active=true]:text-primary-400
                     data-[active=true]:border-primary-400" data-dt-tab="all">
              بسته شده
              <div class="bg-zinc-400 group-data-[active=true]:bg-primary-400 text-white rounded-md size-5 flex justify-center items-center">
                  <?php if ($getTicketsByStatus) {
                      echo count($getTicketsByStatus);
                  }else{
                      echo 0 ;
                  } ?>
              </div>
            </button>
          </div>
          <!-- content -->
          <div class="dt-tabs__content mt-4">
            <div data-dt-panel="current" class="dt-tab-panel grid p-3 divide-y divide-zinc-200">
                <?php
                 if($getTickets){
                    foreach ($getTickets as $Tickets){
                        $date = jdate("r", (dateToTimestamp($Tickets['timeSend'])));
                        $date_org = $date;
                        ?>
                        <a href="/ticketDetails?id=<?= $Tickets['code_tickets'] ?>" class="group py-4">
                            <div class="flex justify-between">
                                <div class="text-zinc-600 text-xs">
                                    <div class="flex gap-x-2 items-center">
                      <span class="text-xs lg:text-sm text-zinc-400">
                        موضوع:
                      </span>
                                        <span class="text-smm lg:text-base text-zinc-600 font-yekanBakhBold">
                   <?php echo $Tickets['title'] ?>
                      </span>
                                    </div>
                                    <div class="flex gap-x-2 items-center mt-1.5">
                      <span class="text-xs lg:text-sm text-zinc-400">
                        کد تیکت:
                      </span>
                                        <span class="text-smm lg:text-s text-zinc-600">
                     <?php echo $Tickets['code_tickets'] ?>
                      </span>
                                    </div>
                                    <div class="flex gap-x-5 items-center mt-3">
                                        <div class="text-x lg:text-xs">
                                            <?= $date_org; ?>
                                        </div>

                                        <?php
                                        if ($Tickets['last_sender'] == 1) {
                                            echo '
                                        <div class="text-x lg:text-xs bg-primary-500 px-1.5 py-1 rounded-lg text-white">
                                            پاسخ داده شده
                                        </div>
                                                         ';
                                        } else {
                                            echo '
                                              <div class="text-x lg:text-xs bg-primary-500 px-1.5 py-1 rounded-lg text-white">
                                          در انتظار پاسخ 
                                        </div>
                                                         ';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <svg class="fill-zinc-600 group-hover:fill-primary-500 size-4.5 lg:size-5.5" xmlns="http://www.w3.org/2000/svg" fill="#000000" width="18" height="18" viewBox="0 0 56 56"><path d="M 47.7928 46.4453 C 49.0352 46.4453 49.5973 45.6484 49.8085 44.6875 C 49.9492 43.9844 49.9962 42.8125 49.9962 41.4531 C 49.9962 30.1094 45.4725 25.2344 34.3397 25.2344 L 17.9803 25.2344 L 12.2382 25.5625 L 20.1132 18.3437 L 25.3163 13.0469 C 25.6913 12.6719 25.9022 12.1328 25.9022 11.5703 C 25.9022 10.3984 24.9882 9.5547 23.8397 9.5547 C 23.2772 9.5547 22.7850 9.7422 22.246 10.2578 L 6.7303 25.7500 C 6.2616 26.1953 6.0038 26.7578 6.0038 27.3203 C 6.0038 27.9062 6.2616 28.4453 6.7303 28.9141 L 22.3163 44.4531 C 22.7850 44.8984 23.2772 45.1094 23.8397 45.1094 C 24.9882 45.1094 25.9022 44.2656 25.9022 43.0937 C 25.9022 42.5312 25.6913 41.9687 25.3163 41.5937 L 20.1132 36.2969 L 12.2147 29.0781 L 17.9803 29.4297 L 34.1288 29.4297 C 42.7538 29.4297 45.7538 32.9688 45.7538 41.6641 C 45.7538 42.7656 45.7069 43.5391 45.7069 44.3594 C 45.7069 45.6016 46.5741 46.4453 47.7928 46.4453 Z"></path></svg>
                            </div>
                        </a>
                <?php
                    }
                 }
                ?>
            </div>
            <div data-dt-panel="all" class="dt-tab-panel grid p-3 divide-y divide-zinc-200 hidden">
                <?php
                if($getTicketsByStatus){
                 foreach ($getTicketsByStatus as $TicketsByStatus){
                     $date = jdate("r", (dateToTimestamp($TicketsByStatus['timeSend'])));
                     $date_org1 = $date;
                     ?>
                     <a href="/ticketDetails?id=<?= $TicketsByStatus['code_tickets'] ?>" class="group py-4">
                         <div class="flex justify-between">
                             <div class="text-zinc-600 text-xs">
                                 <div class="flex gap-x-2 items-center">
                      <span class="text-xs lg:text-sm text-zinc-400">
                        موضوع:
                      </span>
                                     <span class="text-smm lg:text-base text-zinc-600 font-yekanBakhBold">
                     <?= $TicketsByStatus['title'] ?>
                      </span>
                                 </div>
                                 <div class="flex gap-x-2 items-center mt-1.5">
                      <span class="text-xs lg:text-sm text-zinc-400">
                        کد تیکت:
                      </span>
                                     <span class="text-smm lg:text-s text-zinc-600">
                       <?= $TicketsByStatus['code_tickets'] ?>
                      </span>
                                 </div>
                                 <div class="flex gap-x-5 items-center mt-3">
                                     <div class="text-x lg:text-xs">
                                        <?= $date_org1; ?>
                                     </div>
                                     <div class="text-x lg:text-xs bg-red-500 px-1.5 py-1 rounded-lg text-white">
                                         بسته شده
                                     </div>
                                 </div>
                             </div>
                             <svg class="fill-zinc-600 group-hover:fill-primary-500 size-4.5 lg:size-5.5" xmlns="http://www.w3.org/2000/svg" fill="#000000" width="18" height="18" viewBox="0 0 56 56"><path d="M 47.7928 46.4453 C 49.0352 46.4453 49.5973 45.6484 49.8085 44.6875 C 49.9492 43.9844 49.9962 42.8125 49.9962 41.4531 C 49.9962 30.1094 45.4725 25.2344 34.3397 25.2344 L 17.9803 25.2344 L 12.2382 25.5625 L 20.1132 18.3437 L 25.3163 13.0469 C 25.6913 12.6719 25.9022 12.1328 25.9022 11.5703 C 25.9022 10.3984 24.9882 9.5547 23.8397 9.5547 C 23.2772 9.5547 22.7850 9.7422 22.246 10.2578 L 6.7303 25.7500 C 6.2616 26.1953 6.0038 26.7578 6.0038 27.3203 C 6.0038 27.9062 6.2616 28.4453 6.7303 28.9141 L 22.3163 44.4531 C 22.7850 44.8984 23.2772 45.1094 23.8397 45.1094 C 24.9882 45.1094 25.9022 44.2656 25.9022 43.0937 C 25.9022 42.5312 25.6913 41.9687 25.3163 41.5937 L 20.1132 36.2969 L 12.2147 29.0781 L 17.9803 29.4297 L 34.1288 29.4297 C 42.7538 29.4297 45.7538 32.9688 45.7538 41.6641 C 45.7538 42.7656 45.7069 43.5391 45.7069 44.3594 C 45.7069 45.6016 46.5741 46.4453 47.7928 46.4453 Z"></path></svg>
                         </div>
                     </a>
                <?php
                 }
                }
                ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

