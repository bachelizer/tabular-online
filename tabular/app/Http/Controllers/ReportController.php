<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\IReport;
use App\Repositories\Interfaces\IEvent;
use App\Repositories\Interfaces\ICriteria;
use App\Repositories\Interfaces\IParticipant;
use App\Repositories\Interfaces\IScore;
use App\Repositories\Interfaces\IUser;
use Illuminate\Http\Request;

use PDF;

class ReportController extends Controller
{
    //
    private IReport $reportRepository;
    private IEvent $eventRepository;
    private ICriteria $criteriaRepository;
    private IParticipant $participantRepository;
    private IUser $userRepository;
    private IScore $scoreRepository;

    public function __construct(IReport $reportRepository, IEvent $eventRepository, ICriteria $criteriaRepository, IParticipant $participantRepository, IUser $userRepository, IScore $scoreRepository)
    {
        $this->reportRepository = $reportRepository;
        $this->eventRepository = $eventRepository;
        $this->criteriaRepository = $criteriaRepository;
        $this->participantRepository = $participantRepository;
        $this->userRepository = $userRepository;
        $this->scoreRepository = $scoreRepository;
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
}
