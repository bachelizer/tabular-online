export interface ScoreRequest {
    participant_id: number;
    criteria_id: number;
    score: number;
    user_id: number;
    event_id: number;
}

export interface Score {
    id: number;
    participant_id: number;
    sub_event_id: number,
    // criteria_id: number;
    sub_criteria_id: number,
    score: number;
    user_id: number;
    event_id: number;
}

export interface ParticipantScore {
    id: number;
    percentage_score: number;
}