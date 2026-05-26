<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ember & Spice — Fine Street Food</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
  :root {
    --flame: #E8440A;
    --ember: #C73209;
    --tomato: #D94F2B;
    --amber: #F59E0B;
    --gold: #F2C94C;
    --cream: #FDF8F3;
    --warm-white: #FFFAF5;
    --charcoal: #1C1611;
    --brown: #3D2B1F;
    --muted: #6B5147;
    --soft: #C8A99A;
    --card-bg: #FFFFFF;
    --shadow-sm: 0 2px 12px rgba(28,22,17,0.07);
    --shadow-md: 0 8px 32px rgba(28,22,17,0.12);
    --shadow-lg: 0 20px 60px rgba(28,22,17,0.18);
    --radius: 16px;
    --radius-sm: 10px;
    --radius-pill: 50px;
  }

  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  html { scroll-behavior: smooth; }

  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--cream);
    color: var(--charcoal);
    line-height: 1.6;
    -webkit-font-smoothing: antialiased;
  }

  /* ── NAV ─────────────────────────────────────── */
  nav {
    position: sticky;
    top: 0;
    z-index: 100;
    background: rgba(253,248,243,0.92);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-bottom: 1px solid rgba(200,169,154,0.25);
    padding: 0 clamp(1rem, 5vw, 3rem);
    transition: box-shadow .3s;
  }
  nav.scrolled { box-shadow: var(--shadow-md); }
  .nav-inner {
    max-width: 1320px;
    margin: 0 auto;
    height: 68px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1.5rem;
  }
  .logo {
    display: flex;
    align-items: center;
    gap: .5rem;
    text-decoration: none;
    flex-shrink: 0;
  }
  .logo-icon {
    width: 36px; height: 36px;
    background: linear-gradient(135deg, var(--flame), var(--amber));
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
  }
  .logo-text {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    font-size: 1.25rem;
    color: var(--charcoal);
    line-height: 1.1;
  }
  .logo-text span { color: var(--flame); }
  .nav-center {
    flex: 1;
    max-width: 420px;
    position: relative;
  }
  .nav-search {
    width: 100%;
    padding: .55rem 1rem .55rem 2.6rem;
    border: 1.5px solid rgba(200,169,154,0.4);
    border-radius: var(--radius-pill);
    background: var(--warm-white);
    font-family: 'DM Sans', sans-serif;
    font-size: .875rem;
    color: var(--charcoal);
    outline: none;
    transition: border-color .2s, box-shadow .2s;
  }
  .nav-search:focus {
    border-color: var(--flame);
    box-shadow: 0 0 0 3px rgba(232,68,10,0.1);
  }
  .nav-search-icon {
    position: absolute;
    left: .85rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--soft);
    pointer-events: none;
    font-size: .9rem;
  }
  .nav-actions { display: flex; align-items: center; gap: .75rem; }
  .nav-btn {
    padding: .5rem 1.25rem;
    border-radius: var(--radius-pill);
    font-family: 'DM Sans', sans-serif;
    font-weight: 500;
    font-size: .875rem;
    cursor: pointer;
    border: none;
    transition: all .2s;
    white-space: nowrap;
  }
  .nav-btn-ghost {
    background: transparent;
    color: var(--brown);
    border: 1.5px solid rgba(61,43,31,0.15);
  }
  .nav-btn-ghost:hover { border-color: var(--flame); color: var(--flame); }
  .nav-btn-primary {
    background: linear-gradient(135deg, var(--flame), var(--ember));
    color: white;
    box-shadow: 0 4px 14px rgba(232,68,10,0.35);
  }
  .nav-btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(232,68,10,0.45); }
  .cart-btn {
    position: relative;
    width: 42px; height: 42px;
    border-radius: 50%;
    background: var(--warm-white);
    border: 1.5px solid rgba(200,169,154,0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 1rem;
    transition: all .2s;
    flex-shrink: 0;
  }
  .cart-btn:hover { border-color: var(--flame); background: rgba(232,68,10,0.05); }
  .cart-badge {
    position: absolute;
    top: -4px; right: -4px;
    width: 18px; height: 18px;
    background: var(--flame);
    color: white;
    border-radius: 50%;
    font-size: .65rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid var(--cream);
  }
  .hamburger {
    display: none;
    flex-direction: column;
    gap: 5px;
    cursor: pointer;
    padding: .5rem;
    border: none;
    background: none;
  }
  .hamburger span {
    display: block;
    width: 22px; height: 2px;
    background: var(--charcoal);
    border-radius: 2px;
    transition: all .3s;
  }

  /* ── HERO ─────────────────────────────────────── */
  .hero {
    max-width: 1320px;
    margin: 2rem auto;
    padding: 0 clamp(1rem, 5vw, 3rem);
  }
  .hero-inner {
    background: linear-gradient(120deg, #2A1508 0%, #4A1F0D 50%, #6B2E14 100%);
    border-radius: 24px;
    padding: clamp(2.5rem, 6vw, 4.5rem) clamp(1.5rem, 6vw, 4rem);
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    align-items: center;
    position: relative;
    overflow: hidden;
    min-height: 340px;
  }
  .hero-inner::before {
    content: '';
    position: absolute;
    top: -60px; right: -60px;
    width: 320px; height: 320px;
    background: radial-gradient(circle, rgba(245,158,11,0.2) 0%, transparent 70%);
    pointer-events: none;
  }
  .hero-inner::after {
    content: '';
    position: absolute;
    bottom: -40px; left: 40%;
    width: 200px; height: 200px;
    background: radial-gradient(circle, rgba(232,68,10,0.15) 0%, transparent 70%);
    pointer-events: none;
  }
  .hero-badge {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    background: rgba(245,158,11,0.15);
    border: 1px solid rgba(245,158,11,0.3);
    color: var(--gold);
    padding: .35rem .9rem;
    border-radius: var(--radius-pill);
    font-size: .8rem;
    font-weight: 500;
    letter-spacing: .05em;
    text-transform: uppercase;
    margin-bottom: 1.25rem;
  }
  .hero-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2rem, 4.5vw, 3.25rem);
    font-weight: 900;
    color: white;
    line-height: 1.1;
    margin-bottom: 1rem;
  }
  .hero-title em {
    font-style: italic;
    color: var(--gold);
  }
  .hero-desc {
    color: rgba(255,255,255,0.6);
    font-size: .95rem;
    margin-bottom: 2rem;
    max-width: 420px;
  }
  .hero-actions { display: flex; gap: 1rem; flex-wrap: wrap; }
  .btn-hero-primary {
    padding: .8rem 2rem;
    background: linear-gradient(135deg, var(--flame), var(--amber));
    color: white;
    font-family: 'DM Sans', sans-serif;
    font-weight: 600;
    font-size: .95rem;
    border: none;
    border-radius: var(--radius-pill);
    cursor: pointer;
    box-shadow: 0 6px 24px rgba(232,68,10,0.5);
    transition: all .25s;
  }
  .btn-hero-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 32px rgba(232,68,10,0.6); }
  .btn-hero-ghost {
    padding: .8rem 2rem;
    background: rgba(255,255,255,0.08);
    color: white;
    font-family: 'DM Sans', sans-serif;
    font-weight: 500;
    font-size: .95rem;
    border: 1.5px solid rgba(255,255,255,0.2);
    border-radius: var(--radius-pill);
    cursor: pointer;
    transition: all .25s;
  }
  .btn-hero-ghost:hover { background: rgba(255,255,255,0.14); }
  .hero-visual {
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    z-index: 1;
  }
  .hero-plate {
    width: clamp(200px, 28vw, 300px);
    height: clamp(200px, 28vw, 300px);
    border-radius: 50%;
    background: radial-gradient(circle at 35% 35%, #FF9A5C, #E8440A 60%, #8B2500);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: clamp(5rem, 10vw, 8rem);
    box-shadow: 0 20px 60px rgba(0,0,0,0.5), inset 0 -10px 30px rgba(0,0,0,0.2);
    animation: float 4s ease-in-out infinite;
    position: relative;
  }
  .hero-plate::before {
    content: '';
    position: absolute;
    bottom: -20px;
    left: 50%;
    transform: translateX(-50%);
    width: 70%;
    height: 20px;
    background: rgba(0,0,0,0.3);
    border-radius: 50%;
    filter: blur(8px);
  }
  .hero-stats {
    position: absolute;
    bottom: 2rem; right: 2rem;
    display: flex;
    gap: 1rem;
  }
  .hero-stat {
    background: rgba(255,255,255,0.07);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: var(--radius-sm);
    padding: .7rem 1rem;
    text-align: center;
  }
  .hero-stat-num {
    font-family: 'Playfair Display', serif;
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--gold);
    line-height: 1;
  }
  .hero-stat-label {
    font-size: .7rem;
    color: rgba(255,255,255,0.5);
    text-transform: uppercase;
    letter-spacing: .06em;
    margin-top: .2rem;
  }
  @keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-12px); }
  }

  /* ── MAIN CONTENT ─────────────────────────────── */
  .content {
    max-width: 1320px;
    margin: 0 auto;
    padding: 0 clamp(1rem, 5vw, 3rem);
  }

  /* ── SECTION HEADER ────────────────────────────── */
  .section-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    margin: 2.5rem 0 1.5rem;
    gap: 1rem;
  }
  .section-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.5rem, 3vw, 2rem);
    font-weight: 700;
    color: var(--charcoal);
    line-height: 1.2;
  }
  .section-title span { color: var(--flame); }
  .section-sub {
    color: var(--muted);
    font-size: .875rem;
    margin-top: .25rem;
  }
  .see-all {
    font-size: .875rem;
    font-weight: 500;
    color: var(--flame);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: .3rem;
    white-space: nowrap;
    transition: gap .2s;
  }
  .see-all:hover { gap: .6rem; }

  /* ── PROMO BANNERS ────────────────────────────── */
  .promos {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    margin-bottom: 2.5rem;
  }
  .promo-card {
    border-radius: var(--radius);
    padding: 1.25rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    cursor: pointer;
    transition: transform .25s, box-shadow .25s;
    position: relative;
    overflow: hidden;
  }
  .promo-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-lg); }
  .promo-card-1 { background: linear-gradient(120deg, #FF6B35, #E8440A); color: white; }
  .promo-card-2 { background: linear-gradient(120deg, #F59E0B, #D97706); color: white; }
  .promo-card-3 { background: linear-gradient(120deg, #6B2E14, #3D1A08); color: white; }
  .promo-emoji { font-size: 2.5rem; flex-shrink: 0; }
  .promo-text {}
  .promo-label {
    font-size: .75rem;
    font-weight: 500;
    opacity: .8;
    letter-spacing: .05em;
    text-transform: uppercase;
    margin-bottom: .2rem;
  }
  .promo-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.1rem;
    font-weight: 700;
    line-height: 1.2;
  }
  .promo-card::after {
    content: '→';
    position: absolute;
    right: 1.25rem;
    bottom: 1.25rem;
    font-size: .85rem;
    opacity: .6;
  }

  /* ── SEARCH + FILTERS ─────────────────────────── */
  .search-bar-wrap {
    position: relative;
    margin-bottom: 1.25rem;
  }
  .search-bar {
    width: 100%;
    padding: .9rem 1.25rem .9rem 3.25rem;
    border: 2px solid rgba(200,169,154,0.3);
    border-radius: var(--radius);
    background: white;
    font-family: 'DM Sans', sans-serif;
    font-size: .95rem;
    color: var(--charcoal);
    outline: none;
    box-shadow: var(--shadow-sm);
    transition: border-color .2s, box-shadow .2s;
  }
  .search-bar:focus {
    border-color: var(--flame);
    box-shadow: 0 0 0 4px rgba(232,68,10,0.08);
  }
  .search-bar::placeholder { color: var(--soft); }
  .search-icon {
    position: absolute;
    left: 1.1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--soft);
    font-size: 1.1rem;
    pointer-events: none;
  }
  .search-clear {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(200,169,154,0.3);
    border: none;
    border-radius: 50%;
    width: 22px; height: 22px;
    cursor: pointer;
    color: var(--muted);
    font-size: .7rem;
    display: none;
    align-items: center;
    justify-content: center;
    transition: all .2s;
  }
  .search-clear:hover { background: rgba(232,68,10,0.15); color: var(--flame); }
  .search-bar:not(:placeholder-shown) ~ .search-clear { display: flex; }

  /* ── CATEGORY TABS ────────────────────────────── */
  .categories {
    display: flex;
    gap: .6rem;
    overflow-x: auto;
    padding-bottom: .5rem;
    scrollbar-width: none;
    -ms-overflow-style: none;
    margin-bottom: 2rem;
  }
  .categories::-webkit-scrollbar { display: none; }
  .cat-tab {
    display: flex;
    align-items: center;
    gap: .5rem;
    padding: .6rem 1.25rem;
    border-radius: var(--radius-pill);
    border: 1.5px solid rgba(200,169,154,0.35);
    background: white;
    color: var(--muted);
    font-family: 'DM Sans', sans-serif;
    font-size: .875rem;
    font-weight: 500;
    cursor: pointer;
    white-space: nowrap;
    transition: all .22s;
    box-shadow: var(--shadow-sm);
    flex-shrink: 0;
  }
  .cat-tab:hover { border-color: var(--flame); color: var(--flame); background: rgba(232,68,10,0.04); }
  .cat-tab.active {
    background: linear-gradient(135deg, var(--flame), var(--ember));
    color: white;
    border-color: transparent;
    box-shadow: 0 4px 14px rgba(232,68,10,0.35);
  }
  .cat-tab-icon { font-size: 1rem; }
  .cat-count {
    background: rgba(0,0,0,0.1);
    border-radius: 20px;
    padding: .05rem .45rem;
    font-size: .7rem;
    font-weight: 600;
  }
  .cat-tab.active .cat-count { background: rgba(255,255,255,0.25); }

  /* ── SORT/FILTER ROW ──────────────────────────── */
  .filter-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
  }
  .filter-chips { display: flex; gap: .5rem; flex-wrap: wrap; }
  .chip {
    padding: .38rem .9rem;
    border: 1.5px solid rgba(200,169,154,0.35);
    border-radius: var(--radius-pill);
    background: white;
    color: var(--muted);
    font-size: .8rem;
    font-weight: 500;
    cursor: pointer;
    transition: all .2s;
  }
  .chip:hover { border-color: var(--amber); color: var(--brown); }
  .chip.active-chip { background: rgba(245,158,11,0.1); border-color: var(--amber); color: var(--brown); }
  .sort-select {
    padding: .5rem 2.2rem .5rem 1rem;
    border: 1.5px solid rgba(200,169,154,0.35);
    border-radius: var(--radius-pill);
    background: white;
    font-family: 'DM Sans', sans-serif;
    font-size: .875rem;
    color: var(--brown);
    cursor: pointer;
    outline: none;
    appearance: none;
    -webkit-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%236B5147'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    transition: border-color .2s;
  }
  .sort-select:focus { border-color: var(--flame); }

  /* ── PRODUCT GRID ────────────────────────────── */
  .product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
  }

  /* ── PRODUCT CARD ────────────────────────────── */
  .card {
    background: var(--card-bg);
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: transform .3s cubic-bezier(.34,1.56,.64,1), box-shadow .3s;
    position: relative;
    display: flex;
    flex-direction: column;
    border: 1px solid rgba(200,169,154,0.15);
  }
  .card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); }

  .card-img-wrap {
    position: relative;
    padding-top: 65%;
    overflow: hidden;
    background: linear-gradient(135deg, #FDE8DC, #F9C6AE);
    flex-shrink: 0;
  }
  .card-img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    font-size: 5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform .4s cubic-bezier(.34,1.2,.64,1);
  }
  .card:hover .card-img { transform: scale(1.07); }
  .card-emoji {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: clamp(3rem, 6vw, 4.5rem);
    transition: transform .4s cubic-bezier(.34,1.2,.64,1);
  }
  .card:hover .card-emoji { transform: scale(1.1) rotate(-3deg); }

  .card-badge {
    position: absolute;
    top: .75rem;
    left: .75rem;
    padding: .3rem .7rem;
    border-radius: var(--radius-pill);
    font-size: .7rem;
    font-weight: 700;
    letter-spacing: .04em;
    text-transform: uppercase;
  }
  .badge-hot { background: var(--flame); color: white; }
  .badge-new { background: var(--amber); color: #3D2B1F; }
  .badge-deal { background: #10B981; color: white; }
  .badge-sold { background: rgba(28,22,17,0.65); color: rgba(255,255,255,0.7); }

  .card-fav {
    position: absolute;
    top: .75rem;
    right: .75rem;
    width: 32px; height: 32px;
    border-radius: 50%;
    background: rgba(255,255,255,0.9);
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .85rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.12);
    transition: all .2s;
    opacity: 0;
    transform: scale(.85);
  }
  .card:hover .card-fav { opacity: 1; transform: scale(1); }
  .card-fav:hover { background: white; transform: scale(1.1); }
  .card-fav.active { opacity: 1; }
  .card-fav.active span { color: #E53E3E; }

  .card-body {
    padding: 1.1rem 1.25rem 1.25rem;
    display: flex;
    flex-direction: column;
    flex: 1;
  }
  .card-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: .5rem;
  }
  .card-category {
    font-size: .72rem;
    font-weight: 600;
    color: var(--flame);
    text-transform: uppercase;
    letter-spacing: .07em;
  }
  .card-rating {
    display: flex;
    align-items: center;
    gap: .3rem;
    font-size: .78rem;
    color: var(--muted);
    font-weight: 500;
  }
  .stars { color: var(--amber); font-size: .78rem; letter-spacing: -.05em; }
  .card-name {
    font-family: 'Playfair Display', serif;
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--charcoal);
    margin-bottom: .4rem;
    line-height: 1.25;
  }
  .card-desc {
    font-size: .825rem;
    color: var(--muted);
    line-height: 1.5;
    margin-bottom: .9rem;
    flex: 1;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
  .card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: .75rem;
    margin-top: auto;
  }
  .card-price-wrap {}
  .card-price-original {
    font-size: .75rem;
    color: var(--soft);
    text-decoration: line-through;
    line-height: 1;
  }
  .card-price {
    font-family: 'Playfair Display', serif;
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--charcoal);
    line-height: 1;
  }
  .card-price.discounted { color: var(--ember); }
  .card-price-discount {
    display: inline-block;
    background: rgba(16,185,129,0.12);
    color: #059669;
    font-size: .68rem;
    font-weight: 700;
    padding: .1rem .4rem;
    border-radius: 4px;
    margin-left: .3rem;
  }

  .btn-add {
    display: flex;
    align-items: center;
    gap: .5rem;
    padding: .6rem 1.1rem;
    background: linear-gradient(135deg, var(--flame), var(--ember));
    color: white;
    border: none;
    border-radius: var(--radius-pill);
    font-family: 'DM Sans', sans-serif;
    font-weight: 600;
    font-size: .85rem;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(232,68,10,0.35);
    transition: all .22s;
    white-space: nowrap;
    flex-shrink: 0;
  }
  .btn-add:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(232,68,10,0.5); }
  .btn-add:active { transform: scale(.97); }
  .btn-add.added {
    background: linear-gradient(135deg, #10B981, #059669);
    box-shadow: 0 4px 12px rgba(16,185,129,0.35);
  }
  .btn-add-icon { font-size: 1rem; line-height: 1; }

  /* Sold-out card */
  .card.sold-out .card-img-wrap::after {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(28,22,17,0.5);
  }
  .card.sold-out .btn-add {
    background: rgba(200,169,154,0.3);
    color: var(--muted);
    box-shadow: none;
    cursor: not-allowed;
  }
  .card.sold-out .btn-add:hover { transform: none; box-shadow: none; }

  /* ── PAGINATION ───────────────────────────────── */
  .pagination {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .5rem;
    margin: 1rem 0 4rem;
  }
  .page-btn {
    width: 40px; height: 40px;
    border-radius: var(--radius-sm);
    border: 1.5px solid rgba(200,169,154,0.35);
    background: white;
    color: var(--brown);
    font-family: 'DM Sans', sans-serif;
    font-weight: 500;
    font-size: .9rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all .2s;
    box-shadow: var(--shadow-sm);
  }
  .page-btn:hover { border-color: var(--flame); color: var(--flame); }
  .page-btn.active {
    background: linear-gradient(135deg, var(--flame), var(--ember));
    color: white;
    border-color: transparent;
    box-shadow: 0 4px 12px rgba(232,68,10,0.35);
  }
  .page-btn.wide { width: auto; padding: 0 1rem; gap: .4rem; }
  .page-dots { color: var(--soft); letter-spacing: .15em; }

  /* ── CART DRAWER ──────────────────────────────── */
  .cart-overlay {
    position: fixed;
    inset: 0;
    background: rgba(28,22,17,0.5);
    z-index: 200;
    opacity: 0;
    pointer-events: none;
    transition: opacity .3s;
  }
  .cart-overlay.open { opacity: 1; pointer-events: all; }
  .cart-drawer {
    position: fixed;
    top: 0; right: 0;
    bottom: 0;
    width: min(420px, 100vw);
    background: var(--warm-white);
    z-index: 201;
    transform: translateX(100%);
    transition: transform .35s cubic-bezier(.4,0,.2,1);
    display: flex;
    flex-direction: column;
    box-shadow: var(--shadow-lg);
  }
  .cart-drawer.open { transform: translateX(0); }
  .cart-header {
    padding: 1.5rem 1.5rem 1rem;
    border-bottom: 1px solid rgba(200,169,154,0.25);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-shrink: 0;
  }
  .cart-header h2 {
    font-family: 'Playfair Display', serif;
    font-size: 1.35rem;
    font-weight: 700;
  }
  .cart-close {
    width: 36px; height: 36px;
    border-radius: 50%;
    background: rgba(200,169,154,0.2);
    border: none;
    cursor: pointer;
    font-size: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all .2s;
  }
  .cart-close:hover { background: rgba(232,68,10,0.15); }
  .cart-items { flex: 1; overflow-y: auto; padding: 1rem 1.5rem; }
  .cart-item {
    display: flex;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid rgba(200,169,154,0.15);
  }
  .cart-item-emoji {
    width: 56px; height: 56px;
    border-radius: var(--radius-sm);
    background: linear-gradient(135deg, #FDE8DC, #F9C6AE);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    flex-shrink: 0;
  }
  .cart-item-info { flex: 1; }
  .cart-item-name {
    font-weight: 600;
    font-size: .9rem;
    color: var(--charcoal);
    margin-bottom: .2rem;
  }
  .cart-item-price { font-size: .85rem; color: var(--flame); font-weight: 600; }
  .cart-item-qty {
    display: flex;
    align-items: center;
    gap: .5rem;
    margin-top: .4rem;
  }
  .qty-btn {
    width: 26px; height: 26px;
    border-radius: 50%;
    border: 1.5px solid rgba(200,169,154,0.4);
    background: white;
    cursor: pointer;
    font-size: .85rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all .2s;
    color: var(--brown);
  }
  .qty-btn:hover { border-color: var(--flame); color: var(--flame); }
  .qty-num { font-size: .9rem; font-weight: 600; min-width: 18px; text-align: center; }
  .cart-empty {
    text-align: center;
    padding: 3rem 1rem;
    color: var(--soft);
  }
  .cart-empty-icon { font-size: 3.5rem; margin-bottom: 1rem; }
  .cart-empty p { font-size: .9rem; color: var(--muted); }
  .cart-footer {
    padding: 1.25rem 1.5rem;
    border-top: 1px solid rgba(200,169,154,0.25);
    flex-shrink: 0;
  }
  .cart-total-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: .5rem;
    font-size: .9rem;
    color: var(--muted);
  }
  .cart-total-row.grand {
    font-weight: 700;
    font-size: 1.1rem;
    color: var(--charcoal);
    border-top: 1px solid rgba(200,169,154,0.25);
    padding-top: .75rem;
    margin-top: .5rem;
    margin-bottom: 1.25rem;
  }
  .btn-checkout {
    width: 100%;
    padding: .9rem;
    background: linear-gradient(135deg, var(--flame), var(--ember));
    color: white;
    border: none;
    border-radius: var(--radius-pill);
    font-family: 'DM Sans', sans-serif;
    font-weight: 700;
    font-size: 1rem;
    cursor: pointer;
    box-shadow: 0 6px 20px rgba(232,68,10,0.4);
    transition: all .25s;
  }
  .btn-checkout:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(232,68,10,0.5); }

  /* ── TOAST ────────────────────────────────────── */
  .toast {
    position: fixed;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%) translateY(120%);
    background: var(--charcoal);
    color: white;
    padding: .8rem 1.5rem;
    border-radius: var(--radius-pill);
    font-size: .875rem;
    font-weight: 500;
    box-shadow: var(--shadow-lg);
    z-index: 300;
    transition: transform .35s cubic-bezier(.34,1.56,.64,1);
    white-space: nowrap;
    display: flex;
    align-items: center;
    gap: .6rem;
  }
  .toast.show { transform: translateX(-50%) translateY(0); }

  /* ── FOOTER ───────────────────────────────────── */
  footer {
    background: var(--charcoal);
    color: rgba(255,255,255,0.5);
    text-align: center;
    padding: 2rem clamp(1rem, 5vw, 3rem);
    font-size: .825rem;
  }
  footer span { color: var(--flame); }

  /* ── RESPONSIVE ───────────────────────────────── */
  @media (max-width: 900px) {
    .hero-inner { grid-template-columns: 1fr; text-align: center; }
    .hero-visual { display: none; }
    .hero-actions { justify-content: center; }
    .promos { grid-template-columns: 1fr; }
    .hero-stats { display: none; }
    .nav-center { display: none; }
  }
  @media (max-width: 640px) {
    .hamburger { display: flex; }
    .nav-btn-ghost { display: none; }
    .product-grid { grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 1rem; }
    .filter-row { flex-direction: column; align-items: flex-start; }
  }
  @media (max-width: 420px) {
    .product-grid { grid-template-columns: 1fr 1fr; gap: .75rem; }
    .card-body { padding: .85rem; }
    .card-name { font-size: .95rem; }
    .btn-add { padding: .5rem .75rem; font-size: .78rem; }
    .card-price { font-size: 1.05rem; }
  }
