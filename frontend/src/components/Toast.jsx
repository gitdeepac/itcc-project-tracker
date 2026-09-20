export default function Toast({ toast }) {
  if (!toast) return null;
  const isError = toast.type === 'error';
  return (
    <div style={{
      position: 'fixed', bottom: 24, right: 24, zIndex: 999,
      background: isError ? '#2d100e' : '#1a2a1a',
      border: `1px solid ${isError ? '#7f1d1d' : '#166534'}`,
      color: isError ? '#fca5a5' : '#22c55e',
      padding: '10px 16px', borderRadius: 6, fontSize: 13,
    }}>
      {toast.message}
    </div>
  );
}