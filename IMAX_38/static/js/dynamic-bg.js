// dynamic-bg.js
// Intelligently samples dominant colors from page images and creates custom light-blue gradients
(function(){
  'use strict';

  function clamp(v, min, max) { 
    return Math.max(min, Math.min(max, v)); 
  }

  function lerp(a, b, t) { 
    return a + (b - a) * t; 
  }

  // Sample color from an image using canvas
  function sampleImageColor(img, size) {
    size = size || 32;
    var canvas = document.createElement('canvas');
    canvas.width = size;
    canvas.height = size;
    var ctx = canvas.getContext('2d');
    
    try {
      ctx.drawImage(img, 0, 0, size, size);
    } catch(e) { 
      return null; 
    }

    try {
      var data = ctx.getImageData(0, 0, size, size).data;
    } catch(e) { 
      return null; 
    }

    // Sample with higher precision
    var r = 0, g = 0, b = 0, count = 0;
    for (var i = 0; i < data.length; i += 4) {
      // Skip very dark/black and very light/white pixels for better color detection
      var brightness = (data[i] + data[i+1] + data[i+2]) / 3;
      if (brightness > 20 && brightness < 235) {
        r += data[i];
        g += data[i + 1];
        b += data[i + 2];
        count++;
      }
    }

    if (!count) return null;
    return { 
      r: Math.round(r / count), 
      g: Math.round(g / count), 
      b: Math.round(b / count) 
    };
  }

  function rgbToCss(rgb, a) { 
    return 'rgba(' + rgb.r + ',' + rgb.g + ',' + rgb.b + ',' + (a == null ? 1 : a) + ')'; 
  }

  function rgbToHex(rgb) {
    return '#' + [rgb.r, rgb.g, rgb.b].map(x => {
      var hex = x.toString(16);
      return hex.length === 1 ? '0' + hex : hex;
    }).join('');
  }

  // Intelligently blend toward neon gamer palette while preserving saturation
  function blendTowardGamerPalette(sample) {
    // Neon gamer palette stops
    var darkPurple = { r: 26, g: 10, b: 62 };         // #1a0a3e
    var deepMagenta = { r: 45, g: 10, b: 82 };        // #2d0a52
    var neonCyan = { r: 0, g: 255, b: 255 };          // #00ffff
    var neonMagenta = { r: 255, g: 0, b: 255 };       // #ff00ff

    // Calculate saturation of sample
    var max = Math.max(sample.r, sample.g, sample.b);
    var min = Math.min(sample.r, sample.g, sample.b);
    var saturation = max === 0 ? 0 : (max - min) / max;

    // Blend toward dark purple base (80%) for gaming aesthetic
    var blendStrength = 0.8;
    
    var blended = {
      r: Math.round(lerp(sample.r, darkPurple.r, blendStrength)),
      g: Math.round(lerp(sample.g, darkPurple.g, blendStrength)),
      b: Math.round(lerp(sample.b, darkPurple.b, blendStrength))
    };

    // Ensure dark gaming background
    blended.r = clamp(blended.r, 5, 50);
    blended.g = clamp(blended.g, 0, 30);
    blended.b = clamp(blended.b, 20, 80);

    return blended;
  }

  // Generate sophisticated neon gradient with multiple stops
  function generateGradient(dominantColor) {
    var c1 = dominantColor;
    var c2 = { r: 26, g: 10, b: 62 };         // #1a0a3e - dark purple
    var c3 = { r: 45, g: 10, b: 82 };         // #2d0a52 - deep magenta
    var c4 = { r: 10, g: 5, b: 30 };          // #0a0520 - very dark base
    var c5 = { r: 30, g: 10, b: 50 };         // #1e0a32 - dark plum

    return 'linear-gradient(-45deg, ' +
      rgbToCss(c4, 1.0) + ' 0%, ' +
      rgbToCss(c2, 0.95) + ' 25%, ' +
      rgbToCss(c3, 0.9) + ' 50%, ' +
      rgbToCss(c1, 0.85) + ' 75%, ' +
      rgbToCss(c5, 1.0) + ' 100%)';
  }

  function applyGradient(dominantColor) {
    var gradient = generateGradient(dominantColor);
    document.documentElement.style.setProperty('--bg-gradient', gradient);
    
    // Also update --color-bg for neon gamer aesthetic
    var darkBg = {
      r: clamp(dominantColor.r, 5, 30),
      g: clamp(dominantColor.g, 0, 15),
      b: clamp(dominantColor.b, 15, 50)
    };
    document.documentElement.style.setProperty(
      '--color-bg', 
      'rgb(' + darkBg.r + ',' + darkBg.g + ',' + darkBg.b + ')'
    );
  }

  function findCandidateImages() {
    var selectors = [
      '.slider img', 
      '.wide-container img', 
      '.selectable-card img', 
      '.rounded-card img', 
      'img[src*="carousel"]',
      'img[src*="category"]',
      '.grid img', 
      'img'
    ];

    var candidates = [];
    for (var s of selectors) {
      var list = document.querySelectorAll(s);
      for (var i = 0; i < list.length; i++) {
        var img = list[i];
        if (!img) continue;
        var w = img.naturalWidth || img.width || 0;
        var h = img.naturalHeight || img.height || 0;
        // Prefer images with reasonable size
        if ((w >= 160 && h >= 120) || (w >= 200 || h >= 200)) {
          candidates.push(img);
        }
      }
    }
    return candidates;
  }

  function runOnce() {
    var candidates = findCandidateImages();
    if (!candidates || candidates.length === 0) {
      // Fallback: apply a nice light blue gradient
      applyGradient({ r: 220, g: 235, b: 250 });
      return;
    }

    var processed = 0;
    var colors = [];

    function checkCandidate(img, index) {
      if (!img) {
        processed++;
        if (processed === candidates.length) finalizeBg();
        return;
      }

      if (!img.complete) {
        img.addEventListener('load', function() {
          tryProcess(img, colors);
          processed++;
          if (processed === candidates.length) finalizeBg();
        });
        img.addEventListener('error', function() {
          processed++;
          if (processed === candidates.length) finalizeBg();
        });
      } else {
        tryProcess(img, colors);
        processed++;
        if (processed === candidates.length) finalizeBg();
      }
    }

    function tryProcess(img, colorArray) {
      var sample = sampleImageColor(img, 40);
      if (sample) {
        var blended = blendTowardGamerPalette(sample);
        colorArray.push(blended);
      }
    }

    function finalizeBg() {
      var dominantColor;
      if (colors.length === 0) {
        dominantColor = { r: 26, g: 10, b: 62 };  // Dark purple fallback
      } else if (colors.length === 1) {
        dominantColor = colors[0];
      } else {
        // Average all colors for a harmonious neon gradient
        dominantColor = {
          r: Math.round(colors.reduce((sum, c) => sum + c.r, 0) / colors.length),
          g: Math.round(colors.reduce((sum, c) => sum + c.g, 0) / colors.length),
          b: Math.round(colors.reduce((sum, c) => sum + c.b, 0) / colors.length)
        };
      }
      applyGradient(dominantColor);
    }

    // Process first 5 candidates for performance
    var limit = Math.min(5, candidates.length);
    for (var i = 0; i < limit; i++) {
      checkCandidate(candidates[i], i);
    }
  }

  // Run after DOM is ready
  if (document.readyState === 'complete' || document.readyState === 'interactive') {
    setTimeout(runOnce, 100);
  } else {
    document.addEventListener('DOMContentLoaded', runOnce);
  }

  // Also run on window load for safety
  window.addEventListener('load', function() {
    setTimeout(runOnce, 500);
  });

})();

