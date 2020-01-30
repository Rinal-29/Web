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
                    <h2><?=$this->e($front_statistik_pekerjaan);?></h2>
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
                                "balloonText": "<?=$this->e($front_statistik_male);?>:[[value]]",
                                "fillAlphas": 0.8,
                                "id": "AmGraph-1",
                                "lineAlpha": 0.2,
                                "title": "<?=$this->e($front_statistik_male);?>",
                                "type": "column",
                                "valueField": "male"
                            }, {
                                "balloonText": "<?=$this->e($front_statistik_female);?>:[[value]]",
                                "fillAlphas": 0.8,
                                "id": "AmGraph-2",
                                "lineAlpha": 0.2,
                                "title": "<?=$this->e($front_statistik_female);?>",
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
                            "dataProvider": [
                            <?php
                                $pekerjaan = $this->statistik()->getPekerjaan('ASC', WEB_LANG_ID);
                                foreach ($pekerjaan as $krj){
                            ?>
                            {
                                "kiri": '<?=$krj['title'];?>',
                                "male": <?=$krj['male'];?>,
                                "female": <?=$krj['female'];?>
                            },
                            <?php } ?>
                            ],
                            "export": {
                                "enabled": false
                            }

                        });
                    </script>
                    <div id="chartpekerjaan" class="barchartdiv"></div>
                </div>
            </div>
            <div class="widget main_post_style main_right_post_style_list_scroll clearfix ">
                <div class="widget-title">
                    <h2><?=$this->e($front_statistik_pendidikan);?></h2>
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
                                "balloonText": "<?=$this->e($front_statistik_male);?>:[[value]]",
                                "fillAlphas": 0.8,
                                "id": "AmGraph-1",
                                "lineAlpha": 0.2,
                                "title": "<?=$this->e($front_statistik_male);?>",
                                "type": "column",
                                "valueField": "male"
                            }, {
                                "balloonText": "<?=$this->e($front_statistik_female);?>:[[value]]",
                                "fillAlphas": 0.8,
                                "id": "AmGraph-2",
                                "lineAlpha": 0.2,
                                "title": "<?=$this->e($front_statistik_female);?>",
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
                            "dataProvider": [
                            <?php
                                $pendidikan = $this->statistik()->getPendidikan('ASC', WEB_LANG_ID);
                                foreach ($pendidikan as $pdd){
                            ?>
                            {
                                "kiri": '<?=$pdd['title'];?>',
                                "male": <?=$pdd['male'];?>,
                                "female": <?=$pdd['female'];?>
                            },
                            <?php } ?>
                            ],
                            "export": {
                                "enabled": false
                            }

                        });
                    </script>

                    <div id="chartpendidikan" class="barchartdiv"></div>
                </div>
            </div>
            <div class="widget main_post_style main_right_post_style_list_scroll clearfix ">
                <div class="widget-title">
                    <h2><?=$this->e($front_statistik_umur);?></h2>
                </div>
                <div class="post_list_medium_widget">
                    <script>
                        var chart = AmCharts.makeChart("chartkelompokumur", {
                            "type": "serial",
                            "theme": "light",
                            "rotate": true,
                            "marginBottom": 50,
                            "dataProvider": [
                            <?php
                                $umur = $this->statistik()->getUmur('DESC', WEB_LANG_ID);
                                foreach ($umur as $umr){
                            ?>
                            {
                                "age": "<?=$umr['title'];?>",
                                "male": -<?=$umr['male'];?>,
                                "female": <?=$umr['female'];?>
                            },
                            <?php } ?>
                            ],
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
                                "title": "<?=$this->e($front_statistik_male);?>",
                                "labelText": "[[value]]",
                                "clustered": false,
                                "labelFunction": function(item) {
                                    return Math.abs(item.values.value);
                                },
                                "balloonFunction": function(item) {
                                    return item.category + ": " + Math.abs(item.values.value);
                                }
                            }, {
                                "fillAlphas": 0.8,
                                "lineAlpha": 0.2,
                                "type": "column",
                                "valueField": "female",
                                "title": "<?=$this->e($front_statistik_female);?>",
                                "labelText": "[[value]]",
                                "clustered": false,
                                "labelFunction": function(item) {
                                    return Math.abs(item.values.value);
                                },
                                "balloonFunction": function(item) {
                                    return item.category + ": " + Math.abs(item.values.value);
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
                                    return value;
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
                                "text": "<?=$this->e($front_statistik_male);?>",
                                "x": "28%",
                                "y": "97%",
                                "bold": true,
                                "align": "middle"
                            }, {
                                "text": "<?=$this->e($front_statistik_female);?>",
                                "x": "75%",
                                "y": "97%",
                                "bold": true,
                                "align": "middle"
                            }],
                            "export": {
                                "enabled": false
                            }

                        });
                    </script>
                    <div id="chartkelompokumur" class="chartdiv"></div>
                </div>
            </div>
        
            <div class="widget main_post_style main_right_post_style_list_scroll clearfix ">
                    <div class="widget-title">
                        <h2><?=$this->e($front_statistik_rw);?></h2>
                    </div>
                    <div class="post_list_medium_widget">
                    <script>
                        var chart = AmCharts.makeChart("chartrw", {
                            "theme": "light",
                            "type": "serial",
                        	"startDuration": 1,
                            "dataProvider": [
                            <?php
                                $dataRw = $this->statistik()->getRw('ASC', WEB_LANG_ID);
                                foreach ($dataRw as $drw){
                            ?>
                            {
                                "country": "<?=$drw['title'];?>",
                                "jumlah": <?=$drw['jumlah'];?>,
                                "color": "<?=$drw['color'];?>"
                            },
                            <?php } ?>
                            ],
                            "valueAxes": [{
                                "position": "left",
                            }],
                            "graphs": [{
                                "balloonText": "[[category]]: <b>[[value]]</b>",
                                "fillColorsField": "color",
                                "fillAlphas": 1,
                                "lineAlpha": 0.1,
                                "type": "column",
                                "valueField": "jumlah"
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
                        <?php
                        $dataStatistik = $this->statistik()->getStatistik('ASC', WEB_LANG_ID);
                        foreach ($dataStatistik as $dtStat){
                        ?>
                        <li class="clearfix appear_animation animate_css_stlye animate_start">
                            <h4 class="list_title" style="text-align: center; font-size: 16px; color: #005F92;"><?=$dtStat['title'];?></h4>
                            <h2 style="text-align: center;"><?=$dtStat['jumlah'];?></h2>
                        </li>
                        <?php } ?>
                    </ul>
                </div>

                <div class="margin-bottom"></div>
            </div>
            
            <div id="jellywp_widget-2" class="widget video_embed_widget">
                <div class="widget-title">
                    <h2><?= $this->e($front_statistik_dusun);?></h2>
                </div>
                <div class="widget_container">
                    <script type="text/javascript">
                        var chart;
                        var legend;
                        var selected;
                        
                        var types = [
                        <?php 
                          $dusun = $this->statistik()->getDusun('ASC', WEB_LANG_ID);
                          foreach($dusun as $dsn){
                            $CountDusun = $dsn['male']+$dsn['female'];
                        ?>
                        {
                          type: "<?=$dsn['title'];?>",
                          percent: <?=$CountDusun;?>,
                          color: "<?=$dsn['color'];?>",
                          subs: [{
                            type: "<?=$this->e($front_statistik_male);?>",
                            percent: <?=$dsn['male'];?>
                          }, {
                            type: "<?=$this->e($front_statistik_female);?>",
                            percent: <?=$dsn['female'];?>
                          }]
                        },
                        <?php } ?> 
                        ];
                        
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
                            "enabled": false
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
                    <h2><?= $this->e($front_statistik_agama);?></h2>
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
                            "dataProvider": [
                            <?php 
                              $agama = $this->statistik()->getAgama('ASC', WEB_LANG_ID);
                              foreach($agama as $agm){
                            ?>
                            {
                                "agama": "<?=$agm['title'];?>",
                                "litres": <?=$agm['jumlah'];?>
                            },
                            <?php } ?>
                            ],
                            "valueField": "litres",
                            "titleField": "agama"
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
                    <h2><?= $this->e($front_statistik_kawin);?></h2>
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
                            "dataProvider": [
                            <?php 
                              $kawin = $this->statistik()->getKawin('ASC', WEB_LANG_ID);
                              foreach($kawin as $kwn){
                            ?>
                            {
                                "status": "<?=$kwn['title'];?>",
                                "litres": <?=$kwn['jumlah'];?>
                            },
                            <?php } ?>],
                            "valueField": "litres",
                            "titleField": "status"
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
                            "dataProvider": [
                            <?php 
                            $sosial = $this->statistik()->getSosial('ASC', WEB_LANG_ID);
                            foreach ($sosial as $scl){
                            ?>
                            {
                                "golongan": "<?=$scl['title'];?>",
                                "golonganatas": <?=$scl['atas'];?>,
                                "golonganbawah": <?=$scl['bawah'];?>
                            },
                            <?php } ?>
                            ],
                            "valueAxes": [{
                                "stackType": "3d",
                                "position": "left",
                            }],
                            "startDuration": 1,
                            "graphs": [{
                                "balloonText": "[[category]] (<?=$this->e($front_statistik_kelas_atas);?>): <b>[[value]] </b>",
                                "fillAlphas": 0.9,
                                "lineAlpha": 0.2,
                                "title": "<?=$this->e($front_statistik_kelas_atas);?>",
                                "type": "column",
                                "color": "#D11919",
                                "valueField": "golonganatas"
                            }, {
                                "balloonText": "[[category]] (<?=$this->e($front_statistik_kelas_bawah);?>): <b>[[value]] </b>",
                                "fillAlphas": 0.9,
                                "lineAlpha": 0.2,
                                "title": "<?=$this->e($front_statistik_kelas_bawah);?>",
                                "type": "column",
                                "color": "#3C8D30",
                                "valueField": "golonganbawah"
                            }],
                            "plotAreaFillAlphas": 0.1,
                            "depth3D": 50,
                            "angle": 25,
                            "categoryField": "golongan",
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