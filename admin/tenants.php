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
                    <h1 class="h3 mb-4 text-gray-800">Tenants</h1>

                    <div class="row mb-4">
                        <div class="col-sm-3">
                            <a href="#" class="btn btn-block btn-success" data-toggle="modal" data-target="#new_tenant"><i class="fas fa-plus-circle mr-2"></i>Add Tenant</a>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tenants Table</h6>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                              <div class="col-sm-3">
                                <input type="text" id="tenant_id_search" class="form-control" placeholder="Tenant ID" autocomplete="off">
                              </div>
                              <div class="col-sm-3">
                                <input type="text" id="last_name_search" class="form-control" placeholder="Last Name" autocomplete="off">
                              </div>
                              <div class="col-sm-3">
                                <select id="active_search" class="form-control" onchange="search_tenants(1)">
                                  <option value="">Select Status</option>
                                  <option value="1">Active</option>
                                  <option value="0">Inactive</option>
                                </select>
                              </div>
                              <div class="col-sm-3">
                                <button class="btn btn-block btn-primary" id="BtnSearch" onclick="search_tenants(1)"><i class="fas fa-search mr-2"></i>Search</button>
                              </div>
                            </div>
                            <div id="tenants_table_res" class="table-responsive" style="height: 500px; overflow: auto; display:inline-block;">
                                <table class="table table-head-fixed text-nowrap table-hover" id="tenants_table" width="100%" cellspacing="0">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th><b>#</b></th>
                                            <th><b>Tenant ID</b></th>
                                            <th><b>Full Name</b></th>
                                            <th><b>Number Of Tenants</b></th>
                                            <th><b>Date Updated</b></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tenants_data" style="text-align: center;">
                                        <tr>
                                          <td colspan="5" style="text-align:center;">
                                            <div class="spinner-border text-dark" role="status">
                                              <span class="sr-only">Loading...</span>
                                            </div>
                                          </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-sm-end">
                              <div class="dataTables_info" id="tenants_table_info" role="status" aria-live="polite"></div>
                            </div>
                            <div class="d-flex justify-content-sm-center">
                              <button type="button" class="btn bg-primary" id="btnNextPage" style="display:none;" onclick="get_next_page()">Load more</button>
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