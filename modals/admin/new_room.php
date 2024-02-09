<div class="modal fade" id="new_room" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title" id="exampleModalLabel"><b>New Room</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="new_room_form">
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-6">
                            <label>Room Type:</label><label style="color: red;">*</label>
                            <select id="room_type" class="form-control" required>
                                <option value="">Select Room Type</option>
                                <option value="Small">Small</option>
                                <option value="Medium">Medium</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label>Room Rent:</label><label style="color: red;">*</label>
                            <input type="text" id="room_rent" class="form-control" maxlength="10" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label>Room Description</label><label style="color: red;">*</label>
                            <textarea id="room_description" class="form-control" style="resize: none;" rows="3" maxlength="255" onkeyup="count_room_description_char()" required></textarea>
                            <span id="room_description_count"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" id="btnAddRoom" name="btn_add_room" class="btn btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>