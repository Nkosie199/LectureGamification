<!DOCTYPE html>

<html lang = "en">

<head>
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

			if(!isset($_GET["username"])){
				//header("Location: Login.php");
				//exit();
			}	
			$username = $_GET['username'];
			$firstname = $_GET['firstname'];
			$surname = $_GET['surname'];
			$coursecode = $_GET['coursecode'];
?>

	<meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
	<title>Lecturer</title>
	<link href="css/lecstylesheet.css" rel="stylesheet" type="text/css" media="screen" />
	<script src="http://code.jquery.com/jquery-3.2.1.js"></script>

	<script type="text/javascript">

		function toggle_visibility(id) {
			var e = document.getElementById(id);

			if(e.id != document.getElementById('popup-1') || e.id != document.getElementById('popup-2'))
			{
				$('#maindiv > div').each(function(){
					this.style.display = 'none';
				});
				e.style.display = 'block';
			}	
		}

		function toggle_questions(id) {
			var e = document.getElementById(id);


			$('#questions > div').each(function(){
				this.style.display = 'none';
			});
			e.style.display = 'block';

		}

		function popup_visibility(id) {
			var e = document.getElementById(id);	
			if (e.style.display == 'block') {
				e.style.display = 'none';
				document.getElementById('wholepage').style.opacity = 1;
			}
			else {
				e.style.display = 'block';
				document.getElementById('wholepage').style.opacity = 0.3;
			}
		}

		function logout(){
			window.open ('Login.php','_self',false);
		}

		function clearText(id){
			document.getElementById(id).value = "";
		}

		$(function(){
			$('.nav-toggle').click( function(e){
				e.preventDefault();
				$('.nav-side').toggleClass('nav-open');
			});
		});

			// jQuery Document, these are functions pending user interaction
		//If user submits the form
		$("#submitmsg").click(function()
		{ //if user clicks on send	
			var clientmsg = $("#usermsg").val(); //get the value of the users message
			$.post("post.php", {text: clientmsg}); //post the text to post.php				
			$("#usermsg").attr("value", ""); //set usermsg attribute to 'value' and it's value to '' 
			clearText('usermsg');
			return false;
		});

		$("#submitmsg2forum").click(function()
		{ //if user clicks on send	
			var clientmsg = $("#usermsg2forum").val(); //get the value of the users message
			$.post("post2forum.php", {text: clientmsg}); //post the text to post.php				
			$("#usermsg2forum").attr("value", ""); //set usermsg attribute to 'value' and it's value to '' 
			clearText('usermsg2forum');
			return false;
		});
			//Load the file containing the chat log
			function loadLog()
			{		

				var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
				$.ajax({
					url: "log.html",
					cache: false,
					success: function(html){		
						$("#chatbox").html(html); //Insert chat log into the #chatbox div				
						//Auto-scroll			
						var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
						if(newscrollHeight > oldscrollHeight)
						{
							$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
						}				
					},
				});
			}
			function loadForumLog()
			{		
				var oldscrollHeight = $("#forumchatbox").attr("scrollHeight") - 20; //Scroll height before the request
				$.ajax({
					url: "forum.html",
					cache: false,
					success: function(html){		
						$("#forumchatbox").html(html); //Insert chat log into the #chatbox div				
						//Auto-scroll			
						var newscrollHeight = $("#forumchatbox").attr("scrollHeight") - 20; //Scroll height after the request
						if(newscrollHeight > oldscrollHeight)
						{
							$("#forumchatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
						}				
					},
				});
			}
			setInterval (loadLog, 1500);	//call the loadLog funtion every 1500 ms
			setInterval(loadForumLog, 1500);
		</script>
	</head>

	<div id ="all-popups">
		<div id = "popup-2" class = "popup-position">
			<div id = "popup-wrapper">
				<div id = "popup-container">
					<p style = "color: white; margin-left: auto; margin-right: auto; text-align: center;">Are you sure you want to logout?</p>
					<table>
						<tr>
							<td>

								<img id = "confirm" src = "images/confirm-icon.png" title = "confirm" onclick = "logout()">
								<img id = "cancel" src = "images/cancel-icon.png" title = "cancel" onclick = "popup_visibility('popup-2')">
							</td>
						</tr>
					</table>
				</div>
			</div>	
		</div>
	</div>

	<body id = "body">
		<div id = "wholepage">
			<div id = "logout" onClick="popup_visibility('popup-2')"></div>

			<nav class = "nav-side">
				<a href = "" class = "nav-toggle" style = "padding-top:16px"> </a>
				<div id="chatinput">
					<form name="message" action="">
						<!-- <input name="usermsg" type="text" id="usermsg"> -->
						<textarea name="usermsg" id="usermsg" rows="20"></textarea>
						<input name="submitmsg" type="submit"  id="submitmsg" value="">
					</form>
				</div>
			</nav>

			<table>
				<tr>
					<td>
						<div id = profilebar>
							<img id = "profilepic" src="images/man-icon.png"  onclick = "toggle_visibility('home')">
							<label id = "profilename"> <?php echo $firstname . " " . $surname ?> </label>
							<label id = "coursecode"> <?php echo $coursecode ?> </label>
						</div> 

						<table id = "footer">
							<tr>
								<td>
									<input id = "quiz" title = "quizzes" type = "button" onclick = "toggle_visibility('quizzes')" style="background-image:url(images/quizzes.png);"/>
									<input id = "forum" title = "forums" type = "button" onclick = "toggle_visibility('forums')" style="background-image:url(images/forums.png);"/>
									<input id = "course" title = "coursenotes" type = "button" onclick = "toggle_visibility('course-notes')" style="background-image:url(images/coursenotes.png);"/>
									<input id = "leader" title = "leaderboard" type="button" onclick = "toggle_visibility('leaderboard')" style="background-image:url(images/leaderboard.png);"/>
								</td>
							</tr>	
						</table>
					</td>
				</tr>
			</table>

			<canvas style = "background-image: url(slides/slide-1.jpg); background-size: cover" name = "slide" id = "slideshowbar"></canvas>

			<script type = "text/javascript">
				var step = 1
				function slideshowbar()
				{
					var element = document.getElementById('slideshowbar');
					element.style.backgroundImage = "url(slides/slide-" + step + ".jpg)";
					if(step < 4) step++
						else step = 1
							setTimeout("slideshowbar()", 3500)
					}
					slideshowbar()
				</script>

				<div id=maindiv>
					<div id = "home">
						<center>
							<label class = "title">GROUP CHAT</label>
							<div id="chatbox">
								<?php
								if(file_exists("log.html") && filesize("log.html") > 0)
						    { //if hog.html exists and has some data, echo its contents
						    	$handle = fopen("log.html", "r");
						    	$contents = fread($handle, filesize("log.html"));
						    	fclose($handle);
						    	echo $contents;
						    }else
							{// Create the log.html file with a simple entry message
								$fp = fopen("log.html", 'a+');
								fwrite($fp, "<div class='msgln'><i>User has joined the chat session.</i><br></div>");
								fclose($fp);			
							}
							?>
						</div>
					</center>
				</div>

				<div id = "quizzes">
					<center><label><strong>Set Quiz</strong></label></center>
					<br>
					<br>
					<form id = "form" action= "<?php echo 'Location: insert2quizzes.php?username=' . $username . '&coursecode=' . $coursecode?>" method="post">
						<div>
							<label ><strong>Quiz Title</strong></label>
							<textarea id="message" name="quizname" rows="1" cols="50"></textarea>
						</div>
						<br>
						<br>
						<label><strong>Question No</strong></label>
						<table>
							<tr>
								<td>
									<input type="button" onclick = "toggle_questions('question-one')" value = "1">
									<input type="button" onclick = "toggle_questions('question-two')" value = "2">
									<input type="button" onclick = "toggle_questions('question-three')" value = "3">
									<input type="button" onclick = "toggle_questions('question-four')" value = "4">
									<input type="button" onclick = "toggle_questions('question-five')" value = "5">
								</td>
							</tr>
						</table>
						<div id = "questions">	

							<div id = "question-one">
								<div>
									<label ><strong>Question</strong></label>
									<textarea id="message" name="question1" rows="2" cols="20"></textarea>
								</div>
								<br>
								<br>
								<div>
									<label ><strong>Option 1</strong></label>
									<textarea id="message" name="option1_1" rows="1" cols="20"></textarea>
								</div>					
								<br>
								<br>
								<div>
									<label><strong>Option 2</strong></label>
									<textarea id="message" name="option2_1" rows="1" cols="20"></textarea>
								</div>
								<br>
								<br>
								<div>
									<label><strong>Option 3</strong></label>
									<textarea id="message" name="option3_1" rows="1" cols="20"></textarea>
								</div>	
								<br>
								<br>
								<div>
									<label><strong>Option 4</strong></label>
									<textarea id="message" name="option4_1" rows="1" cols="20"></textarea>
								</div>
								<br>
								<br>
								<div>
									<label><strong>Answer</strong></label>
									<textarea id="message" name="answer1" rows="1" cols="20"></textarea>
								</div>
							</div>
							<div id = "question-two">
								<div>
									<label ><strong>Question</strong></label>
									<textarea id="message" name="question2" rows="2" cols="20"></textarea>
								</div>
								<br>
								<br>
								<div>
									<label ><strong>Option 1</strong></label>
									<textarea id="message" name="option1_2" rows="1" cols="20"></textarea>
								</div>
								<br>
								<br>
								<div>
									<label><strong>Option 2</strong></label>
									<textarea id="message" name="option2_2" rows="1" cols="20"></textarea>
								</div>
								<br>
								<br>
								<div>
									<label><strong>Option 3</strong></label>
									<textarea id="message" name="option3_2" rows="1" cols="20"></textarea>
								</div>
								<br>
								<br>
								<div>
									<label><strong>Option 4</strong></label>
									<textarea id="message" name="option4_2" rows="1" cols="20"></textarea>
								</div>
								<br>
								<br>
								<div>
									<label><strong>Answer</strong></label>
									<textarea id="message" name="answer2" rows="1" cols="20"></textarea>
								</div>
							</div>
							<div id = "question-three">
								<div>
									<label ><strong>Question</strong></label>
									<textarea id="message" name="question3" rows="2" cols="20"></textarea>
								</div>
								<br>
								<br>
								<div>
									<label ><strong>Option 1</strong></label>
									<textarea id="message" name="option1_3" rows="1" cols="20"></textarea>
								</div>
								<br>
								<br>
								<div>
									<label><strong>Option 2</strong></label>
									<textarea id="message" name="option2_3" rows="1" cols="20"></textarea>
								</div>
								<br>
								<br>
								<div>
									<label><strong>Option 3</strong></label>
									<textarea id="message" name="option3_3" rows="1" cols="20"></textarea>
								</div>
								<br>
								<br>
								<div>
									<label><strong>Option 4</strong></label>
									<textarea id="message" name="option4_3" rows="1" cols="20"></textarea>
								</div>
								<br>
								<br>
								<div>
									<label><strong>Answer</strong></label>
									<textarea id="message" name="answer3" rows="1" cols="20"></textarea>
								</div>
							</div>
							<div id = "question-four">
								<div>
									<label ><strong>Question</strong></label>
									<textarea id="message" name="question4" rows="2" cols="20"></textarea>
								</div>
								<br>
								<br>
								<div>
									<label ><strong>Option 1</strong></label>
									<textarea id="message" name="option1_4" rows="1" cols="20"></textarea>
								</div>
								<br>
								<br>
								<div>
									<label><strong>Option 2</strong></label>
									<textarea id="message" name="option2_4" rows="1" cols="20"></textarea>
								</div>
								<br>
								<br>
								<div>
									<label><strong>Option 3</strong></label>
									<textarea id="message" name="option3_4" rows="1" cols="20"></textarea>
								</div>
								<br>
								<br>
								<div>
									<label><strong>Option 4</strong></label>
									<textarea id="message" name="option4_4" rows="1" cols="20"></textarea>
								</div>
								<br>
								<br>
								<div>
									<label><strong>Answer</strong></label>
									<textarea id="message" name="answer4" rows="1" cols="20"></textarea>
								</div>
							</div>
							<div id = "question-five">
								<div>
									<label ><strong>Question</strong></label>
									<textarea id="message" name="question5" rows="2" cols="20"></textarea>
								</div>
								<br>
								<br>
								<div>
									<label ><strong>Option 1</strong></label>
									<textarea id="message" name="option1_5" rows="1" cols="20"></textarea>
								</div>
								<br>
								<br>
								<div>
									<label><strong>Option 2</strong></label>
									<textarea id="message" name="option2_5" rows="1" cols="20"></textarea>
								</div>
								<br>
								<br>
								<div>
									<label><strong>Option 3</strong></label>
									<textarea id="message" name="option3_5" rows="1" cols="20"></textarea>
								</div>
								<br>
								<br>
								<div>
									<label><strong>Option 4</strong></label>
									<textarea id="message" name="option4_5" rows="1" cols="20"></textarea>
								</div>
								<br>
								<br>
								<div>
									<label><strong>Answer</strong></label>
									<textarea id="message" name="answer5" rows="1" cols="20"></textarea>
								</div>
							</div>

						</div>
						<br>
						<br>
						<div>
							<button id ="submit" type="submit"">Submit Quiz</button>
						</div>
						<div id = "submit-reset">
							<button id ="reset" type="button" onclick="eraseText()">Reset</button>
						</div>

					</form>
				</div>

				<div id = "forums">
					<center>
						<label class = "title">FORUMS</label>
						<br>
						<div id="forumchatbox">
							<?php
							if(file_exists("forum.html") && filesize("forum.html") > 0)
							{ //if hog.html exists and has some data, echo its contents
								$handle = fopen("forum.html", "r");
								$contents = fread($handle, filesize("forum.html"));
								fclose($handle);
								echo $contents;
							}						
							else{ // Create the forum.html file
								$fp = fopen("forum.html", 'a+');
								fclose($fp);			
							}
							?>
						</div>
						<br>
						<div id="chatinput">
							<form name="message" action="">
								<!-- <input name="usermsg" type="text" id="usermsg"> -->
								<textarea name="usermsg2forum" id="usermsg2forum" rows="5"></textarea>
								<br>
								<input name="submitmsg2forum" type="submit" id="submitmsg2forum" value="" onClick="clearform();"/>
							</form>
						</div>
					</center>
				</div>

				<div id = "course-notes">
					<center>
						<label class = "title" style = "margin-top: 20px;">SET COURSE NOTES</label>
						<form id = "inner" action="insert2course.php" method="post">
							<label>Course Code:</label>
							<div id = "set-course">
								<textarea id= "message" name="coursecode" rows="1" cols="10" autofocus style = "margin-top: 20px;"></textarea>
							</div>

							<label>Lecture ID:</label>
							<div id = "set-lecid">
								<textarea id= "message" name="lecturerid" rows="1" cols="10" autofocus style = "margin-top: 20px;"></textarea>
							</div>

							<label>Course Info:</label>
							<div id = "set-courseinfo">
								<textarea id= "message" name="courseinfo" rows="20" cols="50" autofocus style = "height: 350px; margin-top: 20px;" ></textarea>
							</div>
							<div id = "submit-reset">
								<button id ="submit" type="submit">Submit Course Notes</button>	
							</div>
							<div id = "submit-reset">
								<button id ="reset" type="button" onclick="eraseText()">Reset</button>	
							</div>



						</form>
					</center>
				</div>

				<div id = "leaderboard" style = "color: white;">
					<center>
						<label class = "title">LEADERBOARD</label>
						<?php
						// SQL statement to read data from students table
						$sql = 'SELECT * FROM students ORDER BY xp DESC';

						$query = mysqli_query($conn, $sql);

						if (!$query) {
							die ('SQL Error: ' . mysqli_error($conn));
						}
						?>

						<table class="data-table">

							<caption class="title">Student Leaderboard</caption>
							<thead>
								<tr>
									<th>NO</th>
									<th>StudentID</th>
									<th>Firstname</th>
									<th>Surname</th>
									<th id = "group">Group</th>
									<th>XP</th>
								</tr>
							</thead>

							<tbody>
								<?php
								// while there are rows in the tables, populate the table with the dat specified in the rows
								$no = 1;
								while ($row = mysqli_fetch_array($query))
								{
									echo '<tr>
									<td>'.$no.'</td>
									<td>'.$row['studentid'].'</td>
									<td>'.$row['firstname'].'</td>
									<td>'.$row['surname'].'</td>
									<td id = "group-result">'.$row['group'].'</td>
									<td>'.$row['xp'].'</td>
									</tr>';
									$no++;
								}
								?>
							</tbody>	
						</table>



						<?php
						// SQL statement to read data from groups table
						$sql = 'SELECT * 
						FROM groups ORDER BY points DESC';
						$query = mysqli_query($conn, $sql);

						if (!$query) {
							die ('SQL Error: ' . mysqli_error($conn));
						}
						?>
						<br>

						<table class="data-table">
							<caption class="title">Group Leaderboard</caption>
							<br>
							<br>
							<thead>
								<tr>
									<th>NO</th>
									<th>GroupName</th>
									<th>Course</th>
									<th>Points</th>
								</tr>
							</thead>

							<tbody>
								<?php
								// while there are rows in the tables, populate the table with the dat specified in the rows
								$no 	= 1;
								while ($row = mysqli_fetch_array($query))
								{
									echo '<tr>
									<td>'.$no.'</td>
									<td>'.$row['groupname'].'</td>
									<td>'.$row['course'].'</td>
									<td>'.$row['points'].'</td>
									</tr>';
									$no++;
								}
								?>
							</tbody>
						</table>
					</center>

					<form action = "" method = "POST">

						<center><label>RESET STUDENTS AP AND SP - Enter student number: </label><center>
							<textarea type="text" name="studentid-delete"></textarea>
							<input type="submit" value="UPDATE">

					<?php 

						if(isset($_GET['studentid_delete'])){
							$student = $_GET['studentid_delete'];
							echo $student;
							$sql = "UPDATE students SET ap = 0, sp = 0 WHERE studentid ='" . $student . "';";
							echo $sql;
							$query = mysqli_query($conn, $sql);

							if(mysqli_query($conn, $sql)){
								echo "Records added successfully.";
							} else{
								echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
							} 		
							// close connection
							mysqli_close($conn);

						}

					?>

					</form>

					
				</div>
			</div>
		</body>

		</html>