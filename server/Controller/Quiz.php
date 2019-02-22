<?php

namespace Api\Controller;

use Api\Controller\ControllerAbstract;
use Symfony\Component\HttpFoundation\JsonResponse;
use Api\Entity\{
    QuizList,
    QuizListTrans,
    QuizQuestions,
    QuizQuestionsTrans,
    QuizAnswers,
    QuizAnswersTrans,
    QuizUsers,
    QuizUsersAnswers
};
use Doctrine\ORM\Query\Expr\Join;

class Quiz extends ControllerAbstract
{
    /**
     * Active status value
     */
    protected const STATUS_ACTIVE = '1';

    /**
     * Get active quiz list
     *
     * @return array
     */
    protected function getActiveQuiz() : array
    {
        $query = $this->em->getRepository(QuizListTrans::class)
            ->createQueryBuilder('ql')
            ->innerJoin(QuizList::class, 'q', JOIN::WITH, 'q.id = ql.id')
            ->where('q.active = :active', 'ql.lang = \'en\'')
            ->setParameter('active', self::STATUS_ACTIVE)
            ->getQuery();

        return $query->getResult();
    }

    /**
     * Route /quiz/list controller
     * Get active quiz list
     *
     * @param array $vars
     *
     * @return JsonResponse
     */
    public function getList(array $vars) : JsonResponse
    {
        $data = [];
        $result = $this->getActiveQuiz();
        foreach ($result as $row) {
            $data[] = [
                'id' => $row->getId()->getId(),
                'text' => $row->getQuiz(),
            ];
        }

        $response = new JsonResponse(['code' => JsonResponse::HTTP_OK, 'data' => $data]);
        return $response->send();
    }

    /**
     * Get quiz by id
     *
     * @param string $id
     *
     * @return QuizList|null
     */
    protected function getActiveQuizById(string $id) : ? QuizList
    {

        return $this->em->getRepository(QuizList::class)
            ->findOneBy(['id' => $id, 'active' => self::STATUS_ACTIVE]);
    }

    /**
     * Get active quiz list
     *
     * @return array
     */
    protected function getActiveQuestionByQuizId(string $id) : array
    {
        $query = $this->em->getRepository(QuizQuestionsTrans::class)
            ->createQueryBuilder('qqt')
            ->innerJoin(QuizQuestions::class, 'qq', JOIN::WITH, 'qq.id = qqt.id')
            ->where('qq.quiz = :id', 'qq.active = :active', 'qqt.lang = \'en\'')
            ->orderBy('qq.weight', 'DESC')
            ->setParameter('id', $id)
            ->setParameter('active', self::STATUS_ACTIVE)
            ->getQuery();

        return $query->getResult();
    }

    /**
     * Get active answers list by question id
     *
     * @return array
     */
    protected function getActiveAnswerByQuestionId(string $id) : array
    {
        $qb = $this->em->getRepository(QuizAnswers::class)
            ->createQueryBuilder('qa');
        $query = $qb->select('qa.id, qat.answer')
            ->innerJoin(QuizAnswersTrans::class, 'qat', JOIN::WITH, $qb->expr()->andX(
                $qb->expr()->eq('qat.id', 'qa.id'),
                $qb->expr()->eq('qat.question', 'qa.question')
            ))
            ->where('qa.question = :id', 'qat.lang = \'en\'', 'qa.active = :active')
            ->orderBy('qat.id', 'ASC')
            ->setParameter('id', $id)
            ->setParameter('active', self::STATUS_ACTIVE)
            ->getQuery();

        return $query->getResult();
    }

    /**
     * Route /quiz/id/list controller
     * Get all questions and answers for quiz
     *
     * @param array $vars
     *
     * @return JsonResponse
     */
    public function getQuestionsAndAnswers(array $vars) : JsonResponse
    {
        $badResponse = new JsonResponse(['code' => JsonResponse::HTTP_NOT_FOUND]);

        $id = $vars['id'];
        $data = [];

        $quizExist = $this->getActiveQuizById($id);
        if (!$quizExist) {
            return $badResponse->send();
        }

        $result = $this->getActiveQuestionByQuizId($id);
        foreach ($result as $row) {
            $answers = [];
            $answerResult = $this->getActiveAnswerByQuestionId($row->getId()->getId());
            if (count($answerResult) === 0) {
                continue;
            }

            foreach ($answerResult as $r) {
                $answers[] = ['id' => $r['id'], 'text' => $r['answer']];
            }

            $data[] = [
                'id' => $row->getId()->getId(),
                'text' => $row->getQuestion(),
                'answer' => $answers
            ];
        }

        if (count($data) === 0) {
            return $badResponse->send();
        }

        $response = new JsonResponse(['code' => JsonResponse::HTTP_OK, 'data' => $data]);
        return $response->send();
    }

    /**
     * Route /quiz/start controller
     * Start quiz
     *
     * @return JsonResponse
     */
    public function start() : JsonResponse
    {
        $vars = $this->request->request->all();
        if (!isset($vars['quiz']) || !isset($vars['name']) || $vars['quiz'] == '' || $vars['name'] == '') {
            $response = new JsonResponse(['code' => JsonResponse::HTTP_BAD_REQUEST]);
            return $response->send();
        }

        $id = $this->getActiveQuizById($vars['quiz']);
        $ip = $this->request->getClientIp();
        $uid = $this->generateId();

        if (!$id) {
            $response = new JsonResponse(['code' => JsonResponse::HTTP_BAD_REQUEST]);
            return $response->send();
        }

        $user = new QuizUsers();
        $user->setId($uid);
        $user->setName($vars['name']);
        $user->setQuiz($id);
        $user->setIp($ip);
        $user->setCreateDate(new \DateTime());
        $user->setFinishDate((new \DateTime('1970-01-01')));

        try {
            $this->em->persist($user);
            $this->em->flush();
        } catch (\Exception $e) {
            $response = new JsonResponse(['code' => JsonResponse::HTTP_BAD_REQUEST]);
            return $response->send();
        }

        $response = new JsonResponse(['code' => JsonResponse::HTTP_OK, 'data' => ['id' => $uid]]);
        return $response->send();
    }

