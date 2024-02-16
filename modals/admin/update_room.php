<div class="modal fade" id="update_room" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title" id="exampleModalLabel"><b>Room Details</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="update_room_form">
                <div class="modal-body">
                    <input type="hidden" id="id_room_update" class="form-control">
                    <div class="row mb-2">
                        <div class="col-6">
                            <label>Room ID:</label>
                            <span id="room_id_update"></span>
                        </div>
                        <div class="col-6">
                            <label>Occupied:</label>
                            <span id="occupied_update"></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label>Room Type:</label><label style="color: red;">*</label>
                            <select id="room_type_update" class="form-control" required>
                                <option value="">Select Room Type</option>
                                <option value="Small">Small</option>
                                <option value="Medium">Medium</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label>Room Rent:</label><label style="color: red;">*</label>
                            <input type="number" id="room_rent_update" class="form-control" step="0.01" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label>Amount Per Kw Electric:</label><label style="color: red;">*</label>
                            <input type="number" id="amount_per_kw_electric_update" class="form-control" step="0.01" autocomplete="off" required>
                        </div>
                        <div class="col-6">
                            <label>Amount Per Head Water:</label><label style="color: red;">*</label>
                            <input type="number" id="amount_per_head_water_update" class="form-control" step="0.01" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label>Room Description</label><label style="color: red;">*</label>
                            <textarea id="room_description_update" class="form-control" style="resize: none;" rows="3" maxlength="255" onkeyup="count_room_description_update_char()" required></textarea>
                            <span id="room_description_update_count"></span>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            <div class="float-left">
                                <button type="submit" id="btnDeleteRoom" name="btn_delete_room" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="float-right">
                                <button type="submit" id="btnUpdateRoom" name="btn_update_room" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>