## About Priority task 
Requirements: 
●	Use Git for version control, commit each step in a meaningful way. You can use any public git repository or just make a zip archive including git files and send it over email
●	Back-end should be implemented either with Laravel/Lumen or Symfony
●	Expected outcome 1: PHP app that can solve the problem below
●	Expected outcome 2 (completely optional): Create Frontend to accept the 2 parameters for the app, send to the backend, process it and display the results.
●	You can use any CSS/JS library for this part but handling the main logic with VueJs is a plus
●	The below tasks are not timed but we recommend not to invest more than 4h on them.
●	These tasks are not graded. We want to see how you approach problems and get familiar with your coding style. So feel free to submit any amount of work deliverable on the recommended time frame.

Problem statement:
Create a function which can help users find the best task to work on from the available list (JSON file). The input to the function is ‘hours available at hand now’
and based on this the function should find the best & shortest task that can be completed in
the given available hours (consider the priority and due dates as well). 
For example, after lunch at 1pm, a user will input 4 (hours) so that he/she can find the most critical task that he/she can finish by 5pm. The second input (optional parameter) to the function is ‘hours available tomorrow’ which will help the function to pick a task that he/she can start today but will still be able to complete by tomorrow.
Prioritisation logic: The priority is given in the order of columns due date, priority. So
the objective is to finish (due date) as many critical (priority) tasks as possible in the hours
available the rather just than starting tasks based on priority and leaving them unfinished in
the absence of time.
Users can define today’s date. So all tasks due dates will be related to the user defined day. Tasks that past the due dates shouldn’t be considered anymore.

JSON file structure:
"Id": record identifier
"title": task title
"status": task status (open, in progress or completed)
“due_date": linux timestamp
“priority": 1 as the highest priority to 5 as the lowest
"estimate": integer value representing the amount of hours required to complete

# Steps to run project 
php artisan serve
