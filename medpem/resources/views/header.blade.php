<div class="duolingo-header" id="Header">
    <div class="header-content">
        <div class="page-title">
            <button id="mobileMenuButton" class="mobile-menu-button">
                <i class="fas fa-bars"></i>
            </button>
            <h1></h1>
        </div>

        <div class="user-profile">
            {{-- <div class="streak-counter">
                <div class="streak-icon">
                    <i class="fas fa-fire"></i>
                </div>
                <span>3 hari</span>
            </div>

            <div class="gems-counter">
                <div class="gems-icon">
                    <i class="fas fa-gem"></i>
                </div>
                <span>120</span>
            --}}

                                                <div class="user-menu-items" style="display: flex; align-items: center; gap: 16px; margin-right: 10px; height: 70px;">
                <div class="points-counter" style="display: flex; align-items: center; gap: 6px; height: 36px;">
                    <div class="points-icon" style="width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; background: #FFD700; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <i class="fas fa-star" style="font-size: 16px;"></i>
                </div>
                    <span style="font-weight: 700; font-size: 16px; color: #333333; line-height: 36px;">{{ Auth::user()->total_points ?? 0 }}</span>
                </div>
            </div>

            <!-- Dropdown paling sederhana dengan inline style-->
            <div style="position: relative; height: 70px; display: flex; align-items: center;" class="header-dropdown-container">
                <div id="userAvatarControl" class="user-avatar" style="cursor: pointer; position: relative; display: flex; align-items: center; height: 36px;" onclick="document.getElementById('userDropdownDiv').style.display = document.getElementById('userDropdownDiv').style.display === 'block' ? 'none' : 'block'">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random&color=fff&size=128" alt="{{ Auth::user()->name }}" style="border-radius: 50%; width: 36px; height: 36px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <span style="font-weight: 600; color: #333333; font-size: 16px; line-height: 36px;">{{ Auth::user()->name }}</span>
                        <i class="fas fa-chevron-down text-gray-400" style="font-size: 14px;"></i>
                    </div>

                    <!-- Tambahkan overlay transparan untuk menangkap klik -->
                    <div id="avatarClickOverlay" style="position: absolute; top: -15px; left: -15px; right: -15px; bottom: -15px; cursor: pointer;" onclick="var e=event; e.stopPropagation(); document.getElementById('userDropdownDiv').style.display = document.getElementById('userDropdownDiv').style.display === 'block' ? 'none' : 'block';"></div>
                </div>

                <div id="userDropdownDiv" style="display: none; position: absolute; top: 60px; right: 0; width: 280px; background: white; border-radius: 12px; box-shadow: 0 8px 16px rgba(0,0,0,.15); z-index: 1000;">
                    <div style="padding: 16px; display: flex; align-items: center; border-bottom: 1px solid #eee;">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random&color=fff&size=128" alt="{{ Auth::user()->name }}" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 12px;">
                        <div>
                            <h3 style="font-weight: 700; color: #333; font-size: 16px; margin: 0;">{{ Auth::user()->name }}</h3>
                            <p style="color: #666; font-size: 14px; margin: 0;">{{ Auth::user()->username ?? Auth::user()->email }}</p>
                            <p style="color: #f59e0b; font-size: 14px; font-weight: 700; margin-top: 4px;"><i class="fas fa-star" style="margin-right: 4px;"></i> {{ Auth::user()->total_points ?? 0 }} poin</p>
                        </div>
                    </div>
                    <div style="padding: 8px;">
                        <a href="{{ route('achievements.index') }}" style="display: flex; align-items: center; padding: 12px; color: #333; text-decoration: none; border-radius: 8px; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f8f9fa'" onmouseout="this.style.backgroundColor='transparent'">
                            <i class="fas fa-medal" style="width: 20px; margin-right: 12px; color: #14b8a6;"></i>
                            <span>Pencapaian</span>
                        </a>
                        <a href="{{ route('profile') }}" style="display: flex; align-items: center; padding: 12px; color: #333; text-decoration: none; border-radius: 8px; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f8f9fa'" onmouseout="this.style.backgroundColor='transparent'">
                            <i class="fas fa-user" style="width: 20px; margin-right: 12px;"></i>
                        <span>Profil Saya</span>
                    </a>
                        <div style="height: 1px; background-color: #eee; margin: 8px 0;"></div>
                        <a href="#" onclick="event.preventDefault(); showLogoutModal();" style="display: flex; align-items: center; padding: 12px; color: #ef4444; text-decoration: none; border-radius: 8px; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f8f9fa'" onmouseout="this.style.backgroundColor='transparent'">
                            <i class="fas fa-sign-out-alt" style="width: 20px; margin-right: 12px;"></i>
                        <span>Keluar</span>
                    </a>
                    </div>
                </div>
            </div>

            <!-- Script untuk menutup dropdown saat klik di luar -->
            <script>
                // Fungsi toggle dropdown
                function toggleDropdownDebug(event) {
                    if (event) {
                        event.stopPropagation();
                    }

                    var dropdown = document.getElementById('userDropdownDiv');
                    if (dropdown) {
                        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
                    }
                }

                document.addEventListener('click', function(event) {
                    var dropdown = document.getElementById('userDropdownDiv');
                    var control = document.getElementById('userAvatarControl');

                    if (dropdown && dropdown.style.display === 'block' &&
                        !control.contains(event.target) &&
                        !dropdown.contains(event.target)) {
                        dropdown.style.display = 'none';
                    }
                });

                // Hotkey D untuk menampilkan dropdown
                document.addEventListener('keydown', function(event) {
                    // Jangan aktifkan hotkey jika sedang ada input yang difokuskan
                    if (event.target.tagName === 'INPUT' || event.target.tagName === 'TEXTAREA') {
                        return;
                    }

                    if (event.key === 'd' || event.key === 'D') {
                        var dropdown = document.getElementById('userDropdownDiv');
                        if (dropdown) {
                            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
                        }
                    }

                    // Tutup dropdown dengan Escape
                    if (event.key === 'Escape') {
                        var dropdown = document.getElementById('userDropdownDiv');
                        if (dropdown && dropdown.style.display === 'block') {
                            dropdown.style.display = 'none';
                        }
                    }
                });
            </script>
        </div>
    </div>
