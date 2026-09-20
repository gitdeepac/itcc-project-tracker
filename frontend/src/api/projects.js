import client from './client';

export const login             = (email, password) => client.post('/login', { email, password });
export const logout            = () => client.post('/logout');
export const getMe             = () => client.get('/me');
export const getProjects       = () => client.get('/projects');
export const getProjectSummary = (id) => client.get(`/projects/${id}/summary`);
export const getProjectTasks   = (id) => client.get(`/projects/${id}/tasks`);
export const updateTaskStatus  = (projectId, taskId, status) =>
  client.put(`/projects/${projectId}/tasks/${taskId}`, { status });