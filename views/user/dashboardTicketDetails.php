<?php
$getTicketsCode = getTicketsCode(GET('id'));

if(!$getTicketsCode) {
    abort();
}
$time = jdate("B", (dateToTimestamp($getTicketsCode['timeSend'])));
$date = jdate("r", (dateToTimestamp($getTicketsCode['timeSend'])));
$date_org = $date ;
$getChatTickets = getChatTickets($getTicketsCode['id']);
?>
<main class="mt-4 lg:mt-10 pb-10 lg:mx-6">
    <div class="flex flex-col lg:flex-row gap-5">
        <?php
        include "views/layouts/userProfile.php";
        ?>
      <div class="lg:w-9/12 bg-white shadow-custom lg:rounded-2xl p-4 h-fit order-1 lg:order-2">
        <p class="text-lg lg:text-xl text-zinc-700 font-yekanBakhExtraBlack flex gap-x-1">
              جزئیات
            <span class="text-primary-500">
              تیکت
            </span>
            <span class="font-yekanBakhBlack">
              <?= $getTicketsCode['code_tickets'] ?>
            </span>
        </p>
        <div class="flex h-full flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white mt-8">
            <div class="sticky flex items-center justify-between border-b border-gray-200 p-4">
                <div class="flex gap-x-2 items-center">
                    <span class="text-xs lg:text-sm text-zinc-400">
                        موضوع تیکت:
                    </span>
                    <span class="text-smm lg:text-s text-zinc-700 font-yekanBakhBold">
               <?= $getTicketsCode['title'] ?>
                    </span>
                </div>
                <div class="flex gap-x-2 items-center">
                    <span class="text-xs lg:text-sm text-zinc-400">
                      کد تیکت:
                    </span>
                    <span class="text-smm lg:text-s text-zinc-700 font-yekanBakhBold">
                      <?= $getTicketsCode['code_tickets'] ?>
                    </span>
                </div>
            </div>
            <div class="custom-scrollbar max-h-full flex-1 space-y-6 overflow-auto p-5 xl:space-y-8 xl:p-6">
                <?php
                if ($getChatTickets) {
                foreach ($getChatTickets as $ChatTickets) {
                $time = jdate("B", (dateToTimestamp($ChatTickets['timeSend'])));
                $date = jdate("r", (dateToTimestamp($ChatTickets['timeSend'])));
                $date_org1 = $date ;
                ?>
                <div class="<?= $ChatTickets['sender'] == 2 ? "max-w-[350px]" : "mr-auto max-w-[350px] text-right" ?>">
                    <div class="<?= $ChatTickets['sender'] == 2 ? "rounded-lg rounded-tr-xs bg-gray-100 px-3 py-2" : "ml-auto max-w-max rounded-lg rounded-tl-xs bg-primary-500 px-3 py-2" ?>">
                        <p class=" <?= $ChatTickets['sender'] == 2 ? "text-sm text-zinc-700" : "text-sm text-white" ?>">
                            <?= $ChatTickets['text'] ?>
                    <?php
                    if ($ChatTickets['fileUrl'] !== null) {
                        ?>
                        <form method="get">
                            <a href="/profile/downloadFile?id=<?= $ChatTickets['id'] ?>" class="flex h-9 w-9 items-center justify-center mt-2 rounded-lg bg-brand-500 text-white bg-primary-500 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#ffffff" viewBox="0 0 256 256"><path d="M213.66,82.34l-56-56A8,8,0,0,0,152,24H56A16,16,0,0,0,40,40V216a16,16,0,0,0,16,16H200a16,16,0,0,0,16-16V88A8,8,0,0,0,213.66,82.34ZM160,51.31,188.69,80H160ZM200,216H56V40h88V88a8,8,0,0,0,8,8h48V216Zm-42.34-61.66a8,8,0,0,1,0,11.32l-24,24a8,8,0,0,1-11.32,0l-24-24a8,8,0,0,1,11.32-11.32L120,164.69V120a8,8,0,0,1,16,0v44.69l10.34-10.35A8,8,0,0,1,157.66,154.34Z"></path></svg>
                            </a>
                        </form>
                        <?php
                        }
                        ?>
                        </p>
                    </div>
                    <p class="mt-2 mr-2 font-yekanBakhRegular text-xs text-zinc-500">
                        <?= $date_org1 ?>
                    </p>
                </div>
                    <?php
                }
                }
                ?>
                <div id="ticket" style="margin-right:10px "></div>
            </div>
            <?php
            if ($getTicketsCode['status'] == 1){
            ?>
            <div class="sticky bottom-0 border-t border-gray-200 p-3">
                <form method="post" enctype="multipart/form-data" class="flex items-center justify-between">
                    <input name="text" type="text" placeholder="پیام را بنویسید" class="h-9 w-full border-none bg-transparent pl-12 pr-5 text-sm text-gray-800 outline-hidden placeholder:text-zinc-400 focus:border-0 focus:ring-0">
                    <div class="flex items-center">
                        <input type="file" name="fileUrl" id="dropzone-file" class="hidden">
                        <label for="fileInput" class="ml-4 cursor-pointer inline-flex">
                            <svg class="fill-current" width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12.9522 14.4422C12.9522 14.452 12.9524 14.4618 12.9527 14.4714V16.1442C12.9527 16.6699 12.5265 17.0961 12.0008 17.0961C11.475 17.0961 11.0488 16.6699 11.0488 16.1442V6.15388C11.0488 5.73966 10.7131 5.40388 10.2988 5.40388C9.88463 5.40388 9.54885 5.73966 9.54885 6.15388V16.1442C9.54885 17.4984 10.6466 18.5961 12.0008 18.5961C13.355 18.5961 14.4527 17.4983 14.4527 16.1442V6.15388C14.4527 6.14308 14.4525 6.13235 14.452 6.12166C14.4347 3.84237 12.5817 2 10.2983 2C8.00416 2 6.14441 3.85976 6.14441 6.15388V14.4422C6.14441 14.4492 6.1445 14.4561 6.14469 14.463V16.1442C6.14469 19.3783 8.76643 22 12.0005 22C15.2346 22 17.8563 19.3783 17.8563 16.1442V9.55775C17.8563 9.14354 17.5205 8.80775 17.1063 8.80775C16.6921 8.80775 16.3563 9.14354 16.3563 9.55775V16.1442C16.3563 18.5498 14.4062 20.5 12.0005 20.5C9.59485 20.5 7.64469 18.5498 7.64469 16.1442V9.55775C7.64469 9.55083 7.6446 9.54393 7.64441 9.53706L7.64441 6.15388C7.64441 4.68818 8.83259 3.5 10.2983 3.5C11.764 3.5 12.9522 4.68818 12.9522 6.15388L12.9522 14.4422Z" fill=""></path> </svg>
                        </label>
                        <button type="button" onclick="AddTicketDetails(<?= $getTicketsCode['id'] ?>)" class="py-2 px-4 rounded-lg bg-primary-500 cursor-pointer">
                            <svg class="rotate-180" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.98481 2.44399C3.11333 1.57147 1.15325 3.46979 1.96543 5.36824L3.82086 9.70527C3.90146 9.89367 3.90146 10.1069 3.82086 10.2953L1.96543 14.6323C1.15326 16.5307 3.11332 18.4291 4.98481 17.5565L16.8184 12.0395C18.5508 11.2319 18.5508 8.76865 16.8184 7.961L4.98481 2.44399ZM3.34453 4.77824C3.0738 4.14543 3.72716 3.51266 4.35099 3.80349L16.1846 9.32051C16.762 9.58973 16.762 10.4108 16.1846 10.68L4.35098 16.197C3.72716 16.4879 3.0738 15.8551 3.34453 15.2223L5.19996 10.8853C5.21944 10.8397 5.23735 10.7937 5.2537 10.7473L9.11784 10.7473C9.53206 10.7473 9.86784 10.4115 9.86784 9.99726C9.86784 9.58304 9.53206 9.24726 9.11784 9.24726L5.25157 9.24726C5.2358 9.20287 5.2186 9.15885 5.19996 9.11528L3.34453 4.77824Z" fill="white"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
            <?php
            }else{
                ?>

            <?php
            }
            ?>
        </div>
      </div>
    </div>
  </main>

