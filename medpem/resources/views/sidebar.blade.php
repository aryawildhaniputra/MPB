@php
    use Illuminate\Support\Facades\Auth;
@endphp

<style>
    @media (max-width: 540px) {
        .sidebar {
            width: 100%;
            height: auto;
        }
        .sidebar h2 {
            font-size: 1.5rem;
            text-align: center;
        }
    }
</style>

<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #FFFFFF;
            color: #333333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            font-size: 3rem;
            text-align: center;
        }
        p {
            font-size: 1.2rem;
            text-align: center;
        }
        a {
            display: inline-block;
            margin-top: 5px;
            padding: 10px 20px;
            color: #FFFFFF;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        @media (max-width: 768px) {
            .flex {
                flex-direction: column;
            }
            .w-1/4 {
                width: 100%;
                height: auto;
            }
            .w-3/4 {
                width: 100%;
            }
            .h-screen {
                height: auto;
            }
            .sidebar {
                position: fixed;
                left: 0;
                top: 0;
                height: 100vh;
                z-index: 1000;
            }
            .container {
                /* margin-left: 15%; */
            }
        }
    </style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Feather:wght@700&family=Nunito:wght@800;900&display=swap" rel="stylesheet">

<div class="duolingo-sidebar" id="sidebar">
    <div class="sidebar-logo">
        <div class="mpbing-logo"></div>
    </div>

    <div class="sidebar-menu">
        <a href="{{ route('dashboard') }}" class="sidebar-item {{ request()->is('dashboard') ? 'active' : '' }}" data-title="Dashboard">
            <div class="sidebar-icon bg-gradient-to-br from-orange-400 to-orange-500">
                <i class="fas fa-home"></i>
            </div>
            <span class="sidebar-text">MENU UTAMA</span>
        </a>

        @if(Auth::check() && in_array(Auth::user()->role, ['admin', 'superadmin']))
        <a href="{{ route('admin.users.index') }}" class="sidebar-item {{ request()->is('admin/users*') ? 'active' : '' }}" data-title="Manajemen Pengguna">
            <div class="sidebar-icon bg-gradient-to-br from-green-400 to-green-500">
                <i class="fas fa-users-cog"></i>
            </div>
            <span class="sidebar-text">KELOLA USER</span>
        </a>

        <a href="{{ route('admin.materi.index') }}" class="sidebar-item {{ request()->is('admin/materi*') ? 'active' : '' }}" data-title="Materi Admin">
            <div class="sidebar-icon bg-gradient-to-br from-red-400 to-red-500">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <span class="sidebar-text">KELOLA MATERI</span>
        </a>
        @else
        <a href="{{ route('user.materi.index') }}" class="sidebar-item {{ request()->is('user/materi*') ? 'active' : '' }}" data-title="Materi">
            <div class="sidebar-icon bg-gradient-to-br from-red-400 to-red-500">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <span class="sidebar-text">MATERI BELAJAR</span>
        </a>
        @endif

        <a href="{{ route('belajar.index') }}" class="sidebar-item {{ request()->is('belajar') ? 'active' : '' }}" data-title="Belajar">
            <div class="sidebar-icon bg-gradient-to-br from-blue-400 to-blue-500">
                <i class="fas fa-book-open"></i>
            </div>
            <span class="sidebar-text">BELAJAR SINGKAT</span>
        </a>

        <a href="{{ route('permainan.index') }}" class="sidebar-item {{ request()->is('permainan') ? 'active' : '' }}" data-title="Permainan">
            <div class="sidebar-icon bg-gradient-to-br from-yellow-400 to-yellow-500">
                <i class="fas fa-gamepad"></i>
            </div>
            <span class="sidebar-text">PERMAINAN</span>
        </a>

        <a href="{{ route('leaderboard') }}" class="sidebar-item {{ request()->is('skor') ? 'active' : '' }}" data-title="Papan Peringkat">
            <div class="sidebar-icon bg-gradient-to-br from-purple-400 to-purple-500">
                <i class="fas fa-trophy"></i>
            </div>
            <span class="sidebar-text">PAPAN PERINGKAT</span>
        </a>

        {{-- <a href="#" class="sidebar-item" data-title="Profil">
            <div class="sidebar-icon bg-gradient-to-br from-green-400 to-green-500">
                <i class="fas fa-user"></i>
            </div>
            <span class="sidebar-text">PROFIL</span>
        </a> --}}
    </div>

    <div class="sidebar-toggle-container">
        <div class="sidebar-toggle" id="sidebarToggle">
            <i class="fas fa-chevron-left"></i>
