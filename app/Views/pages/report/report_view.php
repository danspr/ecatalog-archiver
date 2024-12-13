<!-- Start::app-content -->
<div class="main-content app-content" id="app-wrapper" menu-active-path="report">
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

        <!-- Start::row-1 -->
        <div class="row">
            <div class="col-xl-5">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            Parameter
                        </div>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row mb-4">
                                <label for="inputEmail3" class="col-sm-3 col-form-label"><b>Nomor Paket</b></label>
                                <div class="col-sm-9">
                                    <select id="paket-name" class="form-control"></select>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="inputPassword3" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button class="form-control btn btn-primary" type="button" @click="exportData()" id="generate-report-button">                                               
                                        <span class="d-flex align-items-center">
                                            <span class="flex-grow-1 ms-2 btn-text">
                                                Generate Report
                                            </span>
                                            <span class="spinner-border flex-shrink-0" role="status" style="display:none;">
                                                <span class="visually-hidden btn-text">Generate Report</span>
                                            </span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--End::row-1 -->

        <!-- Start::row-2 -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            History
                        </div>
                       
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="report-table" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">File Name</th>
                                    <th scope="col">Created Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in dataList" :key="item.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.file_name }}</td>
                                    <td>{{ item.created }}</td>
                                    <td>
                                        <button @click="downloadReport(item.id)" class="btn btn-primary-light btn-icon btn-sm" title="Download"><i class="ri-download-cloud-fill"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--End::row-2 -->
    </div>
</div>
<!-- End::app-content -->