</style>
</head>
<body>

<!-- NAV -->
<nav id="mainNav">
  <div class="nav-inner">
    <a class="logo" href="#">
      <div class="logo-icon">🔥</div>
      <div class="logo-text">Ember<span>&</span>Spice</div>
    </a>
    <div class="nav-center">
      <span class="nav-search-icon">🔍</span>
      <input class="nav-search" type="search" placeholder="Search dishes, cuisines…">
    </div>
    <div class="nav-actions">
      <button class="nav-btn nav-btn-ghost">Sign In</button>
      <button class="nav-btn nav-btn-primary">Order Now</button>
      <button class="cart-btn" id="cartToggle" aria-label="Cart">
        🛒
        <span class="cart-badge" id="cartBadge">0</span>
      </button>
      <button class="hamburger" aria-label="Menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="hero-inner">
    <div class="hero-content">
      <div class="hero-badge">✨ &nbsp;Daily Special — Free Delivery</div>
      <h1 class="hero-title">Crafted with <em>Fire</em>,<br>Served with <em>Soul</em></h1>
      <p class="hero-desc">Premium street food elevated — smoky, bold flavours made fresh to order. Pick up in 15 min or delivered hot to your door.</p>
      <div class="hero-actions">
        <button class="btn-hero-primary" onclick="document.querySelector('.content').scrollIntoView({behavior:'smooth'})">Explore Menu 🍽️</button>
        <button class="btn-hero-ghost">Watch Story ▶</button>
      </div>
    </div>
    <div class="hero-visual">
      <div class="hero-plate">🍕</div>
    </div>
    <div class="hero-stats">
      <div class="hero-stat">
        <div class="hero-stat-num">4.9</div>
        <div class="hero-stat-label">Rating</div>
      </div>
      <div class="hero-stat">
        <div class="hero-stat-num">12k+</div>
        <div class="hero-stat-label">Orders</div>
      </div>
      <div class="hero-stat">
        <div class="hero-stat-num">15'</div>
        <div class="hero-stat-label">Delivery</div>
      </div>
    </div>
  </div>
