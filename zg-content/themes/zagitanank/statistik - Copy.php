<?=$this->layout('index');?>
    <style>
        .amcharts-pie-slice:hover {
            transform: scale(1.1);
            filter: url(#shadow);
        }
        .piechartdiv {
            width: 100%;
            height: 430px;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .chartdiv {
            width: 100%;
            height: 500px;
            font-size: 11px;
        }
        .barchartdiv {
            width: 100%;
            height: 350px;
            font-size: 11px;
        }
        .chartbar {
            width: 100%;
            height: 500px;
            font-size: 11px;
        }
    </style>
    <script src="<?=$this->asset('/js/amchart/amcharts.js');?>"></script>
    <script src="<?=$this->asset('/js/amchart/pie.js');?>"></script>
    <script src="<?=$this->asset('/js/amchart/serial.js');?>"></script>
    <div class="breadcrumbs_options" style="margin-bottom: 10px;">
        <a href="<?=BASE_URL;?>"><?=$this->e($front_home);?>&nbsp;</a><i class="fa fa-angle-right yellow"></i>
        <a href="<?=$this->e($social_url);?>"><span class="current"><?=$this->e($page_title);?></span></a>
    </div>
    <h3 class="categories-title title"><?=$this->e($page_title);?></h3>
    <div class="row">
        <div class="eight columns content_display_col1" id="content">
            <div class="widget main_post_style main_right_post_style_list_scroll clearfix ">
                <div class="widget-title">
                    <h2>Pekerjaan</h2>
                </div>
                <div class="post_list_medium_widget">
                    <script>
                        var chart = AmCharts.makeChart("chartpekerjaan", {
                            "type": "serial",
                            "theme": "light",
                            "legend": {
                                "position": "top",
                                "marginRight": 10,
                                "autoMargins": false
                            },
                            "categoryField": "kiri",
                            "rotate": true,
                            "startDuration": 1,
                            "categoryAxis": {
                                "gridPosition": "start",
                                "position": "left"
                            },

                            "plotAreaFillAlphas": 0.1,
                            "depth3D": 15,
                            "angle": 5,
                            "trendLines": [],
                            "graphs": [{
                                "balloonText": "Male:[[value]]",
                                "fillAlphas": 0.8,
                                "id": "AmGraph-1",
                                "lineAlpha": 0.2,
                                "title": "Male",
                                "type": "column",
                                "valueField": "male"
                            }, {
                                "balloonText": "Female:[[value]]",
                                "fillAlphas": 0.8,
                                "id": "AmGraph-2",
                                "lineAlpha": 0.2,
                                "title": "Female",
                                "type": "column",
                                "valueField": "female"
                            }],
                            "guides": [],
                            "valueAxes": [{
                                "id": "ValueAxis-1",
                                "position": "top",
                                "axisAlpha": 0
                            }],
                            "allLabels": [],
                            "balloon": {},
                            "titles": [],
                            "dataProvider": [{
                                "kiri": 'IRT',
                                "male": 30.1,
                                "female": 23.9
                            }, {
                                "kiri": 'Pelajar/Mahasiswa',
                                "male": 29.5,
                                "female": 25.1
                            }, {
                                "kiri": 'Belum/Tidak Bekerja',
                                "male": 24.6,
                                "female": 25
                            }, {
                                "kiri": 'Petani/Pekebun',
                                "male": 24.6,
                                "female": 25
                            }, {
                                "kiri": 'Wiraswasta',
                                "male": 24.6,
                                "female": 25
                            }, {
                                "kiri": 'Lain-lain',
                                "male": 24.6,
                                "female": 25
                            }],
                            "export": {
                                "enabled": true
                            }

                        });
                    </script>
                    <div id="chartpekerjaan" class="barchartdiv"></div>
                </div>
            </div>
            <div class="widget main_post_style main_right_post_style_list_scroll clearfix ">
                <div class="widget-title">
                    <h2>Tingkat Pendidikan</h2>
                </div>
                <div class="post_list_medium_widget">
                    <script>
                        var chart = AmCharts.makeChart("chartpendidikan", {
                            "type": "serial",
                            "theme": "light",
                            "legend": {
                                "position": "top",
                                "marginRight": 10,
                                "autoMargins": false
                            },
                            "categoryField": "kiri",
                            "rotate": true,
                            "startDuration": 1,
                            "categoryAxis": {
                                "gridPosition": "start",
                                "position": "left"
                            },

                            "plotAreaFillAlphas": 0.1,
                            "depth3D": 15,
                            "angle": 5,
                            "trendLines": [],
                            "graphs": [{
                                "balloonText": "Male:[[value]]",
                                "fillAlphas": 0.8,
                                "id": "AmGraph-1",
                                "lineAlpha": 0.2,
                                "title": "Male",
                                "type": "column",
                                "valueField": "male"
                            }, {
                                "balloonText": "Female:[[value]]",
                                "fillAlphas": 0.8,
                                "id": "AmGraph-2",
                                "lineAlpha": 0.2,
                                "title": "Female",
                                "type": "column",
                                "valueField": "female"
                            }],
                            "guides": [],
                            "valueAxes": [{
                                "id": "ValueAxis-1",
                                "position": "top",
                                "axisAlpha": 0
                            }],
                            "allLabels": [],
                            "balloon": {},
                            "titles": [],
                            "dataProvider": [{
                                "kiri": 'Belum/Tidak Sekolah',
                                "male": 30.1,
                                "female": 23.9
                            }, {
                                "kiri": 'SD Sederjat',
                                "male": 29.5,
                                "female": 25.1
                            }, {
                                "kiri": 'SLTP Sederjat',
                                "male": 24.6,
                                "female": 25
                            }, {
                                "kiri": 'SLTA Sederjat',
                                "male": 24.6,
                                "female": 25
                            }, {
                                "kiri": 'Diploma',
                                "male": 24.6,
                                "female": 25
                            }, {
                                "kiri": 'Sarjana (S1/S2/S3)',
                                "male": 24.6,
                                "female": 25
                            }, {
                                "kiri": 'Tidak diketahui',
                                "male": 26.2,
                                "female": 22.8
                            }, ],
                            "export": {
                                "enabled": true
                            }

                        });
                    </script>

                    <div id="chartpendidikan" class="barchartdiv"></div>
                </div>
            </div>
            <div class="widget main_post_style main_right_post_style_list_scroll clearfix ">
                <div class="widget-title">
                    <h2>Kelompok Umur</h2>
                </div>
                <div class="post_list_medium_widget">
                    <script>
                        var chart = AmCharts.makeChart("chartkelompokumur", {
                            "type": "serial",
                            "theme": "light",
                            "rotate": true,
                            "marginBottom": 50,
                            "dataProvider": [{
                                "age": "85+",
                                "male": -0.1,
                                "female": 0.3
                            }, {
                                "age": "80-54",
                                "male": -0.2,
                                "female": 0.3
                            }, {
                                "age": "75-79",
                                "male": -0.3,
                                "female": 0.6
                            }, {
                                "age": "70-74",
                                "male": -0.5,
                                "female": 0.8
                            }, {
                                "age": "65-69",
                                "male": -0.8,
                                "female": 1.0
                            }, {
                                "age": "60-64",
                                "male": -1.1,
                                "female": 1.3
                            }, {
                                "age": "55-59",
                                "male": -1.7,
                                "female": 1.9
                            }, {
                                "age": "50-54",
                                "male": -2.2,
                                "female": 2.5
                            }, {
                                "age": "45-49",
                                "male": -2.8,
                                "female": 3.0
                            }, {
                                "age": "40-44",
                                "male": -3.4,
                                "female": 3.6
                            }, {
                                "age": "35-39",
                                "male": -4.2,
                                "female": 4.1
                            }, {
                                "age": "30-34",
                                "male": -5.2,
                                "female": 4.8
                            }, {
                                "age": "25-29",
                                "male": -5.6,
                                "female": 5.1
                            }, {
                                "age": "20-24",
                                "male": -5.1,
                                "female": 5.1
                            }, {
                                "age": "15-19",
                                "male": -3.8,
                                "female": 3.8
                            }, {
                                "age": "10-14",
                                "male": -3.2,
                                "female": 3.4
                            }, {
                                "age": "5-9",
                                "male": -4.4,
                                "female": 4.1
                            }, {
                                "age": "0-4",
                                "male": -5.0,
                                "female": 4.8
                            }],
                            "startDuration": 1,
                            "legend": {
                                "position": "top",
                                "marginRight": 10,
                                "autoMargins": false
                            },
                            "graphs": [{
                                "fillAlphas": 0.8,
                                "lineAlpha": 0.2,
                                "type": "column",
                                "valueField": "male",
                                "title": "Male",
                                "labelText": "[[value]]",
                                "clustered": false,
                                "labelFunction": function(item) {
                                    return Math.abs(item.values.value);
                                },
                                "balloonFunction": function(item) {
                                    return item.category + ": " + Math.abs(item.values.value) + "%";
                                }
                            }, {
                                "fillAlphas": 0.8,
                                "lineAlpha": 0.2,
                                "type": "column",
                                "valueField": "female",
                                "title": "Female",
                                "labelText": "[[value]]",
                                "clustered": false,
                                "labelFunction": function(item) {
                                    return Math.abs(item.values.value);
                                },
                                "balloonFunction": function(item) {
                                    return item.category + ": " + Math.abs(item.values.value) + "%";
                                }
                            }],
                            "categoryField": "age",
                            "categoryAxis": {
                                "gridPosition": "start",
                                "gridAlpha": 0.2,
                                "axisAlpha": 0
                            },
                            "valueAxes": [{
                                "gridAlpha": 0,
                                "ignoreAxisWidth": true,
                                "labelFunction": function(value) {
                                    return Math.abs(value) + '%';
                                },
                                "guides": [{
                                    "value": 0,
                                    "lineAlpha": 0.2
                                }]
                            }],
                            "balloon": {
                                "fixedPosition": true
                            },
                            "chartCursor": {
                                "valueBalloonsEnabled": false,
                                "cursorAlpha": 0.05,
                                "fullWidth": true
                            },
                            "allLabels": [{
                                "text": "Male",
                                "x": "28%",
                                "y": "97%",
                                "bold": true,
                                "align": "middle"
                            }, {
                                "text": "Female",
                                "x": "75%",
                                "y": "97%",
                                "bold": true,
                                "align": "middle"
                            }],
                            "export": {
                                "enabled": true
                            }

                        });
                    </script>
                    <div id="chartkelompokumur" class="chartdiv"></div>
                </div>
            </div>
        
            <div class="widget main_post_style main_right_post_style_list_scroll clearfix ">
                    <div class="widget-title">
                        <h2>Kelompok Umur</h2>
                    </div>
                    <div class="post_list_medium_widget">
                    <script>
                        var chart = AmCharts.makeChart("chartrw", {
                            "theme": "light",
                            "type": "serial",
                        	"startDuration": 1,
                            "dataProvider": [{
                                "country": "RW 1",
                                "visits": 4025,
                                "color": "#FF0F00"
                            }, {
                                "country": "RW 2",
                                "visits": 1882,
                                "color": "#FF6600"
                            }, {
                                "country": "RW 3",
                                "visits": 1809,
                                "color": "#FF9E01"
                            }, {
                                "country": "RW 4",
                                "visits": 1322,
                                "color": "#FCD202"
                            }, {
                                "country": "RW 5",
                                "visits": 1122,
                                "color": "#F8FF01"
                            }, {
                                "country": "RW 6",
                                "visits": 1114,
                                "color": "#B0DE09"
                            }, {
                                "country": "RW 7",
                                "visits": 984,
                                "color": "#04D215"
                            }],
                            "valueAxes": [{
                                "position": "left",
                            }],
                            "graphs": [{
                                "balloonText": "[[category]]: <b>[[value]]</b>",
                                "fillColorsField": "color",
                                "fillAlphas": 1,
                                "lineAlpha": 0.1,
                                "type": "column",
                                "valueField": "visits"
                            }],
                            "depth3D": 10,
                        	"angle": 20,
                            "chartCursor": {
                                "categoryBalloonEnabled": false,
                                "cursorAlpha": 0,
                                "zoomable": false
                            },
                            
                            "responsive": {
                                "enabled": true
                            },
                            "categoryField": "country",
                            "categoryAxis": {
                                "gridPosition": "start",
                                "labelRotation": 90
                            }
                        
                        });
                        </script>
                        <div id="chartrw" class="chartbar"></div>
                    </div>
            </div>
        
        
        </div>
        
        <div class="four columns content_display_col3" id="sidebar">
            <div id="jellywp_widget-1" class="widget post_list_widget comment_widget">
                <div class="widget_container">
                    <ul class="post_list">
                        <li class="clearfix appear_animation animate_css_stlye animate_start">
                            <h4 class="list_title" style="text-align: center; font-size: 16px; color: #005F92;">Jumlah Penduduk</h4>
                            <h2 style="text-align: center;">1200</h2>
                        </li>
                        <li class="clearfix appear_animation animate_css_stlye animate_start">
                            <h4 class="list_title" style="text-align: center; font-size: 16px; color: #005F92;">Jumlah Keluarga</h4>
                            <h2 style="text-align: center;">400</h2>
                        </li>
                        <li class="clearfix appear_animation animate_css_stlye animate_start">
                            <h4 class="list_title" style="text-align: center; font-size: 16px; color: #005F92;">Penduduk Laki-laki</h4>
                            <h2 style="text-align: center;">500</h2>
                        </li>
                        <li class="clearfix appear_animation animate_css_stlye animate_start">
                            <h4 class="list_title" style="text-align: center; font-size: 16px; color: #005F92;">Penduduk Perempuan</h4>
                            <h2 style="text-align: center;">700</h2>
                        </li>
                    </ul>
                </div>

                <div class="margin-bottom"></div>
            </div>
            
            <div id="jellywp_widget-2" class="widget video_embed_widget">
                <div class="widget-title">
                    <h2>Dusun</h2>
                </div>
                <div class="widget_container">
                    <script type="text/javascript">
                        var chart;
                        var legend;
                        var selected;
                        
                        var types = [{
                          type: "Dusun Elle",
                          percent: 70,
                          color: "#ff9e01",
                          subs: [{
                            type: "Laki-laki",
                            percent: 15
                          }, {
                            type: "Perempuan",
                            percent: 35
                          }]
                        }, {
                          type: "Dusun Tokella",
                          percent: 30,
                          color: "#b0de09",
                          subs: [{
                            type: "Laki-laki",
                            percent: 15
                          }, {
                            type: "Perempuan",
                            percent: 10
                          }]
                        }];
                        
                        function generateChartData() {
                          var chartData = [];
                          for (var i = 0; i < types.length; i++) {
                            if (i == selected) {
                              for (var x = 0; x < types[i].subs.length; x++) {
                                chartData.push({
                                  type: types[i].subs[x].type,
                                  percent: types[i].subs[x].percent,
                                  color: types[i].color,
                                  pulled: true
                                });
                              }
                            } else {
                              chartData.push({
                                type: types[i].type,
                                percent: types[i].percent,
                                color: types[i].color,
                                id: i
                              });
                            }
                          }
                          return chartData;
                        }
                        
                        AmCharts.makeChart("chartdusun", {
                          "type": "pie",
                          "theme": "light",
                          "labelRadius": -35,
                          "labelText": "[[title]]",
                          "dataProvider": generateChartData(),
                          "balloonText": "[[title]]: [[value]]",
                          "titleField": "type",
                          "valueField": "percent",
                          "outlineColor": "#FFFFFF",
                          "outlineAlpha": 0.8,
                          "outlineThickness": 2,
                          "colorField": "color",
                          "pulledField": "pulled",
                            "legend": {
                                "position": "top",
                                "marginRight": 10,
                                "autoMargins": false
                            },
                          "listeners": [{
                            "event": "clickSlice",
                            "method": function(event) {
                              var chart = event.chart;
                              if (event.dataItem.dataContext.id != undefined) {
                                selected = event.dataItem.dataContext.id;
                              } else {
                                selected = undefined;
                              }
                              chart.dataProvider = generateChartData();
                              chart.validateData();
                            }
                          }],
                          "export": {
                            "enabled": true
                          }
                        });
                    </script>
                    <div id="chartdusun" class="piechartdiv"></div>
                    <div class="clear"></div>
                </div>


                <div class="margin-bottom"></div>
            </div>
            
            <div id="jellywp_widget-3" class="widget video_embed_widget">
                <div class="widget-title">
                    <h2>Agama</h2>
                </div>
                <div class="widget_container">
                    <script type="text/javascript">
                        var chart = AmCharts.makeChart("chartagama", {
                            "type": "pie",
                            "theme": "light",
                            "legend": {
                                "position": "top",
                                "marginRight": 0,
                                "autoMargins": false
                            },
                            "startDuration": 0,
                            "labelRadius": -35,
                            "labelText": "",
                            "dataProvider": [{
                                "country": "Lithuania",
                                "litres": 501.9
                            }, {
                                "country": "Czech Republic",
                                "litres": 301.9
                            }, {
                                "country": "Ireland",
                                "litres": 201.1
                            }, {
                                "country": "Germany",
                                "litres": 165.8
                            }, {
                                "country": "Australia",
                                "litres": 139.9
                            }],
                            "valueField": "litres",
                            "titleField": "country"
                        });

                        chart.addListener("init", handleInit);

                        chart.addListener("rollOverSlice", function(e) {
                            handleRollOver(e);
                        });

                        function handleInit() {
                            chart.legend.addListener("rollOverItem", handleRollOver);
                        }

                        function handleRollOver(e) {
                            var wedge = e.dataItem.wedge.node;
                            wedge.parentNode.appendChild(wedge);
                        }
                    </script>
                    <div id="chartagama" class="piechartdiv"></div>
                    <div class="clear"></div>
                </div>


                <div class="margin-bottom"></div>
            </div>
            
            

            <div id="jellywp_widget-4" class="widget video_embed_widget">
                <div class="widget-title">
                    <h2>Status Kawin</h2>
                </div>
                <div class="widget_container">
                    <script type="text/javascript">
                        var chart2 = AmCharts.makeChart("chartstatusnikah", {
                            "type": "pie",
                            "theme": "light",
                            "legend": {
                                "position": "top",
                                "marginRight": 0,
                                "autoMargins": false
                            },
                            "startDuration": 0,
                            "labelRadius": -35,
                            "labelText": "",
                            "dataProvider": [{
                                "country": "Lithuania",
                                "litres": 501.9
                            }, {
                                "country": "Czech Republic",
                                "litres": 301.9
                            }, {
                                "country": "Ireland",
                                "litres": 201.1
                            }, {
                                "country": "Germany",
                                "litres": 165.8
                            }, {
                                "country": "Australia",
                                "litres": 139.9
                            }],
                            "valueField": "litres",
                            "titleField": "country"
                        });

                        chart2.addListener("init", handleInit);

                        chart2.addListener("rollOverSlice", function(e) {
                            handleRollOver(e);
                        });

                        function handleInit() {
                            chart2.legend.addListener("rollOverItem", handleRollOver);
                        }

                        function handleRollOver(e) {
                            var wedge = e.dataItem.wedge.node;
                            wedge.parentNode.appendChild(wedge);
                        }
                    </script>
                    <div id="chartstatusnikah" class="piechartdiv"></div>
                    <div class="clear"></div>
                </div>


                <div class="margin-bottom"></div>
            </div>

        </div>

    </div>
    <div class="row">
        <div class="twelve columns">
            <div class="widget main_post_style main_right_post_style_list_scroll clearfix ">
                <div class="widget-title">
                    <h2>Kelas dan Bantuan Sosial</h2>
                </div>
                <div class="post_list_medium_widget">
                    <script>
                        var chart3 = AmCharts.makeChart("chartdivSosial", {
                            "theme": "light",
                            "type": "serial",
                            "legend": {
                                "position": "top",
                                "marginRight": 0,
                                "autoMargins": false
                            },
                            "dataProvider": [{
                                "country": "Total Keluarga",
                                "golonganatas": 3.5,
                                "golonganbawah": 4.2
                            }, {
                                "country": "Keluarga Raskin",
                                "golonganatas": 1.7,
                                "golonganbawah": 3.1
                            }, {
                                "country": "Program Keluarga Harapan",
                                "golonganatas": 2.8,
                                "golonganbawah": 2.9
                            }, {
                                "country": "Keluarga BPJS",
                                "golonganatas": 2.6,
                                "golonganbawah": 2.3
                            }, {
                                "country": "Keluarga KIP",
                                "golonganatas": 1.4,
                                "golonganbawah": 2.1
                            }],
                            "valueAxes": [{
                                "stackType": "3d",
                                "unit": "%",
                                "position": "left",
                            }],
                            "startDuration": 1,
                            "graphs": [{
                                "balloonText": "[[category]] (Menengah ke Atas): <b>[[value]] %</b>",
                                "fillAlphas": 0.9,
                                "lineAlpha": 0.2,
                                "title": "Golongan Menengah ke Atas",
                                "type": "column",
                                "color": "#D11919",
                                "valueField": "golonganatas"
                            }, {
                                "balloonText": "[[category]] (Menengah ke Bawah): <b>[[value]] %</b>",
                                "fillAlphas": 0.9,
                                "lineAlpha": 0.2,
                                "title": "Golongan Menengah ke Bawah",
                                "type": "column",
                                "color": "#3C8D30",
                                "valueField": "golonganbawah"
                            }],
                            "plotAreaFillAlphas": 0.1,
                            "depth3D": 50,
                            "angle": 25,
                            "categoryField": "country",
                            "categoryAxis": {
                                "gridPosition": "start"
                            },
                            "export": {
                                "enabled": true
                            }
                        });
                    </script>

                    <div id="chartdivSosial" class="chartdiv"></div>
                </div>
            </div>
        </div>
    </div>