</div>

<!-- Logout Modal -->
<div id="logoutModal" class="logout-modal">
    <div class="logout-modal-content">
        <span class="close-modal" onclick="hideLogoutModal()">&times;</span>
        <h2>Konfirmasi Keluar</h2>
        <p>Apakah Anda yakin ingin keluar dari aplikasi?</p>
        <div class="modal-buttons">
            <button class="cancel-button" onclick="hideLogoutModal()">Batal</button>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="logout-button">Ya, Keluar</button>
            </form>
        </div>
    </div>
</div>

<!-- Page Transition Loader -->
<div id="pageLoader" class="page-loader">
    <div class="loader-content">
        <div class="spinner-container">
            <div class="spinner"></div>
        </div>
        <p>Memuat...</p>
    </div>
</div>

<style>
    .duolingo-header {
        height: 70px;
        padding: 0 2rem;
        background-color: #ffffff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        position: fixed;
        width: calc(100% - 250px);
        z-index: 999;
        margin-left: 250px;
        top: 0;
        right: 0;
        transition: all 0.3s ease;
    }

    /* Header adjustments for collapsed sidebar */
    .sidebar-collapsed .duolingo-header {
        width: calc(100% - 70px);
        margin-left: 70px;
    }

    /* Mobile menu button */
    .mobile-menu-button {
        display: none;
        background: none;
        border: none;
        font-size: 1.25rem;
        color: #4a5568;
        margin-right: 1rem;
        cursor: pointer;
        padding: 0.5rem;
    }

    /* Main content wrapper adjustment */
    .main-content-wrapper {
        padding-top: 15px; /* Keep some padding for main content */
    }

    .header-content {
        height: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .page-title h1 {
        font-size: 1.75rem;
        font-weight: 800;
        margin: 0;
        letter-spacing: -0.5px;
        display: flex;
        align-items: center;
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 1rem;
        height: 70px;
    }

    .streak-counter, .gems-counter, .points-counter {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 700;
        font-size: 1rem;
        color: #333333;
        height: 36px;
    }

    .streak-icon, .gems-icon, .points-icon {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .streak-icon {
        background: linear-gradient(135deg, #ff9500, #ff5252);
        font-size: 1rem;
    }

    .gems-icon {
        background: linear-gradient(135deg, #36d1dc, #5b86e5);
        font-size: 1rem;
    }

    .points-icon {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        background: #FFD700;
        font-size: 1rem;
    }

    .user-points {
        font-weight: 700;
        font-size: 1.1rem;
        color: #333333;
        margin-left: 0.25rem;
    }

    .user-avatar {
        display: flex;
        align-items: center;
        cursor: pointer;
        padding: 0.5rem;
        border-radius: 2rem;
        transition: all 0.2s;
        position: relative;
        height: 36px;
    }

    .user-avatar:hover {
        background-color: #e2e8f0;
    }

    .user-avatar:hover .fa-chevron-down {
        transform: translateY(2px);
        color: #58CC02;
    }

    .user-avatar img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #e2e8f0;
    }

    .user-name {
        margin-left: 0.75rem;
        font-weight: 600;
        color: #2d3748;
    }

    .user-dropdown {
        position: absolute;
        top: 75px;
        right: 2rem;
        width: 280px;
        background: white;
        border-radius: 1rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        z-index: 9999;
        transition: all 0.2s ease-in-out;
        transform-origin: top right;
        opacity: 1;
        transform: scale(1);
    }

    .user-dropdown.hidden {
        opacity: 0;
        transform: scale(0.95);
        pointer-events: none;
    }

    .hidden {
        display: none !important;
    }

    .dropdown-header {
        padding: 1.25rem;
        display: flex;
        align-items: center;
        border-bottom: 1px solid #f0f4f8;
    }

    .dropdown-header img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 1rem;
    }

    .user-info h3 {
        font-weight: 700;
        color: #2d3748;
        font-size: 1rem;
    }

    .dropdown-body {
        padding: 0.5rem;
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        color: #4a5568;
        text-decoration: none;
        border-radius: 0.5rem;
        transition: background-color 0.2s;
    }

    .dropdown-item:hover {
        background-color: #f7fafc;
    }

    .dropdown-item i {
        width: 20px;
        margin-right: 0.75rem;
    }

    .dropdown-divider {
        height: 1px;
        background-color: #f0f4f8;
        margin: 0.5rem 0;
    }

    @media (max-width: 768px) {
        .duolingo-header {
            width: 100% !important;
            position: fixed;
            padding: 0 1rem;
            height: 60px; /* Smaller on mobile */
            margin-left: 0 !important;
            z-index: 30;
        }

        .mobile-menu-button {
            display: none; /* Hide the mobile menu button as we have bottom navigation now */
        }

        .streak-counter, .gems-counter {
            display: none; /* Hide on smaller screens */
        }

        .points-counter {
            margin-right: 5px;
        }

        .user-name {
            display: none;
        }

        /* Adjust content to account for bottom navigation bar */
        .main-content-wrapper {
            padding-bottom: 65px; /* Space for bottom navigation */
        }

        /* Ensure dropdown appears in correct position on mobile */
        .user-dropdown {
            top: 65px;
            right: 10px;
        }
    }

    /* Very small screens adjustments */
    @media (max-width: 480px) {
        .duolingo-header {
            padding: 0 0.75rem;
            height: 55px;
        }

        .page-title h1 {
            font-size: 1.25rem;
        }

        .points-icon {
            width: 30px;
            height: 30px;
        }

        .user-avatar img {
            width: 32px;
            height: 32px;
        }

        /* Adjust content for smaller bottom bar */
        .main-content-wrapper {
            padding-bottom: 60px;
        }
    }

    /* Logout Modal Styles */
    .logout-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        overflow: auto;
        animation: fadeIn 0.3s;
        align-items: center;
        justify-content: center;
    }

    /* Special blur effect for belajar and materi pages */
    body[data-page-type="belajar"] .logout-modal,
    body[data-page-type="materi"] .logout-modal,
    body[data-page-type="user-materi"] .logout-modal {
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
        background-color: rgba(0, 0, 0, 0.3);
    }

    .logout-modal.active {
        display: flex;
    }

    .logout-modal-content {
        position: relative;
        z-index: 10000;
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border-radius: 10px;
        width: 80%;
        max-width: 400px;
    }

    .close-modal {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 20px;
        color: #718096;
        cursor: pointer;
        transition: all 0.2s;
        padding: 5px;
    }

    .close-modal:hover {
        color: #2d3748;
    }

    .logout-modal h2 {
        margin-top: 0;
        color: #2d3748;
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .logout-modal p {
        color: #4a5568;
        margin-bottom: 25px;
        font-size: 1rem;
    }

    .modal-buttons {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 20px;
    }

    .cancel-button, .logout-button {
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        border: none;
        min-width: 110px;
        font-size: 0.95rem;
    }

    .cancel-button {
        background-color: #f3f4f6;
        color: #4b5563;
    }

    .cancel-button:hover {
        background-color: #e5e7eb;
    }

    .logout-button {
        background-color: #ef4444;
        color: white;
    }

    .logout-button:hover {
        background-color: #dc2626;
    }

    .inline {
        display: inline-block;
        margin: 0;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideDown {
        from { transform: translateY(-30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    /* Media queries for responsive modal */
    @media (max-width: 480px) {
        .logout-modal-content {
            width: 85%;
            margin: 30% auto;
            padding: 20px;
        }
    }

    /* Page Loader Styles */
    .page-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(20, 32, 51, 0.95);
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
        z-index: 99999;
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        pointer-events: all;
    }

    .page-loader.active {
        opacity: 1;
        visibility: visible;
    }

    .loader-content {
        text-align: center;
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    }

    .spinner-container {
        display: flex;
        justify-content: center;
        margin-bottom: 15px;
    }

    .spinner {
        width: 60px;
        height: 60px;
        border: 5px solid rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        border-top: 5px solid #1CB0F6;
        border-left: 5px solid #1CB0F6;
        animation: spin 1s linear infinite;
        box-shadow: 0 0 15px rgba(28, 176, 246, 0.5);
    }

    .page-loader p {
        color: white;
        font-weight: 700;
        font-size: 20px;
        font-family: 'Nunito', sans-serif;
        margin: 0;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .click-hint {
        position: absolute;
        background: rgba(0,0,0,0.8);
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 12px;
        top: -30px;
        right: 0;
        opacity: 0;
        transition: all 0.2s;
        pointer-events: none;
    }

    .user-avatar:hover .click-hint {
        opacity: 1;
        top: -25px;
    }

    /* Style for body when modal is open on belajar and materi pages */
    body.modal-open-blur .main-content {
        filter: blur(5px);
        transition: filter 0.3s ease;
    }
</style>

@include('components.achievement-notification')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ensure the page loader is moved to the end of the body for proper z-index stacking
        const pageLoaderElement = document.getElementById('pageLoader');
        if (pageLoaderElement) {
            document.body.appendChild(pageLoaderElement);
        }

        const sidebar = document.getElementById('sidebar');
        const header = document.getElementById('Header');
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const logoutModal = document.getElementById('logoutModal');
        const pageLoader = document.getElementById('pageLoader');

        // Check if we're coming from another page with the loader active
        if (sessionStorage.getItem('pageIsLoading') === 'true') {
            // Show loader immediately
            document.body.style.overflow = 'hidden'; // Prevent scrolling while loading
            pageLoader.style.display = 'flex'; // Ensure it's displayed
            pageLoader.classList.add('active');

            // Move loader to body if it's not already there
            if (pageLoader.parentNode !== document.body) {
                document.body.appendChild(pageLoader);
            }

            // Clear the flag
            sessionStorage.removeItem('pageIsLoading');

            // Hide loader when page is loaded
            setTimeout(() => {
                pageLoader.classList.remove('active');
                document.body.style.overflow = '';
            }, 700); // Slightly longer delay for smoother appearance
        }

        // Check saved sidebar state and apply to header - only on desktop
        if (window.innerWidth > 768) {
            const savedState = localStorage.getItem('sidebarCollapsed');
            if (savedState === 'true') {
                header.parentElement.classList.add('sidebar-collapsed');
            }
        }

        // Ensure page loader is at root level of document
        if (pageLoader && pageLoader.parentNode !== document.body) {
            document.body.appendChild(pageLoader);
        }

        // Page transition handling for all navigation links
        document.querySelectorAll('a').forEach(link => {
            // Skip links that should not trigger the loader
            if (link.getAttribute('href') === '#' ||
                link.classList.contains('dropdown-item') ||
                link.getAttribute('href') === 'javascript:void(0)' ||
                link.getAttribute('target') === '_blank') {
                return;
            }

            link.addEventListener('click', function(e) {
                // Don't show loader for same-page anchors
                if (this.getAttribute('href').startsWith('#')) {
                    return;
                }

                // Don't show loader for external links
                if (this.getAttribute('href').includes('://') &&
                    !this.getAttribute('href').includes(window.location.hostname)) {
                    return;
                }

                // Show loader with higher stacking context
                document.body.style.overflow = 'hidden'; // Prevent scrolling while loading
                pageLoader.style.display = 'flex'; // Ensure it's displayed
                pageLoader.classList.add('active');

                // Set flag for next page
                sessionStorage.setItem('pageIsLoading', 'true');

                // If it's taking too long, hide after 8 seconds
                setTimeout(() => {
                    if (pageLoader.classList.contains('active')) {
                        pageLoader.classList.remove('active');
                        document.body.style.overflow = '';
                        sessionStorage.removeItem('pageIsLoading');
                    }
                }, 8000);
            });
        });

        // Hide loader when page is fully loaded
        window.addEventListener('load', function() {
            setTimeout(() => {
                pageLoader.classList.remove('active');
                document.body.style.overflow = '';
                sessionStorage.removeItem('pageIsLoading');
            }, 500); // Slightly longer delay for smoother appearance
        });

        // Update header when sidebar state changes
        function updateHeaderState() {
            if (sidebar && sidebar.classList.contains('collapsed')) {
                header.parentElement.classList.add('sidebar-collapsed');
            } else {
                header.parentElement.classList.remove('sidebar-collapsed');
            }
        }

        // Listen for sidebar toggle events
        const sidebarToggle = document.getElementById('sidebarToggle');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                setTimeout(updateHeaderState, 50); // Small delay to ensure sidebar class has been updated
            });
        }

        // Handle responsive layout changes
        function handleResponsiveHeader() {
            if (window.innerWidth <= 768) {
                // Mobile mode - full width header
                header.parentElement.classList.remove('sidebar-collapsed');
            } else {
                // Desktop mode - check saved state
                const savedState = localStorage.getItem('sidebarCollapsed');
                if (savedState === 'true') {
                    header.parentElement.classList.add('sidebar-collapsed');
                } else {
                    header.parentElement.classList.remove('sidebar-collapsed');
                }
            }
        }

        // Add window resize listener for responsive adjustments
        window.addEventListener('resize', handleResponsiveHeader);

        // Initial call to set correct state
        handleResponsiveHeader();
    });
</script>

<!-- Direct handler for dropdown menu, ensuring it works in all pages -->
<script>
// Immediately execute this code for better reliability
(function() {
    // Jangan lakukan event binding yang kompleks di halaman belajar dan materi
    const path = window.location.pathname;
    if (path.includes('/belajar') || path.includes('/materi')) {
        return;
    }
})();
</script>

<!-- Tambahkan script sederhana di bagian paling bawah yang pasti dijalankan -->
<script>
function toggleDropdownManually() {
    var dropdown = document.getElementById('userDropdown');
    if (dropdown) {
        if (dropdown.style.display === 'none' || dropdown.classList.contains('hidden')) {
            dropdown.style.display = 'block';
            dropdown.classList.remove('hidden');
        } else {
            dropdown.style.display = 'none';
            dropdown.classList.add('hidden');
        }
    }
}

// Tambahkan event listener untuk click di luar dropdown
document.addEventListener('click', function(event) {
    var dropdown = document.getElementById('userDropdown');
    var button = document.getElementById('profileDropdownBtn');

    if (dropdown && button && !dropdown.classList.contains('hidden') &&
        !button.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.style.display = 'none';
        dropdown.classList.add('hidden');
    }
});

// Tambahkan event listener untuk tombol Escape
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        var dropdown = document.getElementById('userDropdown');
        if (dropdown && !dropdown.classList.contains('hidden')) {
            dropdown.style.display = 'none';
            dropdown.classList.add('hidden');
        }
    }
});
</script>

