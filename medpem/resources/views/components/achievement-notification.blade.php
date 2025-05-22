<!-- Achievement Modal Overlay -->
<div id="achievementModalOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-[9999]" style="display: none;"></div>

<!-- Achievement Modal -->
<div id="achievementModal" class="fixed inset-0 z-[10000] flex items-center justify-center" style="display: none;">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 transform transition-all achievement-modal-container">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-gray-800">Pencapaian Baru!</h3>
            <button id="closeAchievementModal" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="mb-4">
            <div class="flex justify-center mb-4">
                <div class="achievement-icon w-20 h-20 flex items-center justify-center rounded-full bg-orange-100 border-4 border-orange-300">
                    <span class="text-3xl text-orange-600"><i class="fas fa-trophy"></i></span>
                </div>
            </div>
            <div id="achievementModalContent" class="text-center">
                <!-- Content will be populated by JavaScript -->
            </div>
        </div>
        <div class="text-center">
            <button id="confirmAchievementModal" class="px-4 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700 transition">
                Lanjutkan
            </button>
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

        let content = '<p class="text-lg font-bold mb-2">Selamat!</p>';

        if (achievements.length > 1) {
            content += `<p class="mb-4 text-sm text-gray-600">Kamu telah membuka ${achievements.length} pencapaian baru!</p>`;
        }

        achievements.forEach((item, index) => {
            // Handle different achievement data structures
            const achievement = item.achievement || item;

            // Create card-like element for each achievement
            content += `<div class="achievement-item mb-4 p-3 rounded-lg border border-gray-200">`;
            content += `<p class="mb-2"><span class="font-bold">${achievement.name}</span></p>`;
            content += `<p class="text-sm text-gray-600 mb-3">${achievement.description}</p>`;
            if (achievement.points_reward > 0) {
                content += `<p class="text-sm font-bold text-yellow-600 mb-1"><i class="fas fa-coins mr-1"></i>+${achievement.points_reward} poin</p>`;
            }
            content += `</div>`;
        });

        modalContent.innerHTML = content;

        // Apply initial state for animation
        modalContainer.style.opacity = '0';
        modalContainer.style.transform = 'scale(0.9)';

        // Show overlay and modal
        overlay.style.display = 'block';
        modal.style.display = 'flex';

        // Animate in with a small delay
        setTimeout(() => {
            modalContainer.style.opacity = '1';
            modalContainer.style.transform = 'scale(1)';
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
            modalContainer.style.transform = 'scale(0.9)';

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
    });
</script>

<style>
    #achievementModalOverlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
    }

    #achievementModal {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 10000;
        display: none;
    }

    .achievement-modal-container {
        opacity: 1;
        transform: scale(1);
        max-height: 90vh;
        overflow-y: auto;
        transition: all 0.3s ease;
    }

    .achievement-item {
        background-color: #f9f9f9;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .achievement-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
</style>
