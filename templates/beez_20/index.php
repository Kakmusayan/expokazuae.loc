<?php
  //dir="echo $this->direction; 
  /** * @package    Joomla.Site * @copyright  Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved. * @license    GNU General Public License version 2 or later; see LICENSE.txt */ 
  <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>"  >  <head>    <!-- The following JDOC Head tag loads all the header and meta information from your site config and content. -->    <jdoc:include type="head" />
    
        <title></title>
        <meta charset="UTF-8">
        <link href="/templates/beez_20/css/res.css" rel="stylesheet">
        <link href="/templates/beez_20/css/reset.css" rel="stylesheet">
        <link href="/templates/beez_20/css/style.css?v=<?php echo time(); ?>" rel="stylesheet">

  <link href="/templates/beez_20/css/bootstrap.min.css?v=<?php echo time(); ?>" rel="stylesheet">

<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">


  <script type="text/javascript" src="/components/com_comprofiler/js/menubest.min.js?v=2dc6c769a81b3a4c"></script>
  <script type="text/javascript" src="/components/com_comprofiler/js/menubest.min.js?v=2dc6c769a81b3a4c"></script>
  <script type="text/javascript" src="/components/com_comprofiler/js/cb12.min.js?v=2dc6c769a81b3a4c"></script>
  <script type="text/javascript" src="/components/com_comprofiler/js/overlib_all_mini.js?v=2dc6c769a81b3a4c"></script><script type="text/javascript"><!--
overlib_pagedefaults(WIDTH,250,VAUTO,RIGHT,AUTOSTATUSCAP, CSSCLASS,TEXTFONTCLASS,'cb-tips-font',FGCLASS,'cb-tips-fg',BGCLASS,'cb-tips-bg',CAPTIONFONTCLASS,'cb-tips-capfont', CLOSEFONTCLASS, 'cb-tips-closefont');
--></script>
  <script type="text/javascript"><!--
if ( typeof window.$ != 'undefined' ) {
  window.cbjqldr_tmpsave$ = window.$;
}
if ( typeof window.jQuery != 'undefined' ) {
  window.cbjqldr_tmpsavejquery = window.jQuery;
}
--></script>
  
  <script type="text/javascript"><!--
var cbjQuery = jQuery.noConflict( true );
--></script>
  <script type="text/javascript"><!--
window.$ = cbjQuery;
window.jQuery = cbjQuery;
--></script><script type="text/javascript" src="/components/com_comprofiler/js/tabpane.min.js?v=2dc6c769a81b3a4c"></script>
  <script type="text/javascript" src="/components/com_comprofiler/plugin/user/plug_cbactivity/js/jquery.timeago.min.js"></script>
  <script type="text/javascript" src="/components/com_comprofiler/js/jquery-1.5.2/jquery.form.min.js?v=2dc6c769a81b3a4c"></script>
  <script type="text/javascript" src="/components/com_comprofiler/plugin/user/plug_cbprofilegallery/js/profilegallery.min.js?v=4be5479fb9d3b5e4"></script>
  <script type="text/javascript" src="/components/com_comprofiler/plugin/user/plug_cbprofilebook/bb_adm.min.js?v=8eb5621d9c55e964"></script>
  <script type="text/javascript" src="/components/com_comprofiler/js/jquery-1.5.2/jquery.cluetip.min.js?v=2dc6c769a81b3a4c"></script>
  <script type="text/javascript"><!--
var _adminpbnewcommentblog_validations = Array( Array('profilebookpostertitle','','Title is Required!'),Array('profilebookpostercomments','','Comment is Required!'));
var _adminpbnewcommentblog_bbcodestack = Array();


var _adminpbnewcommentwall_validations = Array( Array('profilebookpostercomments','','Comment is Required!'));
var _adminpbnewcommentwall_bbcodestack = Array();



  function cbConnSubmReq() {
    cClick();
    document.connOverForm.submit();
  }
  function confirmSubmit() {
  if (confirm("Are you sure you want to remove this connection?"))
    return true ;
  else
    return false ;
  }


