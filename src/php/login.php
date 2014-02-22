<?php
if(isset($_SESSION['user']))
{
    header('LOCATION: ../php/main.php');
}
?>
<html>
    <head>
        <link href='../css/login.css' rel='StyleSheet' type='text/css'/>
        <title>Adventurer Login</title>
        <h1>Adventurer</h1>
    </head>
    <body>
        <form method='post' name='login'action='../php/logincheck.php'>
            <table>
                    <td>Adventurer: </td><td><input type='text' name='username'/></td>
                </tr>
                <tr>
                    <td>Password: </td><td><input type='password' name='password'/></td>
                </tr>
            </table><br/>
            <input type='submit'class='loginbuttons'value='Login'/>
            <input type='button'class='loginbuttons'value='Create Account'onclick='tocreate()'/>
        </form><br/>
        <script>
            function tocreate()
            {
                window.location.replace('../html/createaccount.html');
            }
        </script>
    </body>
    <footer>
        Version: Alpha 0.1.1
    </footer>
</html>