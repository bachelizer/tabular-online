import api from '../api';
import type { UserRequest, User } from '@/stores/user/interface/user.interface';
import type { SignInRequest } from '@/stores/user/interface/user.interface';

const createUser = (payload: UserRequest) => api.post('/api/user', payload);

const fetchEventUser = (eventId: number) => api.get(`/api/user/${eventId}`);

const signIn = (ps: string) => api.get(`/api/user/signIn/${ps}`);

const updateUser = (payload: User) => api.put(`/api/user/${payload.id}`, payload);

const removeUser = (id: number) => api.delete(`/api/user/${id}`)

export default {
    createUser,
    fetchEventUser,
    signIn,
    updateUser,
    removeUser,
};
