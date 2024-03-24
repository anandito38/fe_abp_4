<header class="header_section">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('images/logo.png') }}" alt="logo" height="70">
                <span style="font-family: 'Bodoni Svtytwo SC ITC TT Book', serif; letter-spacing: 2px;">
                    Telyu Canteen
                </span>

            </a>
            <div class="" id="">
                <div class="User_option">
                    <form class="form-inline ">
                        
                        <input type="search" placeholder="Search">
                        <button class="btn  nav_search-btn" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
                <div class="custom_menu-btn">
                    <button onclick="openNav()">
                        <img src="{{ asset('images/menu.png') }}" alt="">
                    </button>
                </div>
                <div id="myNav" class="overlay">
                    <div class="overlay-content">
                        <a href="/">Home</a>
                        <a href="/menu/all">Menu</a>
                        <a href="/shop/all">Toko</a>
                        <a href="/">Testimonial</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