</section>

<!-- MAIN CONTENT -->
<div class="content">

  <!-- PROMOS -->
  <div class="promos">
    <div class="promo-card promo-card-1">
      <span class="promo-emoji">🍕</span>
      <div class="promo-text">
        <div class="promo-label">Limited Time</div>
        <div class="promo-title">Buy 2 Pizzas,<br>Get 1 Free</div>
      </div>
    </div>
    <div class="promo-card promo-card-2">
      <span class="promo-emoji">🥤</span>
      <div class="promo-text">
        <div class="promo-label">Today Only</div>
        <div class="promo-title">Free Drink<br>with any Meal</div>
      </div>
    </div>
    <div class="promo-card promo-card-3">
      <span class="promo-emoji">🚀</span>
      <div class="promo-text">
        <div class="promo-label">Always</div>
        <div class="promo-title">Free Delivery<br>Over ₦5,000</div>
      </div>
    </div>
  </div>

  <!-- SECTION HEADER -->
  <div class="section-header">
    <div>
      <h2 class="section-title">Our <span>Menu</span></h2>
      <p class="section-sub">Handpicked favourites & seasonal specials</p>
    </div>
    <a class="see-all" href="#">View all →</a>
  </div>

  <!-- SEARCH -->
  <div class="search-bar-wrap">
    <span class="search-icon">🔍</span>
    <input class="search-bar" id="mainSearch" type="search" placeholder="Search burgers, jollof rice, pasta…">
    <button class="search-clear" onclick="document.getElementById('mainSearch').value='';filterProducts()">✕</button>
  </div>

  <!-- CATEGORY TABS -->
  <div class="categories" id="catTabs">
    <button class="cat-tab active" data-cat="all">🍽️ All <span class="cat-count">24</span></button>
    <button class="cat-tab" data-cat="pizza">🍕 Pizza <span class="cat-count">5</span></button>
    <button class="cat-tab" data-cat="burger">🍔 Burgers <span class="cat-count">4</span></button>
    <button class="cat-tab" data-cat="rice">🍚 Rice <span class="cat-count">4</span></button>
    <button class="cat-tab" data-cat="chicken">🍗 Chicken <span class="cat-count">3</span></button>
    <button class="cat-tab" data-cat="pasta">🍝 Pasta <span class="cat-count">3</span></button>
    <button class="cat-tab" data-cat="drinks">🥤 Drinks <span class="cat-count">3</span></button>
    <button class="cat-tab" data-cat="dessert">🍰 Desserts <span class="cat-count">2</span></button>
  </div>

  <!-- FILTER ROW -->
  <div class="filter-row">
    <div class="filter-chips">
      <button class="chip active-chip" data-filter="all">All Items</button>
      <button class="chip" data-filter="popular">🔥 Popular</button>
      <button class="chip" data-filter="new">✨ New</button>
      <button class="chip" data-filter="deals">💰 Deals</button>
      <button class="chip" data-filter="veg">🥦 Veg</button>
    </div>
    <select class="sort-select">
      <option>Sort: Featured</option>
      <option>Price: Low–High</option>
      <option>Price: High–Low</option>
      <option>Highest Rated</option>
    </select>
  </div>

  <!-- PRODUCT GRID -->
  <div class="product-grid" id="productGrid"></div>

  <!-- PAGINATION -->
  <div class="pagination">
    <button class="page-btn wide">← Prev</button>
    <button class="page-btn active">1</button>
    <button class="page-btn">2</button>
    <button class="page-btn">3</button>
    <span class="page-dots">…</span>
    <button class="page-btn">8</button>
    <button class="page-btn wide">Next →</button>
  </div>

