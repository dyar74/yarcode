<?php
/**
 * Created by PhpStorm.
 * User: Yar
 * Date: 07.09.2016
 * Time: 20:46
 */
use yii\helpers\Html;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\widgets\Breadcrumbs;
use frontend\assets\AgencyAsset;
use frontend\widgets\PortfoliosWidget;
use kartik\alert\AlertBlock;

AgencyAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- Custom Fonts -->
     <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body id="page-top" class="index">
<?php $this->beginBody() ?>


<!-- Navigation -->
<?php
NavBar::begin([
    'id' => 'mainNav',
    'brandLabel' => 'Start Bootstrap',
    'brandUrl' => '/#page-top',
    'options' => ['class' =>'navbar navbar-default navbar-custom navbar-fixed-top' ],

    ]);
echo Nav::widget([
     'items' => [
        ['label' => '', 'url' => ['/#page-top'],
            'options' => ['class' => 'hidden'],
            'linkOptions' =>['class'=>'page-scroll']
        ],
        ['label' => 'Services', 'url' => ['/#services' ],
            'linkOptions' =>['class'=>'page-scroll', 'data-target' => "#services"]
        ],
        ['label' => 'Portfolio', 'url' => ['/#portfolio'],
            'linkOptions' =>['class'=>'page-scroll',  'data-target' => "#portfolio"]
        ],
        ['label' => 'About', 'url' => ['/#about'],
            'linkOptions' =>['class'=>'page-scroll',  'data-target' => "#about"]
        ],
        ['label' => 'Team', 'url' => ['/#team'],
            'linkOptions' =>['class'=>'page-scroll',  'data-target' => "#team"]
        ],
        ['label' => 'Contact', 'url' => ['/#contact'],
            'linkOptions' =>['class'=>'page-scroll',  'data-target' => "#contact"]
        ],
    ],

    'options' => [
        'class' => 'nav navbar-nav navbar-right',
    ],
    'encodeLabels' => false,
]);
NavBar::end();
?>

<!-- Header -->
<header>
    <div class="container">
        <div class="intro-text">
            <div class="intro-lead-in">Welcome To Our Studio!</div>
            <div class="intro-heading">It's Nice To Meet You</div>
            <a href="#services" class="page-scroll btn btn-xl">Tell Me More</a>
        </div>
    </div>
</header>

    <?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>

        <?= AlertBlock::widget([
            'useSessionFlash' => true,
            'type' => AlertBlock::TYPE_GROWL
        ]); ?>

    <?php endforeach; ?>
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= $content ?>


<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <span class="copyright">Copyright &copy; Your Website 2016</span>
            </div>
            <div class="col-md-4">
                <ul class="list-inline social-buttons">
                    <li><a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul class="list-inline quicklinks">
                    <li> <?=Html::a('Privacy Policy', Yii::$app->urlManager->createUrl(['/site/page', 'view' => 'policy'])) ;?>
                    </li>
                    <li><?=Html::a('Terms of Use',Yii::$app->urlManager->createUrl(['/site/page', 'view' => 'terms'])) ;?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- Portfolio Modals -->
<!-- Use the modals below to showcase details about your portfolio projects! -->
<?= PortfoliosWidget::widget(['view' => 'block']); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>