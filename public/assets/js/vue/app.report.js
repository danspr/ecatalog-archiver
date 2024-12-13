const { createApp } = Vue

createApp({
    data() {
        return {
            urlGetReportList: `${baseURL}api/report/list`,           
            urlGetPaketNameList: `${baseURL}api/report/paket-list`,           
            urlExportData: `${baseURL}api/report/export`,           
            dataList: [],
            form: { nomor_paket: '' },
            buttonSubmitId: 'generate-report-button'
        }
    },
    mounted() {
        this.initView()
        this.getReportList(true)
    },
    methods: {
        initView() {
            let self = this;
            $('#paket-name').select2({
                placeholder: 'Search for a package',
                allowClear: true,
                ajax: {
                    url: this.urlGetPaketNameList,
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            nomor_paket: params.term // search term
                        };
                    },
                    processResults: function(data) {
                        let resultData = data.data;
                        return {
                            results: resultData.map(function(item) {
                                return {
                                    id: item.nomor_paket, // Use the unique ID from your data
                                    text: item.nomor_paket // Display name
                                };
                            })
                        };
                    },
                    cache: true
                },
                minimumInputLength: 3
            });

            $('#paket-name').on('select2:select', function(e) {
                var selectedData = e.params.data;
                self.form.nomor_paket = selectedData.id
            });

            $('#paket-name').on('select2:clear', function() {
                self.form.nomor_paket = '';
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
            let URL = this.urlGetReportList + "?type=epurchasing";
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