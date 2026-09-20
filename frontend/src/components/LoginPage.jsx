import { useState } from 'react';
import { login } from '../api/projects';

export default function LoginPage({ onLogin }) {
  const [email, setEmail]       = useState('admin@itcc.test');
  const [password, setPassword] = useState('password');
  const [error, setError]       = useState('');
  const [loading, setLoading]   = useState(false);

  async function handleSubmit(e) {
    e.preventDefault();
    setError('');
    setLoading(true);
    try {
      const res = await login(email, password);
      localStorage.setItem('itcc_token', res.data.token);
      onLogin(res.data.user);
    } catch (err) {
      setError(err.response?.data?.message || 'Login failed.');
    } finally {
      setLoading(false);
    }
  }

  return (
    <div style={{ minHeight: '100vh', background: '#0f1117', display: 'flex', alignItems: 'center', justifyContent: 'center' }}>
      <div style={{ background: '#181c27', border: '1px solid #2a2f3f', borderRadius: 8, padding: 32, width: '100%', maxWidth: 380 }}>
        <h2 style={{ color: '#e2e8f0', fontSize: 16, fontWeight: 600, marginBottom: 20 }}>ITCC Project Tracker</h2>
        {error && (
          <div style={{ background: '#2d100e', border: '1px solid #7f1d1d', color: '#fca5a5', borderRadius: 6, padding: '10px 14px', fontSize: 13, marginBottom: 16 }}>
            {error}
          </div>
        )}
        <form onSubmit={handleSubmit}>
          <div style={{ marginBottom: 14 }}>
            <label style={{ display: 'block', fontSize: 12, color: '#94a3b8', marginBottom: 5 }}>Email</label>
            <input type="email" value={email} onChange={e => setEmail(e.target.value)} required
              style={{ width: '100%', background: '#0f1117', border: '1px solid #2a2f3f', borderRadius: 6, color: '#e2e8f0', padding: '8px 10px', fontSize: 13, outline: 'none', boxSizing: 'border-box' }} />
          </div>
          <div style={{ marginBottom: 20 }}>
            <label style={{ display: 'block', fontSize: 12, color: '#94a3b8', marginBottom: 5 }}>Password</label>
            <input type="password" value={password} onChange={e => setPassword(e.target.value)} required
              style={{ width: '100%', background: '#0f1117', border: '1px solid #2a2f3f', borderRadius: 6, color: '#e2e8f0', padding: '8px 10px', fontSize: 13, outline: 'none', boxSizing: 'border-box' }} />
          </div>
          <button type="submit" disabled={loading}
            style={{ width: '100%', background: '#4f7cff', color: '#fff', border: 'none', borderRadius: 6, padding: '9px 0', fontSize: 13, fontWeight: 500, cursor: loading ? 'not-allowed' : 'pointer', opacity: loading ? .6 : 1 }}>
            {loading ? 'Signing in…' : 'Sign in'}
          </button>
        </form>
      </div>
    </div>
  );
}