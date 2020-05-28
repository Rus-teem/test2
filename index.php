<?php
function ValidateEmail($email)
{
   $pattern = '/^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i';
   return preg_match($pattern, $email);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['formid']) && $_POST['formid'] == 'layoutgrid6')
{
   $mailto = 'yourname@yourdomain.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $subject = 'Website form';
   $message = 'Values submitted from web site form:';
   $success_url = '';
   $error_url = '';
   $eol = "\n";
   $error = '';
   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha_code", "recaptcha_challenge_field", "recaptcha_response_field", "g-recaptcha-response");
   $boundary = md5(uniqid(time()));
   $header  = 'From: '.$mailfrom.$eol;
   $header .= 'Reply-To: '.$mailfrom.$eol;
   $header .= 'MIME-Version: 1.0'.$eol;
   $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
   $header .= 'X-Mailer: PHP v'.phpversion().$eol;
   try
   {
      if (!ValidateEmail($mailfrom))
      {
         $error .= "The specified email address (" . $mailfrom . ") is invalid!\n<br>";
         throw new Exception($error);
      }
      foreach ($_POST as $key => $value)
      {
         if (preg_match('/www\.|http:|https:/i', $value))
         {
            $error .= "URLs are not allowed!\n<br>";
            throw new Exception($error);
            break;
         }
      }
      if (!preg_match("/^[A-Za-zАБВГДЕЖЗИЙКЛМНОПРСТУФХЦШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцшщъыьэюя \t\r\n\f]*$/", $_POST['Editbox1']))
      {
         $error .= "Please enter only letter and whitespace characters in the \"Editbox1\" field.\n<br>";
      }
      if (empty($_POST['Editbox1']))
      {
         $error .= "Please enter a value for the \"Editbox1\" field.\n<br>";
      }
      if (strlen($_POST['Editbox1']) < 1)
      {
         $error .= "Please enter at least 1 characters in the \"Editbox1\" field.\n<br>";
      }
      if (strlen($_POST['Editbox1']) > 15)
      {
         $error .= "Please enter at most 15 characters in the \"Editbox1\" field.\n<br>";
      }
      if (!preg_match("/^[-+]?\d*\.?\d*$/", $_POST['phone']))
      {
         $error .= "Please enter only digit characters in the \"phone\" field.\n<br>";
      }
      if (empty($_POST['phone']))
      {
         $error .= "Please enter a value for the \"phone\" field.\n<br>";
      }
      if (strlen($_POST['phone']) < 1)
      {
         $error .= "Please enter at least 1 characters in the \"phone\" field.\n<br>";
      }
      if (strlen($_POST['phone']) > 12)
      {
         $error .= "Please enter at most 12 characters in the \"phone\" field.\n<br>";
      }
      if (!empty($error))
      {
         throw new Exception($error);
      }
      $message .= $eol;
      $message .= "IP Address : ";
      $message .= $_SERVER['REMOTE_ADDR'];
      $message .= $eol;
      $message .= "Referer : ";
      $message .= $_SERVER['SERVER_NAME'];
      $message .= $_SERVER['PHP_SELF'];
      $message .= $eol;
      foreach ($_POST as $key => $value)
      {
         if (!in_array(strtolower($key), $internalfields))
         {
            if (!is_array($value))
            {
               $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
            }
            else
            {
               $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
            }
         }
      }
      $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
      $body .= '--'.$boundary.$eol;
      $body .= 'Content-Type: text/plain; charset=ISO-8859-1'.$eol;
      $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
      $body .= $eol.stripslashes($message).$eol;
      if (!empty($_FILES))
      {
         foreach ($_FILES as $key => $value)
         {
             if ($_FILES[$key]['error'] == 0)
             {
                $body .= '--'.$boundary.$eol;
                $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
                $body .= 'Content-Transfer-Encoding: base64'.$eol;
                $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
                $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
             }
         }
      }
      $body .= '--'.$boundary.'--'.$eol;
      if ($mailto != '')
      {
         mail($mailto, $subject, $body, $header);
      }
      header('Location: '.$success_url);
   }
   catch (Exception $e)
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $e->getMessage(), $errorcode);
      echo $errorcode;
   }
   exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Безымянная страница</title>
<meta name="robots" content="index, follow">
<meta name="generator" content="WYSIWYG Web Builder 15 - http://www.wysiwygwebbuilder.com">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="font-awesome.min.css" rel="stylesheet">
<link href="kriastak-diadema.css" rel="stylesheet">
<link href="index.css" rel="stylesheet">
<script src="jquery-1.12.4.min.js"></script>
<script src="jquery-ui.min.js"></script>
<script src="transition.min.js"></script>
<script src="collapse.min.js"></script>
<script src="dropdown.min.js"></script>
<script src="wb.validation.min.js"></script>
<script src="tooltip.min.js"></script>
<script src="popover.min.js"></script>
<script src="wwb15.min.js"></script>
<script src="jquery.js"></script>
<script src="jquery.maskedinput-1.2.2.js"></script>
<script>   
   
   jQuery(function($) {
   
   $.mask.definitions['~']='[+-]';
   
   $('#date').mask('99/99/9999');
   
   $('#phone').mask('+7(999) 999-99-99');
   
   $('#phoneext').mask("(999) 999-9999? x99999");
   
   $("#tin").mask("99-9999999");
   
   $("#ssn").mask("999-99-9999");
   
   $("#product").mask("a*-999-a999");
   
   $("#eyescript").mask("~9.99 ~9.99 999");
   
   });
