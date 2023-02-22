import type { Criteria } from "@/stores/criteria/interface/criteria.interface";
import type { User } from "@/stores/user/interface/user.interface"
import type { Participant } from "@/stores/participant/interface/participant.interface";

export interface EventRequest {
    id: number;
    event_name: string;
    date: Date;
    is_active: boolean;
}

export interface Event {
    id: number;
    event_name: string;
    date: Date;
    is_active: boolean;
    criterias: Criteria[];
    users: User[];
    participants: Participant[];
}
