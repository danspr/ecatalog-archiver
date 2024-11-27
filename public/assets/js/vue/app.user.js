const { createApp } = Vue

createApp({
    data() {
        return {
            urlGetUserList: `${baseURL}api/user/list`,          
            urlGetUserDetail: `${baseURL}api/user/detail`,          
            urlCreateUser: `${baseURL}api/user/insert`,          
            urlUpdateUser: `${baseURL}api/user/update`,          
            urlDeleteUser: `${baseURL}api/user/delete`,          
            urlChangePassword: `${baseURL}api/user/change-password`,          
            dataList: [],
            form: { id: '', full_name: '', username: '', password: '', role: '', status: '' },
            formPass: { id: '', password: '', password_confirm: '' },
            buttonSubmitId: 'createButton', currentUserId: '',
        }
    },
    mounted() {
        this.getUserList(true)
    },
    methods: {
        initTable(){
            $('#userTable').ready(function(){
                $('#userTable').DataTable({
                    "responsive": true,
                    "processing": true, 
                    "order": [],
                    "columnDefs": [
                        {"targets": [ -1 ],
                        "orderable": false
                        },
                    ],
                });
           })
        },
        getUserList(init) {
            let self = this
            axios.get(this.urlGetUserList, { headers: axiosHeader })
            .then(function (response) {
                if (response.status == 200) {
                    self.currentUserId = (response.data).current_user_id
                    self.dataList = (response.data).data
                    if (init) {
                        self.initTable()
                    } else {
                        $('#userTable').DataTable().destroy();
                        self.initTable()
                    }
                }
            })
            .catch(function (error) {
                axiosErrorCallback(error);
            })
        },
        createNewUser() {
            let self = this
            if(this.form.full_name == '' || this.form.username == '' || this.form.password == '' || this.form.role == '' || this.form.status == '') {
                showAlert('error', 'Please fill all required fields')
                return;
            }
            axios.post(this.urlCreateUser, this.form, { headers: axiosHeader })
            .then(function (response) {
                if (response.status == 200) {
                    self.getUserList(false)
                    showAlert('success', getMessage('success.create'))
                    $('#userNewModal').modal('hide');
                    self.form = { id: '', full_name: '', username: '', password: '', role: '', status: '' }
                }
            })
            .catch(function (error) {
                axiosErrorCallback(error);
            })
        },
        getUserDetail(id) {
            let self = this
            this.form.id = id
            axios.get(this.urlGetUserDetail + `?id=${id}`, { headers: axiosHeader })
            .then(function (response) {
                if (response.status == 200) {
                    self.form.id = (response.data).data.id
                    self.form.full_name = (response.data).data.full_name
                    self.form.username = (response.data).data.username
                    self.form.role = (response.data).data.role
                    self.form.status = (response.data).data.status
                    $('#userUpdateModal').modal('show')
                }
            })
            .catch(function (error) {
                axiosErrorCallback(error);
            })
        },
        updateUser() {  
            let self = this
            if(this.form.full_name == '' || this.form.username == '' || this.form.role == '' || this.form.status == '') {
                showAlert('error', 'Please fill all required fields')
                return;
            }
            axios.post(this.urlUpdateUser, this.form, { headers: axiosHeader })
            .then(function (response) {
                if (response.status == 200) {
                    self.getUserList(false)
                    showAlert('success', getMessage('success.update'))
                    $('#userUpdateModal').modal('hide');
                    self.form = { id: '', full_name: '', username: '', password: '', role: '', status: '' }
                }
            })
            .catch(function (error) {
                axiosErrorCallback(error);
            })
        },
        deleteUser(id) {
            let self = this
            let confirmation = confirm(getMessage('confirm.delete'))
            if(confirmation) {
                axios.post(this.urlDeleteUser, { id: id }, { headers: axiosHeader })
                .then(function (response) {
                    if (response.status == 200) {
                        self.getUserList(false)
                        showAlert('success', getMessage('success.delete'))
                    }
                })
                .catch(function (error) {
                    axiosErrorCallback(error);
                })
            }
        },
        showPasswordModal(id) {
            this.formPass.id = id
            $('#userPasswordModal').modal('show')
        },
        changePassword() {
            let self = this
            if(this.formPass.password == '' || this.formPass.password_confirm == '') {
                showAlert('error', 'Please fill all required fields')
                return;
            }

            if(this.formPass.password != this.formPass.password_confirm) {
                showAlert('error', 'Password and Confirm Password does not match')
                return;
            }

            let payload = {
                id: self.formPass.id,
                password: self.formPass.password
            }
            axios.post(this.urlChangePassword, payload, { headers: axiosHeader })
            .then(function (response) {
                if (response.status == 200) {
                    self.getUserList(false)
                    showAlert('success', getMessage('success.update'))
                    $('#userPasswordModal').modal('hide');
                    self.formPass = { id: '', password: '', password_confirm: '' }
                }
            })
            .catch(function (error) {
                axiosErrorCallback(error);
            })
        },
        
    }
}).mount('#app-wrapper')