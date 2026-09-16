function applyStoredTheme() {
  const stored = localStorage.getItem('vf-theme');
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  const shouldBeDark = stored ? stored === 'dark' : prefersDark;
  document.documentElement.classList.toggle('dark', shouldBeDark);
}

function toggleTheme() {
  const isDark = document.documentElement.classList.toggle('dark');
  localStorage.setItem('vf-theme', isDark ? 'dark' : 'light');
}

// Se ejecuta lo antes posible para evitar parpadeo del tema incorrecto
applyStoredTheme();

// Exponer globalmente porque el HTML usa onclick="toggleTheme()"
window.toggleTheme = toggleTheme;

// Partículas tipo ascuas / polvo flotante 
document.addEventListener('DOMContentLoaded', () => {
  const canvas = document.getElementById('ember-canvas');
  if (!canvas) return;

  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduceMotion) return;

  const ctx = canvas.getContext('2d');
  let particles = [];
  let width, height;

  function resize() {
    width = canvas.width = window.innerWidth;
    height = canvas.height = window.innerHeight;
  }

  function createParticles(count) {
    particles = Array.from({ length: count }, () => ({
      x: Math.random() * width,
      y: Math.random() * height,
      r: Math.random() * 1.4 + 0.4,
      speedY: Math.random() * 0.35 + 0.08,
      speedX: (Math.random() - 0.5) * 0.15,
      opacity: Math.random() * 0.5 + 0.15,
    }));
  }

  function isDark() {
    return document.documentElement.classList.contains('dark');
  }

  function draw() {
    ctx.clearRect(0, 0, width, height);
    const color = isDark() ? '176, 141, 79' : '138, 100, 40';

    particles.forEach((p) => {
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
      ctx.fillStyle = `rgba(${color}, ${p.opacity})`;
      ctx.fill();

      p.y -= p.speedY;
      p.x += p.speedX;

      if (p.y < -10) {
        p.y = height + 10;
        p.x = Math.random() * width;
      }
    });

    requestAnimationFrame(draw);
  }

  resize();
  createParticles(Math.floor((width * height) / 22000));
  draw();

  window.addEventListener('resize', () => {
    resize();
    createParticles(Math.floor((width * height) / 22000));
  });
});