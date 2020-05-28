   
   $(document).ready(function()
   {
      $("a[href*='#header']").click(function(event)
      {
         event.preventDefault();
         $('html, body').stop().animate({ scrollTop: $('#wb_header').offset().top }, 600, 'easeOutSine');
      });
      $(document).on('click','.ThemeableMenu1-navbar-collapse.in',function(e)
      {
         if ($(e.target).is('a') && ($(e.target).attr('class') != 'dropdown-toggle')) 
         {
            $(this).collapse('hide');
         }
      });
      $("#LayoutGrid6").submit(function(event)
      {
         var isValid = $.validate.form(this);
         return isValid;
      });
      $("a[href*='#LayoutGrid6']").click(function(event)
      {
         event.preventDefault();
         $('html, body').stop().animate({ scrollTop: $('#wb_LayoutGrid6').offset().top }, 600, 'linear');
      });
      $("#Name").validate(
      {
         required: true,
         bootstrap: true,
         type: 'custom',
         param: /^[A-Za-zАБВГДЕЖЗИЙКЛМНОПРСТУФХЦШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцшщъыьэюя \t\r\n\f]*$/,
         length_min: '1',
         length_max: '15',
         color_text: '#000000',
         color_hint: '#00FF00',
         color_error: '#FF0000',
         color_border: '#808080',
         nohint: false,
         font_family: 'Arial',
         font_size: '13px',
         position: 'topleft',
         offsetx: 0,
         offsety: 0,
         effect: 'none',
         error_text: ''
      });
      $("#phone").validate(
      {
         required: true,
         bootstrap: true,
         type: 'number',
         expr_min: '',
         expr_max: '',
         value_min: '',
         value_max: '',
         length_min: '1',
         length_max: '12',
         color_text: '#000000',
         color_hint: '#00FF00',
         color_error: '#FF0000',
         color_border: '#808080',
         nohint: false,
         font_family: 'Arial',
         font_size: '13px',
         position: 'topleft',
         offsetx: 0,
         offsety: 0,
         effect: 'none',
         error_text: ''
      });
      $("#LayoutGrid18").submit(function(event)
      {
         var isValid = $.validate.form(this);
         return isValid;
      });
      $("#Editbox1").validate(
      {
         required: true,
         bootstrap: true,
         type: 'custom',
         param: /^[A-Za-zАБВГДЕЖЗИЙКЛМНОПРСТУФХЦШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцшщъыьэюя \t\r\n\f]*$/,
         length_min: '1',
         length_max: '15',
         color_text: '#000000',
         color_hint: '#00FF00',
         color_error: '#FF0000',
         color_border: '#808080',
         nohint: false,
         font_family: 'Arial',
         font_size: '13px',
         position: 'topleft',
         offsetx: 0,
         offsety: 0,
         effect: 'none',
         error_text: ''
      });
      $("#Editbox2").validate(
      {
         required: true,
         bootstrap: true,
         type: 'number',
         expr_min: '',
         expr_max: '',
         value_min: '',
         value_max: '',
         length_min: '1',
         length_max: '12',
         color_text: '#000000',
         color_hint: '#00FF00',
         color_error: '#FF0000',
         color_border: '#808080',
         nohint: false,
         font_family: 'Arial',
         font_size: '13px',
         position: 'topleft',
         offsetx: 0,
         offsety: 0,
         effect: 'none',
         error_text: ''
      });
      $("#LayoutGrid25").submit(function(event)
      {
         var isValid = $.validate.form(this);
         return isValid;
      });
      $("#Editbox3").validate(
      {
         required: true,
         bootstrap: true,
         type: 'custom',
         param: /^[A-Za-zАБВГДЕЖЗИЙКЛМНОПРСТУФХЦШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцшщъыьэюя \t\r\n\f]*$/,
         length_min: '1',
         length_max: '15',
         color_text: '#000000',
         color_hint: '#00FF00',
         color_error: '#FF0000',
         color_border: '#808080',
         nohint: false,
         font_family: 'Arial',
         font_size: '13px',
         position: 'topleft',
         offsetx: 0,
         offsety: 0,
         effect: 'none',
         error_text: ''
      });
      $("#Editbox4").validate(
      {
         required: true,
         bootstrap: true,
         type: 'number',
         expr_min: '',
         expr_max: '',
         value_min: '',
         value_max: '',
         length_min: '1',
         length_max: '12',
         color_text: '#000000',
         color_hint: '#00FF00',
         color_error: '#FF0000',
         color_border: '#808080',
         nohint: false,
         font_family: 'Arial',
         font_size: '13px',
         position: 'topleft',
         offsetx: 0,
         offsety: 0,
         effect: 'none',
         error_text: ''
      });
      $("#Editbox5").validate(
      {
         required: true,
         bootstrap: true,
         type: 'custom',
         param: /^[A-Za-zАБВГДЕЖЗИЙКЛМНОПРСТУФХЦШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцшщъыьэюя \t\r\n\f]*$/,
         length_min: '1',
         length_max: '15',
         color_text: '#000000',
         color_hint: '#00FF00',
         color_error: '#FF0000',
         color_border: '#808080',
         nohint: false,
         font_family: 'Arial',
         font_size: '13px',
         position: 'topleft',
         offsetx: 0,
         offsety: 0,
         effect: 'none',
         error_text: ''
      });
      $("#Editbox6").validate(
      {
         required: true,
         bootstrap: true,
         type: 'custom',
         param: /^[A-Za-zАБВГДЕЖЗИЙКЛМНОПРСТУФХЦШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцшщъыьэюя \t\r\n\f]*$/,
         length_min: '1',
         length_max: '15',
         color_text: '#000000',
         color_hint: '#00FF00',
         color_error: '#FF0000',
         color_border: '#808080',
         nohint: false,
         font_family: 'Arial',
         font_size: '13px',
         position: 'topleft',
         offsetx: 0,
         offsety: 0,
         effect: 'none',
         error_text: ''
      });
      $("#Editbox7").validate(
      {
         required: true,
         bootstrap: true,
         type: 'custom',
         param: /^[A-Za-zАБВГДЕЖЗИЙКЛМНОПРСТУФХЦШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцшщъыьэюя \t\r\n\f]*$/,
         length_min: '1',
         length_max: '15',
         color_text: '#000000',
         color_hint: '#00FF00',
         color_error: '#FF0000',
         color_border: '#808080',
         nohint: false,
         font_family: 'Arial',
         font_size: '13px',
         position: 'topleft',
         offsetx: 0,
         offsety: 0,
         effect: 'none',
         error_text: ''
      });
      $("#").popover(
      {
         content: function() { return $('#wb_Card1').html(); },
         html : true,
         placement: 'right',
         template: '<div class="popover Card1" role="tooltip"><div class="arrow"></div><div class="popover-content"></div></div>',
         title: '',
         trigger: 'hover'
      });
   });
