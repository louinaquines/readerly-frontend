
<style>
:root { --sidebar-w: 240px; }

#sidebar {
    position: fixed;
    left: 0; top: 0; bottom: 0;
    width: var(--sidebar-w);
    background: linear-gradient(180deg, #1E3A5F 0%, #1E40AF 100%);
    display: flex;
    flex-direction: column;
    z-index: 100;
    transition: transform .25s ease;
}

#sidebarOverlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.45);
    z-index: 99;
}

#sidebarOverlay.open { display: block; }

#hamburger {
    display: none;
    position: fixed;
    top: 12px;
    left: 12px;
    z-index: 200;
    background: #1E3A5F;
    border: none;
    border-radius: 8px;
    width: 40px;
    height: 40px;
    cursor: pointer;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 5px;
    padding: 0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.3);
}

#hamburger span {
    display: block;
    width: 20px;
    height: 2px;
    background: #fff;
    border-radius: 2px;
    transition: all .2s;
}

@media (max-width: 768px) {
    #hamburger { display: flex; }
    #sidebar { transform: translateX(-100%); }
    #sidebar.open { transform: translateX(0); }
    body { padding-top: 60px; }
    .main { margin-left: 0; }
}
.main {
    margin-left: var(--sidebar-w);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

@media (max-width: 768px) {
    .main {
        margin-left: 0;
    }
}
</style>

<button id="hamburger" aria-label="Open menu">
    <span></span><span></span><span></span>
</button>

<div id="sidebarOverlay"></div>

<aside id="sidebar">
    <div style="padding:1.5rem;border-bottom:1px solid rgba(255,255,255,.1)">
        <div style="font-family:'Baloo 2',cursive;font-size:1.4rem;font-weight:800;color:#fff">
            Reader<span style="color:#F59E0B">ly</span>
        </div>
    </div>

    <nav style="flex:1;padding:1rem .75rem;overflow-y:auto">
        <div style="font-size:.65rem;font-weight:700;color:rgba(255,255,255,.4);letter-spacing:1px;padding:.5rem .75rem;margin-bottom:.25rem">MAIN</div>

        <a href="{{ route('teacher.dashboard') }}" style="display:flex;align-items:center;gap:.75rem;padding:.65rem .75rem;border-radius:10px;color:rgba(255,255,255,.8);text-decoration:none;font-size:.88rem;font-weight:500;transition:all .2s;margin-bottom:.2rem;{{ request()->routeIs('teacher.dashboard') ? 'background:rgba(255,255,255,.12);color:#fff;' : '' }}">
            <x-icon name="home" /> <span>Dashboard</span>
        </a>

        <div style="font-size:.65rem;font-weight:700;color:rgba(255,255,255,.4);letter-spacing:1px;padding:.5rem .75rem;margin-bottom:.25rem">CLASSES</div>

        <a href="{{ route('teacher.classes') }}" style="display:flex;align-items:center;gap:.75rem;padding:.65rem .75rem;border-radius:10px;color:rgba(255,255,255,.8);text-decoration:none;font-size:.88rem;font-weight:500;transition:all .2s;margin-bottom:.2rem;{{ request()->routeIs('teacher.classes') ? 'background:rgba(255,255,255,.12);color:#fff;' : '' }}">
            <x-icon name="school" /> <span>My Classes</span>
        </a>

        <div style="font-size:.65rem;font-weight:700;color:rgba(255,255,255,.4);letter-spacing:1px;padding:.5rem .75rem;margin-bottom:.25rem">REPORTS</div>

        <a href="{{ route('teacher.reports') }}" style="display:flex;align-items:center;gap:.75rem;padding:.65rem .75rem;border-radius:10px;color:rgba(255,255,255,.8);text-decoration:none;font-size:.88rem;font-weight:500;transition:all .2s;margin-bottom:.2rem;{{ request()->routeIs('teacher.reports') ? 'background:rgba(255,255,255,.12);color:#fff;' : '' }}">
            <x-icon name="file-text" /> <span>PDF Reports</span>
        </a>

        <a href="{{ route('teacher.analytics') }}" style="display:flex;align-items:center;gap:.75rem;padding:.65rem .75rem;border-radius:10px;color:rgba(255,255,255,.8);text-decoration:none;font-size:.88rem;font-weight:500;transition:all .2s;margin-bottom:.2rem;{{ request()->routeIs('teacher.analytics') ? 'background:rgba(255,255,255,.12);color:#fff;' : '' }}">
            <x-icon name="bar-chart" /> <span>Analytics</span>
        </a>
    </nav>

    <div style="padding:1rem .75rem;border-top:1px solid rgba(255,255,255,.1)">
        @php $sidebarAvatar = session('user')['avatar'] ?? ''; @endphp
        <a href="{{ route('teacher.profile') }}" style="display:flex;align-items:center;gap:.75rem;padding:.75rem;background:rgba(255,255,255,.08);border-radius:12px;margin-bottom:.75rem;text-decoration:none;color:inherit;transition:background .2s">
            <div style="width:34px;height:34px;border-radius:50%;flex-shrink:0;background:transparent;border:2px solid white;display:flex;align-items:center;justify-content:center;overflow:hidden;">
                @if(!empty($sidebarAvatar) && (str_contains($sidebarAvatar, 'storage') || str_contains($sidebarAvatar, 'avatars/')))
                    <img src="{{ asset('storage/'.$sidebarAvatar) }}" style="width:100%;height:100%;object-fit:cover;">
                @else
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:18px;height:18px;color:rgba(255,255,255,.6)">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
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
                Sign Out
            </button>
        </form>
    </div>
</aside>

<script>
(function () {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const hamburger = document.getElementById('hamburger');

    function openSidebar() {
        sidebar.classList.add('open');
        overlay.classList.add('open');
    }

    function closeSidebar() {
        sidebar.classList.remove('open');
        overlay.classList.remove('open');
    }

    hamburger.addEventListener('click', function () {
        sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
    });

    overlay.addEventListener('click', closeSidebar);

    // Close sidebar on nav link click (mobile UX)
    sidebar.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth <= 768) closeSidebar();
        });
    });
})();
</script>