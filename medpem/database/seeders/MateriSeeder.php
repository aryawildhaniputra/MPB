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
            'description' => 'Learn the names of body parts in English with pictures.',
            'content' => '<h1>Parts of My Body (Bagian-Bagian Tubuh)</h1>
<p>In this material, you will learn the names of body parts in English.</p>
<h2>External Body Parts (Bagian Luar Tubuh)</h2>
<p><img src="/images/materi/infograph.png" alt="External Body Parts"></p>
<h3>External Body Parts Vocabulary:</h3>
<p><strong>Head</strong> - Kepala</p>
<p><strong>Eye</strong> - Mata</p>
<p><strong>Eyebrow</strong> - Alis</p>
<p><strong>Ear</strong> - Telinga</p>
<p><strong>Nose</strong> - Hidung</p>
<p><strong>Lip</strong> - Bibir</p>
<p><strong>Mouth</strong> - Mulut</p>
<p><strong>Tongue</strong> - Lidah</p>
<p><strong>Arm</strong> - Lengan</p>
<p><strong>Hand</strong> - Tangan</p>
<p><strong>Leg</strong> - Kaki</p>
<p><strong>Foot</strong> - Telapak kaki</p>
<h2>Internal Body Parts (Bagian Dalam Tubuh)</h2>
<p><img src="/images/materi/infograph2.png" alt="Internal Body Parts"></p>
<h3>Internal Body Parts Vocabulary:</h3>
<p><strong>Brain</strong> - Otak</p>
<p><strong>Heart</strong> - Jantung</p>
<p><strong>Lungs</strong> - Paru-paru</p>
<p><strong>Liver</strong> - Hati</p>
<p><strong>Stomach</strong> - Lambung</p>
<p><strong>Intestine</strong> - Usus</p>
<p><strong>Kidneys</strong> - Ginjal</p>
<p><strong>Pancreas</strong> - Pankreas</p>
<p><strong>Spleen</strong> - Limpa</p>
<p><strong>Bladder</strong> - Kandung kemih</p>
<p><strong>Thyroid</strong> - Kelenjar tiroid</p>
<h2>Simple Sentences</h2>
<ul>
<li>I have two eyes. <em>(Saya punya dua mata.)</em></li>
<li>This is my hand. <em>(Ini tangan saya.)</em></li>
<li>I can touch my nose. <em>(Saya bisa menyentuh hidung saya.)</em></li>
<li>My head hurts. <em>(Kepala saya sakit.)</em></li>
<li>I wash my hands. <em>(Saya mencuci tangan saya.)</em></li>
</ul>'
        ]);

        Materi::create([
            'title' => 'Kinds of Illness',
            'description' => 'Learn about various types of illnesses and health complaints in English.',
            'content' => '<h1>Kinds of Illness (Jenis-Jenis Penyakit)</h1>
<p>In this material, you will learn the names of illnesses and health complaints in English:</p>
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
<p>Knowing vocabulary about illnesses in English is very important when you are abroad or speaking with a doctor who uses English.</p>'
        ]);

        Materi::create([
            'title' => 'Body Movement and Actions',
            'description' => 'Learn about body movements and activities in English.',
            'content' => '<h1>Body Movement and Actions (Gerakan dan Aksi Tubuh)</h1>
<p>In this material, you will learn verbs and expressions related to body movements:</p>
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
<h2>Example Sentences</h2>
<ol>
    <li><strong>I can jump high.</strong> - Saya bisa melompat tinggi.</li>
    <li><strong>She is waving her hand.</strong> - Dia melambai-lambaikan tangannya.</li>
    <li><strong>They are dancing together.</strong> - Mereka menari bersama.</li>
    <li><strong>He nodded his head.</strong> - Dia menganggukkan kepalanya.</li>
</ol>
<p>Learning body movement verbs helps you to describe daily activities in English.</p>'
        ]);
    }
}
