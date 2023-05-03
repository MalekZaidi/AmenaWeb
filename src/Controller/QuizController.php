<?php

namespace App\Controller;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class QuizController extends AbstractController
{
    #[Route('/quiz', name: 'app_quiz')]
    public function index(SessionInterface $session)
    {
        // Initialisation du score
        $score = $session->get('score', 0);
        $submitted = $session->get('submitted', false);

        if (!$submitted) {
            $client = new Client([
                'base_uri' => 'https://opentdb.com',
                'timeout'  => 2.0,
            ]);

            $response = $client->get('/api.php', [
                'query' => [
                    'amount' => 10,
                    'type' => 'multiple',
                    'encode' => 'url3986',
                    'language' => 'fr'
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            $questions = array();
            foreach ($data['results'] as $result) {
                $question = array(
                    'question' => u(urldecode($result['question'])),
                    'correct_answer' => u(urldecode($result['correct_answer'])),
                    'incorrect_answers' => array_map('urldecode', $result['incorrect_answers'])
                );
                $question['all_answers'] = $this->shuffleArray($question['incorrect_answers'], $question['correct_answer']);
                $questions[] = $question;
            }

            $session->set('questions', $questions);
        } else {
            $questions = $session->get('questions');
        }

        return $this->render('quiz/index.html.twig', [
            'questions' => $questions,
            'score' => $score,
            'submitted' => $submitted
        ]);
    }

    #[Route('/quiz/submit', name: 'app_quiz_submit', methods: ['POST'])]
public function submit(SessionInterface $session, RequestStack $requestStack)
{
    $score = 0;
    $questions = $session->get('questions');
    $request = $requestStack->getCurrentRequest();

    foreach ($questions as $index => $question) {
        $answer = $request->request->get('answer_' . ($index + 1));

        if ($answer == $question['correct_answer']) {
            $score++;
        }
    }

    $session->set('score', $score);
    $session->set('submitted', true);

    return $this->redirectToRoute('app_quiz');
}
    private function shuffleArray(array $incorrectAnswers, string $correctAnswer): array
    {
        $allAnswers = array_merge($incorrectAnswers, [$correctAnswer]);
        shuffle($allAnswers);
        return $allAnswers;
    }
}