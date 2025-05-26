<?php
// Kiểm tra trạng thái đăng nhập (sử dụng session từ index.php)
$logged_in = isset($_SESSION['user']) ? true : false;
$user_name = $logged_in ? $_SESSION['user'] : '';
?>

<header id="site-header" class="main-header">
    <div class="topbar">
        <div class="container">
            <div class="top-bar-content text-center">
                <p>Miễn phí vận chuyển với đơn hàng trên 500K.</p>
            </div>
        </div>
    </div>

    <div class="header-middle">
        <div class="container">
            <nav class="desktop-menu hidden-xs hidden-sm">
                <ul class="menu-list">
                    <li><a href="../index.php">Trang chủ</a></li>
                    <li><a href="category.php?type=new-arrivals">Sản phẩm mới</a></li>
                    <li><a href="category.php?type=best-sellers">Bán chạy</a></li>
                    <li><a href="category.php?type=tops">Áo</a></li>
                    <li><a href="category.php?type=bottoms">Quần</a></li>
                    <li><a href="category.php?type=outerwear">Outerwear</a></li>
                    <li><a href="category.php?type=accessories">Phụ kiện</a></li>
                    <li><a href="category.php?type=sale">Giảm giá</a></li>
                </ul>
            </nav>

            <div class="flexContainer-header row-flex flexAlignCenter">
                <div class="header-upper-menu-mobile header-action hidden-md hidden-lg">
                    <div class="header-action-toggle site-handle" id="site-menu-handle">
                        <span class="hamburger-menu" aria-hidden="true">
                            <span class="bar"></span>
                        </span>
                    </div>
                    <div class="header_dropdown_content site_menu_mobile">
                        <span class="box-triangle"></span>
                        <div class="site-nav-container-menu">
                            <div class="menu-mobile-content">
                                <nav id="mb-menu" class="navbar-mainmenu">
                                    <ul class="menuList-sub vertical-menu-list sub-child">
                                        <li><a class="parent" href="../index.php">Trang chủ</a></li>
                                        <li><a class="parent" href="category.php?type=new-arrivals">Sản phẩm mới</a></li>
                                        <li><a class="parent" href="category.php?type=best-sellers">Bán chạy</a></li>
                                        <li><a class="parent" href="category.php?type=tops">Áo</a></li>
                                        <li><a class="parent" href="category.php?type=bottoms">Quần</a></li>
                                        <li><a class="parent" href="category.php?type=outerwear">Outerwear</a></li>
                                        <li><a class="parent" href="category.php?type=accessories">Phụ kiện</a></li>
                                        <li><a class="parent" href="category.php?type=sale">Giảm giá</a></li>
                                        <li class="main_help">
                                            <div class="mobile_menu_section">
                                                <p class="mobile_menu_section-title">Liên hệ với chúng tôi</p>
                                                <div class="mobile_menu_help">
                                                    <span class="icon icon--bi-phone"></span>
                                                    <a href="tel:0123456789" rel="nofollow">0123 456 789</a>
                                                </div>
                                                <div class="mobile_menu_help">
                                                    <span class="icon icon--bi-email"></span>
                                                    <a href="mailto:your-email@example.com" rel="nofollow">your-email@example.com</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="header-upper-logo">
                    <div class="wrap-logo text-center" itemscope itemtype="http://schema.org/Organization">
                        <a href="../index.php" itemprop="url" aria-label="logo">
                            <img itemprop="logo" src="../images/logo.png" alt="Streetwear Shop"/>
                        </a>
                        <h1 style="display:none"><a href="../index.php" itemprop="url">Streetwear Shop</a></h1>
                    </div>
                </div>

                <div class="header-upper-search-top hidden-xs hidden-sm">
                    <div class="header-search">
                        <div class="search-box wpo-wrapper-search">
                            <form action="search.php" method="get" class="searchform searchform-categoris ultimate-search">
                                <div class="wpo-search-inner">
                                    <input type="hidden" name="type" value="product" />
                                    <input required id="inputSearchAuto" name="q" maxlength="40" class="searchinput input-search search-input" type="text" placeholder="Tìm kiếm sản phẩm...">
                                </div>
                                <button type="submit" class="btn-search">
                                    <span class="svg search">🔍</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="header-upper-icon">
                    <div class="header-wrap-icon">
                        <div class="wrapper-search header-action">
                            <a class="header-action-toggle" href="search.php" aria-label="Tìm kiếm" title="Tìm kiếm">
                                <span class="box-icon">
                                    <span class="svg-ico-search">🔍</span>
                                </span>
                            </a>
                        </div>

                        <div class="wrapper-account header-action">
                            <a class="header-action-toggle" href="<?php echo $logged_in ? 'account.php' : 'login.php'; ?>" aria-label="Tài khoản">
                                <span class="box-icon">
                                    <span class="svg-ico-account">👤</span>
                                </span>
                                <span class="icon-box-text">
                                    <?php echo $logged_in ? "Xin chào, $user_name" : 'Đăng nhập / Đăng ký'; ?>
                                </span>
                            </a>
                            <?php if (!$logged_in) { ?>
                                <div class="header_dropdown_content site_account">
                                    <span class="box-triangle"></span>
                                    <div class="site-nav-container text-center">
                                        <div class="site_account_panel_list">
                                            <div id="header-login-panel" class="site_account_panel site_account_default is-selected">
                                                <div class="site-account-list">
                                                    <form action="login.php" method="post">
                                                        <div class="site_account_header">
                                                            <h2 class="site_account_title heading">Đăng nhập tài khoản</h2>
                                                            <p class="site_account_legend">Nhập email và mật khẩu của bạn:</p>
                                                        </div>
                                                        <div class="form__input-wrapper form__input-wrapper--labelled">
                                                            <input type="email" id="login-customer-email" class="form__field form__field--text" name="email" required="required" autocomplete="email">
                                                            <label for="login-customer-email" class="form__floating-label">Email</label>
                                                        </div>
                                                        <div class="form__input-wrapper form__input-wrapper--labelled">
                                                            <input type="password" id="login-customer-password" class="form__field form__field--text" name="password" required="required" autocomplete="current-password">
                                                            <label for="login-customer-password" class="form__floating-label">Mật khẩu</label>
                                                        </div>
                                                        <button type="submit" class="form__submit button dark">Đăng nhập</button>
                                                    </form>
                                                    <div class="site_account_secondary-action">
                                                        <p>Khách hàng mới? <a href="register.php" class="link">Tạo tài khoản</a></p>
                                                        <p>Quên mật khẩu? <a href="recover.php" class="link">Khôi phục mật khẩu</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>