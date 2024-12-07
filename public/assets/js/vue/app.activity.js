const { createApp } = Vue

createApp({
    data() {
        return {
            urlGetActivityList: `${baseURL}api/activity/list`,         
            dataList: [],
            form: { start_date: '', end_date: ''},
            buttonSubmitId: 'searchButton',
        }
    },
    mounted() {
        this.initView()
        this.getActivityList(true)
    },
    methods: {
        initView() {
            this.form.start_date = moment().format('YYYY-MM-DD');
            this.form.end_date = moment().format('YYYY-MM-DD');
            
            flatpickr("#start-date", {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
                defaultDate: moment().format('YYYY-MM-DD'),
            });

            flatpickr("#end-date", {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
                defaultDate: moment().format('YYYY-MM-DD'),
            });
        },
        initTable(){
            $('#activityTable').ready(function(){
                $('#activityTable').DataTable({
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
        getActivityList(init) {
            showLoadingButton(this.buttonSubmitId);
            let self = this
            let URL = this.urlGetActivityList + `?start_date=${this.form.start_date}&end_date=${this.form.end_date}`
            axios.get(URL, { headers: axiosHeader })
            .then(function (response) {
                hideLoadingButton(this.buttonSubmitId, 'Search');
                if (response.status == 200) {
                    self.dataList = (response.data).data
                    if (init) {
                        self.initTable()
                    } else {
                        $('#activityTable').DataTable().destroy();
                        self.initTable()
                    }
                }
            })
            .catch(function (error) {
                axiosErrorCallback(error);
            })
            .finally(() => {
                hideLoadingButton(this.buttonSubmitId, 'Search');
            })
        },
    }
}).mount('#app-wrapper')