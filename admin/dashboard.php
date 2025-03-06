<?php
require_once "../lib/db.php";
$db = new Database();
$bookingCount = $db->select("tb_order", "COUNT(id) AS count")[0]['count'];
$customerCount = $db->select("tb_user", "COUNT(id) AS count", "role = 'customer'")[0]['count'];
$totalRevenue = $db->select("tb_order", "SUM(total_amount) AS total")[0]['total'] ?? 0;
$totalCustomers = $customerCount;
$totalIncome = $totalRevenue;

$currentMonth = date('Y-m');
$monthlyIncome = $db->select("tb_order", "SUM(total_amount) AS total", "DATE_FORMAT(order_date, '%Y-%m') = '$currentMonth'")[0]['total'] ?? 0;

?>

<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="card">
          <div class="card-statistic-4">
            <div class="align-items-center justify-content-between">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                  <div class="card-content">
                    <h5 class="font-15">Booking</h5>
                    <h2 class="mb-3 font-18"><?php echo $bookingCount; ?></h2>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                  <div class="banner-img">
                    <img src="assets/img/banner/1.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="card">
          <div class="card-statistic-4">
            <div class="align-items-center justify-content-between">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                  <div class="card-content">
                    <h5 class="font-15">Customers</h5>
                    <h2 class="mb-3 font-18"><?php echo $customerCount; ?></h2>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                  <div class="banner-img">
                    <img src="assets/img/banner/2.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="card">
          <div class="card-statistic-4">
            <div class="align-items-center justify-content-between">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                  <div class="card-content">
                    <h5 class="font-15">Revenue</h5>
                    <h2 class="mb-3 font-18">$<?php echo number_format($totalRevenue, 2); ?></h2>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                  <div class="banner-img">
                    <img src="assets/img/banner/4.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12 col-sm-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Revenue chart</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-9">
                <div id="chart1"></div>
                <div class="row mb-0">
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="list-inline text-center">
                      <div class="list-inline-item p-r-30"><i data-feather="arrow-up-circle"
                          class="col-green"></i>
                        <h5 class="m-b-0">$<?php echo number_format($monthlyIncome / 4, 2); ?></h5>
                        <p class="text-muted font-14 m-b-0">Weekly Earnings</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="list-inline text-center">
                      <div class="list-inline-item p-r-30"><i data-feather="arrow-down-circle"
                          class="col-orange"></i>
                        <h5 class="m-b-0">$<?php echo number_format($monthlyIncome, 2); ?></h5>
                        <p class="text-muted font-14 m-b-0">Monthly Earnings</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="list-inline text-center">
                      <div class="list-inline-item p-r-30"><i data-feather="arrow-up-circle"
                          class="col-green"></i>
                        <h5 class="mb-0 m-b-0">$<?php echo number_format($totalIncome, 2); ?></h5>
                        <p class="text-muted font-14 m-b-0">Yearly Earnings</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="row mt-5">
                  <div class="col-7 col-xl-7 mb-3">Total customers</div>
                  <div class="col-5 col-xl-5 mb-3">
                    <span class="text-big"><?php echo $totalCustomers; ?></span>
                  </div>
                  <div class="col-7 col-xl-7 mb-3">Total Income</div>
                  <div class="col-5 col-xl-5 mb-3">
                    <span class="text-big">$<?php echo number_format($totalIncome, 2); ?></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>