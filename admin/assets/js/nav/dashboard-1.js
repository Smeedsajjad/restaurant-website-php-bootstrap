(function($) {
    /* "use strict" */

    var dzChartlist = function() {
        var screenWidth = $(window).width();

        var widgetChart1 = function() {
            if (jQuery('#widgetChart1').length > 0) {
                const chart_widget_1 = document.getElementById("widgetChart1").getContext('2d');
                new Chart(chart_widget_1, {
                    type: "line",
                    data: {
                        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "January", "February", "March", "April"],
                        datasets: [{
                            label: "Sales Stats",
                            backgroundColor: ['rgba(234,73,137,.13)'],
                            borderColor: '#ea4989',
                            pointBackgroundColor: '#ea4989',
                            pointBorderColor: '#ea4989',
                            borderWidth: 2,
                            pointHoverBackgroundColor: '#ea4989',
                            pointHoverBorderColor: '#ea4989',
                            fill: true,
                            tension: 0.3,
                            data: [8, 7, 6, 3, 2, 4, 6, 8, 12, 6, 12, 13, 10, 18, 14, 24, 16, 12, 19, 21, 16, 14, 24, 21, 13, 15, 27, 29, 21, 11, 14, 19, 21, 17]
                        }]
                    },
                    options: {
                        title: { display: false },
                        plugins: {
                            legend: false,
                            tooltip: {
                                intersect: false,
                                mode: "nearest",
                                xPadding: 10,
                                yPadding: 10,
                                caretPadding: 10
                            },
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        hover: { mode: "index" },
                        scales: {
                            x: {
                                display: false,
                                grid: false,
                                scaleLabel: { display: true, labelString: "Month" }
                            },
                            y: {
                                display: false,
                                grid: false,
                                scaleLabel: { display: true, labelString: "Value" },
                                ticks: { beginAtZero: true }
                            }
                        },
                        elements: {
                            point: { radius: 0, borderWidth: 0 }
                        },
                        layout: { padding: { left: 0, right: 0, top: 5, bottom: 0 } }
                    }
                });
            }
        }

        var widgetChart2 = function() {
            if (jQuery('#widgetChart2').length > 0) {
                const chart_widget_2 = document.getElementById("widgetChart2").getContext('2d');
                new Chart(chart_widget_2, {
                    type: "line",
                    data: {
                        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "January", "February", "March", "April"],
                        datasets: [{
                            label: "Sales Stats",
                            backgroundColor: ['rgba(234,73,137,.13)'],
                            borderColor: '#ea4989',
                            pointBackgroundColor: '#ea4989',
                            pointBorderColor: '#ea4989',
                            borderWidth: 2,
                            pointHoverBackgroundColor: '#ea4989',
                            pointHoverBorderColor: '#ea4989',
                            fill: true,
                            tension: 0.3,
                            data: [19, 21, 16, 14, 24, 21, 13, 15, 27, 29, 21, 11, 14, 19, 21, 17, 12, 6, 12, 13, 10, 18, 14, 24, 16, 12, 8, 7, 6, 3, 2, 7, 6, 8]
                        }]
                    },
                    options: {
                        title: { display: false },
                        plugins: {
                            legend: false,
                            tooltip: {
                                intersect: false,
                                mode: "nearest",
                                xPadding: 10,
                                yPadding: 10,
                                caretPadding: 10
                            },
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        hover: { mode: "index" },
                        scales: {
                            x: {
                                display: false,
                                grid: false,
                                scaleLabel: { display: true, labelString: "Month" }
                            },
                            y: {
                                display: false,
                                grid: false,
                                scaleLabel: { display: true, labelString: "Value" },
                                ticks: { beginAtZero: true }
                            }
                        },
                        elements: {
                            point: { radius: 0, borderWidth: 0 }
                        },
                        layout: { padding: { left: 0, right: 0, top: 5, bottom: 0 } }
                    }
                });
            }
        }

        var widgetChart3 = function() {
            if (jQuery('#widgetChart3').length > 0) {
                const chart_widget_3 = document.getElementById("widgetChart3").getContext('2d');
                new Chart(chart_widget_3, {
                    type: "line",
                    data: {
                        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "January", "February", "March", "April"],
                        datasets: [{
                            label: "Sales Stats",
                            backgroundColor: ['rgba(234,73,137,.13)'],
                            borderColor: '#ea4989',
                            pointBackgroundColor: '#ea4989',
                            pointBorderColor: '#ea4989',
                            borderWidth: 2,
                            pointHoverBackgroundColor: '#ea4989',
                            pointHoverBorderColor: '#ea4989',
                            fill: true,
                            tension: 0.3,
                            data: [8, 7, 6, 3, 2, 4, 6, 8, 10, 6, 12, 15, 13, 15, 14, 13, 21, 11, 14, 10, 21, 10, 13, 10, 12, 14, 16, 14, 12, 10, 9, 8, 4, 1]
                        }]
                    },
                    options: {
                        title: { display: false },
                        plugins: {
                            legend: false,
                            tooltip: {
                                intersect: false,
                                mode: "nearest",
                                xPadding: 10,
                                yPadding: 10,
                                caretPadding: 10
                            },
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        hover: { mode: "index" },
                        scales: {
                            x: {
                                display: false,
                                gridLines: false,
                                scaleLabel: { display: true, labelString: "Month" }
                            },
                            y: {
                                display: false,
                                grid: false,
                                scaleLabel: { display: true, labelString: "Value" },
                                ticks: { beginAtZero: true }
                            }
                        },
                        elements: {
                            point: { radius: 0, borderWidth: 0 }
                        },
                        layout: { padding: { left: 0, right: 0, top: 5, bottom: 0 } }
                    }
                });
            }
        }

        var widgetChart4 = function() {
            if (jQuery('#widgetChart4').length > 0) {
                const chart_widget_4 = document.getElementById("widgetChart4").getContext('2d');
                new Chart(chart_widget_4, {
                    type: "line",
                    data: {
                        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "January", "February", "March", "April"],
                        datasets: [{
                            label: "Sales Stats",
                            backgroundColor: ['rgba(234,73,137,.13)'],
                            borderColor: '#ea4989',
                            pointBackgroundColor: '#ea4989',
                            pointBorderColor: '#ea4989',
                            borderWidth: 2,
                            pointHoverBackgroundColor: '#ea4989',
                            pointHoverBorderColor: '#ea4989',
                            fill: true,
                            tension: 0.3,
                            data: [16, 12, 19, 21, 13, 15, 12, 6, 12, 13, 10, 18, 14, 24, 16, 12, 19, 21, 16, 14, 24, 21, 13, 15, 27, 29, 21, 11, 14, 19, 21, 17]
                        }]
                    },
                    options: {
                        title: { display: false },
                        plugins: {
                            legend: false,
                            tooltip: {
                                intersect: false,
                                mode: "nearest",
                                xPadding: 10,
                                yPadding: 10,
                                caretPadding: 10
                            },
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        hover: { mode: "index" },
                        scales: {
                            x: {
                                display: false,
                                grid: false,
                                scaleLabel: { display: true, labelString: "Month" }
                            },
                            y: {
                                display: false,
                                grid: false,
                                scaleLabel: { display: true, labelString: "Value" },
                                ticks: { beginAtZero: true }
                            }
                        },
                        elements: {
                            point: { radius: 0, borderWidth: 0 }
                        },
                        layout: { padding: { left: 0, right: 0, top: 5, bottom: 0 } }
                    }
                });
            }
        }

        var chartBarRunning = function() {
            var options = {
                series: [{
                    name: 'Net Profit',
                    data: [31, 40, 28, 51, 42, 109, 100]
                }, {
                    name: 'Revenue',
                    data: [11, 32, 45, 32, 34, 52, 41]
                }],
                chart: {
                    type: 'bar',
                    height: 250,
                    stacked: true,
                    toolbar: { show: false },
                    zoom: { enabled: false },
                },
                plotOptions: {
                    bar: { horizontal: false, columnWidth: '25%', endingShape: 'rounded' },
                },
                dataLabels: { enabled: false },
                xaxis: { type: 'month', categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'] },
                legend: { position: 'bottom', offsetY: 0 },
                fill: { opacity: 1 },
                colors: ['#ea4989', '#26E023'],
                tooltip: {
                    y: {
                        formatter: function(val) { return "$ " + val + " thousands"; }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chartBarRunning"), options);
            chart.render();
        }

        return {
            init: function() {},
            load: function() {
                widgetChart1();
                widgetChart2();
                widgetChart3();
                widgetChart4();
                chartBarRunning();
            },
            resize: function() {}
        }
    }();

    jQuery(window).on('load', function() {
        setTimeout(function() { dzChartlist.load(); }, 1000);
    });

})(jQuery);
