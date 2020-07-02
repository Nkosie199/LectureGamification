<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "Gamification");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Escape user inputs for security
$quizname = mysqli_real_escape_string($link, $_REQUEST['quizname']);
$dateset = mysqli_real_escape_string($link, date("M d Y"));
$course = mysqli_real_escape_string($link, $_GET['coursecode']);
$lecturerid = mysqli_real_escape_string($link, $_GET['username']);

// question 1
$question1 = mysqli_real_escape_string($link, $_REQUEST['question1']);
$option1_1 = mysqli_real_escape_string($link, $_REQUEST['option1_1']);
$option2_1 = mysqli_real_escape_string($link, $_REQUEST['option2_1']);
$option3_1 = mysqli_real_escape_string($link, $_REQUEST['option3_1']);
$option4_1 = mysqli_real_escape_string($link, $_REQUEST['option4_1']);
$answer1 = mysqli_real_escape_string($link, $_REQUEST['answer1']);

// question 2
$question2 = mysqli_real_escape_string($link, $_REQUEST['question2']);
$option1_2 = mysqli_real_escape_string($link, $_REQUEST['option1_2']);
$option2_2 = mysqli_real_escape_string($link, $_REQUEST['option2_2']);
$option3_2 = mysqli_real_escape_string($link, $_REQUEST['option3_2']);
$option4_2 = mysqli_real_escape_string($link, $_REQUEST['option4_2']);
$answer2 = mysqli_real_escape_string($link, $_REQUEST['answer2']);

// question 3
$question3 = mysqli_real_escape_string($link, $_REQUEST['question3']);
$option1_3 = mysqli_real_escape_string($link, $_REQUEST['option1_3']);
$option2_3 = mysqli_real_escape_string($link, $_REQUEST['option2_3']);
$option3_3 = mysqli_real_escape_string($link, $_REQUEST['option3_3']);
$option4_3 = mysqli_real_escape_string($link, $_REQUEST['option4_3']);
$answer3 = mysqli_real_escape_string($link, $_REQUEST['answer3']);

// question 4
$question4 = mysqli_real_escape_string($link, $_REQUEST['question4']);
$option1_4 = mysqli_real_escape_string($link, $_REQUEST['option1_4']);
$option2_4 = mysqli_real_escape_string($link, $_REQUEST['option2_4']);
$option3_4 = mysqli_real_escape_string($link, $_REQUEST['option3_4']);
$option4_4 = mysqli_real_escape_string($link, $_REQUEST['option4_4']);
$answer4 = mysqli_real_escape_string($link, $_REQUEST['answer4']);

// question 5
$question5 = mysqli_real_escape_string($link, $_REQUEST['question5']);
$option1_5 = mysqli_real_escape_string($link, $_REQUEST['option1_5']);
$option2_5 = mysqli_real_escape_string($link, $_REQUEST['option2_5']);
$option3_5 = mysqli_real_escape_string($link, $_REQUEST['option3_5']);
$option4_5 = mysqli_real_escape_string($link, $_REQUEST['option4_5']);
$answer5 = mysqli_real_escape_string($link, $_REQUEST['answer5']);
// attempt insert query execution
$sql =
    "INSERT INTO quizzes
(quizname, dateset, course, lecturerid, question, option1, option2, option3, option4, answer) 
VALUES 
('$quizname', '$dateset', '$course', '$lecturerid', '$question1', '$option1_1', '$option2_1', '$option3_1', '$option4_1', '$answer1'),
('$quizname', '$dateset', '$course', '$lecturerid', '$question2', '$option1_2', '$option2_2', '$option3_2', '$option4_2', '$answer2'),
('$quizname', '$dateset', '$course', '$lecturerid', '$question3', '$option1_3', '$option2_3', '$option3_3', '$option4_3', '$answer3'),
('$quizname', '$dateset', '$course', '$lecturerid', '$question4', '$option1_4', '$option2_4', '$option3_4', '$option4_4', '$answer4'),
('$quizname', '$dateset', '$course', '$lecturerid', '$question5', '$option1_5', '$option2_5', '$option3_5', '$option4_5', '$answer5')
";

if(mysqli_query($link, $sql)){
    echo "All Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. <br><br>" . mysqli_error($link);
}

// close connection
mysqli_close($link);

?>