cbjQuery( document ).ready( function( $ ) {
var jQuery = $;
var cbshowtabsArray = new Array();
function showCBTab( sName ) {
  if ( typeof(sName) == 'string' ) {
    sName = sName.toLowerCase();
  }
  for (var i=0;i<cbshowtabsArray.length;i++) {
    for (var j=0;j<cbshowtabsArray[i][0].length;j++) {
      if (cbshowtabsArray[i][0][j] == sName) {
        eval(cbshowtabsArray[i][1]);
        return;
      }
    }
  }
}

$.extend( jQuery.timeago.settings.strings, {prefixFromNow: 'TIMEAGOFROMNOWPREFIX',suffixAgo: 'ago',suffixFromNow: 'from now',seconds: 'less than a minute',minute: 'about a minute',minutes: '%d minutes',hour: 'about an hour',hours: 'about %d hours',day: 'a day',days: '%d days',month: 'about a month',months: '%d months',year: 'about a year',years: '%d years'});$( '.activityTimeago' ).timeago({ allowFuture: true });$( '#activityForm' ).ajaxForm({beforeSend: function( jqXHR, settings ) {$( '.activityButtonMore' ).addClass( 'disabled' ).html( 'Loading...' );},success: function( data, textStatus, jqXHR ) {if ( data.replace( /^\s+|\s+$/, '' ) ) {var newData = $( data );if ( newData.length ) {$( '.activityPaging' ).fadeOut( 'fast', function() {$( this ).replaceWith( newData.hide() );$( '.activityTimeago' ).timeago({ allowFuture: true });newData.fadeIn( 'slow' );});}}}});$( '#activityForm' ).delegate( '.activityButtonMore', 'click', function() {$( '#activityForm' ).submit();});$( window ).scroll( function() {if ( ( $( window ).scrollTop() + $( window ).height() ) > ( $( document ).height() - $( '#activityForm' ).offset().top ) ) {var isVisible = false;var tab = $( '#cbtab23' );if ( tab.length ) {if ( tab.is( ':visible' ) ) {isVisible = true;}} else {isVisible = true;}if ( isVisible ) {var more = $( '.activityButtonMore' );if ( more.length ) {more.trigger( 'click' );}}}});var activityUpdateCount = 0;var activityAutoUpdate = setInterval( function() {var first = $( '#activityForm' ).children().first();if ( first.length ) {var id = first.attr( 'id' );if ( id ) {id = id.replace( /activity/i, '' );$.ajax({url: '//index.php?option=com_comprofiler&task=tabclass&tab=cbactivityTab&Itemid=273&format=raw',type: 'POST',data: { 'tab_activity_last': id, 'tab_activity_ajax': 1 },success: function( data, textStatus, jqXHR ) {if ( data.replace( /^\s+|\s+$/, '' ) ) {var newData = $( data );if ( newData.length ) {$( '#activityForm' ).prepend( newData.hide() );$( '.activityTimeago' ).timeago({ allowFuture: true });newData.fadeIn( 'slow' );}}}});}}activityUpdateCount++;if ( activityUpdateCount >= 10 ) {clearInterval( activityAutoUpdate );}}, 60000 );
var tabPanegjTabs = new WebFXTabPane(document.getElementById("gjTabs"),true);


$('table.cbpbeditorButtons input[title],table.cbpbeditorButtons select[title]').each( function() { $(this).attr('title', $(this).attr('title').replace(/^([^:]*):(.*)$/, '$1|$2') ); } );
$('table.cbpbeditorButtons input[title]').cluetip( { splitTitle: '|', arrows: true, cursor: '', width: 400, dropShadow: false, cluetipClass: 'jtip', fx: { open: 'fadeIn', openSpeed: 'fast' } /*, positionBy: 'bottomTop' */ });
$('table.cbpbeditorButtons select[title]').cluetip({ activation: 'focus', splitTitle: '|', arrows: true, cursor: '', width: 400, dropShadow: false, cluetipClass: 'jtip', fx: { open: 'fadeIn', openSpeed: 'fast' } });

var tabPanecb_tabmain = new WebFXTabPane(document.getElementById("cb_tabmain"),false);
var tabPanecb_tabmain;
cbshowtabsArray.push( [['articles','12','getauthortab'],'tabPanecb_tabmain.setSelectedIndex( 0 );'] );
cbshowtabsArray.push( [['connections','15','getconnectiontab'],'tabPanecb_tabmain.setSelectedIndex( 1 );'] );
cbshowtabsArray.push( [['activity','23','cbactivitytab'],'tabPanecb_tabmain.setSelectedIndex( 2 );'] );
cbshowtabsArray.push( [['invites','31','cbinvitestab'],'tabPanecb_tabmain.setSelectedIndex( 3 );'] );
cbshowtabsArray.push( [['groups','32','cbgjtab'],'tabPanecb_tabmain.setSelectedIndex( 4 );'] );

var tabPanecb_underall = new WebFXTabPane(document.getElementById("cb_underall"),false);
var tabPanecb_underall;
cbshowtabsArray.push( [['profile gallery','24','getprofilegallerytab'],'tabPanecb_underall.setSelectedIndex( 0 );'] );
cbshowtabsArray.push( [['profilebook','26','getprofilebooktab'],'tabPanecb_underall.setSelectedIndex( 1 );'] );
cbshowtabsArray.push( [['profileblog','27','getprofilebookblogtab'],'tabPanecb_underall.setSelectedIndex( 2 );'] );
cbshowtabsArray.push( [['profilewall','28','getprofilebookwalltab'],'tabPanecb_underall.setSelectedIndex( 3 );'] );

var tabPanenot_on_profile_1 = new WebFXTabPane(document.getElementById("not_on_profile_1"),false);
var tabPanenot_on_profile_1;
cbshowtabsArray.push( [['user information','33'],'tabPanenot_on_profile_1.setSelectedIndex( 0 );'] );
});
if ( typeof window.cbjqldr_tmpsave$ != 'undefined' ) {
  window.$ = window.cbjqldr_tmpsave$;
}
if ( typeof window.cbjqldr_tmpsavejquery != 'undefined' ) {
  window.jQuery = window.cbjqldr_tmpsavejquery;
}
--></script>
      <!--LiveInternet counter--><script type="text/javascript"><!--
