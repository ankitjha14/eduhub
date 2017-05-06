Technologies Used:-pk
	php html css json


How to run the Api:

1. Extract the file 
2. Download Xampp with php 5.x;
3. Install and run the xampp server
4. put the extracted file in C://xampp/htdocs  folder.
5. Run on localhose (url http://localhost/navigus)

6. first go to http://localhost/navigus/admin insert some data to use the api like professors, course, and the plan by which the course are arranged in semester and 
	branch.
7. after that signup at http://localhost/navigus/ as a professor or student

                     OR
					 
   Goto this link https://navigotest.000webhostapp.com/navigus/
   
   
   
 How I approached the problem:
 
Assumption
1. I assumed that there are one teacher for one course and one teacher can teach many course;
2. and assumed that the course are fixed for a semester with particular branch(cs/it).

After Assuming these data i approach the problem
I made 9 tables to store the information and perform the task
1.) student - to store the info of student.
2.) professor - to store the info of professor.
3.) branch
4.) course
5.) plan 
6.) tutorial
7.} solution
9.) Lecture slide
8.) Review

Reviewing/Grading algorithm:
$current review (given by user);
$old Avg. review 
$NO. of old review 
$New Avg. review  = ()($old Avg. review * $NO. of old review ) + $current review)/$NO. of old review  + 1;
then i check if (abs($New Avg. review - $old Avg. review ) < 5*1.1^(2-$new_no)) i add his review else reject his review.
in such manner no fake review will effect the average review


How to express student to give reviews?
i simply count the noof reviews and promisse them to give some surprise at 100 reviews :P


I have not given much attention to vulnerability of website as the time was very less, however i have tried very hard to take care of different errors where necessary.

Kindly contact me if you are facing any problem.
Email- ankitjha14@gmail.com
Phone-8588984781
