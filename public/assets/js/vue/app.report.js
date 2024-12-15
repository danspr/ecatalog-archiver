const { createApp } = Vue

createApp({
    data() {
        return {
            urlGetReportList: `${baseURL}api/report/list`,           
            urlGetPaketNameList: `${baseURL}api/report/paket-list`,           
            urlGetSatkerList: `${baseURL}api/report/satuan-kerja`,           
            urlExportData: `${baseURL}api/report/export`,           
            dataList: [], 
            form: { filter: 'nomor_paket', nomor_paket: '', satuan_kerja: '', start_date: '', end_date: '' },
            buttonSubmitId: 'generate-report-button', element: { startDate: null, endDate: '' }
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
                placeholder: 'Cari Nomor Paket',
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

            $('#satuan-kerja').select2({
                placeholder: 'Cari Satuan Kerja',
                allowClear: true,
                ajax: {
                    url: this.urlGetSatkerList,
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            nama: params.term // search term
                        };
                    },
                    processResults: function(data) {
                        let resultData = data.data;
                        return {
                            results: resultData.map(function(item) {
                                return {
                                    id: item.satuan_kerja, // Use the unique ID from your data
                                    text: item.satuan_kerja // Display name
                                };
                            })
                        };
                    },
                    cache: true
                },
                minimumInputLength: 3
            });

            $('#satuan-kerja').on('select2:select', function(e) {
                var selectedData = e.params.data;
                self.form.satuan_kerja = selectedData.id
            });

            $('#satuan-kerja').on('select2:clear', function() {
                self.form.satuan_kerja = '';
            });

            this.form.start_date = moment().format('YYYY-MM-DD');
            this.form.end_date = moment().format('YYYY-MM-DD');
            this.element.startDate =flatpickr("#start-date", {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
                defaultDate: moment().format('YYYY-MM-DD'),
                onChange: function (selectedDates) {
                    self.form.start_date = selectedDates[0];
                    if (self.form.end_date) {
                      self.validateDateRange();
                    }
                },
            });

            this.element.endDate = flatpickr("#end-date", {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
                defaultDate: moment().format('YYYY-MM-DD'),
                onChange: function (selectedDates) {
                    self.form.end_date = selectedDates[0];
                    if (self.form.start_date) {
                        self.validateDateRange();
                    }
                },
            });
        },
        validateDateRange() {
            const oneDay = 24 * 60 * 60 * 1000;
            const diffDays = Math.round((new Date(this.form.end_date) - new Date(this.form.start_date)) / oneDay);
        
            if (diffDays > 30) {
              alert("You can only select a date range of up to 30 days.");
              this.element.endDate.clear();
            }
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