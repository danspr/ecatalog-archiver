<!-- Start::app-sidebar -->
<aside class="app-sidebar sticky" id="sidebar">

<!-- Start::main-sidebar-header -->
<div class="main-sidebar-header">
    <a href="<?= base_url() ?>" class="header-logo">
        <img src="<?= base_url() ?>assets/images/brand-logos/app-light-logo.png" alt="logo" class="desktop-logo">
        <img src="<?= base_url() ?>assets/images/brand-logos/app-light-toggle-logo.png" alt="logo" class="toggle-logo">
        <img src="<?= base_url() ?>assets/images/brand-logos/app-dark-logo.png" alt="logo" class="desktop-dark">
        <img src="<?= base_url() ?>assets/images/brand-logos/app-dark-toggle-logo.png" alt="logo" class="toggle-dark">
    </a>
</div>
<!-- End::main-sidebar-header -->

<!-- Start::main-sidebar -->
<div class="main-sidebar" id="sidebar-scroll">

    <!-- Start::nav -->
    <nav class="main-menu-container nav nav-pills flex-column sub-open">
        <div class="slide-left" id="slide-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path> </svg>
        </div>
        <ul class="main-menu">
            <!-- Start::slide__category -->
            <li class="slide__category"><span class="category-name">Main</span></li>
            <!-- End::slide__category -->

             <!-- Start::slide -->
             <li class="slide">
                <a href="/dashboard" active-path="dashboard" class="side-menu__item">
                    <i class="bx bx-home side-menu__icon"></i>
                    <span class="side-menu__label">Dashboard</span>
                </a>
            </li>
            <!-- End::slide -->

            <!-- Start::slide -->
            <li class="slide">
                <a href="<?= base_url('report') ?>" active-path="report" class="side-menu__item">
                    <i class="bx bxs-report side-menu__icon"></i>
                    <span class="side-menu__label">ePurchasing Report</span>
                </a>
            </li>
            <!-- End::slide -->

            <!-- Start::slide -->
            <li class="slide">
                <a href="<?= base_url('sirup') ?>" active-path="sirup" class="side-menu__item">
                    <i class="bx bxs-report side-menu__icon"></i>
                    <span class="side-menu__label">SIRUP Report</span>
                </a>
            </li>
            <!-- End::slide --> 

            <!-- Start::slide__category -->
            <li class="slide__category"><span class="category-name">Setting</span></li>
            <!-- End::slide__category -->

            <!-- Start::slide -->
            <li class="slide">
                <a href="<?= base_url('user') ?>" active-path="user"  class="side-menu__item">
                    <i class="bx bx-user side-menu__icon"></i>
                    <span class="side-menu__label">User Management</span>
                </a>
            </li>
            <li class="slide">
                <a href="<?= base_url('activity') ?>" active-path="activity"  class="side-menu__item">
                    <i class="bx bx-history side-menu__icon"></i>
                    <span class="side-menu__label">Activity Log</span>
                </a>
            </li>
            <!-- End::slide -->

             <!-- Start::slide -->
             <!-- <li class="slide">
                <a href="icons.html" class="side-menu__item">
                    <i class="bx bx-cog side-menu__icon"></i>
                    <span class="side-menu__label">Setting</span>
                </a>
            </li> -->
            <!-- End::slide -->
            
        </ul>
        <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path> </svg></div>
    </nav>
    <!-- End::nav -->

</div>
<!-- End::main-sidebar -->

</aside>
<!-- End::app-sidebar -->