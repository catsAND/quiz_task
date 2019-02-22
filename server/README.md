# Quiz API
## General information
* Base endpoint `https://localhost/api`
* All endpoints return JSON object
* Available method only `GET`, `POST`
* If occurred error return JSON object with `code` <> 200
### Methods
#### GET /quiz/list
Get all quizzes
#### GET /quiz/{id}/list
Get all questions for quiz

`id` -- quiz id
#### POST /quiz/start
Start quiz

POST data:
`name` -- user name
`quiz` -- quiz id
#### POST /quiz/answer
Save user answer

POST data:
`uid` -- user id
`qid` -- question id
`id` -- answer id
#### GET /quiz/result/{id}
Get final result

`id` -- user id
