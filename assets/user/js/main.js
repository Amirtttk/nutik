/////////////////////////////////////// open search box + Ctrl+K shortcut
if (document.getElementById("search-input")) {
  const searchInput = document.getElementById("search-input");
  const searchDropdown = document.getElementById("search-dropdown");
  const searchContainer = document.getElementById("search-container");
  const searchBackdrop = document.getElementById("search-backdrop");
  const toggleTypingState = () => {
    searchContainer.classList.toggle("is-typing", searchInput.value.trim().length > 0);
  };
  const focusSearchInput = () => {
    if (window.getComputedStyle(searchInput).display === "none") return false;
    searchInput.focus();
    searchDropdown.classList.remove("opacity-0", "scale-95", "pointer-events-none");
    searchBackdrop.classList.remove("opacity-0", "pointer-events-none");
    return true;
  };
  searchInput.addEventListener("focus", () => {
    searchDropdown.classList.remove("opacity-0", "scale-95", "pointer-events-none");
    searchBackdrop.classList.remove("opacity-0", "pointer-events-none");
  });
  searchInput.addEventListener("input", toggleTypingState);
  toggleTypingState();
  document.addEventListener("click", (e) => {
    if (searchBackdrop.contains(e.target)) {
      searchBackdrop.classList.add("opacity-0", "pointer-events-none");
      searchDropdown.classList.add("opacity-0", "scale-95", "pointer-events-none");
    }
    if (!searchContainer.contains(e.target)) {
      searchDropdown.classList.add("opacity-0", "scale-95", "pointer-events-none");
    }
  });
  document.addEventListener("keydown", (e) => {
    if (!(e.ctrlKey || e.metaKey) || e.key.toLowerCase() !== "k") return;
    e.preventDefault();
    if (focusSearchInput()) return;
    const mobileSearchBtn = document.getElementById("mobileSearchBtn");
    const fullSearchInput = document.getElementById("fullSearchInput");
    if (mobileSearchBtn && fullSearchInput) {
      mobileSearchBtn.click();
      setTimeout(() => fullSearchInput.focus(), 320);
    }
  });
}
//////////////////////////////////////////// open and close mobile navbar
if (document.getElementById("mobile-menu")) {
  document.addEventListener("DOMContentLoaded", function () {
    const menu = document.getElementById("mobile-menu");
    const overlay = document.getElementById("overlay");
    const openBtn = document.querySelector(".menu-mobile");
    function openMenu() {
      menu.classList.remove("translate-x-full");
      overlay.classList.remove("hidden");
      overlay.classList.add("opacity-100");
    }
    function closeMenu() {
      menu.classList.add("translate-x-full");
      overlay.classList.add("hidden");
      overlay.classList.remove("opacity-100");
    }
    openBtn.addEventListener("click", openMenu);
    overlay.addEventListener("click", closeMenu);
  });
  document.querySelectorAll("#mobile-menu ul li a").forEach((item) => {
    item.addEventListener("click", () => {
      const menu = document.getElementById("mobile-menu");
      const overlay = document.getElementById("overlay");
      menu.classList.add("translate-x-full");
      overlay.classList.add("hidden");
      overlay.classList.remove("opacity-100");
    });
  });
}
////////////////////////////// btn category desktop
const categoriesItem = document.querySelectorAll(".category-item");
const subcategories = document.querySelectorAll(".subcategory-item");
categoriesItem.forEach(cat => {
  cat.addEventListener("mouseenter", () => {
    const category = cat.getAttribute("data-category");
    subcategories.forEach(sub => {
      sub.classList.add("hidden");
      if (sub.getAttribute("data-parent") === category) {
        sub.classList.remove("hidden");
      }
    });
  });
});
/////////////////////////////////////// Quantity input
const minusIcon = `
<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
    <path class="stroke-zinc-600" d="M6 12H18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>`;
