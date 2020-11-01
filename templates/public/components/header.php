<header class="main-header main-header-overlay" data-sticky-header="true"
        data-sticky-options='{ "stickyTrigger": "first-section" }'>

    <div class="mainbar-wrap">
        <div class="container mainbar-container">
            <div class="mainbar">
                <div class="row mainbar-row align-items-lg-stretch px-4">

                    <div class="col">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="/" rel="home">
										<span class="navbar-brand-inner">
											<img class="logo-dark" src="<?=$getFileSrc("img/logo-white.png")?>"
                                                 alt="Ave HTML Template">
											<img class="logo-sticky" src="<?=$getFileSrc("img/logo-black.png")?>"
                                                 alt="Ave HTML Template">
											<img class="mobile-logo-default" src="<?=$getFileSrc("img/logo-black.png")?>"
                                                 alt="Ave HTML Template">
											<img class="logo-default" src="<?=$getFileSrc("img/logo-white.png")?>"
                                                 alt="Ave HTML Template">
										</span>
                            </a>
                            <button type="button" class="navbar-toggle collapsed nav-trigger style-mobile"
                                    data-toggle="collapse" data-target="#main-header-collapse" aria-expanded="false"
                                    data-changeclassnames='{ "html": "mobile-nav-activated overflow-hidden" }'>
                                <span class="sr-only">Toggle navigation</span>
                                <span class="bars">
											<span class="bar"></span>
											<span class="bar"></span>
											<span class="bar"></span>
										</span>
                            </button>
                        </div><!-- /.navbar-header -->
                    </div><!-- /.col -->

                    <div class="col">

                        <div class="collapse navbar-collapse" id="main-header-collapse">

                            <ul id="primary-nav" class="main-nav nav align-items-lg-stretch justify-content-lg-end"
                                data-submenu-options='{ "toggleType":"fade", "handler":"mouse-in-out" }'>

                                <li>
                                    <a href="/">
                                        <span class="link-icon"></span>
                                        <span class="link-txt">
													<span class="link-ext"></span>
													<span class="txt">
														Home
														<span class="submenu-expander">
															<i class="fa fa-angle-down"></i>
														</span>
													</span>
												</span>
                                    </a>
                                </li>
                            </ul><!-- /#primary-nav  -->

                        </div><!-- /#main-header-collapse -->

                        <div class="header-module">
                            <a href="#" target="_blank"
                               class="btn btn-solid text-uppercase btn-sm round border-thin btn-white font-size-12 text-uppercase ltr-sp-15 px-2">
										<span>
											<span class="btn-txt">Join Us</span>
										</span>
                            </a>
                        </div><!-- /.header-module -->

                    </div><!-- /.col -->

                </div><!-- /.mainbar-row -->
            </div><!-- /.mainbar -->
        </div><!-- /.mainbar-container -->
    </div><!-- /.mainbar-wrap -->

</header><!-- /.main-header -->
