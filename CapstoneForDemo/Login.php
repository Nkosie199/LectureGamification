<!DOCTYPE html>
<html>


<?php
    //Connection to the Gamification database
    $db_host = 'localhost'; // Server Name
    $db_user = 'root'; // Username
    $db_pass = ''; // Password
    $db_name = 'Gamification'; // Database Name

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (!$conn) {
        die ('Failed to connect to MySQL: ' . mysqli_connect_error());  
    }
    session_start();
    
?>

    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="css/loginstyle.css">
        <script src="http://code.jquery.com/jquery-3.2.1.js"></script>
    </head>


    <body>
        <div class="login-form">

            <div class="app-title">

                <img src="images/uct-background.png">

                <div class = "control-group" >
                    <form action = "" method = "GET">

                        <select name= myoption id="user-name" class="select">

                            <option value="student">Student</option>
                            <option value="lecturer">Lecturer</option>

                            <div class="control-group">

                                <input type="text" class="login-field" value="" placeholder="username" id="login-name" name = "studentid">

                                <label class="login-field-icon fui-user" for="login-name"></label>
                            </div>

                            <div class="control-group">

                                <input type="password" class="login-field" value="" placeholder="password" id="login-pass" name = "password">

                                <label class="login-field-icon fui-lock" for="login-pass"></label>
                            </div>
                            <script type="text/javascript">
                            </script>
                            <input class = "login-button" type= "submit" value = "Login">

                        </select>
                    </form>

                    <?php
                    if(isset($_GET['myoption']) && isset($_GET['studentid']) && isset($_GET['password'])) 
                    {
                        $type = $_GET['myoption'];
                        $id = $_GET['studentid'];
                        $pass = $_GET['password'];

                        if($type == 'student')
                        {
                            $sql = "SELECT * FROM students WHERE studentid = '" . $id . "' AND password = '" . $pass ."';";

                            $query = mysqli_query($conn, $sql);
                            
                            if($query){

                                while ($row = mysqli_fetch_array($query)){
                                    $username = $row['studentid'];
                                    $_SESSION['username'] = $username;
                                    $firstname = $row['firstname'];
                                    $surname = $row['surname'];
                                    $coursecode = $row['coursecode'];
                                    $group = $row['group'];
                                    $rank = $row['rank'];
                                    $xp = $row['xp'];
                                    $ap = $row['ap'];
                                    $sp = $row['sp'];

                                    header("Location: Student.php?username=" . $username . "&firstname=" . $firstname . "&surname=" . $surname . "&coursecode=" . $coursecode . "&group=" . $group . "&rank=" . $rank . "&xp=" . $xp . "&ap=" . $ap . "&sp=" . $sp);
                                    exit();
                                    
                                }
                            }
                        }
                        else if ($type == 'lecturer'){
                            $sql = "SELECT * FROM lecturers WHERE lecturerid = '" . $id . "' AND password = '" . $pass ."';";

                            $query = mysqli_query($conn, $sql);

                            if($query){
                                while ($row = mysqli_fetch_array($query)){
                                    $username = $row['lecturerid'];
                                    $_SESSION['username'] = $username;
                                    $firstname = $row['firstname'];
                                    $surname = $row['surname'];
                                    $coursecode = $row['coursecode'];

                                    header("Location: Lecturer.php?username=" . $username . "&firstname=" . $firstname . "&surname=" . $surname . "&coursecode=" . $coursecode);
                                    exit();
                                }     

                            }
                        }
                    }
                    ?>       
                </div>
            </div>
        </body>


        </html>