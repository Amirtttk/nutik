<?php
$getTicketsCode = getTicketsCode(GET('ticketDetails'));
$getChatTickets = getChatTickets($getTicketsCode['id']);
$getOneUser = getOneUser($getTicketsCode['userID']);

?>
<div class=" d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="flex-row-fluid mx-lg-8" id="kt_chat_content">
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header align-items-center px-4 py-3">
                <div class=" flex-grow-1">
                    <div class="text-dark-75 font-weight-bold font-size-h5"><?= $getOneUser['userFullName'] ?></div>
                </div>
                <div class=" flex-grow-1">
                    <div class="text-dark-75 font-weight-bold font-size-h5">موضوع: <?= $getTicketsCode['title'] ?></div>
                </div>
            </div>
            <!--end::Header-->

            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Scroll-->
                <div class="" data-mobile-height="350" style="height: 252px;">
                    <!--begin::پیامs-->
                    <div class="messages">
                        <?php
                        foreach ($getChatTickets as $ChatTickets){
                            $date = jdate("r", (dateToTimestamp($getTicketsCode['timeSend'])));
                            $date_org = $date ;
                        ?>
                            <div class="<?= $ChatTickets['sender'] == 2 ? "mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px" : "mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px" . '" style="margin:0px auto 0px 0px;"' ?>">
                                <?= $ChatTickets['text'] ?>
                                <?php
                                if ($ChatTickets['fileUrl'] !== null) {
                                    ?>
                                    <form method="get">
                                    <a href="/admin/downloadFile?id=<?= $ChatTickets['id'] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                             fill="<?= $ChatTickets['sender'] == 2 ? "#000000" : "rgb(63 65 77 / 1)" ?>"
                                             viewBox="0 0 256 256">
                                            <path
                                                    d="M213.66,82.34l-56-56A8,8,0,0,0,152,24H56A16,16,0,0,0,40,40V216a16,16,0,0,0,16,16H200a16,16,0,0,0,16-16V88A8,8,0,0,0,213.66,82.34ZM160,51.31,188.69,80H160ZM200,216H56V40h88V88a8,8,0,0,0,8,8h48V216Zm-42.34-61.66a8,8,0,0,1,0,11.32l-24,24a8,8,0,0,1-11.32,0l-24-24a8,8,0,0,1,11.32-11.32L120,164.69V120a8,8,0,0,1,16,0v44.69l10.34-10.35A8,8,0,0,1,157.66,154.34Z">
                                            </path>
                                        </svg>
                                    </a>
                                        </form>
                                    <?php
                                }
                                ?>
                                <div style="font-size: 10px;margin:10px 0px 0px 0px;">
                                    <?= $date_org; ?>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <div id="ticket"></div>
                    </div>
                    <!--end::پیامs-->
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 252px; left: 730px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 61px;"></div></div></div>
                <!--end::Scroll-->
            </div>
            <!--end::Body-->
             <?php
             if ($getTicketsCode['status'] == 1){
                 ?>
                 <!--begin::Footer-->
                 <div class="card-footer align-items-center d-flex">
                     <!--begin::Compose-->
                     <input type="text" id="textMasseg" name="text" type="text" class="form-control border p-2" rows="2" placeholder="تایپ یک پیام">
                     <div class="d-flex align-items-center justify-content-between">
                         <label class="btn btn-sm btn-icon btn-white btn-hover-text-primary btn-shadow mx-4" data-action="change" data-toggle="tooltip" title="">
                        <span class="svg-icon svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\عمومی\Clip.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M14,16 L12,16 L12,12.5 C12,11.6715729 11.3284271,11 10.5,11 C9.67157288,11 9,11.6715729 9,12.5 L9,17.5 C9,19.4329966 10.5670034,21 12.5,21 C14.4329966,21 16,19.4329966 16,17.5 L16,7.5 C16,5.56700338 14.4329966,4 12.5,4 L12,4 C10.3431458,4 9,5.34314575 9,7 L7,7 C7,4.23857625 9.23857625,2 12,2 L12.5,2 C15.5375661,2 18,4.46243388 18,7.5 L18,17.5 C18,20.5375661 15.5375661,23 12.5,23 C9.46243388,23 7,20.5375661 7,17.5 L7,12.5 C7,10.5670034 8.56700338,9 10.5,9 C12.4329966,9 14,10.5670034 14,12.5 L14,16 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.500000, 12.500000) rotate(-315.000000) translate(-12.500000, -12.500000) "/>
                            </g>
                        </svg><!--end::Svg Icon--></span>
                             <input id="inputFile" accept=".png, .jpg, .jpeg , .zip" type="file" name="fileUrl" style="opacity: 0;display: none">
                             <input type="hidden" name="profile_avatar_remove">
                         </label>
                         <div>
                             <button type="button" onclick="AddTicketDetails(<?= $getTicketsCode['id'] ?>)" class="btn btn-primary btn-md text-uppercase font-weight-bold chat-send py-2 px-6">ارسال</button>
                         </div>
                     </div>
                     <!--begin::Compose-->
                 </div>
                 <!--end::Footer-->
            <?php
             }
             ?>

        </div>
        <!--end::Card-->
    </div>
</div>
<?php
$pageTitle = "جزییات تیکت ";
$pageScript = "
    <script src='../../../assets/admin/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.6'></script>
    <script src='../../../assets/admin/js/pages/widgets.js?v=7.0.6'></script>
    <script src='../../../assets/admin/plugins/custom/datatables/datatables.bundle.js?v=7.0.6'></script>
    <script src='../../../assets/admin/js/pages/crud/datatables/basic/paginations.js?v=7.0.6'></script>
    <script src='../../assets/admin/js/sweetalert.js'></script>
    <script src='../../assets/admin/js/main.js'></script>
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
    </script>
";
$pageLink = "
    <link href='../../assets/admin/css/style.bundle.rtl.css' rel='stylesheet' type='text/css' />
    <link href='../../assets/admin/css/themes/layout/header/base/light.rtl.css' rel='stylesheet'
        type='text/css' />
    <link href='../../assets/admin/css/themes/layout/aside/dark.rtl.css' rel='stylesheet' type='text/css' />
";

?>
