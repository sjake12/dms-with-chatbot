import axios from 'axios';

// Create an axios instance with default config
const instance = axios.create({
    headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    }
});

// Add a request interceptor to handle authentication
instance.interceptors.request.use(
    config => {
        // Add authentication token if available
        const token = localStorage.getItem('auth_token');
        if (token) {
            config.headers['Authorization'] = `Bearer ${token}`;
        }
        return config;
    },
    error => Promise.reject(error)
);

// Add a response interceptor for global error handling
instance.interceptors.response.use(
    response => response,
    error => {
        // Handle common error scenarios
        if (error.response) {
            switch (error.response.status) {
                case 401:
                    // Redirect to login or refresh token
                    window.location = '/login';
                    break;
                case 403:
                    console.error('Forbidden: You do not have permission');
                    break;
                case 500:
                    console.error('Server error: Please try again later');
                    break;
            }
        }
        return Promise.reject(error);
    }
);

export default instance;
