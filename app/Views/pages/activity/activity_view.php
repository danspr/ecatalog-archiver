<!-- Start::app-content -->
<div class="main-content app-content" id="app-wrapper" menu-active-path="activity">
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
            <div class="col-xl-6">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            Search
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
                                    <button class="form-control btn btn-primary" type="button" @click="getActivityList(false)" id="searchButton">                                               
                                        <span class="d-flex align-items-center">
                                            <span class="flex-grow-1 ms-2 btn-text">
                                                Search
                                            </span>
                                            <span class="spinner-border flex-shrink-0" role="status" style="display:none;">
                                                <span class="visually-hidden btn-text">Search</span>
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

        <!-- Start::row-1 -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            Log
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table text-nowrap table-bordered" id="activityTable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Datetime</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Activity</th>
                                    <th scope="col">Result</th>
                                    <th scope="col">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in dataList" :key="item.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.datetime }}</td>
                                    <td>{{ item.username }}</td>
                                    <td>{{ item.activity }}</td>
                                    <td>
                                        <span v-if="item.result == 'success'" class="badge bg-success">Success</span>
                                        <span v-else class="badge bg-danger">Error</span>
                                    </td>
                                    <td>{{ item.detail }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--End::row-1 -->
    </div>

</div>
<!-- End::app-content -->

