import api from '../api'

const fetchRoles = () => api.get('/api/role');

export default {
    fetchRoles,
}