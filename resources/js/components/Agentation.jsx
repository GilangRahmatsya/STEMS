import React, { useState, useCallback } from 'react';
import { Agentation as AgentationComponent } from 'agentation';

/**
 * Agentation Component for STEMS Development
 * - Annotates UI elements with bounding box info
 * - Only loads in development mode
 * - Sends annotation data to console for inspection
 */
export default function Agentation() {
  const [annotations, setAnnotations] = useState([]);
  const [showStats, setShowStats] = useState(false);

  const handleAnnotationAdd = useCallback((annotation) => {
    console.group('🎯 Agentation Annotation');
    console.log('Element:', annotation.element);
    console.log('Path:', annotation.elementPath);
    console.log('Bounding Box:', annotation.boundingBox);
    console.groupEnd();

    // Store annotation for debugging
    setAnnotations(prev => [...prev, {
      timestamp: new Date().toLocaleTimeString(),
      ...annotation
    }]);
  }, []);

  // Only render in development
  if (process.env.NODE_ENV !== 'development') {
    return null;
  }

  return (
    <>
      {/* Agentation Component - Main Inspector */}
      <AgentationComponent 
        onAnnotationAdd={handleAnnotationAdd}
        copyToClipboard={true}
      />

      {/* Debug Stats Overlay */}
      {showStats && (
        <div style={{
          position: 'fixed',
          bottom: '20px',
          right: '20px',
          background: 'rgba(0, 0, 0, 0.9)',
          color: '#0f0',
          padding: '12px 16px',
          borderRadius: '6px',
          fontSize: '12px',
          fontFamily: 'monospace',
          maxWidth: '300px',
          zIndex: 99999,
          maxHeight: '200px',
          overflowY: 'auto',
          border: '2px solid #0f0'
        }}>
          <div style={{ marginBottom: '8px', fontWeight: 'bold' }}>
            📊 Annotations: {annotations.length}
          </div>
          {annotations.slice(-5).map((ann, idx) => (
            <div key={idx} style={{ marginBottom: '4px', fontSize: '11px' }}>
              <div>{ann.timestamp}</div>
              <div>→ {ann.element}</div>
            </div>
          ))}
        </div>
      )}

      {/* Toggle Button */}
      <button
        onClick={() => setShowStats(!showStats)}
        style={{
          position: 'fixed',
          bottom: '20px',
          left: '20px',
          background: '#ff6b00',
          color: 'white',
          border: 'none',
          padding: '8px 12px',
          borderRadius: '4px',
          cursor: 'pointer',
          fontSize: '12px',
          fontWeight: 'bold',
          zIndex: 99998
        }}
      >
        {showStats ? '📊 Hide Stats' : '📊 Show Stats'}
      </button>
    </>
  );
}