</script> 
<script src="index.js"></script>
</head>
<body>
   <div id="wb_header">
      <div id="header">
         <div class="col-1">
            <div id="wb_ThemeableMenu1">
               <div id="ThemeableMenu1" class="ThemeableMenu1" style="width:100%;height:auto !important;">
                  <div class="container">
                     <a id="ThemeableMenu1-logo" href="#"><img alt="Черпица по Шведской технологии" title="Черпица по Шведской технологии" src="images/Logokriastak-logo.png"></a>
                     <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".ThemeableMenu1-navbar-collapse">
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                        </button>
                     </div>
                     <div class="ThemeableMenu1-navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                           <li class="">
                              <a href="#LayoutGrid2">Цена</a>
                           </li>
                           <li class="">
                              <a href="#LayoutGrid11">Типы черепицы</a>
                           </li>
                           <li class="">
                              <a href="tel:+78432536884">+7 (843) 253-68-84</a>
                           </li>
                           <li class="">
                              <a href="#contact">Вам перзвонить?</a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div id="wb_LayoutGrid1">
      <div id="LayoutGrid1">
         <div class="col-1">
         </div>
         <div class="col-2">
            <div id="wb_Text1" onscroll="ShowObjectWithEffect('wb_Text1', 1, '', 0);return false;">
               <span id="wb_uid0"><strong>ЧЕРЕПИЦА ПО ШВЕДСКОЙ ТЕХНОЛОГИИ </strong></span>
            </div>
            <div id="wb_Text2">
               <span id="wb_uid1">ОТ ПРОИЗВОДИТЕЛЯ ПО НИЗКИМ ЦЕНАМ</span>
            </div>
            <a id="Button1" href="">УЗНАТЬ ЦЕНЫ</a>
         </div>
         <div class="col-3">
         </div>
      </div>
   </div>
   <div id="wb_LayoutGrid2">
      <div id="LayoutGrid2">
         <div class="row">
            <div class="col-1">
               <div id="wb_Heading1">
                  <h1 id="Heading1">ВЫБЕРИ ЦВЕТ ЧЕРЕПИЦЫ</h1>
               </div>
               <div id="wb_Text4">
                  <span id="wb_uid2">РЯДНАЯ ЧЕРЕПИЦА, СПЕЦИАЛЬНЫЕ ЦЕНА</span>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div id="wb_LayoutGrid3">
      <div id="LayoutGrid3">
         <div class="row">
            <div class="col-1">
               <div id="wb_Image1">
                  <img src="images/brown.jpg" id="Image1" alt="">
               </div>
               <div id="wb_Text5">
                  <span id="wb_uid3"><strong>Цвет: </strong>Коричневый</span>
               </div>
               <div id="wb_Text3">
                  <span id="wb_uid4">Цена за шт. - <s>83 р</s>. 65руб.<br>Цена м<sup>2 </sup>- 650 руб.</span>
               </div>
            </div>
            <div class="col-2">
               <div id="wb_Image2">
                  <img src="images/02k.jpg" id="Image2" alt="">
               </div>
               <div id="wb_Text6">
                  <span id="wb_uid5"><strong>Цвет: </strong>Черный </span>
               </div>
               <div id="wb_Text7">
                  <span id="wb_uid6">Цена за шт. - <s>83 р</s>. 65руб.<br>Цена м<sup>2 </sup>- 650 руб.</span>
               </div>
            </div>
            <div class="col-3">
               <div id="wb_Image3">
                  <img src="images/grafit.jpg" id="Image3" alt="">
               </div>
               <div id="wb_Text8">
                  <span id="wb_uid7"><strong>Цвет: </strong>Графит </span>
               </div>
               <div id="wb_Text9">
                  <span id="wb_uid8">Цена за шт. - <s>83 р</s>. 65руб.<br>Цена м<sup>2 </sup>- 650 руб.</span>
               </div>
            </div>
            <div class="col-4">
               <div id="wb_Image4">
                  <img src="images/kirpich-krasnii-antik.jpg" id="Image4" alt="">
               </div>
               <div id="wb_Text10">
                  <span id="wb_uid9"><strong>Цвет: </strong>Кирпично-красный Antik</span>
               </div>
               <div id="wb_Text11">
                  <span id="wb_uid10">Цена за шт. - <s>83 р</s>. 65руб.<br>Цена м<sup>2 </sup>- 650 руб.</span>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div id="wb_LayoutGrid4">
      <div id="LayoutGrid4">
         <div class="row">
            <div class="col-1">
               <div id="wb_Heading2">
                  <h5 id="Heading2">ВЫБЕРИ ЦВЕТ ЧЕРЕПИЦЫ</h5>
               </div>
               <div id="wb_Text12">
                  <span id="wb_uid11">РЯДНАЯ ЧЕРЕПИЦА, БАЗОВЫЕ ЦВЕТА</span>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div id="wb_LayoutGrid5">
      <div id="LayoutGrid5">
         <div class="row">
            <div class="col-1">
               <div id="wb_Image5">
                  <img src="images/04k (1).jpg" id="Image5" alt="">
               </div>
               <div id="wb_Text14">
                  <span id="wb_uid12"><strong>Цвет: </strong>Кирпично-красный</span>
               </div>
               <div id="wb_Text13">
                  <span id="wb_uid13">Цена за шт. - <s>83 р</s>. 65руб.<br>Цена м<sup>2 </sup>- 650 руб.</span>
               </div>
            </div>
            <div class="col-2">
               <div id="wb_Image6">
                  <img src="images/05k.jpg" id="Image6" alt="">
               </div>
               <div id="wb_Text15">
                  <span id="wb_uid14"><strong>Цвет: </strong>Красный</span>
               </div>
               <div id="wb_Text16">
                  <span id="wb_uid15">Цена за шт. - <s>83 р</s>. 65руб.<br>Цена м<sup>2 </sup>- 650 руб.</span>
               </div>
            </div>
            <div class="col-3">
               <div id="wb_Image7">
                  <img src="images/grafit.jpg" id="Image7" alt="">
               </div>
               <div id="wb_Text17">
                  <span id="wb_uid16"><strong>Цвет: </strong>Графит </span>
               </div>
               <div id="wb_Text18">
                  <span id="wb_uid17">Цена за шт. - <s>83 р</s>. 65руб.<br>Цена м<sup>2 </sup>- 650 руб.</span>
               </div>
            </div>
            <div class="col-4">
               <div id="wb_Image8">
                  <img src="images/07k-2.jpg" id="Image8" alt="">
               </div>
               <div id="wb_Text19">
                  <span id="wb_uid18"><strong>Цвет: </strong>Коричневый Antik</span>
               </div>
               <div id="wb_Text20">
                  <span id="wb_uid19">Цена за шт. - <s>83 р</s>. 65руб.<br>Цена м<sup>2 </sup>- 650 руб.</span>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div id="wb_LayoutGrid6">
      <form name="LayoutGrid6" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" id="LayoutGrid6">
         <input type="hidden" name="formid" value="layoutgrid6">
         <div class="col-1">
            <div id="wb_Image9">
               <img src="images/013k-2.jpg" id="Image9" alt="">
            </div>
            <div id="wb_Text22">
               <span id="wb_uid20"><strong>Цвет: </strong>Серый Antik</span>
            </div>
            <div id="wb_Text21">
               <span id="wb_uid21">Цена за шт. - <s>83 р</s>. 65руб.<br>Цена м<sup>2 </sup>- 650 руб.</span>
            </div>
         </div>
         <div class="col-2">
            <div id="wb_Image10">
               <img src="images/09k-2.jpg" id="Image10" alt="">
            </div>
            <div id="wb_Text23">
               <span id="wb_uid22"><strong>Цвет: </strong>Неокрашенный серый / красный</span>
            </div>
            <div id="wb_Text24">
               <span id="wb_uid23">Цена за шт. - <s>83 р</s>. 65руб.<br>Цена м<sup>2 </sup>- 650 руб.</span>
            </div>
         </div>
         <div class="col-3">
            <div id="wb_Text25">
               <span id="wb_uid24"><strong>Есть вопрос?</strong></span>
            </div>
            <div id="wb_Text26">
               <span id="wb_uid25">Оставьте свои контакты и мы вам перезвоним в удобное время</span>
            </div>
            <div id="wb_Name">
               <input type="text" id="Name" name="Editbox1" value="" spellcheck="false" placeholder="&#1042;&#1072;&#1096;&#1077; &#1080;&#1084;&#1103;">
            </div>
            <div id="wb_phone">
               <input type="tel" id="phone" name="phone" value="" maxlength="12" spellcheck="false" accesskey="+7 (000) 000 00 00" placeholder="&#1042;&#1072;&#1096; &#1085;&#1086;&#1084;&#1077;&#1088; &#1090;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;&#1072;">
            </div>
            <input type="submit" id="Button2" name="" value="ПЕРЕЗВОНИТЕ МНЕ">
            <div id="wb_LayoutGrid7">
               <div id="LayoutGrid7">
                  <div class="col-1">
                     <input type="checkbox" id="Checkbox1" name="Checkbox1" value="Вы даете свое согласие на обработку персональных данных" checked title="&#1042;&#1099; &#1076;&#1072;&#1077;&#1090;&#1077; &#1089;&#1074;&#1086;&#1077; &#1089;&#1086;&#1075;&#1083;&#1072;&#1089;&#1080;&#1077; &#1085;&#1072; &#1086;&#1073;&#1088;&#1072;&#1073;&#1086;&#1090;&#1082;&#1091; &#1087;&#1077;&#1088;&#1089;&#1086;&#1085;&#1072;&#1083;&#1100;&#1085;&#1099;&#1093; &#1076;&#1072;&#1085;&#1085;&#1099;&#1093;">
                  </div>
                  <div class="col-2">
                     <div id="wb_Text29">
                        <span id="wb_uid26">Вы даете свое согласие на обработку персональных данных</span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </form>
   </div>
   <div id="wb_LayoutGrid8">
      <div id="LayoutGrid8">
         <div class="row">
            <div class="col-1">
               <div id="wb_LayoutGrid11">
                  <div id="LayoutGrid11">
                     <div class="row">
                        <div class="col-1">
                           <div id="wb_Heading3">
                              <h5 id="Heading3">ВЫБЕРИ ФОРМУ ЧЕРЕПИЦЫ</h5>
                           </div>
                           <div id="wb_Text38">
                              <span id="wb_uid27">ВСЕ ТИПЫ ЧЕРЕПИЦЫ ДОСТУПНЫ В РАЗЛИЧНЫХ ЦВЕТАХ</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div id="wb_LayoutGrid10">
                  <div id="LayoutGrid10">
                     <div class="row">
                        <div class="col-1">
                           <div id="wb_Image11">
                              <img src="images/02-konk-300.png" id="Image11" alt="">
                           </div>
                           <div id="wb_Text31">
                              <span id="wb_uid28"><strong>Тип: </strong>Коньковая черепица</span>
                           </div>
                           <div id="wb_Text30">
                              <span id="wb_uid29">Упаковка, шт / поддон	100<br>Вес, кг / шт	5,3</span>
                           </div>
                        </div>
                        <div class="col-2">
                           <div id="wb_Image13">
                              <img src="images/03-tor-300.png" id="Image13" alt="">
                           </div>
                           <div id="wb_Text32">
                              <span id="wb_uid30"><strong>Тип: </strong>Торцевая черепица</span>
                           </div>
                           <div id="wb_Text33">
                              <span id="wb_uid31">Упаковка, шт / поддон	100<br>Вес, кг / шт	4,8</span>
                           </div>
                        </div>
                        <div class="col-3">
                           <div id="wb_Image14">
                              <img src="images/04-nach-kr-300.png" id="Image14" alt="">
                           </div>
                           <div id="wb_Text34">
                              <span id="wb_uid32"><strong>Тип: </strong>Начальная/конечная коньковая черепица</span>
                           </div>
                           <div id="wb_Text35">
                              <span id="wb_uid33">Упаковка, шт / поддон	30<br>Вес, кг / шт	4,9</span>
                           </div>
                        </div>
                        <div class="col-4">
                           <div id="wb_Image15">
                              <img src="images/06-hreb-300.png" id="Image15" alt="">
                           </div>
                           <div id="wb_Text36">
                              <span id="wb_uid34"><strong>Тип: </strong>Конечная хребтовая черепица</span>
                           </div>
                           <div id="wb_Text37">
                              <span id="wb_uid35">Упаковка, шт / поддон	57<br>Вес, кг / шт	3,8</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div id="wb_LayoutGrid9">
                  <div id="LayoutGrid9">
                     <div class="row">
                        <div class="col-1">
                           <div id="wb_Image16">
                              <img src="images/07-vent-300.png" id="Image16" alt="">
                           </div>
                           <div id="wb_Text40">
                              <span id="wb_uid36"><strong>Тип: </strong>Вентиляционная черепица</span>
                           </div>
                           <div id="wb_Text39">
                              <span id="wb_uid37">Упаковка, шт / поддон	36<br>Вес, кг / шт	5,8</span>
                           </div>
                        </div>
                        <div class="col-2">
                           <div id="wb_Image17">
                              <img src="images/08-x300.png" id="Image17" alt="">
                           </div>
                           <div id="wb_Text41">
                              <span id="wb_uid38"><strong>Тип: </strong>Х-образная черепица</span>
                           </div>
                           <div id="wb_Text42">
                              <span id="wb_uid39">Упаковка, шт / поддон	6<br>Вес, кг / шт	8,4</span>
                           </div>
                        </div>
                        <div class="col-3">
                           <div id="wb_Image18">
                              <img src="images/09-t-300.png" id="Image18" alt="">
                           </div>
                           <div id="wb_Text43">
                              <span id="wb_uid40"><strong>Тип: </strong>Т-образная черепица</span>
                           </div>
                           <div id="wb_Text44">
                              <span id="wb_uid41">Упаковка, шт / поддон	40<br>Вес, кг / шт	7,0</span>
                           </div>
                        </div>
                        <div class="col-4">
                           <div id="wb_Image19">
                              <img src="images/09y-300.png" id="Image19" alt="">
                           </div>
                           <div id="wb_Text45">
                              <span id="wb_uid42"><strong>Тип: </strong>Y-образная черепица</span>
                           </div>
                           <div id="wb_Text46">
                              <span id="wb_uid43">Упаковка, шт / поддон	32<br>Вес, кг / шт	5.4</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div id="wb_LayoutGrid13">
      <div id="LayoutGrid13-overlay"></div>
      <div id="LayoutGrid13">
         <div class="row">
            <div class="col-1">
               <div id="wb_Heading4">
                  <h5 id="Heading4">ВЫБЕРИ ФОРМУ ЧЕРЕПИЦЫ</h5>
               </div>
               <div id="wb_LayoutGrid12">
                  <div id="LayoutGrid12">
                     <div class="row">
                        <div class="col-1">
                           <div class="col-1-padding">
                              <div id="wb_Image20">
                                 <img src="images/1.png" id="Image20" alt="">
                              </div>
                              <div id="wb_Text47">
                                 <h3>Натуральный материал</h3>
                              </div>
                              <div id="wb_Text48">
                                 <span id="wb_uid44">В составе цементно-песчаной черепицы Kriastak имеются только натуральные природные элементы, которые делают продукт экологичным и безопасным.</span>
                              </div>
                           </div>
                        </div>
                        <div class="col-2">
                           <div class="col-2-padding">
                              <div id="wb_Image21">
                                 <img src="images/2.png" id="Image21" alt="">
                              </div>
                              <div id="wb_Text49">
                                 <h3>Прочность</h3>
                              </div>
                              <div id="wb_Text50">
                                 <span id="wb_uid45">Современный производственный процесс, спроектированный<br>специально для производства ЦПЧ, а также высочайшее качество цемента, применяемого при производстве черепицы, позволяют добиться исключительных показателей прочности, аналогов которым нет в России.</span>
                              </div>
                           </div>
                        </div>
                        <div class="col-3">
                           <div class="col-3-padding">
                              <div id="wb_Image22">
                                 <img src="images/3.png" id="Image22" alt="">
                              </div>
                              <div id="wb_Text51">
                                 <h3>Уникальная цветовая палитра</h3>
                              </div>
                              <div id="wb_Text52">
                                 <span id="wb_uid46">Собственное производство позволяет снизить затраты на сырье и логистику, что дает возможность предлагать клиентам черепицу по самым привлекательным ценам, по качеству не уступающую европейским аналогам.</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div id="wb_LayoutGrid14">
                  <div id="LayoutGrid14">
                     <div class="row">
                        <div class="col-1">
                           <div class="col-1-padding">
                              <div id="wb_Image24">
                                 <img src="images/5.png" id="Image24" alt="">
                              </div>
                              <div id="wb_Text55">
                                 <span id="wb_uid47"><strong>Заводская гарантия 35 лет</strong></span>
                              </div>
                              <div id="wb_Text56">
                                 <span id="wb_uid48">Гарантия распространяется на все виды цементно-песчаной черепицы Kriastak.</span>
                              </div>
                           </div>
                        </div>
                        <div class="col-2">
                           <div class="col-2-padding">
                              <div id="wb_Image25">
                                 <img src="images/6.png" id="Image25" alt="">
                              </div>
                              <div id="wb_Text57">
                                 <span id="wb_uid49"><strong>Срок службы 100 лет</strong></span>
                              </div>
                              <div id="wb_Text58">
                                 <span id="wb_uid50">Вы строите дом, который качественно прослужит не одному поколению жильцов. Мелкий ремонт возможен в случае повреждения отдельных участков кровельного покрытия. По истечении времени выгоревшие участки (по желанию) всегда можно подкрасить, вернув черепице первозданный вид.</span>
                              </div>
                           </div>
                        </div>
                        <div class="col-3">
                           <div class="col-3-padding">
                              <div id="wb_Image26">
                                 <img src="images/1.png" id="Image26" alt="">
                              </div>
                              <div id="wb_Text59">
                                 <span id="wb_uid51"><strong>Срок службы 100 лет</strong></span>
                              </div>
                              <div id="wb_Text60">
                                 <span id="wb_uid52">Вы строите дом, который качественно прослужит не одному поколению жильцов. Мелкий ремонт возможен в случае повреждения отдельных участков кровельного покрытия. По истечении времени выгоревшие участки (по желанию) всегда можно подкрасить, вернув черепице первозданный вид.</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div id="wb_LayoutGrid24">
                  <div id="LayoutGrid24">
                     <div class="row">
                        <div class="col-1">
                           <div class="col-1-padding">
                              <div id="wb_Image43">
                                 <img src="images/7 (1).png" id="Image43" alt="">
                              </div>
                              <div id="wb_Text77">
                                 <span id="wb_uid53"><strong>Подходит для всех климатических зон</strong></span>
                              </div>
                              <div id="wb_Text78">
                                 <span id="wb_uid54">Включая регионы с экстремально низкими и высокими температурами. Черепица Криастак морозоустойчива, обладает низкой тепло- и электропроводностью. В жару под такой крышей будет прохладно, в мороз - тепло. Черепица выдерживает ветровые нагрузки, влажность, пожаробезопасна.</span>
                              </div>
                           </div>
                        </div>
                        <div class="col-2">
                           <div class="col-2-padding">
                              <div id="wb_Image44">
                                 <img src="images/9.png" id="Image44" alt="">
                              </div>
                              <div id="wb_Text79">
                                 <span id="wb_uid55"><strong>Отличная шумоизоляция</strong></span>
                              </div>
                              <div id="wb_Text80">
                                 <span id="wb_uid56">Дождь, град, снег - шумовая нагрузка на кровельное покрытие поглощается черепицей Криастак. А так же в мансардном пространстве.</span>
                              </div>
                           </div>
                        </div>
                        <div class="col-3">
                           <div class="col-3-padding">
                              <div id="wb_Image40">
                                 <img src="images/4.png" id="Image40" alt="">
                              </div>
                              <div id="wb_Text71">
                                 <span id="wb_uid57"><strong>Выгодная цена</strong></span>
                              </div>
                              <div id="wb_Text72">
                                 <span id="wb_uid58">Собственное производство позволяет снизить затраты на сырье и логистику, что дает возможность предлагать клиентам черепицу по самым привлекательным ценам, по качеству не уступающую европейским аналогам.</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div id="wb_LayoutGrid15">
      <div id="LayoutGrid15">
         <div class="row">
            <div class="col-1">
               <div id="wb_Heading5">
                  <h5 id="Heading5">СТРОГИЙ КОНТРОЛЬ НАД КАЧЕСТВОМ</h5>
               </div>
               <div id="wb_LayoutGrid16">
                  <div id="LayoutGrid16">
                     <div class="row">
                        <div class="col-1">
                           <div id="wb_Text65">
                              <span id="wb_uid59">Всё сырье, смеси и уже готовая продукция проходят строгий контроль качества, тестирование и оптимизацию. Это позволяет нам предложить вам, с одной стороны, эстетические и функциональные характеристики продукции, с другой стороны - профессиональные и практические решения для керамической черепицы.</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div id="wb_LayoutGrid17">
                  <div id="LayoutGrid17">
                     <div class="row">
                        <div class="col-1">
                           <div class="col-1-padding">
                              <div id="wb_Image29">
                                 <img src="images/Sertifikate - Kriastak-min.jpg" id="Image29" alt="">
                              </div>
                           </div>
                        </div>
                        <div class="col-2">
                           <div class="col-2-padding">
                              <div id="wb_Heading6">
                                 <h1 id="Heading6">Шведские технологии</h1>
                              </div>
                              <div id="wb_Text66">
                                 <span id="wb_uid60">Специалисты компании Kriastak осуществляют производство натуральной черепицы с 1993 года. Больше 20 лет велось производство кровельных материалов для известной торговой марки Baltic tile. Колоссальный опыт и партнёрство с крупнейшей шведской производственной компанией делают Kriastak сегодня признанным профессионалом на рынке производителей натуральной черепицы.<br>Завод компании оснащен шведским оборудованием, в производстве используются высокопрочные формы и качественное сырье, что позволяет путем экструзии производить черепицу с исключительными показателями прочности, аналогов которым нет на российском рынке. Уникальные технологии покраски позволяют предлагать клиентам богатую цветовую палитру изделий. Для окрашивания черепицы в массе используется немецкий пигмент Bayer, а обе внешние покраски производятся специальной краской Benderit (Швеция), стойкой к перепадам температур и прямым солнечным лучам. Черепица Kriastak создана с учетом российских климатических особенностей, потому выдерживает экстремальные нагрузки температуры, ветра, влажности. Срок эксплуатация черепицы Kriastak составляет больше 100 лет. Гарантия на все изделия - 35 лет. Натуральные материалы, прочность, стильный дизайн, отличная шумоизоляция, низкая теплопроводность, пожаробезопасность и долговечность делают черепицу Kriastak лучшим решением для строителей России.<br>Собственное производство позволяет снизить затраты на сырье и логистику, что дает возможность предлагать клиентам черепицу по самым привлекательным ценам, по качеству не уступающую европейским аналогам. Поставки осуществляются по всей стране в кратчайшие сроки, в наличии всегда имеется большой складской запас.</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div id="wb_LayoutGrid19">
      <div id="LayoutGrid19">
         <div class="row">
            <div class="col-1">
               <div id="wb_Heading7">
                  <h1 id="Heading7">УЗНАЙТЕ ПОДРОБНЕЕ О НАШЕМ ПРОДУКТЕ</h1>
               </div>
               <div id="wb_Text67">
                  <span id="wb_uid61">СКАЧАЙТЕ&nbsp; НАШИ ТАБЛИЦЫ</span>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div id="wb_LayoutGrid18">
      <form name="LayoutGrid18" method="post" action="mailto:yourname@yourdomain.com" enctype="multipart/form-data" id="LayoutGrid18">
         <div class="col-1">
            <div id="wb_Image30">
               <img src="images/book-1.png" id="Image30" alt="">
            </div>
            <input type="submit" id="Button3" name="" value="СКАЧАТЬ">
         </div>
         <div class="col-2">
            <div id="wb_Image31">
               <img src="images/book-2.png" id="Image31" alt="">
            </div>
            <a id="Button4" href="http://" onclick="ShowObjectWithEffect('Button4', 1, '', 0);return false;">СКАЧАТЬ</a>
         </div>
         <div class="col-3">
            <div id="wb_Text68">
               <span id="wb_uid62"><strong>Остались вопросы?</strong></span>
            </div>
            <div id="wb_Text69">
               <span id="wb_uid63">Оставьте свои контакты и мы перезвоним</span>
            </div>
            <div id="wb_Editbox1">
               <input type="text" id="Editbox1" name="Editbox1" value="" spellcheck="false" placeholder="&#1042;&#1072;&#1096;&#1077; &#1080;&#1084;&#1103;">
            </div>
            <div id="wb_Editbox2">
               <input type="tel" id="Editbox2" name="phone2" value="" maxlength="12" spellcheck="false" placeholder="&#1042;&#1072;&#1096; &#1085;&#1086;&#1084;&#1077;&#1088; &#1090;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;&#1072;">
            </div>
            <input type="submit" id="Button5" name="" value="ПЕРЕЗВОНИТЕ МНЕ">
            <div id="wb_LayoutGrid20">
               <div id="LayoutGrid20">
                  <div class="col-1">
                     <input type="checkbox" id="Checkbox2" name="Checkbox1" value="Вы даете свое согласие на обработку персональных данных" checked title="&#1042;&#1099; &#1076;&#1072;&#1077;&#1090;&#1077; &#1089;&#1074;&#1086;&#1077; &#1089;&#1086;&#1075;&#1083;&#1072;&#1089;&#1080;&#1077; &#1085;&#1072; &#1086;&#1073;&#1088;&#1072;&#1073;&#1086;&#1090;&#1082;&#1091; &#1087;&#1077;&#1088;&#1089;&#1086;&#1085;&#1072;&#1083;&#1100;&#1085;&#1099;&#1093; &#1076;&#1072;&#1085;&#1085;&#1099;&#1093;">
                  </div>
                  <div class="col-2">
                     <div id="wb_Text70">
                        <span id="wb_uid64">Вы даете свое согласие на обработку персональных данных</span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </form>
   </div>
   <div id="wb_LayoutGrid21">
      <div id="LayoutGrid21">
         <div class="row">
            <div class="col-1">
               <div id="wb_Heading8">
                  <h5 id="Heading8">ПРИМЕРЫ УЛОЖНОЙ ЧЕРЕПИЦЫ</h5>
               </div>
               <div id="wb_LayoutGrid22">
                  <div id="LayoutGrid22">
                     <div class="row">
                        <div class="col-1">
                           <div id="wb_Image32">
                              <img src="images/1-min.png" id="Image32" alt="">
                           </div>
                        </div>
                        <div class="col-2">
                           <div id="wb_Image33">
                              <img src="images/2-min.png" id="Image33" alt="">
                           </div>
                        </div>
                        <div class="col-3">
                           <div id="wb_Image34">
                              <img src="images/3-min.png" id="Image34" alt="">
                           </div>
                        </div>
                        <div class="col-4">
                           <div id="wb_Image35">
                              <img src="images/4-min.png" id="Image35" alt="">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div id="wb_LayoutGrid23">
                  <div id="LayoutGrid23">
                     <div class="row">
                        <div class="col-1">
                           <div id="wb_Image36">
                              <img src="images/5-min.png" id="Image36" alt="">
                           </div>
                        </div>
                        <div class="col-2">
                           <div id="wb_Image37">
                              <img src="images/6-min.png" id="Image37" alt="">
                           </div>
                        </div>
                        <div class="col-3">
                           <div id="wb_Image38">
                              <img src="images/7-min.png" id="Image38" alt="">
                           </div>
                        </div>
                        <div class="col-4">
                           <div id="wb_Image39">
                              <img src="images/8-min.png" id="Image39" alt="">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div id="wb_LayoutGrid25">
      <form name="LayoutGrid18" method="post" action="mailto:yourname@yourdomain.com" enctype="multipart/form-data" id="LayoutGrid25">
         <div class="col-1">
            <div id="wb_Card1">
               <div id="Card1-card-body">
                  <img id="Card1-card-item0" src="images/h400.jpeg.jpg" alt="" title="">
                  <div id="Card1-card-item1">Технический специалист </div>
                  <div id="Card1-card-item2">Описание и какой-либо текст</div>
                  <hr id="Card1-card-item3">
                  <div id="Card1-card-item4"><a href="tel:+79178803446" title="&#1055;&#1086;&#1079;&#1074;&#1086;&#1085;&#1080;&#1090;&#1100; &#1089;&#1087;&#1077;&#1094;&#1080;&#1072;&#1083;&#1080;&#1089;&#1090;&#1091;"><i class="fa fa-phone"></i>Позвонить специалисту</a></div>
               </div>
            </div>
         </div>
         <div class="col-2">
            <div id="wb_Text75">
               <span id="wb_uid65"><strong>НУЖНА ДРУГАЯ ЦЕНА</strong></span>
            </div>
            <div id="wb_Text73">
               <span id="wb_uid66">Мы сделаем перерасчет исходя из ваших потребностей</span>
            </div>
            <div id="wb_Editbox5">
               <input type="text" id="Editbox5" name="Editbox1" value="" spellcheck="false" placeholder="&#1055;&#1083;&#1086;&#1097;&#1072;&#1076;&#1100;">
            </div>
            <div id="wb_Text76">
               <span id="wb_uid67"><strong>или</strong></span>
            </div>
            <div id="wb_Editbox6">
               <input type="text" id="Editbox6" name="Editbox1" value="" spellcheck="false" placeholder="&#1050;&#1086;&#1083;&#1080;&#1095;&#1077;&#1089;&#1090;&#1074;&#1086; &#1096;&#1090;&#1091;&#1082;">
            </div>
            <div id="wb_Editbox7">
               <input type="text" id="Editbox7" name="Editbox1" value="" spellcheck="false" placeholder="&#1042;&#1072;&#1096;&#1072; &#1094;&#1077;&#1085;&#1072; &#1079;&#1072; &#1096;&#1090;&#1091;&#1082;&#1091;">
            </div>
            <hr id="Line1">
            <div id="wb_Editbox3">
               <input type="text" id="Editbox3" name="Editbox1" value="" spellcheck="false" placeholder="&#1042;&#1072;&#1096;&#1077; &#1080;&#1084;&#1103;">
            </div>
            <div id="wb_Editbox4">
               <input type="tel" id="Editbox4" name="phone" value="" maxlength="12" spellcheck="false" placeholder="&#1042;&#1072;&#1096; &#1085;&#1086;&#1084;&#1077;&#1088; &#1090;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;&#1072;">
            </div>
            <input type="submit" id="Button8" name="" value="ПЕРЕЗВОНИТЕ МНЕ">
            <div id="wb_LayoutGrid26">
               <div id="LayoutGrid26">
                  <div class="col-1">
                     <input type="checkbox" id="Checkbox3" name="Checkbox1" value="Вы даете свое согласие на обработку персональных данных" checked title="&#1042;&#1099; &#1076;&#1072;&#1077;&#1090;&#1077; &#1089;&#1074;&#1086;&#1077; &#1089;&#1086;&#1075;&#1083;&#1072;&#1089;&#1080;&#1077; &#1085;&#1072; &#1086;&#1073;&#1088;&#1072;&#1073;&#1086;&#1090;&#1082;&#1091; &#1087;&#1077;&#1088;&#1089;&#1086;&#1085;&#1072;&#1083;&#1100;&#1085;&#1099;&#1093; &#1076;&#1072;&#1085;&#1085;&#1099;&#1093;">
                  </div>
                  <div class="col-2">
                     <div id="wb_Text74">
                        <span id="wb_uid68">Вы даете свое согласие на обработку персональных данных</span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </form>
   </div>
   <div id="wb_LayoutGrid27">
      <div id="LayoutGrid27">
         <div class="col-1">
            <div id="Html1">
               <script charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A86c45f2c49e03a5067d489c900fde1a96e0f1f9737808e7a5c9154bac2695518&amp;width=100%25&amp;height=100%&amp;lang=ru_RU&amp;scroll=falce"></script></div>
         </div>
         <div class="col-2">
            <div id="wb_Text81">
               <h3>Дополнительные услуги: </h3>
            </div>
            <div id="wb_Text82">
               <ul id="wb_uid69">
                  <li id="wb_uid70"><p id="wb_uid71"><span id="wb_uid72">Расчет</span><span id="wb_uid73">&nbsp;</span><span id="wb_uid74">по</span><span id="wb_uid75">&nbsp;</span><span id="wb_uid76">проекту</span><span id="wb_uid77">&nbsp;</span><span id="wb_uid78">в</span><span id="wb_uid79">&nbsp;</span><span id="wb_uid80">течении</span><span id="wb_uid81"> 24</span><span id="wb_uid82">часов</span><span id="wb_uid83">; </span>
                  </li>
                  <li id="wb_uid84"><p id="wb_uid85">Выезд&nbsp;тех.специалиста&nbsp;на&nbsp;объект&nbsp;для&nbsp;предварительного&nbsp;осмотра; 
                  </li>
                  <li id="wb_uid86"><p id="wb_uid87">Предоставление&nbsp;бригады&nbsp;для&nbsp;монтажа; 
                  </li>
                  <li id="wb_uid88"><p id="wb_uid89">Шеф&nbsp;контроль(приемка&nbsp;черепицы&nbsp;на&nbsp;объекте&nbsp;и&nbsp;контроль&nbsp;выгрузки, контроль&nbsp;производства&nbsp;кровельных&nbsp;работ).
                  </li>
               </ul>
            </div>
            <div id="wb_Text83">
               <h3>Офис:</h3>
            </div>
            <div id="wb_Text84">
               <span id="wb_uid90"><strong>&#1040;&#1076;&#1088;&#1077;&#1089;: </strong>&#1050;&#1072;&#1079;&#1072;&#1085;&#1100; &#1043;.&#1058;&#1091;&#1082;&#1072;&#1103; 58, &#1086;&#1092;&#1080;&#1089; 206<br><strong>Телефон: <a href="tel:+78432536884" class="black">+7 (843) 253-68-84</a></strong></span>
            </div>
            <div id="wb_Text86">
               <h3>Производство:</h3>
            </div>
            <div id="wb_Text87">
               <span id="wb_uid91"><strong>&#1040;&#1076;&#1088;&#1077;&#1089;: </strong>Санкт-Петербург, пос. Шушары, Старорусский пр., 42</span>
            </div>
         </div>
      </div>
   </div>
</body>
</html>