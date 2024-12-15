const { createApp } = Vue

createApp({
    data() {
        return {
            urlGetTotalRecords: `${baseURL}api/dashboard/total-records`,
            urlGetOverview: `${baseURL}api/dashboard/overview/`,
            urlGetActivity: `${baseURL}api/dashboard/activity`,
            result: {
                totalRecords: { transaction: 0, penyedia: 0, swakelola: 0 },
                overview: { label: [], tniAD: [], tniAU: [], tniAL: [] },
                activity: []
            },
            form: { overviewPeriod: 'last_week' },
            chart: { overview: null, loading: false },
            activity: { loading: false}, currentYear: '',
        }
    },
    mounted() {
        this.initView()
        this.showTotalRecords()
        this.showOverview(true)
        this.showRecentActivity()
    },
    methods: {
        initView(){
            let options = this.getOverviewChartOptions();
            this.chart.overview = new ApexCharts(document.querySelector("#subscriptionOverview"), options);
            this.chart.overview.render();
            this.currentYear = moment().format('YYYY');
        },
        showTotalRecords(){
            axios.get(this.urlGetTotalRecords, { headers: axiosHeader })
            .then(response => {
                if(response.status == 200) {
                    let data = (response.data).data;
                    this.result.totalRecords.transaction = data.total_transaction;
                    this.result.totalRecords.penyedia = data.total_penyedia;
                    this.result.totalRecords.swakelola = data.total_swakelola;
                }
            })
            .catch(error => {
                axiosErrorCallback(error)
            })
        },
        showOverview(){
            this.chart.loading = true;
            let self = this;
            let URL = this.urlGetOverview + this.form.overviewPeriod;
            axios.get(URL, { headers: axiosHeader })
            .then(response => {
                if(response.status == 200) { 
                    let data = (response.data).data;
                    self.result.overview.label = data.label;
                    self.result.overview.tniAD = data.tni_ad;
                    self.result.overview.tniAU = data.tni_au;
                    self.result.overview.tniAL = data.tni_al;

                    self.chart.loading = false;
                    let options = self.getOverviewChartOptions();
                    self.chart.overview.updateOptions(options)
                }
            })
            .catch(error => {
                axiosErrorCallback(error)
                console.log(error)
            })
            .finally(() => {
                this.chart.loading = false;
            })
        },
        getOverviewChartOptions() {
            var options = {
                series: [
                    {
                        name: "TNI AD",
                        data: this.result.overview.tniAD
                    },
                    {
                        name: "TNI AU",
                        data: this.result.overview.tniAU
                    },
                    {
                        name: "TNI AL",
                        data: this.result.overview.tniAL
                    }
                ],
                chart: {
                    toolbar: {
                        show: false
                    },
                    height: 400,
                    type: 'line',
                    zoom: {
                        enabled: false
                    },
                    dropShadow: {
                        enabled: true,
                        enabledOnSeries: undefined,
                        top: 5,
                        left: 0,
                        blur: 3,
                        color: '#000',
                        opacity: 0.15
                    },
                },
                grid: {
                    borderColor: '#f1f1f1',
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: [2, 2, 2],
                    curve: ['smooth', 'smooth', 'smooth'],
                    lineCap: 'butt',
                    dashArray: [0, 0, 0]
                },
                title: {
                    text: undefined,
                },
                legend: {
                    show: true,
                    position: 'top',
                    horizontalAlign: 'center',
                    fontWeight: 600,
                    fontSize: '11px',
                    tooltipHoverFormatter: function (val, opts) {
                        return val + ' - ' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + ''
                    },
                    labels: {
                        colors: '#74767c',
                    },
                    markers: {
                        width: 7,
                        height: 7,
                        strokeWidth: 0,
                        radius: 12,
                        offsetX: 0,
                        offsetY: 0
                    },
                },
                markers: {
                },
                yaxis: {
                    title: {
                        style: {
                            color: '#adb5be',
                            fontSize: '14px',
                            fontFamily: 'poppins, sans-serif',
                            fontWeight: 600,
                            cssClass: 'apexcharts-yaxis-label',
                        },
                    },
                    labels: {
                        formatter: function (y) {
                            return y.toFixed(0) + "";
                        },
                        show: true,
                        style: {
                            colors: "#8c9097",
                            fontSize: '11px',
                            fontWeight: 600,
                            cssClass: 'apexcharts-xaxis-label',
                        },
                    }
                },
                xaxis: {
                    type: 'day',
                    categories: this.result.overview.label,
                    axisBorder: {
                        show: true,
                        color: 'rgba(119, 119, 142, 0.05)',
                        offsetX: 0,
                        offsetY: 0,
                    },
                    axisTicks: {
                        show: true,
                        borderType: 'solid',
                        color: 'rgba(119, 119, 142, 0.05)',
                        width: 6,
                        offsetX: 0,
                        offsetY: 0
                    },
                    labels: {
                        rotate: -90,
                        style: {
                            colors: "#8c9097",
                            fontSize: '11px',
                            fontWeight: 600,
                            cssClass: 'apexcharts-xaxis-label',
                        },
                    }
                },
                tooltip: {
                    y: [
                        {
                            title: {
                                formatter: function (val) {
                                    return val
                                }
                            }
                        },
                        {
                            title: {
                                formatter: function (val) {
                                    return val
                                }
                            }
                        },
                        {
                            title: {
                                formatter: function (val) {
                                    return val;
                                }
                            }
                        }
                    ]
                },
                colors: ["rgb(35, 149, 35)", "rgb(128, 196, 233)", "rgb(10, 57, 129)"],
            };
            return options;
        },
        showRecentActivity(){
            this.activity.loading = true;
            let self = this;
            axios.get(this.urlGetActivity, { headers: axiosHeader })
            .then(response => {
                self.activity.loading = false;
                if(response.status == 200) {
                    let data = (response.data).data;
                    self.result.activity = data;
                    self.showActivittyHTML();
                }
            })
            .catch(error => {
                axiosErrorCallback(error)
            })
            .finally(() => {
                this.activity.loading = false;
            })
        },
        showActivittyHTML(){
            const activityList = document.getElementById('recent-activity-list');
            const activities = this.result.activity;
        
            activities.forEach(activity => {
                const listItem = document.createElement('li');
                listItem.className = 'crm-recent-activity-content';
                listItem.innerHTML = `
                    <div class="d-flex align-items-top">
                        <div class="me-3">
                            <span class="avatar avatar-xs bg-secondary-transparent avatar-rounded">
                                <i class="bi bi-circle-fill fs-8 ${activity.result === 'success' ? 'text-success' : 'text-danger'}"></i>
                            </span>
                        </div>
                        <div class="crm-timeline-content">
                            <span title="${activity.detail}">${activity.detail.slice(0, 150)}</span>
                            <span class="d-block fs-12 text-muted">${activity.datetime}</span>
                        </div>
                        <div class="flex-fill text-end">
                            <span class="d-block text-muted fs-11 op-7">${activity.username}</span>
                        </div>
                    </div>
                `;
                activityList.appendChild(listItem);
            });
        },
        formatNumber(number){
            return new Intl.NumberFormat().format(number);
        }
        
    }
}).mount('#app-wrapper')