new Image().src = "//counter.yadro.ru/hit?r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random();//--></script><!--/LiveInternet-->

        <link href="/components/com_comprofiler/plugin/templates/bootstrap/template.css" rel="stylesheet">
 <link rel="stylesheet" href="/components/com_comprofiler/plugin/user/plug_cbactivity/templates/default/template.css" type="text/css">
  <link rel="stylesheet" href="/components/com_comprofiler/plugin/user/plug_cbinvites/templates/default/template.css" type="text/css">
  <link rel="stylesheet" href="/components/com_comprofiler/plugin/user/plug_cbgroupjive/templates/default/template.css" type="text/css">
         <link href="/components/com_foxcontact/css/neon.css" rel="stylesheet">
       <style type="text/css">
.cbpgToggleEditor { padding-right: 14px; margin-bottom: 10px; }
.cbpgEditorHidden { background: url(/components/com_comprofiler/plugin/user/plug_cbprofilegallery/images/none-arrow.gif) no-repeat right; }
.cbpgEditorVisible { background: url(/components/com_comprofiler/plugin/user/plug_cbprofilegallery/images/block-arrow.gif) no-repeat right; }
.cbpgQuotas { padding: 10px 0px; }
.cbpgAdd { padding: 10px 0px 30px; }
.cbpgAdd label { }
label.cbpgInvalid { color: red; font-weight: bold; font-size:110%; margin-left: 8px; }
input.cbpgInvalid { border-color: red; }
.cbpbToggleEditor { padding-right: 14px; margin-bottom: 10px; }
.cbpbEditorHidden { background: url(/components/com_comprofiler/plugin/user/plug_cbprofilebook/smilies/none-arrow.gif) no-repeat right; }
.cbpbEditorVisible { background: url(/components/com_comprofiler/plugin/user/plug_cbprofilebook/smilies/block-arrow.gif) no-repeat right; }
.cbpbMainArea { margin-top: 16px; }
.cbpbBlog .cbpbSnglMsgAll, .cbpbBlog .cbpbTopSep { width:65%; margin: auto; }
.cbpbBlog .cbpbEditorsArea { width:auto; margin: 0px 0px 0px 17.5%; }
.pbTitle { font-size: 140%; }
.cbpbNew { background-color: #ffcc66; color: #332200; padding: 3px 3px 1px; margin-left: 5px; }
hr.cbpbSepMsg { border: 0px; width:100%; height: 2px; background-color: #ddd; }
.cbpbDateInfo { float:left; width:70%; }
.cbpbBlog .cbpbDateInfo { margin-bottom: 10px; }
.cbpbRateInfo { float:right; width:25%;text-align:right; }
.cbpbEditorContainer { border: 2px solid #ccc; background-color:#f4f4f4; margin: 0px 0px 20px; padding: 10px; display: block; width: auto; }
div.pbTitleInput { margin: 12px 0px; }
input.pbTitleBox { font-size:130%; font-weight:bold; }
.pbTitleInput .fieldCell, .pbCommentInput .fieldCell { display: block; }
.pbCommentInput .fieldCell td { padding: 0px; vertical-align: middle; }
.cbpbeditorButtons select.inputbox { vertical-align: baseline; }
.cbpbEditorTexts { padding: 0px; border: 0px; margin: 0px; border-collapse: collapse; }
#smoothtop{
  background: url(http://style.vseinstrumenti.ru/res/img/icon/naverh.png) 0 0 no-repeat;
background-position: 0 0px;
width: 83px;
height: 28px;
position: fixed;
top: 1px;
left: 0;
z-index: 2000;
display: none;
  
}

#smoothtop:hover{background-position: center bottom;}
.cf_ajax_loader{background-image:url(/images/stories/customfilters/loaders/spinner.gif) !important;background-position:center center;background-repeat:no-repeat !important;}#cf_res_ajax_loader{background-image:url(//images/stories/customfilters/loaders/spinner2.gif) !important;background-repeat:no-repeat !important;}
  </style>
      
        <script src="/templates/beez_20/js/jquery.js"></script>
        <script src="/templates/beez_20/js/jquery.bxslider.js"></script>
        <script src="/templates/beez_20/js/modernizr.custom.08346.js"></script>

        <script>
            $(document).ready(function() {
                $('.bx-slider-top').bxSlider({
                    minSlides: 1,
                    maxSlides: 1,
                    auto: true,
                    mode: 'fade',
                    controls: true

                });
                $('.bx-slider-bottom').bxSlider({
                    minSlides: 1,
                    maxSlides: 1,
                    auto: true,
                    mode: 'fade',
                    speed: 1500,
                    controls: true

                });
                $('.partners').bxSlider({
                    slideWidth: 99,
                    minSlides: 6,
                    maxSlides: 6,
                    moveSlides: 1,
                    slideMargin: 20,
                    pager: false

                });
            });
        </script>
    
    
<style>
#slider-wrap{ /* Оболочка слайдера и кнопок */
  width:420px; 
  }
#slidern{ /* Оболочка слайдера */
width: 420px;
height: 290px;
  overflow: hidden;
  position:relative;}
.sliden{ /* Слайд */
  width:100%;
  height:100%;
  }
.sli-links{ /* Кнопки смены слайдов */
  margin-top:10px;
  text-align:center;}
.sli-links .control-slide{
  margin:2px;
  display:inline-block;
  width:16px;
  height:16px;
  overflow:hidden;
  text-indent:-9999px;
    background:url("/templates/beez_20/images/radioBg.png") center bottom no-repeat;}
.sli-links .control-slide:hover{
  cursor:pointer;
  background-position:center center;}
.sli-links .control-slide.active{
  background-position:center top;}
#prewbutton, #nextbutton{ /* Ссылка "Следующий" и "Педыдущий" */
  display:block;
  width:15px;
  height:100%;
  position:absolute;
  top:0;
  overflow:hidden;
  text-indent:-999px;
  background:url(arrowBg.png) left center no-repeat;
  opacity:0.8;
  z-index:3;
  outline:none !important;}
