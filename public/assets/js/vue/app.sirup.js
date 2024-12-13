const { createApp } = Vue

createApp({
    data() {
        return {
            urlGetReportList: `${baseURL}api/report/list`,                    
            urlExportData: `${baseURL}api/sirup/export`,           
            dataList: [], dataYear: [],
            form: { tahun: '', report: 'rekap' },
            buttonSubmitId: 'generate-report-button'
        }
    },
    mounted() {
        this.initView()
        this.getReportList(true)
    },
    methods: {
        generateYear(start, end) {
            let years = [];
            for (let year = end; year >= start; year--) {
                years.push(year);
            }
            return years;
        },
        initView() {
            let currentYear = new Date().getFullYear();
            this.dataYear = this.generateYear(2019, currentYear + 1);
            this.form.tahun = currentYear
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
                            width: '15%',
                            render: function (data, type, row) {
                                if (type === 'display' || type === 'filter') {
                                    return moment(data).format('D MMMM YYYY HH:mm');
                                }
                                return data;
                            },
                        },
                        {
                            targets: 3,
                            width: '5%',
                        },
                    ],
                });
           })
        },
        getReportList(init) {
            let self = this
            let URL = this.urlGetReportList + "?type=sirup";
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
        exportData(){
            let self = this;
            showLoadingButton(this.buttonSubmitId);
            axios.post(this.urlExportData, this.form, { headers: axiosHeader })
            .then(function (response) {
                if (response.status == 200) {
                    let data = (response.data).data;
                    window.open(data.download_url, '_blank');
                }
                self.getReportList(false);
            })
            .catch(function (error) {
                axiosErrorCallback(error);
            })
            .finally(() => {
                hideLoadingButton(this.buttonSubmitId, 'Generate Report');
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