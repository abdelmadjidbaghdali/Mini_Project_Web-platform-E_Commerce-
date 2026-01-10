// gamer-effects.js
// Creates animated gamer-style decorative elements with neon effects
(function(){
  'use strict';

  // Configuration
  const CONFIG = {
    particleCount: 30,
    hexCount: 8,
    geometricLineCount: 12,
    animationSpeed: 'slow' // slow, medium, fast
  };

  // Create main effects container
  function createEffectsContainer() {
    const container = document.createElement('div');
    container.id = 'gamer-effects-container';
    container.style.cssText = `
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: 0;
      overflow: hidden;
    `;
    document.body.insertBefore(container, document.body.firstChild);
    return container;
  }

  // Create floating particle effects
  function createParticles(container) {
    const colors = ['#00ffff', '#ff00ff', '#ff0066', '#0099ff', '#00ff99'];
    
    for (let i = 0; i < CONFIG.particleCount; i++) {
      const particle = document.createElement('div');
      const color = colors[Math.floor(Math.random() * colors.length)];
      const size = Math.random() * 3 + 1;
      const x = Math.random() * 100;
      const y = Math.random() * 100;
      const duration = 15 + Math.random() * 15;
      const delay = Math.random() * 5;

      particle.style.cssText = `
        position: absolute;
        width: ${size}px;
        height: ${size}px;
        background: radial-gradient(circle, ${color}, transparent);
        border-radius: 50%;
        left: ${x}%;
        top: ${y}%;
        box-shadow: 0 0 ${size * 3}px ${color};
        opacity: 0.6;
        animation: floating-particles ${duration}s ease-in-out ${delay}s infinite;
      `;
      
      container.appendChild(particle);
    }
  }

  // Create hexagonal patterns
  function createHexagons(container) {
    for (let i = 0; i < CONFIG.hexCount; i++) {
      const hex = document.createElement('div');
      const size = 80 + Math.random() * 120;
      const x = Math.random() * 100;
      const y = Math.random() * 100;
      const duration = 20 + Math.random() * 20;
      const delay = Math.random() * 5;
      const colors = ['rgba(0, 255, 255, 0.1)', 'rgba(138, 43, 226, 0.08)', 'rgba(255, 0, 102, 0.08)'];
      const color = colors[Math.floor(Math.random() * colors.length)];

      hex.style.cssText = `
        position: absolute;
        width: ${size}px;
        height: ${size}px;
        left: ${x}%;
        top: ${y}%;
        clip-path: polygon(30% 0%, 70% 0%, 100% 30%, 100% 70%, 70% 100%, 30% 100%, 0% 70%, 0% 30%);
        border: 2px solid;
        border-color: ${color};
        opacity: 0.3;
        animation: hex-pulse ${duration}s ease-in-out ${delay}s infinite;
      `;
      
      container.appendChild(hex);
    }
  }

  // Create geometric lines
  function createGeometricLines(container) {
    for (let i = 0; i < CONFIG.geometricLineCount; i++) {
      const line = document.createElement('div');
      const height = 2 + Math.random() * 3;
      const width = 200 + Math.random() * 300;
      const x = Math.random() * 100;
      const y = Math.random() * 100;
      const rotation = Math.random() * 90;
      const duration = 8 + Math.random() * 12;
      const delay = Math.random() * 3;
      const colors = ['#00ffff', '#ff00ff', '#ff0066', '#0099ff'];
      const color = colors[Math.floor(Math.random() * colors.length)];

      line.style.cssText = `
        position: absolute;
        width: ${width}px;
        height: ${height}px;
        left: ${x}%;
        top: ${y}%;
        transform: rotate(${rotation}deg);
        background: linear-gradient(90deg, transparent, ${color}, transparent);
        box-shadow: 0 0 10px ${color}, 0 0 20px ${color}80;
        opacity: 0.4;
        animation: geometric-slide ${duration}s linear ${delay}s infinite;
      `;
      
      container.appendChild(line);
    }
  }

  // Create HUD elements (corner decorations)
  function createHUDElements(container) {
    const positions = [
      { corner: 'top-left', x: '20px', y: '20px' },
      { corner: 'top-right', x: 'auto', y: '20px', right: '20px' },
      { corner: 'bottom-left', x: '20px', y: 'auto', bottom: '20px' },
      { corner: 'bottom-right', x: 'auto', y: 'auto', right: '20px', bottom: '20px' }
    ];

    positions.forEach((pos, idx) => {
      const hud = document.createElement('div');
      const size = 60 + Math.random() * 40;
      const colors = ['#00ffff', '#ff00ff', '#ff0066'];
      const color = colors[idx % colors.length];

      hud.style.cssText = `
        position: fixed;
        width: ${size}px;
        height: ${size}px;
        left: ${pos.x};
        top: ${pos.y};
        ${pos.right ? 'right: ' + pos.right : ''}
        ${pos.bottom ? 'bottom: ' + pos.bottom : ''}
        border: 2px solid ${color};
        opacity: 0.2;
        animation: neon-flicker 3s ease-in-out ${idx * 0.5}s infinite;
        pointer-events: none;
        z-index: 0;
      `;

      // Add inner corner decorations
      const corner1 = document.createElement('div');
      corner1.style.cssText = `
        position: absolute;
        width: 20px;
        height: 20px;
        border-top: 3px solid ${color};
        border-left: 3px solid ${color};
        top: -2px;
        left: -2px;
        box-shadow: 0 0 10px ${color};
      `;
      hud.appendChild(corner1);

      const corner2 = document.createElement('div');
      corner2.style.cssText = `
        position: absolute;
        width: 20px;
        height: 20px;
        border-bottom: 3px solid ${color};
        border-right: 3px solid ${color};
        bottom: -2px;
        right: -2px;
        box-shadow: 0 0 10px ${color};
      `;
      hud.appendChild(corner2);

      container.appendChild(hud);
    });
  }

  // Create digital scan lines effect
  function createScanLines(container) {
    const scanlines = document.createElement('div');
    scanlines.style.cssText = `
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: repeating-linear-gradient(
        0deg,
        rgba(0, 255, 255, 0.03),
        rgba(0, 255, 255, 0.03) 1px,
        transparent 1px,
        transparent 2px
      );
      pointer-events: none;
      z-index: 0;
      animation: wave-flow 20s linear infinite;
    `;
    container.appendChild(scanlines);
  }

  // Create glowing gradient orbs in background
  function createGlowingOrbs(container) {
    const orbCount = 4;
    const colors = [
      { main: '#00ffff', shadow: 'rgba(0, 255, 255, 0.2)' },
      { main: '#ff00ff', shadow: 'rgba(138, 43, 226, 0.2)' },
      { main: '#ff0066', shadow: 'rgba(255, 0, 102, 0.15)' },
      { main: '#0099ff', shadow: 'rgba(0, 153, 255, 0.2)' }
    ];

    for (let i = 0; i < orbCount; i++) {
      const orb = document.createElement('div');
      const size = 200 + Math.random() * 300;
      const x = Math.random() * 100;
      const y = Math.random() * 100;
      const duration = 15 + Math.random() * 15;
      const delay = Math.random() * 5;
      const color = colors[i % colors.length];

      orb.style.cssText = `
        position: absolute;
        width: ${size}px;
        height: ${size}px;
        left: ${x}%;
        top: ${y}%;
        border-radius: 50%;
        background: radial-gradient(circle, ${color.main}20, transparent);
        filter: blur(80px);
        opacity: 0.15;
        animation: glow-pulse ${duration}s ease-in-out ${delay}s infinite;
      `;
      
      container.appendChild(orb);
    }
  }

  // Add CSS animations if not already present
  function injectAnimations() {
    const styleId = 'gamer-effects-styles';
    if (!document.getElementById(styleId)) {
      const style = document.createElement('style');
      style.id = styleId;
      style.textContent = `
        @keyframes floating-particles {
          0% { transform: translateY(0px) translateX(0px) rotate(0deg); opacity: 0.3; }
          25% { opacity: 0.6; }
          50% { transform: translateY(-20px) translateX(10px) rotate(90deg); opacity: 0.8; }
          75% { opacity: 0.5; }
          100% { transform: translateY(0px) translateX(0px) rotate(360deg); opacity: 0.3; }
        }

        @keyframes hex-pulse {
          0%, 100% { 
            transform: scale(1) rotate(0deg);
            opacity: 0.1;
          }
          50% { 
            transform: scale(1.1) rotate(30deg);
            opacity: 0.25;
          }
        }

        @keyframes geometric-slide {
          0% { transform: translateX(-100%) rotate(var(--rotation, 0deg)); opacity: 0; }
          50% { opacity: 0.15; }
          100% { transform: translateX(100%) rotate(var(--rotation, 0deg)); opacity: 0; }
        }

        @keyframes neon-flicker {
          0%, 100% { opacity: 0.2; }
          19% { opacity: 0.18; }
          20% { opacity: 0.25; }
          39% { opacity: 0.2; }
          40% { opacity: 0.22; }
          59% { opacity: 0.2; }
          60% { opacity: 0.19; }
        }

        @keyframes glow-pulse {
          0%, 100% { 
            filter: blur(80px);
            opacity: 0.15;
          }
          50% { 
            filter: blur(100px);
            opacity: 0.25;
          }
        }

        @keyframes wave-flow {
          0% { transform: translateX(0); }
          100% { transform: translateX(100%); }
        }
      `;
      document.head.appendChild(style);
    }
  }

  // Initialize all effects
  function init() {
    // Wait for DOM to be ready
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initialize);
    } else {
      initialize();
    }
  }

  function initialize() {
    try {
      injectAnimations();
      const container = createEffectsContainer();
      
      createScanLines(container);
      createGlowingOrbs(container);
      createHexagons(container);
      createGeometricLines(container);
      createParticles(container);
      createHUDElements(container);

      console.log('Gamer effects initialized successfully');
    } catch (error) {
      console.error('Error initializing gamer effects:', error);
    }
  }

  init();
})();