    /**
     * Get quiz by id
     *
     * @param string $id
     *
     * @return QuizUsers|null
     */
    protected function getUserById(string $id) : ? QuizUsers
    {
        return $this->em->getRepository(QuizUsers::class)
            ->findOneBy(['id' => $id]);
    }

    /**
     * Get active question list
     *
     * @param string $id
     *
     * @return QuizQuestions|null
     */
    protected function getActiveQuestionById(string $id) : ? QuizQuestions
    {
        return $this->em->getRepository(QuizQuestions::class)
            ->findOneBy(['id' => $id, 'active' => self::STATUS_ACTIVE]);
    }

    /**
     * Get active answer by id
     *
     * @param string $id
     * @param string $qid
     *
     * @return QuizAnswers|null
     */
    protected function getActiveAnswerById(string $id, string $qid) : ? QuizAnswers
    {
        return $this->em->getRepository(QuizAnswers::class)
            ->findOneBy(['id' => $id, 'question' => $qid, 'active' => self::STATUS_ACTIVE]);
    }

    /**
     * Route /quiz/answer controller
     * Save answer
     *
     * @return JsonResponse
     */
    public function saveAnswer() : JsonResponse
    {
        $badResponse = new JsonResponse(['code' => JsonResponse::HTTP_BAD_REQUEST]);

        $vars = $this->request->request->all();

        $user = $this->getUserById($vars['uid']);
        if (!$user) {
            return $badResponse->send();
        }

        $question = $this->getActiveQuestionById($vars['qid']);
        if (!$question) {
            return $badResponse->send();
        }

        $answer = $this->getActiveAnswerById($vars['id'], $vars['qid']);
        if (!$answer) {
            return $badResponse->send();
        }

        $userAnswer = new QuizUsersAnswers();
        $userAnswer->setUserId($user->getId());
        $userAnswer->setQuestionId($question->getId());
        $userAnswer->setAnswerId($answer->getId());
        $userAnswer->setAnswerDate(new \DateTime());

        try {
            $this->em->persist($userAnswer);
            $this->em->flush();
        } catch (\Exception $e) {
            return $badResponse->send();
        }

        $response = new JsonResponse(['code' => JsonResponse::HTTP_OK]);
        return $response->send();
    }

    /**
     * Get question count by quiz id
     *
     * @param QuizList $quiz
     *
     * @return integer
     */
    protected function getQuestionCountByQuiz(QuizList $quiz) : int
    {
        return $this->em->getRepository(QuizQuestions::class)
            ->count(['quiz' => $quiz->getId(), 'active' => self::STATUS_ACTIVE]);
    }

    /**
     * Get all answered question by user id
     *
     * @param QuizUsers $user
     *
     * @return array
     */
    protected function getAnsweredQuestionByUser(QuizUsers $user) : array
    {
        return $this->em->getRepository(QuizUsersAnswers::class)
            ->findBy(['userId' => $user->getId()]);
    }

    /**
     * Check if answer is correct
     *
     * @param integer $id
     * @param string $questionId
     *
     * @return boolean
     */
    protected function checkIfAnswerCorrect(int $id, string $questionId) : bool
    {
        return $this->em->getRepository(QuizAnswers::class)
            ->count(['id' => $id, 'question' => $questionId, 'active' => self::STATUS_ACTIVE, 'correct' => 1]) > 0;
    }

    /**
     * Route /quiz/result controller
     * Get result for quiz
     *
     * @param array $vars
     *
     * @return JsonResponse
     */
    public function getResult(array $vars) : JsonResponse
    {
        $badResponse = new JsonResponse(['code' => JsonResponse::HTTP_NOT_FOUND]);

        $user = $this->getUserById($vars['uid']);
        if (!$user) {
            return $badResponse->send();
        }

        $questionCount = $this->getQuestionCountByQuiz($user->getQuiz());

        $defaultDate = new \DateTime('1970-01-02');
        if ($user->getFinishDate() > $defaultDate) {
            $response = new JsonResponse(['code' => JsonResponse::HTTP_OK, 'data' => [
                'name' => $user->getName(),
                'question' => $questionCount,
                'correct' => $user->getCorrected(),
            ]]);
        }

        $answered = $this->getAnsweredQuestionByUser($user);
        if (count($answered) !== $questionCount) {
            return $badResponse->send();
        }

        $qty = 0;
        foreach ($answered as $row) {
            $checkCorrect = $this->checkIfAnswerCorrect($row->getAnswerId(), $row->getQuestionId());
            if ($checkCorrect) {
                $qty += 1;
            }
        }

        $user->setCorrected($qty);
        $user->setFinishDate(new \DateTime());

        try {
            $this->em->merge($user);
            $this->em->flush();
        } catch (\Exception $e) {
            $response = new JsonResponse(['code' => JsonResponse::HTTP_BAD_REQUEST]);
            return $response->send();
        }

        $response = new JsonResponse(['code' => JsonResponse::HTTP_OK, 'data' => [
            'name' => $user->getName(),
            'question' => $questionCount,
            'correct' => $qty,
        ]]);
        return $response->send();
    }
}
