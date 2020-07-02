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
				$group = $_GET['group'];
				$rank = $_GET['rank'];
				$xp = $_GET['xp'];
				$ap = $_GET['ap'];
				$sp = $_GET['sp'];
	?>

<meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
<title>Student</title>
<link href="css/stylesheet.css" rel="stylesheet" type="text/css" media="screen" /> <!-- Connection to stylesheet -->

<script src="http://code.jquery.com/jquery-3.2.1.js"></script> <!--Connection to Jquery script. -->

<script type="text/javascript">

		function toggle_visibility(id) { //This method is used to toggle between different elements in the main div
			var e = document.getElementById(id);

			if(e.id != document.getElementById('popup-1') || e.id != document.getElementById('popup-2'))
			{
				$('#maindiv > div').each(function(){
					this.style.display = 'none';
				});
				e.style.display = 'block';
			}	
		}

		function popup_visibility(id) { //Toggles the visibility of the various popups. 
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

		function quiz_visibility(value) { //Toggles the visibility of the various popups.
			var e = document.getElementById("quiz-popup");	
			if (e.style.display == 'block') {
				e.style.display = 'none';
				document.getElementById('wholepage').style.opacity = 1;

			}
			else {
				e.style.display = 'block';
				document.getElementById('wholepage').style.opacity = 0.3;
				document.getElementById('quiz-type').value = value;
			}
		}

		function question_toggle(id) { //Toggles the visibility of the various popups. 
			var e = document.getElementById(id);	
			$('#all-questions > div').each(function(){
				this.style.display = 'none';
			});
			e.style.display = 'block';
		}

		function getLocation() { //Acquires the users location coordinates. Used to establish whether they are in class. 
			if (navigator.geolocation) 
			{
				navigator.geolocation.getCurrentPosition(showPosition);
			} 
		}

		function showPosition(position) { //Method used by the getLocation() method that determines the students location compared to some predetermined location (lecture.)
			<!-- The fourth decimal place is worth up to 11 m: it can identify a parcel of land. It is comparable to the typical accuracy of an uncorrected GPS unit with no interference. -->

			var lat = position.coords.latitude + "";
			var long = position.coords.longitude + "";
			if(lat.includes("-33.954") && long.includes("18.498")) 
			{
				document.getElementById("location-confirmation").src = "images/confirmlocation.png";
				document.getElementById('location-message').innerHTML = "Well done for coming to class!";
				document.getElementById("progress-ap").value += 30;
				popup_visibility('popup-1');
			}
			else
			{
				document.getElementById("location-confirmation").src = "images/nolocation.png";
				document.getElementById('location-message').innerHTML = "Nice try! Come to class next time to earn extra XP!";
				popup_visibility('popup-1');
			}

		}

		function logout() //Code use to logout and swap to login page. 
		{	
			window.open ('Login.php','_self',false);
		}

		function clearText(id) //Clears the text in the textboxs. 
		{
			document.getElementById(id).value = "";
		}

		$(function() //Function used to toggle between the navigation bar being open or not
		{
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
		setInterval(loadLog, 1500);	//call the loadLog funtion every 1500 ms
		setInterval(loadForumLog, 1500);
	</script>
</head>

<div id ="all-popups"> <!-- This is where the various popups are located -->

	<div id = "popup-1" class = "popup-position">
		<div id = "popup-wrapper">
			<div id = "popup-container">

				<p id = "location-message" style = "color: white; margin-left: auto; margin-right: auto; text-align: center;"></p>

				<img id = "location-confirmation">
				<a id = "exit-popup" href = "javascript: void(0)" onclick = "popup_visibility('popup-1')">X</a>
			</div>
		</div>
	</div>	

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

<div id = "quiz-popup" class = "popup-position">
	<div id = "popup-wrapper">
		<div id = "popup-container">
			<table> 
				<input id = "quiz-type" type = "button" value = "egergerge" style = "font-size: 37px; color: white; width: 150px;"/>
				<tr>
					<td id = "all-questions">
						<input type="button" id="quiz-one" value="1" onclick = "question_toggle('question-one')"/>
						<input type="button" id="quiz-two" value="2" onclick = "question_toggle('question-two')"/>
						<input type="button" id="quiz-three" value="3" onclick = "question_toggle('question-three')"/>
						<input type="button" id="quiz-four" value="4" onclick = "question_toggle('question-four')"/>
						<input type="button" id="quiz-five" value="5" onclick = "question_toggle('question-five')"/>
					</td>


				</tr>
			</table>


			<div id = "all-questions">
				<?php
					// SQL statement to read data from students table
				$sql = "SELECT * FROM quizzes WHERE quizname = 'ASD 1';" ;

				$query = mysqli_query($conn, $sql);

				if (!$query) {
					die ('SQL Error: ' . mysqli_error($conn));

					
				}
					

				?>
 
				<progress  value="10" max="100" style = "position: relative; bottom: 90px;"></progress> 
				<button style = "margin-left;"> SUBMIT</button>
				<div id = "question-one">

					<label>QUESTION ONE</label>
					<h1> Question: How many days are in a year?</h1>
					<br>
					<button> 23</button>
					<button> 365</button>
					<button> 783</button>
					<button> 123</button>
					
					
				</div>
				
				<div id = "question-two">
					<label>QUESTION TWO</label>
					<h1> Question: What is the time?</h1>
					<br>
					<button> now </button>
					<button> later</button>
					<button> depends</button>
					<button> me </button>
					
				</div>

				<div id = "question-three">
					<label>QUESTION THREE</label>
					<h1> Question: When is my birthday?</h1>
					<br>
					<button> June </button>
					<button> July</button>
					<button> March</button>
					<button> December </button>
					
				</div>
				
				<div id = "question-four">
					<label>QUESTION FOUR</label>
					<h1> Question: Where is God?</h1>
					<br>
					<button> Heaven </button>
					<button> Hell </button>
					<button> Not alive</button>
					<button> Looking </button>
					
				</div>

				<div id = "question-five">
					<label>QUESTION FIVE</label>
					<h1> Question: Are you happy?</h1>
					<br>
					<button> yes </button>
					<button> no </button>
					<button> maybe</button>
					<button> perhaps </button>
					
				</div>
				
			</div>
			

			<a id = "exit-popup" href = "javascript: void(0)" onclick = "popup_visibility('quiz-popup')">X</a>
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

					<div id ="progress">
						<img id = "group-icon" src="images/alchemy-icon.png">
						<label id = "group-name"> <?php echo $group ?> </label>
						<img src="images/experience-points.png" title = "XP" style = "width: 45px; height: 45px; position: absolute; right: 575px; top: 215px; ">
						<img src="images/accuracy-icon.png" title = "AP" style = "width: 45px; height: 45px; position: absolute; right: 575px; top: 265px; ">
						<img src="images/speed-icon.png" title = "SP" style ="width: 35px; height: 35px; position: absolute; top: 320px; right: 575px; ">

						<progress id = "progress-xp" value=<?php echo $xp ?> max="100"></progress>
						<progress id = "progress-ap" value=<?php echo $ap ?> max="100"></progress>
						<progress id = "progress-sp" value=<?php echo $sp ?> max="100"></progress>

						<div id = "rank-box">
							<label id = "rank-label">RANK</label>
							<img id = "noob-medal" src = "images/noob-medal.png" value = "1gergerre">
							<label id = "noob-label">NOOB</label>
						</div>
					</div>
				</td>

				<td>
					<table id = "footer">
						<tr>
							<td>
								<input id = "quiz" title = "quizzes" type = "button" onclick = "toggle_visibility('quizzes')" style="background-image:url(images/quizzes.png);"/>
								<input id = "forum" title = "forums" type = "button" onclick = "toggle_visibility('forums')" style="background-image:url(images/forums.png);"/>
								<input id = "course" title = "coursenotes" type = "button" onclick = "toggle_visibility('course-notes')" style="background-image:url(images/coursenotes.png);"/>
								<input id = "leader" title = "leaderboard" type="button" onclick = "toggle_visibility('leaderboard')" style="background-image:url(images/leaderboard.png);"/>


								<input id = "location" title = "check location" type = "button" onclick = "getLocation()" style="background-image:url(images/checklocation.png);"/>
							</td>
						</tr>	
					</table>
				</td>
			</tr>
		</table>

		<canvas style = "background-image: url(slides/slide-1.jpg); background-size: cover" name = "slide" id = "slideshowbar"></canvas> <!-- Canvas used to store the slideshow -->

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
					<center><label class = "title">GROUP CHAT</label></center>
					<div id="chatbox">
						<?php
						if(file_exists("log.html") && filesize("log.html") > 0)
						{ //if hog.html exists and has some data, echo its contents
							$handle = fopen("log.html", "r");
							$contents = fread($handle, filesize("log.html"));
							fclose($handle);
							echo $contents;
						}						
						else
						{// Create the log.html file with a simple entry message
							$fp = fopen("log.html", 'a+');
							fwrite($fp, "<div class='msgln'><i>Welcome to the chat session.</i><br></div>");
							fclose($fp);			
						}
						?>
					</div>
				</div>

				<div id = "quizzes">
					<center>
						<label class = "title">QUIZZES</label>
						<?php
					// SQL statement to read data from students table
						$sql = "SELECT DISTINCT quizname FROM quizzes WHERE course = '". $coursecode ." ' GROUP BY quizname;";

						$query = mysqli_query($conn, $sql);

						if (!$query) {
							die ('SQL Error: ' . mysqli_error($conn));
						}
						?>

						<table class="data-table">
							<tbody>
								<?php
							// while there are rows in the tables, populate the table with the dat specified in the rows
								while ($row = mysqli_fetch_array($query))
								{
									$value = $row['quizname'];

									echo '<tr><td><input type = "button" value = "' . $value . '" onclick = "quiz_visibility(\'' . $value . '\')"></td></tr>';

								}
								?>
							</tbody>
						</table>		
					</center>
				</div>

				<div id = "forums">
					<center>
						<label class = "title">FORUMS</label>
						<br>
						<div id="forumchatbox">
							<?php
						if(file_exists("forum.html") && filesize("forum.html") > 0){ //if hog.html exists and has some data, echo its contents
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
					<label class = "title">COURSE-NOTES</label>
					<br>
					<br>
					<?php
					// SQL statement to read data from students table
					$sql = 'SELECT * FROM courses';

					$query = mysqli_query($conn, $sql);

					if (!$query) {
						die ('SQL Error: ' . mysqli_error($conn));
					}
					?>
					<table class="data-table">
						<tbody>
							<?php
							// while there are rows in the tables, populate the table with the dat specified in the rows
							while ($row = mysqli_fetch_array($query))
							{
								echo '<tr>
								<td>'.$row['coursecode'].'</td>
								</tr>
								<tr>
								<td>'.$row['lecturerid'].'</td>
								</tr>
								<tr>
								<td>'.$row['courseinfo'].'</td>
								</tr>
								';
							}
							?>
						</tbody>
					</table>
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
							$no 	= 1;
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

					<center><label>RESET STUDENTS AP AND SP - Enter student number: </label><center>
					<input type = "textarea">

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
			</div>

		</div>
		<script type="text/javascript">
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
	</div>
</body>

</html>