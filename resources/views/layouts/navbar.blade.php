<aside class="main-sidebar" style="background-color: #f4f6f9">
    <a href="#" class="brand-link">
        <img src="{{ asset('assets') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <div class="sidebar">
        <a href="/{{ strtolower(Auth::user()->role->name) }}/profile"
            class="user-panel mt-3 py-2 mb-3 d-flex align-items-center rounded">
            <div class="image">
                <img src="{{ asset('assets') }}/images/profile/{{ Auth::user()->image }}" class="img-circle elevation-2"
                    alt="User Image" style="width: 35px; height: 35px;">
            </div>
            <div class="info test">
                <div class="d-block">{{ Auth::user()->name }}</div>
                <span class="badge py-1 px-2" style="background-color: #f3797e">{{ Auth::user()->role->name }}</span>
            </div>
        </a>

        <nav class="mt-2 main-menu">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-header">MAIN MENU</li>
                <li class="nav-item">
                    <a href="/{{ strtolower(Auth::user()->role->name) }}"
                        class="{{ request()->is('/') || request()->is('admin') ? 'active' : '' }} nav-link">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @if (Auth::user()->role_id === 1)
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-chalkboard-teacher nav-icon"></i>
                            <p>
                                Teacher
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('teacher-list') }}"
                                    class="{{ request()->is('teacher/list') ? 'active' : '' }} nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Teacher List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('teacher-add') }}"
                                    class="{{ request()->is('teacher/add') ? 'active' : '' }} nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Teacher Add</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="{{ request()->is('task/history') ? 'active' : '' }} nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Teacher Edit</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="{{ request()->is('task/history') ? 'active' : '' }} nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Teacher Detail</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-graduation-cap nav-icon"></i>
                            <p>
                                Student
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('student-list') }}"
                                    class="{{ request()->is('student/list') ? 'active' : '' }} nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Student List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('student-add') }}"
                                    class="{{ request()->is('student/add') ? 'active' : '' }} nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Student Add</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#"
                                    class="{{ request()->is('finance/history') ? 'active' : '' }} nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Student Edit</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#"
                                    class="{{ request()->is('finance/history') ? 'active' : '' }} nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Student Detail</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fa fa-credit-card nav-icon"></i>
                            <p>
                                Subject
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('course-list') }}"
                                    class="{{ request()->is('student/list') ? 'active' : '' }} nav-link">
                                    <i class="fas fa-edit nav-icon"></i>
                                    <p>Subject List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('course-add') }}"
                                    class="{{ request()->is('student/add') ? 'active' : '' }} nav-link">
                                    <i class="fa fa-history nav-icon"></i>
                                    <p>Subject Add</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#"
                                    class="{{ request()->is('finance/history') ? 'active' : '' }} nav-link">
                                    <i class="fa fa-history nav-icon"></i>
                                    <p>Subject Edit</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('setting') }}"
                            class="{{ request()->is('setting') ? 'active' : '' }} nav-link">
                            <i class="fas fa-tachometer-alt nav-icon"></i>
                            <p>Setting</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
    <script type="text/javascript">
        var navParent = document.querySelectorAll("ul.nav-treeview");
        var checkElement = false;
        for (let i = 0; i < navParent.length; i++) {
            let navChild = [].slice.call(navParent[i].children);
            for (let j = 0; j<navChild.length; j++){
                if(navChild[j].children[0].className.includes("active")){
                    navParent[i].parentElement.classList.add("menu-is-opening");
                    navParent[i].parentElement.classList.add("menu-open");
                    navChild[j].setAttribute("style","display: block");
                    break;
                }
            }
        }
    </script>
</aside>
