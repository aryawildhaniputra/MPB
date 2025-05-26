<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\UserGame;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use Illuminate\Support\Facades\Log;

/**
 * PermainanController manages all educational games
 *
 * TODO: IMPORTANT - ABOUT IMAGES
 * All external image URLs (from freepik, etc.) in this controller need to be replaced with local images
 * for both privacy and performance reasons. The image paths should follow this convention:
 * - Image guessing game: /images/games/image-guessing/[name].jpg
 * - Image matching game: /images/games/image-matching/[name].jpg
 *
 * Please download appropriate educational images and update all image paths before deploying.
 */
class PermainanController extends Controller
{
    /**
     * Display a listing of the games.
     */
    public function index()
    {
        // Get all available games
        $games = Game::all();
        return view('permainan.index', compact('games'));
    }

    /**
     * Display a specific game.
     */
    public function show($slug)
    {
        // Find the game by slug
        $game = Game::where('slug', $slug)->firstOrFail();
        return view('permainan.' . $slug, compact('game'));
    }

    /**
     * Word Scramble game - unscramble words
     */
    public function wordScramble()
    {
        // Game data for word scramble
        $gameData = [
            'title' => 'Word Scramble - Parts of Body',
            'slug' => 'word-scramble-body',
            'description' => 'Susun huruf-huruf acak menjadi kata yang benar tentang bagian tubuh manusia.',
            'words' => [
                [
                    'word' => 'HEAD',
                    'hint' => 'Bagian atas tubuh yang berisi otak',
                    'definition' => 'Kepala adalah bagian tubuh yang berisi otak, mata, telinga, hidung, dan mulut.'
                ],
                [
                    'word' => 'EYES',
                    'hint' => 'Organ penglihatan',
                    'definition' => 'Mata adalah organ yang digunakan untuk melihat dan menerima informasi visual.'
                ],
                [
                    'word' => 'NOSE',
                    'hint' => 'Organ penciuman',
                    'definition' => 'Hidung adalah organ penciuman dan juga bagian dari sistem pernapasan.'
                ],
                [
                    'word' => 'EARS',
                    'hint' => 'Organ pendengaran',
                    'definition' => 'Telinga adalah organ yang digunakan untuk mendengar suara dan menjaga keseimbangan.'
                ],
                [
                    'word' => 'MOUTH',
                    'hint' => 'Tempat untuk makan dan berbicara',
                    'definition' => 'Mulut adalah lubang di wajah yang digunakan untuk makan, berbicara, dan bernafas.'
                ],
                [
                    'word' => 'HANDS',
                    'hint' => 'Digunakan untuk memegang benda',
                    'definition' => 'Tangan adalah bagian tubuh di ujung lengan yang memiliki lima jari.'
                ],
                [
                    'word' => 'FEET',
                    'hint' => 'Digunakan untuk berjalan',
                    'definition' => 'Kaki adalah bagian tubuh di ujung kaki yang digunakan untuk berdiri dan berjalan.'
                ],
                [
                    'word' => 'ARMS',
                    'hint' => 'Menghubungkan tangan ke tubuh',
                    'definition' => 'Lengan adalah anggota tubuh yang menghubungkan tangan ke bahu.'
                ],
                [
                    'word' => 'LEGS',
                    'hint' => 'Digunakan untuk berlari',
                    'definition' => 'Kaki adalah anggota tubuh yang digunakan untuk berjalan, berlari, dan melompat.'
                ],
                [
                    'word' => 'NECK',
                    'hint' => 'Menghubungkan kepala ke tubuh',
                    'definition' => 'Leher adalah bagian tubuh yang menghubungkan kepala ke tubuh.'
                ]
            ]
        ];

        return view('permainan.word-scramble', ['gameData' => $gameData]);
    }

    /**
     * Word Scramble game - unscramble words (house parts)
     */
    public function wordScrambleHouse()
    {
        // Game data for word scramble
        $gameData = [
            'title' => 'Word Scramble - Parts of House',
            'slug' => 'word-scramble-house',
            'description' => 'Susun huruf-huruf acak menjadi kata yang benar tentang bagian rumah.',
            'words' => [
                [
                    'word' => 'KITCHEN',
                    'hint' => 'Tempat untuk memasak makanan',
                    'definition' => 'Dapur adalah ruangan tempat menyiapkan dan memasak makanan.'
                ],
                [
                    'word' => 'BEDROOM',
                    'hint' => 'Tempat untuk tidur dan beristirahat',
                    'definition' => 'Kamar tidur adalah ruangan yang digunakan untuk tidur dan beristirahat.'
                ],
                [
                    'word' => 'BATHROOM',
                    'hint' => 'Tempat untuk mandi dan buang air',
                    'definition' => 'Kamar mandi adalah ruangan untuk mandi, mencuci, dan menggunakan toilet.'
                ],
                [
                    'word' => 'LIVING',
                    'hint' => 'Ruangan untuk berkumpul dengan keluarga',
                    'definition' => 'Ruang tamu adalah tempat untuk bersantai dan menerima tamu.'
                ],
                [
                    'word' => 'DINING',
                    'hint' => 'Tempat untuk makan bersama',
                    'definition' => 'Ruang makan adalah tempat anggota keluarga berkumpul untuk makan bersama.'
                ],
                [
                    'word' => 'GARAGE',
                    'hint' => 'Tempat untuk memarkir kendaraan',
                    'definition' => 'Garasi adalah ruangan untuk menyimpan dan memarkir kendaraan.'
                ],
                [
                    'word' => 'ATTIC',
                    'hint' => 'Ruangan di bawah atap rumah',
                    'definition' => 'Loteng adalah ruangan di bawah atap yang sering digunakan untuk penyimpanan.'
                ],
                [
                    'word' => 'BASEMENT',
                    'hint' => 'Ruangan di bawah tanah',
                    'definition' => 'Ruang bawah tanah adalah ruangan yang terletak di bawah rumah, kadang digunakan untuk penyimpanan.'
                ],
                [
                    'word' => 'WINDOW',
                    'hint' => 'Tempat masuknya cahaya dan udara',
                    'definition' => 'Jendela adalah bukaan pada dinding yang memungkinkan cahaya dan udara masuk ke dalam rumah.'
                ],
                [
                    'word' => 'DOOR',
                    'hint' => 'Tempat untuk masuk dan keluar rumah',
                    'definition' => 'Pintu adalah struktur yang memungkinkan orang masuk dan keluar ruangan atau bangunan.'
                ]
            ]
        ];

        return view('permainan.word-scramble', ['gameData' => $gameData]);
    }