#prewbutton{left:10px;}
#nextbutton{
  right:10px;
  background:url(arrowBg.png) right center no-repeat;}
#prewbutton:hover, #nextbutton:hover{
  opacity:1;}
</style>
<script>

/*

HW Slider - простой слайдер на jQuery. 

Настройки скрипта:

hwSlideSpeed - Скорость анимации перехода слайда.
hwTimeOut - время до автоматического перелистывания слайдов.
hwNeedLinks - включает или отключает показ ссылок "следующий - предыдущий". Значения true или false

Подробнее на http://heavenweb.ru/

*/
(function ($) {
var hwSlideSpeed = 700;
var hwTimeOut = 0;
var hwNeedLinks = true;

$(document).ready(function(e) {
  $('.sliden').css(
    {"position" : "absolute",
     "top":'0', "left": '0'}).hide().eq(0).show();
  var slideNum = 0;
  var slideTime;
  slideCount = $("#slidern .sliden").size();
  var animSlide = function(arrow){
    clearTimeout(slideTime);
    $('.sliden').eq(slideNum).fadeOut(hwSlideSpeed);
    if(arrow == "next"){
      if(slideNum == (slideCount-1)){slideNum=0;}
      else{slideNum++}
      }
    else if(arrow == "prew")
    {
      if(slideNum == 0){slideNum=slideCount-1;}
      else{slideNum-=1}
    }
    else{
      slideNum = arrow;
      }
    $('.sliden').eq(slideNum).fadeIn(hwSlideSpeed, rotator);
    $(".control-slide.active").removeClass("active");
    $('.control-slide').eq(slideNum).addClass('active');
    }
if(hwNeedLinks){
var $linkArrow = $('<a id="prewbutton" href="#">&lt;</a><a id="nextbutton" href="#">&gt;</a>')
  .prependTo('#slidern');    
  $('#nextbutton').click(function(){
    animSlide("next");
    return false;
    })
  $('#prewbutton').click(function(){
    animSlide("prew");
    return false;
    })
}
  var $adderSpan = '';
  $('.sliden').each(function(index) {
      $adderSpan += '<span class = "control-slide">' + index + '</span>';
    });
  $('<div class ="sli-links">' + $adderSpan +'</div>').appendTo('#slider-wrap');
  $(".control-slide:first").addClass("active");
  $('.control-slide').click(function(){
  var goToNum = parseFloat($(this).text());
  animSlide(goToNum);
  });
  var pause = true;
  var rotator = function(){
    if(!pause){slideTime = setTimeout(function(){animSlide('next')}, hwTimeOut);}
      }
  $('#slider-wrap').hover(  
    function(){clearTimeout(slideTime); pause = true;},
    function(){pause = true; rotator();
    });
  rotator();
});
})(jQuery);

