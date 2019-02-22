import API_URL from '../config';

function get(method) {
  return new Promise((resolve, reject) => {
    fetch(API_URL + method)
      .then(r => r.json())
      .then((r) => {
        if (r.code !== 200) {
          return reject(`Server returned ${r.code} code`);
        }
        return resolve(r);
      })
      .catch(e => reject(e));
  });
}
function post(method, data) {
  const formData = new FormData();
  for (const key of Object.keys(data)) {
    formData.append(key, data[key]);
  }

  return new Promise((resolve, reject) => {
    fetch(API_URL + method, {
      method: 'POST',
      body: formData,
    })
      .then(r => r.json())
      .then(r => resolve(r))
      .catch(e => reject(e));
  });
}

async function getQuizList() {
  return await get('/quiz/list');
}

async function startQuiz(name, quiz) {
  const response = await post('/quiz/start', {
    name,
    quiz,
  });
  return response.data.id;
}

async function getQuestionByQuizId(id) {
  return await get(`/quiz/${id}/list`);
}

async function saveAnswer(uid, questionId, answerId) {
  const response = await post('/quiz/answer', {
    uid,
    qid: questionId,
    id: answerId,
  });
  return response.code === 200;
}

async function getResult(id) {
  return await get(`/quiz/result/${id}`);
}

export default {
  getQuizList,
  startQuiz,
  getQuestionByQuizId,
  saveAnswer,
  getResult,
};
