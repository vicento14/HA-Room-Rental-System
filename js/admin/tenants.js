// AJAX IN PROGRESS GLOBAL VARS
var search_tenants_ajax_in_progress = false;

$(document).ready(function () {
    search_tenants(1);
});

document.getElementById("tenant_id_search").addEventListener("keyup", e => {
    if (e.which === 13) {
        e.preventDefault();
        search_tenants(1);
    }
});

document.getElementById("last_name_search").addEventListener("keyup", e => {
    if (e.which === 13) {
        e.preventDefault();
        search_tenants(1);
    }
});

// Table Responsive Scroll Event for Load More
document.getElementById("tenants_table_res").addEventListener("scroll", function () {
    var scrollTop = document.getElementById("tenants_table_res").scrollTop;
    var scrollHeight = document.getElementById("tenants_table_res").scrollHeight;
    var offsetHeight = document.getElementById("tenants_table_res").offsetHeight;

    //check if the scroll reached the bottom
    if ((offsetHeight + scrollTop + 1) >= scrollHeight) {
        get_next_page();
    }
});

const get_next_page = () => {
    var current_page = parseInt(sessionStorage.getItem('tenants_table_pagination'));
    let total = sessionStorage.getItem('count_rows');
    var last_page = parseInt(sessionStorage.getItem('last_page'));
    var next_page = current_page + 1;
    if (next_page <= last_page && total > 0) {
        search_tenants(next_page);
    }
}

const count_tenants = () => {
    var tenant_id = sessionStorage.getItem('tenant_id_search');
    var last_name = sessionStorage.getItem('last_name_search');
    var active = sessionStorage.getItem('active_search');
    $.ajax({
        url: '../process/admin/tenants/tenant_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'count_tenants',
            tenant_id: tenant_id,
            last_name: last_name,
            active: active
        },
        success: function (response) {
            sessionStorage.setItem('count_rows', response);
            var count = `Total: ${response}`;
            $('#tenants_table_info').html(count);

            if (response > 0) {
                tenants_last_page();
                /*document.getElementById("btnNextPage").style.display = "block";
                document.getElementById("btnNextPage").removeAttribute('disabled');*/
            } else {
                document.getElementById("btnNextPage").style.display = "none";
                document.getElementById("btnNextPage").setAttribute('disabled', true);
            }
        }
    });
}

