import axios from 'axios';

const url = (parsedUrl: string) => {
    if (parsedUrl === 'http://localhost:3000') return 'http://127.0.0.1:8000';
    return 'http://127.0.0.1:8000';
};

export default axios.create({
    baseURL: url(window.location.origin),
    // withCredentials: true,
    headers: {
        'Content-Type': 'application/json'
    }
});
