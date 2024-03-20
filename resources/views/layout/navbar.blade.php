<header class="header_section">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
            <a class="navbar-brand" href="index.html">
                <span>
                    Delfood
                </span>
            </a>
            {{--  --}}
            <div class="" id="">
                <div class="User_option">
                    @if (isset($cekLogin))
                    <a href="/logoutt">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span>{{$userAuth['nickname']}}</span>
                    </a>
                    @else
                    <a href="/login">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span>Login</span>
                    </a>
                    @endif
                    <form class="form-inline ">
                        <input type="search" placeholder="Search" />
                        <button class="btn  nav_search-btn" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
                <div class="custom_menu-btn">
                    <button onclick="openNav()">
                        <img src="images/menu.png" alt="">
                    </button>
                </div>
                <div id="myNav" class="overlay">
                    <div class="overlay-content">
                        <a href="/">Home</a>
                        <a href="/">Menu</a>
                        <a href="shop">Toko</a>
                        <a href="testimonial.html">Testimonial</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>