</div>
    </div>
</div>

<style>
    .duolingo-sidebar {
        width: 250px;
        height: 100vh;
        background-color: #142033;
        color: #ffffff;
        display: flex;
        flex-direction: column;
        padding: 1.5rem 1rem;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 40;
        font-family: 'Nunito', sans-serif;
        transition: all 0.3s ease;
    }

    .duolingo-sidebar.collapsed {
        width: 70px;
    }

    .sidebar-toggle-container {
        margin-top: auto;
        display: flex;
        justify-content: center;
        padding-top: 1.5rem;
    }

    .sidebar-toggle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .sidebar-toggle:hover {
        background-color: rgba(255, 255, 255, 0.2);
        transform: scale(1.1);
    }

    .duolingo-sidebar.collapsed .sidebar-toggle i {
        transform: rotate(180deg);
    }

    .sidebar-logo {
        margin-bottom: 2rem;
        padding: 0 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .duolingo-sidebar.collapsed .sidebar-logo {
        transform: scale(0.8);
        margin-bottom: 1.5rem;
    }

    /* Duolingo-style logo styling */
    .mpbing-logo {
        font-family: 'Nunito', sans-serif;
        font-weight: 900;
        font-size: 2.2rem;
        letter-spacing: -0.5px;
        color: white;
        text-align: center;
        position: relative;
        padding-left: 5px;
        padding-right: 5px;
    }

    .mpbing-logo::before {
        content: "MP";
        color: white;
    }

    .mpbing-logo::after {
        content: "Bing";
        color: white;
    }

    .duolingo-sidebar.collapsed .mpbing-logo::after {
        content: "";
    }

    .sidebar-menu {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        flex-grow: 1;
    }

    .sidebar-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        border-radius: 1rem;
        text-decoration: none;
        color: #ffffff;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        font-weight: 700;
        letter-spacing: 0.5px;
        position: relative;
    }

    .sidebar-item:hover {
        background-color: rgba(255, 255, 255, 0.15) !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2) !important;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .sidebar-item.active {
        background-color: #213555;
    }

    /* Enhanced hover for collapsed sidebar */
    .duolingo-sidebar.collapsed .sidebar-item {
        margin: 0.4rem 0;
        border-radius: 0.75rem;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .duolingo-sidebar.collapsed .sidebar-item:hover {
        background-color: rgba(255, 255, 255, 0.15);
        transform: translateY(-2px) scale(1.03);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    /* Enhanced active state for collapsed sidebar */
    .duolingo-sidebar.collapsed .sidebar-item.active {
        background-color: rgba(255, 255, 255, 0.15);
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
        position: relative;
    }

    /* Remove unwanted background effects */
    .duolingo-sidebar.collapsed .sidebar-item.active::before,
    .sidebar-item.active::before {
        content: none !important;
        display: none !important;
    }

    .sidebar-icon {
        width: 40px;
        height: 40px;
        min-width: 40px; /* Ensure fixed width */
        min-height: 40px; /* Ensure fixed height */
        max-width: 40px; /* Enforce maximum width */
        max-height: 40px; /* Enforce maximum height */
        border-radius: 50%; /* Perfect circle */
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        font-size: 1.25rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        position: relative;
        z-index: 1;
        flex-shrink: 0; /* Prevent icon from shrinking */
        aspect-ratio: 1 / 1; /* Ensure perfect circle */
        overflow: hidden; /* Ensure content doesn't overflow */
    }

    .duolingo-sidebar.collapsed .sidebar-icon {
        margin-right: 0;
    }

    /* Enhanced icon appearance when sidebar is collapsed */
    .duolingo-sidebar.collapsed .sidebar-item:hover .sidebar-icon {
        transform: scale(1.1);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
    }

    .duolingo-sidebar.collapsed .sidebar-item.active .sidebar-icon {
        border: 2px solid rgba(255, 255, 255, 0.5);
        transform: scale(1.05);
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
    }

    .sidebar-text {
        font-size: 0.85rem;
        font-weight: 800;
        transition: opacity 0.3s ease;
        white-space: nowrap;
    }

    .duolingo-sidebar.collapsed .sidebar-text {
        opacity: 0;
        width: 0;
        overflow: hidden;
    }

    .duolingo-sidebar.collapsed .sidebar-item {
        justify-content: center;
        padding: 0.75rem 0;
    }

    /* Automatically hide on smaller screens */
    @media (max-width: 768px) {
        .duolingo-sidebar {
            width: 100%;
            height: 65px;
            transform: translateY(0);
            top: auto;
            bottom: 0;
            left: 0;
            right: 0;
            flex-direction: row;
            padding: 0;
            z-index: 50;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar-logo {
            display: none;
        }

        .sidebar-toggle-container {
            display: none;
        }

        .sidebar-menu {
            flex-direction: row;
            width: 100%;
            justify-content: space-around;
            padding: 0;
            margin: 0;
            gap: 0;
            height: 100%;
        }

        .sidebar-item {
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 5px 0;
            width: auto;
            flex: 1;
            margin: 0;
            border-radius: 0;
            height: 100%;
        }

        .sidebar-icon {
            width: 42px;
            height: 42px;
            margin: 0;
            font-size: 1.2rem;
        }

        .sidebar-text {
            display: none; /* Hide text on mobile */
        }

        .sidebar-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            position: relative;
        }

        /* Subtle indicator for active item */
        .sidebar-item.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 3px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 3px 3px 0 0;
        }

        .duolingo-sidebar .sidebar-item::after {
            display: none;
        }

        /* Custom hover effects for mobile */
        .sidebar-item:hover {
            transform: none !important;
            background-color: rgba(255, 255, 255, 0.1) !important;
            box-shadow: none !important;
        }

        .duolingo-sidebar.visible {
            transform: translateY(0);
        }

        .main-content {
            margin-left: 0 !important;
            width: 100% !important;
            padding-bottom: 70px !important; /* Match the height of bottom bar */
        }
    }

    /* Additional media query for very small screens */
    @media (max-width: 480px) {
        .duolingo-sidebar {
            height: 60px;
        }

        .sidebar-icon {
            width: 36px;
            height: 36px;
            font-size: 1.1rem;
        }

        .main-content {
            padding-bottom: 65px !important;
        }
    }

    /* Adjust main content when sidebar is collapsed */
    .main-content {
        transition: all 0.3s ease;
    }

    body.sidebar-collapsed .main-content {
        margin-left: 70px;
        width: calc(100% - 70px);
    }

    /* Additional active indicator for collapsed sidebar */
    .duolingo-sidebar.collapsed .sidebar-item.active::after {
        content: none;
    }

    /* Tooltip for collapsed menu items */
    .duolingo-sidebar.collapsed .sidebar-item::after {
        content: attr(data-title);
        position: absolute;
        left: 70px;
        top: 50%;
        transform: translateY(-50%) scale(0.9);
        background: rgba(33, 53, 85, 0.95);
        color: white;
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 0.85rem;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        pointer-events: none;
        z-index: 100;
        transform-origin: left center;
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .duolingo-sidebar.collapsed .sidebar-item:hover::after {
        opacity: 1;
        visibility: visible;
        transform: translateY(-50%) scale(1);
    }

    /* Fix for JavaScript hover effect */
    .duolingo-sidebar.collapsed .sidebar-item {
        overflow: visible;
    }

    /* Additional active indicator for collapsed sidebar */
    .duolingo-sidebar.collapsed .sidebar-item.active::after {
        content: none;
    }

    /* Make sure tooltip still appears on hover but doesn't conflict with active indicator */
    .duolingo-sidebar.collapsed .sidebar-item.active:hover::after {
        content: attr(data-title);
        position: absolute;
        left: 70px;
        right: auto;
        top: 50%;
        width: auto;
        height: auto;
        background: rgba(33, 53, 85, 0.95);
        color: white;
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 0.85rem;
        opacity: 1;
        visibility: visible;
        transform: translateY(-50%) scale(1);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        z-index: 100;
        pointer-events: none;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const mainContentElements = document.querySelectorAll('.main-content');
        const sidebarItems = document.querySelectorAll('.sidebar-item');

        // Get page loader if it exists
        const pageLoader = document.getElementById('pageLoader');

        // Check saved state - only apply on desktop
        if (window.innerWidth > 768) {
            const savedState = localStorage.getItem('sidebarCollapsed');
            if (savedState === 'true') {
                sidebar.classList.add('collapsed');
                document.body.classList.add('sidebar-collapsed');
            }
        }

        // Toggle sidebar with smooth animation
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.style.transition = 'all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1)';
                sidebar.classList.toggle('collapsed');
                document.body.classList.toggle('sidebar-collapsed');

                // Save state
                localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
            });
        }

        // Add page transition loading for sidebar menu items
        sidebarItems.forEach(item => {
            // Only add loading for actual navigation links (not buttons/toggles)
            if (item.getAttribute('href') && !item.getAttribute('href').startsWith('#') &&
                item.getAttribute('href') !== 'javascript:void(0)') {
                item.addEventListener('click', function(e) {
                    // Don't show loader for dropdown toggles
                    if (this.classList.contains('dropdown-toggle')) {
                        return;
                    }

                    // Show loader if it exists
                    if (pageLoader) {
                        pageLoader.classList.add('active');

                        // Set flag for next page load
                        sessionStorage.setItem('pageIsLoading', 'true');

                        // Fallback if navigation takes too long
                        setTimeout(() => {
                            if (pageLoader && pageLoader.classList.contains('active')) {
                                pageLoader.classList.remove('active');
                                sessionStorage.removeItem('pageIsLoading');
                            }
                        }, 8000);
                    }
                });
            }
        });

        // Add interaction effects to sidebar items when collapsed
        sidebarItems.forEach(item => {
            // Get the icon element
            const icon = item.querySelector('.sidebar-icon');

            // Mouse enter effect
            item.addEventListener('mouseenter', function() {
                // Apply hover effect regardless of sidebar state
                if (window.innerWidth > 768) {
                    // Add scaling effect to icon with smooth transition
                    if (icon) {
                        icon.style.transition = 'all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
                        icon.style.transform = item.classList.contains('active') ? 'scale(1.05)' : 'scale(1.1)';
                        // Apply shadow but avoid excessive glow
                        item.style.boxShadow = item.classList.contains('active') ?
                            '0 0 10px rgba(255, 255, 255, 0.1)' : '0 5px 15px rgba(0, 0, 0, 0.2)';
                    }

                    // Background effect for hover
                    item.style.backgroundColor = 'rgba(255, 255, 255, 0.15)';
                    item.style.transform = 'translateY(-2px)';
                }
            });

            // Mouse leave effect
            item.addEventListener('mouseleave', function() {
                if (window.innerWidth > 768) {
                    // Reset transition to original speed
                    if (icon) {
                        icon.style.transition = 'all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1)';
                        icon.style.transform = item.classList.contains('active') ? 'scale(1.05)' : 'scale(1)';
                        item.style.boxShadow = item.classList.contains('active') ?
                            '0 0 10px rgba(255, 255, 255, 0.1)' : 'none';
                    }

                    // Reset background and transform
                    if (!item.classList.contains('active')) {
                        item.style.backgroundColor = '';
                        item.style.transform = '';
                    }
                }
            });
        });

        // Handle responsive behavior
        function handleResponsive() {
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('collapsed');
                document.body.classList.remove('sidebar-collapsed');

                // Remove any mobile menu toggle button if it exists
                const existingMobileToggle = document.querySelector('.mobile-menu-toggle');
                if (existingMobileToggle) {
                    existingMobileToggle.remove();
                }
            } else {
                // Only on desktop restore the saved state
                const savedState = localStorage.getItem('sidebarCollapsed');
                if (savedState === 'true') {
                    sidebar.classList.add('collapsed');
                    document.body.classList.add('sidebar-collapsed');
                } else {
                    sidebar.classList.remove('collapsed');
                    document.body.classList.remove('sidebar-collapsed');
                }
            }
        }

        window.addEventListener('resize', handleResponsive);
        handleResponsive();
    });
</script>
