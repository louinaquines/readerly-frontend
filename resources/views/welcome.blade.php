<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/png" href="{{ asset('build/assets/Readerly logo.png') }}">
<title>Readerly</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700;800&family=DM+Sans:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --yellow:#F59E0B;--yellow-light:#FEF3C7;--yellow-dark:#92400E; --green:#23e90b;
  --orange:#F97316;--orange-light:#FFF7ED;
  --blue:#1E40AF;--blue-mid:#3B82F6;--blue-light:#EFF6FF;--blue-dark:#1E3A5F;
  --teal:#0D9488;--teal-light:#F0FDFA;
  --white:#fff;--gray-50:#F9FAFB;--gray-100:#F3F4F6;--gray-200:#E5E7EB;
  --gray-300:#D1D5DB;--gray-500:#6B7280;--gray-700:#374151;--gray-900:#111827;
  --font-display:'Baloo 2',cursive;--font-body:'DM Sans',sans-serif;
  --radius:16px;--radius-lg:24px;
}
html{scroll-behavior:smooth}
body{font-family:var(--font-body);background:var(--white);color:var(--gray-900);overflow-x:hidden}

/* Skeleton Loading */
.skeleton-loader{position:fixed;inset:0;background:var(--white);z-index:9999;display:flex;flex-direction:column;transition:opacity .4s ease,visibility .4s ease}
.skeleton-loader.hidden{opacity:0;visibility:hidden;pointer-events:none}
.skeleton-nav{height:68px;border-bottom:1px solid var(--gray-100);display:flex;align-items:center;justify-content:space-between;padding:0 clamp(1rem,4vw,2.5rem)}
.skeleton-logo{width:120px;height:24px;background:var(--gray-200);border-radius:4px}
.skeleton-links{display:flex;gap:1.5rem}
.skeleton-link{width:60px;height:16px;background:var(--gray-200);border-radius:4px}
.skeleton-hero{flex:1;display:grid;grid-template-columns:1fr 1fr;gap:clamp(2rem,5vw,5rem);padding:calc(68px + 4rem) clamp(1rem,4vw,2.5rem) 4rem;align-items:center}
.skeleton-content{flex:1}
.skeleton-h1{width:80%;height:48px;background:var(--gray-200);border-radius:8px;margin-bottom:1.25rem}
.skeleton-p{width:100%;height:20px;background:var(--gray-200);border-radius:4px;margin-bottom:2rem}
.skeleton-p2{width:70%;height:20px;background:var(--gray-200);border-radius:4px;margin-bottom:2rem}
.skeleton-btns{display:flex;gap:.85rem}
.skeleton-btn{width:140px;height:44px;background:var(--gray-200);border-radius:50px}
.skeleton-btn2{width:120px;height:44px;background:var(--gray-200);border-radius:50px}
.skeleton-visual{min-height:480px;display:flex;justify-content:center;align-items:center}
.skeleton-card{width:360px;height:320px;background:var(--gray-200);border-radius:28px}
@media(max-width:900px){.skeleton-hero{grid-template-columns:1fr}.skeleton-visual{display:none}}

