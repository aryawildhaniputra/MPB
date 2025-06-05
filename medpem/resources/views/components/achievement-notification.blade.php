<!-- Achievement Modal Overlay -->
<div id="achievementModalOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-[8500]" style="display: none;"></div>

<!-- Achievement Modal -->
<div id="achievementModal" class="fixed inset-0 z-[8600] flex items-center justify-center p-4" style="display: none;">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full transform transition-all achievement-modal-container">
        <!-- Header with close button -->
        <div class="relative text-center pt-6 pb-4">
            <button id="closeAchievementModal" class="absolute top-4 right-4 achievement-close-btn">
                <i class="fas fa-times"></i>
            </button>
            <h3 class="achievement-title">Pencapaian Baru!</h3>
        </div>

        <!-- Content area -->
        <div class="px-6 pb-6">
            <!-- Trophy Icon -->
            <div class="flex justify-center mb-6">
                <div class="achievement-icon">
                    <span class="achievement-icon-text">
                        <i class="fas fa-trophy trophy-icon-fa"></i>
                        <span class="trophy-icon-emoji">🏆</span>
                    </span>
                </div>
            </div>

            <!-- Achievement content -->
            <div id="achievementModalContent" class="achievement-content">
                <!-- Content will be populated by JavaScript -->
            </div>

            <!-- Confirm button -->
            <div class="text-center mt-6">
                <button id="confirmAchievementModal" class="achievement-confirm-btn">
                    Lanjutkan
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Achievement modal functions
    function showAchievementModal(achievements) {
        const modalContent = document.getElementById('achievementModalContent');
        const modal = document.getElementById('achievementModal');
        const overlay = document.getElementById('achievementModalOverlay');
        const modalContainer = modal.querySelector('.achievement-modal-container');

        // Make sure achievements is an array
        if (!Array.isArray(achievements)) {
            console.error('Invalid achievements data:', achievements);
            return;
        }

        let content = '<div class="achievement-congratulations">Selamat!</div>';

        if (achievements.length > 1) {
            content += `<div class="achievement-subtitle">Kamu telah membuka ${achievements.length} pencapaian baru!</div>`;
        }

        achievements.forEach((item, index) => {
            // Handle different achievement data structures
            const achievement = item.achievement || item;

            // Create card-like element for each achievement
            content += `<div class="achievement-item">`;
            content += `<div class="achievement-name">${achievement.name}</div>`;
            content += `<div class="achievement-description">${achievement.description}</div>`;
            if (achievement.points_reward > 0) {
                content += `<div class="achievement-points"><i class="fas fa-coins"></i>+${achievement.points_reward} poin</div>`;
            }
            content += `</div>`;
        });

        modalContent.innerHTML = content;

        // Apply initial state for animation
        modalContainer.style.opacity = '0';
        modalContainer.style.transform = 'scale(0.95) translateY(-10px)';

        // Show overlay and modal
        overlay.style.display = 'block';
        modal.style.display = 'flex';

        // Animate in with a small delay
        setTimeout(() => {
            modalContainer.style.opacity = '1';
            modalContainer.style.transform = 'scale(1) translateY(0)';
        }, 10);

        // Prevent body scrolling when modal is open
        document.body.style.overflow = 'hidden';
    }

    // Close modal event handlers
    document.addEventListener('DOMContentLoaded', function() {
        const closeModal = function() {
            const modal = document.getElementById('achievementModal');
            const overlay = document.getElementById('achievementModalOverlay');
            const modalContainer = modal.querySelector('.achievement-modal-container');

            // Animate out
            modalContainer.style.opacity = '0';
            modalContainer.style.transform = 'scale(0.95) translateY(-10px)';

            // Hide after animation completes
            setTimeout(() => {
                modal.style.display = 'none';
                overlay.style.display = 'none';

                // Re-enable body scrolling
                document.body.style.overflow = '';
            }, 200);
        };

        document.getElementById('closeAchievementModal').addEventListener('click', closeModal);
        document.getElementById('confirmAchievementModal').addEventListener('click', closeModal);

        // Close modal on overlay click
        document.getElementById('achievementModalOverlay').addEventListener('click', closeModal);

        // Close modal on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modal = document.getElementById('achievementModal');
                if (modal && modal.style.display !== 'none') {
                    closeModal();
                }
            }
        });

        // Check for newly unlocked achievements in session
        @if(session('achievement_unlocked'))
            // Show notification for newly unlocked achievements
            const newAchievements = @json(session('achievement_unlocked'));

            if (newAchievements.length > 0) {
                // Show modal with achievements
                setTimeout(() => {
                    showAchievementModal(newAchievements);
                }, 500); // Short delay to ensure page is loaded
            }
        @endif

        // Ensure trophy icon displays properly
        function ensureTrophyIcon() {
            const trophyFA = document.querySelector('.trophy-icon-fa');
            const trophyEmoji = document.querySelector('.trophy-icon-emoji');

            if (trophyFA && trophyEmoji) {
                // Check if FontAwesome is loaded by checking computed style
                const faStyle = window.getComputedStyle(trophyFA, ':before');
                const hasFA = faStyle.fontFamily.includes('Font Awesome') ||
                            trophyFA.offsetWidth > 0 ||
                            trophyFA.offsetHeight > 0;

                if (!hasFA || faStyle.content === 'none' || faStyle.content === '') {
                    // FontAwesome not loaded or not working, show emoji
                    trophyFA.style.display = 'none';
                    trophyEmoji.style.display = 'inline-block';
                } else {
                    // FontAwesome is working, hide emoji
                    trophyFA.style.display = 'inline-block';
                    trophyEmoji.style.display = 'none';
                }
            }
        }

        // Run trophy icon check after a brief delay to allow FontAwesome to load
        setTimeout(ensureTrophyIcon, 100);

        // Also run on window load as a backup
        window.addEventListener('load', ensureTrophyIcon);
    });
