<?php
session_start();

session_unset();

session_destroy();
echo "<script>
    alert('User Logged Out!!');
    window.location.href = 'index.php';
  </script>.";
?>