</div><!-- /content -->

<!-- FOOTER -->
<footer>
  <p>© 2026 <span>Ember & Spice</span> · Made with 🔥 in Lagos · All rights reserved</p>
</footer>

<!-- CART DRAWER -->
<div class="cart-overlay" id="cartOverlay" onclick="toggleCart()"></div>
<div class="cart-drawer" id="cartDrawer">
  <div class="cart-header">
    <h2>🛒 Your Order</h2>
    <button class="cart-close" onclick="toggleCart()">✕</button>
  </div>
  <div class="cart-items" id="cartItems">
    <div class="cart-empty" id="cartEmpty">
      <div class="cart-empty-icon">🍽️</div>
      <strong style="color:var(--charcoal);display:block;margin-bottom:.4rem">Nothing here yet</strong>
      <p>Add items from the menu to get started!</p>
    </div>
  </div>
  <div class="cart-footer">
    <div class="cart-total-row"><span>Subtotal</span><span id="subtotal">₦0</span></div>
    <div class="cart-total-row"><span>Delivery</span><span>₦500</span></div>
    <div class="cart-total-row grand"><span>Total</span><span id="grandTotal">₦500</span></div>
    <button class="btn-checkout">Checkout →</button>
  </div>
</div>

<!-- TOAST -->
<div class="toast" id="toast"></div>

