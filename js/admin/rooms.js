// AJAX IN PROGRESS GLOBAL VARS
var search_rooms_ajax_in_progress = false;

$(document).ready(function () {
    search_rooms(1);
});

document.getElementById("room_id_search").addEventListener("keyup", e => {
    if (e.which === 13) {
        e.preventDefault();
        search_rooms(1);
    }
});

document.getElementById("room_rent_search").addEventListener("keyup", e => {
    if (e.which === 13) {
        e.preventDefault();
        search_rooms(1);
    }
});

// Table Responsive Scroll Event for Load More
document.getElementById("rooms_table_res").addEventListener("scroll", function () {
    var scrollTop = document.getElementById("rooms_table_res").scrollTop;
    var scrollHeight = document.getElementById("rooms_table_res").scrollHeight;
    var offsetHeight = document.getElementById("rooms_table_res").offsetHeight;

    //check if the scroll reached the bottom
    if ((offsetHeight + scrollTop + 1) >= scrollHeight) {
        get_next_page();
    }
});

const get_next_page = () => {
    var current_page = parseInt(sessionStorage.getItem('rooms_table_pagination'));
    let total = sessionStorage.getItem('count_rows');
    var last_page = parseInt(sessionStorage.getItem('last_page'));
    var next_page = current_page + 1;
    if (next_page <= last_page && total > 0) {
        search_rooms(next_page);
    }
}

const count_rooms = () => {
    var room_id = sessionStorage.getItem('room_id_search');
    var room_rent = sessionStorage.getItem('room_rent_search');
    var room_type = sessionStorage.getItem('room_type_search');
    $.ajax({
        url: '../process/admin/rooms/room_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'count_rooms',
            room_id: room_id,
            room_rent: room_rent,
            room_type: room_type
        },
        success: function (response) {
            sessionStorage.setItem('count_rows', response);
            var count = `Total: ${response}`;
            $('#rooms_table_info').html(count);

            if (response > 0) {
                rooms_last_page();
                /*document.getElementById("btnNextPage").style.display = "block";
                document.getElementById("btnNextPage").removeAttribute('disabled');*/
            } else {
                document.getElementById("btnNextPage").style.display = "none";
                document.getElementById("btnNextPage").setAttribute('disabled', true);
            }
        }
    });
}

const rooms_last_page = () => {
    var room_id = sessionStorage.getItem('room_id_search');
    var room_rent = sessionStorage.getItem('room_rent_search');
    var room_type = sessionStorage.getItem('room_type_search');
    var current_page = parseInt(sessionStorage.getItem('rooms_table_pagination'));
    $.ajax({
        url: '../process/admin/rooms/room_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'rooms_last_page',
            room_id: room_id,
            room_rent: room_rent,
            room_type: room_type
        },
        success: function (response) {
            sessionStorage.setItem('last_page', response);
            let total = sessionStorage.getItem('count_rows');
            var next_page = current_page + 1;
            if (next_page > response || total < 1) {
                document.getElementById("btnNextPage").style.display = "none";
                document.getElementById("btnNextPage").setAttribute('disabled', true);
            } else {
                document.getElementById("btnNextPage").style.display = "block";
                document.getElementById("btnNextPage").removeAttribute('disabled');
            }
        }
    });
}

const search_rooms = current_page => {
    // If an AJAX call is already in progress, return immediately
    if (search_rooms_ajax_in_progress) {
        return;
    }

    var room_id = document.getElementById('room_id_search').value;
    var room_rent = document.getElementById('room_rent_search').value;
    var room_type = document.getElementById('room_type_search').value;

    var room_id_1 = sessionStorage.getItem('room_id_search');
    var room_rent_1 = sessionStorage.getItem('room_rent_search');
    var room_type_1 = sessionStorage.getItem('room_type_search');
    if (current_page > 1) {
        switch (true) {
            case room_id !== room_id_1:
            case room_rent !== room_rent_1:
            case room_type !== room_type_1:
                room_id = room_id_1;
                room_rent = room_rent_1;
                room_type = room_type_1;
                break;
            default:
        }
        /*if (room_id !== room_id_1 || room_rent !== room_rent_1 || room_type !== room_type_1) {
            room_id = room_id_1;
            room_rent = room_rent_1;
            room_type = room_type_1;
        }*/
    } else {
        sessionStorage.setItem('room_id_search', room_id);
        sessionStorage.setItem('room_rent_search', room_rent);
        sessionStorage.setItem('room_type_search', room_type);
    }

    // Set the flag to true as we're starting an AJAX call
    search_rooms_ajax_in_progress = true;

    $.ajax({
        url: '../process/admin/rooms/room_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'search_rooms',
            room_id: room_id,
            room_rent: room_rent,
            room_type: room_type,
            current_page: current_page
        },
        beforeSend: (jqXHR, settings) => {
            document.getElementById("btnNextPage").setAttribute('disabled', true);
            var loading = `<tr id="loading"><td colspan="5" style="text-align:center;"><div class="spinner-border text-dark" role="status"><span class="sr-only">Loading...</span></div></td></tr>`;
            if (current_page == 1) {
                document.getElementById("rooms_data").innerHTML = loading;
            } else {
                $('#rooms_table tbody').append(loading);
            }
            jqXHR.url = settings.url;
            jqXHR.type = settings.type;
        },
        success: function (response) {
            $('#loading').remove();
            document.getElementById("btnNextPage").removeAttribute('disabled');
            if (current_page == 1) {
                $('#rooms_table tbody').html(response);
            } else {
                $('#rooms_table tbody').append(response);
            }
            sessionStorage.setItem('rooms_table_pagination', current_page);
            count_rooms();
            // Set the flag back to false as the AJAX call has completed
            search_rooms_ajax_in_progress = false;
        }
    }).fail((jqXHR, textStatus, errorThrown) => {
        console.log(jqXHR);
        console.log(`System Error : Call IT Personnel Immediately!!! They will fix it right away. Error: url: ${jqXHR.url}, method: ${jqXHR.type} ( HTTP ${jqXHR.status} - ${jqXHR.statusText} ) Press F12 to see Console Log for more info.`);
        $('#loading').remove();
        document.getElementById("btnNextPage").removeAttribute('disabled');
        // Set the flag back to false as the AJAX call has completed
        search_rooms_ajax_in_progress = false;
    });
}

