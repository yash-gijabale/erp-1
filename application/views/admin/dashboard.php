<style>
  /* .chart-container{
    width: 600px !important;
  } */
  canvas{

width:50vw !important;
height:60vh !important;

}
</style>
<div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $total_developers ?></h3>

                <p>Total</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $total_projects ?></h3>

                <p>Close</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $total_structurs ?></h3>

                <p>In Progress</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $total_observations ?></h3>

                <p>Open NC</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>

        <div>
  <canvas id="myChart" class="mt-5 chart-container"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

  var graph_data = JSON.parse('<?php echo $graph_data ?>')
  console.log(graph_data);

  const ctx = document.getElementById('myChart');
  var myContext = document.getElementById( 
            "myChart").getContext('2d'); 
        var myChart = new Chart(myContext, { 
            type: 'bar', 
            data: { 
                labels: graph_data.project_list, 
                datasets: [{ 
                    label: 'Open', 
                    backgroundColor: "#4bc0c0", 
                    data: graph_data.open_nc, 
                }, { 
                    label: 'In Progress', 
                    backgroundColor: "#ff9f40", 
                    data: graph_data.progress_nc, 
                }, { 
                    label: 'Close', 
                    backgroundColor: "#ff6384", 
                    data: graph_data.close_nc, 
                }], 
            }, 
            options: { 
              maintainAspectRatio: true,
              responsive: true,
                plugins: { 
                    title: { 
                        display: true, 
                        text: 'Stacked Bar chart For Observation' 
                    }, 
                }, 
                scales: { 
                    x: { 
                        stacked: true, 
                        // barThickness: 1
                    }, 
                    y: { 
                        stacked: true 
                    } 
                } 
            } 
        }); 
</script>