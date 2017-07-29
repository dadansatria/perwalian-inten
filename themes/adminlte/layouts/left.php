<?php

use app\models\User;

?>

<aside class="main-sidebar">
    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username; ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form> 
        <!-- /.search form -->

        <!-- ADMIN -->

        <?php if(User::isAdmin()){ ?>

            <?= dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [

                        ['label' => 'Dosen', 'icon' => 'check-square-o', 'url' => ['dosen/index'],],
                        ['label' => 'Jurusan', 'icon' => 'warning', 'url' => ['jurusan/index'],],
                        ['label' => 'Mata Kuliah', 'icon' => 'warning', 'url' => ['makul/index'],],
                        ['label' => 'Perwalian', 'icon' => 'user-circle', 'url' => ['perwalian/index'],],
                        ['label' => 'User', 'icon' => 'user', 'url' => ['/user'],],
                        ['label' => 'Logout', 'url' => ['site/logout'], 'template' => '<a href="{url}" data-method="post">{icon} {label}</a>' , 'visible' => !Yii::$app->user->isGuest],
                    ],
                ]
            ) ?>
        <?php } ?>

        <?php if(User::isDosen()){ ?>

            <?= dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'DOSEN WALI','options' => ['class' => 'header']],
                        ['label' => 'Belum Ditandatangan', 'icon' => 'check-square-o', 'url' => ['perwalian/index','status'=>2],],
                        ['label' => 'Sudah Ditandatangan', 'icon' => 'check-square-o', 'url' => ['perwalian/index','status'=>1],],

                        ['label' => 'DOSEN MATKUL','options' => ['class' => 'header']],
                        ['label' => 'Belum Dinilai', 'icon' => 'warning', 'url' => ['perwalian-matkul/index','status'=>2],],
                        ['label' => 'Sudah Dinilai', 'icon' => 'user-circle', 'url' => ['perwalian-matkul/index','status'=>1],],

                        ['label' => 'SISTEM','options' => ['class' => 'header']],
                        ['label' => 'User', 'icon' => 'user', 'url' => ['/user'],],
                        ['label' => 'Logout', 'url' => ['site/logout'], 'template' => '<a href="{url}" data-method="post">{icon} {label}</a>' , 'visible' => !Yii::$app->user->isGuest],
                    ],
                ]
            ) ?>
        <?php } ?>

        <?php if(User::isMahasiswa()){ ?>
            <?= dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'Mata Kuliah', 'icon' => 'check-square-o', 'url' => ['mahasiswa/rekap'],],

                        ['label' => 'User', 'icon' => 'user', 'url' => ['/user'],],
                        ['label' => 'Logout', 'url' => ['site/logout'], 'template' => '<a href="{url}" data-method="post">{icon} {label}</a>' , 'visible' => !Yii::$app->user->isGuest],
                    ],
                ]
            ) ?>
        <?php } ?>

    </section>

</aside>
