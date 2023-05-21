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
        <title>Course Info-SOEN287</title>
        <link rel="stylesheet" href="styles.css">
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

    <div class="sidemenu">
        <a href="#GeneralInfo">General</a>
        <a href="#Schedule">Schedule</a>
        <a href="#passingGrade">Evaluation</a>
        <a href="#syllabus">Syllabus</a>
        <a href="#support">Academic Support</a>
      </div>
      

  
    <div id = 'GeneralInfo'>  
        <div class = "bodytitle">General Course Information</div>
        <div class = "bodytext"> 
        <p> 
            This is an introductory course to Web programming.<br><br>
            <b>Required Text Book</b> <br>
            <i>Programming the World Wide Web by Robert W. Sebesta, 8th edition, Pearson, 2014.</i><br><br>
            The book is available in 2 formats:
            <ul>
                <li>Hard Copy: ISBN: 978-0-13-377598-3</li>
                <li>Digital Copy: ISBN: 978-0-13-377612-6</li>
            </ul>
            <b>Course Topics</b><br>
            The course will include discussions and explanations of the following topics: 
                <ul>
                    <li>Internet architecture and protocols</li>
                    <li>Web applications through clients and servers</li>
                    <li>Markup languages</li>
                    <li>Client-side programming using scripting languages</li>
                    <li>Static website contents and dynamic page generation through server-side programming</li>
                    <li>Preserving state in Web applications</li>
                </ul>
            Please notice that Web programming and Web application is a very wide domain.<br>
            Many techniques are used to build a complex online business system. <br>
            The following topics are NOT covered in this course, but in some other courses: 
            <ul>
                <li>J2EE, JSP, Servlet, (SOEN 387)</li>
                <li>Web services (SOEN 487)</li>
                <li>Security (SOEN 321)</li>
                <li>Enterprise level systems and applications (SOEN 387, SOEN 487)</li>
                <li>Database and SQL (COMP 353)</li>
            </ul>
            <br>
        </p>
        </div>
    </div>
    
    <div id='Schedule'>
        <div class = "bodytitle">Tentative Course Schedule</div>
        <div class = "bodytext">
            <p>

            </p>
            
            <table id ='courseSchedule'>
                <tr>
                    <th>Week</th>
                    <th>Chapter</th>
                    <th>Topics</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>1, 2</td>
                    <td>Fundamentals, HTML</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>1, 2</td>
                    <td>Fundamentals, HTML</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>2, 3</td>
                    <td>HTML, CSS</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>3, 4</td>
                    <td>CSS, JavaScript</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>4, 5</td>
                    <td>JavaScript</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>5</td>
                    <td>JavaScript</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>6</td>
                    <td>Dynamic HTML with JavaScript</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>6</td>
                    <td>Dynamic HTML with JavaScript</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>6</td>
                    <td>Dynamic HTML with JavaScript</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>9</td>
                    <td>PHP: syntax</td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>9</td>
                    <td>PHP: Form handling</td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>9</td>
                    <td>PHP: patterns, File I/O, cookies</td>
                </tr>
                <tr>
                    <td>13</td>
                    <td>9</td>
                    <td>PHP: sessions</td>
                </tr>
            </table>
            <br>
        </div>
    </div>

    <div id='passingGrade'>
        <br>
        <div class="bodytitle">Evaluation Scheme</div>
        <div class="bodytext">
            <p>
                Important information regarding course evaluation and passing grades:
                <ol>
                    <li>In order to pass the course, you must <b>pass the term test and the final exam</b> 
                        by getting <i>over 50%</i> of the marks in each one of them, regardless of your grade in other required components.</li>
                    <li>There is no standard relationship between percentages and letter grades assigned.</li>
                    <li>Although we encourage discussion of the project among students and groups, you should be 
                        aware of the University regulations concerning plagiarism described in 16.3.13 of the 
                        undergraduate Calendar.All students should become familiar with <a href = "https://www.concordia.ca/conduct/academic-integrity.html">the University’s Code of 
                            Conduct</a>.
                        In cases where cheating or plagiarism is suspected, the case will be forwarded directly to the 
                        appropriate university office for consideration. Please do not assume that you get <i>second chances</i>
                        when it comes to cheating. Once is often enough to damage your academic career.</li>
                </ol>
            </p>
        </div>
    </div>

    <div id='syllabus'>  
        <div class="bodytitle">Syllabus</div>  
        <div class = "bodytext">
            <p>Access the complete syllabus <a href = "SOEN 287 - Course Outline - Fall 2022.pdf" download>here</a></p>
        </div>
    </div>

    <div id='support'>
        <div class="bodytitle">Academic Support</div>
        <div class="bodytext">
                <h3>Speical Needs</h3>
                <p>
                    If you have any special needs, please contact your instructor to arrange a time to discuss the situation.
                </p>
                <h3>Academic Support</h3>
                <p>
                    If you are experiencing difficulties that are affecting your studies, Concordia University offers many on campus free of charge services.<br> 
                    Please visit the <a href = "http://www.concordia.ca/students/success.html">Student Success Centre Website</a> to find the complete list of these resources.
                </p>
        </div>
    </div>

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
