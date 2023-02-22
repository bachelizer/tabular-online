export interface User {
    password: string;
    event_id: number;
    role_id: number;
    full_name: string;
    screen_name: string;
}

export interface UserRequest {
    password: string;
    event_id: number;
    role_id: number;
    full_name: string;
    screen_name: string;
}