</script>

<style>
    /* Base Modal Styles */
    #achievementModalOverlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.6);
        z-index: 8500;
        backdrop-filter: blur(4px);
    }

    #achievementModal {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 8600;
        display: none;
        padding: 1rem;
    }

    .achievement-modal-container {
        background: linear-gradient(145deg, #ffffff 0%, #fefefe 100%);
        border-radius: 1rem;
        box-shadow:
            0 25px 50px -12px rgba(0, 0, 0, 0.25),
            0 0 0 1px rgba(255, 255, 255, 0.05);
        max-width: 26rem;
        width: 100%;
        max-height: 85vh;
        overflow-y: auto;
        opacity: 1;
        transform: scale(1) translateY(0);
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        border: 2px solid #f97316;
        position: relative;
    }

    .achievement-title {
        font-size: 1.375rem;
        font-weight: 800;
        color: #1f2937;
        margin: 0;
        letter-spacing: -0.025em;
    }

    .achievement-close-btn {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
        background-color: #f3f4f6;
        border: 1px solid #e5e7eb;
        color: #6b7280;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        cursor: pointer;
        z-index: 10;
    }

    .achievement-close-btn:hover {
        background-color: #ef4444;
        color: white;
        border-color: #dc2626;
        transform: scale(1.05);
    }

    .achievement-icon {
        width: 5rem;
        height: 5rem;
        border-radius: 50%;
        background: linear-gradient(145deg, #fed7aa 0%, #fb923c 100%);
        border: 3px solid #f97316;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow:
            0 10px 25px -5px rgba(249, 115, 22, 0.4),
            0 0 0 4px rgba(249, 115, 22, 0.1);
        animation: pulse-trophy 2s ease-in-out infinite;
        position: relative;
        margin: 0 auto;
    }

    .achievement-icon::before {
        content: '';
        position: absolute;
        top: -6px;
        left: -6px;
        right: -6px;
        bottom: -6px;
        border-radius: 50%;
        background: linear-gradient(145deg, #f97316, #ea580c);
        z-index: -1;
        animation: rotate 3s linear infinite;
        opacity: 0.3;
    }

    .achievement-icon-text {
        font-size: 2.25rem;
        color: #ea580c;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
        font-weight: 900;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        z-index: 2;
        position: relative;
        line-height: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
    }

    /* FontAwesome Trophy Icon */
    .trophy-icon-fa {
        font-size: 2.25rem !important;
        color: #ea580c !important;
        font-weight: 900 !important;
        display: inline-block;
        line-height: 1;
    }

    /* Emoji Trophy Fallback */
    .trophy-icon-emoji {
        font-size: 2.5rem;
        line-height: 1;
        display: none; /* Hidden by default, shown if FontAwesome fails */
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
    }

    /* Show emoji if FontAwesome is not available */
    .achievement-icon-text .trophy-icon-fa:not(.fa-trophy),
    .achievement-icon-text .trophy-icon-fa[class*="fa-"]:empty {
        display: none;
    }

    .achievement-icon-text .trophy-icon-fa:not(.fa-trophy) + .trophy-icon-emoji,
    .achievement-icon-text .trophy-icon-fa[class*="fa-"]:empty + .trophy-icon-emoji {
        display: inline-block;
    }

    /* Fallback: Show emoji if no FontAwesome detected */
    @supports not (font-family: "Font Awesome 6 Free") {
        .trophy-icon-fa {
            display: none !important;
        }
        .trophy-icon-emoji {
            display: inline-block !important;
        }
    }

    .achievement-congratulations {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #f97316;
        text-align: center;
    }

    .achievement-subtitle {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 1.5rem;
        line-height: 1.5;
        text-align: center;
    }

    .achievement-content {
        text-align: center;
    }

    .achievement-item {
        background: linear-gradient(145deg, #f8fafc 0%, #f1f5f9 100%);
        border: 1px solid #e2e8f0;
        border-radius: 0.75rem;
        padding: 1rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .achievement-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #f97316, #ea580c);
        border-radius: 0.75rem 0.75rem 0 0;
    }

    .achievement-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px -5px rgba(0, 0, 0, 0.1);
        border-color: #f97316;
    }

    .achievement-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.5rem;
        line-height: 1.3;
    }

    .achievement-description {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 0.75rem;
        line-height: 1.5;
    }

    .achievement-points {
        font-size: 0.875rem;
        font-weight: 600;
        color: #d97706;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.375rem;
        background-color: #fef3c7;
        padding: 0.375rem 0.75rem;
        border-radius: 9999px;
        border: 1px solid #fbbf24;
        width: fit-content;
        margin: 0 auto;
    }

    .achievement-confirm-btn {
        background: linear-gradient(145deg, #f97316 0%, #ea580c 100%);
        color: white;
        padding: 0.875rem 2rem;
        border-radius: 0.75rem;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        box-shadow:
            0 4px 14px -2px rgba(249, 115, 22, 0.4),
            0 0 0 1px rgba(249, 115, 22, 0.2);
        letter-spacing: 0.025em;
        width: 100%;
        max-width: 200px;
    }

    .achievement-confirm-btn:hover {
        transform: translateY(-2px);
        box-shadow:
            0 8px 25px -5px rgba(249, 115, 22, 0.5),
            0 0 0 1px rgba(249, 115, 22, 0.3);
        background: linear-gradient(145deg, #ea580c 0%, #c2410c 100%);
    }

    .achievement-confirm-btn:active {
        transform: translateY(0);
        transition: transform 0.1s ease;
    }

    /* Animations */
    @keyframes pulse-trophy {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }

    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }

    /* Tablet Responsiveness */
    @media (max-width: 768px) {
        #achievementModal {
            padding: 0.75rem;
        }

        .achievement-modal-container {
            max-width: 100%;
            width: calc(100% - 1.5rem);
            border-radius: 0.875rem;
        }

        .achievement-title {
            font-size: 1.25rem;
        }

        .achievement-close-btn {
            width: 2.25rem;
            height: 2.25rem;
            font-size: 0.9rem;
        }

        .achievement-icon {
            width: 4.5rem;
            height: 4.5rem;
        }

        .achievement-icon-text {
            font-size: 1.75rem;
        }

        .achievement-congratulations {
            font-size: 1.125rem;
        }

        .achievement-subtitle {
            font-size: 0.8rem;
        }

        .achievement-name {
            font-size: 1rem;
        }

        .achievement-description {
            font-size: 0.8rem;
        }

        .achievement-points {
            font-size: 0.8rem;
        }

        .achievement-confirm-btn {
            padding: 0.75rem 1.5rem;
            font-size: 0.95rem;
        }
    }

    /* Mobile Responsiveness */
    @media (max-width: 480px) {
        #achievementModal {
            padding: 0.5rem;
        }

        .achievement-modal-container {
            max-width: 100%;
            width: calc(100% - 1rem);
            border-radius: 0.75rem;
        }

        .achievement-title {
            font-size: 1.125rem;
            line-height: 1.4;
        }

        .achievement-close-btn {
            width: 2rem;
            height: 2rem;
            font-size: 0.8rem;
            top: 3px;
            right: 3px;
        }

        .achievement-icon {
            width: 4rem;
            height: 4rem;
            border-width: 2px;
        }

        .achievement-icon-text {
            font-size: 1.5rem;
        }

        .achievement-congratulations {
            font-size: 1rem;
        }

        .achievement-subtitle {
            font-size: 0.75rem;
            line-height: 1.4;
        }

        .achievement-item {
            padding: 0.875rem;
        }

        .achievement-name {
            font-size: 0.95rem;
            margin-bottom: 0.375rem;
        }

        .achievement-description {
            font-size: 0.75rem;
            margin-bottom: 0.5rem;
        }

        .achievement-points {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }

        .achievement-confirm-btn {
            padding: 0.625rem 1.25rem;
            font-size: 0.9rem;
        }
    }

    /* Extra Small Mobile */
    @media (max-width: 360px) {
        .achievement-modal-container {
            width: calc(100% - 0.75rem);
        }

        .achievement-title {
            font-size: 1rem;
        }

        .achievement-icon {
            width: 3.5rem;
            height: 3.5rem;
        }

        .achievement-icon-text {
            font-size: 1.25rem;
        }

        .achievement-close-btn {
            width: 1.875rem;
            height: 1.875rem;
            font-size: 0.75rem;
        }
    }

    /* Touch device optimizations */
    @media (hover: none) and (pointer: coarse) {
        .achievement-close-btn {
            min-width: 2.75rem;
            min-height: 2.75rem;
        }

        .achievement-item:hover {
            transform: none;
            box-shadow: 0 4px 14px -2px rgba(0, 0, 0, 0.1);
        }
    }
</style>