<!-- Add a script to set page type attribute on body -->
<script>
// Add a script to set page type attribute on body
(function() {
    function setPageTypeAttribute() {
        const path = window.location.pathname;
        let pageType = 'unknown';

        if (path.includes('/belajar')) {
            pageType = 'belajar';
        } else if (path.includes('/materi')) {
            pageType = 'materi';
        } else if (path.includes('/user/materi')) {
            pageType = 'user-materi';
        } else if (path.includes('/dashboard')) {
            pageType = 'dashboard';
        }

        document.body.setAttribute('data-page-type', pageType);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', setPageTypeAttribute);
    } else {
        setPageTypeAttribute();
    }
})();
</script>

<script>
// Cleanup: Debug elements removed
</script>

<!-- Interceptor JavaScript untuk memaksimalkan kemungkinan dropdown dapat diklik -->
<script>
// Interceptor JavaScript untuk memaksimalkan kemungkinan dropdown dapat diklik
document.addEventListener('DOMContentLoaded', function() {
    // Tambahkan area overlay yang lebih besar di sekitar avatar untuk mendeteksi klik
    const userAvatar = document.querySelector('.user-avatar.dropdown-toggle');

    if (userAvatar) {
        // Buat area overlay yang lebih besar
        const overlay = document.createElement('div');
        overlay.style.position = 'absolute';
        overlay.style.top = '-15px';
        overlay.style.right = '-15px';
        overlay.style.bottom = '-15px';
        overlay.style.left = '-15px';
        overlay.style.zIndex = '9998';
        overlay.style.cursor = 'pointer';
        overlay.style.background = 'rgba(255,0,0,0.0)'; // Transparan tapi bisa dibuat merah untuk debug
        overlay.id = 'profile-overlay';

        // Tambahkan ke parent dari user avatar
        userAvatar.style.position = 'relative';
        userAvatar.appendChild(overlay);

        // Event listeners untuk overlay
        overlay.addEventListener('click', function(e) {
            e.stopPropagation();

            const dropdown = document.getElementById('userDropdownDiv');
            if (dropdown) {
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
            }
        });
    }

    // Tambahkan failsafe interval check
    setInterval(function() {
        const btn = document.getElementById('profileDropdownBtn');
        const path = window.location.pathname;

        // Jika tombol tidak bisa diklik, coba metode lain
        if (btn && (path.includes('/belajar') || path.includes('/materi'))) {
            btn.style.pointerEvents = 'auto';
            btn.style.cursor = 'pointer';
            btn.style.zIndex = '100000';

            // Coba modifikasi onclick attribute langsung jika belum ada
            if (!btn.hasAttribute('data-click-setup')) {
                btn.setAttribute('onclick', "event.stopPropagation(); toggleDropdownManually(); return false;");
                btn.setAttribute('data-click-setup', 'true');
            }
        }
    }, 2000);
});
</script>

