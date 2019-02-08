<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\widgets\Menu;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?= Html::csrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <?php $this->beginBody() ?>

  <div class="wrapper">
    <header class="main-header">
      <!-- Logo -->
      <a href="<?= Url::to(['site/dashboard']) ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>B</b>C</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">Bridge Campus</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?= Html::img('@web/images/avatar5.png',['height'=>"50px",'title'=>'CARE Training','class'=>'user-image'] ) ?>
                <span class="hidden-xs"><?= @Yii::$app->user->identity->fullname; ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <?= Html::img('@web/images/avatar5.png',['title'=>'CARE Training','class'=>'img-circle'] ) ?>
                  

                  <p>
                    <?= \Yii::$app->user->identity->fullname;?>
                  </p>
                </li>
                <!-- Menu Body -->
               <!--  <li class="user-body">
                  <div class="row">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </div>
                
                </li> -->
                <!-- Menu Footer-->
                <li class="user-footer" style="background-color: #367fa9;">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?= Url::to(['site/logout']) ?>" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <li>
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <aside class="main-sidebar">
      <section class="sidebar">
        <?php echo Menu::widget([
          'options' => ['class' => 'sidebar-menu', 'id'=>'side-menu','data-widget'=>"tree"],
          'items' => [
            ['label' => '<i class="fa fa-home"></i> <span>Dashboard</span>', 'url' => ['/site/dashboard']],
            ['label' => '<i class="fa fa-book" aria-hidden="true"></i> <span>Courses</span>', 'url' => ['/courses/index']],
            ['label' => '<i class="fa fa-university" aria-hidden="true"></i> <span>University</span>', 'url' => ['/university/index']],
            ['label' => '<i class="fa fa-university" aria-hidden="true"></i> <span>Colleges</span>', 'url' => ['/college/index']],
            ['label' => '<i class="fa fa-file" aria-hidden="true"></i> <span>Exam</span>', 'url' => ['/exam/index']],
            ['label' => '<i class="fa fa-file-text" aria-hidden="true"></i> <span>News / Articals</span>', 'url' => ['/news-artical/index']],
            ['label' => '<i class="fa fa-user" aria-hidden="true"></i> <span>User</span>', 'url' => ['/user/index']],
            ['label' => '<i class="fa fa-tasks" aria-hidden="true"></i> <span> Advertise</span>', 'url' => ['/advertise/index']],

            [
              'label' => 'Master',
              'url' => ['#'],
              'options'=>['class'=>'treeview'],
              'template' => '<a href="#"><i class="fa fa-edit"></i> <span>{label}</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span></a>',
              'items' => [
                ['label' => 'Specialization', 'url' => ['/specialization/index']],
                ['label' => 'Program', 'url' => ['/program/index']],
                ['label' => 'Exam Category', 'url' => ['/exam-category/index']],
                ['label' => 'Affiliate', 'url' => ['/affiliate/index']],
                ['label' => 'Accredited', 'url' => ['/accredited/index']],
                ['label' => 'Approved', 'url' => ['/approved/index']],
                ['label' => 'Front End', 'url' => ['/frontend/index']],
              ],
            ],
          ],
          'submenuTemplate' => "\n<ul class='treeview-menu'>\n{items}\n</ul>\n",
        'encodeLabels' => false, //allows you to use html in labels
        'activateParents' => true,
      ]);

      ?>

    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="app-title">
        <?= Html::encode($this->title) ?>
      </h1>
      <?= isset($this->params['subtitle']) ? $this->params['subtitle'] : '';?>
     <!--  <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol> -->
      <?= Breadcrumbs::widget([
              'homeLink' => [ 
              'label' => 'Dashboard',
              'url' => Yii::$app->homeUrl,
              'template' => "<li><i class='fa fa-dashboard'></i> {link}</li>\n",
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </section>

    <!-- Main content -->
    <section class="content">
     <?= $content ?> 
   </section>
   <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->
 <footer class="main-footer">
  <strong>Copyright &copy; <?= date('Y') ?> <a href="<?= Url::home() ?>">Bridge Campus</a>.</strong> All rights
  reserved.
</footer>

<div class="control-sidebar-bg"></div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
