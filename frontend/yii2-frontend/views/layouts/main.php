<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

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
<style type="text/css">
    #header, .header, #footer {
        font-weight: bold;
        color: #fff;
        text-align: center;
        /* line-height: 50px; */
        height: 50px;
        font-size: 18px;
        padding: 16px;
    }

    #header a, .header a {
        float: left;
        color: #fff;
        text-decoration: none;
    }
    .mobile-logo{
        margin-left: 15px;
    }
</style>
<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <nav id="menu" class="mm-menu mm-menu_offcanvas">
            <ul>
                <li>
                    <a href="index.html">Blank link</a>
                    <ul>
                        <li><a href="#">First sub-item</a></li>
                        <li><a href="#">Second sub-item</a></li>
                        <li><a href="#">Third sub-item</a></li>
                    </ul>
                </li>
                <li><a href="index.html">Fixed header</a></li>
                <li><a href="horizontal-submenus.html">Horizontal submenus</a></li>
            </ul>
        </nav>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
            <div class="navbar-brand d-none d-lg-block">Bridge Campus</div>
        <div id="header" class="d-lg-none">
            <a class="mobile-menu" href="#menu"><i class="fas fa-bars"></i></a>
            <a class="mobile-logo" href="#">Bridge Campus</a>
        </div>
        <div class="collapse navbar-collapse">
<?php
echo Nav::widget([
    'items' => [
        [
            'label' => 'Home',
            'url' => ['site/index'],
            'linkOptions' => [],
        ],
        [
            'label' => 'Dropdown',
            'items' => [
                ['label' => 'Level 1 - Dropdown A', 'url' => '#'],
                    '<div class="dropdown-divider"></div>',
                    '<div class="dropdown-header">Dropdown Header</div>',
                ['label' => 'Level 1 - Dropdown B', 'url' => '#'],
            ],
        ],
        [
            'label' => 'Login',
            'url' => ['site/login'],
            'visible' => Yii::$app->user->isGuest
        ],
    ],
    'options' => ['class' =>'navbar-nav ml-auto'], // set this to nav-tab to get tab-styled navigation
]);
?>
</div>
</div>
</nav>
<!--         <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
            <div class="navbar-brand d-none d-lg-block ">Navbar</div>
        <div id="header" class="d-lg-none">
            <a class="mobile-menu" href="#menu"><i class="fas fa-bars"></i></a>
            <a class="mobile-logo" href="#"><strong>COMPANY LOGO</strong></a>
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
            </ul>
        </div>
    </div>
    </nav> -->
<!--     <div class="navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header">
                                
               <div id="header" class="visible-xs">
                    <a class="mobile-menu" href="#menu"> <span class="glyphicon glyphicon-menu-hamburger"></span></a>
                    <a class="mobile-logo" href="#"><strong>COMPANY LOGO</strong></a>
                </div>
                <a href="#" class="navbar-brand hidden-xs"><strong>COMPANY LOGO</strong></a>
                
            </div>

            <div class="collapse navbar-collapse" role="navigation">
                <ul class="nav navbar-nav navbar-right hidden-xs">
                    <li class="dropdown active">
                      <a id="drop4" role="button" data-toggle="dropdown" href="#">Blank link <b class="caret"></b></a>
                      <ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop4">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">First sub-item</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Second sub-item</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Third sub-item</a></li>
                    </ul>
                </li>
                <li><a href="index.html">Fixed header</a></li>
                <li><a href="horizontal-submenus.html" class="active">Horizontal submenus</a></li>
                <li><a href="left-right-mmenu.html">Left/Right menu</a></li>
            </ul>
        </div>
    </div>
</div> -->
<!--     <nav id="mymenu" class="navbar-inverse navbar-fixed-top navbar">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mymenu-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/bridgecampus/">My Application</a>
            </div>
            <div id="mymenu-collapse" class="collapse navbar-collapse">
                <ul id="w0" class="navbar-nav navbar-right nav">
                    <li><a href="/bridgecampus/site/index">Home</a></li>
                    <li><a href="/bridgecampus/site/about">About</a></li>
                    <li class="active"><a href="/bridgecampus/site/contact">Contact</a></li>
                    <li><a href="/bridgecampus/site/signup">Signup</a></li>
                    <li><a href="/bridgecampus/site/login">Login</a></li>
                </ul>
            </div>
        </div>
    </nav> -->
    <?php
/*    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'id'=>'mymenu',
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ])
    NavBar::end();*/
    ?>

    <div class="container">

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>


<?php $this->endBody() ?>
</body>
<?php $this->registerJs("
    $(function() {
        //$('nav#menu').mmenu();
        //$('nav#menu').show();
            new Mmenu( document.querySelector( '#menu' ));
            document.addEventListener( 'click', function( evnt ) {
                var anchor = evnt.target.closest( \"a[href^='#/']\" );
                if ( anchor ) {
                    alert('Thank you for clicking, but that\'s a demo link.');
                    evnt.preventDefault();
                }
            });
        });
 "); ?>
 </html>
<?php $this->endPage() ?>