    /**
     * Word Matching game - match parts of body with their functions
     */
    public function wordMatching()
    {
        // Game data for word matching
        $gameData = [
            'title' => 'Word Matching - Parts of Body',
            'slug' => 'word-matching-body',
            'description' => 'Cocokkan setiap bagian tubuh dengan fungsinya.',
            'items' => [
                [
                    'term' => 'Eyes',
                    'definition' => 'To see and receive visual information'
                ],
                [
                    'term' => 'Nose',
                    'definition' => 'To smell and breathe'
                ],
                [
                    'term' => 'Ears',
                    'definition' => 'To hear sounds and maintain balance'
                ],
                [
                    'term' => 'Mouth',
                    'definition' => 'To eat, talk, and breathe'
                ],
                [
                    'term' => 'Hands',
                    'definition' => 'To grab, hold, and manipulate objects'
                ],
                [
                    'term' => 'Brain',
                    'definition' => 'To control the body and process information'
                ],
                [
                    'term' => 'Heart',
                    'definition' => 'To pump blood throughout the body'
                ],
                [
                    'term' => 'Lungs',
                    'definition' => 'To take in oxygen and remove carbon dioxide'
                ]
            ]
        ];

        return view('permainan.word-matching', ['gameData' => $gameData]);
    }

    /**
     * Word Matching game for house parts
     */
    public function wordMatchingHouse()
    {
        // Game data for word matching - house parts
        $gameData = [
            'title' => 'Word Matching - Parts of House',
            'slug' => 'word-matching-house',
            'description' => 'Cocokkan setiap bagian rumah dengan fungsinya.',
            'items' => [
                [
                    'term' => 'Kitchen',
                    'definition' => 'A place to cook and prepare food'
                ],
                [
                    'term' => 'Bedroom',
                    'definition' => 'A place to sleep and rest'
                ],
                [
                    'term' => 'Bathroom',
                    'definition' => 'A place to take a bath and use toilet'
                ],
                [
                    'term' => 'Living Room',
                    'definition' => 'A place to relax and entertain guests'
                ],
                [
                    'term' => 'Dining Room',
                    'definition' => 'A place to eat meals'
                ],
                [
                    'term' => 'Garage',
                    'definition' => 'A place to park vehicles'
                ],
                [
                    'term' => 'Attic',
                    'definition' => 'A space just below the roof for storage'
                ],
                [
                    'term' => 'Basement',
                    'definition' => 'An underground space for storage or activities'
                ]
            ]
        ];

        return view('permainan.word-matching', ['gameData' => $gameData]);
    }

    /**
     * Word Search game - find body parts in a grid
     */
    public function wordSearch()
    {
        // Game data for word search
        $gameData = [
            'title' => 'Word Search - Parts of Body',
            'slug' => 'word-search-body',
            'description' => 'Temukan semua kata tentang bagian tubuh dalam kotak huruf. Permainan ini disesuaikan untuk siswa kelas 5 SD.',
            'grid_size' => 8,
            'words' => [
                'HEAD',
                'EYE',
                'NOSE',
                'MOUTH',
                'EAR',
                'ARM',
                'HAND',
                'LEG',
                'FOOT'
            ]
        ];

        return view('permainan.word-search', ['gameData' => $gameData]);
    }

    /**
     * Word Search game - find house parts in a grid
     */
    public function wordSearchHouse()
    {
        // Game data for word search - house parts
        $gameData = [
            'title' => 'Word Search - Parts of House',
            'slug' => 'word-search-house',
            'description' => 'Temukan semua kata tentang bagian rumah dalam kotak huruf. Permainan ini disesuaikan untuk siswa kelas 5 SD.',
            'grid_size' => 9,
            'words' => [
                'KITCHEN',
                'BEDROOM',
                'BATH',
                'LIVING',
                'DINING',
                'GARAGE',
                'ATTIC',
                'DOOR',
                'WINDOW',
                'ROOF'
            ]
        ];

        return view('permainan.word-search', ['gameData' => $gameData]);
    }

    /**
     * Removed Image Guessing game
     */

    /**
     * Image Matching game - match house parts with their images
     */
    public function imageMatchingHouse()
    {
        // Game data for image matching - house parts
        $gameData = [
            'title' => 'Image Matching - Parts of House',
            'slug' => 'image-matching-house',
            'description' => 'Pasangkan gambar bagian rumah dengan kata yang tepat. Permainan seru untuk menguji pengetahuanmu tentang vocabulary bagian rumah!',
            'items' => [
                [
                    // TODO: Replace this with a local image of a kitchen
                    // Recommended path: /images/games/image-matching/kitchen.jpg
                    'image' => 'https://img.freepik.com/premium-vector/kitchen-interior-with-furniture-household-appliances-modern-room-home-cooking-kitchen-interior-vector-cartoon-illustration_253349-1018.jpg',
                    'word' => 'KITCHEN',
                    'hint' => 'Tempat untuk memasak'
                ],
                [
                    // TODO: Replace this with a local image of a bedroom
                    // Recommended path: /images/games/image-matching/bedroom.jpg
                    'image' => 'https://img.freepik.com/premium-vector/modern-bedroom-interior-with-furniture-cartoon-background-cozy-house-apartment-rest-relaxation-sleep-place-with-bed-carpet-nightstand-lamp-window-bedroom-room-vector-flat-illustration_253349-966.jpg',
                    'word' => 'BEDROOM',
                    'hint' => 'Tempat untuk tidur'
                ],
                [
                    'image' => 'https://img.freepik.com/premium-vector/cartoon-bathroom-interior-with-furniture-bathtub-washbasin-toilet-bowl-towels-indoor-house-rest-room-vector-flat-illustration-modern-bath-supplies-water-procedure-vanity-shower-cabinet_253349-1011.jpg',
                    'word' => 'BATHROOM',
                    'hint' => 'Tempat untuk mandi'
                ],
                [
                    'image' => 'https://img.freepik.com/premium-vector/living-room-interior-with-furniture-sofa-tv-flowerpot-table-shelf-home-apartment-cartoon-illustration_253349-844.jpg',
                    'word' => 'LIVING ROOM',
                    'hint' => 'Tempat berkumpul keluarga'
                ],
                [
                    'image' => 'https://img.freepik.com/premium-vector/dining-room-interior-with-furniture-round-table-chairs-dining-zone-home-apartment-cartoon-vector-illustration-with-table-served-dinner-lamp-flowers-vase-cupboard-kitchenware_253349-918.jpg',
                    'word' => 'DINING ROOM',
                    'hint' => 'Tempat untuk makan'
                ],
                [
                    'image' => 'https://img.freepik.com/premium-vector/garage-with-closed-gate-suburban-house-with-cars-inside-workshop-room-city-building-exterior-auto-parking-repair-service-house-construction-automobile-storage-vector-cartoon-illustration_257455-756.jpg',
                    'word' => 'GARAGE',
                    'hint' => 'Tempat memarkir mobil'
                ],
                [
                    'image' => 'https://img.freepik.com/premium-vector/summer-garden-landscape-with-green-bushes-flowers-grass-plants-garden-nature-scenery-house-backyard-cartoon-illustration-with-blooming-meadow-ornamental-shrubs-beautiful-plantation_253349-965.jpg',
                    'word' => 'GARDEN',
                    'hint' => 'Area dengan tanaman dan bunga'
                ],
                [
                    'image' => 'https://img.freepik.com/premium-vector/cartoon-roof-house-construction-top-part-building-home-architecture-element-cottage-outside-design-ceramic-tile-terracotta-traditional-covering-isolated-white-background-vector-illustration_186930-1345.jpg',
                    'word' => 'ROOF',
                    'hint' => 'Bagian atas rumah'
                ]
            ]
        ];

        return view('permainan.image-matching', ['gameData' => $gameData]);
    }

