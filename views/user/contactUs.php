 <main class="my-4 xl:my-10">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 md:gap-8 mx-2 md:mx-32 mb-8 md:my-12 border border-zinc-200 rounded-2xl p-2 md:p-8 bg-white">
      <div class="space-y-4 md:space-y-6 order-2 lg:order-1">
        <div class="w-full text-zinc-700 text-lg lg:text-2xl pb-6 pr-2 font-PeydaBold lg:font-PeydaBlack">
          فـرم درخـواسـت 
          <span class="text-primary-600">
            تـمـاس
          </span>
          <p class="text-zinc-600 text-sm lg:text-sm font-yekanBakhRegular lg:font-yekanBakhSemiBold mt-2">
            در ساعات غیر اداری لطفا فرم زیر را پر کنید
            تا در اولین فرصت بررسی و پاسخ داده شود.
          </p>
        </div>
          <div id="getErrors"></div>
        <div class="text-s text-zinc-700 font-PeydaBold">
            نام و نام خانوادگی:
            <input name="nameAndFamily" class="w-full rounded-lg border border-zinc-200 bg-white px-3 py-3 mt-1 text-gray-700 transition-all outline-2 outline-transparent focus:outline-primary-500" type="text" placeholder="امیررضا کریمی">
        </div>
        <div class="text-s text-zinc-700 font-PeydaBold">
            شماره تماس:
            <input name="mobile" class="w-full rounded-lg border border-zinc-200 bg-white px-3 py-3 mt-1 text-gray-700 transition-all outline-2 outline-transparent focus:outline-primary-500 text-left" dir="ltr" type="number" placeholder="09XX-XXX-XXXX">
        </div>
        <div class="text-s text-zinc-700 font-PeydaBold">
            پیام شما:
          <textarea name="text" class="w-full rounded-lg border border-zinc-200 bg-white px-3 py-3 mt-1 text-gray-700 transition-all outline-2 outline-transparent focus:outline-primary-500" placeholder="متن پیام شما..." cols="30" rows="5"></textarea>
        </div>
        <button onclick="createContactus()" type="button" class="font-PeydaBold flex items-center py-3 px-6 text-white text-s bg-primary-500 rounded-xl xl:rounded-2xl hover:opacity-85 transition shadow-lg shadow-primary-500/50 relative cursor-pointer">
          ثبت و ارسال
        </button>
      </div>
      <div class="order-1 lg:order-2">
        <div class="w-full text-zinc-700 text-lg lg:text-2xl text-center pb-6 pr-2 rounded-2xl font-PeydaBold lg:font-PeydaBlack">
        اطـلـاعـات 
        <span class="text-primary-600">
            تـمـاس
          </span>
        </div>
        <div class="grid grid-cols-1 mt-6 mb-10">
          <ul class="flex flex-col font-yekanBakhRegular">
            <li class="flex gap-x-5 justify-between mb-5">
              <div class="text-zinc-700 text-sm w-20 font-yekanBakhBold">
               آدرس:
              </div>
              <a href="#" class="text-zinc-700 text-sm text-left">
                سبزوار - خیابان اصلی - کوچه اصلی
              </a>
            </li>
            <li class="flex gap-x-5 justify-between mb-4">
              <div class="text-zinc-700 text-sm font-yekanBakhBold">
                واحد فروش:
              </div>
              <a href="tel:09123456789" class="text-zinc-700 text-sm">
                09123456789
              </a>
            </li>
            <li class="flex gap-x-5 justify-between mb-4">
              <div class="text-zinc-700 text-sm font-yekanBakhBold">
               واحد پشتیبانی:
              </div>
              <a href="tel:09123456789" class="text-zinc-700 text-sm">
                09123456789
              </a>
            </li>
            <li class="flex gap-x-5 justify-between">
              <div class="text-zinc-700 text-sm font-yekanBakhBold">
                ساعات کاری:
              </div>
              <div class="text-zinc-700 text-sm">
                8 تا 23
              </div>
            </li>
          </ul>
        </div>
        <div class="grid xl:grid-cols-2 gap-5 mb-5">
            <a href="#" class="flex items-center gap-3 w-full group">
                <div class="flex items-center justify-center
                    h-full
                    px-5
                    rounded-2xl
                    bg-zinc-100
                    transition-all duration-300
                    group-hover:bg-primary-500">
                    <svg class="fill-zinc-500 group-hover:fill-white" xmlns="http://www.w3.org/2000/svg" width="34" height="34" fill="#ffffff" viewBox="0 0 256 256"><path d="M128,80a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160ZM176,24H80A56.06,56.06,0,0,0,24,80v96a56.06,56.06,0,0,0,56,56h96a56.06,56.06,0,0,0,56-56V80A56.06,56.06,0,0,0,176,24Zm40,152a40,40,0,0,1-40,40H80a40,40,0,0,1-40-40V80A40,40,0,0,1,80,40h96a40,40,0,0,1,40,40ZM192,76a12,12,0,1,1-12-12A12,12,0,0,1,192,76Z"></path></svg>
                </div>
                <div class="flex flex-col items-center justify-center
                        w-full h-18
                        rounded-2xl
                        bg-zinc-100
                        transition-all duration-300
                        group-hover:bg-primary-500">
                    <span class="text-zinc-800 group-hover:text-white font-yekanBakhBold mx-1 text-s lg:text-lg">
                        اینستاگرام
                    </span>
                    <span class="text-zinc-500 group-hover:text-white text-xs lg:text-sm mt-1 font-yekanBakhRegular">
                    instagram.com/notic.ir
                    </span>
                </div>
            </a>
            <a href="#" class="flex items-center gap-3 w-full group">
                <div class="flex items-center justify-center
                    h-full
                    px-5
                    rounded-2xl
                    bg-zinc-100
                    transition-all duration-300
                    group-hover:bg-primary-500">
                    <svg class="fill-zinc-500 group-hover:fill-white" xmlns="http://www.w3.org/2000/svg" width="34" height="34" fill="#000000" viewBox="0 0 256 256"><path d="M214.75,211.71l-62.6-98.38,61.77-67.95a8,8,0,0,0-11.84-10.76L143.24,99.34,102.75,35.71A8,8,0,0,0,96,32H48a8,8,0,0,0-6.75,12.3l62.6,98.37-61.77,68a8,8,0,1,0,11.84,10.76l58.84-64.72,40.49,63.63A8,8,0,0,0,160,224h48a8,8,0,0,0,6.75-12.29ZM164.39,208,62.57,48h29L193.43,208Z"></path></svg>
                </div>
                <div class="flex flex-col items-center justify-center
                        w-full h-18
                        rounded-2xl
                        bg-zinc-100
                        transition-all duration-300
                        group-hover:bg-primary-500">
                    <span class="text-zinc-800 group-hover:text-white font-yekanBakhBold mx-1 text-s lg:text-lg">
                        ایکس
                    </span>
                    <span class="text-zinc-500 group-hover:text-white text-xs lg:text-sm mt-1 font-yekanBakhRegular">
                    x.com/notic.ir
                    </span>
                </div>
            </a>
            <a href="#" class="flex items-center gap-3 w-full group">
                <div class="flex items-center justify-center
                    h-full
                    px-5
                    rounded-2xl
                    bg-zinc-100
                    transition-all duration-300
                    group-hover:bg-primary-500">
                    <svg class="fill-zinc-500 group-hover:fill-white" xmlns="http://www.w3.org/2000/svg" width="34" height="34" fill="#000000" viewBox="0 0 256 256"><path d="M228.88,26.19a9,9,0,0,0-9.16-1.57L17.06,103.93a14.22,14.22,0,0,0,2.43,27.21L72,141.45V200a15.92,15.92,0,0,0,10,14.83,15.91,15.91,0,0,0,17.51-3.73l25.32-26.26L165,220a15.88,15.88,0,0,0,10.51,4,16.3,16.3,0,0,0,5-.79,15.85,15.85,0,0,0,10.67-11.63L231.77,35A9,9,0,0,0,228.88,26.19Zm-61.14,36L78.15,126.35l-49.6-9.73ZM88,200V152.52l24.79,21.74Zm87.53,8L92.85,135.5l119-85.29Z"></path></svg>
                </div>
                <div class="flex flex-col items-center justify-center
                        w-full h-18
                        rounded-2xl
                        bg-zinc-100
                        transition-all duration-300
                        group-hover:bg-primary-500">
                    <span class="text-zinc-800 group-hover:text-white font-yekanBakhBold mx-1 text-s lg:text-lg">
                        تلگرام
                    </span>
                    <span class="text-zinc-500 group-hover:text-white text-xs lg:text-sm mt-1 font-yekanBakhRegular">
                    t.me/notic.ir
                    </span>
                </div>
            </a>
            <a href="#" class="flex items-center gap-3 w-full group">
                <div class="flex items-center justify-center
                    h-full
                    px-5
                    rounded-2xl
                    bg-zinc-100
                    transition-all duration-300
                    group-hover:bg-primary-500">
                    <svg class="fill-zinc-500 group-hover:fill-white" xmlns="http://www.w3.org/2000/svg" width="34" height="34" fill="#000000" viewBox="0 0 256 256"><path d="M164.44,121.34l-48-32A8,8,0,0,0,104,96v64a8,8,0,0,0,12.44,6.66l48-32a8,8,0,0,0,0-13.32ZM120,145.05V111l25.58,17ZM234.33,69.52a24,24,0,0,0-14.49-16.4C185.56,39.88,131,40,128,40s-57.56-.12-91.84,13.12a24,24,0,0,0-14.49,16.4C19.08,79.5,16,97.74,16,128s3.08,48.5,5.67,58.48a24,24,0,0,0,14.49,16.41C69,215.56,120.4,216,127.34,216h1.32c6.94,0,58.37-.44,91.18-13.11a24,24,0,0,0,14.49-16.41c2.59-10,5.67-28.22,5.67-58.48S236.92,79.5,234.33,69.52Zm-15.49,113a8,8,0,0,1-4.77,5.49c-31.65,12.22-85.48,12-86,12H128c-.54,0-54.33.2-86-12a8,8,0,0,1-4.77-5.49C34.8,173.39,32,156.57,32,128s2.8-45.39,5.16-54.47A8,8,0,0,1,41.93,68c30.52-11.79,81.66-12,85.85-12h.27c.54,0,54.38-.18,86,12a8,8,0,0,1,4.77,5.49C221.2,82.61,224,99.43,224,128S221.2,173.39,218.84,182.47Z"></path></svg>                </div>
                <div class="flex flex-col items-center justify-center
                        w-full h-18
                        rounded-2xl
                        bg-zinc-100
                        transition-all duration-300
                        group-hover:bg-primary-500">
                    <span class="text-zinc-800 group-hover:text-white font-yekanBakhBold mx-1 text-s lg:text-lg">
                        یوتیوب
                    </span>
                    <span class="text-zinc-500 group-hover:text-white text-xs lg:text-sm mt-1 font-yekanBakhRegular">
                    instagram.com/notic.ir
                    </span>
                </div>
            </a>
        </div>
        <iframe class="rounded-3xl w-full" title="map-iframe" src="https://neshan.org/maps/iframe/places/3c3f4920eea09fd7fe92d9c4fe9cdc7d#c36.220-57.675-20z-0p/36.21977529424289/57.67512071663677" width="600" height="250" allowfullscreen="" loading="lazy"></iframe>
      </div>
    </div>
  </main>
