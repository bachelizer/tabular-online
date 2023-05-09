export interface Criteria {
    id: number;
    event_id: number;
    criteria: string;
    percentage: number;
    score: number | '';
}

export interface CriteriaRequest {
    event_id: number;
    criteria: string;
    percentage: number;
}