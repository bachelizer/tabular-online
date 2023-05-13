export interface ActivityRequest
{
    title: string;
    description: string;
    date: string;
    is_active: boolean;
}

export interface Activity
{
    id: number;
    title: string;
    description: string;
    date: string;
    is_active: boolean;
}