const tenants_last_page = () => {
    var tenant_id = sessionStorage.getItem('tenant_id_search');
    var last_name = sessionStorage.getItem('last_name_search');
    var active = sessionStorage.getItem('active_search');
    var current_page = parseInt(sessionStorage.getItem('tenants_table_pagination'));
    $.ajax({
        url: '../process/admin/tenants/tenant_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'tenants_last_page',
            tenant_id: tenant_id,
            last_name: last_name,
            active: active
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

const search_tenants = current_page => {
    // If an AJAX call is already in progress, return immediately
    if (search_tenants_ajax_in_progress) {
        return;
    }

    var tenant_id = document.getElementById('tenant_id_search').value;
    var last_name = document.getElementById('last_name_search').value;
    var active = document.getElementById('active_search').value;

    var tenant_id_1 = sessionStorage.getItem('tenant_id_search');
    var last_name_1 = sessionStorage.getItem('last_name_search');
    var active_1 = sessionStorage.getItem('active_search');
    if (current_page > 1) {
        switch (true) {
            case tenant_id !== tenant_id_1:
            case last_name !== last_name_1:
            case active !== active_1:
                tenant_id = tenant_id_1;
                last_name = last_name_1;
                active = active_1;
                break;
            default:
        }
        /*if (tenant_id !== tenant_id_1 || last_name !== last_name_1 || active !== active_1) {
            tenant_id = tenant_id_1;
            last_name = last_name_1;
            active = active_1;
        }*/
    } else {
        sessionStorage.setItem('tenant_id_search', tenant_id);
        sessionStorage.setItem('last_name_search', last_name);
        sessionStorage.setItem('active_search', active);
    }

    // Set the flag to true as we're starting an AJAX call
    search_tenants_ajax_in_progress = true;

    $.ajax({
        url: '../process/admin/tenants/tenant_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'search_tenants',
            tenant_id: tenant_id,
            last_name: last_name,
            active: active,
            current_page: current_page
        },
        beforeSend: (jqXHR, settings) => {
            document.getElementById("btnNextPage").setAttribute('disabled', true);
            var loading = `<tr id="loading"><td colspan="5" style="text-align:center;"><div class="spinner-border text-dark" role="status"><span class="sr-only">Loading...</span></div></td></tr>`;
            if (current_page == 1) {
                document.getElementById("tenants_data").innerHTML = loading;
            } else {
                $('#tenants_table tbody').append(loading);
            }
            jqXHR.url = settings.url;
            jqXHR.type = settings.type;
        },
        success: function (response) {
            $('#loading').remove();
            document.getElementById("btnNextPage").removeAttribute('disabled');
            if (current_page == 1) {
                $('#tenants_table tbody').html(response);
            } else {
                $('#tenants_table tbody').append(response);
            }
            sessionStorage.setItem('tenants_table_pagination', current_page);
            count_tenants();
            // Set the flag back to false as the AJAX call has completed
            search_tenants_ajax_in_progress = false;
        }
    }).fail((jqXHR, textStatus, errorThrown) => {
        console.log(jqXHR);
        console.log(`System Error : Call IT Personnel Immediately!!! They will fix it right away. Error: url: ${jqXHR.url}, method: ${jqXHR.type} ( HTTP ${jqXHR.status} - ${jqXHR.statusText} ) Press F12 to see Console Log for more info.`);
        $('#loading').remove();
        document.getElementById("btnNextPage").removeAttribute('disabled');
        // Set the flag back to false as the AJAX call has completed
        search_tenants_ajax_in_progress = false;
    });
}

$("#new_tenant").on('show.bs.modal', e => {
    load_address_textarea();
    load_work_address_textarea();
});

const load_address_textarea = () => {
    setTimeout(() => {
        var max_length = document.getElementById("address").getAttribute("maxlength");
        var address_length = document.getElementById("address").value.length;
        var address_count = `${address_length} / ${max_length}`;
        document.getElementById("address_count").innerHTML = address_count;
    }, 100);
}

const count_address_char = () => {
    var max_length = document.getElementById("address").getAttribute("maxlength");
    var address_length = document.getElementById("address").value.length;
    var address_count = `${address_length} / ${max_length}`;
    document.getElementById("address_count").innerHTML = address_count;
}

const load_work_address_textarea = () => {
    setTimeout(() => {
        var max_length = document.getElementById("work_address").getAttribute("maxlength");
        var work_address_length = document.getElementById("work_address").value.length;
        var work_address_count = `${work_address_length} / ${max_length}`;
        document.getElementById("work_address_count").innerHTML = work_address_count;
    }, 100);
}

const count_work_address_char = () => {
    var max_length = document.getElementById("work_address").getAttribute("maxlength");
    var work_address_length = document.getElementById("work_address").value.length;
    var work_address_count = `${work_address_length} / ${max_length}`;
    document.getElementById("work_address_count").innerHTML = work_address_count;
}

document.getElementById('new_tenant_form').addEventListener('submit', function (e) {
    e.preventDefault();
    add_tenant();
});

const add_tenant = () => {
    var last_name = document.getElementById('last_name').value;
    var first_name = document.getElementById('first_name').value;
    var middle_name = document.getElementById('middle_name').value;
    var address = document.getElementById('address').value;
    var num_of_tenants = document.getElementById('num_of_tenants').value;
    var contact_number = document.getElementById('contact_number').value;
    var occupation = document.getElementById('occupation').value;
    var company = document.getElementById('company').value;
    var work_address = document.getElementById('work_address').value;

    $.ajax({
        url: '../process/admin/tenants/tenant_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'add_tenant',
            last_name: last_name,
            first_name: first_name,
            middle_name: middle_name,
            address: address,
            num_of_tenants: num_of_tenants,
            contact_number: contact_number,
            occupation: occupation,
            company: company,
            work_address: work_address
        }, success: function (response) {
            if (response == 'success') {
                swal({
                    title: "Tenants",
                    text: `Successfully Added`,
                    icon: "info",
                    timer: 1000,
                });
                $('#last_name').val('');
                $('#first_name').val('');
                $('#middle_name').val('');
                $('#address').val('');
                $('#num_of_tenants').val('');
                $('#contact_number').val('');
                $('#occupation').val('');
                $('#company').val('');
                $('#work_address').val('');
                search_tenants(1);
                $('#new_tenant').modal('hide');
            } else {
                swal('Tenants Error', `Error : ${response}`, 'error');
            }
        }
    });
}

const get_tenants_details = el => {
    var id = el.dataset.id;
    var tenant_id = el.dataset.tenant_id;
    var active = el.dataset.active;
    var last_name = el.dataset.last_name;
    var first_name = el.dataset.first_name;
    var middle_name = el.dataset.middle_name;
    var address = el.dataset.address;
    var num_of_tenants = el.dataset.num_of_tenants;
    var contact_number = el.dataset.contact_number;
    var occupation = el.dataset.occupation;
    var company = el.dataset.company;
    var work_address = el.dataset.work_address;

    document.getElementById("id_tenant_update").value = id;
    document.getElementById("tenant_id_update").innerHTML = tenant_id;
    document.getElementById("last_name_update").value = last_name;
    document.getElementById("first_name_update").value = first_name;
    document.getElementById("middle_name_update").value = middle_name;
    document.getElementById("address_update").value = address;
    document.getElementById("num_of_tenants_update").value = num_of_tenants;
    document.getElementById("contact_number_update").value = contact_number;
    document.getElementById("occupation_update").value = occupation;
    document.getElementById("company_update").value = company;
    document.getElementById("work_address_update").value = work_address;
    document.getElementById("active_update").value = active;

    if (active == '1') {
        document.getElementById("active_update").innerHTML = 'Active';
    } else {
        document.getElementById("active_update").innerHTML = 'Inactive';
    }
}

$("#update_tenant").on('show.bs.modal', e => {
    load_address_update_textarea();
    load_work_address_update_textarea();
});

const load_address_update_textarea = () => {
    setTimeout(() => {
        var max_length = document.getElementById("address_update").getAttribute("maxlength");
        var address_update_length = document.getElementById("address_update").value.length;
        var address_update_count = `${address_update_length} / ${max_length}`;
        document.getElementById("address_update_count").innerHTML = address_update_count;
    }, 100);
}

const count_address_update_char = () => {
    var max_length = document.getElementById("address_update").getAttribute("maxlength");
    var address_update_length = document.getElementById("address_update").value.length;
    var address_update_count = `${address_update_length} / ${max_length}`;
    document.getElementById("address_update_count").innerHTML = address_update_count;
}

const load_work_address_update_textarea = () => {
    setTimeout(() => {
        var max_length = document.getElementById("work_address_update").getAttribute("maxlength");
        var work_address_update_length = document.getElementById("work_address_update").value.length;
        var work_address_update_count = `${work_address_update_length} / ${max_length}`;
        document.getElementById("work_address_update_count").innerHTML = work_address_update_count;
    }, 100);
}

const count_work_address_update_char = () => {
    var max_length = document.getElementById("work_address_update").getAttribute("maxlength");
    var work_address_update_length = document.getElementById("work_address_update").value.length;
    var work_address_update_count = `${work_address_update_length} / ${max_length}`;
    document.getElementById("work_address_update_count").innerHTML = work_address_update_count;
}

// Get the form element
var update_tenant_form = document.getElementById('update_tenant_form');

// Add a submit event listener to the form
update_tenant_form.addEventListener('submit', function (e) {
    e.preventDefault();

    // Get the button that triggered the submit event
    var button = document.activeElement;

    // Check the id or name of the button
    if (button.id === 'btnUpdateTenant') {
        // Call the function for the first submit button
        update_tenant();
    } else if (button.id === 'btnDeleteTenant') {
        // Call the function for the first submit button
        delete_tenant();
    }
});

const update_tenant = () => {
    var id = document.getElementById('id_tenant_update').value;
    var last_name = document.getElementById('last_name_update').value;
    var first_name = document.getElementById('first_name_update').value;
    var middle_name = document.getElementById('middle_name_update').value;
    var address = document.getElementById('address_update').value;
    var num_of_tenants = document.getElementById('num_of_tenants_update').value;
    var contact_number = document.getElementById('contact_number_update').value;
    var occupation = document.getElementById('occupation_update').value;
    var company = document.getElementById('company_update').value;
    var work_address = document.getElementById('work_address_update').value;

    $.ajax({
        url: '../process/admin/tenants/tenant_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'update_tenant',
            id: id,
            last_name: last_name,
            first_name: first_name,
            middle_name: middle_name,
            address: address,
            num_of_tenants: num_of_tenants,
            contact_number: contact_number,
            occupation: occupation,
            company: company,
            work_address: work_address
        }, success: function (response) {
            if (response == 'success') {
                swal({
                    title: "Tenants",
                    text: `Successfully Updated`,
                    icon: "info",
                    timer: 1000,
                });
                $('#last_name_update').val('');
                $('#first_name_update').val('');
                $('#middle_name_update').val('');
                $('#address_update').val('');
                $('#num_of_tenants_update').val('');
                $('#contact_number_update').val('');
                $('#occupation_update').val('');
                $('#company_update').val('');
                $('#work_address_update').val('');
                search_tenants(1);
                $('#update_tenant').modal('hide');
            } else {
                swal('Tenants Error', `Error : ${response}`, 'error');
            }
        }
    });
}

const delete_tenant = () => {
    var id = document.getElementById('id_tenant_update').value;
    $.ajax({
        url: '../process/admin/tenants/tenant_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'delete_tenant',
            id: id
        }, success: function (response) {
            if (response == 'success') {
                swal({
                    title: "Tenants",
                    text: `Successfully Deleted`,
                    icon: "info",
                    timer: 1000,
                });
                $('#last_name_update').val('');
                $('#first_name_update').val('');
                $('#middle_name_update').val('');
                $('#address_update').val('');
                $('#num_of_tenants_update').val('');
                $('#contact_number_update').val('');
                $('#occupation_update').val('');
                $('#company_update').val('');
                $('#work_address_update').val('');
                search_tenants(1);
                $('#update_tenant').modal('hide');
            } else {
                swal('Tenants Error', `Error : ${response}`, 'error');
            }
        }
    });
}
