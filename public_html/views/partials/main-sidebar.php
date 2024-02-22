  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
          <img src="<?= UPLOADS_PATH; ?>AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light"><?= SOFTWARE_NAME; ?></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="<?= UPLOADS_PATH; ?>user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block"><?= $_SESSION['short_name']; ?></a>
              </div>
          </div>

          <!-- SidebarSearch Form
          <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
          </div> -->

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <!--
                  <li class="nav-item menu-open">
                      <a href="#" class="nav-link active">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Starter Pages
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="#" class="nav-link active">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Active Page</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="#" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Inactive Page</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Simple Link
                              <span class="right badge badge-danger">New</span>
                          </p>
                      </a>
                  </li>-->

                  <!-- <li class="nav-item">
                      <a href="dashboard" class="nav-link active">
                          <i class="nav-icon far fa-image"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li> -->
                  <li class="nav-item ">
                      <a href="#" class="nav-link active">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Agenda
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item <?php if ($viewName == 'schedule/index') {
                                                    echo 'menu-open';
                                                } ?>">
                              <a href="schedule" class="nav-link <?php if ($viewName == 'schedule/index') {
                                                                        echo 'active';
                                                                    } ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Calendário</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="#" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Compromissos</p>
                              </a>
                          </li>
                      </ul>
                  </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>