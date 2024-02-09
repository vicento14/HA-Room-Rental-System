<div class="modal fade" id="update_tenant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title" id="exampleModalLabel"><b>Tenant Details</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="update_tenant_form">
                <div class="modal-body">
                    <input type="hidden" id="id_tenant_update" class="form-control">
                    <div class="row mb-2">
                        <div class="col-6">
                            <label>Tenant ID:</label>
                            <span id="tenant_id_update"></span>
                        </div>
                        <div class="col-6">
                            <label>Status:</label>
                            <span id="active_update"></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <label>Last Name:</label><label style="color: red;">*</label>
                            <input type="text" id="last_name_update" class="form-control" maxlength="255" autocomplete="off" required>
                        </div>
                        <div class="col-4">
                            <label>First Name:</label><label style="color: red;">*</label>
                            <input type="text" id="first_name_update" class="form-control" maxlength="255" autocomplete="off" required>
                        </div>
                        <div class="col-4">
                            <label>Middle Name:</label>
                            <input type="text" id="middle_name_update" class="form-control" maxlength="255" autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label>Address</label><label style="color: red;">*</label>
                            <textarea id="address_update" class="form-control" style="resize: none;" rows="3" maxlength="625" onkeyup="count_address_update_char()" required></textarea>
                            <span id="address_update_count"></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <label>Number Of Tenants:</label><label style="color: red;">*</label>
                            <input type="number" id="num_of_tenants_update" class="form-control" min="1" autocomplete="off" required>
                        </div>
                        <div class="col-8">
                            <label>Contact Number:</label><label style="color: red;">*</label>
                            <input type="text" id="contact_number_update" class="form-control" maxlength="11" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label>Occupation:</label><label style="color: red;">*</label>
                            <input type="text" id="occupation_update" class="form-control" maxlength="255" autocomplete="off" required>
                        </div>
                        <div class="col-6">
                            <label>Company:</label><label style="color: red;">*</label>
                            <input type="text" id="company_update" class="form-control" maxlength="255" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label>Work Address</label><label style="color: red;">*</label>
                            <textarea id="work_address_update" class="form-control" style="resize: none;" rows="3" maxlength="625" onkeyup="count_work_address_update_char()" required></textarea>
                            <span id="work_address_update_count"></span>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            <div class="float-left">
                                <button type="submit" id="btnDeleteTenant" name="btn_delete_tenant" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="float-right">
                                <button type="submit" id="btnUpdateTenant" name="btn_update_tenant" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>