</script>

    </head>
    <body>
        <div class="wraper">
            <header class="clearfix" id="header">
                <div class="logo fl-l">
                                <jdoc:include type="modules" name="logo" />
                </div>
                <div class="cabinet fl-l">
                  <?php
$user =& JFactory::getUser();
?>
<?php if($user->guest) : ?>
<div id="user1">
                <jdoc:include type="modules" name="cabinet" />
</div>
<?php endif ?>
                  <jdoc:include type="modules" name="cabinet2" />

                </div>
                <div class="telephone fl-l">
                <jdoc:include type="modules" name="telephone" />
                </div>
                <div class="search fl-l">
                  <p class="lang"><a href="index.php/kz/"><img src="images/1-fl.png" border="0" alt="" /></a>  <a href="index.php/ru/"><img src="images/2-fl.png" border="0" alt="" /></a>  <a href="index.php/ar/"><img src="images/3-fl.png" border="0" alt="" /></a>  <a href="index.php/zh/"><img src="images/4-fl.png" border="0" alt="" width="16" height="13" /></a>  <a href="index.php/en/"><img src="images/5-fl.png" border="0" alt="" /></a></p>
                    <form>
                       </form>
                      <div class="sear"> <jdoc:include type="modules" name="search" /></div>
                   
                </div>
            </header>
            <nav class="main-menu">
                            <jdoc:include type="modules" name="main-menu" />

            </nav>
            
                
          

          
          
          
                     <jdoc:include type="modules" name="slid" />
                
               
             <section class="content clearfix">
                <div class="single-left fl-l">
                    <div class="singl-block">
                        <ul class="bx-slider-bottom">
                            <li>
                            <jdoc:include type="modules" name="dav" />
                            </li>
                            <li>
                        <jdoc:include type="modules" name="dav2" />
                            </li>
                        </ul>
                    </div>
                <div class="clear"></div>
                   <div class="news fl-l clearfix">
                       
                            <div class="row">
                                                      <jdoc:include type="modules" name="news2" />
                          
                           </div>
                      </div>
                               
                           
                    <div class="about fl-l">
                     <jdoc:include type="modules" name="about" />
                    </div>
               </div>
                <div class="single-right fl-r">
                    
                            <div class="row">
                        <jdoc:include type="modules" name="news" />
