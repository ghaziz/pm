<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/icon.png">

    <!--( Bootstrap core CSS )-->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/fonts/font-awesome-4/css/font-awesome.min.css" />


    <!--( HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries )-->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.niftymodals/css/component.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/pwt.datepicker-master/pwt.datepicker-master/dist/css/persian-datepicker-0.3.6.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.nanoscroller/nanoscroller.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div id="cl-wrapper">

    <div class="cl-sidebar">
        <div class="cl-toggle"><i class="fa fa-bars"></i></div>
        <div class="cl-navblock">
            <div class="menu-space">
                <div class="content">
                    <div class="sidebar-logo">
                        <div class="logo">
                            <a href="index2.html"></a>
                        </div>
                    </div>
                    <!--
                    <div class="side-user">
                      <div class="avatar"><img src="images/avatar6.jpg" alt="Avatar" /></div>
                      <div class="info">
                        <p>40 <b>GB</b> / 100 <b>GB</b><span><a href="#"><i class="fa fa-plus"></i></a></span></p>
                        <div class="progress progress-user">
                          <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                            <span class="sr-only">50% Complete (success)</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    -->
                    <ul class="cl-vnavigation">
                        <li><a href="index-2.html"><i class="fa fa-home"></i><span>پیشخوان</span></a></li>
                        <li><a href="#"><i class="fa fa-smile-o"></i><span>شرکت ها</span></a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo $this->createUrl('company/index'); ?>">لیست شرکت ها</a></li>
                                <li><a href="#" class="md-trigger" data-modal="globalModal" onclick="showModal('<?php echo $this->createAbsoluteUrl('company/new')?>')">ایجاد</a></li>
                                <li><a href="<?php echo $this->createUrl('company/attachments'); ?>">پیوست ها</a></li>
                            </ul>
                        </li>
                        <li><a href="#"><i class="fa fa-list-alt"></i><span>پروژه ها</span></a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo $this->createUrl('project/index'); ?>">لیست پروژه ها</a></li>
                                <li><a href="#" class="md-trigger" data-modal="globalModal" onclick="showModal('<?php echo $this->createAbsoluteUrl('project/new')?>')">ایجاد</a></li>
                            </ul>
                        </li>
                        <li><a href="#"><i class="fa fa-list-alt"></i><span>تسک ها</span></a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo $this->createUrl('task/index'); ?>">لیست تسک ها</a></li>
                                <li><a href="#" class="md-trigger" data-modal="globalModal" onclick="showModal('<?php echo $this->createAbsoluteUrl('task/new')?>')">ایجاد</a></li>
                            </ul>
                        </li>
                        <li><a href="#"><i class="fa fa-list-alt"></i><span>کاربران</span></a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo $this->createUrl('users/index'); ?>">لیست کاربران</a></li>
                                <li><a href="#" class="md-trigger" data-modal="globalModal" onclick="showModal('<?php echo $this->createAbsoluteUrl('users/new')?>')">ایجاد</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="text-right collapse-button" style="padding:7px 9px;">
                <input type="text" class="form-control search" placeholder="جستجو..." />
                <button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;" class="fa fa-angle-left"></i></button>
            </div>
        </div>
    </div>
    <div class="container-fluid" id="pcont">
        <!-- TOP NAVBAR -->
        <div id="head-nav" class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-collapse">
                    <ul class="nav navbar-nav navbar-right user-nav">
                        <li class="dropdown profile_menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img alt="Avatar"
                                                                                            style="width: 25px"
                                                                                            src="<?php echo Yii::app()->user->image; ?>"/><span><?php echo Yii::app()->user->name; ?></span>
                                <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">حساب من</a></li>
                                <li><a href="#">پروفایل</a></li>
                                <li><a href="#">پیام ها</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo $this->createUrl('site/logout'); ?>">خروج</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav not-nav">
                        <li class="button dropdown">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class=" fa fa-inbox"></i></a>
                            <ul class="dropdown-menu messages">
                                <li>
                                    <div class="nano nscroller">
                                        <div class="content">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <img src="images/avatar2.jpg" alt="avatar" /><span class="date pull-right">13 دی.</span> <span class="name">محمد</span> سلام، خوبی؟
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="images/avatar_50.jpg" alt="avatar" /><span class="date pull-right">20 آر.</span><span class="name">هوشگ</span> سلام، این خبرت جالب بود.
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="images/avatar4_50.jpg" alt="avatar" /><span class="date pull-right">2 بهمن.</span><span class="name">هادی</span> موفق باشی!
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="images/avatar3_50.jpg" alt="avatar" /><span class="date pull-right">2 آذر.</span><span class="name">رضا</span> سلام، من رضا هستم.
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <ul class="foot"><li><a href="#">نمایش تمامی پیام ها </a></li></ul>
                                </li>
                            </ul>
                        </li>
                        <li class="button dropdown">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-globe"></i><span class="bubble">2</span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="nano nscroller">
                                        <div class="content">
                                            <ul>
                                                <li><a href="#"><i class="fa fa-cloud-upload info"></i><b>هادی</b> اکنون شما را دنبال می کند <span class="date">2 دقیقه پیش.</span></a></li>
                                                <li><a href="#"><i class="fa fa-male success"></i> <b>عباس</b> برای پیوند شما دیدگاهی ارسال کرده <span class="date">15 دقیقه پیش.</span></a></li>
                                                <li><a href="#"><i class="fa fa-bug warning"></i> <b>الهه</b> برای ارسال شما دیدگاه ارسال نمود <span class="date">30 دقیقه پیش.</span></a></li>
                                                <li><a href="#"><i class="fa fa-credit-card danger"></i> <b>زهرا</b> درخواستی برای شما ارسال نمود <span class="date">1 ساعت پیش.</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <ul class="foot"><li><a href="#">نمایش تمامی فعالیت ها </a></li></ul>
                                </li>
                            </ul>
                        </li>
                        <li class="button"><a class="toggle-menu menu-left push-body" href="javascript:;" class="speech-button"><i class="fa fa-comments"></i></a></li>
                    </ul>

                </div><!--/.nav-collapse animate-collapse -->
            </div>
        </div>


        <div class="cl-mcont">
            <?php echo $content; ?>
        </div>

    </div>

    <!-- start: Modal (every lightbox will/should use this construct to show content)-->
    <!-- Nifty Modal -->
    <div class="md-modal md-effect-1 md-trigger" id="globalModal">
        <div class="md-content">
            <div class="modal-header">
                <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                    <div class="loader"></div>
            </div>
        </div>
    </div>

</div>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/pwt.datepicker-master/pwt.datepicker-master/lib/persian-date.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/pwt.datepicker-master/pwt.datepicker-master/dist/js/persian-datepicker-0.3.6.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.cookie/jquery.cookie.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.pushmenu/js/jPushMenu.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.nanoscroller/jquery.nanoscroller.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.sparkline/jquery.sparkline.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ui/jquery-ui.js" ></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/behaviour/core.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.icheck/icheck.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.niftymodals/js/jquery.modalEffects.js"></script>

<!--( Bootstrap core JavaScript )-->
<!--<script src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/js/behaviour/voice-commands.js"></script>-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/app.js"></script>

</body>
</html>
