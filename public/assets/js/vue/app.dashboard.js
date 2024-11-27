const { createApp } = Vue

createApp({
    data() {
        return {
          
        }
    },
    mounted() {
        this.showOverview()
        this.showRecentActivity()
    },
    methods: {
        showOverview(){
            var options = {
                series: [
                    {
                        name: "Success",
                        data: [9, 8, 3, 10, 8, 9, 7, 2, 10, 6] // Higher values
                    },
                    {
                        name: "Failed",
                        data: [1, 2, 7, 0, 2, 1, 3, 8, 0, 4] // Corresponding lower values
                    }
                ],
                chart: {
                    toolbar: {
                        show: false
                    },
                    height: 285,
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
                    width: [2, 2],
                    curve: ['smooth', 'smooth'],
                    lineCap: 'butt',
                    dashArray: [0, 0]
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
                    categories: ['01 Jan', '02 Jan', '03 Jan', '04 Jan', '05 Jan', '06 Jan', '07 Jan', '08 Jan', '09 Jan',
                        '10 Jan', '11 Jan', '12 Jan'
                    ],
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
                colors: ["rgb(35, 149, 35)", "rgb(214, 34, 34)"],
            };
            var chart1 = new ApexCharts(document.querySelector("#subscriptionOverview"), options);
            chart1.render();
        },
        showRecentActivity(){
            const activities = [
                {
                    "type": "user",
                    "activity": "Logged in to the application",
                    "result": "success",
                    "datetime": "2024-11-27 08:15:23",
                    "user": "admin"
                },
                {
                    "type": "system",
                    "activity": "Backup job completed for database",
                    "result": "success",
                    "datetime": "2024-11-27 08:30:10",
                    "user": "system"
                },
                {
                    "type": "user",
                    "activity": "Uploaded new document",
                    "result": "success",
                    "datetime": "2024-11-27 09:00:45",
                    "user": "john.doe"
                },
                {
                    "type": "system",
                    "activity": "Scheduled cleanup job failed",
                    "result": "failed",
                    "datetime": "2024-11-27 09:15:00",
                    "user": "system"
                },
                {
                    "type": "user",
                    "activity": "Attempted unauthorized access",
                    "result": "failed",
                    "datetime": "2024-11-27 10:05:12",
                    "user": "guest"
                },
                {
                    "type": "system",
                    "activity": "Backup job completed for user files",
                    "result": "success",
                    "datetime": "2024-11-27 10:30:40",
                    "user": "system"
                },
                {
                    "type": "user",
                    "activity": "Reset password",
                    "result": "success",
                    "datetime": "2024-11-27 11:00:20",
                    "user": "jane.smith"
                },
                {
                    "type": "system",
                    "activity": "Disk space monitoring job failed",
                    "result": "failed",
                    "datetime": "2024-11-27 11:45:15",
                    "user": "system"
                },
                {
                    "type": "user",
                    "activity": "Logged out of the application",
                    "result": "success",
                    "datetime": "2024-11-27 12:10:05",
                    "user": "admin"
                },
                {
                    "type": "system",
                    "activity": "Generated monthly report",
                    "result": "success",
                    "datetime": "2024-11-27 12:42:50",
                    "user": "system"
                },
            ];
        
            const activityList = document.getElementById('recent-activity-list');
        
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
                            <span>${activity.activity}</span>
                            <span class="d-block fs-12 text-muted">${activity.datetime}</span>
                        </div>
                        <div class="flex-fill text-end">
                            <span class="d-block text-muted fs-11 op-7">${activity.user}</span>
                        </div>
                    </div>
                `;
                activityList.appendChild(listItem);
            });
        }
    }
}).mount('#app-wrapper')