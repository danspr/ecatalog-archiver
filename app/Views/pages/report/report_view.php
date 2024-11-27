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
            <div class="col-xl-4">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            Filter
                        </div>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-3 col-form-label"><b>Start Date</b></label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-text text-muted"> <i class="ri-calendar-line"></i> </div>
                                        <input type="text" class="form-control" id="start-date" v-model="form.start_date">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label"><b>End Date</b></label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-text text-muted"> <i class="ri-calendar-line"></i> </div>
                                        <input type="text" class="form-control" id="end-date" v-model="form.end_date">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword3" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="button" @click="getReportList(false)" class="form-control btn btn-primary">Search</button>
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
                            Report Archive
                        </div>
                       
                    </div>
                    <div class="card-body">
                        <table class="table text-nowrap table-bordered" id="report-table">
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