const trashIcon = `
<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
    <path class="stroke-red-500" fill-rule="evenodd" clip-rule="evenodd" d="M15.7628 9H7.63719C7.18864 9 6.82501 9.37295 6.82501 9.833V16.5C6.82501 17.8807 7.91632 19 9.26251 19H14.1375C14.784 19 15.404 18.7366 15.8611 18.2678C16.3182 17.7989 16.575 17.163 16.575 16.5V9.833C16.575 9.37295 16.2114 9 15.7628 9Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path class="stroke-red-500" fill-rule="evenodd" clip-rule="evenodd" d="M14.625 7L13.9191 5.553C13.7541 5.21427 13.4167 5.0002 13.0475 5H10.3526C9.98338 5.0002 9.64596 5.21427 9.48092 5.553L8.77502 7H14.625Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path class="fill-red-500" d="M10.8247 12.333C10.8247 11.9188 10.4889 11.583 10.0747 11.583C9.66047 11.583 9.32469 11.9188 9.32469 12.333H10.8247ZM9.32469 15.666C9.32469 16.0802 9.66047 16.416 10.0747 16.416C10.4889 16.416 10.8247 16.0802 10.8247 15.666H9.32469ZM14.0753 12.333C14.0753 11.9188 13.7396 11.583 13.3253 11.583C12.9111 11.583 12.5753 11.9188 12.5753 12.333H14.0753ZM12.5753 15.666C12.5753 16.0802 12.9111 16.416 13.3253 16.416C13.7396 16.416 14.0753 16.0802 14.0753 15.666H12.5753ZM14.625 6.25C14.2108 6.25 13.875 6.58579 13.875 7C13.875 7.41421 14.2108 7.75 14.625 7.75V6.25ZM16.575 7.75C16.9892 7.75 17.325 7.41421 17.325 7C17.325 6.58579 16.9892 6.25 16.575 6.25V7.75ZM8.77501 7.75C9.18923 7.75 9.52501 7.41421 9.52501 7C9.52501 6.58579 9.18923 6.25 8.77501 6.25V7.75ZM6.82501 6.25C6.4108 6.25 6.07501 6.58579 6.07501 7C6.07501 7.41421 6.4108 7.75 6.82501 7.75V6.25ZM9.32469 12.333V15.666H10.8247V12.333H9.32469ZM12.5753 12.333V15.666H14.0753V12.333H12.5753ZM14.625 7.75H16.575V6.25H14.625V7.75ZM8.77501 6.25H6.82501V7.75H8.77501V6.25Z"/>
</svg>`;
function updateDecrementIcon(button, value) {
    button.innerHTML = value <= 1 ? trashIcon : minusIcon;
}
document.querySelectorAll(".quantity-counter").forEach(counter => {
    const input = counter.querySelector('input[type="number"]');
    const incrementBtn = counter.querySelector('[data-action="increment"]');
    const decrementBtn = counter.querySelector('[data-action="decrement"]');
    updateDecrementIcon(decrementBtn, Number(input.value));
    incrementBtn.addEventListener("click", () => {
        let value = Number(input.value) + 1;
        input.value = value;
        updateDecrementIcon(decrementBtn, value);
        input.dispatchEvent(new Event("change", { bubbles: true }));
    });
    decrementBtn.addEventListener("click", () => {
        let value = Number(input.value);
        if (value > 1) {
            value--;
            input.value = value;
            updateDecrementIcon(decrementBtn, value);

            input.dispatchEvent(new Event("change", { bubbles: true }));
        } else {
            // counter.closest('.cart-item').remove();
            console.log("Remove product");
        }
    });
});
//////////////////////////////////////////// open and close mobile navbar
document.addEventListener("DOMContentLoaded", function () {
  const menu = document.getElementById("mobile-menu");
  const overlay = document.getElementById("overlay");
  const openBtn = document.querySelector(".menu-mobile");
  function openMenu() {
    menu.classList.remove("translate-x-full");
    overlay.classList.remove("hidden");
    overlay.classList.add("opacity-100");
  }
  function closeMenu() {
    menu.classList.add("translate-x-full");
    overlay.classList.add("hidden");
    overlay.classList.remove("opacity-100");
  }
  if (openBtn){
    openBtn.addEventListener("click", openMenu);
    overlay.addEventListener("click", closeMenu);
  }
});
//////////////////////////////////////////// open and close menu/submenu mobile
document.addEventListener("DOMContentLoaded", function () {
  const menuToggles = document.querySelectorAll(".menu-toggle");
  menuToggles.forEach((toggle) => {
    toggle.addEventListener("click", function (e) {
      e.preventDefault();
      e.stopPropagation();
      const submenu = this.nextElementSibling ||
        this.parentElement?.nextElementSibling ||
        this.closest("li")?.querySelector(".submenu");
      const icon = this.querySelector("img") || this.querySelector("svg");
      if (!submenu) return;
      if (submenu.classList.contains("hidden")) {
        submenu.classList.remove("hidden");
        if (icon) icon.classList.add("rotate-180");
      } else {
        submenu.classList.add("hidden");
        if (icon) icon.classList.remove("rotate-180");
      }
    });
  });
});
/////////////////////////////////////// show and hide header desktop in scroll
if (document.getElementById("stickyDiv")) {
  const stickyDiv = document.getElementById("stickyDiv");
  const placeholder1 = document.getElementById("stickyPlaceholder");
  const stickySub = document.getElementById("stickySub");
  const placeholder2 = document.getElementById("stickySubPlaceholder");
  const stickyTop = stickyDiv.offsetTop;
  const subTop = stickySub.offsetTop;
  let lastScroll = window.scrollY;
  let lastScrolled = 0;
    window.addEventListener("scroll", () => {
      let current = window.scrollY;
      if (current > lastScrolled) {
        stickySub.style.top = "0";
      } else {
        stickySub.style.top = "80px";
      }
      lastScrolled = current;
    });
  window.addEventListener("scroll", () => {
    const sc = window.scrollY;
    if (sc >= stickyTop) {
      stickyDiv.classList.add("fixed", "top-0", "left-0", "right-0", "w-full");
      placeholder1.style.height = stickyDiv.offsetHeight + "px";
    } else {
      stickyDiv.classList.remove("fixed", "top-0", "left-0", "right-0", "w-full");
      placeholder1.style.height = "0px";
    }
    const stickyDivHeight = stickyDiv.offsetHeight;
    if (sc >= subTop - stickyDivHeight) {
      stickySub.classList.add("fixed", "left-0", "right-0", "w-full");
      placeholder2.style.height = stickySub.offsetHeight + "px";
    } else {
      stickySub.classList.remove("fixed", "left-0", "right-0", "w-full");
      placeholder2.style.height = "0px";
    }
    lastScroll = sc;
  });
}
/////////////////////////////////////// verify 6 code
if (document.querySelector('input.code-input')) {
  const inputElements = [...document.querySelectorAll('input.code-input')]
  if (inputElements) {
    window.addEventListener("load", () => inputElements[0].focus());
    inputElements.forEach((ele,index)=>{
      ele.addEventListener('keydown',(e)=>{
        if(e.keyCode === 8 && e.target.value==='') inputElements[Math.max(0,index-1)].focus()
      })
      ele.addEventListener('input',(e)=>{
        const [first,...rest] = e.target.value
        e.target.value = first ?? ''
        const lastInputBox = index===inputElements.length-1
        const didInsertContent = first!==undefined
        if(didInsertContent && !lastInputBox) {
          inputElements[index+1].focus()
          inputElements[index+1].value = rest.join('')
          inputElements[index+1].dispatchEvent(new Event('input'))
        }
      })
    })
  }
  function onSubmit(e){
    e.preventDefault()
    const code = inputElements.map(({value})=>value).join('')
    console.log(code)
  }
}
////////////////////////////////////////// modal
document.querySelectorAll(".open-modal").forEach((button) => {
  button.addEventListener("click", () => {
    const modalId = button.getAttribute("data-modal");
    const modal = document.getElementById(modalId);
    const modalBox = modal.querySelector(".modal-box");

    modal.classList.remove("hidden");
    setTimeout(() => {
      modal.classList.add("opacity-100");
      modalBox.classList.remove("opacity-0", "scale-90");
    }, 10);
  });
});
document.querySelectorAll(".close-modal").forEach((button) => {
  button.addEventListener("click", () => {
    const modal = button.closest(".modal");
    const modalBox = modal.querySelector(".modal-box");
    modal.classList.remove("opacity-100");
    modalBox.classList.add("opacity-0", "scale-90");
    setTimeout(() => modal.classList.add("hidden"), 300);
  });
});
document.querySelectorAll(".modal").forEach((modal) => {
  modal.addEventListener("click", (e) => {
    if (e.target === modal) {
      const modalBox = modal.querySelector(".modal-box");
      modal.classList.remove("opacity-100");
      modalBox.classList.add("opacity-0", "scale-90");
      setTimeout(() => modal.classList.add("hidden"), 300);
    }
  });
});
/////////////////////////////////////// open filter in search products
if (document.getElementById("mobile-filter")) {
  const filters = document.getElementById("mobile-filter");
  const openFilter = document.querySelector(".filter-mobile");
  const closeFilter = document.getElementById("closeFilter");
  function openMenu() {
    filters.classList.remove("translate-y-full");
  }
  function closeMenu() {
    filters.classList.add("translate-y-full");
  }
  openFilter.addEventListener("click", openMenu);
  closeFilter.addEventListener("click", closeMenu);
}
/////////////////////////////////////// price filter
if (document.getElementById('priceSlider')) {
  const slider = document.getElementById('priceSlider');
  const minLabel = document.getElementById('minLabel');
  const maxLabel = document.getElementById('maxLabel');
  noUiSlider.create(slider, {
    start: [0, 5000000],
    connect: true,
    direction: 'rtl',
    range: {
      min: 0,
      max: 10000000
    },
    step: 1000,
    format: {
      to: v => Math.round(v),
      from: v => Number(v)
    }
  });
  slider.noUiSlider.on('update', (values) => {
    const nums = values.map(Number);
    const min = Math.min(...nums);
    const max = Math.max(...nums);
    minLabel.textContent = `${min.toLocaleString()} تومان`;
    maxLabel.textContent = `${max.toLocaleString()} تومان`;
  });
}
/////////////////////////////////////// copy link page to clipboard
if(document.getElementById("copyBtn")){
  const copyBtn = document.getElementById("copyBtn");
  const copyTarget = document.getElementById("copyTarget");
  const copyIcon = document.getElementById("copyIcon");
  const copyText = document.getElementById("copyText");
  const defaultIcon = copyIcon.innerHTML;
  const successIcon = `
    <path d="M5 13l4 4L19 7"
      stroke="currentColor"
      stroke-width="2"
      stroke-linecap="round"
      stroke-linejoin="round" />
  `;
  copyBtn.addEventListener("click", async () => {
    try {
      await navigator.clipboard.writeText(copyTarget.innerText.trim());
      copyIcon.innerHTML = successIcon;
      copyIcon.classList.add("text-green-600");
      copyText.innerText = "کپی شد";
      setTimeout(() => {
        copyIcon.innerHTML = defaultIcon;
        copyIcon.classList.remove("text-green-600");
        copyText.innerText = "کپی کردن لینک";
        }, 3000);
    } catch (err) {
    }
  });
}
/////////////////////////////////////// product image in single product
if (document.getElementById('mainImage')) {
  const mainImage = document.getElementById('mainImage');
  const zoomBox = document.getElementById('zoomBox');
  const zoomLens = document.getElementById('zoomLens');
  const wrapper = document.getElementById('imageWrapper');
  
  function isMobile() {
    return window.innerWidth <= 768;
  }
  
  mainImage.addEventListener('mousemove', (e) => {
    if (isMobile()) return;
  
    const rect = wrapper.getBoundingClientRect();
    const lensSize = zoomLens.offsetWidth;
    const zoomLevel = 2;
  
    let x = e.clientX - rect.left - lensSize / 2;
    let y = e.clientY - rect.top - lensSize / 2;
  
    x = Math.max(0, Math.min(x, rect.width - lensSize));
    y = Math.max(0, Math.min(y, rect.height - lensSize));
  
    zoomLens.style.left = x + 'px';
    zoomLens.style.top = y + 'px';
  
    zoomBox.style.backgroundImage = `url(${mainImage.src})`;
    zoomBox.style.backgroundSize =
      `${rect.width * zoomLevel}px ${rect.height * zoomLevel}px`;
    zoomBox.style.backgroundPosition =
      `-${x * zoomLevel}px -${y * zoomLevel}px`;
  
    zoomLens.classList.remove('hidden');
    zoomBox.classList.remove('hidden');
  });
  
  mainImage.addEventListener('mouseleave', () => {
    zoomLens.classList.add('hidden');
    zoomBox.classList.add('hidden');
  });
  
  function changeImage(el) {
    mainImage.src = el.src;
  }
  
}
/////////////////////////////////////// Quantity input single product
if(document.getElementById("addToCartBtnUnique")){
  document.querySelectorAll('[id="addToCartBtnUnique"]').forEach((addToCartBtn) => {
    const wrapper = addToCartBtn.parentElement;
    const counterWrapper = wrapper.querySelector('#counterWrapperUnique');
    const incrementBtn  = wrapper.querySelector('#incrementBtnUnique');
    const decrementBtn  = wrapper.querySelector('#decrementBtnUnique');
    const counterInput  = wrapper.querySelector('#counterInputUnique');
  
    let count = 1;
  
    addToCartBtn.addEventListener("click", function (e) {
      e.preventDefault();
      addToCartBtn.classList.add("hidden");
      counterWrapper.classList.remove("hidden");
      count = 1;
      counterInput.value = count;
    });
  
    incrementBtn.addEventListener("click", function () {
      count++;
      counterInput.value = count;
    });
  
    decrementBtn.addEventListener("click", function () {
      count--;
      if (count < 1) {
        counterWrapper.classList.add("hidden");
        addToCartBtn.classList.remove("hidden");
        count = 1;
      }
      counterInput.value = count;
    });
  });
}
/////////////////////////////////////// star rating
const stars = document.querySelectorAll('#rating .star');
  const ratingValue = document.getElementById('ratingValue');
  let currentRating = 0;
  function updateStars(value) {
    stars.forEach(s => {
      if (parseInt(s.dataset.value) <= value) {
        s.classList.remove('text-gray-300');
        s.classList.add('text-yellow-400');
      } else {
        s.classList.remove('text-yellow-400');
        s.classList.add('text-gray-300');
      }
    });
  }
  stars.forEach(star => {
    star.addEventListener('click', () => {
      currentRating = parseInt(star.dataset.value);
      ratingValue.textContent = currentRating;
      updateStars(currentRating);
    });
    star.addEventListener('mouseenter', () => {
      const hoverValue = parseInt(star.dataset.value);
      updateStars(hoverValue);
    });
    star.addEventListener('mouseleave', () => {
      updateStars(currentRating);
    });
  });
