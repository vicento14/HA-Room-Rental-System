<div class="modal fade" id="new_account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title" id="exampleModalLabel"><b>New Account</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="new_account_form">
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-6">
                            <label>Name:</label><label style="color: red;">*</label>
                            <input type="text" id="name" class="form-control" maxlength="255" autocomplete="off" required>
                        </div>
                        <div class="col-6">
                            <label>Username:</label><label style="color: red;">*</label>
                            <input type="text" id="username" class="form-control" maxlength="255" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label>Password:</label><label style="color: red;">*</label>
                            <input type="password" id="password" class="form-control" maxlength="255" autocomplete="off" required>
                        </div>
                        <div class="col-6">
                            <label>Role:</label><label style="color: red;">*</label>
                            <select id="role" class="form-control" required>
                                <option value="">Select Role</option>
                                <option value="Admin">Admin</option>
                                <option value="User">User</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" id="btnAddAccount" name="btn_add_account" class="btn btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>