    /**
     * Word Hangman game - guess the hidden word
     */
    public function wordHangmanBody()
    {
        // Game data for hangman
        $gameData = [
            'title' => 'Word Hangman - Parts of Body',
            'slug' => 'word-hangman-body',
            'description' => 'Tebak kata yang tersembunyi dengan memilih huruf yang tepat.',
            'max_attempts' => 6,
            'words' => [
                [
                    'word' => 'HEAD',
                    'hint' => 'The part of the body on top containing the brain'
                ],
                [
                    'word' => 'SHOULDER',
                    'hint' => 'The part where the arm joins the body'
                ],
                [
                    'word' => 'ELBOW',
                    'hint' => 'The middle joint of the arm'
                ],
                [
                    'word' => 'KNEE',
                    'hint' => 'The joint between the thigh and the lower leg'
                ],
                [
                    'word' => 'NECK',
                    'hint' => 'The part connecting the head to the body'
                ],
                [
                    'word' => 'FINGER',
                    'hint' => 'The flexible parts at the end of your hand'
                ],
                [
                    'word' => 'TOE',
                    'hint' => 'The digits on your foot'
                ],
                [
                    'word' => 'ANKLE',
                    'hint' => 'The joint connecting the foot to the leg'
                ],
                [
                    'word' => 'CHIN',
                    'hint' => 'The bottom part of the face below your mouth'
                ],
                [
                    'word' => 'CHEEK',
                    'hint' => 'The side part of the face below the eye'
                ]
            ]
        ];

        return view('permainan.word-hangman', ['gameData' => $gameData]);
    }

    /**
     * Word Scramble game for illnesses
     */
    public function wordScrambleIllness()
    {
        // Game data for word scramble focused on illnesses
        $gameData = [
            'title' => 'Word Scramble - Kind of Illness',
            'slug' => 'word-scramble-illness',
            'description' => 'Susun huruf-huruf acak menjadi kata yang benar tentang penyakit.',
            'words' => [
                [
                    'word' => 'FEVER',
                    'hint' => 'Saat badanmu terasa panas',
                    'definition' => 'Demam adalah saat badanmu terasa panas dan hangat.'
                ],
                [
                    'word' => 'COLD',
                    'hint' => 'Hidung berair dan sering bersin',
                    'definition' => 'Pilek adalah saat hidungmu berair dan kamu sering bersin.'
                ],
                [
                    'word' => 'COUGH',
                    'hint' => 'Saat kamu berkata "uhuk uhuk"',
                    'definition' => 'Batuk adalah saat tenggorokanmu gatal dan kamu berkata "uhuk uhuk".'
                ],
                [
                    'word' => 'HEADACHE',
                    'hint' => 'Sakit di kepalamu',
                    'definition' => 'Sakit kepala adalah rasa tidak nyaman di kepalamu.'
                ],
                [
                    'word' => 'TOOTHACHE',
                    'hint' => 'Sakit di gigimu',
                    'definition' => 'Sakit gigi adalah rasa sakit yang kamu rasakan pada gigimu.'
                ],
                [
                    'word' => 'FLU',
                    'hint' => 'Seperti pilek dan demam bersama',
                    'definition' => 'Flu adalah saat kamu demam, pilek, dan merasa lemah.'
                ],
                [
                    'word' => 'SORE',
                    'hint' => 'Sakit di tenggorokan saat menelan',
                    'definition' => 'Sakit tenggorokan adalah rasa sakit saat kamu menelan.'
                ],
                [
                    'word' => 'RASH',
                    'hint' => 'Kulit merah dan gatal',
                    'definition' => 'Ruam adalah bintik-bintik merah pada kulitmu yang terasa gatal.'
                ],
                [
                    'word' => 'EARACHE',
                    'hint' => 'Sakit di telingamu',
                    'definition' => 'Sakit telinga adalah rasa sakit yang kamu rasakan pada telingamu.'
                ],
                [
                    'word' => 'SNEEZE',
                    'hint' => 'Saat kamu berkata "hatsyi!"',
                    'definition' => 'Bersin adalah saat hidungmu gatal dan kamu berkata "hatsyi!"'
                ]
            ]
        ];

        return view('permainan.word-scramble', ['gameData' => $gameData]);
    }

