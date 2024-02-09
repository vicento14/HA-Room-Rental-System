<div class="modal fade" id="new_tenant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title" id="exampleModalLabel"><b>New Tenant</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="new_tenant_form">
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-4">
                            <label>Last Name:</label><label style="color: red;">*</label>
                            <input type="text" id="last_name" class="form-control" maxlength="255" autocomplete="off" required>
                        </div>
                        <div class="col-4">
                            <label>First Name:</label><label style="color: red;">*</label>
                            <input type="text" id="first_name" class="form-control" maxlength="255" autocomplete="off" required>
                        </div>
                        <div class="col-4">
                            <label>Middle Name:</label>
                            <input type="text" id="middle_name" class="form-control" maxlength="255" autocomplete="off">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12">
                            <label>Address</label><label style="color: red;">*</label>
                            <textarea id="address" class="form-control" style="resize: none;" rows="3" maxlength="625" onkeyup="count_address_char()" required></textarea>
                            <span id="address_count"></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <label>Number Of Tenants:</label><label style="color: red;">*</label>
                            <input type="number" id="num_of_tenants" class="form-control" min="1" autocomplete="off" required>
                        </div>
                        <div class="col-8">
                            <label>Contact Number:</label><label style="color: red;">*</label>
                            <input type="text" id="contact_number" class="form-control" maxlength="11" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label>Occupation:</label><label style="color: red;">*</label>
                            <input type="text" id="occupation" class="form-control" maxlength="255" autocomplete="off" required>
                        </div>
                        <div class="col-6">
                            <label>Company:</label><label style="color: red;">*</label>
                            <input type="text" id="company" class="form-control" maxlength="255" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label>Work Address</label><label style="color: red;">*</label>
                            <textarea id="work_address" class="form-control" style="resize: none;" rows="3" maxlength="625" onkeyup="count_work_address_char()" required></textarea>
                            <span id="work_address_count"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" id="btnAddTenant" name="btn_add_tenant" class="btn btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>