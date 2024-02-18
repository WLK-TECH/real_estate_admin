                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light topbar bg-light shadow static-top">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <span class="fw-bold text-dark pl-3" style="color: #666;">Hello, Delight Team!</span>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline" style="color: #666;">{{ Auth::user()->name }}</span>
                                @if (!Auth::user()->profile)
                                <img class="img-profile rounded-circle" src="{{ asset('assets/img/profile/profile.png') }}">
                                @else
                                <img class="img-profile rounded-circle" src="{{ Auth::user()->img_url }}">
                                @endif

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in text-center"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item text-secondary" href="{{ url('/profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2"></i>
                                    Profile
                                </a>

                                <a class="dropdown-item" href="">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <button type="submit" class="btn btn-sm">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                                            Logout
                                        </button>
                                    </form>

                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
