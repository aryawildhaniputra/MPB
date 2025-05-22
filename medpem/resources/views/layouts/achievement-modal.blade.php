<!-- Achievement Modal -->
<div id="achievementModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 transform transition-all">
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

        let content = '<p class="text-lg font-bold mb-2">Selamat!</p>';

        achievements.forEach((item, index) => {
            content += `<p class="mb-2"><span class="font-bold">${item.achievement.name}</span></p>`;
            content += `<p class="text-sm text-gray-600 mb-4">${item.achievement.description}</p>`;
            if (item.achievement.points_reward > 0) {
                content += `<p class="text-sm font-bold text-yellow-600 mb-2">+${item.achievement.points_reward} poin</p>`;
            }
        });

        modalContent.innerHTML = content;
        modal.classList.remove('hidden');
    }

    // Close modal event handlers
    document.getElementById('closeAchievementModal').addEventListener('click', function() {
        document.getElementById('achievementModal').classList.add('hidden');
    });

    document.getElementById('confirmAchievementModal').addEventListener('click', function() {
        document.getElementById('achievementModal').classList.add('hidden');
    });

    // Check for newly unlocked achievements in session
    @if(session('achievement_unlocked'))
        // Show notification for newly unlocked achievements
        const newAchievements = @json(session('achievement_unlocked'));

        if (newAchievements.length > 0) {
            // Show modal with achievements
            showAchievementModal(newAchievements);
        }
    @endif
</script>