/* ── NAV ── */
nav{position:fixed;top:0;left:0;right:0;z-index:200;height:68px;padding:0 clamp(1rem,4vw,2.5rem);display:flex;align-items:center;justify-content:space-between;background:rgba(255,255,255,.92);backdrop-filter:blur(18px);-webkit-backdrop-filter:blur(18px);border-bottom:1px solid rgba(0,0,0,.06);transition:box-shadow .3s}
nav.scrolled{box-shadow:0 4px 24px rgba(0,0,0,.08)}
.nav-logo{font-family:var(--font-display);font-size:1.5rem;font-weight:800;color:var(--blue-dark);text-decoration:none;letter-spacing:-.5px;display:flex;align-items:center;gap:.35rem; margin-left:1rem}
.nav-logo span{color: var(--yellow); margin-left: -.30rem;}
.nav-links{display:flex;align-items:center;gap:1.8rem;list-style:none}
.nav-links a{font-size:.875rem;font-weight:500;color:var(--gray-600,#4B5563);text-decoration:none;transition:color .2s}
.nav-links a:hover{color:var(--yellow)}
.nav-cta{display:flex;gap:.6rem;align-items:center}

/* hamburger */
.nav-hamburger{display:none;flex-direction:column;gap:5px;cursor:pointer;padding:.4rem;border:none;background:transparent}
.nav-hamburger span{display:block;width:22px;height:2px;background:var(--gray-700);border-radius:2px;transition:all .25s}
.nav-hamburger.open span:nth-child(1){transform:translateY(7px) rotate(45deg)}
.nav-hamburger.open span:nth-child(2){opacity:0}
.nav-hamburger.open span:nth-child(3){transform:translateY(-7px) rotate(-45deg)}
.mobile-menu{display:none;position:fixed;top:68px;left:0;right:0;background:rgba(255,255,255,.98);backdrop-filter:blur(18px);border-bottom:1px solid rgba(0,0,0,.08);padding:1.2rem clamp(1rem,4vw,2.5rem) 1.5rem;z-index:199;flex-direction:column;gap:.2rem}
.mobile-menu.open{display:flex}
.mobile-menu a{font-size:.95rem;font-weight:500;color:var(--gray-700);text-decoration:none;padding:.7rem 0;border-bottom:1px solid var(--gray-100)}
.mobile-menu a:last-child{border-bottom:none}
.mobile-menu .m-cta{display:flex;gap:.6rem;margin-top:.8rem}

.btn{font-family:var(--font-body);font-weight:600;font-size:.875rem;padding:.55rem 1.25rem;border-radius:50px;border:none;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:.4rem;transition:all .2s;white-space:nowrap}
.btn-outline{background:transparent;border:2px solid var(--blue);color:var(--blue)}
.btn-outline:hover{background:var(--blue);color:#fff}
.btn-primary{background:var(--blue);color:#fff;box-shadow:0 2px 8px rgba(30,64,175,.2)}
.btn-primary:hover{background:var(--blue-dark);transform:translateY(-1px);box-shadow:0 8px 24px rgba(30,64,175,.3)}
.btn-yellow{background:var(--yellow);color:var(--yellow-dark)}
.btn-yellow:hover{background:var(--orange);color:#fff;transform:translateY(-2px);box-shadow:0 8px 24px rgba(249,115,22,.35)}
.btn-lg{padding:.85rem 1.8rem;font-size:.95rem}
.btn-white{background:#fff;color:var(--blue-dark)}
.btn-white:hover{background:var(--gray-100);transform:translateY(-1px)}

/* ── HERO ── */
.hero{min-height:100svh;padding:calc(68px + 4rem) clamp(1rem,4vw,2.5rem) 4rem;display:flex;align-items:center;background:linear-gradient(135deg,#EFF6FF 0%,#FFF7ED 55%,#FFFBEB 100%);position:relative;overflow:hidden}
.hero::before{content:'';position:absolute;top:-120px;right:-120px;width:560px;height:560px;background:radial-gradient(circle,rgba(249,115,22,.12) 0%,transparent 68%);border-radius:50%;pointer-events:none}
.hero::after{content:'';position:absolute;bottom:-80px;left:-80px;width:400px;height:400px;background:radial-gradient(circle,rgba(30,64,175,.07) 0%,transparent 68%);border-radius:50%;pointer-events:none}
.hero-inner{max-width:1200px;margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:clamp(2rem,5vw,5rem);align-items:center;width:100%}
@keyframes pulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.5;transform:scale(1.4)}}
.hero h1{font-family:var(--font-display);font-size:clamp(2.2rem,4.5vw,3.8rem);font-weight:800;line-height:1.1;color:var(--gray-900);margin-bottom:1.25rem;letter-spacing:-1.5px}
.hl-orange{color:var(--orange)}
.hl-blue{color:var(--blue)}
.hero p{font-size:clamp(.9rem,1.5vw,1.02rem);color:var(--gray-500);line-height:1.8;margin-bottom:2rem;max-width:460px}
.hero-actions{display:flex;gap:.85rem;flex-wrap:wrap}
.hero-stats{display:flex;gap:clamp(1.5rem,3vw,2.5rem);margin-top:2.5rem;padding-top:2rem;border-top:1px solid rgba(0,0,0,.08);flex-wrap:wrap}
.stat-num{font-family:var(--font-display);font-size:1.6rem;font-weight:800;color:var(--blue-dark);line-height:1}
.stat-num2{font-family:var(--font-display);font-size:1.6rem;font-weight:800;color:var(--yellow);line-height:1}
.stat-label{font-size:.72rem;color:var(--gray-500);margin-top:.15rem}

/* ── HERO VISUAL (enhanced) ── */
.hero-visual{position:relative;display:flex;justify-content:center;align-items:center;min-height:480px}

/* Orbiting ring decoration */
.hero-ring{position:absolute;width:420px;height:420px;border-radius:50%;border:1.5px dashed rgba(30,64,175,.12);top:50%;left:50%;transform:translate(-50%,-50%);animation:spin 28s linear infinite;pointer-events:none}
.hero-ring-2{position:absolute;width:320px;height:320px;border-radius:50%;border:1px dashed rgba(249,115,22,.15);top:50%;left:50%;transform:translate(-50%,-50%);animation:spin 18s linear infinite reverse;pointer-events:none}
@keyframes spin{from{transform:translate(-50%,-50%) rotate(0deg)}to{transform:translate(-50%,-50%) rotate(360deg)}}

/* Orbit dot markers */
.orbit-dot{position:absolute;width:9px;height:9px;border-radius:50%;top:50%;left:50%}
.orbit-dot-1{background:var(--orange);box-shadow:0 0 0 3px rgba(249,115,22,.2);animation:orbit1 28s linear infinite}
.orbit-dot-2{background:var(--blue-mid);box-shadow:0 0 0 3px rgba(59,130,246,.2);animation:orbit2 18s linear infinite reverse}
@keyframes orbit1{from{transform:translate(-50%,-50%) rotate(0deg) translateX(210px) rotate(0deg)}to{transform:translate(-50%,-50%) rotate(360deg) translateX(210px) rotate(-360deg)}}
@keyframes orbit2{from{transform:translate(-50%,-50%) rotate(0deg) translateX(160px) rotate(0deg)}to{transform:translate(-50%,-50%) rotate(360deg) translateX(160px) rotate(-360deg)}}

/* Main card */
.hero-card-main{background:#fff;border-radius:28px;padding:clamp(1.2rem,2.5vw,1.8rem);box-shadow:0 28px 72px rgba(0,0,0,.1),0 4px 12px rgba(0,0,0,.05);width:100%;max-width:360px;position:relative;z-index:3;animation:float 5s ease-in-out infinite}
@keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-14px)}}

/* Card header */
.card-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.1rem}
.card-header-left{display:flex;align-items:center;gap:.6rem}
.card-avatar{width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,var(--blue),var(--blue-mid));display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-weight:800;font-size:.8rem;color:#fff}
.card-student-name{font-family:var(--font-display);font-size:.88rem;font-weight:700;color:var(--gray-900)}
.card-student-grade{font-size:.7rem;color:var(--gray-500)}
.card-level-badge{background:var(--blue-light);color:var(--blue);font-size:.68rem;font-weight:700;padding:.2rem .55rem;border-radius:50px;letter-spacing:.3px}

/* Passage display */
.passage-display{background:linear-gradient(135deg,#EFF6FF,#F0F9FF);border-radius:14px;padding:1rem 1.1rem;margin-bottom:1rem;border:1px solid rgba(59,130,246,.1)}
.passage-label{display:flex;align-items:center;justify-content:space-between;margin-bottom:.6rem}
.passage-label-text{font-size:.67rem;font-weight:700;color:var(--blue);text-transform:uppercase;letter-spacing:.6px}
.passage-progress-pill{font-size:.65rem;font-weight:700;color:var(--orange);background:rgba(249,115,22,.1);padding:.15rem .45rem;border-radius:50px}
.passage-words{display:flex;flex-wrap:wrap;gap:5px;line-height:1.9}
.word{font-family:var(--font-display);font-size:.92rem;font-weight:600;padding:2px 8px;border-radius:6px;background:#fff;color:var(--gray-500);transition:all .35s;border:1px solid rgba(0,0,0,.04)}
.word.read{background:linear-gradient(135deg,#D1FAE5,#ECFDF5);color:#065F46;border-color:rgba(6,95,70,.12)}
.word.current{background:var(--yellow);color:var(--yellow-dark);transform:scale(1.1);box-shadow:0 4px 12px rgba(245,158,11,.4);border-color:transparent}

/* Waveform animation */
.waveform{display:flex;align-items:center;gap:3px;height:28px;margin:.9rem 0 .7rem}
.waveform-bar{width:3px;border-radius:3px;background:var(--orange);animation:wave 1.2s ease-in-out infinite}
.waveform-bar:nth-child(1){height:8px;animation-delay:0s}
.waveform-bar:nth-child(2){height:18px;animation-delay:.1s}
.waveform-bar:nth-child(3){height:24px;animation-delay:.2s}
.waveform-bar:nth-child(4){height:14px;animation-delay:.3s}
.waveform-bar:nth-child(5){height:22px;animation-delay:.15s}
.waveform-bar:nth-child(6){height:10px;animation-delay:.25s}
.waveform-bar:nth-child(7){height:20px;animation-delay:.05s}
.waveform-bar:nth-child(8){height:16px;animation-delay:.35s}
.waveform-bar:nth-child(9){height:26px;animation-delay:.1s}
.waveform-bar:nth-child(10){height:12px;animation-delay:.2s}
.waveform-bar:nth-child(11){height:20px;animation-delay:.3s}
.waveform-bar:nth-child(12){height:8px;animation-delay:.15s}
@keyframes wave{0%,100%{transform:scaleY(.4);opacity:.5}50%{transform:scaleY(1);opacity:1}}
.waveform-label{font-size:.72rem;color:var(--gray-500);margin-left:auto;font-weight:600;color:var(--orange)}

/* Accuracy section */
.accuracy-section{background:var(--gray-50);border-radius:12px;padding:.8rem .95rem}
.accuracy-row{display:flex;justify-content:space-between;align-items:center;margin-bottom:.5rem}
.accuracy-title{font-size:.72rem;font-weight:600;color:var(--gray-600,#4B5563)}
.accuracy-score{font-family:var(--font-display);font-size:1.05rem;font-weight:800;color:var(--orange)}
.accuracy-bar{background:var(--gray-200);border-radius:50px;height:7px;overflow:hidden}
.accuracy-fill{height:100%;width:0;background:linear-gradient(90deg,#FCD34D,var(--orange));border-radius:50px;animation:fillBar 2.5s 1s ease-out forwards}
@keyframes fillBar{from{width:0}to{width:78%}}

/* Floating badges */
.floating-badge{position:absolute;background:#fff;border-radius:14px;padding:.6rem .85rem;box-shadow:0 8px 28px rgba(0,0,0,.11),0 2px 6px rgba(0,0,0,.07);font-size:.75rem;font-weight:600;display:flex;align-items:center;gap:.45rem;z-index:4;white-space:nowrap}
.badge-1{top:-10px;right:-20px;color:#065F46;animation:float 4s ease-in-out infinite .6s}
.badge-2{bottom:10px;left:-28px;color:var(--blue-dark);animation:float 4s ease-in-out infinite 1.2s}
.badge-3{top:42%;right:-38px;color:#6B21A8;background:linear-gradient(135deg,#fff,#FAF5FF);animation:float 4s ease-in-out infinite .3s}
.badge-icon{width:24px;height:24px;border-radius:7px;display:flex;align-items:center;justify-content:center;font-size:.8rem;flex-shrink:0}

/* AI chip */
.ai-chip{position:absolute;bottom:-20px;right:10px;background:linear-gradient(135deg,var(--blue-dark),var(--blue));color:#fff;font-size:.7rem;font-weight:700;padding:.35rem .75rem;border-radius:50px;display:flex;align-items:center;gap:.35rem;box-shadow:0 4px 16px rgba(30,64,175,.35);z-index:4;animation:float 4s ease-in-out infinite .9s;letter-spacing:.3px}
.ai-chip::before{content:'';width:6px;height:6px;background:#4ADE80;border-radius:50%;animation:pulse 2s infinite}

/* ── SHARED ── */
section{padding:clamp(3.5rem,7vw,6rem) clamp(1rem,4vw,2.5rem)}
.container{max-width:1200px;margin:0 auto}
.section-badge{display:inline-flex;align-items:center;gap:.4rem;font-size:.76rem;font-weight:700;padding:.3rem .85rem;border-radius:50px;margin-bottom:.85rem;letter-spacing:.3px}
.badge-blue{background:var(--blue-light);color:var(--blue)}
.badge-orange{background:var(--orange-light);color:#C2410C}
h2.section-title{font-family:var(--font-display);font-size:clamp(1.75rem,3.5vw,2.7rem);font-weight:800;line-height:1.2;color:var(--gray-900);letter-spacing:-.5px;margin-bottom:.85rem}
.section-sub{font-size:.97rem;color:var(--gray-500);line-height:1.75;max-width:520px}

/* ── ABOUT ── */
.about{background:var(--white)}
.about-grid{display:grid;grid-template-columns:1fr 1fr;gap:clamp(2.5rem,5vw,5rem);align-items:center;margin-top:3rem}
.about-img-box{border-radius:var(--radius-lg);background:linear-gradient(135deg,#DBEAFE,#FEF3C7);padding:2rem;display:flex;flex-direction:column;gap:.9rem}
.about-stat-card{background:#fff;border-radius:14px;padding:1.1rem 1.4rem;box-shadow:0 4px 16px rgba(0,0,0,.06)}
.about-stat-card .num{font-family:var(--font-display);font-size:1.9rem;font-weight:800;color:var(--blue-dark);line-height:1}
.about-stat-card .lbl{font-size:.75rem;color:var(--gray-500);margin-top:.2rem}
.about-content p{font-size:.93rem;color:var(--gray-500);line-height:1.8;margin-bottom:.9rem}
.about-pills{display:flex;flex-wrap:wrap;gap:.5rem;margin-top:1.4rem}
.pill{background:var(--blue-light);color:var(--blue-dark);font-size:.75rem;font-weight:600;padding:.3rem .8rem;border-radius:50px}

/* ── SERVICES ── */
.services{background:var(--gray-50)}
.services-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.25rem;margin-top:3rem}
.service-card{background:#fff;border-radius:20px;padding:1.75rem;border:1.5px solid rgba(0,0,0,.05);transition:all .3s}
.service-card:hover{border-color:rgba(249,115,22,.25);transform:translateY(-5px);box-shadow:0 16px 40px rgba(0,0,0,.08)}
.s-icon{width:48px;height:48px;border-radius:13px;display:flex;align-items:center;justify-content:center;font-size:1.3rem;margin-bottom:1rem}
.s-blue{background:var(--blue-light)}
.s-yellow{background:var(--yellow-light)}
.s-orange{background:var(--orange-light)}
.service-card h4{font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--gray-900);margin-bottom:.4rem}
.service-card p{font-size:.82rem;color:var(--gray-500);line-height:1.65}

/* ── BANNER ── */
.banner{background:linear-gradient(135deg,var(--yellow-dark) 0%,#1E40AF 60%,#0d9488 100%);position:relative;overflow:hidden;padding:clamp(3.5rem,7vw,5.5rem) clamp(1rem,4vw,2.5rem)}
.banner::before{content:'';position:absolute;top:-80px;right:-80px;width:360px;height:360px;background:rgba(249,115,22,.18);border-radius:50%;pointer-events:none}
.banner::after{content:'';position:absolute;bottom:-60px;left:-60px;width:280px;height:280px;background:rgba(255,255,255,.05);border-radius:50%;pointer-events:none}
.banner-inner{max-width:760px;margin:0 auto;text-align:center;position:relative;z-index:1}
.banner-quote{font-size:.75rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--yellow);margin-bottom:1.1rem}
.banner h2{font-family:var(--font-display);font-size:clamp(1.7rem,4vw,2.7rem);font-weight:800;color:#fff;line-height:1.25;margin-bottom:1rem;letter-spacing:-.4px}
.banner h2 span{color:var(--yellow)}
.banner p{color:rgba(255,255,255,.7);font-size:.95rem;line-height:1.75}
.banner-stats{display:flex;justify-content:center;gap:clamp(2rem,5vw,4rem);margin-top:3rem;flex-wrap:wrap}
.bstat .bnum{font-family:var(--font-display);font-size:2.2rem;font-weight:800;color:var(--yellow);line-height:1}
.bstat .blbl{font-size:.75rem;color:rgba(255,255,255,.55);margin-top:.3rem}

/* ── SLIDER ── */
.slider-section{background:#fff;overflow:hidden;padding:clamp(3rem,6vw,5rem) 0}
.slider-header{padding:0 clamp(1rem,4vw,2.5rem);max-width:1200px;margin:0 auto 2.5rem}
.slides-track{display:flex;gap:1.25rem;animation:slide 24s linear infinite;width:max-content;padding:0 clamp(1rem,4vw,2.5rem)}
.slides-track:hover{animation-play-state:paused}
@keyframes slide{from{transform:translateX(0)}to{transform:translateX(-50%)}}
.slide-card{background:var(--gray-50);border-radius:18px;padding:1.4rem;width:240px;flex-shrink:0;border:1.5px solid rgba(0,0,0,.05)}
.slide-img-placeholder{width:100%;height:120px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:2.2rem;margin-bottom:.85rem}
.slide-card h5{font-family:var(--font-display);font-size:.9rem;font-weight:700;color:var(--gray-900);margin-bottom:.3rem}
.slide-card p{font-size:.75rem;color:var(--gray-500);line-height:1.5}

/* ── TESTIMONIALS ── */
.testimonials{background:var(--gray-50)}
.testi-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.25rem;margin-top:3rem}
.testi-card{background:#fff;border-radius:20px;padding:1.75rem;border:1.5px solid rgba(0,0,0,.05);transition:all .3s}
.testi-card:hover{transform:translateY(-4px);box-shadow:0 12px 32px rgba(0,0,0,.08)}
.stars{display:flex;gap:3px;margin-bottom:.9rem}
.star{width:13px;height:13px;background:var(--yellow);border-radius:3px}
.testi-card blockquote{font-size:.86rem;color:var(--gray-700);line-height:1.72;margin-bottom:1.1rem;font-style:italic}
.testi-author{display:flex;align-items:center;gap:.65rem}
.testi-avatar{width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:.8rem;font-weight:700;color:#fff;flex-shrink:0}
.testi-name{font-size:.83rem;font-weight:600;color:var(--gray-900)}
.testi-role{font-size:.72rem;color:var(--gray-500)}

/* ── BLOG ── */
.blog{background:#fff}
.blog-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.25rem;margin-top:3rem}
.blog-card{border-radius:20px;overflow:hidden;border:1.5px solid rgba(0,0,0,.06);transition:all .3s}
.blog-card:hover{transform:translateY(-4px);box-shadow:0 12px 32px rgba(0,0,0,.09)}
.blog-img{height:150px;display:flex;align-items:center;justify-content:center;font-size:2.8rem}
.blog-body{padding:1.25rem}
.blog-tag{display:inline-block;font-size:.7rem;font-weight:700;padding:.22rem .65rem;border-radius:50px;margin-bottom:.65rem}
.blog-card h5{font-family:var(--font-display);font-size:.97rem;font-weight:700;color:var(--gray-900);margin-bottom:.45rem;line-height:1.35}
.blog-card p{font-size:.79rem;color:var(--gray-500);line-height:1.6}
.blog-meta{font-size:.7rem;color:var(--gray-300);margin-top:.65rem}

/* ── CTA BOTTOM ── */
.cta-bottom{background:linear-gradient(135deg,#FFFBEB 0%,#FFF7ED 50%,#FEF3C7 100%);border-top:1px solid rgba(245,158,11,.15)}
.cta-bottom-inner{max-width:680px;margin:0 auto;text-align:center}
.cta-bottom h2{font-family:var(--font-display);font-size:clamp(1.8rem,4vw,2.7rem);font-weight:800;color:var(--gray-900);margin-bottom:.9rem;letter-spacing:-.5px}
.cta-bottom h2 span{color:var(--orange)}
.cta-bottom p{color:var(--gray-500);font-size:.95rem;line-height:1.75;margin-bottom:1.8rem}
.cta-bottom-actions{display:flex;gap:.85rem;justify-content:center;flex-wrap:wrap}

/* ── CONTACT ── */
.contact{background:#fff;padding:clamp(3.5rem,7vw,5.5rem) clamp(1rem,4vw,2.5rem)}
.contact-grid{display:grid;grid-template-columns:1fr 1fr;gap:clamp(2rem,5vw,4rem);align-items:start;margin-top:2.5rem}
.contact-info h3{font-family:var(--font-display);font-size:1.35rem;font-weight:800;color:var(--gray-900);margin-bottom:.85rem}
.contact-info p{font-size:.88rem;color:var(--gray-500);line-height:1.75;margin-bottom:1.4rem}
.contact-item{display:flex;align-items:center;gap:.7rem;margin-bottom:.8rem}
.c-icon{width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:.95rem;flex-shrink:0}
.contact-item span{font-size:.86rem;color:var(--gray-700);font-weight:500}
.contact-form{display:flex;flex-direction:column;gap:.85rem}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:.85rem}
.form-group label{font-size:.75rem;font-weight:600;color:var(--gray-700);display:block;margin-bottom:.32rem}
.form-group input,.form-group textarea,.form-group select{width:100%;padding:.68rem .9rem;border:1.5px solid var(--gray-200);border-radius:10px;font-family:var(--font-body);font-size:.87rem;color:var(--gray-900);background:#fff;transition:border-color .2s;outline:none}
.form-group input:focus,.form-group textarea:focus,.form-group select:focus{border-color:var(--blue-mid);box-shadow:0 0 0 3px rgba(59,130,246,.1)}
.form-group textarea{resize:vertical;min-height:100px}

/* ── FOOTER ── */
footer{background:var(--gray-900);color:rgba(255,255,255,.5);padding:clamp(3rem,6vw,4.5rem) clamp(1rem,4vw,2.5rem) 2rem}
.footer-grid{max-width:1200px;margin:0 auto;display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:clamp(1.5rem,4vw,3rem);padding-bottom:2.5rem;border-bottom:1px solid rgba(255,255,255,.08)}
.footer-brand .logo{font-family:var(--font-display);font-size:1.4rem;font-weight:800;color:#fff;text-decoration:none}
.footer-brand .logo span{color:var(--yellow)}
.footer-brand p{font-size:.8rem;margin-top:.65rem;line-height:1.65}
.footer-social{display:flex;gap:.5rem;margin-top:1.1rem}
.social-btn{width:32px;height:32px;border-radius:8px;background:rgba(255,255,255,.08);display:flex;align-items:center;justify-content:center;font-size:.8rem;text-decoration:none;transition:background .2s}
.social-btn:hover{background:rgba(255,255,255,.16)}
.footer-col h5{font-size:.78rem;font-weight:700;color:#fff;letter-spacing:.5px;text-transform:uppercase;margin-bottom:.9rem}
.footer-col ul{list-style:none;display:flex;flex-direction:column;gap:.5rem}
.footer-col ul a{font-size:.8rem;color:rgba(255,255,255,.45);text-decoration:none;transition:color .2s}
.footer-col ul a:hover{color:var(--yellow)}
.footer-bottom{max-width:1200px;margin:1.5rem auto 0;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:.5rem}
.footer-bottom p{font-size:.73rem}
.footer-legal{display:flex;gap:1.4rem}
.footer-legal a{font-size:.73rem;color:rgba(255,255,255,.35);text-decoration:none;transition:color .2s}
.footer-legal a:hover{color:rgba(255,255,255,.65)}

/* ── REVEAL ── */
.reveal{opacity:0;transform:translateY(24px);transition:opacity .6s ease,transform .6s ease}
.reveal.visible{opacity:1;transform:translateY(0)}
.reveal-delay-1{transition-delay:.1s}
.reveal-delay-2{transition-delay:.2s}
.reveal-delay-3{transition-delay:.3s}

/* ── RESPONSIVE ── */
@media(max-width:1024px){
  .services-grid{grid-template-columns:repeat(2,1fr)}
}
@media(max-width:900px){
  .hero-inner{grid-template-columns:1fr;text-align:center;gap:3rem}
  .hero p,.hero-actions,.hero-stats{margin-left:auto;margin-right:auto}
  .hero-actions,.hero-stats{justify-content:center}
  .hero-visual{display:flex;min-height:auto}
  .hero-ring,.hero-ring-2,.orbit-dot-1,.orbit-dot-2{display:none}
  .floating-badge.badge-3{display:none}
  .hero-card-main{max-width:340px}
  .about-grid,.contact-grid{grid-template-columns:1fr}
  .testi-grid,.blog-grid{grid-template-columns:1fr 1fr}
  .footer-grid{grid-template-columns:1fr 1fr}
  .nav-links{display:none}
  .nav-hamburger{display:flex}
  .nav-cta .btn-outline{display:none}
}
@media(max-width:640px){
  .hero-visual{display:none}
  .services-grid,.testi-grid,.blog-grid,.form-row{grid-template-columns:1fr}
  .footer-grid{grid-template-columns:1fr}
  .banner-stats{gap:1.5rem}
  .hero-stats{gap:1.5rem}
  .hero-actions .btn-lg{width:100%;justify-content:center}
  .cta-bottom-actions .btn-lg{width:100%;justify-content:center}
}
@media(max-width:400px){
  .hero h1{font-size:2rem;letter-spacing:-.5px}
}
</style>
</head>
<body>

<!-- Skeleton Loader -->
<div class="skeleton-loader" id="skeleton">
  <div class="skeleton-nav">
    <div class="skeleton-logo"></div>
    <div class="skeleton-links">
      <div class="skeleton-link"></div>
      <div class="skeleton-link"></div>
      <div class="skeleton-link"></div>
      <div class="skeleton-link"></div>
      <div class="skeleton-link"></div>
    </div>
  </div>
  <div class="skeleton-hero">
    <div class="skeleton-content">
      <div class="skeleton-h1"></div>
      <div class="skeleton-p"></div>
      <div class="skeleton-p2"></div>
      <div class="skeleton-btns">
        <div class="skeleton-btn"></div>
        <div class="skeleton-btn2"></div>
      </div>
    </div>
    <div class="skeleton-visual">
      <div class="skeleton-card"></div>
    </div>
  </div>
</div>

<!-- NAV -->
<nav id="navbar">
  <a href="/" class="nav-logo">Reader<span>ly</span></a>
  <ul class="nav-links">
    <li><a href="/">Home</a></li>
    <li><a href="#about">About</a></li>
    <li><a href="#services">Services</a></li>
    <li><a href="#testimonials">Testimonials</a></li>
    <li><a href="#contact">Contact</a></li>
  </ul>
  <div class="nav-cta">
    <a href="{{ route('login') }}" class="btn btn-outline">Sign In</a>
    <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
    <button class="nav-hamburger" id="hamburger" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

<!-- MOBILE MENU -->
<div class="mobile-menu" id="mobileMenu">
  <a href="/" class="mobile-link">Home</a>
  <a href="#about" class="mobile-link">About</a>
  <a href="#services" class="mobile-link">Services</a>
  <a href="#testimonials" class="mobile-link">Testimonials</a>
  <a href="#contact" class="mobile-link">Contact</a>
  <div class="m-cta">
    <a href="{{ route('login') }}" class="btn btn-outline" style="flex:1;justify-content:center">Sign In</a>
    <a href="{{ route('register') }}" class="btn btn-primary" style="flex:1;justify-content:center">Get Started</a>
  </div>
</div>

<!-- HERO -->
<section class="hero">
  <div class="hero-inner">
    <!-- Left: Content -->
    <div class="hero-content">
      <h1>Reading Made <span class="hl-orange">Fun</span> &<br><span class="hl-blue">Smarter</span> Every Day</h1>
      <p>Readerly helps teachers assess reading skills, track progress in real time, and generate AI-powered stories personalized to each child — in Filipino and English.</p>
      <div class="hero-actions">
        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Start Reading Now →</a>
        <a href="#about" class="btn btn-outline btn-lg">Learn More</a>
      </div>
      <div class="hero-stats">
        <div class="stat-item"><div class="stat-num">AI</div><div class="stat-label">Story Generator</div></div>
        <div class="stat-item"><div class="stat-num">Live</div><div class="stat-label">Progress Tracking</div></div>
        <div class="stat-item"><div class="stat-num2">PH</div><div class="stat-label">Localized Content</div></div>
      </div>
    </div>

    <!-- Right: Enhanced Hero Visual -->
    <div class="hero-visual">
      <!-- Decorative rings -->
      <div class="hero-ring"></div>
      <div class="hero-ring-2"></div>
      <div class="orbit-dot orbit-dot-1"></div>
      <div class="orbit-dot orbit-dot-2"></div>

      <!-- Floating badges -->
      <div class="floating-badge badge-1">
        <div class="badge-icon" style="background:#D1FAE5"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#065F46" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
        78% Accuracy!
      </div>
      <div class="floating-badge badge-2">
        <div class="badge-icon" style="background:#DBEAFE"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#1E40AF" stroke-width="2"><path d="M3 3v18h18"/><path d="M18 9l-5 5-4-4-3 3"/></svg></div>
        Level 2 Unlocked!
      </div>
      <div class="floating-badge badge-3">
        <div class="badge-icon" style="background:#F5F3FF"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#6B21A8" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v8"/><path d="M8 12h8"/></svg></div>
        AI Story Ready
      </div>

      <!-- Main card -->
      <div class="hero-card-main">
        <!-- Card header with student info -->
        <div class="card-header">
          <div class="card-header-left">
            <div class="card-avatar">LJ</div>
            <div>
              <div class="card-student-name">Levi Jake</div>
              <div class="card-student-grade">Grade 6 · Section A</div>
            </div>
          </div>
          <div class="card-level-badge">LVL 2</div>
        </div>

        <!-- Passage display -->
        <div class="passage-display">
          <div class="passage-label">
            <span class="passage-label-text">Today's Passage</span>
            <span class="passage-progress-pill" id="progressPill">4 / 9</span>
          </div>
          <div class="passage-words" id="heroWords">
            <span class="word read">He</span>
            <span class="word read">wants</span>
            <span class="word read">to</span>
            <span class="word current">read</span>
            <span class="word">and</span>
            <span class="word">learn</span>
            <span class="word">in</span>
            <span class="word">Readerly.</span>
          </div>
        </div>

        <!-- Live waveform -->
        <div style="display:flex;align-items:center;gap:.5rem">
          <div class="waveform">
            <div class="waveform-bar"></div>
            <div class="waveform-bar"></div>
            <div class="waveform-bar"></div>
            <div class="waveform-bar"></div>
            <div class="waveform-bar"></div>
            <div class="waveform-bar"></div>
            <div class="waveform-bar"></div>
            <div class="waveform-bar"></div>
            <div class="waveform-bar"></div>
            <div class="waveform-bar"></div>
            <div class="waveform-bar"></div>
            <div class="waveform-bar"></div>
          </div>
          <span style="font-size:.7rem;color:var(--orange);font-weight:600;margin-left:.25rem">● Listening…</span>
        </div>

        <!-- Accuracy section -->
        <div class="accuracy-section">
          <div class="accuracy-row">
            <span class="accuracy-title">Reading Accuracy</span>
            <span class="accuracy-score">78%</span>
          </div>
          <div class="accuracy-bar"><div class="accuracy-fill"></div></div>
        </div>
      </div>

      <!-- AI chip -->
      <div class="ai-chip">AI Powered</div>
    </div>
  </div>
</section>

<!-- ABOUT -->
<section class="about" id="about">
  <div class="container">
    <div class="about-grid">
      <div class="about-img-wrap reveal">
        <div class="about-img-box">
          <div style="text-align:center;padding:.75rem 0"><svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="1.5"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg></div>
          <div class="about-stat-card"><div class="num">1–6</div><div class="lbl">Grade levels supported</div></div>
          <div class="about-stat-card"><div class="num" style="color:var(--orange)">AI</div><div class="lbl">Personalized remedial stories</div></div>
          <div class="about-stat-card"><div class="num">PH</div><div class="lbl">Filipino & English passages</div></div>
        </div>
      </div>
      <div class="about-content reveal reveal-delay-1">
        <div class="section-badge badge-blue">About Readerly</div>
        <h2 class="section-title">Empowering Filipino Readers, One Story at a Time</h2>
        <p>Readerly was built to address a real challenge in Philippine classrooms — identifying and supporting struggling readers early. Our platform gives teachers the tools to assess, track, and intervene with precision.</p>
        <p>Using voice recognition technology and AI-generated stories, we make remedial reading personal, engaging, and effective for every Grade 1 to Grade 6 student.</p>
        <div class="about-pills">
          <span class="pill">Speech Recognition</span>
          <span class="pill">AI Story Generator</span>
          <span class="pill">Real-time Alerts</span>
          <span class="pill">Level-Up System</span>
          <span class="pill">PDF Reports</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SERVICES -->
<section class="services" id="services">
  <div class="container">
    <div class="reveal">
      <div class="section-badge badge-orange">What We Offer</div>
      <h2 class="section-title">Everything Your Classroom Needs</h2>
      <p class="section-sub">From reading assessment to AI-powered remediation — all in one place.</p>
    </div>
    <div class="services-grid">
      <div class="service-card reveal reveal-delay-1"><div class="s-icon s-blue"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1E40AF" stroke-width="2"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg></div><h4>Voice-Based Reading Assessment</h4><p>Students read aloud and our system captures every word using the Web Speech API — detecting errors in Filipino and English.</p></div>
      <div class="service-card reveal reveal-delay-2"><div class="s-icon s-yellow"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#D97706" stroke-width="2"><path d="M3 3v18h18"/><path d="M18 9l-5 5-4-4-3 3"/></svg></div><h4>Live Accuracy Tracking</h4><p>Accuracy scores are calculated instantly after each session, with visual trend charts showing improvement over time.</p></div>
      <div class="service-card reveal reveal-delay-3"><div class="s-icon s-orange"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#C2410C" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M12 8v8"/><path d="M8 12h8"/><circle cx="16" cy="16" r="2"/></svg></div><h4>AI Story Generator</h4><p>After each session, AI crafts a Taglish remedial story specifically targeting the student's missed words and error patterns.</p></div>
      <div class="service-card reveal reveal-delay-1"><div class="s-icon s-blue"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1E40AF" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg></div><h4>Real-time Teacher Alerts</h4><p>Teachers receive instant WebSocket notifications when students complete sessions — color-coded green, yellow, or red.</p></div>
      <div class="service-card reveal reveal-delay-2"><div class="s-icon s-yellow"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#D97706" stroke-width="2"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg></div><h4>Level-Up System</h4><p>Students progress through reading levels after 3 consecutive passing sessions, keeping them motivated and engaged.</p></div>
      <div class="service-card reveal reveal-delay-3"><div class="s-icon s-orange"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#C2410C" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg></div><h4>PDF Report Export</h4><p>Download complete student reading history as a polished PDF — perfect for parent-teacher meetings and school records.</p></div>
    </div>
  </div>
</section>

<!-- BANNER -->
<section class="banner">
  <div class="banner-inner">
    <div class="banner-quote reveal">Our Mission</div>
    <h2 class="reveal reveal-delay-1">Every Filipino child deserves to read with <span>confidence</span> and joy.</h2>
    <p class="reveal reveal-delay-2">We believe the right tools can bridge the reading gap in Philippine classrooms — making assessment smarter and remediation personal.</p>
    <div class="banner-stats reveal reveal-delay-3">
      <div class="bstat"><div class="bnum">6</div><div class="blbl">Grade levels covered</div></div>
      <div class="bstat"><div class="bnum">AI</div><div class="blbl">Personalized stories</div></div>
      <div class="bstat"><div class="bnum">2</div><div class="blbl">Languages supported</div></div>
      <div class="bstat"><div class="bnum">∞</div><div class="blbl">Reading sessions</div></div>
    </div>
  </div>
</section>

<!-- IMAGE SLIDER -->
<section class="slider-section">
  <div class="slider-header reveal">
    <div class="section-badge badge-blue">Platform Highlights</div>
    <h2 class="section-title">See Readerly in Action</h2>
  </div>
  <div style="overflow:hidden">
    <div class="slides-track">
      <div class="slide-card"><div class="slide-img-placeholder" style="background:linear-gradient(135deg,#DBEAFE,#EFF6FF)"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#1E40AF" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8"/><path d="M12 17v4"/></svg></div><h5>Teacher Dashboard</h5><p>Manage classes, assign passages, and monitor every student's progress at a glance.</p></div>
      <div class="slide-card"><div class="slide-img-placeholder" style="background:linear-gradient(135deg,#FFF7ED,#FEF3C7)"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#D97706" stroke-width="1.5"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg></div><h5>Student Reader</h5><p>Kid-friendly reading interface with live word highlighting as the student speaks.</p></div>
      <div class="slide-card"><div class="slide-img-placeholder" style="background:linear-gradient(135deg,#F0FDF4,#DCFCE7)"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#16A34A" stroke-width="1.5"><path d="M3 3v18h18"/><path d="M18 9l-5 5-4-4-3 3"/></svg></div><h5>Accuracy Charts</h5><p>Visual progress charts showing score trends across multiple reading sessions.</p></div>
      <div class="slide-card"><div class="slide-img-placeholder" style="background:linear-gradient(135deg,#F5F3FF,#EDE9FE)"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#7C3AED" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M12 8v8"/><path d="M8 12h8"/><circle cx="16" cy="16" r="2"/></svg></div><h5>AI Story Output</h5><p>Personalized Taglish stories generated after each session targeting specific error words.</p></div>
      <div class="slide-card"><div class="slide-img-placeholder" style="background:linear-gradient(135deg,#FEF2F2,#FFE4E6)"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg></div><h5>PDF Reports</h5><p>One-click export of a student's complete reading history for school records.</p></div>
      <div class="slide-card"><div class="slide-img-placeholder" style="background:linear-gradient(135deg,#FFFBEB,#FEF3C7)"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#D97706" stroke-width="1.5"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg></div><h5>Live Alerts</h5><p>Real-time color-coded notifications arriving on the teacher dashboard instantly.</p></div>
      <!-- duplicated for infinite loop -->
      <div class="slide-card"><div class="slide-img-placeholder" style="background:linear-gradient(135deg,#DBEAFE,#EFF6FF)"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#1E40AF" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8"/><path d="M12 17v4"/></svg></div><h5>Teacher Dashboard</h5><p>Manage classes, assign passages, and monitor every student's progress at a glance.</p></div>
      <div class="slide-card"><div class="slide-img-placeholder" style="background:linear-gradient(135deg,#FFF7ED,#FEF3C7)"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#D97706" stroke-width="1.5"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg></div><h5>Student Reader</h5><p>Kid-friendly reading interface with live word highlighting as the student speaks.</p></div>
      <div class="slide-card"><div class="slide-img-placeholder" style="background:linear-gradient(135deg,#F0FDF4,#DCFCE7)"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#16A34A" stroke-width="1.5"><path d="M3 3v18h18"/><path d="M18 9l-5 5-4-4-3 3"/></svg></div><h5>Accuracy Charts</h5><p>Visual progress charts showing score trends across multiple reading sessions.</p></div>
      <div class="slide-card"><div class="slide-img-placeholder" style="background:linear-gradient(135deg,#F5F3FF,#EDE9FE)"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#7C3AED" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M12 8v8"/><path d="M8 12h8"/><circle cx="16" cy="16" r="2"/></svg></div><h5>AI Story Output</h5><p>Personalized Taglish stories generated after each session targeting specific error words.</p></div>
      <div class="slide-card"><div class="slide-img-placeholder" style="background:linear-gradient(135deg,#FEF2F2,#FFE4E6)"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg></div><h5>PDF Reports</h5><p>One-click export of a student's complete reading history for school records.</p></div>
      <div class="slide-card"><div class="slide-img-placeholder" style="background:linear-gradient(135deg,#FFFBEB,#FEF3C7)"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#D97706" stroke-width="1.5"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg></div><h5>Live Alerts</h5><p>Real-time color-coded notifications arriving on the teacher dashboard instantly.</p></div>
    </div>
  </div>
</section>

<!-- TESTIMONIALS -->
<section class="testimonials" id="testimonials">
  <div class="container">
    <div class="reveal" style="text-align:center">
      <div class="section-badge badge-orange">What Teachers Say</div>
      <h2 class="section-title">Loved by Educators Across the Philippines</h2>
    </div>
    <div class="testi-grid">
      <div class="testi-card reveal reveal-delay-1">
        <div class="stars"><div class="star"></div><div class="star"></div><div class="star"></div><div class="star"></div><div class="star"></div></div>
        <blockquote>"Readerly completely changed how I do reading assessments. I used to spend hours manually checking — now the system does it for me in seconds."</blockquote>
        <div class="testi-author"><div class="testi-avatar" style="background:var(--blue)">JF</div><div><div class="testi-name">Ms. Formoso</div><div class="testi-role">Grade 3 Teacher, Cebu City</div></div></div>
      </div>
      <div class="testi-card reveal reveal-delay-2">
        <div class="stars"><div class="star"></div><div class="star"></div><div class="star"></div><div class="star"></div><div class="star"></div></div>
        <blockquote>"My students actually look forward to their reading sessions now. The AI stories are fun and they don't even realize they're practicing their weak words!"</blockquote>
        <div class="testi-author"><div class="testi-avatar" style="background:var(--orange)">SK</div><div><div class="testi-name">Ms. Kabristante</div><div class="testi-role">Grade 5 Teacher, Davao</div></div></div>
      </div>
      <div class="testi-card reveal reveal-delay-3">
        <div class="stars"><div class="star"></div><div class="star"></div><div class="star"></div><div class="star"></div><div class="star"></div></div>
        <blockquote>"The real-time alerts are a game changer. I can see exactly which students need help the moment they finish reading — no waiting, no guessing."</blockquote>
        <div class="testi-author"><div class="testi-avatar" style="background:#059669">DD</div><div><div class="testi-name">Mr. Diamante</div><div class="testi-role">Reading Specialist, Manila</div></div></div>
      </div>
    </div>
  </div>
</section>

<!-- BLOG -->
<section class="blog" id="blog">
  <div class="container">
    <div class="reveal">
      <div class="section-badge badge-blue">Latest Articles</div>
      <h2 class="section-title">Resources for Educators</h2>
      <p class="section-sub">Tips, research, and guides to help you support your students' reading journey.</p>
    </div>
    <div class="blog-grid">
      <div class="blog-card reveal reveal-delay-1">
        <div class="blog-img" style="background:linear-gradient(135deg,#EFF6FF,#DBEAFE)"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#1E40AF" stroke-width="1.5"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg></div>
        <div class="blog-body">
          <span class="blog-tag" style="background:var(--blue-light);color:var(--blue)">Reading Tips</span>
          <h5>5 Signs Your Student is a Struggling Reader</h5>
          <p>Early identification is key. Learn the most common signs that a Grade 1–3 student needs reading support.</p>
          <div class="blog-meta">June 2025 · 4 min read</div>
        </div>
      </div>
      <div class="blog-card reveal reveal-delay-2">
        <div class="blog-img" style="background:linear-gradient(135deg,#FFF7ED,#FEF3C7)"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#D97706" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M12 8v8"/><path d="M8 12h8"/><circle cx="16" cy="16" r="2"/></svg></div>
        <div class="blog-body">
          <span class="blog-tag" style="background:#FFF7ED;color:#C2410C">AI in Education</span>
          <h5>How AI-Generated Stories Improve Reading Retention</h5>
          <p>Research shows personalized stories targeting specific error patterns can dramatically improve reading fluency.</p>
          <div class="blog-meta">May 2025 · 6 min read</div>
        </div>
      </div>
      <div class="blog-card reveal reveal-delay-3">
        <div class="blog-img" style="background:linear-gradient(135deg,#F0FDF4,#DCFCE7)"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#16A34A" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg></div>
        <div class="blog-body">
          <span class="blog-tag" style="background:#F0FDF4;color:#166534">Filipino Literacy</span>
          <h5>Teaching Filipino and English Reading in the Same Classroom</h5>
          <p>Practical strategies for bilingual reading instruction in Philippine elementary schools.</p>
          <div class="blog-meta">April 2025 · 5 min read</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA BOTTOM -->
<section class="cta-bottom">
  <div class="container">
    <div class="cta-bottom-inner reveal">
      <h2>Ready to <span>Readerly</span> your Students?</h2>
      <p>Join teachers across the Philippines using Readerly to help every child read with confidence — in Filipino and English.</p>
      <div class="cta-bottom-actions">
        <a href="{{ route('register') }}" class="btn btn-yellow btn-lg">Get Started Free →</a>
        <a href="#contact" class="btn btn-outline btn-lg">Contact Us</a>
      </div>
    </div>
  </div>
</section>

<!-- CONTACT -->
<section class="contact" id="contact">
  <div class="container">
    <div class="reveal">
      <div class="section-badge badge-blue">Get in Touch</div>
      <h2 class="section-title">We'd Love to Hear from You</h2>
      <p class="section-sub">Have questions about Readerly for your school? Reach out to us.</p>
    </div>
    <div class="contact-grid">
      <div class="contact-info reveal reveal-delay-1">
        <h3>Contact Information</h3>
        <p>Whether you're a teacher, a principal, or a school administrator, we're here to help you get started with Readerly.</p>
        <div class="contact-item"><div class="c-icon" style="background:var(--blue-light)"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#1E40AF" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div><span>Readerly@school.ph</span></div>
        <div class="contact-item"><div class="c-icon" style="background:var(--yellow-light)"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#D97706" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></div><span>(012) 345 6789</span></div>
        <div class="contact-item"><div class="c-icon" style="background:#F0FDF4"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#16A34A" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div><span>Cebu, Philippines</span></div>
      </div>
      <div class="reveal reveal-delay-2">
        <form class="contact-form">
          <div class="form-row">
            <div class="form-group"><label>First Name</label><input type="text" placeholder="Juan"></div>
            <div class="form-group"><label>Last Name</label><input type="text" placeholder="Dela Cruz"></div>
          </div>
          <div class="form-group"><label>Email Address</label><input type="email" placeholder="juan@school.ph"></div>
          <div class="form-group"><label>Role</label>
            <select><option>Grade School Teacher</option><option>School Principal</option><option>Curriculum Coordinator</option><option>Parent</option><option>Other</option></select>
          </div>
          <div class="form-group"><label>Message</label><textarea placeholder="Tell us about your school or ask us anything..."></textarea></div>
          <button type="submit" class="btn btn-primary btn-lg" style="width:100%;justify-content:center;border-radius:12px">Send Message →</button>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="footer-grid">
    <div class="footer-brand">
      <a href="/" class="logo">Reader<span>ly</span></a>
      <p>A reading assessment platform for Filipino Grade 1–6 students. Powered by voice recognition and AI.</p>
      <div class="footer-social">
        <a href="#" class="social-btn">f</a>
        <a href="#" class="social-btn">t</a>
        <a href="#" class="social-btn">in</a>
        <a href="#" class="social-btn">@</a>
      </div>
    </div>
    <div class="footer-col">
      <h5>Platform</h5>
      <ul>
        <li><a href="{{ route('login') }}">Student Login</a></li>
        <li><a href="{{ route('login') }}">Teacher Login</a></li>
        <li><a href="#services">Features</a></li>
        <li><a href="#about">About</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h5>Resources</h5>
      <ul>
        <li><a href="#blog">Blog</a></li>
        <li><a href="#">Documentation</a></li>
        <li><a href="#">Guides</a></li>
        <li><a href="#contact">Support</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h5>Legal</h5>
      <ul>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Terms of Use</a></li>
        <li><a href="#">Data Protection</a></li>
        <li><a href="#">Cookies</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <p>© {{ date('Y') }} Readerly. All rights reserved.</p>
    <div class="footer-legal">
      <a href="#">Privacy</a>
      <a href="#">Terms</a>
      <a href="#">Sitemap</a>
    </div>
  </div>
</footer>

<script>
// Nav scroll
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => navbar.classList.toggle('scrolled', window.scrollY > 20));

// Mobile menu
const hamburger = document.getElementById('hamburger');
const mobileMenu = document.getElementById('mobileMenu');
hamburger.addEventListener('click', () => {
  hamburger.classList.toggle('open');
  mobileMenu.classList.toggle('open');
});
document.querySelectorAll('.mobile-link,.m-cta a').forEach(a => {
  a.addEventListener('click', () => {
    hamburger.classList.remove('open');
    mobileMenu.classList.remove('open');
  });
});

// Scroll reveal
const observer = new IntersectionObserver(
  entries => entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('visible') }),
  {threshold:.1}
);
document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

// Word animation
const words = document.querySelectorAll('#heroWords .word');
const pill = document.getElementById('progressPill');
let idx = 3;
setInterval(() => {
  words.forEach((w,i) => {
    w.classList.remove('read','current');
    if(i < idx) w.classList.add('read');
    if(i === idx) w.classList.add('current');
  });
  if(pill) pill.textContent = (idx+1) + ' / ' + words.length;
  idx = (idx + 1) % words.length;
  if(idx === 0) idx = 1;
}, 1000);

// Hide skeleton loader (min 2 seconds)
window.addEventListener('load', () => {
  setTimeout(() => {
    const skeleton = document.getElementById('skeleton');
    if(skeleton) skeleton.classList.add('hidden');
    setTimeout(() => { if(skeleton) skeleton.style.display = 'none'; }, 400);
  }, 2000);
});
</script>
</body>
</html>