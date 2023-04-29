import api from '../api';

const signIn = (password: any) => api.post('/api/auth', password);

export default {
    signIn
};
