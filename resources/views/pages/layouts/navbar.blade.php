  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="#" class="brand-link">
          <img src="{{ asset('assets') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
              class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <div class="sidebar">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
              <div class="image">
                  <img src="{{ asset('assets') }}/images/profile/{{ Auth::user()->image }}" class="img-circle elevation-2"
                      alt="User Image" style="width: 35px; height: 35px;">
              </div>
              <div class="info">
                  <a href="/profile" class="d-block">{{ Auth::user()->name }}</a>
                  <span class="badge badge-primary">{{ Auth::user()->role->name }}</span>
              </div>
          </div>

          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <li class="nav-item">
                      <a href="/"
                          class="{{ request()->is('/') || request()->is('home') ? 'active' : '' }} nav-link">
                          <i class="fas fa-tachometer-alt nav-icon"></i>
                          <p>Dashboard</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fa fa-tasks"></i>
                          <p>
                              Task
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="/task" class="{{ request()->is('task') ? 'active' : '' }} nav-link">
                                  <i class="fa fa-check-square nav-icon"></i>
                                  <p>List</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="/task/history"
                                  class="{{ request()->is('task/history') ? 'active' : '' }} nav-link">
                                  <i class="fa fa-history nav-icon"></i>
                                  <p>History</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="fa fa-credit-card nav-icon"></i>
                          <p>
                              Finance
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="/finance" class="{{ request()->is('finance') ? 'active' : '' }} nav-link">
                                  <i class="fas fa-edit nav-icon"></i>
                                  <p>Transaction</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="/finance/history"
                                  class="{{ request()->is('finance/history') ? 'active' : '' }} nav-link">
                                  <i class="fa fa-history nav-icon"></i>
                                  <p>History</p>
                              </a>
                          </li>
                      </ul>
                  </li>
              </ul>
          </nav>
      </div>
  </aside>