<script>
const products = [
  { id:1, name:"Smoky Pepperoni Pizza", desc:"Wood-fired crust, house tomato, triple pepperoni, fresh basil", price:4200, original:null, emoji:"🍕", cat:"pizza", badge:"hot", rating:4.9, reviews:312, tag:"popular" },
  { id:2, name:"BBQ Chicken Pizza", desc:"Tangy BBQ sauce, pulled chicken, jalapeños, mozzarella", price:4500, original:5000, emoji:"🍕", cat:"pizza", badge:"deal", rating:4.8, reviews:198, tag:"deals" },
  { id:3, name:"Margherita Classic", desc:"San Marzano tomato, buffalo mozzarella, fresh basil oil", price:3800, original:null, emoji:"🍕", cat:"pizza", badge:null, rating:4.7, reviews:144, tag:"veg" },
  { id:4, name:"Truffle Mushroom Pizza", desc:"White sauce, wild mushrooms, truffle oil, parmesan shavings", price:5200, original:null, emoji:"🍕", cat:"pizza", badge:"new", rating:4.9, reviews:67, tag:"new" },
  { id:5, name:"Volcano Burger", desc:"Double smash patty, molten cheddar, caramelised onions, ember sauce", price:3600, original:null, emoji:"🍔", cat:"burger", badge:"hot", rating:4.8, reviews:421, tag:"popular" },
  { id:6, name:"Crispy Chicken Burger", desc:"Buttermilk fried thigh, pickles, sriracha mayo, brioche bun", price:3200, original:3800, emoji:"🍔", cat:"burger", badge:"deal", rating:4.7, reviews:283, tag:"deals" },
  { id:7, name:"Truffle Smash Burger", desc:"Wagyu patty, truffle aioli, arugula, caramelised onion jam", price:4800, original:null, emoji:"🍔", cat:"burger", badge:"new", rating:4.9, reviews:54, tag:"new" },
  { id:8, name:"Classic Beef Burger", desc:"100% beef, lettuce, tomato, cheddar, house thousand island", price:2800, original:null, emoji:"🍔", cat:"burger", badge:null, rating:4.5, reviews:189, tag:"popular" },
  { id:9, name:"Smoky Jollof Rice", desc:"Party-style jollof, slow-cooked with spiced tomato base & herbs", price:2500, original:null, emoji:"🍚", cat:"rice", badge:"hot", rating:4.9, reviews:534, tag:"popular" },
  { id:10, name:"Fried Rice & Chicken", desc:"Wok-fried egg rice, crispy chicken, garden vegetables", price:2800, original:null, emoji:"🍳", cat:"rice", badge:null, rating:4.7, reviews:312, tag:"popular" },
  { id:11, name:"Coconut Rice & Stew", desc:"Fragrant coconut rice, slow-cooked beef stew, fried plantain", price:3100, original:null, emoji:"🥥", cat:"rice", badge:null, rating:4.6, reviews:178, tag:"veg" },
  { id:12, name:"Ofada Rice & Sauce", desc:"Local ofada rice, designer sauce, assorted meat — authentic taste", price:3400, original:null, emoji:"🌿", cat:"rice", badge:"new", rating:4.8, reviews:89, tag:"new" },
  { id:13, name:"Grilled Suya Chicken", desc:"Spiced suya seasoning, whole grilled chicken, pepper sauce", price:5800, original:null, emoji:"🍗", cat:"chicken", badge:"hot", rating:4.9, reviews:267, tag:"popular" },
  { id:14, name:"Peri-Peri Wings", desc:"12 crispy wings, signature peri-peri glaze, blue cheese dip", price:3800, original:4200, emoji:"🍗", cat:"chicken", badge:"deal", rating:4.8, reviews:341, tag:"deals" },
  { id:15, name:"Honey Garlic Thighs", desc:"Glazed chicken thighs, roasted garlic mash, crispy skin", price:4100, original:null, emoji:"🍗", cat:"chicken", badge:null, rating:4.6, reviews:156, tag:"popular" },
  { id:16, name:"Carbonara Royale", desc:"Guanciale, egg yolk, pecorino, freshly cracked pepper, spaghetti", price:4200, original:null, emoji:"🍝", cat:"pasta", badge:"hot", rating:4.8, reviews:198, tag:"popular" },
  { id:17, name:"Bolognese Classico", desc:"Six-hour slow-cooked meat ragù, fresh tagliatelle, grana padano", price:4000, original:null, emoji:"🍝", cat:"pasta", badge:null, rating:4.7, reviews:163, tag:"popular" },
  { id:18, name:"Prawn Aglio Olio", desc:"Tiger prawns, garlic, chilli flakes, lemon zest, al dente linguine", price:5100, original:null, emoji:"🦐", cat:"pasta", badge:"new", rating:4.9, reviews:72, tag:"new" },
  { id:19, name:"Tropical Fruit Punch", desc:"Fresh mango, pineapple, passion fruit, hint of chilli salt rim", price:1200, original:null, emoji:"🥤", cat:"drinks", badge:null, rating:4.7, reviews:221, tag:"popular" },
  { id:20, name:"Smoky Tamarind Soda", desc:"Housemade tamarind syrup, soda water, tajín, smoked ice cube", price:1400, original:null, emoji:"🧉", cat:"drinks", badge:"new", rating:4.8, reviews:44, tag:"new" },
  { id:21, name:"Cold Brew Horchata", desc:"Slow-drip cold brew, cinnamon rice milk, dash of vanilla", price:1600, original:null, emoji:"☕", cat:"drinks", badge:null, rating:4.9, reviews:97, tag:"popular" },
  { id:22, name:"Lava Chocolate Cake", desc:"Warm dark chocolate lava, vanilla bean ice cream, caramel drizzle", price:2200, original:null, emoji:"🍫", cat:"dessert", badge:"hot", rating:5.0, reviews:312, tag:"popular" },
  { id:23, name:"Mango Panna Cotta", desc:"Silky Italian cream, fresh mango coulis, toasted coconut flakes", price:1900, original:null, emoji:"🥭", cat:"dessert", badge:"new", rating:4.8, reviews:61, tag:"new" },
  { id:24, name:"Vintage Suya Plate", desc:"Classic suya beef skewers — OUT OF STOCK until Thursday", price:3900, original:null, emoji:"🥩", cat:"rice", badge:"sold", rating:4.9, reviews:489, tag:"popular", soldOut:true }
];

