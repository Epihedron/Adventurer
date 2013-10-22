<?php
    session_start();
?>
<html>
    <head>
        <link href='../css/admin.css' rel='StyleSheet' type='text/css'/>
        <script src='../js/admin.js'></script>
        <h1>Administration Page</h1>
        <h2>
            <button class='menubutton' onclick='tomain()'>Main</button>
            <button class='menubutton' onclick='logout()'>Logout</button>
        </h2>
        <h3>Your access level <?php echo $_SESSION['user'];?> is: <?php echo $_SESSION['access'];?>.</h3>
    </head>
    <body>
        <form action='../php/adminupdate.php' method='post' name='update'>
            <table id='newupdate'>
                <th>Post Update</th>
                <tr>
                    <td>
                        <input type='text' id='updatetitle' name='updatetitle' maxlength='200'/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <textarea id='updatebody' name='updatebody' maxlength='1000'></textarea>
                    </td>
                </tr>
                <tr id='updatesubmit'>
                    <td>
                        <input type='submit' value='Submit' class='updatesubmit'/><button class='updatesubmit' type='button' onclick='clearfield()'>Clear</button>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>