<!-- Start::app-content -->
<div class="main-content app-content" id="app-wrapper" menu-active-path="dashboard">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0"><?= $pageName ?></h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $pageName ?></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header Close -->
        
        <div class="row">
            <div class="col-xxl-9 col-xl-12">
                <div class="row">
                    <div class="col-xxl-4 col-lg-4 col-md-4">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 pe-0">
                                        <p class="mb-2">
                                            <span class="fs-16">Total Files</span>
                                        </p>
                                        <p class="mb-2 fs-12">
                                            <span class="fs-25 fw-semibold lh-1 vertical-bottom mb-0">1117</span>
                                            <span class="d-block fs-10 fw-semibold text-muted">Items</span>
                                        </p>
                                        <a href="<?= base_url('goods') ?>" class="fs-12 mb-0 text-primary">Show full stats<i class="ti ti-chevron-right ms-1"></i></a>
                                    </div>
                                    <div class="col-6">
                                        <!-- <p class="badge bg-success-transparent float-end d-inline-flex"><i class="ti ti-caret-up me-1"></i>42%</p> -->
                                        <p class="main-card-icon mb-0"><svg class="svg-primary" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M19,19c0,0.55-0.45,1-1,1s-1-0.45-1-1v-3H8V5h11V19z" opacity=".3"></path><path d="M0,0h24v24H0V0z" fill="none"></path><g><path d="M19.5,3.5L18,2l-1.5,1.5L15,2l-1.5,1.5L12,2l-1.5,1.5L9,2L7.5,3.5L6,2v14H3v3c0,1.66,1.34,3,3,3h12c1.66,0,3-1.34,3-3V2 L19.5,3.5z M19,19c0,0.55-0.45,1-1,1s-1-0.45-1-1v-3H8V5h11V19z"></path><rect height="2" width="6" x="9" y="7"></rect><rect height="2" width="2" x="16" y="7"></rect><rect height="2" width="6" x="9" y="10"></rect><rect height="2" width="2" x="16" y="10"></rect></g></svg></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-lg-4 col-md-4">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 pe-0">
                                        <p class="mb-2">
                                            <span class="fs-16">Total Files This Month</span>
                                        </p>
                                        <p class="mb-2 fs-12">
                                            <span class="fs-25 fw-semibold lh-1 vertical-bottom mb-0">90</span>
                                            <span class="d-block fs-10 fw-semibold text-muted">Items</span>
                                        </p>
                                        <a href="<?= base_url('goods') ?>" class="fs-12 mb-0 text-primary">Show full stats<i class="ti ti-chevron-right ms-1"></i></a>
                                    </div>
                                    <div class="col-6">
                                        <!-- <p class="badge bg-success-transparent float-end d-inline-flex"><i class="ti ti-caret-up me-1"></i>42%</p> -->
                                        <p class="main-card-icon mb-0"><svg class="svg-primary" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M19,19c0,0.55-0.45,1-1,1s-1-0.45-1-1v-3H8V5h11V19z" opacity=".3"></path><path d="M0,0h24v24H0V0z" fill="none"></path><g><path d="M19.5,3.5L18,2l-1.5,1.5L15,2l-1.5,1.5L12,2l-1.5,1.5L9,2L7.5,3.5L6,2v14H3v3c0,1.66,1.34,3,3,3h12c1.66,0,3-1.34,3-3V2 L19.5,3.5z M19,19c0,0.55-0.45,1-1,1s-1-0.45-1-1v-3H8V5h11V19z"></path><rect height="2" width="6" x="9" y="7"></rect><rect height="2" width="2" x="16" y="7"></rect><rect height="2" width="6" x="9" y="10"></rect><rect height="2" width="2" x="16" y="10"></rect></g></svg></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-lg-4 col-md-4">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 pe-0">
                                        <p class="mb-2">
                                            <span class="fs-16">Total Files Today</span>
                                        </p>
                                        <p class="mb-2 fs-12">
                                            <span class="fs-25 fw-semibold lh-1 vertical-bottom mb-0">6</span>
                                            <span class="d-block fs-10 fw-semibold text-muted">Items</span>
                                        </p>
                                        <a href="<?= base_url('goods') ?>" class="fs-12 mb-0 text-primary">Show full stats<i class="ti ti-chevron-right ms-1"></i></a>
                                    </div>
                                    <div class="col-6">
                                        <!-- <p class="badge bg-success-transparent float-end d-inline-flex"><i class="ti ti-caret-up me-1"></i>42%</p> -->
                                        <p class="main-card-icon mb-0"><svg class="svg-primary" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M19,19c0,0.55-0.45,1-1,1s-1-0.45-1-1v-3H8V5h11V19z" opacity=".3"></path><path d="M0,0h24v24H0V0z" fill="none"></path><g><path d="M19.5,3.5L18,2l-1.5,1.5L15,2l-1.5,1.5L12,2l-1.5,1.5L9,2L7.5,3.5L6,2v14H3v3c0,1.66,1.34,3,3,3h12c1.66,0,3-1.34,3-3V2 L19.5,3.5z M19,19c0,0.55-0.45,1-1,1s-1-0.45-1-1v-3H8V5h11V19z"></path><rect height="2" width="6" x="9" y="7"></rect><rect height="2" width="2" x="16" y="7"></rect><rect height="2" width="6" x="9" y="10"></rect><rect height="2" width="2" x="16" y="10"></rect></g></svg></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-header justify-content-between">
                                <div class="card-title">Backup Overview</div>
                                <div class="dropdown">
                                    <a href="javascript:void(0);" class="p-2 fs-12 text-muted" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        View All<i class="ri-arrow-down-s-line align-middle ms-1 d-inline-block"></i>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a class="dropdown-item" href="javascript:void(0);">Last Week</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">Last Month</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">Last Year</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="row border-bottom border-block-end-dashed">
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="p-3 border-sm-end border-inline-end-dashed text-sm-start text-center">
                                            <p class="fs-20 fw-semibold mb-0">1,117</p>
                                            <p class="mb-0 text-muted">Total Backup Job</p>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="p-3 border-sm-end border-inline-end-dashed text-sm-start text-center">
                                            <p class="fs-20 fw-semibold mb-0"><span class="basic-subscription">742</span></p>
                                            <p class="mb-0 text-muted">Success</p>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="p-3 text-sm-start text-center">
                                            <p class="fs-20 fw-semibold mb-0"><span class="pro-subscription">259</span></p>
                                            <p class="mb-0 text-muted">Failed</p>
                                        </div>
                                    </div>
                                </div>
                                <div id="subscriptionOverview" class="px-3 mt-sm-0 mt-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-md-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            Recent Activities
                        </div>
                        <button type="button" class="btn btn-sm btn-light">View All</button>
                    </div>
                    <div class="card-body">
                        <ul id="recent-activity-list" class="list-unstyled mb-0 crm-recent-activity">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End::app-content -->

