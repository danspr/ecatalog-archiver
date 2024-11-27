const { createApp } = Vue

createApp({
    data() {
        return {
            urlGetReportList: `${baseURL}api/report/list`,               
            dataList: [],
            form: { start_date: '', end_date: '' },
            buttonSubmitId: 'createButton'
        }
    },
    mounted() {
        this.initView()
        this.getReportList(true)
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
            $('#report-table').ready(function(){
                $('#report-table').DataTable({
                    "responsive": true,
                    "processing": true, 
                    "order": [],
                    "columnDefs": [
                        {"targets": [ -1 ],
                        "orderable": false
                        },
                        {
                            targets: 2,
                            render: function (data, type, row) {
                                if (type === 'display' || type === 'filter') {
                                    return moment(data).format('D MMMM YYYY HH:mm');
                                }
                                return data;
                            },
                        },
                    ],
                });
           })
        },
        getReportList(init) {
            let self = this
            let URL = this.urlGetReportList + `?start_date=${this.form.start_date}&end_date=${this.form.end_date}`
            axios.get(URL, { headers: axiosHeader })
            .then(function (response) {
                if (response.status == 200) {
                    self.dataList = (response.data).data
                    if (init) {
                        self.initTable()
                    } else {
                        $('#report-table').DataTable().destroy();
                        self.initTable()
                    }
                }
            })
            .catch(function (error) {
                axiosErrorCallback(error);
            })
        },
        downloadReport(id){
            let URL = `${baseURL}api/report/${id}/download`;
            axios.get(URL, { headers: axiosHeader })
            .then(function (response) {
                if (response.status == 200) {
                    window.open(URL, '_blank');
                }
            })
            .catch(function (error) {
                axiosErrorCallback(error);
            })
        }
    }
}).mount('#app-wrapper')