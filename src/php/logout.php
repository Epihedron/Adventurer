<?php
    session_start();
    setcookie("PHPSESSID","",time()-3600);
    session_destroy();
?>
<html>
    <head>
    <link href='../css/redirect.css' type='text/css' rel='StyleSheet'/>
    <meta http-equiv='refresh' content='3;../../index.html'/>
    </head>
    <body>
        You have logged out successfully.
    </body>
</html>