    /**
     * Sentence Scramble game - unscramble full sentences
     */
    public function sentenceScramble()
    {
        // Game data for sentence scramble
        $gameData = [
            'title' => 'Sentence Scramble - Parts of Body',
            'slug' => 'sentence-scramble',
            'description' => 'Susun kata-kata acak menjadi kalimat yang benar tentang penggunaan bagian tubuh.',
            'sentences' => [
                [
                    'original' => 'Selena uses her ears to listen the music',
                    'hint' => 'Penggunaan telinga untuk mendengarkan',
                    'definition' => 'Selena menggunakan telinganya untuk mendengarkan musik.'
                ],
                [
                    'original' => 'Kowin uses his foot to play makan kerupuk competition',
                    'hint' => 'Penggunaan kaki dalam lomba',
                    'definition' => 'Kowin menggunakan kakinya untuk bermain lomba makan kerupuk.'
                ],
                [
                    'original' => 'Adit uses his hand to pick an melon',
                    'hint' => 'Penggunaan tangan untuk mengambil sesuatu',
                    'definition' => 'Adit menggunakan tangannya untuk mengambil melon.'
                ],
                [
                    'original' => 'They use their nose to smell a flower',
                    'hint' => 'Penggunaan hidung untuk mencium aroma',
                    'definition' => 'Mereka menggunakan hidung mereka untuk mencium bunga.'
                ],
                [
                    'original' => 'Kimmy uses her eyes to see beautiful scenery',
                    'hint' => 'Penggunaan mata untuk melihat',
                    'definition' => 'Kimmy menggunakan matanya untuk melihat pemandangan indah.'
                ],
                [
                    'original' => 'We use our hands to write a letter',
                    'hint' => 'Penggunaan tangan untuk menulis',
                    'definition' => 'Kami menggunakan tangan kami untuk menulis surat.'
                ],
                [
                    'original' => 'The chef uses his fingers to taste the soup',
                    'hint' => 'Penggunaan jari untuk mencicipi',
                    'definition' => 'Koki itu menggunakan jarinya untuk mencicipi sup.'
                ],
                [
                    'original' => 'She uses her mouth to speak English',
                    'hint' => 'Penggunaan mulut untuk berbicara',
                    'definition' => 'Dia menggunakan mulutnya untuk berbicara bahasa Inggris.'
                ],
                [
                    'original' => 'The doctor uses his brain to solve medical problems',
                    'hint' => 'Penggunaan otak untuk memecahkan masalah',
                    'definition' => 'Dokter itu menggunakan otaknya untuk memecahkan masalah medis.'
                ],
                [
                    'original' => 'Athletes use their legs to run fast',
                    'hint' => 'Penggunaan kaki untuk berlari',
                    'definition' => 'Atlet menggunakan kaki mereka untuk berlari cepat.'
                ]
            ]
        ];

        return view('permainan.sentence-scramble', ['gameData' => $gameData]);
    }

    /**
     * Word Matching game for illnesses
     */
    public function wordMatchingIllness()
    {
        // Game data for word matching related to illnesses
        $gameData = [
            'title' => 'Word Matching - Kind of Illness',
            'slug' => 'word-matching-illness',
            'description' => 'Cocokkan setiap jenis penyakit dengan ciri-cirinya.',
            'items' => [
                [
                    'term' => 'Fever',
                    'definition' => 'Badan terasa panas dan hangat'
                ],
                [
                    'term' => 'Cold',
                    'definition' => 'Hidung berair dan sering bersin'
                ],
                [
                    'term' => 'Cough',
                    'definition' => 'Berkata "uhuk uhuk" dan tenggorokan gatal'
                ],
                [
                    'term' => 'Headache',
                    'definition' => 'Rasa sakit di kepala'
                ],
                [
                    'term' => 'Toothache',
                    'definition' => 'Rasa sakit di gigi atau saat mengunyah'
                ],
                [
                    'term' => 'Flu',
                    'definition' => 'Demam, pilek, dan badan terasa lemah'
                ],
                [
                    'term' => 'Sore Throat',
                    'definition' => 'Sakit saat menelan makanan atau minuman'
                ],
                [
                    'term' => 'Sneeze',
                    'definition' => 'Berkata "hatsyi!" saat hidung gatal'
                ]
            ]
        ];

        return view('permainan.word-matching', ['gameData' => $gameData]);
    }

    /**
     * Word Search game for illnesses
     */
    public function wordSearchIllness()
    {
        // Game data for word search focused on illnesses
        $gameData = [
            'title' => 'Word Search - Kind of Illness',
            'slug' => 'word-search-illness',
            'description' => 'Temukan kata-kata tersembunyi tentang penyakit dalam kotak huruf.',
            'grid_size' => 10,
            'theme_image' => '/images/games/kind-of-illness/illness_game.svg',
            'words' => ['FEVER', 'COLD', 'COUGH', 'HEAD', 'TOOTH', 'FLU', 'SICK', 'EAR', 'SNEEZE', 'PAIN']
        ];

        return view('permainan.word-search', ['gameData' => $gameData]);
    }