<!-- Tambahkan sederhana script di akhir file header untuk menutup dropdown saat klik di luar -->
<script>
// Tambahkan sederhana script di akhir file header untuk menutup dropdown saat klik di luar
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('userDropdown');
    const btn = document.getElementById('profileDropdownBtn');

    // Jika dropdown terbuka dan klik tidak pada dropdown atau tombol dropdown
    if (dropdown && dropdown.style.display === 'block' &&
        !dropdown.contains(event.target) &&
        !btn.contains(event.target)) {
        dropdown.style.display = 'none';
    }
});

// Tambahkan key event untuk menutup dropdown dengan Escape
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const dropdown = document.getElementById('userDropdown');
        if (dropdown && dropdown.style.display === 'block') {
            dropdown.style.display = 'none';
        }
    }
});

// Fungsi toggle yang lebih robust
function toggleUserDropdown(event) {
    if (event) {
        event.stopPropagation();
    }
    const dropdown = document.getElementById('userDropdown');
    if (dropdown) {
        dropdown.style.display = dropdown.style.display === 'none' || dropdown.style.display === '' ? 'block' : 'none';
    }
}
</script>

<script>
// Direct implementation for materi pages
document.addEventListener('DOMContentLoaded', function() {
    // console.log('[Header Script] Checking current page');
    const path = window.location.pathname;
    // console.log('[Header Script] Path:', path);

    // Deteksi halaman materi dan terapkan fixes khusus
    const isMateriPage = path.includes('/materi') || path.includes('/user/materi');
    if (isMateriPage) {
        // console.log('[Header Script] Detected materi page, applying special fixes');

        // Fixes khusus untuk halaman materi - forcing pointer events
        const userAvatar = document.getElementById('userAvatarControl');
        if (userAvatar) {
            userAvatar.style.pointerEvents = 'auto';
            // console.log('[Header Script] Forcing pointer-events on avatar');

            // Override onClick untuk lebih reliable
            userAvatar.addEventListener('click', function(e) {
                e.stopPropagation();
                const dropdown = document.getElementById('userDropdownDiv');
                if (dropdown) {
                    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
                }
            }, true);
        }

        // Tambahkan fullscreen overlay transparent
        const body = document.body;
        const overlay = document.createElement('div');
        overlay.id = 'materiPageFullOverlay';
        overlay.style.position = 'fixed';
        overlay.style.top = '0';
        overlay.style.left = '0';
        overlay.style.width = '70px';
        overlay.style.height = '70px';
        overlay.style.backgroundColor = 'rgba(255,0,0,0.0)';
        overlay.style.zIndex = '9999';

        // Posisikan di avatar
        const avatarDiv = document.querySelector('.user-avatar');
        if (avatarDiv) {
            const rect = avatarDiv.getBoundingClientRect();
            overlay.style.top = rect.top + 'px';
            overlay.style.left = rect.left + 'px';

            overlay.addEventListener('click', function(e) {
                e.stopPropagation();

                const dropdown = document.getElementById('userDropdownDiv');
                if (dropdown) {
                    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
                }
            });

            body.appendChild(overlay);
            // console.log('[Header Script] Added fullscreen clickable overlay');
        }
    }
});
</script>

