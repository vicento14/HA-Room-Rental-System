$(document).ready(function () {
    load_accounts();
});

document.getElementById("username_search").addEventListener("keyup", e => {
    if (e.which === 13) {
        e.preventDefault();
        search_accounts();
    }
});

document.getElementById("name_search").addEventListener("keyup", e => {
    if (e.which === 13) {
        e.preventDefault();
        search_accounts();
    }
});

const load_accounts = () => {
    $.ajax({
        url: '../process/admin/accounts/acct-management_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'load_accounts'
        },
        success: function (response) {
            document.getElementById("accounts_data").innerHTML = response;
        }
    });
}

const search_accounts = () => {
    var username = document.getElementById('username_search').value;
    var name = document.getElementById('name_search').value;
    var role = document.getElementById('role_search').value;
    $.ajax({
        url: '../process/admin/accounts/acct-management_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'search_accounts',
            username: username,
            name: name,
            role: role
        },
        beforeSend: () => {
            var loading = `<tr><td colspan="4" style="text-align:center;"><div class="spinner-border text-dark" role="status"><span class="sr-only">Loading...</span></div></td></tr>`;
            document.getElementById("accounts_data").innerHTML = loading;
        },
        success: function (response) {
            document.getElementById("accounts_data").innerHTML = response;
        }
    });
}

document.getElementById('new_account_form').addEventListener('submit', function(e) {
    e.preventDefault();
    add_account();
});

const add_account = () => {
    var name = document.getElementById('name').value;
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var role = document.getElementById('role').value;

    $.ajax({
        url: '../process/admin/accounts/acct-management_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'add_account',
            name: name,
            username: username,
            password: password,
            role: role
        }, success: function (response) {
            if (response == 'success') {
                swal({
                    title: "Accounts",
                    text: `Successfully Added`,
                    icon: "info",
                    timer: 1000,
                });
                document.getElementById("name").value = '';
                document.getElementById("username").value = '';
                document.getElementById("password").value = '';
                document.getElementById("role").value = '';
                load_accounts();
                $('#new_account').modal('hide');
            } else if (response == 'Already Exist') {
                swal('Accounts', `Duplicate Data`, 'info');
            } else {
                swal('Accounts Error', `Error : ${response}`, 'error');
            }
        }
    });
}

const get_accounts_details = el => {
    var id = el.dataset.id;
    var username = el.dataset.username;
    var name = el.dataset.name;
    var role = el.dataset.role;

    document.getElementById("id_account_update").value = id;
    document.getElementById("username_update").value = username;
    document.getElementById("name_update").value = name;
    document.getElementById("role_update").value = role;
}

// Get the form element
var update_account_form = document.getElementById('update_account_form');

// Add a submit event listener to the form
update_account_form.addEventListener('submit', function(e) {
    e.preventDefault();

    // Get the button that triggered the submit event
    var button = document.activeElement;

    // Check the id or name of the button
    if (button.id === 'btnUpdateAccount') {
        // Call the function for the first submit button
        update_account();
    } else if (button.id === 'btnDeleteAccount') {
        // Call the function for the first submit button
        delete_account();
    }
});

const update_account = () => {
    var id = document.getElementById('id_account_update').value;
    var username = document.getElementById('username_update').value;
    var name = document.getElementById('name_update').value;
    var password = document.getElementById('password_update').value;
    var role = document.getElementById('role_update').value;

    $.ajax({
        url: '../process/admin/accounts/acct-management_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'update_account',
            id: id,
            username: username,
            name: name,
            password: password,
            role: role
        }, success: function (response) {
            if (response == 'success') {
                swal({
                    title: "Accounts",
                    text: `Successfully Updated`,
                    icon: "info",
                    timer: 1000,
                });
                document.getElementById("name_update").value = '';
                document.getElementById("username_update").value = '';
                document.getElementById("password_update").value = '';
                document.getElementById("role_update").value = '';
                load_accounts();
                $('#update_account').modal('hide');
            } else if (response == 'duplicate') {
                swal('Accounts', `Duplicate Data`, 'info');
            } else {
                swal('Accounts Error', `Error : ${response}`, 'error');
            }
        }
    });
}

const delete_account = () => {
    var id = document.getElementById('id_account_update').value;
    $.ajax({
        url: '../process/admin/accounts/acct-management_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'delete_account',
            id: id
        }, success: function (response) {
            if (response == 'success') {
                swal({
                    title: "Accounts",
                    text: `Successfully Deleted`,
                    icon: "info",
                    timer: 1000,
                });
                document.getElementById("name_update").value = '';
                document.getElementById("username_update").value = '';
                document.getElementById("password_update").value = '';
                document.getElementById("role_update").value = '';
                load_accounts();
                $('#update_account').modal('hide');
            } else {
                swal('Accounts Error', `Error : ${response}`, 'error');
            }
        }
    });
}