    /**
     * Record game completion
     */
    public function completeGame(Request $request)
    {
        try {
            if (!Auth::check()) {
                return response()->json(['error' => 'Unauthenticated'], 401);
            }

            $request->validate([
                'game_slug' => 'required|string',
                'score' => 'required|integer',
                'time_taken' => 'required|integer',
            ]);

            // Find the game
            $game = Game::where('slug', $request->game_slug)->first();

            // If game doesn't exist in database, create a temporary fallback game object
            if (!$game) {
                Log::warning("Game with slug '{$request->game_slug}' not found in database. Creating temporary object.");

                // Create a fallback game object with default values
                $game = new Game();
                $game->id = 0; // Temporary ID
                $game->slug = $request->game_slug;
                $game->title = ucwords(str_replace('-', ' ', $request->game_slug));
                $game->points_reward = 10; // Default points

                // Try to create/find the game in database for future uses
                try {
                    $dbGame = Game::firstOrCreate(
                        ['slug' => $request->game_slug],
                        [
                            'title' => ucwords(str_replace('-', ' ', $request->game_slug)),
                            'description' => 'Auto-created game',
                            'points_reward' => 10,
                            'difficulty' => 'medium',
                            'game_type' => explode('-', $request->game_slug)[0],
                            'theme' => explode('-', $request->game_slug, 2)[1] ?? 'general',
                            'estimated_time' => 5,
                            'is_active' => true
                        ]
                    );

                    // Use the database ID if it was created successfully
                    if ($dbGame && $dbGame->id) {
                        $game = $dbGame;
                    }
                } catch (\Exception $e) {
                    Log::error("Failed to create game entry: " . $e->getMessage());
                    // Continue with temporary game object
                }
            }

            // Get user
            $user = Users::find(Auth::id());

            // Check if user has already completed this game
            try {
                $userGame = UserGame::where('user_id', $user->id)
                              ->where('game_id', $game->id)
                              ->first();

                if ($userGame) {
                    // Update existing record if new score is higher
                    if ($request->score > $userGame->score) {
                        $userGame->score = $request->score;
                        $userGame->time_taken = $request->time_taken;
                        $userGame->completed = true;
                        $userGame->last_played_at = now();
                        $userGame->save();
                    } else {
                        // Just update last played time and mark as completed
                        $userGame->last_played_at = now();
                        $userGame->completed = true;
                        $userGame->save();
                    }
                } else {
                    // Create new record
                    UserGame::create([
                        'user_id' => $user->id,
                        'game_id' => $game->id,
                        'score' => $request->score,
                        'time_taken' => $request->time_taken,
                        'completed' => true,
                        'last_played_at' => now()
                    ]);

                    // Add game points to user's total points (only on first completion)
                    $user->total_points = ($user->total_points ?? 0) + $game->points_reward;
                    $user->save();
                }
            } catch (\Exception $e) {
                Log::error("Error saving user game progress: " . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Error saving game progress, but you can continue playing',
                    'error' => $e->getMessage()
                ], 500);
            }

            return response()->json([
                'success' => true,
                'message' => 'Game completion recorded successfully',
                'points_earned' => $game->points_reward
            ]);
        } catch (\Exception $e) {
            Log::error("Unexpected error in completeGame: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show game answers and explanations for completed games
     */
    public function showAnswers($slug)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Find the game
        $game = Game::where('slug', $slug)->first();
        if (!$game) {
            return redirect()->route('permainan.index')->with('error', 'Permainan tidak ditemukan');
        }

        // Check if user has completed this game
        $userGame = UserGame::where('user_id', Auth::id())
            ->where('game_id', $game->id)
            ->first();

        if (!$userGame || !$userGame->completed) {
            return redirect()->route('permainan.index')->with('error', 'Kamu belum menyelesaikan permainan ini');
        }

        // Get answers data based on game type
        $answersData = $this->getGameAnswersData($slug);

        return view('permainan.answers', [
            'game' => $game,
            'answersData' => $answersData
        ]);
    }

    /**
     * Get answers data for different game types
     */
    private function getGameAnswersData($slug)
    {
        switch($slug) {
            case 'word-scramble':
                return [
                    'title' => 'Jawaban Word Scramble - Parts of Body',
                    'description' => 'Berikut adalah jawaban dan penjelasan untuk permainan Word Scramble tentang bagian tubuh.',
                    'items' => [
                        ['term' => 'HEAD', 'definition' => 'Kepala adalah bagian tubuh yang berisi otak, mata, telinga, hidung, dan mulut.'],
                        ['term' => 'EYES', 'definition' => 'Mata adalah organ yang digunakan untuk melihat dan menerima informasi visual.'],
                        ['term' => 'NOSE', 'definition' => 'Hidung adalah organ penciuman dan juga bagian dari sistem pernapasan.'],
                        ['term' => 'EARS', 'definition' => 'Telinga adalah organ yang digunakan untuk mendengar suara dan menjaga keseimbangan.'],
                        ['term' => 'MOUTH', 'definition' => 'Mulut adalah lubang di wajah yang digunakan untuk makan, berbicara, dan bernafas.'],
                        ['term' => 'HANDS', 'definition' => 'Tangan adalah bagian tubuh di ujung lengan yang memiliki lima jari.'],
                        ['term' => 'FEET', 'definition' => 'Kaki adalah bagian tubuh di ujung kaki yang digunakan untuk berdiri dan berjalan.'],
                        ['term' => 'ARMS', 'definition' => 'Lengan adalah anggota tubuh yang menghubungkan tangan ke bahu.'],
                        ['term' => 'LEGS', 'definition' => 'Kaki adalah anggota tubuh yang digunakan untuk berjalan, berlari, dan melompat.'],
                        ['term' => 'NECK', 'definition' => 'Leher adalah bagian tubuh yang menghubungkan kepala ke tubuh.']
                    ]
                ];

            case 'word-scramble-body':
                return [
                    'title' => 'Jawaban Word Scramble - Parts of Body',
                    'description' => 'Berikut adalah jawaban dan penjelasan untuk permainan Word Scramble tentang bagian tubuh.',
                    'items' => [
                        ['term' => 'HEAD', 'definition' => 'Kepala adalah bagian tubuh yang berisi otak, mata, telinga, hidung, dan mulut.'],
                        ['term' => 'EYES', 'definition' => 'Mata adalah organ yang digunakan untuk melihat dan menerima informasi visual.'],
                        ['term' => 'NOSE', 'definition' => 'Hidung adalah organ penciuman dan juga bagian dari sistem pernapasan.'],
                        ['term' => 'EARS', 'definition' => 'Telinga adalah organ yang digunakan untuk mendengar suara dan menjaga keseimbangan.'],
                        ['term' => 'MOUTH', 'definition' => 'Mulut adalah lubang di wajah yang digunakan untuk makan, berbicara, dan bernafas.'],
                        ['term' => 'HANDS', 'definition' => 'Tangan adalah bagian tubuh di ujung lengan yang memiliki lima jari.'],
                        ['term' => 'FEET', 'definition' => 'Kaki adalah bagian tubuh di ujung kaki yang digunakan untuk berdiri dan berjalan.'],
                        ['term' => 'ARMS', 'definition' => 'Lengan adalah anggota tubuh yang menghubungkan tangan ke bahu.'],
                        ['term' => 'LEGS', 'definition' => 'Kaki adalah anggota tubuh yang digunakan untuk berjalan, berlari, dan melompat.'],
                        ['term' => 'NECK', 'definition' => 'Leher adalah bagian tubuh yang menghubungkan kepala ke tubuh.']
                    ]
                ];

            case 'word-matching':
                return [
                    'title' => 'Jawaban Word Matching - Parts of Body',
                    'description' => 'Berikut adalah jawaban dan penjelasan untuk permainan Word Matching tentang bagian tubuh dan fungsinya.',
                    'items' => [
                        ['term' => 'Eyes', 'definition' => 'To see and receive visual information', 'translation' => 'Mata digunakan untuk melihat dan menerima informasi visual dari lingkungan sekitar.'],
                        ['term' => 'Nose', 'definition' => 'To smell and breathe', 'translation' => 'Hidung digunakan untuk mencium bau dan bernafas.'],
                        ['term' => 'Ears', 'definition' => 'To hear sounds and maintain balance', 'translation' => 'Telinga digunakan untuk mendengar suara dan menjaga keseimbangan tubuh.'],
                        ['term' => 'Mouth', 'definition' => 'To eat, talk, and breathe', 'translation' => 'Mulut digunakan untuk makan, berbicara, dan bernafas.'],
                        ['term' => 'Hands', 'definition' => 'To grab, hold, and manipulate objects', 'translation' => 'Tangan digunakan untuk mengambil, memegang, dan memanipulasi benda.'],
                        ['term' => 'Brain', 'definition' => 'To control the body and process information', 'translation' => 'Otak digunakan untuk mengontrol tubuh dan memproses informasi.'],
                        ['term' => 'Heart', 'definition' => 'To pump blood throughout the body', 'translation' => 'Jantung digunakan untuk memompa darah ke seluruh tubuh.'],
                        ['term' => 'Lungs', 'definition' => 'To take in oxygen and remove carbon dioxide', 'translation' => 'Paru-paru digunakan untuk menghirup oksigen dan mengeluarkan karbon dioksida.']
                    ]
                ];

            case 'word-matching-body':
                return [
                    'title' => 'Jawaban Word Matching - Parts of Body',
                    'description' => 'Berikut adalah jawaban dan penjelasan untuk permainan Word Matching tentang bagian tubuh dan fungsinya.',
                    'items' => [
                        ['term' => 'Eyes', 'definition' => 'To see and receive visual information', 'translation' => 'Mata digunakan untuk melihat dan menerima informasi visual dari lingkungan sekitar.'],
                        ['term' => 'Nose', 'definition' => 'To smell and breathe', 'translation' => 'Hidung digunakan untuk mencium bau dan bernafas.'],
                        ['term' => 'Ears', 'definition' => 'To hear sounds and maintain balance', 'translation' => 'Telinga digunakan untuk mendengar suara dan menjaga keseimbangan tubuh.'],
                        ['term' => 'Mouth', 'definition' => 'To eat, talk, and breathe', 'translation' => 'Mulut digunakan untuk makan, berbicara, dan bernafas.'],
                        ['term' => 'Hands', 'definition' => 'To grab, hold, and manipulate objects', 'translation' => 'Tangan digunakan untuk mengambil, memegang, dan memanipulasi benda.'],
                        ['term' => 'Brain', 'definition' => 'To control the body and process information', 'translation' => 'Otak digunakan untuk mengontrol tubuh dan memproses informasi.'],
                        ['term' => 'Heart', 'definition' => 'To pump blood throughout the body', 'translation' => 'Jantung digunakan untuk memompa darah ke seluruh tubuh.'],
                        ['term' => 'Lungs', 'definition' => 'To take in oxygen and remove carbon dioxide', 'translation' => 'Paru-paru digunakan untuk menghirup oksigen dan mengeluarkan karbon dioksida.']
                    ]
                ];

            case 'word-search':
                return [
                    'title' => 'Jawaban Word Search - Parts of Body',
                    'description' => 'Berikut adalah jawaban dan penjelasan untuk permainan Word Search tentang bagian tubuh.',
                    'items' => [
                        ['term' => 'HEAD', 'definition' => 'Kepala adalah bagian tubuh yang berisi otak, mata, telinga, hidung, dan mulut.'],
                        ['term' => 'HAND', 'definition' => 'Tangan adalah bagian tubuh di ujung lengan yang memiliki lima jari.'],
                        ['term' => 'FOOT', 'definition' => 'Kaki adalah bagian tubuh di ujung kaki yang digunakan untuk berdiri dan berjalan.'],
                        ['term' => 'ARM', 'definition' => 'Lengan adalah anggota tubuh yang menghubungkan tangan ke bahu.'],
                        ['term' => 'LEG', 'definition' => 'Kaki adalah anggota tubuh yang digunakan untuk berjalan, berlari, dan melompat.'],
                        ['term' => 'EYE', 'definition' => 'Mata adalah organ yang digunakan untuk melihat dan menerima informasi visual.'],
                        ['term' => 'EAR', 'definition' => 'Telinga adalah organ yang digunakan untuk mendengar suara dan menjaga keseimbangan.'],
                        ['term' => 'NOSE', 'definition' => 'Hidung adalah organ penciuman dan juga bagian dari sistem pernapasan.'],
                        ['term' => 'MOUTH', 'definition' => 'Mulut adalah lubang di wajah yang digunakan untuk makan, berbicara, dan bernafas.'],
                        ['term' => 'NECK', 'definition' => 'Leher adalah bagian tubuh yang menghubungkan kepala ke tubuh.']
                    ]
                ];

            case 'word-search-body':
                return [
                    'title' => 'Jawaban Word Search - Parts of Body',
                    'description' => 'Berikut adalah jawaban dan penjelasan untuk permainan Word Search tentang bagian tubuh.',
                    'items' => [
                        ['term' => 'HEAD', 'definition' => 'Kepala adalah bagian tubuh yang berisi otak, mata, telinga, hidung, dan mulut.'],
                        ['term' => 'HAND', 'definition' => 'Tangan adalah bagian tubuh di ujung lengan yang memiliki lima jari.'],
                        ['term' => 'FOOT', 'definition' => 'Kaki adalah bagian tubuh di ujung kaki yang digunakan untuk berdiri dan berjalan.'],
                        ['term' => 'ARM', 'definition' => 'Lengan adalah anggota tubuh yang menghubungkan tangan ke bahu.'],
                        ['term' => 'LEG', 'definition' => 'Kaki adalah anggota tubuh yang digunakan untuk berjalan, berlari, dan melompat.'],
                        ['term' => 'EYE', 'definition' => 'Mata adalah organ yang digunakan untuk melihat dan menerima informasi visual.'],
                        ['term' => 'EAR', 'definition' => 'Telinga adalah organ yang digunakan untuk mendengar suara dan menjaga keseimbangan.'],
                        ['term' => 'NOSE', 'definition' => 'Hidung adalah organ penciuman dan juga bagian dari sistem pernapasan.'],
                        ['term' => 'MOUTH', 'definition' => 'Mulut adalah lubang di wajah yang digunakan untuk makan, berbicara, dan bernafas.'],
                        ['term' => 'NECK', 'definition' => 'Leher adalah bagian tubuh yang menghubungkan kepala ke tubuh.']
                    ]
                ];

            case 'word-scramble-illness':
                return [
                    'title' => 'Jawaban Word Scramble - Kind of Illness',
                    'description' => 'Berikut adalah jawaban dan penjelasan untuk permainan Word Scramble tentang jenis penyakit.',
                    'items' => [
                        ['term' => 'FEVER', 'definition' => 'Demam adalah saat badanmu terasa panas dan hangat.'],
                        ['term' => 'COLD', 'definition' => 'Pilek adalah saat hidungmu berair dan kamu sering bersin.'],
                        ['term' => 'COUGH', 'definition' => 'Batuk adalah saat tenggorokanmu gatal dan kamu berkata "uhuk uhuk".'],
                        ['term' => 'HEADACHE', 'definition' => 'Sakit kepala adalah rasa tidak nyaman di kepalamu.'],
                        ['term' => 'TOOTHACHE', 'definition' => 'Sakit gigi adalah rasa sakit yang kamu rasakan pada gigimu.'],
                        ['term' => 'FLU', 'definition' => 'Flu adalah saat kamu demam, pilek, dan merasa lemah.'],
                        ['term' => 'SORE', 'definition' => 'Sakit tenggorokan adalah rasa sakit saat kamu menelan.'],
                        ['term' => 'RASH', 'definition' => 'Ruam adalah bintik-bintik merah pada kulitmu yang terasa gatal.'],
                        ['term' => 'EARACHE', 'definition' => 'Sakit telinga adalah rasa sakit yang kamu rasakan pada telingamu.'],
                        ['term' => 'SNEEZE', 'definition' => 'Bersin adalah saat hidungmu gatal dan kamu berkata "hatsyi!"']
                    ]
                ];

            case 'word-matching-illness':
                return [
                    'title' => 'Jawaban Word Matching - Kind of Illness',
                    'description' => 'Berikut adalah jawaban dan penjelasan untuk permainan Word Matching tentang jenis penyakit dan gejalanya.',
                    'items' => [
                        ['term' => 'Fever', 'definition' => 'Badan terasa panas dan hangat', 'translation' => 'Demam terjadi ketika suhu tubuh naik di atas tingkat normal, biasanya karena tubuh melawan infeksi.'],
                        ['term' => 'Cold', 'definition' => 'Hidung berair dan sering bersin', 'translation' => 'Pilek disebabkan oleh virus yang menyebabkan hidung tersumbat, bersin, dan kadang sakit tenggorokan.'],
                        ['term' => 'Cough', 'definition' => 'Berkata "uhuk uhuk" dan tenggorokan gatal', 'translation' => 'Batuk adalah refleks tubuh untuk membersihkan saluran pernapasan dari irritan.'],
                        ['term' => 'Headache', 'definition' => 'Rasa sakit di kepala', 'translation' => 'Sakit kepala adalah rasa nyeri atau tidak nyaman di kepala, bisa ringan sampai berat.'],
                        ['term' => 'Toothache', 'definition' => 'Rasa sakit di gigi atau saat mengunyah', 'translation' => 'Sakit gigi biasanya disebabkan oleh kerusakan gigi, infeksi, atau radang gusi.'],
                        ['term' => 'Flu', 'definition' => 'Demam, pilek, dan badan terasa lemah', 'translation' => 'Flu adalah infeksi virus yang menyerang sistem pernapasan dengan gejala lebih berat dari pilek biasa.'],
                        ['term' => 'Sore Throat', 'definition' => 'Sakit saat menelan makanan atau minuman', 'translation' => 'Sakit tenggorokan adalah rasa nyeri, kering, atau gatal di tenggorokan yang memburuk saat menelan.'],
                        ['term' => 'Sneeze', 'definition' => 'Berkata "hatsyi!" saat hidung gatal', 'translation' => 'Bersin adalah refleks tubuh yang mengeluarkan udara dengan kuat melalui hidung dan mulut.']
                    ]
                ];

            case 'word-search-illness':
                return [
                    'title' => 'Jawaban Word Search - Kind of Illness',
                    'description' => 'Berikut adalah jawaban dan penjelasan untuk permainan Word Search tentang jenis penyakit.',
                    'items' => [
                        ['term' => 'FEVER', 'definition' => 'Demam adalah saat suhu tubuh meningkat di atas normal, biasanya karena infeksi.'],
                        ['term' => 'COLD', 'definition' => 'Pilek adalah infeksi virus pada saluran pernapasan atas dengan gejala seperti hidung tersumbat.'],
                        ['term' => 'COUGH', 'definition' => 'Batuk adalah refleks tubuh untuk membersihkan saluran pernapasan dari irritan.'],
                        ['term' => 'HEAD', 'definition' => 'Bagian tubuh yang berisi otak, bisa mengalami sakit kepala (headache).'],
                        ['term' => 'TOOTH', 'definition' => 'Bagian keras di mulut yang digunakan untuk mengunyah, bisa mengalami sakit gigi (toothache).'],
                        ['term' => 'FLU', 'definition' => 'Influenza, penyakit yang disebabkan virus dengan gejala lebih berat dari pilek biasa.'],
                        ['term' => 'SICK', 'definition' => 'Kondisi tidak sehat atau merasa tidak enak badan.'],
                        ['term' => 'EAR', 'definition' => 'Organ pendengaran yang bisa mengalami sakit telinga (earache).'],
                        ['term' => 'SNEEZE', 'definition' => 'Tindakan mengeluarkan udara dengan kuat melalui hidung dan mulut, biasanya karena iritasi.'],
                        ['term' => 'PAIN', 'definition' => 'Rasa tidak nyaman yang merupakan tanda adanya masalah di tubuh.']
                    ]
                ];

            case 'word-scramble-house':
                return [
                    'title' => 'Jawaban Word Scramble - Parts of House',
                    'description' => 'Berikut adalah jawaban dan penjelasan untuk permainan Word Scramble tentang bagian rumah.',
                    'items' => [
                        ['term' => 'KITCHEN', 'definition' => 'Dapur adalah ruangan tempat menyiapkan dan memasak makanan.'],
                        ['term' => 'BEDROOM', 'definition' => 'Kamar tidur adalah ruangan yang digunakan untuk tidur dan beristirahat.'],
                        ['term' => 'BATHROOM', 'definition' => 'Kamar mandi adalah ruangan untuk mandi, mencuci, dan menggunakan toilet.'],
                        ['term' => 'LIVING', 'definition' => 'Ruang tamu adalah tempat untuk bersantai dan menerima tamu.'],
                        ['term' => 'DINING', 'definition' => 'Ruang makan adalah tempat anggota keluarga berkumpul untuk makan bersama.'],
                        ['term' => 'GARAGE', 'definition' => 'Garasi adalah ruangan untuk menyimpan dan memarkir kendaraan.'],
                        ['term' => 'ATTIC', 'definition' => 'Loteng adalah ruangan di bawah atap yang sering digunakan untuk penyimpanan.'],
                        ['term' => 'BASEMENT', 'definition' => 'Ruang bawah tanah adalah ruangan yang terletak di bawah rumah, kadang digunakan untuk penyimpanan.'],
                        ['term' => 'WINDOW', 'definition' => 'Jendela adalah bukaan pada dinding yang memungkinkan cahaya dan udara masuk ke dalam rumah.'],
                        ['term' => 'DOOR', 'definition' => 'Pintu adalah struktur yang memungkinkan orang masuk dan keluar ruangan atau bangunan.']
                    ]
                ];

            case 'word-matching-house':
                return [
                    'title' => 'Jawaban Word Matching - Parts of House',
                    'description' => 'Berikut adalah jawaban dan penjelasan untuk permainan Word Matching tentang bagian rumah dan fungsinya.',
                    'items' => [
                        ['term' => 'Kitchen', 'definition' => 'A place to cook and prepare food', 'translation' => 'Dapur adalah tempat untuk memasak dan menyiapkan makanan.'],
                        ['term' => 'Bedroom', 'definition' => 'A place to sleep and rest', 'translation' => 'Kamar tidur adalah tempat untuk tidur dan beristirahat.'],
                        ['term' => 'Bathroom', 'definition' => 'A place to take a bath and use toilet', 'translation' => 'Kamar mandi adalah tempat untuk mandi dan menggunakan toilet.'],
                        ['term' => 'Living Room', 'definition' => 'A place to relax and entertain guests', 'translation' => 'Ruang tamu adalah tempat untuk bersantai dan menerima tamu.'],
                        ['term' => 'Dining Room', 'definition' => 'A place to eat meals', 'translation' => 'Ruang makan adalah tempat untuk makan bersama keluarga.'],
                        ['term' => 'Garage', 'definition' => 'A place to park vehicles', 'translation' => 'Garasi adalah tempat untuk memarkir kendaraan.'],
                        ['term' => 'Attic', 'definition' => 'A space just below the roof for storage', 'translation' => 'Loteng adalah ruangan di bawah atap yang digunakan untuk penyimpanan.'],
                        ['term' => 'Basement', 'definition' => 'An underground space for storage or activities', 'translation' => 'Ruang bawah tanah adalah ruangan di bawah rumah untuk penyimpanan atau aktivitas.']
                    ]
                ];

            case 'word-search-house':
                return [
                    'title' => 'Jawaban Word Search - Parts of House',
                    'description' => 'Berikut adalah jawaban dan penjelasan untuk permainan Word Search tentang bagian rumah.',
                    'items' => [
                        ['term' => 'KITCHEN', 'definition' => 'Dapur adalah ruangan tempat menyiapkan dan memasak makanan.'],
                        ['term' => 'BEDROOM', 'definition' => 'Kamar tidur adalah ruangan yang digunakan untuk tidur dan beristirahat.'],
                        ['term' => 'BATH', 'definition' => 'Bak mandi adalah tempat untuk mandi dalam kamar mandi.'],
                        ['term' => 'LIVING', 'definition' => 'Ruang tamu adalah tempat untuk bersantai dan menerima tamu.'],
                        ['term' => 'DINING', 'definition' => 'Ruang makan adalah tempat anggota keluarga berkumpul untuk makan bersama.'],
                        ['term' => 'GARAGE', 'definition' => 'Garasi adalah ruangan untuk menyimpan dan memarkir kendaraan.'],
                        ['term' => 'ATTIC', 'definition' => 'Loteng adalah ruangan di bawah atap yang sering digunakan untuk penyimpanan.'],
                        ['term' => 'DOOR', 'definition' => 'Pintu adalah struktur yang memungkinkan orang masuk dan keluar ruangan atau bangunan.'],
                        ['term' => 'WINDOW', 'definition' => 'Jendela adalah bukaan pada dinding yang memungkinkan cahaya dan udara masuk ke dalam rumah.'],
                        ['term' => 'ROOF', 'definition' => 'Atap adalah bagian atas rumah yang melindungi dari hujan, panas, dan cuaca.']
                    ]
                ];

            // Removed image-guessing-body case

            case 'image-matching-house':
                return [
                    'title' => 'Jawaban Image Matching - Parts of House',
                    'description' => 'Berikut adalah jawaban dan penjelasan untuk permainan mencocokkan gambar dengan nama bagian rumah.',
                    'items' => [
                        ['word' => 'KITCHEN', 'definition' => 'Dapur adalah ruangan tempat menyiapkan dan memasak makanan.', 'hint' => 'Tempat memasak makanan'],
                        ['word' => 'BEDROOM', 'definition' => 'Kamar tidur adalah ruangan yang digunakan untuk tidur dan beristirahat.', 'hint' => 'Tempat untuk tidur'],
                        ['word' => 'BATHROOM', 'definition' => 'Kamar mandi adalah ruangan untuk mandi, mencuci, dan menggunakan toilet.', 'hint' => 'Tempat untuk mandi'],
                        ['word' => 'LIVING ROOM', 'definition' => 'Ruang tamu adalah tempat untuk bersantai dan menerima tamu.', 'hint' => 'Tempat menerima tamu'],
                        ['word' => 'DINING ROOM', 'definition' => 'Ruang makan adalah tempat anggota keluarga berkumpul untuk makan bersama.', 'hint' => 'Tempat makan bersama'],
                        ['word' => 'GARAGE', 'definition' => 'Garasi adalah ruangan untuk menyimpan dan memarkir kendaraan.', 'hint' => 'Tempat memarkir mobil'],
                        ['word' => 'ATTIC', 'definition' => 'Loteng adalah ruangan di bawah atap yang sering digunakan untuk penyimpanan.', 'hint' => 'Ruangan di bawah atap'],
                        ['word' => 'BASEMENT', 'definition' => 'Ruang bawah tanah adalah ruangan yang terletak di bawah rumah.', 'hint' => 'Ruangan di bawah rumah']
                    ]
                ];

            case 'sentence-scramble':
                return [
                    'title' => 'Jawaban Sentence Scramble - Parts of Body',
                    'description' => 'Berikut adalah jawaban dan penjelasan untuk permainan Sentence Scramble tentang penggunaan bagian tubuh.',
                    'items' => [
                        ['term' => 'Selena uses her ears to listen the music', 'definition' => 'Selena menggunakan telinganya untuk mendengarkan musik.'],
                        ['term' => 'Kowin uses his foot to play makan kerupuk competition', 'definition' => 'Kowin menggunakan kakinya untuk bermain lomba makan kerupuk.'],
                        ['term' => 'Adit uses his hand to pick an melon', 'definition' => 'Adit menggunakan tangannya untuk mengambil melon.'],
                        ['term' => 'They use their nose to smell a flower', 'definition' => 'Mereka menggunakan hidung mereka untuk mencium bunga.'],
                        ['term' => 'Kimmy uses her eyes to see beautiful scenery', 'definition' => 'Kimmy menggunakan matanya untuk melihat pemandangan indah.'],
                        ['term' => 'We use our hands to write a letter', 'definition' => 'Kami menggunakan tangan kami untuk menulis surat.'],
                        ['term' => 'The chef uses his fingers to taste the soup', 'definition' => 'Koki itu menggunakan jarinya untuk mencicipi sup.'],
                        ['term' => 'She uses her mouth to speak English', 'definition' => 'Dia menggunakan mulutnya untuk berbicara bahasa Inggris.'],
                        ['term' => 'The doctor uses his brain to solve medical problems', 'definition' => 'Dokter itu menggunakan otaknya untuk memecahkan masalah medis.'],
                        ['term' => 'Athletes use their legs to run fast', 'definition' => 'Atlet menggunakan kaki mereka untuk berlari cepat.']
                    ]
                ];

            default:
                return [
                    'title' => 'Jawaban Tidak Tersedia',
                    'description' => 'Maaf, jawaban untuk permainan ini belum tersedia.',
                    'items' => []
                ];
        }
    }
}
