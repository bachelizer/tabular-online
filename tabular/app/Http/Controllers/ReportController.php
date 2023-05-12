<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\IReport;
use App\Repositories\Interfaces\IEvent;
use App\Repositories\Interfaces\ICriteria;
use App\Repositories\Interfaces\IParticipant;
use App\Repositories\Interfaces\IScore;
use App\Repositories\Interfaces\IUser;
use App\Repositories\Interfaces\ISubEvent;
use Illuminate\Http\Request;

use PDF;

class ReportController extends Controller
{
    //
    private IReport $reportRepository;
    private IEvent $eventRepository;
    private ICriteria $criteriaRepository;
    private ISubEvent $subEvent;
    private IParticipant $participantRepository;
    private IUser $userRepository;
    private IScore $scoreRepository;

    public function __construct(IReport $reportRepository, IEvent $eventRepository, ICriteria $criteriaRepository, IParticipant $participantRepository, IUser $userRepository, IScore $scoreRepository,  ISubEvent $subEvent)
    {
        $this->reportRepository = $reportRepository;
        $this->eventRepository = $eventRepository;
        $this->criteriaRepository = $criteriaRepository;
        $this->participantRepository = $participantRepository;
        $this->userRepository = $userRepository;
        $this->scoreRepository = $scoreRepository;
        $this->subEvent = $subEvent;
    }

    public function getScores(Request $request, $eventId)
    {

        $jsonString = $request->getContent();
        $data = json_decode($jsonString, true);
        // $participant = $this->participantRepository->fetchEventParticipant($eventId);
        // $score = $this->reportRepository->getScores($eventId);
        // $allScores = $this->reportRepository->getAllScores($eventId);
        $event = $this->eventRepository->showEvent($eventId);
        $criteria = $this->criteriaRepository->fetchEventCriteria($eventId);
        $users = $this->userRepository->fetchEventUser($eventId);
        // $score = $this->scoreRepository->getTotalPercentage($eventId);
        // $pdf = PDF::loadView('reports/scores', array('participant' => $participant,'score' => $score, 'event' => $event, 'criteria' => $criteria, 'users' =>  $users, 'allScores' =>  $allScores));
        $pdf = PDF::loadView('reports/scores', array('participants' => $data, 'event' => $event, 'criteria' => $criteria, 'users' =>  $users));
        return $pdf->download('tabulator_final_result.pdf');
        // return $data;
    }

    public function getScoringJudge($eventId)
    {
        $scores = $this->reportRepository->getScoringJudge($eventId);
        $event = $this->eventRepository->showEvent($eventId);
        $users = $this->userRepository->fetchEventUser($eventId);
        $pdf = PDF::loadView('reports/judge-scoring', array('scores' => $scores, 'event' => $event, 'users' =>  $users));
        return $pdf->download('tabulator_judges_scoring.pdf');
        // return $users;
    }

    public function individualJudgeScoring($eventId, $userId)
    {
        $male = $this->reportRepository->individualJudgeScoring($eventId, $userId, 'male');
        $female = $this->reportRepository->individualJudgeScoring($eventId, $userId, 'female');
        $event = $this->eventRepository->showEvent($eventId);
        // $criteria = $this->criteriaRepository->fetchEventCriteria($eventId);
        $criteria = $this->subEvent->fetchEventCriteria($eventId);
        $user = $this->userRepository->getUserDetails($userId);
        $pdf = PDF::loadView('reports/individual-scoring', array('male' => $male, 'female' => $female, 'event' => $event, 'criteria' => $criteria, 'user' =>  $user));
        return $pdf->download('individual_scoring_'.$userId.'.pdf');
        // return $male;
    }

    public function scoreSummary($eventId)
    {
        $male = $this->reportRepository->scoreSummary($eventId, 'male');
        // $female = $this->reportRepository->scoreSummary($eventId, 'female');
        $event = $this->eventRepository->showEvent($eventId);
        $users = $this->reportRepository->fetchEventUser($eventId);
        $pdf = PDF::loadView('reports/score-summary', array('male' => $male, 'event' => $event, 'users' =>  $users));
        return $pdf->download('score_summary.pdf');
        // return $data;
    }

    public function scoreSummary2($eventId)
    {
        $male = $this->reportRepository->scoreSummary2($eventId, 'male');
        $female = $this->reportRepository->scoreSummary2($eventId, 'female');
        $subEvents = $this->subEvent->showSubEvents($eventId);
        $event = $this->eventRepository->showEvent($eventId);
        $users = $this->reportRepository->fetchEventUser($eventId);
        $pdf = PDF::loadView('reports/score-summary', array('male' => $male, 'female' => $female, 'subEvents' => $subEvents, 'users' =>  $users, 'event' => $event));
        return $pdf->download('score_summary.pdf');
        // return $male;
        // return $users;
        // return $male;
    }
}
