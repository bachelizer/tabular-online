import type { Score } from "@/stores/score/interface/score.interface";

export interface Participant {
    id: number;
    screen_name: string;
    full_name: string;
    gender: string;
    number: number;
    event_id: number;
    scores: Score[];
}

export interface ParticipantRequest {
    screen_name: string;
    full_name: string;
    gender: string;
    number: number;
    event_id: number;
}