let cart = {};
let activeCategory = 'all';
let activeFilter = 'all';
let searchQuery = '';

function renderProducts() {
  const grid = document.getElementById('productGrid');
  let filtered = products.filter(p => {
    const catMatch = activeCategory === 'all' || p.cat === activeCategory;
    const filterMatch = activeFilter === 'all' || p.tag === activeFilter;
    const searchMatch = !searchQuery || p.name.toLowerCase().includes(searchQuery) || p.desc.toLowerCase().includes(searchQuery);
    return catMatch && filterMatch && searchMatch;
  });

  if (!filtered.length) {
    grid.innerHTML = `<div style="grid-column:1/-1;text-align:center;padding:4rem 1rem;color:var(--soft)">
      <div style="font-size:3rem;margin-bottom:1rem">🍽️</div>
      <strong style="display:block;color:var(--muted);margin-bottom:.4rem">No dishes found</strong>
      <p style="font-size:.875rem">Try a different search or category</p>
    </div>`;
    return;
  }

  grid.innerHTML = filtered.map(p => {
    const inCart = cart[p.id] ? cart[p.id].qty : 0;
    const isFav = false;
    const badgeHtml = p.badge ? `<span class="card-badge badge-${p.badge}">${
      p.badge==='hot'?'🔥 Hot':p.badge==='new'?'✨ New':p.badge==='deal'?'💰 Deal':'😴 Sold Out'}</span>` : '';
    const originalHtml = p.original ? `<div class="card-price-original">₦${p.original.toLocaleString()}</div>` : '';
    const discountHtml = p.original ? `<span class="card-price-discount">-${Math.round((1-p.price/p.original)*100)}%</span>` : '';
    const stars = '★'.repeat(Math.floor(p.rating)) + (p.rating%1>=.5?'½':'');
    const addLabel = p.soldOut ? '✕ Sold Out' : inCart > 0 ? `✓ In Cart (${inCart})` : '+ Add';
    const addClass = p.soldOut ? '' : inCart > 0 ? 'added' : '';

    return `<div class="card${p.soldOut?' sold-out':''}" id="card-${p.id}">
      <div class="card-img-wrap">
        <div class="card-emoji">${p.emoji}</div>
        ${badgeHtml}
        <button class="card-fav${isFav?' active':''}" onclick="toggleFav(${p.id},this)" aria-label="Favourite">
          <span>${isFav?'❤️':'🤍'}</span>
        </button>
      </div>
      <div class="card-body">
        <div class="card-meta">
          <span class="card-category">${p.cat}</span>
          <span class="card-rating"><span class="stars">${stars}</span> ${p.rating} (${p.reviews})</span>
        </div>
        <div class="card-name">${p.name}</div>
        <div class="card-desc">${p.desc}</div>
        <div class="card-footer">
          <div class="card-price-wrap">
            ${originalHtml}
            <div>
              <span class="card-price${p.original?' discounted':''}">₦${p.price.toLocaleString()}</span>
              ${discountHtml}
            </div>
          </div>
          <button class="btn-add ${addClass}" onclick="addToCart(${p.id})" ${p.soldOut?'disabled':''}>
            <span class="btn-add-icon">${p.soldOut?'✕':inCart>0?'✓':'＋'}</span>
            ${p.soldOut?'Sold Out':inCart>0?`Cart (${inCart})`:'Add'}
          </button>
        </div>
      </div>
    </div>`;
  }).join('');
}

