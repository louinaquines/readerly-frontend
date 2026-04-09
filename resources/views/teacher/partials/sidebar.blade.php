<aside style="position:fixed;left:0;top:0;bottom:0;width:240px;background:#1E3A5F;display:flex;flex-direction:column;z-index:50">
    <div style="padding:1.5rem;border-bottom:1px solid rgba(255,255,255,.1)">
        <div style="font-family:'Baloo 2',cursive;font-size:1.4rem;font-weight:800;color:#fff">Reader<span style="color:#F59E0B">ly</span></div>
    </div>
    <nav style="flex:1;padding:1rem .75rem;overflow-y:auto">
        <div data-lang="nav-main" data-lang-en="MAIN" data-lang-fil="PANGUNAHIN" style="font-size:.65rem;font-weight:700;color:rgba(255,255,255,.4);letter-spacing:1px;padding:.5rem .75rem;margin-bottom:.25rem">MAIN</div>
        <a href="{{ route('teacher.dashboard') }}" style="display:flex;align-items:center;gap:.75rem;padding:.65rem .75rem;border-radius:10px;color:rgba(255,255,255,.8);text-decoration:none;font-size:.88rem;font-weight:500;transition:all .2s;margin-bottom:.2rem;{{ request()->routeIs('teacher.dashboard') ? 'background:rgba(255,255,255,.12);color:#fff;' : '' }}">
            🏠 <span data-lang="nav-dashboard" data-lang-en="Dashboard" data-lang-fil="Dashboard">Dashboard</span>
        </a>
        <div data-lang="nav-classes" data-lang-en="CLASSES" data-lang-fil="MGA KLAS" style="font-size:.65rem;font-weight:700;color:rgba(255,255,255,.4);letter-spacing:1px;padding:.5rem .75rem;margin-bottom:.25rem">CLASSES</div>
        <a href="{{ route('teacher.classes') }}" style="display:flex;align-items:center;gap:.75rem;padding:.65rem .75rem;border-radius:10px;color:rgba(255,255,255,.8);text-decoration:none;font-size:.88rem;font-weight:500;transition:all .2s;margin-bottom:.2rem;{{ request()->routeIs('teacher.classes') ? 'background:rgba(255,255,255,.12);color:#fff;' : '' }}">
            🏫 <span data-lang="nav-my-classes" data-lang-en="My Classes" data-lang-fil="Mga Klas Ko">My Classes</span>
        </a>
        <div data-lang="nav-reports" data-lang-en="REPORTS" data-lang-fil="ULAT" style="font-size:.65rem;font-weight:700;color:rgba(255,255,255,.4);letter-spacing:1px;padding:.5rem .75rem;margin-bottom:.25rem">REPORTS</div>
        <a href="{{ route('teacher.reports') }}" style="display:flex;align-items:center;gap:.75rem;padding:.65rem .75rem;border-radius:10px;color:rgba(255,255,255,.8);text-decoration:none;font-size:.88rem;font-weight:500;transition:all .2s;margin-bottom:.2rem;{{ request()->routeIs('teacher.reports') ? 'background:rgba(255,255,255,.12);color:#fff;' : '' }}">
            📄 <span data-lang="nav-pdf-reports" data-lang-en="PDF Reports" data-lang-fil="PDF na Ulat">PDF Reports</span>
        </a>
        <a href="{{ route('teacher.analytics') }}" style="display:flex;align-items:center;gap:.75rem;padding:.65rem .75rem;border-radius:10px;color:rgba(255,255,255,.8);text-decoration:none;font-size:.88rem;font-weight:500;transition:all .2s;margin-bottom:.2rem;{{ request()->routeIs('teacher.analytics') ? 'background:rgba(255,255,255,.12);color:#fff;' : '' }}">
            📊 <span data-lang="nav-analytics" data-lang-en="Analytics" data-lang-fil="Analitika">Analytics</span>
        </a>
    </nav>
    <div style="padding:1rem .75rem;border-top:1px solid rgba(255,255,255,.1)">
        <a href="{{ route('teacher.profile') }}" style="display:flex;align-items:center;gap:.75rem;padding:.75rem;background:rgba(255,255,255,.08);border-radius:12px;margin-bottom:.75rem;text-decoration:none;color:inherit;transition:background .2s">
<div style="width:34px;height:34px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.8rem;font-weight:800;color:#fff;flex-shrink:0;background:var(--white)">
                @if(session('user.avatar') ?? false)
                  <img src="{{ Storage::url(session('user.avatar')) }}" alt="Avatar" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                @else
                  <svg viewBox="0 0 24 24" fill="currentColor" style="width: 1.5rem; height: 1.5rem; color: rgba(255,255,255,0.6);">
                    <path d="M12 12.713l-1.333-1.333-2.667 2.667V16h8v-2.253l-2.667-2.667zM12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.93 0-3.5-1.57-3.5-3.5s1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5-1.57 3.5-3.5 3.5z"/>
                  </svg>
                @endif
            </div>
            <div style="min-width:0">
                <div style="font-size:.82rem;font-weight:600;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ session('user')['name'] ?? 'Teacher' }}</div>
                <div style="font-size:.7rem;color:rgba(255,255,255,.5)">Teacher</div>
            </div>
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="width:100%;display:flex;align-items:center;justify-content:center;gap:.4rem;padding:.55rem;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);border-radius:9px;color:rgba(255,255,255,.7);font-size:.82rem;font-weight:500;cursor:pointer;transition:all .2s" onmouseover="this.style.background='rgba(255,255,255,.15)'" onmouseout="this.style.background='rgba(255,255,255,.08)'">
                 <span data-lang="nav-sign-out" data-lang-en="Sign Out" data-lang-fil="Mag-Log Out">Sign Out</span>
            </button>
        </form>
    </div>
</aside>
