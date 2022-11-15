1. Download and install XAMPP ver 7.4.30 for windows
2. Open XAMPP and start Apache and MySQL
3. Move CSA_v2.0 to xampp/htdocs/
4. Visit http://localhost/phpmyadmin/ and create a new database named csa_db
5. Open csa_db and import local database from CSA_v2.0/database/csa_db.sql
6. Visit http://localhost/CSA_v2.0/public/index.php
7. Use any of the credentials below to log in or register a new account

note: 
 - in order to successfully register a student or a counselor account, make sure to input a valid institution code 
 - institution code is generated after a successfull institution registration
 - institution codes from existing institution accounts can be found in the institution table in your database

default password for all acounts: admin123

student account id number:
1. 3284010490
2. 599351617
3. 2040514017

counselor account id number:
1. 1107319787
2. 82573824
3. 3569180649

institution account id number:
1. 2781083719
2. 1183238246
3. 3224034315

Student Account
1. After logging in, the user will be redirected to the student landing page by default
2. The navigation bar is located on the right side where you can see the tabs where the user can navigate to the calendar, profile, and activity logs page
3. The calendar page is where the user can set an appointment
4. Set an appointment by simply filling in the schedule form on the left side of the calendar page. Use the calendar as reference to see which date and time is available
5. The profile page is where the user can view his/her personal details and th activities log page is where the user can all his/her past, present, and future appointments

note:
 - an error message will pop up upon form submission if there is a conflict of schedule between set appointments among students or when there are no available counselors at the chosen date and time or if the meeting link provided is invalid
 - try clicking on the schedules found on the calendar dates, if the schedule is made by the user, a modal will pop up showing the schedule in full detail, if the schedule is set by another user, the modal will not pop up
 - all appointment that has gone past its due date will automatically be deleted after one hour
 - the system automatically chooses which counselor is available at the chose schedule and an error message will pop up if there are no one available 
 - users may opt to edit or delete currently set appointments
 - users may opt to save a pdf copy of the activities logs

Counselor Account
1. Similar to students, counselors can also set an appointment but they need to indicate a specific student using their id number as reference
2. In addition, the counselor page also has an appointment page where they can view the details of their scheduled appointments in table a format

note:
 - counselors may only select on the options provided in the drop down content on the student id input
 - the options available for the student id input are exclusive only to the students who are registered on the same institution ar the the counselor in reference to the institution's institution code









Marc Lloyd Runas