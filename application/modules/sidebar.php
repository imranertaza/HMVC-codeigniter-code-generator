<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php print base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Al-Mamun</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Working</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <?php                                                                    
            echo add_main_menu('Prescription', 'prescription', 'prescription', 'fa fa-medkit');
            echo add_main_menu('Medicine', 'medicine', 'medicine', 'fa fa-cubes');
            echo add_main_menu('Advice', 'advice', 'advice', 'fa fa-user-md');
            echo add_main_menu('Category', 'category', 'category', 'fa fa-table');
            echo add_main_menu('Company', 'company', 'company', 'fa fa-hospital-o');
            echo add_main_menu('Settings', 'settings', 'settings', 'fa fa-gears');
           ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>