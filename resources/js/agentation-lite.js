// Agentation Lite - Development-only UI annotation tool
// Simple vanilla JavaScript integration (no React needed)

if (typeof window !== 'undefined') {
    // Wait for DOM to be ready
    document.addEventListener('DOMContentLoaded', () => {
        // Create container for Agentation UI
        const container = document.createElement('div');
        container.id = 'agentation-lite-container';
        document.body.appendChild(container);

        // Add styles for debugging overlay
        const style = document.createElement('style');
        style.textContent = `
            #agentation-lite-container {
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 99999;
            }
            
            .agentation-toggle {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
                color: white;
                border: none;
                cursor: pointer;
                font-size: 24px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                transition: all 0.3s ease;
                hover: transform 0.3s ease;
            }
            
            .agentation-toggle:hover {
                transform: scale(1.1);
                box-shadow: 0 6px 20px rgba(249, 115, 22, 0.4);
            }
            
            .agentation-panel {
                position: fixed;
                bottom: 90px;
                right: 20px;
                width: 320px;
                max-height: 400px;
                background: white;
                border-radius: 12px;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
                padding: 16px;
                display: none;
                flex-direction: column;
                gap: 12px;
                z-index: 99998;
                border: 1px solid #e5e7eb;
            }
            
            .agentation-panel.active {
                display: flex;
            }
            
            .agentation-panel h3 {
                margin: 0;
                font-size: 16px;
                font-weight: 600;
                color: #1f2937;
            }
            
            .agentation-log {
                max-height: 300px;
                overflow-y: auto;
                background: #f9fafb;
                border-radius: 8px;
                padding: 12px;
                font-size: 12px;
                font-family: 'Courier New', monospace;
                color: #374151;
                line-height: 1.5;
            }
            
            .agentation-log-entry {
                margin-bottom: 8px;
                padding-bottom: 8px;
                border-bottom: 1px solid #e5e7eb;
            }
            
            .agentation-log-entry:last-child {
                border-bottom: none;
                margin-bottom: 0;
                padding-bottom: 0;
            }
            
            .agentation-log-label {
                font-weight: 600;
                color: #f97316;
                margin-bottom: 2px;
            }
        `;
        document.head.appendChild(style);

        // Create toggle button
        const toggleBtn = document.createElement('button');
        toggleBtn.className = 'agentation-toggle';
        toggleBtn.textContent = '🎨';
        toggleBtn.title = 'Toggle Agentation Panel (🎯 = Selector Active)';
        toggleBtn.setAttribute('aria-label', 'Toggle annotation panel');
        
        // Create panel
        const panel = document.createElement('div');
        panel.className = 'agentation-panel';
        
        const panelTitle = document.createElement('h3');
        panelTitle.textContent = 'Agentation Debug';
        
        // Create selector button
        const selectorBtn = document.createElement('button');
        selectorBtn.style.cssText = 'padding: 6px 12px; background: #f97316; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: 600; transition: all 0.2s;';
        selectorBtn.textContent = '🎯 Selector: OFF';
        selectorBtn.title = 'Click to enable selector mode - then click elements to inspect';
        
        const panelLog = document.createElement('div');
        panelLog.className = 'agentation-log';
        panelLog.textContent = 'Click 🎯 Selector button, then click elements to inspect...';
        
        panel.appendChild(panelTitle);
        panel.appendChild(selectorBtn);
        panel.appendChild(panelLog);
        
        // Store logs and selector state
        let logs = [];
        const maxLogs = 10;
        let selectorActive = false;
        
        // Toggle panel
        toggleBtn.addEventListener('click', () => {
            panel.classList.toggle('active');
            if (!panel.classList.contains('active') && selectorActive) {
                selectorActive = false;
                selectorBtn.textContent = '🎯 Selector: OFF';
                selectorBtn.style.background = '#f97316';
                document.body.style.cursor = 'auto';
            }
        });
        
        // Selector mode toggle
        selectorBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            selectorActive = !selectorActive;
            if (selectorActive) {
                selectorBtn.textContent = '🎯 Selector: ON';
                selectorBtn.style.background = '#22c55e';
                document.body.style.cursor = 'crosshair';
                panelLog.textContent = '👆 Click elements to inspect...';
            } else {
                selectorBtn.textContent = '🎯 Selector: OFF';
                selectorBtn.style.background = '#f97316';
                document.body.style.cursor = 'auto';
                panelLog.textContent = 'Selector disabled';
            }
        });
        
        // Function to inspect element
        const inspectElement = (element) => {
            const tag = element.tagName.toLowerCase();
            const classNameStr = element.className ? String(element.className) : '';
            const classes = classNameStr ? `.${classNameStr.split(' ').join('.')}` : '';
            const id = element.id ? `#${element.id}` : '';
            const selector = `${tag}${id}${classes}`;
            const bbox = element.getBoundingClientRect();
            
            // Log entry
            const logEntry = {
                element: tag,
                selector: selector,
                text: element.textContent?.substring(0, 50) || '',
                boundingBox: {
                    x: Math.round(bbox.x),
                    y: Math.round(bbox.y),
                    width: Math.round(bbox.width),
                    height: Math.round(bbox.height)
                },
                timestamp: new Date().toLocaleTimeString()
            };
            
            // Add to logs
            logs.unshift(logEntry);
            if (logs.length > maxLogs) logs.pop();
            
            // Update panel
            panelLog.innerHTML = logs.map(log => `
                <div class="agentation-log-entry">
                    <div class="agentation-log-label">📍 ${log.element}</div>
                    <div><strong>Selector:</strong> <code>${log.selector}</code></div>
                    <div><strong>Text:</strong> ${log.text || '(empty)'}</div>
                    <div><strong>Position:</strong> x:${log.boundingBox.x} y:${log.boundingBox.y}</div>
                    <div><strong>Size:</strong> ${log.boundingBox.width}×${log.boundingBox.height}px</div>
                    <div style="color: #999; font-size: 11px;">${log.timestamp}</div>
                </div>
            `).join('');
            
            // Console log
            console.log('🎨 Agentation:', logEntry);
        };
        
        // Add element inspection on hover (when selector OFF)
        document.addEventListener('mouseover', (e) => {
            if (selectorActive) return;
            if (e.target === toggleBtn || e.target === panel || e.target === selectorBtn || panel.contains(e.target)) {
                return;
            }
            
            inspectElement(e.target);
        });
        
        // Add element inspection on click (when selector ON)
        document.addEventListener('click', (e) => {
            if (!selectorActive) return;
            if (e.target === toggleBtn || e.target === panel || e.target === selectorBtn || panel.contains(e.target)) {
                return;
            }
            
            e.preventDefault();
            e.stopPropagation();
            inspectElement(e.target);
        }, true);
        
        container.appendChild(toggleBtn);
        container.appendChild(panel);
        
        console.log('✅ Agentation Lite loaded - click 🎨 button to start');
    });
}