/////////////////////////////////////////////// showMoreText
function showMoreText() {
  document.getElementById("moreText").style.display = "block";
}
/////////////////////////////////////// tabs
document.querySelectorAll('.dt-tabs').forEach(wrapper => {
  const buttons = wrapper.querySelectorAll('.dt-tab-btn');
  const panels = wrapper.querySelectorAll('.dt-tab-panel');

  buttons.forEach(btn => {
    btn.addEventListener('click', () => {
      const key = btn.dataset.dtTab;

      // reset buttons
      buttons.forEach(b => b.removeAttribute('data-active'));
      btn.setAttribute('data-active', 'true');

      // reset panels
      panels.forEach(p => p.classList.add('hidden'));
      wrapper
        .querySelector(`[data-dt-panel="${key}"]`)
        .classList.remove('hidden');
    });
  });
});
/////////////////////////////////////// animated tabs
if (document.querySelector(".tab_reel")) {
    const reel = document.querySelector(".tab_reel");
    const tabs = document.querySelectorAll(".tab");
    tabs.forEach((tab, index) => {
        tab.addEventListener("click", () => {
            tabs.forEach(item => item.classList.remove("activeTabPanel"));
            tab.classList.add("activeTabPanel");
            reel.style.transform = `translateX(${index * 50}%)`;
        });
    });
}
/////////////////////////////////////// showMoreInfo
function showMoreInfo(event) {
    event.preventDefault();
    const moreText = document.getElementById("moreText");
    moreText.style.overflow = "hidden";
    moreText.style.maxHeight = "0";
    moreText.style.opacity = "0";
    moreText.style.transition = "max-height .5s ease, opacity .5s ease";
    requestAnimationFrame(() => {
        moreText.style.maxHeight = moreText.scrollHeight + "px";
        moreText.style.opacity = "1";
    });
    setTimeout(() => {
        moreText.scrollIntoView({
            behavior: "smooth",
            block: "start"
        });
    }, 150);
}
///////////////////////////////// show and hide box reservation
if (document.getElementById("reserveType")) {
  const reserveType = document.getElementById("reserveType");
  const inBox = document.getElementById("inBox");
  const phoBox = document.getElementById("phoBox");
  function changeReserveType() {
    if (reserveType.value === "in") {
        inBox.classList.remove("hidden");
        phoBox.classList.add("hidden");
    } else {
        phoBox.classList.remove("hidden");
        inBox.classList.add("hidden");
    }
  }
  reserveType.addEventListener("change", changeReserveType);
  changeReserveType();
}
////////////////////////////////// form steps
const steps = document.querySelectorAll(".step");
const indicators = document.querySelectorAll(".step-item");

