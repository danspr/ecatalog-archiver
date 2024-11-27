<div class="modal fade" id="userNewModal" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">New User
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fs-14 text-dark">Full Name</label>
                    <input type="text" class="form-control" placeholder="" v-model="form.full_name">
                </div>
                <div class="mb-3">
                    <label class="form-label fs-14 text-dark">Username</label>
                    <input type="text" class="form-control"  placeholder="" v-model="form.username">
                </div>
                <div class="mb-3">
                    <label class="form-label fs-14 text-dark">Password</label>
                    <input type="password" class="form-control" placeholder="" v-model="form.password">
                </div>
                <div class="mb-3">
                    <label class="form-label fs-14 text-dark">Role</label>
                    <select class="form-select" id="role" v-model="form.role">
                        <option value="Administrator">Administrator</option>
                        <option value="User">User</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fs-14 text-dark">Status</label>
                    <select class="form-select" id="status" v-model="form.status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" @click="createNewUser" id="createButton">Create</button>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>