const { createApp } = Vue

createApp({
    data() {
        return {
            urlLogin: `${baseURL}api/auth/signin`,
            urlDashboardPage: `${baseURL}dashboard`,
            loginForm : { username: '', password: '' }, 
            buttonLoginId: 'login-button',
        }
    },
    mounted() {

    },
    methods: {
        login(event){
            let self = this;
            if(this.loginForm.username == '' || this.loginForm.password == '') {
                showAlert('warning', 'Username and Password are required');
                return;
            }

            showLoadingButton(this.buttonLoginId);
            axios.post(this.urlLogin, this.loginForm, { headers: axiosHeader })
                .then(function (response) {
                    showAlert('success', getMessage('success.login'));
                    setTimeout(() => {
                        redirect(self.urlDashboardPage);
                    }, 1000)
                })
                .catch(function (error) {
                    axiosErrorCallback(error);
                })
                .finally(() => {
                    hideLoadingButton(this.buttonLoginId, 'Sign In');
                })
        },
    }
}).mount('#app-wrapper')