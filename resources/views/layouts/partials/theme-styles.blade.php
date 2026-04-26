<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Source+Serif+4:ital,wght@0,300;0,400;0,600;1,300&family=EB+Garamond:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { box-sizing: border-box; }
:root {
  --maroon: #6B1020;
  --maroon-deep: #4A0A16;
  --maroon-mid: #8B1A2C;
  --maroon-light: #F5E8EB;
  --red: #C0272D;
  --red-light: #FDECEA;
  --gold: #C9A84C;
  --gold-light: #FBF3DC;
  --gold-dark: #8B6E28;
  --black: #1A1410;
  --charcoal: #2E2820;
  --ink: #3D3530;
  --white: #FDFAF6;
  --cream: #F7F3ED;
  --border: #C8B89A;
  --border-light: #DDD5C5;
  --text: #1A1410;
  --text-mid: #4A3F35;
  --text-muted: #7A6E62;
  --radius: 8px;
  --radius-lg: 16px;
  --shadow: 0 2px 12px rgba(26,20,16,0.12);
  --shadow-md: 0 6px 24px rgba(26,20,16,0.14);
  --font-display: 'Playfair Display', Georgia, serif;
  --font-body: 'Source Serif 4', Georgia, serif;
  --font-ui: 'EB Garamond', Georgia, serif;
}
html, body { min-height: 100%; }
body {
  margin: 0;
  font-family: var(--font-body);
  background: var(--cream);
  color: var(--text);
  line-height: 1.65;
}
a { color: inherit; text-decoration: none; }
button, input, select, textarea { font: inherit; }
.text-muted { color: var(--text-muted) !important; }
.card {
  background: var(--white);
  border: 1px solid var(--border-light);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow);
}
.card-body { padding: 1.5rem; }
.card-title { font-family: var(--font-display); font-size: 1rem; font-weight: 600; color: var(--maroon); margin-bottom: 0.5rem; }
.form-label { display: block; margin-bottom: 0.5rem; font-size: 0.8rem; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; color: var(--text-mid); }
.form-control {
  width: 100%;
  min-height: 44px;
  padding: 0.9rem 1rem;
  border: 1.5px solid var(--border);
  border-radius: var(--radius);
  background: var(--white);
  color: var(--text);
  transition: border-color 0.2s ease, box-shadow 0.2s ease;
}
.form-control:focus {
  outline: none;
  border-color: var(--maroon);
  box-shadow: 0 0 0 4px rgba(107,16,32,0.08);
}
.form-text { font-size: 0.875rem; color: var(--text-muted); }
.btn-primary {
  background: var(--maroon);
  border-color: var(--maroon);
  color: var(--white);
}
.btn-primary:hover, .btn-primary:focus {
  background: var(--maroon-deep);
  border-color: var(--maroon-deep);
}
.btn-outline-secondary {
  color: var(--maroon);
  background: transparent;
  border-color: var(--maroon);
}
.btn-outline-secondary:hover, .btn-outline-secondary:focus {
  background: rgba(255,255,255,0.16);
}
.btn-secondary {
  color: var(--maroon);
  background: var(--gold-light);
  border-color: var(--gold);
}
.btn-secondary:hover {
  background: var(--gold);
  color: var(--maroon-deep);
}
.btn-danger { background: var(--red); border-color: var(--red); color: var(--white); }
.btn, .btn-primary, .btn-outline-secondary, .btn-secondary, .btn-danger { border-radius: 999px; padding: 0.85rem 1.3rem; font-weight: 600; letter-spacing: 0.02em; }
.alert {
  border-radius: var(--radius);
  border: 1px solid transparent;
}
.alert-success { background: #F6F7EC; border-color: #D7E3C0; color: #2E4F2F; }
.alert-danger { background: #FDF0F0; border-color: #E8C2C2; color: #7E1E1E; }
.top-nav {
  background: var(--maroon-deep);
  border-bottom: 3px solid var(--gold);
  padding: 0 0.75rem;
}
.nav-inner {
  max-width: 1200px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: 68px;
  gap: 1rem;
}
.nav-logo {
  font-family: var(--font-display);
  color: var(--gold);
  font-size: 1.2rem;
  font-weight: 700;
  letter-spacing: 0.3px;
}
.nav-logo span {
  display: block;
  font-size: 0.75rem;
  color: rgba(253,250,246,0.85);
  letter-spacing: 1.8px;
  text-transform: uppercase;
  font-family: var(--font-body);
  font-weight: 400;
  margin-top: 0.1rem;
}
.nav-links { display: flex; gap: 0.5rem; flex: 1; }
.nav-link {
  padding: 0.85rem 1rem;
  color: rgba(253,250,246,0.75);
  font-family: var(--font-ui);
  font-size: 0.95rem;
  border-bottom: 2px solid transparent;
  transition: all 0.2s ease;
}
.nav-link:hover { color: var(--white); }
.nav-link.active { color: var(--gold); border-bottom-color: var(--gold); }
.nav-user {
  display: flex;
  align-items: center;
  gap: 0.85rem;
  color: rgba(253,250,246,0.82);
  font-family: var(--font-body);
  font-size: 0.95rem;
}
.nav-avatar {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: var(--gold);
  color: var(--maroon-deep);
  display: grid;
  place-items: center;
  font-family: var(--font-display);
  font-size: 0.95rem;
  font-weight: 700;
  border: 2px solid rgba(201,168,76,0.4);
}
.admin-layout { display: flex; min-height: calc(100vh - 68px); }
.sidebar {
  width: 240px;
  background: var(--maroon);
  border-right: 1px solid var(--maroon-mid);
  flex-shrink: 0;
  padding: 28px 0;
}
.sidebar-section { padding: 0 0 20px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 24px; }
.sidebar-section-label { font-size: 0.75rem; letter-spacing: 0.16em; text-transform: uppercase; color: rgba(201,168,76,0.6); margin-bottom: 10px; padding: 0 20px; }
.sidebar-item {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 12px 20px;
  color: rgba(253,250,246,0.72);
  font-size: 0.95rem;
  transition: all 0.2s;
  border-left: 3px solid transparent;
}
.sidebar-item:hover { background: rgba(255,255,255,0.08); color: var(--white); }
.sidebar-item.active {
  background: rgba(201,168,76,0.12);
  color: var(--gold);
  border-left-color: var(--gold);
}
.sidebar-footer { padding: 0 20px; margin-top: 24px; }
.main-content, .main-area { flex: 1; padding: 38px; background: var(--cream); }
.page-header { margin-bottom: 28px; padding-bottom: 20px; border-bottom: 1px solid var(--border-light); }
.page-title { font-family: var(--font-display); font-size: 2rem; font-weight: 600; color: var(--maroon); margin-bottom: 0.35rem; }
.page-subtitle { font-size: 0.95rem; color: var(--text-muted); }
.auth-shell { min-height: 100vh; display: grid; place-items: center; padding: 2rem 1rem; }
.auth-card {
  width: min(100%, 480px);
  background: var(--white);
  border: 1px solid var(--border-light);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow);
  overflow: hidden;
}
.auth-panel { padding: 2rem 2rem 2.5rem; }
.auth-brand { text-align: center; margin-bottom: 1.75rem; }
.brand-mark { width: 56px; height: 56px; margin: 0 auto 1rem; background: var(--gold); border-radius: 18px; display: grid; place-items: center; font-family: var(--font-display); color: var(--maroon-deep); font-weight: 700; }
.auth-title { font-family: var(--font-display); font-size: 1.85rem; letter-spacing: -0.03em; margin-bottom: 0.75rem; color: var(--maroon); }
.auth-copy { color: var(--text-muted); font-size: 0.95rem; max-width: 420px; margin: 0 auto; }
.auth-footer { margin-top: 1.75rem; text-align: center; color: var(--text-muted); font-size: 0.95rem; }
.auth-footer a { color: var(--maroon); font-weight: 600; }
</style>
