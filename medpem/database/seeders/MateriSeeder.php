<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materi;

class MateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Materi::create([
            'title' => 'Parts of My Body',
            'description' => 'Learn the names of body parts in English.',
            'content' => '<div class="materi-content">
    <h1>Parts of My Body (Bagian-Bagian Tubuh)</h1>
    <p>In this material, you will learn the names of body parts in English:</p>

    <div class="section">
        <h2>Head Parts (Bagian Kepala)</h2>
        <ol>
            <li><strong>Head</strong> - Kepala</li>
            <li><strong>Hair</strong> - Rambut</li>
            <li><strong>Eye</strong> - Mata</li>
            <li><strong>Ear</strong> - Telinga</li>
            <li><strong>Nose</strong> - Hidung</li>
            <li><strong>Mouth</strong> - Mulut</li>
            <li><strong>Lip</strong> - Bibir</li>
            <li><strong>Tooth/Teeth</strong> - Gigi</li>
            <li><strong>Tongue</strong> - Lidah</li>
            <li><strong>Chin</strong> - Dagu</li>
            <li><strong>Cheek</strong> - Pipi</li>
            <li><strong>Forehead</strong> - Dahi</li>
            <li><strong>Eyebrow</strong> - Alis</li>
            <li><strong>Eyelash</strong> - Bulu mata</li>
            <li><strong>Jaw</strong> - Rahang</li>
        </ol>
    </div>

    <div class="section">
        <h2>Body Parts (Bagian Tubuh)</h2>
        <ol>
            <li><strong>Neck</strong> - Leher</li>
            <li><strong>Shoulder</strong> - Bahu</li>
            <li><strong>Chest</strong> - Dada</li>
            <li><strong>Arm</strong> - Lengan</li>
            <li><strong>Elbow</strong> - Siku</li>
            <li><strong>Hand</strong> - Tangan</li>
            <li><strong>Finger</strong> - Jari tangan</li>
            <li><strong>Stomach</strong> - Perut</li>
            <li><strong>Back</strong> - Punggung</li>
            <li><strong>Waist</strong> - Pinggang</li>
            <li><strong>Hip</strong> - Pinggul</li>
            <li><strong>Wrist</strong> - Pergelangan tangan</li>
            <li><strong>Palm</strong> - Telapak tangan</li>
            <li><strong>Thumb</strong> - Ibu jari</li>
            <li><strong>Index finger</strong> - Jari telunjuk</li>
            <li><strong>Middle finger</strong> - Jari tengah</li>
            <li><strong>Ring finger</strong> - Jari manis</li>
            <li><strong>Little finger</strong> - Jari kelingking</li>
        </ol>
    </div>

    <div class="section">
        <h2>Leg Parts (Bagian Kaki)</h2>
        <ol>
            <li><strong>Leg</strong> - Kaki</li>
            <li><strong>Knee</strong> - Lutut</li>
            <li><strong>Foot/Feet</strong> - Kaki (bagian bawah)</li>
            <li><strong>Toe</strong> - Jari kaki</li>
            <li><strong>Ankle</strong> - Pergelangan kaki</li>
            <li><strong>Heel</strong> - Tumit</li>
            <li><strong>Thigh</strong> - Paha</li>
            <li><strong>Calf</strong> - Betis</li>
            <li><strong>Shin</strong> - Tulang kering</li>
            <li><strong>Sole</strong> - Telapak kaki</li>
        </ol>
    </div>

    <div class="section">
        <h2>Internal Body Parts (Bagian Tubuh Internal)</h2>
        <ol>
            <li><strong>Heart</strong> - Jantung</li>
            <li><strong>Lung</strong> - Paru-paru</li>
            <li><strong>Brain</strong> - Otak</li>
            <li><strong>Liver</strong> - Hati</li>
            <li><strong>Kidney</strong> - Ginjal</li>
            <li><strong>Intestine</strong> - Usus</li>
            <li><strong>Bone</strong> - Tulang</li>
            <li><strong>Muscle</strong> - Otot</li>
            <li><strong>Blood vessel</strong> - Pembuluh darah</li>
            <li><strong>Nerve</strong> - Saraf</li>
        </ol>
    </div>

    <div class="section">
        <h2>Simple Sentence Examples</h2>
        <ul>
            <li>I have two eyes. <em>(Saya punya dua mata.)</em></li>
            <li>This is my hand. <em>(Ini tangan saya.)</em></li>
            <li>I can touch my nose. <em>(Saya bisa menyentuh hidung saya.)</em></li>
            <li>My head hurts. <em>(Kepala saya sakit.)</em></li>
            <li>I wash my hands. <em>(Saya mencuci tangan saya.)</em></li>
            <li>She has long hair. <em>(Dia memiliki rambut panjang.)</em></li>
            <li>He broke his leg. <em>(Dia mematahkan kakinya.)</em></li>
            <li>My heart beats fast. <em>(Jantung saya berdetak cepat.)</em></li>
            <li>I hurt my ankle. <em>(Saya melukai pergelangan kaki saya.)</em></li>
            <li>She has beautiful eyes. <em>(Dia memiliki mata yang indah.)</em></li>
        </ul>
        <p>It\'s important to know the body parts in English so you can communicate well about your body condition.</p>
    </div>
</div>'
        ]);

        Materi::create([
            'title' => 'Kinds of Illness',
            'description' => 'Learn about various types of illnesses and health complaints in English.',
            'content' => '<div class="materi-content">
    <h1>Kinds of Illness (Jenis-Jenis Penyakit)</h1>
    <p>In this material, you will learn the names of illnesses and health complaints in English:</p>

    <div class="section">
        <h2>Common Complaints (Keluhan Umum)</h2>
        <ol>
            <li><strong>Headache</strong> - Sakit kepala</li>
            <li><strong>Stomachache</strong> - Sakit perut</li>
            <li><strong>Fever</strong> - Demam</li>
            <li><strong>Cold</strong> - Pilek</li>
            <li><strong>Cough</strong> - Batuk</li>
            <li><strong>Sore throat</strong> - Sakit tenggorokan</li>
            <li><strong>Toothache</strong> - Sakit gigi</li>
            <li><strong>Earache</strong> - Sakit telinga</li>
            <li><strong>Backache</strong> - Sakit punggung</li>
            <li><strong>Dizziness</strong> - Pusing</li>
            <li><strong>Nausea</strong> - Mual</li>
            <li><strong>Vomiting</strong> - Muntah</li>
            <li><strong>Runny nose</strong> - Hidung berair</li>
            <li><strong>Stuffy nose</strong> - Hidung tersumbat</li>
            <li><strong>Sneezing</strong> - Bersin</li>
        </ol>
    </div>

    <div class="section">
        <h2>Health Conditions (Kondisi Kesehatan)</h2>
        <ol>
            <li><strong>Flu</strong> - Influenza</li>
            <li><strong>Allergy</strong> - Alergi</li>
            <li><strong>Rash</strong> - Ruam</li>
            <li><strong>Injury</strong> - Cedera</li>
            <li><strong>Wound</strong> - Luka</li>
            <li><strong>Broken bone</strong> - Patah tulang</li>
            <li><strong>Sprain</strong> - Keseleo</li>
            <li><strong>Bruise</strong> - Memar</li>
            <li><strong>Cut</strong> - Luka sayat</li>
            <li><strong>Burn</strong> - Luka bakar</li>
            <li><strong>Infection</strong> - Infeksi</li>
            <li><strong>Inflammation</strong> - Peradangan</li>
            <li><strong>Swelling</strong> - Bengkak</li>
            <li><strong>Itching</strong> - Gatal</li>
            <li><strong>Bleeding</strong> - Pendarahan</li>
        </ol>
    </div>

    <div class="section">
        <h2>Chronic Conditions (Kondisi Kronis)</h2>
        <ol>
            <li><strong>Diabetes</strong> - Diabetes</li>
            <li><strong>High blood pressure</strong> - Tekanan darah tinggi</li>
            <li><strong>Asthma</strong> - Asma</li>
            <li><strong>Arthritis</strong> - Radang sendi</li>
            <li><strong>Heart disease</strong> - Penyakit jantung</li>
            <li><strong>Migraine</strong> - Migren</li>
            <li><strong>Allergies</strong> - Alergi</li>
            <li><strong>Bronchitis</strong> - Bronkitis</li>
            <li><strong>Sinusitis</strong> - Sinusitis</li>
            <li><strong>Gastritis</strong> - Radang lambung</li>
        </ol>
    </div>

    <div class="section">
        <h2>Expressions When Sick (Ungkapan Ketika Sakit)</h2>
        <ol>
            <li><strong>I feel sick.</strong> - Saya merasa sakit.</li>
            <li><strong>I have a headache.</strong> - Saya sakit kepala.</li>
            <li><strong>My stomach hurts.</strong> - Perut saya sakit.</li>
            <li><strong>I have a fever.</strong> - Saya demam.</li>
            <li><strong>I need to see a doctor.</strong> - Saya perlu pergi ke dokter.</li>
            <li><strong>I need medicine.</strong> - Saya butuh obat.</li>
            <li><strong>I don\'t feel well.</strong> - Saya merasa tidak enak badan.</li>
            <li><strong>I feel dizzy.</strong> - Saya merasa pusing.</li>
            <li><strong>I feel nauseous.</strong> - Saya merasa mual.</li>
            <li><strong>My throat is sore.</strong> - Tenggorokan saya sakit.</li>
            <li><strong>I have a cold.</strong> - Saya sedang pilek.</li>
            <li><strong>I\'m allergic to...</strong> - Saya alergi terhadap...</li>
        </ol>
    </div>

    <div class="section">
        <h2>Asking About Condition (Cara Menanyakan Kondisi)</h2>
        <ol>
            <li><strong>What\'s wrong?</strong> - Ada apa?</li>
            <li><strong>Are you feeling okay?</strong> - Apakah kamu merasa baik-baik saja?</li>
            <li><strong>Where does it hurt?</strong> - Di mana yang sakit?</li>
            <li><strong>How long have you been sick?</strong> - Sudah berapa lama kamu sakit?</li>
            <li><strong>Have you taken any medicine?</strong> - Sudah minum obat?</li>
            <li><strong>Do you need to see a doctor?</strong> - Apakah kamu perlu ke dokter?</li>
            <li><strong>Is it getting better?</strong> - Apakah sudah membaik?</li>
            <li><strong>When did it start?</strong> - Kapan mulainya?</li>
            <li><strong>How do you feel now?</strong> - Bagaimana perasaanmu sekarang?</li>
            <li><strong>Does it hurt when...?</strong> - Apakah sakit ketika...?</li>
        </ol>
        <p>Knowing vocabulary about illnesses in English is very important when you are abroad or speaking with a doctor who uses English.</p>
    </div>
</div>'
        ]);

        Materi::create([
            'title' => 'Body Movement and Actions',
            'description' => 'Learn about body movements and activities in English.',
            'content' => '<div class="materi-content">
    <h1>Body Movement and Actions (Gerakan dan Aksi Tubuh)</h1>
    <p>In this material, you will learn verbs and expressions related to body movements:</p>

    <div class="section">
        <h2>Basic Movements (Gerakan Dasar)</h2>
        <ol>
            <li><strong>Walk</strong> - Berjalan</li>
            <li><strong>Run</strong> - Berlari</li>
            <li><strong>Jump</strong> - Melompat</li>
            <li><strong>Skip</strong> - Melompat-lompat</li>
            <li><strong>Hop</strong> - Melompat dengan satu kaki</li>
            <li><strong>Dance</strong> - Menari</li>
            <li><strong>Swim</strong> - Berenang</li>
            <li><strong>Climb</strong> - Memanjat</li>
        </ol>
    </div>

    <div class="section">
        <h2>Hand Movements (Gerakan Tangan)</h2>
        <ol>
            <li><strong>Wave</strong> - Melambai</li>
            <li><strong>Clap</strong> - Bertepuk tangan</li>
            <li><strong>Grab</strong> - Menggenggam</li>
            <li><strong>Touch</strong> - Menyentuh</li>
            <li><strong>Point</strong> - Menunjuk</li>
            <li><strong>Throw</strong> - Melempar</li>
            <li><strong>Catch</strong> - Menangkap</li>
            <li><strong>Push</strong> - Mendorong</li>
            <li><strong>Pull</strong> - Menarik</li>
        </ol>
    </div>

    <div class="section">
        <h2>Head Movements (Gerakan Kepala)</h2>
        <ol>
            <li><strong>Nod</strong> - Mengangguk</li>
            <li><strong>Shake</strong> - Menggeleng</li>
            <li><strong>Look</strong> - Melihat</li>
            <li><strong>Blink</strong> - Berkedip</li>
            <li><strong>Smile</strong> - Tersenyum</li>
            <li><strong>Laugh</strong> - Tertawa</li>
            <li><strong>Cry</strong> - Menangis</li>
        </ol>
    </div>

    <div class="section">
        <h2>Example Sentences</h2>
        <ol>
            <li><strong>I can jump high.</strong> - Saya bisa melompat tinggi.</li>
            <li><strong>She is waving her hand.</strong> - Dia melambai-lambaikan tangannya.</li>
            <li><strong>They are dancing together.</strong> - Mereka menari bersama.</li>
            <li><strong>He nodded his head.</strong> - Dia menganggukkan kepalanya.</li>
        </ol>
        <p>Learning body movement verbs helps you to describe daily activities in English.</p>
    </div>
</div>'
        ]);
    }
}
