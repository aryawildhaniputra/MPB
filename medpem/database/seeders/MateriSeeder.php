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
            'content' => "# Parts of My Body (Bagian-Bagian Tubuh)

In this material, you will learn the names of body parts in English:

## Head Parts (Bagian Kepala)
1. **Head** - Kepala
2. **Hair** - Rambut
3. **Eye** - Mata
4. **Ear** - Telinga
5. **Nose** - Hidung
6. **Mouth** - Mulut
7. **Lip** - Bibir
8. **Tooth/Teeth** - Gigi

## Body Parts (Bagian Tubuh)
1. **Neck** - Leher
2. **Shoulder** - Bahu
3. **Chest** - Dada
4. **Arm** - Lengan
5. **Elbow** - Siku
6. **Hand** - Tangan
7. **Finger** - Jari tangan
8. **Stomach** - Perut

## Leg Parts (Bagian Kaki)
1. **Leg** - Kaki
2. **Knee** - Lutut
3. **Foot/Feet** - Kaki (bagian bawah)
4. **Toe** - Jari kaki

## Simple Sentence Examples
- I have two eyes. (Saya punya dua mata.)
- This is my hand. (Ini tangan saya.)
- I can touch my nose. (Saya bisa menyentuh hidung saya.)
- My head hurts. (Kepala saya sakit.)
- I wash my hands. (Saya mencuci tangan saya.)

It's important to know the body parts in English so you can communicate well about your body condition."
        ]);

        Materi::create([
            'title' => 'Kinds of Illness',
            'description' => 'Learn about various types of illnesses and health complaints in English.',
            'content' => "# Kinds of Illness (Jenis-Jenis Penyakit)

In this material, you will learn the names of illnesses and health complaints in English:

## Common Complaints (Keluhan Umum)
1. **Headache** - Sakit kepala
2. **Stomachache** - Sakit perut
3. **Fever** - Demam
4. **Cold** - Pilek
5. **Cough** - Batuk
6. **Sore throat** - Sakit tenggorokan
7. **Toothache** - Sakit gigi
8. **Earache** - Sakit telinga

## Health Conditions (Kondisi Kesehatan)
1. **Flu** - Influenza
2. **Allergy** - Alergi
3. **Rash** - Ruam
4. **Injury** - Cedera
5. **Wound** - Luka
6. **Broken bone** - Patah tulang

## Expressions When Sick (Ungkapan Ketika Sakit)
1. **I feel sick.** - Saya merasa sakit.
2. **I have a headache.** - Saya sakit kepala.
3. **My stomach hurts.** - Perut saya sakit.
4. **I have a fever.** - Saya demam.
5. **I need to see a doctor.** - Saya perlu pergi ke dokter.
6. **I need medicine.** - Saya butuh obat.

## Asking About Condition (Cara Menanyakan Kondisi)
1. **What's wrong?** - Ada apa?
2. **Are you feeling okay?** - Apakah kamu merasa baik-baik saja?
3. **Where does it hurt?** - Di mana yang sakit?
4. **How long have you been sick?** - Sudah berapa lama kamu sakit?

Knowing vocabulary about illnesses in English is very important when you are abroad or speaking with a doctor who uses English."
        ]);

        Materi::create([
            'title' => 'Body Movement and Actions',
            'description' => 'Learn about body movements and activities in English.',
            'content' => "# Body Movement and Actions (Gerakan dan Aksi Tubuh)

In this material, you will learn verbs and expressions related to body movements:

## Basic Movements (Gerakan Dasar)
1. **Walk** - Berjalan
2. **Run** - Berlari
3. **Jump** - Melompat
4. **Skip** - Melompat-lompat
5. **Hop** - Melompat dengan satu kaki
6. **Dance** - Menari
7. **Swim** - Berenang
8. **Climb** - Memanjat

## Hand Movements (Gerakan Tangan)
1. **Wave** - Melambai
2. **Clap** - Bertepuk tangan
3. **Grab** - Menggenggam
4. **Touch** - Menyentuh
5. **Point** - Menunjuk
6. **Throw** - Melempar
7. **Catch** - Menangkap
8. **Push** - Mendorong
9. **Pull** - Menarik

## Head Movements (Gerakan Kepala)
1. **Nod** - Mengangguk
2. **Shake** - Menggeleng
3. **Look** - Melihat
4. **Blink** - Berkedip
5. **Smile** - Tersenyum
6. **Laugh** - Tertawa
7. **Cry** - Menangis

## Example Sentences
1. **I can jump high.** - Saya bisa melompat tinggi.
2. **She is waving her hand.** - Dia melambai-lambaikan tangannya.
3. **They are dancing together.** - Mereka menari bersama.
4. **He nodded his head.** - Dia menganggukkan kepalanya.

Learning body movement verbs helps you to describe daily activities in English."
        ]);
    }
}