$("#new_room").on('show.bs.modal', e => {
    load_room_description_textarea();
});

const load_room_description_textarea = () => {
    setTimeout(() => {
        var max_length = document.getElementById("room_description").getAttribute("maxlength");
        var room_description_length = document.getElementById("room_description").value.length;
        var room_description_count = `${room_description_length} / ${max_length}`;
        document.getElementById("room_description_count").innerHTML = room_description_count;
    }, 100);
}

const count_room_description_char = () => {
    var max_length = document.getElementById("room_description").getAttribute("maxlength");
    var room_description_length = document.getElementById("room_description").value.length;
    var room_description_count = `${room_description_length} / ${max_length}`;
    document.getElementById("room_description_count").innerHTML = room_description_count;
}

document.getElementById('new_room_form').addEventListener('submit', function (e) {
    e.preventDefault();
    add_room();
});

const add_room = () => {
    var room_type = document.getElementById('room_type').value;
    var room_rent = document.getElementById('room_rent').value;
    var room_description = document.getElementById('room_description').value;

    $.ajax({
        url: '../process/admin/rooms/room_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'add_room',
            room_type: room_type,
            room_rent: room_rent,
            room_description: room_description
        }, success: function (response) {
            if (response == 'success') {
                swal({
                    title: "Rooms",
                    text: `Successfully Added`,
                    icon: "info",
                    timer: 1000,
                });
                $('#room_type').val('');
                $('#room_rent').val('');
                $('#room_description').val('');
                search_rooms(1);
                $('#new_room').modal('hide');
            } else {
                swal('Rooms Error', `Error : ${response}`, 'error');
            }
        }
    });
}

const get_rooms_details = el => {
    var id = el.dataset.id;
    var room_id = el.dataset.room_id;
    var room_type = el.dataset.room_type;
    var room_rent = el.dataset.room_rent;
    var room_description = el.dataset.room_description;
    var occupied = el.dataset.occupied;

    document.getElementById("id_room_update").value = id;
    document.getElementById("room_id_update").innerHTML = room_id;
    document.getElementById("room_type_update").value = room_type;
    document.getElementById("room_rent_update").value = room_rent;
    document.getElementById("room_description_update").value = room_description;

    if (occupied == '1') {
        document.getElementById("occupied_update").innerHTML = 'Yes';
    } else {
        document.getElementById("occupied_update").innerHTML = 'No';
    }
}

$("#update_room").on('show.bs.modal', e => {
    load_room_description_update_textarea();
});

const load_room_description_update_textarea = () => {
    setTimeout(() => {
        var max_length = document.getElementById("room_description_update").getAttribute("maxlength");
        var room_description_update_length = document.getElementById("room_description_update").value.length;
        var room_description_update_count = `${room_description_update_length} / ${max_length}`;
        document.getElementById("room_description_update_count").innerHTML = room_description_update_count;
    }, 100);
}

const count_room_description_update_char = () => {
    var max_length = document.getElementById("room_description_update").getAttribute("maxlength");
    var room_description_update_length = document.getElementById("room_description_update").value.length;
    var room_description_update_count = `${room_description_update_length} / ${max_length}`;
    document.getElementById("room_description_update_count").innerHTML = room_description_update_count;
}

// Get the form element
var update_room_form = document.getElementById('update_room_form');

// Add a submit event listener to the form
update_room_form.addEventListener('submit', function (e) {
    e.preventDefault();

    // Get the button that triggered the submit event
    var button = document.activeElement;

    // Check the id or name of the button
    if (button.id === 'btnUpdateRoom') {
        // Call the function for the first submit button
        update_room();
    } else if (button.id === 'btnDeleteRoom') {
        // Call the function for the first submit button
        delete_room();
    }
});

const update_room = () => {
    var id = document.getElementById('id_room_update').value;
    var room_type = document.getElementById('room_type_update').value;
    var room_rent = document.getElementById('room_rent_update').value;
    var room_description = document.getElementById('room_description_update').value;

    $.ajax({
        url: '../process/admin/rooms/room_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'update_room',
            id: id,
            room_type: room_type,
            room_rent: room_rent,
            room_description: room_description
        }, success: function (response) {
            if (response == 'success') {
                swal({
                    title: "Rooms",
                    text: `Successfully Updated`,
                    icon: "info",
                    timer: 1000,
                });
                $('#room_type_update').val('');
                $('#room_rent_update').val('');
                $('#room_description_update').val('');
                search_rooms(1);
                $('#update_room').modal('hide');
            } else {
                swal('Rooms Error', `Error : ${response}`, 'error');
            }
        }
    });
}

const delete_room = () => {
    var id = document.getElementById('id_room_update').value;
    $.ajax({
        url: '../process/admin/rooms/room_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'delete_room',
            id: id
        }, success: function (response) {
            if (response == 'success') {
                swal({
                    title: "Rooms",
                    text: `Successfully Deleted`,
                    icon: "info",
                    timer: 1000,
                });
                search_rooms(1);
                $('#update_room').modal('hide');
            } else {
                swal('Rooms Error', `Error : ${response}`, 'error');
            }
        }
    });
}
