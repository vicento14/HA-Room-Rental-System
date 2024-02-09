<?php
include('plugins/header.php');
include('plugins/sidebar/admin_bar.php');
?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include('plugins/topbar.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Accounts</h1>

                    <div class="row mb-4">
                        <div class="col-sm-3">
                            <a href="#" class="btn btn-block btn-success" data-toggle="modal" data-target="#new_account"><i class="fas fa-plus-circle mr-2"></i>Add Account</a>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Accounts Table</h6>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                              <div class="col-sm-3">
                                <input type="text" id="username_search" class="form-control" placeholder="Username" autocomplete="off">
                              </div>
                              <div class="col-sm-3">
                                <input type="text" id="name_search" class="form-control" placeholder="Name" autocomplete="off">
                              </div>
                              <div class="col-sm-3">
                                <select id="role_search" class="form-control" onchange="search_accounts()">
                                  <option value="">Select Role</option>
                                  <option value="Admin">Admin</option>
                                  <option value="User">User</option>
                                </select>
                              </div>
                              <div class="col-sm-3">
                                <button class="btn btn-block btn-primary" id="BtnSearch" onclick="search_accounts()"><i class="fas fa-search mr-2"></i>Search</button>
                              </div>
                            </div>
                            <div class="table-responsive" style="height: 500px; overflow: auto; display:inline-block;">
                                <table class="table table-head-fixed text-nowrap table-hover" id="accounts_table" width="100%" cellspacing="0">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th><b>#</b></th>
                                            <th><b>Name</b></th>
                                            <th><b>Role</b></th>
                                            <th><b>Date Updated</b></th>
                                        </tr>
                                    </thead>
                                    <tbody id="accounts_data" style="text-align: center;">
                                        <tr>
                                          <td colspan="4" style="text-align:center;">
                                            <div class="spinner-border text-dark" role="status">
                                              <span class="sr-only">Loading...</span>
                                            </div>
                                          </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include('plugins/footer.php'); ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

<?php
include('plugins/anchorpagetop.php');
include('plugins/modals.php');
include('plugins/script.php');
?>