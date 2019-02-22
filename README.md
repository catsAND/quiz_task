# quiz_task

# **DEMO http://darkpay.io/quiz/dist/**

## Main objective
Your task is to build a simple quiz where user enters his name, picks a test, gives the answers and finally gets the results.
The technologies you have to use are: PHP, MySQL, HTML, CSS, JavaScript. PHP code must be object oriented. As of the design and UX perspective - it’s all up to you and your imagination.
The quiz consists of 3 main views:
* Index page. User must enter his name and choose one of many available tests.
* Quiz view. A question is shown to the user and he must choose one answer. One question can have 2 to n answers.
* Results page.

### Detailed description of views
#### Index page
User must enter his name and choose a test. If the name field is empty or no test has been chosen - an appropriate error message must to be shown.
#### Quiz view
User must choose 1 option. If no answer has been chosen, he can’t continue to the next question.

_Important: the number of answer options can vary from question to question. For example, first question can have 2 answer options, while the second question can have 11 answer options._
You also must create a progressbar which shows the overall progress.
#### Results page
Here you must show the user’s name he provided in the index page and the results - how many questions did the user respond to, and how many of the answers were correct.


### Technical guidelines

#### Design
* It must be responsive
  * If the width of the screen is big enough, the answer options must be shown in 2 columns (like in the screenshot above).
  * If the width of the screen is smaller (for example on mobile devices), the answers options must be shown in 1 column.
* Font size, font color, margins, spacing etc. - it’s all up to you.

#### PHP
* Architecture mus be service-oriented.
* Dependency injection has to be used.
* Include unit tests (PHPUnit) for some of the service methods.
* Code must be object oriented.
* Comment your code.
* PHP frameworks are not allowed.
* Bonus points will be added if you manage to show the quiz dynamically, without full reload of the page.
* Be accurate regarding to the coding style and best coding practices (use a coding standard).

#### Database
* Use MySQL.
* There can be many tests.
* For each test there can be many questions.
* For each question there can be 2 - n answer options. There is no max value.
* Each time the users gives an answer - it must be stored in the database. Which user was it, which test did he take and which answer to which question did he respond.
* You must store the final result. How many questions did the user answer correctly.
* You must think in a way that over time the database will become big. There will be a lot of rows. So you must think about appropriate indexes.