<jdoc:include type="modules" name="login111" style="xhtml" />
                            </div>
                        </div>
                    
               
            </section>
                    <div class="left"> <jdoc:include type="modules" name="left" /></div>

           <jdoc:include type="message" /> <jdoc:include type="component" />

            <div><jdoc:include type="modules" name="partner" /></div>
          
       <div class="separator">

            </div>

        </div></div>
   
            <div class="wrap-footer clearfix">
                <div class="info-block fl-l">
                                    <jdoc:include type="modules" name="footer1" />
            
                </div>
                <div class="nav-footer fl-l"> 
                <jdoc:include type="modules" name="footer2" />

                </div>
                <div class="social-b fl-l">
                                <jdoc:include type="modules" name="social" />
                </div>
                <div class="social-m fl-l">
                   <script type="text/javascript" src="//yandex.st/share/share.js"
charset="utf-8"></script>
<div class="yashare-auto-init" data-yashareL10n="ru"
 data-yashareType="icon" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir,lj,friendfeed,moikrug,gplus,surfingbird"

                  ></div> <div style="text-align:right;padding:5px;"><!--LiveInternet logo--><a href="http://www.liveinternet.ru/click"
target="_blank"><img src="//counter.yadro.ru/logo?11.16"
title="LiveInternet: показано число просмотров за 24 часа, посетителей за 24 часа и за сегодня"
alt="" border="0" width="88" height="31"/></a><!--/LiveInternet-->


</div>

                  

                </div>
            </div>
            <div class="studio">
            <jdoc:include type="modules" name="studio" />
            </div>
            <script src="/templates/beez_20/js/bootstrap.min.js"></script>
      <script src="/templates/beez_20/js/jquery.totemticker.min.js?v=<?php echo time(); ?>"></script>
    <script>
        $('.news-list').totemticker({ row_height: '180px', });
    </script>
      
<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = '145441';
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);})();</script>
<!-- {/literal} END JIVOSITE CODE -->
    </body>
</html>