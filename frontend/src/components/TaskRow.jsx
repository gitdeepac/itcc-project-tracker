import { useState } from 'react';
import { updateTaskStatus } from '../api/projects';

const STATUS_COLORS = { done: '#22c55e', in_progress: '#f59e0b', todo: '#94a3b8' };

export default function TaskRow({ task, projectId, onUpdated, showToast }) {
  const [saving, setSaving] = useState(false);

  async function handleChange(e) {
    const newStatus = e.target.value;
    setSaving(true);
    try {
      await updateTaskStatus(projectId, task.id, newStatus);
      showToast('Status updated');
      onUpdated();
    } catch (err) {
      showToast(err.response?.data?.message || 'Update failed', 'error');
    } finally {
      setSaving(false);
    }
  }

  return (
    <tr style={{ borderBottom: '1px solid #1e2330' }}>
      <td style={{ padding: '10px 0', color: '#e2e8f0', fontSize: 13 }}>{task.title}</td>
      <td style={{ padding: '10px 8px', color: '#94a3b8', fontSize: 13 }}>{task.assignee || '—'}</td>
      <td style={{ padding: '10px 8px', color: '#94a3b8', fontSize: 13 }}>{task.due_date || '—'}</td>
      <td style={{ padding: '10px 0' }}>
        <select value={task.status} onChange={handleChange} disabled={saving}
          style={{ background: '#0f1117', border: '1px solid #2a2f3f', color: STATUS_COLORS[task.status], borderRadius: 6, padding: '4px 8px', fontSize: 12, cursor: saving ? 'not-allowed' : 'pointer', outline: 'none' }}>
          <option value="todo">to do</option>
          <option value="in_progress">in progress</option>
          <option value="done">done</option>
        </select>
      </td>
    </tr>
  );
}