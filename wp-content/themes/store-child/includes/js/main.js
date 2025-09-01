document.addEventListener("DOMContentLoaded", () => {

  // Sticky desktop menu
  window.onscroll = function() {
    const scrStickyDesktopMenu = window.pageYOffset || document.documentElement.scrollTop;
    const stickyDesktopMenu = document.querySelector('.sticky-desktop-menu');
    if (scrStickyDesktopMenu > 400) {
      stickyDesktopMenu.classList.add('active');
    }
    if (scrStickyDesktopMenu < 400) {
      stickyDesktopMenu.classList.remove('active');
    }
  }

  // To top кнопка вверх
  const toTop = document.getElementById("to-top");

  if (toTop) {

    const image = toTop.querySelector('.image');
    
    image.onclick = () => {
      scroll(0, 0);
    }

    // Показать to-top при скролле
    window.onscroll = () => {
      
      let scrToTop = window.scrollY || document.documentElement.scrollTop;

      if (scrToTop > 400) {
        toTop.classList.add('active');
      } else {
        toTop.classList.remove('active');
      }

    }

  }


  // Filter mobile
  const openFilterBtn = document.querySelector('.archive-product .open-filter-btn');

  if (openFilterBtn) {
    const filterForm = document.querySelector('.filter .form');

    openFilterBtn.onclick = function() {

      if(openFilterBtn.innerText == 'Открыть фильтр') {
        openFilterBtn.innerText = 'Скрыть фильтр';
      } else {
        openFilterBtn.innerText = 'Открыть фильтр';
      }

      filterForm.classList.toggle('active');
    }
  }


  // Отключение кнопок если только один товар
  const cartPage = document.querySelector('.cart-page');

  if (cartPage) {
    const qtys = cartPage.querySelectorAll('.quantity');

    qtys.forEach((item) => {
      const inputQty = item.querySelector('input.qty');

      if (inputQty.type == 'hidden') {
        item.querySelector('.minus').classList.add('hidden');
        item.querySelector('.plus').classList.add('hidden');
      }
    });
  }


  // Mobile menu
  const body = document.querySelector('body');
  const burgerMenuWrapper = document.querySelector('.burger-menu-wrapper');
  const mobileMenu = document.querySelector('.mobile-menu');

  function openMobileMenu() {
    body.classList.add('overflow-hidden');
    mobileMenu.classList.add('active');
    burgerMenuWrapper.classList.add('menu-is-open');
  }

  function closeMobileMenu() {
    body.classList.remove('overflow-hidden');
    burgerMenuWrapper.classList.remove('menu-is-open');
    mobileMenu.classList.remove('active');
  }

  burgerMenuWrapper.onclick = function() {
    if (burgerMenuWrapper.classList.contains('menu-is-open')) {
      closeMobileMenu();
    } else {
      openMobileMenu();
    }
  }

  const listParentClick = document.querySelectorAll('.mobile-menu li.menu-item a');

  for (let i=0; i < listParentClick.length; i++) {
    listParentClick[i].onclick = function (event) {
      event.preventDefault();
      closeMobileMenu();
      let hrefClick = this.href;
      setTimeout(function() {
        location.href = hrefClick
      }, 500);
    }
  }


  // Окна
  const modalWindows = document.querySelectorAll('.modal-window');
  const callbackFormBtns = document.querySelectorAll('.js-callback-form-btn');
  const callbackModal = document.querySelector('#callback-modal');
  const modalCloseBtns = document.querySelectorAll('.modal-window .modal-close');

  callbackFormBtns.forEach((item) => {
    item.onclick = function () {
      modalWindowOpen(callbackModal);
    }
  });
  
  function modalWindowOpen(win) {
    // Открытие окна
    body.classList.add('overflow-hidden');
    win.classList.add('active');
    setTimeout(function(){
      win.childNodes[1].classList.add('active');
    }, 200);
  }

  for (let i=0; i < modalCloseBtns.length; i++) {
    modalCloseBtns[i].onclick = function() {
      modalWindowClose(modalWindows[i]);
    }
  }

  for (let i = 0; i < modalWindows.length; i++) {
    modalWindows[i].onclick = function(event) {
      let classList = event.target.classList;
      for (let j = 0; j < classList.length; j++) {
        if (classList[j] == "modal" || classList[j] == "modal-wrapper" || classList[j] == "modal-window") {
          modalWindowClose(modalWindows[i])
        }
      }
    }
  }

  function modalWindowClose(win) {
    body.classList.remove('overflow-hidden');
    win.childNodes[1].classList.remove('active');
    setTimeout(() => {
      win.classList.remove('active');
    }, 300);
  }


  // Input phone mask
  function inputPhoneMask() {
    const elementPhone = document.querySelectorAll('.js-input-phone-mask');

    const maskOptionsPhone = {
      mask: '+{7} (000) 000 00 00'
    };

    elementPhone.forEach((item) => {
      const mask = IMask(item, maskOptionsPhone);
    });

    // Маска номера телефона на странице оформления заказа checkout billing billing_phone
    const billingPhone = document.getElementById('billing_phone');

    if (billingPhone) {
      const maskBillingPhone = IMask(billingPhone, maskOptionsPhone);
    }
  }

  inputPhoneMask();


  // Slim Select в карточке товара
  const singleProduct = document.querySelector('.single-product');

  if (singleProduct) {
    const paTabletkiPo = document.getElementById('pa_tabletki-po');
    const paTabletki = document.getElementById('pa_tabletki');

    if (paTabletkiPo) {
      new SlimSelect({
        select: '#pa_tabletki-po',
        showSearch: false,
        searchFocus: false,
      });
    }

    if (paTabletki) {
      new SlimSelect({
        select: '#pa_tabletki',
        showSearch: false,
        searchFocus: false,
      });
    }
    
  }


  // Set cookie
  function setCookie(name, value, days) {
    let expires = "";
    if (days) {
      let date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/" + "; sameSite=Lax;";
  }

  function getCookie(name) {
    let matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"));
    return matches ? decodeURIComponent(matches[1]) : undefined;
  }

  function checkCookies() {
    let cookieNote = document.querySelector('#cookie_note');
    let cookieBtnAccept = cookieNote.querySelector('#cookie_accept');

    // Если куки we-use-cookie нет или она просрочена, то показываем уведомление
    if (!getCookie('we-use-cookie')) {
      cookieNote.classList.add('active');
    }

    // При клике на кнопку устанавливаем куку we-use-cookie на один год
    cookieBtnAccept.addEventListener('click', function () {
      setCookie('we-use-cookie', 'true', 365);
      cookieNote.classList.remove('active');
    });
  }

  checkCookies();


  // AJAX фильтр товаров из подкатегорий на странице категории. На всех категориях кроме Гомеопатия term-id=438
  const filterBtns = document.querySelectorAll('.filter-btn');

  filterBtns.forEach((item) => {
    item.onclick = function() {

      // удаление active у всех кнопок
      for (var i = 0; i < filterBtns.length; i++) {
        filterBtns[i].classList.remove('active');
      }

      // добавление active у текущей кнопки
      item.classList.add('active');

      // Отключение плагина Load more products
      // Со включенным плагином подгружаются другие товары кроме отфильтрованных
      the_lmp_js_data = '';

      const products = document.querySelector('ul.products');
      
      // лоадер. селекторы от плагина load more products
      products.innerHTML = '<span class="lmp_products_loading"><i class="fa fa-spinner lmp_rotate"></i></span>';

      fetch(Myscrt.ajaxurl, {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        cache: 'no-cache',
        body: 'action=get_subcat&subcat_id=' + item.dataset.termId,
      })
      // вставка в ul.products
      .then((response) => response.text())
      .then((html) => {
        // если пришел html, то вставляю, иначе "Товаров не найдено"
        products.innerHTML = (html ? html : '<div class="no-found-product-text">Товаров не найдено</div>');
      })
      .catch((error) => {
        console.log(error);
      })
    }
  });

  // AJAX фильтр товаров в категории Гомеопатия term-id=438
  const filteredButtons = document.querySelectorAll('.js-filtered-button');

  filteredButtons.forEach((item) => {
    item.onclick = function() {

      // удаление active у всех кнопок
      for (var i = 0; i < filteredButtons.length; i++) {
        filteredButtons[i].classList.remove('active');
      }

      // добавление active у текущей кнопки
      item.classList.add('active');

      // Отключение плагина Load more products
      // Со включенным плагином подгружаются другие товары кроме отфильтрованных
      the_lmp_js_data = '';

      const products = document.querySelector('ul.products');
      
      // лоадер. селекторы от плагина load more products
      products.innerHTML = '<span class="lmp_products_loading"><i class="fa fa-spinner lmp_rotate"></i></span>';

      fetch(Myscrt.ajaxurl, {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        cache: 'no-cache',
        body: 'action=get_products_term_gomeopatiya&letter=' + item.value,
      })
      // вставка в ul.products
      .then((response) => response.text())
      .then((html) => {
        // если пришел html, то вставляю, иначе "Товаров не найдено"
        products.innerHTML = (html ? html : '<div class="no-found-product-text">Товаров не найдено</div>');
      })
      .catch((error) => {
        console.log(error);
      })

    }

  });


  // AJAX получение специалистов по городу
  const specialistyPage = document.querySelector('.specialisty-page');

  if (specialistyPage) {
    const cityBtns = document.querySelectorAll('.js-city-btn');

    cityBtns.forEach((item) => {
      item.onclick = function() {

        // удаление active у всех кнопок
        const citiesItems = document.querySelectorAll('.cities-item');
        for (var i = 0; i < citiesItems.length; i++) {
          citiesItems[i].classList.remove('active');
        }

        // добавление active у текущей кнопки
        item.classList.add('active');

        // удаление пагинации
        const pagination = document.querySelector('.specialisty-page .pagination');
        if (pagination) {
          pagination.innerHTML = '';
        }

        const specialists = document.querySelector('.specialisty-page .js-insert-specialists');
        
        // лоадер. селекторы от плагина load more products
        specialists.innerHTML = '<span class="lmp_products_loading"><i class="fa fa-spinner lmp_rotate"></i></span>';    

        fetch(Myscrt.ajaxurl, {
          method: 'POST',
          headers: {'Content-Type':'application/x-www-form-urlencoded'},
          cache: 'no-cache',
          body: 'action=get_specialists&cat_id=' + item.dataset.termId,
        })
        // вставка в specialists
        .then((response) => response.text())
        .then((html) => {
          // если пришел html, то вставляю, иначе "Товаров не найдено"
          specialists.innerHTML = (html ? html : '<div class="no-specialists-text">Специалистов не найдено</div>');
        })
        .catch((error) => {
          console.log(error);
        })
      }
    });
  }


  // AJAX фильтр городов на странице Где купить
  /*
  const wherebuyPage = document.querySelector('.wherebuy-page');

  if (wherebuyPage) {
    const cityBtns = document.querySelectorAll('.js-city-btn');
    const aItems = document.querySelectorAll('.js-a-item');

    cityBtns.forEach((item) => {
      item.onclick = function() {

        // удаление active у всех кнопок
        const citiesItems = document.querySelectorAll('.cities-item');
        for (var i = 0; i < citiesItems.length; i++) {
          citiesItems[i].classList.remove('active');
        }

        // добавление active у текущей кнопки
        item.classList.add('active');

        item.classList.add('active');

        for (var i = 0; i < aItems.length; i++) {
          aItems[i].classList.remove('hidden');
          if (item.dataset.name !== aItems[i].dataset.name) {
            aItems[i].classList.add('hidden');
          }
        }
      }
    });
  }
  */


  // AJAX Отправка формы Персональный рецепт на странице Лекарства
  const lekarstvaPage = document.querySelector('.lekarstva-page');

  if (lekarstvaPage) {

    const personalOrderForm = document.querySelector('#personal-order-form');
    const personalOrderSubmitBtn = document.querySelector('#personal-order-submit-btn');
    const inputFile = document.querySelector('#input-file');

    function ajaxCallback(form) {

      const inputs = form.querySelectorAll('.input-field');
      let arr = [];

      const inputName = form.querySelector('.js-required-name');
      if (inputName.value.length < 3 || inputName.value.length > 50) {
        inputName.classList.add('required');
        arr.push(false);
      } else {
        inputName.classList.remove('required');
      }

      const inputPhone = form.querySelector('.js-required-phone');
      if (inputPhone.value.length != 18) {
        inputPhone.classList.add('required');
        arr.push(false);
      } else {
        inputPhone.classList.remove('required');
      }

      const inputFile = form.querySelector('.js-required-file');
      if (inputFile.value == '') {
        inputFile.classList.add('required');
        arr.push(false);
      }

      const inputCheckboxes = form.querySelectorAll('.js-required-checkbox');
      inputCheckboxes.forEach((item) => {
        if (!item.checked) {
          arr.push(false);
        }
      });

      if (arr.length == 0) {
        for (let i = 0; i < inputs.length; i++) {
          inputs[i].classList.remove('required');
        }

        fetch('/wp-content/themes/store-child/phpmailer/sendform.php', {
          method: 'POST',
          cache: 'no-cache',
          body: new FormData(form)
        })
        .then((response) => response.text())
        .then((text) => {
          if(text) {
            console.log(text);
          } else {
            alert("Спасибо. Мы свяжемся с вами.");
            form.reset();
          }
        })
        .catch((error) => {
          console.log(error);
        })
        
      }

      return false;
    }

    inputFile.onchange = function() {
      if(this.files[0].size > 2097152) {
        alert("Ошибка. Загрузите файл не более 2МБ.");
        this.value = "";
      } else {
        const customInputfileLabelText = document.querySelector('#custom-inputfile-label-text');
        customInputfileLabelText.innerHTML = this.files[0].name;
      }
    };

    personalOrderSubmitBtn.onclick = function() {
      ajaxCallback(personalOrderForm);
    }

  }


  // AJAX обновление количество товара у значка корзины в хэдере и нижнем мобильном меню add to cart
  jQuery(document).ready(function($) {
    /**
     * jquery событие 'added_to_cart' в контексте woocommerce
     * Все события в /wp-content/plugins/woocommerce/assets/js/frontend
     * Vanilla javascript нет этого события
     * Если добавить событие click на кнопку добавления в корзину, то оно сработает раньше. В корзине будут прошлые значения
     */ 
    $(document.body).on('added_to_cart', function(){

      fetch(Myscrt.ajaxurl, {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        cache: 'no-cache',
        body: 'action=set_cart_counters',
      })
      .then((response) => response.json())
      .then((json) => {
        const headerCartCounter = document.querySelector('.header-cart__counter'); // счетчик товаров для значка корзины в хэдере
        const fixedBottomMenu = document.querySelector('.fixed-bottom-menu .badge-counter'); // счетчик товаров для значка корзины в нижнем меню
        headerCartCounter.innerText = json.count;
        fixedBottomMenu.innerText = json.count
      })
      .catch((error) => {
        console.log(error);
      })

    });
  });


  // AJAX Отправка формы Заказать звонок
  const callbackForm = document.getElementById('callback-modal-form');
  const callbackSubmitBtn = document.getElementById('callback-modal-btn');

  function ajaxCallback(form) {

    let arr = [];

    const inputName = form.querySelector('.js-required-name');
    if (inputName.value.length < 3 || inputName.value.length > 20) {
      inputName.classList.add('required');
      arr.push(false);
    } else {
      inputName.classList.remove('required');
    }

    const inputPhone = form.querySelector('.js-required-phone');
    if (inputPhone.value.length != 18) {
      inputPhone.classList.add('required');
      arr.push(false);
    } else {
      inputPhone.classList.remove('required');
    }

    const inputCheckboxes = form.querySelectorAll('.js-required-checkbox');
    inputCheckboxes.forEach((item) => {
      if (!item.checked) {
        arr.push(false);
      }
    });

    if (arr.length == 0) {

      fetch('/wp-content/themes/store-child/phpmailer/mailer.php', {
        method: 'POST',
        cache: 'no-cache',
        body: new FormData(form)
      })
      .catch((error) => {
        console.log(error);
      })

      alert("Спасибо. Мы свяжемся с вами.");

      form.reset();

    }

    return false;
  }

  if (callbackSubmitBtn) {
    callbackSubmitBtn.onclick = function() {
      ajaxCallback(callbackForm);
    }
  }


  // AJAX Отправка формы Стать партнером
  const partnerForm = document.getElementById('partner-form');
  const partnerSubmitBtn = document.getElementById('partner-submit-btn');

  function ajaxPartner(form) {

    let arr = [];

    const inputName = form.querySelector('.js-required-name');
    if (inputName.value.length < 3 || inputName.value.length > 50) {
      inputName.classList.add('required');
      arr.push(false);
    } else {
      inputName.classList.remove('required');
    }

    const inputSurname = form.querySelector('.js-required-surname');
    if (inputSurname.value.length < 3 || inputSurname.value.length > 50) {
      inputSurname.classList.add('required');
      arr.push(false);
    } else {
      inputSurname.classList.remove('required');
    }

    const inputCountry = form.querySelector('.js-required-country');
    if (inputCountry.value.length < 3 || inputCountry.value.length > 50) {
      inputCountry.classList.add('required');
      arr.push(false);
    } else {
      inputCountry.classList.remove('required');
    }

    const inputCity = form.querySelector('.js-required-city');
    if (inputCity.value.length < 3 || inputCity.value.length > 50) {
      inputCity.classList.add('required');
      arr.push(false);
    } else {
      inputCity.classList.remove('required');
    }

    const inputPhone = form.querySelector('.js-required-phone');
    if (inputPhone.value.length != 18) {
      inputPhone.classList.add('required');
      arr.push(false);
    } else {
      inputPhone.classList.remove('required');
    }

    const inputEmail = form.querySelector('.js-required-email');
    if (inputEmail.value.length < 3 || inputEmail.value.length > 50) {
      inputEmail.classList.add('required');
      arr.push(false);
    } else {
      inputEmail.classList.remove('required');
    }

    const inputCheckboxes = form.querySelectorAll('.js-required-checkbox');
    inputCheckboxes.forEach((item) => {
      if (!item.checked) {
        arr.push(false);
      }
    });

    if (arr.length == 0) {

      fetch('/wp-content/themes/store-child/phpmailer/partner.php', {
        method: 'POST',
        cache: 'no-cache',
        body: new FormData(form)
      })
      .catch((error) => {
        console.log(error);
      })

      alert("Спасибо. Мы свяжемся с вами.");

      form.reset();

    }

    return false;
  }

  if (partnerSubmitBtn) {
    partnerSubmitBtn.onclick = function() {
      ajaxPartner(partnerForm);
    }
  }


  // AJAX Отправка формы White label
  const whiteLabelForm = document.getElementById('white-label-form');
  const whiteLabelSubmitBtn = document.getElementById('white-label-submit-btn');

  function ajaxWhiteLabel(form) {

    let arr = [];

    const inputName = form.querySelector('.js-required-name');
    if (inputName.value.length < 3 || inputName.value.length > 50) {
      inputName.classList.add('required');
      arr.push(false);
    } else {
      inputName.classList.remove('required');
    }

    const inputPhone = form.querySelector('.js-required-phone');
    if (inputPhone.value.length != 18) {
      inputPhone.classList.add('required');
      arr.push(false);
    } else {
      inputPhone.classList.remove('required');
    }

    const inputEmail = form.querySelector('.js-required-email');
    if (inputEmail.value.length < 3 || inputEmail.value.length > 50) {
      inputEmail.classList.add('required');
      arr.push(false);
    } else {
      inputEmail.classList.remove('required');
    }

    const inputCheckboxes = form.querySelectorAll('.js-required-checkbox');
    inputCheckboxes.forEach((item) => {
      if (!item.checked) {
        arr.push(false);
      }
    });

    if (arr.length == 0) {

      fetch('/wp-content/themes/store-child/phpmailer/whitelabel.php', {
        method: 'POST',
        cache: 'no-cache',
        body: new FormData(form)
      })
      .catch((error) => {
        console.log(error);
      })

      alert("Спасибо. Мы свяжемся с вами.");

      form.reset();

    }

    return false;
  }

  if (whiteLabelSubmitBtn) {
    whiteLabelSubmitBtn.onclick = function() {
      ajaxWhiteLabel(whiteLabelForm);
    }
  }


  // AJAX отправка формы Записаться на консультацию на странице специалиста
  const lfsForm = document.getElementById('lfs-form');
  const lfsSubmitBtn = document.getElementById('lfs-submit-btn');

  function ajaxLfs(form) {

    let arr = [];

    const inputName = form.querySelector('.js-required-name');
    if (inputName.value.length < 3 || inputName.value.length > 50) {
      inputName.classList.add('required');
      arr.push(false);
    } else {
      inputName.classList.remove('required');
    }

    const inputSurname = form.querySelector('.js-required-surname');
    if (inputSurname.value.length < 3 || inputSurname.value.length > 50) {
      inputSurname.classList.add('required');
      arr.push(false);
    } else {
      inputSurname.classList.remove('required');
    }

    const inputPhone = form.querySelector('.js-required-phone');
    if (inputPhone.value.length != 18) {
      inputPhone.classList.add('required');
      arr.push(false);
    } else {
      inputPhone.classList.remove('required');
    }

    const inputEmail = form.querySelector('.js-required-email');
    if (inputEmail.value.length < 3 || inputEmail.value.length > 30) {
      inputEmail.classList.add('required');
      arr.push(false);
    } else {
      inputEmail.classList.remove('required');
    }

    const inputCheckbox = form.querySelector('.js-required-checkbox');
    if (!inputCheckbox.checked) {
      arr.push(false);
    }

    if (arr.length == 0) {

      fetch('/wp-content/themes/store-child/phpmailer/specialist.php', {
        method: 'POST',
        cache: 'no-cache',
        body: new FormData(form)
      })
      .catch((error) => {
        console.log(error);
      })

      alert("Спасибо. Мы свяжемся с вами.");

      form.reset();

    }

    return false;
  }

  if (lfsSubmitBtn) {
    lfsSubmitBtn.onclick = function() {
      ajaxLfs(lfsForm);
    }
  }

  // Аккордеон на странице Частые вопрос faq-page
  /*
  const faqPage = document.querySelector('.faq-page');

  if (faqPage) {
    const accordeonItems = document.querySelectorAll('.accordeon-item');

    accordeonItems.forEach((item) => {
      const accordeonItemTitle = item.querySelector('.accordeon-item-title');

      accordeonItemTitle.onclick = function () {
        item.classList.toggle('active');
      }
    });
  }
  */

});