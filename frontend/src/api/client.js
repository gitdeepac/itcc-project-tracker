import axios from 'axios';


const client = axios.create({
  baseURL: '/api',
  headers: { 'Accept': 'application/json', 'Content-Type': 'application/json' },
});



client.interceptors.request.use(config => {
  const token = localStorage.getItem('itcc_token');
  if (token) config.headers.Authorization = `Bearer ${token}`;
  return config;
});


client.interceptors.response.use(
  res => res,
  err => {
    if (err.response?.status === 401) {
      localStorage.removeItem('itcc_token');
      window.location.reload();
    }
    return Promise.reject(err);
  }
);

export default client;
