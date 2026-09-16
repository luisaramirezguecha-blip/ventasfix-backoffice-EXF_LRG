(function () {
  const root = document.documentElement;
  const saved = localStorage.getItem('ventasfix-theme');
  if (saved === 'dark') root.classList.add('dark');
  if (saved === 'light') root.classList.remove('dark');

  window.toggleTheme = function () {
    const isDark = root.classList.toggle('dark');
    localStorage.setItem('ventasfix-theme', isDark ? 'dark' : 'light');
  };
})();

// SIDEBAR ACCORDION
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.accordion-trigger').forEach((trigger) => {
    trigger.addEventListener('click', () => {
      const panel = document.getElementById(trigger.getAttribute('aria-controls'));
      const expanded = trigger.getAttribute('aria-expanded') === 'true';
      trigger.setAttribute('aria-expanded', String(!expanded));
      panel.classList.toggle('open', !expanded);
    });
  });

  //  MODAL 
  document.querySelectorAll('[data-modal-open]').forEach((btn) => {
    btn.addEventListener('click', () => {
      const modal = document.getElementById(btn.getAttribute('data-modal-open'));
      modal.classList.add('open');
    });
  });
  document.querySelectorAll('[data-modal-close]').forEach((btn) => {
    btn.addEventListener('click', () => {
      btn.closest('.modal-overlay').classList.remove('open');
    });
  });
  document.querySelectorAll('.modal-overlay').forEach((overlay) => {
    overlay.addEventListener('click', (e) => {
      if (e.target === overlay) overlay.classList.remove('open');
    });
  });

  //  MOBILE SIDEBAR
  const sidebarToggle = document.getElementById('sidebar-toggle');
  const sidebar = document.querySelector('.sidebar');
  if (sidebarToggle && sidebar) {
    sidebarToggle.addEventListener('click', () => sidebar.classList.toggle('open'));
  }
});

// EMBER PARTICLES 
(function () {
  const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (prefersReduced) return;

  window.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('ember-canvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    let w, h, particles;

    function resize() {
      w = canvas.width = window.innerWidth;
      h = canvas.height = window.innerHeight;
    }
    function makeParticles() {
      const count = Math.min(36, Math.floor((w * h) / 45000));
      particles = Array.from({ length: count }, () => ({
        x: Math.random() * w,
        y: Math.random() * h,
        r: Math.random() * 1.6 + 0.4,
        speedY: Math.random() * 0.35 + 0.08,
        drift: Math.random() * 0.4 - 0.2,
        alpha: Math.random() * 0.5 + 0.15,
      }));
    }
    function getColor() {
      const dark = document.documentElement.classList.contains('dark');
      return dark ? '176,141,79' : '138,100,40';
    }

    function tick() {
      ctx.clearRect(0, 0, w, h);
      const color = getColor();
      particles.forEach((p) => {
        p.y -= p.speedY;
        p.x += p.drift;
        if (p.y < -5) { p.y = h + 5; p.x = Math.random() * w; }
        ctx.beginPath();
        ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
        ctx.fillStyle = `rgba(${color},${p.alpha})`;
        ctx.fill();
      });
      requestAnimationFrame(tick);
    }

    resize();
    makeParticles();
    tick();
    window.addEventListener('resize', () => { resize(); makeParticles(); });
  });
})();
