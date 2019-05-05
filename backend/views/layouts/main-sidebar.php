<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\widgets\Menu;
?>    
    <aside class="main-sidebar">
      <section class="sidebar">
        <?php echo Menu::widget([
          'options' => ['class' => 'sidebar-menu', 'id'=>'side-menu','data-widget'=>"tree"],
          'items' => [
            ['label' => '<i class="fa fa-home"></i> <span>Dashboard</span>', 'url' => ['/site/dashboard']],
            ['label' => '<i class="fa fa-book" aria-hidden="true"></i> <span>Courses</span>', 'url' => ['/courses/index']],
            ['label' => '<i class="fa fa-university" aria-hidden="true"></i> <span>University</span>', 'url' => ['/university/index']],
            ['label' => '<i class="fa fa-building" aria-hidden="true"></i> <span>Colleges</span>', 'url' => ['/college/index']],
            ['label' => '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span>Exam</span>', 'url' => ['/exam/index']],
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