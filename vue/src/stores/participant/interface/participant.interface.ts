export interface Participant {
    id: number;
    screen_name: string;
    full_name: string;
    number: number;
    event_id: number;
}

export interface ParticipantRequest {
    screen_name: string;
    full_name: string;
    number: number;
    event_id: number;
}