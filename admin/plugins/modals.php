<?php
include('../modals/logout_modal.php');

if ($_SERVER['REQUEST_URI'] == "/harrs/admin/accounts.php") {
    include('../modals/admin/new_account.php');
    include('../modals/admin/update_account.php');
}
?>