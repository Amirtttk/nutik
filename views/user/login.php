 <main>
    <div class="h-screen flex justify-center items-center bg-gradient-to-bl from-zinc-100 to-zinc-200">
      <div class="bg-white rounded-3xl border border-zinc-300 shadow-custom w-11/12 sm:w-7/12 md:w-6/12 lg:w-4/12 xl:w-3/12 h-auto py-5 px-4">
        <img class="w-36 mx-auto" src="./../../assets/user/image/logo.png" alt="">
        <div class="mt-5 xl:text-lg font-PeydaBold text-zinc-800">
          ورود یا ثبت نام
        </div>
          <div id="formNowLogin" >
          <form name="registerForm" method="post">
              <span id="showCode"></span>
            <div class="mt-4 mb-3 text-xs xl:text-smm font-PeydaRegular text-zinc-500">
              لطفا شماره موبایل خود را وارد کنید:
            </div>
            <div class="flex flex-col gap-y-1">
                <input id="mobile" name="mobile" class="w-full text-sm xl:text-base rounded-lg border border-zinc-200 bg-white px-3 py-3 mt-1 text-gray-700 transition-all outline-2 outline-transparent focus:outline-primary-500 text-left" dir="ltr" type="number" placeholder="09XX-XXX-XXXX">
            </div>
              <span id="showError" class="text-danger"></span>
              <?php
              $count = checkLoginAttempts($_SERVER['REMOTE_ADDR'], time());
              $count2 = checkLoginAttempts($_SERVER['REMOTE_ADDR'], time(), 'req');
              if ($count < 5 && $count2 < 15) {

              ?>
            <button type="button" onclick="checkMobile()" id="btnCheckMobile" class="bg-primary-600 hover:bg-white hover:text-primary-600 group rounded-2xl w-full text-center block p-3.5 lg:p-4 mt-10 transition-all duration-300 hover:shadow-custom text-smm xl:text-sm text-white" href="">
               ارسال کد تایید
            </button>
                  <?php
              }else{
                  ?>
                  <a class="bg-primary-600 hover:bg-white hover:text-primary-600 group rounded-2xl w-full text-center block p-3.5 lg:p-4 mt-10 transition-all duration-300 hover:shadow-custom text-smm xl:text-sm text-white" href="">
                  تعداد درخواست غیر مجاز لطفا صبر کنید
                  </a>
              <?php
              }
              ?>
        </form>
        </div>
          <div style="display: none" id="formNewLogin">
              <form name="registerForm" method="post">
                  <div class="mt-5 xl:text-lg font-PeydaBold text-zinc-800">
                      ارسال کد تایید
                  </div>
                  <div class="mt-4 mb-3 text-xs xl:text-smm font-PeydaRegular text-zinc-500">
                      لطفا کد 4 رقمی ارسال شده به شماره تلفن 09123456789 را وارد کنید:
                  </div>
                  <div class="input-field mb-5 flex flex-row-reverse gap-x-4 justify-center mt-2">
                      <input type="text" inputmode="numeric" pattern="[0-9]*" id="codeUser[]" class="code-input w-10 h-12 text-center focus:shadow-lg shadow-custom/15 rounded-lg border border-zinc-200 bg-white text-gray-700 transition-all outline-2 outline-transparent focus:outline-primary-500" required="">
                      <input type="text" inputmode="numeric" pattern="[0-9]*" id="codeUser[]" class="code-input w-10 h-12 text-center focus:shadow-lg shadow-custom/15 rounded-lg border border-zinc-200 bg-white text-gray-700 transition-all outline-2 outline-transparent focus:outline-primary-500" required="">
                      <input type="text" inputmode="numeric" pattern="[0-9]*" id="codeUser[]" class="code-input w-10 h-12 text-center focus:shadow-lg shadow-custom/15 rounded-lg border border-zinc-200 bg-white text-gray-700 transition-all outline-2 outline-transparent focus:outline-primary-500" required="">
                      <input type="text" inputmode="numeric" pattern="[0-9]*" id="codeUser[]" class="code-input w-10 h-12 text-center focus:shadow-lg shadow-custom/15 rounded-lg border border-zinc-200 bg-white text-gray-700 transition-all outline-2 outline-transparent focus:outline-primary-500" required="">
                  </div>
                  <span id="showError2" class="text-danger"></span>
                  <span id="spanTimer">کد ارسالی تا <span
                              id="nowTime"></span> ثانیه دیگر منقضی
                        میشود</span>
                  <button type="button" onclick="checkCode()" id="btnSubmitCode"  class="bg-primary-600 hover:bg-white hover:text-primary-600 group rounded-2xl w-full text-center block p-3.5 lg:p-4 mt-10 transition-all duration-300 hover:shadow-custom text-smm xl:text-sm text-white" href="">
                      تایید
                  </button>
              </form>
          </div>
      </div>
    </div>
  </main>

