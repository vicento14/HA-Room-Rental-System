<div class="modal fade" id="update_account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title" id="exampleModalLabel"><b>New Account</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="update_account_form">
                <div class="modal-body">
                    <input type="hidden" id="id_account_update" class="form-control">
                    <div class="row mb-2">
                        <div class="col-6">
                            <label>Name:</label><label style="color: red;">*</label>
                            <input type="text" id="name_update" class="form-control" maxlength="255" autocomplete="off" required>
                        </div>
                        <div class="col-6">
                            <label>Username:</label><label style="color: red;">*</label>
                            <input type="text" id="username_update" class="form-control" maxlength="255" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label>Password:</label><label style="color: red;">*</label>
                            <input type="password" id="password_update" class="form-control" maxlength="255" autocomplete="off">
                        </div>
                        <div class="col-6">
                            <label>Role:</label><label style="color: red;">*</label>
                            <select id="role_update" class="form-control" required>
                                <option value="">Select Role</option>
                                <option value="Admin">Admin</option>
                                <option value="User">User</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            <div class="float-left">
                                <button type="submit" id="btnDeleteAccount" name="btn_delete_account" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="float-right">
                                <button type="submit" id="btnUpdateAccount" name="btn_update_account" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>