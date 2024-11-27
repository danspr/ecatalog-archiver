<div class="modal fade" id="userPasswordModal" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Change Password
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fs-14 text-dark">Password</label>
                    <input type="password" class="form-control" placeholder="" v-model="formPass.password">
                </div>
                <div class="mb-3">
                    <label class="form-label fs-14 text-dark">Confirm Password</label>
                    <input type="password" class="form-control" placeholder="" v-model="formPass.password_confirm">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" @click="changePassword">Change</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>