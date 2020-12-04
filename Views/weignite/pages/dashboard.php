
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
<link href="<?= base_url("assets_admin/plugins/apex/apexcharts.css") ?>" rel="stylesheet" type="text/css">
<link href="<?= base_url("assets_admin/assets/css/dashboard/dash_1.css") ?>" rel="stylesheet" type="text/css" />
<style media="screen">
    .widget.widget-chart-three .widget-heading h5 {
        font-size: 17px;
        display: block;
        color: #000000;
        margin-bottom: 0;
    }
</style>
<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
<!--  BEGIN CONTENT AREA  -->
<div class="layout-px-spacing">

    <div class="row layout-top-spacing">

        <?php if (isset($graph)): ?>
            <?php $graphTime = $project->getGrpahTime($graph) ?>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-chart-three">
                    <div class="widget-heading">
                        <div class="">
                            <h5 class=""><?= $project->getTotalGraph($graph) ?> Visitors, graph per day</h5>
                        </div>

                        <div class="dropdown  custom-dropdown">
                            <a class="dropdown-toggle" href="#" role="button" id="uniqueVisitors" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="uniqueVisitors">
                                <a class="dropdown-item" href="javascript:void(0);">View</a>
                                <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                <a class="dropdown-item" href="javascript:void(0);">Download</a>
                            </div>
                        </div>
                    </div>

                    <div class="widget-content">
                        <div id="uniqueVisits"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 layout-spacing">
                <div class="widget widget-chart-three">
                    <div class="widget-heading">
                        <div class="">
                            <h5 class="">Graph by hours</h5>
                        </div>

                        <div class="dropdown  custom-dropdown">
                            <a class="dropdown-toggle" href="#" role="button" id="uniqueVisitors" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="uniqueVisitors">
                                <a class="dropdown-item" href="javascript:void(0);">View</a>
                                <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                <a class="dropdown-item" href="javascript:void(0);">Download</a>
                            </div>
                        </div>
                    </div>

                    <div class="widget-content">
                        <div id="hourHeat"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 layout-spacing">
                <div class="widget widget-chart-three">
                    <div class="widget-heading">
                        <h5 class="">Most web link and video clicked</h5>
                    </div>
                    <div class="widget-content">
                        <ul class="list-group ">
                            <?php foreach ($project->getMostLinked() as $link): ?>
                                <li class="list-group-item">
                                    <div class="row" style="border-bottom: 1px silver solid;">
                                        <div class="col-8">
                                            <?= $link->_get("data") ?>
                                        </div>
                                        <div class="col-4 text-right">
                                            <b><?= $link->cantidad ?></b>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 layout-spacing">
                <div class="widget widget-chart-three">
                    <div class="widget-heading">
                        <h5 class="">Most Emojis</h5>
                    </div>
                    <div class="widget-content">
                        <ul class="list-group ">
                            <?php foreach ($project->getMostEmojis() as $emoji): ?>
                                <li class="list-group-item">
                                    <div class="row" style="border-bottom: 1px silver solid;">
                                        <div class="col-8">
                                            <?= $emoji->_get("data") ?>
                                        </div>
                                        <div class="col-4 text-right">
                                            <b><?= $emoji->cantidad ?></b>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                * You don´t have a project
            </div>

        <?php endif; ?>



    </div>

</div>
<?php if (isset($graph)): ?>
    <!--  END CONTENT AREA  -->
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="<?= base_url("assets_admin/plugins/apex/apexcharts.min.js") ?>"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

    <script type="text/javascript">
    // Total Visits
    try {

      Apex.tooltip = {
        theme: 'light'
      }
      <?php $accessGraph = $project->getAccessGraph($graph) ?>
        var d_1options1 = {
          chart: {
              height: 350,
              type: 'bar',
              toolbar: {
                show: false,
              },
              dropShadow: {
                  enabled: true,
                  top: 1,
                  left: 1,
                  blur: 1,
                  color: '#515365',
                  opacity: 0.3,
              }
          },
          colors: ['#5c1ac3', '#ffbb44'],
          plotOptions: {
              bar: {
                  horizontal: false,
                  columnWidth: '55%',
                  endingShape: 'flat'
              },
          },
          dataLabels: {
              enabled: false
          },
          legend: {
                position: 'bottom',
                horizontalAlign: 'center',
                fontSize: '14px',
                markers: {
                  width: 10,
                  height: 10,
                },
                itemMargin: {
                  horizontal: 0,
                  vertical: 8
                }
          },
          grid: {
            borderColor: '#EEE',
          },
          stroke: {
              show: true,
              width: 2,
              colors: ['transparent']
          },
          series: [{
              name: 'Direct',
              data: [<?= implode(", ", $accessGraph); ?>]
            },
          ],
          xaxis: {
              categories: ['<?= implode("', '",array_keys($accessGraph)); ?>'],
          },
          fill: {
            type: 'gradient',
            gradient: {
              shade: 'dark',
              type: 'vertical',
              shadeIntensity: 0.3,
              inverseColors: false,
              opacityFrom: 1,
              opacityTo: 0.8,
              stops: [0, 100]
            }
          },
          tooltip: {
            theme: 'dark',
              y: {
                  formatter: function (val) {
                      return val
                  }
              }
          }
        }
        var d_1options2 = {
          chart: {
              height: 350,
              type: 'bar',
              toolbar: {
                show: false,
              },
              dropShadow: {
                  enabled: true,
                  top: 1,
                  left: 1,
                  blur: 1,
                  color: '#0e7dff',
                  opacity: 0.3,
              }
          },
          colors: ['#0e7dff'],
          plotOptions: {
              bar: {
                  horizontal: true,
                  columnWidth: '55%',
                  endingShape: 'flat'
              },
          },
          dataLabels: {
              enabled: false
          },
          legend: {
                position: 'bottom',
                horizontalAlign: 'center',
                fontSize: '14px',
                markers: {
                  width: 10,
                  height: 10,
                },
                itemMargin: {
                  horizontal: 0,
                  vertical: 8
                }
          },
          grid: {
            borderColor: '#EEE',
          },
          stroke: {
              show: true,
              width: 2,
              colors: ['transparent']
          },
          series: [{
              name: 'Direct',
              data: [<?= implode(", ", $graphTime); ?>]
            },
          ],
          xaxis: {
              categories: ['<?= implode("', '",array_keys($graphTime)); ?>'],
          },
          fill: {
            type: 'gradient',
            gradient: {
              shade: 'dark',
              type: 'vertical',
              shadeIntensity: 0.3,
              inverseColors: false,
              opacityFrom: 1,
              opacityTo: 0.8,
              stops: [0, 100]
            }
          },
          tooltip: {
            theme: 'dark',
              y: {
                  formatter: function (val) {
                      return val
                  }
              }
          }
        }


        var d_1C_3 = new ApexCharts(
            document.querySelector("#uniqueVisits"),
            d_1options1
        );
        d_1C_3.render();

        var d_1C_2 = new ApexCharts(
            document.querySelector("#hourHeat"),
            d_1options2
        );
        d_1C_2.render();


        const ps = new PerfectScrollbar(document.querySelector('.mt-container'));


    } catch(e) {
      // statements
      console.log(e);
    }
    </script>
<?php endif; ?>
