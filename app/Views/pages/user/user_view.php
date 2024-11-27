<!-- Start::app-content -->
<div class="main-content app-content" id="app-wrapper" menu-active-path="user">
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
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            User List
                        </div>
                        <div class="d-flex">
                            <button class="btn btn-sm btn-primary btn-wave waves-light"  data-bs-toggle="modal"
                            data-bs-target="#userNewModal"><i class="ri-add-line fw-semibold align-middle me-1"></i> Create User</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table text-nowrap table-bordered" id="userTable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in dataList" :key="item.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.full_name }}</td>
                                    <td>{{ item.username }}</td>
                                    <td>{{ item.role }}</td>
                                    <td>
                                        <span v-if="item.status == '1'" class="badge bg-success">Active</span>
                                        <span v-else class="badge bg-danger">Inactive</span>
                                    </td>
                                    <td>
                                        <button @click="getUserDetail(item.id)" class="btn btn-primary-light btn-icon btn-sm" title="Edit User"><i class="ri-edit-line"></i></button>
                                        <button @click="showPasswordModal(item.id)" class="btn btn-orange-light btn-icon ms-1 btn-sm" title="Change Password"><i class="ri-lock-fill"></i></button>
                                        <button :disabled="item.id == currentUserId" @click="deleteUser(item.id)" class="btn btn-icon ms-1 btn-sm invoice-btn" :class="item.id == currentUserId ? 'btn-dark' : 'btn-danger-light'" title="Delete User"><i class="ri-delete-bin-5-line"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--End::row-1 -->
    </div>

    <?= view('modals/user_new_modal') ?>
    <?= view('modals/user_edit_modal') ?>
    <?= view('modals/user_password_modal') ?>
</div>
<!-- End::app-content -->