function addToCart(id) {
  const p = products.find(x => x.id === id);
  if (!p || p.soldOut) return;
  if (!cart[id]) cart[id] = { ...p, qty: 0 };
  cart[id].qty++;
  updateCartUI();
  renderProducts();
  showToast(`${p.emoji} ${p.name} added to cart!`);
}

function updateCartUI() {
  const total = Object.values(cart).reduce((s,i) => s + i.qty, 0);
  document.getElementById('cartBadge').textContent = total;

  const subtotal = Object.values(cart).reduce((s,i) => s + i.price * i.qty, 0);
  document.getElementById('subtotal').textContent = `₦${subtotal.toLocaleString()}`;
  document.getElementById('grandTotal').textContent = `₦${(subtotal + 500).toLocaleString()}`;

  const el = document.getElementById('cartItems');
  const empty = document.getElementById('cartEmpty');

  if (!total) { empty && (empty.style.display = ''); return; }
  empty && (empty.style.display = 'none');

  const itemsHtml = Object.values(cart).filter(i => i.qty > 0).map(i => `
    <div class="cart-item">
      <div class="cart-item-emoji">${i.emoji}</div>
      <div class="cart-item-info">
        <div class="cart-item-name">${i.name}</div>
        <div class="cart-item-price">₦${i.price.toLocaleString()}</div>
        <div class="cart-item-qty">
          <button class="qty-btn" onclick="changeQty(${i.id},-1)">−</button>
          <span class="qty-num">${i.qty}</span>
          <button class="qty-btn" onclick="changeQty(${i.id},1)">+</button>
        </div>
      </div>
    </div>`).join('');
  el.innerHTML = `<div id="cartEmpty" style="display:none"></div>` + itemsHtml;
}

