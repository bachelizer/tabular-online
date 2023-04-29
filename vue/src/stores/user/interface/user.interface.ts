import type { Role } from "@/stores/role/interface/role.interface";
import type { Event } from "@/stores/event/interface/event.interface";

export interface User {
    id: number;
    password: string;
    event_id: number;
    role_id: number;
    full_name: string;
    screen_name: string;
    role: Role;
    event: Event;
}

export interface UserRequest {
    password: string;
    event_id: number;
    role_id: number;
    full_name: string;
    screen_name: string;
}

export interface SignInRequest {
    password: string;
}