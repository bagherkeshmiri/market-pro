@section('styles')
@endsection

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-body">

            <section id="multiple-column-form">
                <div class="row match-height">

                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                                <h4 class="card-title">پردازنده</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div id="gauge-chart-cpu" class="mb-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                                <h4 class="card-title">رم</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div id="gauge-chart-ram" class="mb-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                                <h4 class="card-title">هارد</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div id="gauge-chart-disk" class="mb-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

        </div>
    </div>
</div>


@section('scripts')

    @php
        $cpuUsage = $systemData['cpu'];
        $ramUsage = $systemData['memory'];
        $diskUsage = $systemData['disk']['percentage'];
    @endphp

    <script>

        let cpuUsage = @json($cpuUsage);
        let ramUsage = @json($ramUsage);
        let diskUsage = @json($diskUsage);

        $(document).ready(function () {

            const primary = '#5A8DEE';
            const success = '#39DA8A';
            const danger = '#FF5B5C';
            const warning = '#FDAC41';
            const info = '#00CFDD';


            Apex.chart = {
                fontFamily: 'primary-font',
                locales: [{
                    "name": "fa",
                }],
                defaultLocale: "fa"
            }

            const gaugeChartOptionsCpu = {
                chart: {
                    height: 360,
                    type: 'radialBar',

                },
                plotOptions: {
                    radialBar: {
                        hollow: {
                            margin: 15,
                            size: "60%"
                        },
                        startAngle: -135,
                        endAngle: 135,
                        dataLabels: {
                            name: {
                                fontSize: '22px',
                                color: '#304156',
                                offsetY: -16
                            },
                            value: {
                                fontSize: '30px',
                                color: '#828d99',
                                offsetY: 7,
                                formatter: function (val) {
                                    return val + " %";
                                }
                            }
                        }
                    }
                },
                stroke: {
                    lineCap: 'round'
                },
                fill: {
                    colors: [warning]
                },
                series: [cpuUsage],
                labels: [''],

            };

            const gaugeChartOptionsRam = {
                chart: {
                    height: 360,
                    type: 'radialBar',

                },
                plotOptions: {
                    radialBar: {
                        hollow: {
                            margin: 15,
                            size: "60%"
                        },
                        startAngle: -135,
                        endAngle: 135,
                        dataLabels: {
                            name: {
                                fontSize: '22px',
                                color: '#304156',
                                offsetY: -16
                            },
                            value: {
                                fontSize: '30px',
                                color: '#828d99',
                                offsetY: 7,
                                formatter: function (val) {
                                    return val + " %";
                                }
                            }
                        }
                    }
                },
                stroke: {
                    lineCap: 'round'
                },
                fill: {
                    colors: [success]
                },
                series: [ramUsage],
                labels: [''],

            };

            const gaugeChartOptionsDisk = {
                chart: {
                    height: 360,
                    type: 'radialBar',

                },
                plotOptions: {
                    radialBar: {
                        hollow: {
                            margin: 15,
                            size: "60%"
                        },
                        startAngle: -135,
                        endAngle: 135,
                        dataLabels: {
                            name: {
                                fontSize: '22px',
                                color: '#304156',
                                offsetY: -16
                            },
                            value: {
                                fontSize: '30px',
                                color: '#828d99',
                                offsetY: 7,
                                formatter: function (val) {
                                    return val + " %";
                                }
                            }
                        }
                    }
                },
                stroke: {
                    lineCap: 'round'
                },
                fill: {
                    colors: [info]
                },
                series: [diskUsage],
                labels: [''],

            };


            const gaugeChartCpu = new ApexCharts(
                document.querySelector("#gauge-chart-cpu"),
                gaugeChartOptionsCpu
            );

            const gaugeChartRam = new ApexCharts(
                document.querySelector("#gauge-chart-ram"),
                gaugeChartOptionsRam
            );

            const gaugeChartDisk = new ApexCharts(
                document.querySelector("#gauge-chart-disk"),
                gaugeChartOptionsDisk
            );

            gaugeChartCpu.render();
            gaugeChartRam.render();
            gaugeChartDisk.render();

        });

    </script>

@endsection
