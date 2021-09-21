<?php
  include('components/navigation.php');
?>

<main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Overview</li>
                    </ol>
                </nav>
                <h1 class="h2">Welcome to your dashboard <?php echo htmlspecialchars($_SESSION["username"]); ?></h1>
                <div class="row my-4">
                    <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
                        <div class="card">
                            <h5 class="card-header">Employees</h5>
                            <div class="card-body">
                              <h5 class="card-title">$132,000.00</h5>
                              <p class="card-text">Salary payments</p>
                            </div>
                          </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                        <div class="card">
                            <h5 class="card-header">Running Projects</h5>
                            <div class="card-body">
                              <h5 class="card-title">5</h5>
                              <p class="card-text">Number of Projects</p>
                            </div>
                          </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                        <div class="card">
                            <h5 class="card-header">Departments</h5>
                            <div class="card-body">
                              <h5 class="card-title">3</h5>
                              <p class="card-text">Number of Departments</p>
                            </div>
                          </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                        <div class="card">
                            <h5 class="card-header">Total Expenditure</h5>
                            <div class="card-body">
                              <h5 class="card-title">$1,000,000.00</h5>
                              <p class="card-text">Employee/Project Expenditure</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-lg-0">
                        <div class="card">
                            <h5 class="card-header">Employees</h5>
                            <div class="card-body">
                                <div class="table-responsive">

                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th scope="col">Employee ID</th>
                                            <th scope="col">Department</th>
                                            <th scope="col">Employee Name</th>
                                            <th scope="col">Salary</th>
                                          </tr>
                                        </thead>

                                        <tbody>

                                          <tr>
                                            <th scope="row">17371705</th>
                                            <td>Volt Premium Bootstrap 5 Dashboard</td>
                                            <td>johndoe@gmail.com</td>
                                            <td>€61.11</td>
                                            <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                          </tr>

                                          <tr>
                                            <th scope="row">17370540</th>
                                            <td>Pixel Pro Premium Bootstrap UI Kit</td>
                                            <td>jacob.monroe@company.com</td>
                                            <td>$153.11</td>
                                            <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                          </tr>
                                          <tr>
                                            <th scope="row">17371705</th>
                                            <td>Volt Premium Bootstrap 5 Dashboard</td>
                                            <td>johndoe@gmail.com</td>
                                            <td>€61.11</td>
                                            <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                          </tr>

                                          <tr>
                                            <th scope="row">17370540</th>
                                            <td>Pixel Pro Premium Bootstrap UI Kit</td>
                                            <td>jacob.monroe@company.com</td>
                                            <td>$153.11</td>
                                            <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                          </tr>

                                          <tr>
                                            <th scope="row">17371705</th>
                                            <td>Volt Premium Bootstrap 5 Dashboard</td>
                                            <td>johndoe@gmail.com</td>
                                            <td>€61.11</td>
                                            <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                          </tr>

                                          <tr>
                                            <th scope="row">17370540</th>
                                            <td>Pixel Pro Premium Bootstrap UI Kit</td>
                                            <td>jacob.monroe@company.com</td>
                                            <td>$153.11</td>
                                            <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                          </tr>

                                        </tbody>
                                      </table>
                                </div>
                                <a href="#" class="btn btn-block btn-light">View all</a>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                    <div class="card">
                            <h5 class="card-header">Departments</h5>
                            <div class="card-body">
                                <div class="table-responsive">

                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th scope="col">Department ID</th>
                                            <th scope="col">Department Name</th>
                                          </tr>
                                        </thead>

                                        <tbody>

                                          <tr>
                                            <th scope="row">17371705</th>
                                            <td>Volt Premium Bootstrap 5 Dashboard</td>
                                            <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                          </tr>

                                          <tr>
                                            <th scope="row">17371705</th>
                                            <td>Volt Premium Bootstrap 5 Dashboard</td>
                                            <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                          </tr>

                                          <tr>
                                            <th scope="row">17371705</th>
                                            <td>Volt Premium Bootstrap 5 Dashboard</td>
                                            <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                          </tr>

                                          <tr>
                                            <th scope="row">17371705</th>
                                            <td>Volt Premium Bootstrap 5 Dashboard</td>
                                            <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                          </tr>

                                        </tbody>
                                      </table>
                                </div>
                                <a href="#" class="btn btn-block btn-light">View all</a>
                            </div>
                        </div>
                    </div>

                </div>
                <?php
                  include('components/footer.php');
                ?>
    </main>
  </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>