function changeQty(id, delta) {
  if (!cart[id]) return;
  cart[id].qty = Math.max(0, cart[id].qty + delta);
  if (!cart[id].qty) delete cart[id];
  updateCartUI();
  renderProducts();
}

function toggleFav(id, btn) {
  const isActive = btn.classList.toggle('active');
  btn.querySelector('span').textContent = isActive ? '❤️' : '🤍';
  showToast(isActive ? '❤️ Added to favourites!' : 'Removed from favourites');
}

function toggleCart() {
  document.getElementById('cartOverlay').classList.toggle('open');
  document.getElementById('cartDrawer').classList.toggle('open');
}

function showToast(msg) {
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.classList.add('show');
  clearTimeout(t._to);
  t._to = setTimeout(() => t.classList.remove('show'), 2800);
}

function filterProducts() {
  searchQuery = document.getElementById('mainSearch').value.toLowerCase().trim();
  renderProducts();
}

// Category tabs
document.getElementById('catTabs').addEventListener('click', e => {
  const btn = e.target.closest('.cat-tab');
  if (!btn) return;
  document.querySelectorAll('.cat-tab').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  activeCategory = btn.dataset.cat;
  renderProducts();
});

// Filter chips
document.querySelectorAll('.chip').forEach(chip => {
  chip.addEventListener('click', () => {
    document.querySelectorAll('.chip').forEach(c => c.classList.remove('active-chip'));
    chip.classList.add('active-chip');
    activeFilter = chip.dataset.filter;
    renderProducts();
  });
});

// Search
document.getElementById('mainSearch').addEventListener('input', filterProducts);

// Cart toggle
document.getElementById('cartToggle').addEventListener('click', toggleCart);

// Sticky nav shadow
window.addEventListener('scroll', () => {
  document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 20);
});

// Initial render
renderProducts();
updateCartUI();
</script>
</body>
</html>
