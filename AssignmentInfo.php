<?php
session_start();
// If the user is not logged in or not a student, redirect to the login page...
if (!isset($_SESSION['loggedin']) || $_SESSION['user_type']!="student") {
	header('Location: login.html');
    exit;
}
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Assignments-SOEN287</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="AssignmentPage.css">
        <link rel="stylesheet" href="InfoStyles.css">
    </head>

    <header>
        <div class="profile">
            <a href="ProfileEdit.php">Profile</a>
        </div>
        <div class="logout">
            <a href="Logout.php"> Logout</a>
        </div>
        <div class="titlelogo">
                <a href ="Home.php">
                    <img src="WebTitle.png"
                        width="200"
                        height="50">
                </a>
        </div>
    </header>

    <div class="nav">
        <div class = "navright">
            <div class="navitem"><a href="CourseInfo.php">Course Info</a></div>
            <div class="navitem"><a href="AssignmentInfo.php">Assignment Details</a></div>
            <div class="navitem"><a href="ViewGradesStudents_update.php">My Grades</a></div>
        </div>
    </div>

  
    <div id = 'assignmentpage'>  
        <div class = "bodytitle">Assignments</div>
        <div class = "bodytext"> 
        <p> 
            As the semester progresses, assignments will be displayed on this website.<br><br>
            <h2 class="assignment-number">Assignment #1 </h2>
            <fieldset class="assignment">
            <ul>
                <li><b>Due Date: </b>Tuesday, November 8, 2022</li>
                <li><b>Weight: </b>6%</li>
            </ul>
            <div class="a1">
            <div class="resumeA1">
            <p>Your assignments will be a running problem to make an online checkers playing site. You will expand what your site can do with each submission. 
                All submissions must be properly validated and bug-free. No late submissions will be accepted. 
                This is an individual assignment.</p>  
            </div> 
            <br>
            <div class="Problem-1">
                <h3><b>Problem 1</b></h3>
            </div>
            <div class="reqs">
               <ul>
                <li><p>A header. This should appear at the top of all pages on your site. It should include a logo, background color and top-menu 
                    headers that will eventually link to important pages on your site. At least one working link should be to a “Rules” page. 
                    Clicking on the logo should take you back to the starting page.</p></li>
                  
                <li><p>A side menu. This should appear on the left side of all your pages. Include contextual navigation links here. 
                    Make links to “View Games” and “Profile”, but they can just link to the starting page for now. 
                    The side menu should consistently appear on the left side, even if menu items change.</p></li>
                  
                <li><p>A content area. This should be the main area where content of the site is displayed. This is where forms would be 
                    filled out, your checker board would be displayed and where any significant text would appear. Include enough content on the starting page, 
                    decorated as you wish, to demonstrate your HTML5 and CSS knowledge.</p></li>
                        
                <li><p>A footer. This should appear at the bottom of all your pages. Give it a distinct background color and include links to a “Privacy Statement” and a “Contact Us” page.</p></li>

                    </ul>
                   
               <p>The Rules page for your site should include the rules to play checkers. Among other things, it should include the following content as exactly as possible, 
                including all formatting (but you may make the font consistent with the rest of your site):</p>     
                
                <p>Pieces have the following properties: </p>

                <ol>
                    <li><p>Regular Pieces:</p></li>
                        <ul>
                            <li><p>Each player starts with 12 <b>regular pieces</b> on each of the black squares of the first three rows on their side.</p></li>
                            <li><p>One player’s <b>regular pieces</b> are black. The other player’s <b>regular pieces</b> are red.</p></li>
                        </ul>
                    <li><p>Kings: </p></li>
                    <ul>
                        <li><p>No players start with <b>kings</b>.</p></li>
                        <li><p>The color of <b>kings</b> are the same as <b>regular pieces</b>, but they generally look bigger or fancier.</p></li>
                        <li><p>Placing a <b>regular piece</b> on the opposing player’s first row turns it into a <b>king</b></p></li>
                    </ul>
                </ol>
                <p>Indicate whether your assignment is to be viewed in either Firefox or Chrome by including an appropriate icon in the footer of your site. While not a direct requirement, please structure 
                    the files for your site in a sensible manner. Create the folders “images”, “css” and “js” to help keep your file structure clean.</p>

            </div>
            <br>


        </div>
        </fieldset>
        <br>
        <br>
        <br>
        

        <h2><b>Assignment #2</b></h2>
        <fieldset>
            <h3><b><i>Coming Soon ...</i></b></h3>
        </fieldset>
        <br>
        <br>
        <br>
        <br>

    <footer>
        <div class="ft">
            <div class="footleft">SOEN 287&emsp;&emsp;Fall 2022</div>
            <a href = "https://www.concordia.ca">
                <img src = "cu_logo.png"
                    alt = "Concordia University Logo"
                    width = "300" 
                    height = "50"
                    text-align = "RIGHT"/>
            </a>
        </div>
    </footer>

</html>