<!-- Add script to enhance the blur effect for logout modal -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced logout modal handling
    const logoutModal = document.getElementById('logoutModal');

    // Function to show modal with special effects for belajar and materi pages
    function showLogoutModal() {
        if (logoutModal) {
            logoutModal.classList.add('active');

            // Add extra blur class for specific pages
            const pageType = document.body.getAttribute('data-page-type');
            if (pageType === 'belajar' || pageType === 'materi' || pageType === 'user-materi') {
                document.body.classList.add('modal-open-blur');

                // Apply blur to main content directly
                try {
                    const mainContent = document.querySelector('.main-content');
                    if (mainContent) {
                        mainContent.style.filter = 'blur(5px)';
                        mainContent.style.transition = 'filter 0.3s ease';
                    }
                } catch (e) {
                    console.error('Error applying blur:', e);
                }
            }
        }
    }

    // Function to hide modal and remove effects
    function hideLogoutModal() {
        if (logoutModal) {
            logoutModal.classList.remove('active');
            document.body.classList.remove('modal-open-blur');

            try {
                const mainContent = document.querySelector('.main-content');
                if (mainContent) {
                    mainContent.style.filter = '';
                }
            } catch (e) {
                console.error('Error removing blur:', e);
            }
        }
    }

    // Expose functions globally
    window.showLogoutModal = showLogoutModal;
    window.hideLogoutModal = hideLogoutModal;
});
</script>

<!-- Tambahkan jQuery untuk kompatibilitas yang lebih baik -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Pastikan loader selalu diatas semua elemen -->
<script>
    // Execute immediately rather than waiting for DOMContentLoaded
    (function() {
        // When the DOM is ready, move pageLoader to be direct child of body
        document.addEventListener('DOMContentLoaded', function() {
            var pageLoader = document.getElementById('pageLoader');
            if (pageLoader && pageLoader.parentNode !== document.body) {
                document.body.appendChild(pageLoader);
                console.log('Moved page loader to body element');
            }
        });

        // When page is fully loaded from another page
        if (sessionStorage.getItem('pageIsLoading') === 'true') {
            // When page structure is available
            document.addEventListener('DOMContentLoaded', function() {
                document.body.style.overflow = 'hidden';
            });
        }
    })();
</script>