let currentStep = 0;

function showStep(index){

    steps.forEach((step,i)=>{
        step.classList.toggle("active", i===index);
    });

    indicators.forEach((item,i)=>{
        item.classList.toggle("active", i===index);
    });

}

document.querySelectorAll(".nextBtn").forEach(btn=>{

    btn.addEventListener("click",()=>{

        if(currentStep < steps.length-1){
            currentStep++;
            showStep(currentStep);
        }

    });

});

document.querySelectorAll(".prevBtn").forEach(btn=>{

    btn.addEventListener("click",()=>{

        if(currentStep > 0){
            currentStep--;
            showStep(currentStep);
        }

    });

});

showStep(currentStep);
//////////////////////////////////// chart dashboard Details Info
if (document.getElementById('salesChart')) {
  const ctx = document.getElementById('salesChart');
  
  new Chart(ctx,{
      type:'line',
  
      data:{
          labels:[
              '1405/05/02',
              '1405/05/04',
              '1405/05/08',
              '1405/05/14',
              '1405/05/29',
              '1405/05/02'
          ],
  
          datasets:[{
  
              label:'کیلوگرم',
  
              data:[
                  65,
                  67,
                  69,
                  75,
                  76,
                  79
              ],
  
              borderColor:'#3B82F6',
  
              borderWidth:3,
  
              tension:.45,
  
              fill:true,
  
              backgroundColor:(context)=>{
  
                  const chart=context.chart;
                  const {ctx,chartArea}=chart;
  
                  if(!chartArea) return null;
  
                  const gradient=ctx.createLinearGradient(
                      0,
                      chartArea.top,
                      0,
                      chartArea.bottom
                  );
  
                  gradient.addColorStop(0,'rgba(59,130,246,.30)');
                  gradient.addColorStop(1,'rgba(59,130,246,0)');
  
                  return gradient;
              },
  
              pointRadius:5,
  
              pointHoverRadius:7,
  
              pointBackgroundColor:'#fff',
  
              pointBorderColor:'#3B82F6',
  
              pointBorderWidth:3
  
          }]
      },
  
      options:{
  
          responsive:true,
  
          maintainAspectRatio:false,
  
          plugins:{
              legend:{
                  display:false
              }
          },
  
          interaction:{
              intersect:false,
              mode:'index'
          },
  
          scales:{
  
              x:{
                  grid:{
                      display:false
                  },
                  ticks:{
                      color:'#777',
                      font:{
                          size:13
                      }
                  }
              },
  
              y:{
                  beginAtZero:true,
  
                  ticks:{
                      color:'#777'
                  },
  
                  grid:{
                      color:'rgba(0,0,0,.05)',
                      drawBorder:false
                  }
              }
  
          }
  
      }
  
  });
}
let domain = window.location.origin + "/";

function createContactus() {
  let nameAndFamily = $('input[name="nameAndFamily"]').val(),
      mobile = $('input[name="mobile"]').val(),
      text = $('textarea[name="text"]').val(),
      getErrors = document.getElementById("getErrors");
  $.ajax({
    url: `${domain}requests/contactUs/create.php`,
    type: "POST",
    data: {
      nameAndFamily,
      mobile,
      text
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        setTimeout(() => location.replace("contactUs"), 3000);
      } else {
        getErrors.innerHTML = response.error;
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        scroll(5000, 200);
      }
    },
  });
}
function createCommet(product) {
  let text = $('textarea[name="text"]').val(),
      nameAndFamily = $('input[name="nameAndFamily"]').val(),
      getErrors = document.getElementById("getErrors");
  $.ajax({
    url: `${domain}requests/comment/create.php`,
    type: "POST",
    data: {
      text,
      nameAndFamily,
      product
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.status == 200) {
        getErrors.innerHTML = "";
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
      } else {
        getErrors.innerHTML = response.error;
        Toast.fire({
          icon: response.type,
          title: response.text,
        });
        scroll(150, 600);
      }
    },
  });
}

