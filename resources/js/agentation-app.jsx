import React from 'react';
import ReactDOM from 'react-dom/client';
import Agentation from './components/Agentation';

/**
 * React App wrapper untuk Agentation inspector
 * Mount ke #agentation-root div di Blade template
 */
function App() {
  return (
    <>
      {process.env.NODE_ENV === 'development' && <Agentation />}
    </>
  );
}

// Mount ketika DOM ready
document.addEventListener('DOMContentLoaded', () => {
  const container = document.getElementById('agentation-root');
  if (container) {
    const root = ReactDOM.createRoot(container);
    root.render(<App />);
  }
});

export default App;
