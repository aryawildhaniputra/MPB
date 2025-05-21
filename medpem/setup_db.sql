-- Drop tables if they exist
DROP TABLE IF EXISTS user_hearts CASCADE;
DROP TABLE IF EXISTS user_lessons CASCADE;
DROP TABLE IF EXISTS questions CASCADE;
DROP TABLE IF EXISTS lessons CASCADE;
DROP TABLE IF EXISTS user_materi CASCADE;
DROP TABLE IF EXISTS materi CASCADE;

-- Create lessons table
CREATE TABLE lessons (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    icon VARCHAR(255),
    icon_color VARCHAR(255) DEFAULT '#3B82F6',
    level INTEGER DEFAULT 1,
    position INTEGER DEFAULT 0,
    xp_reward INTEGER DEFAULT 10,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- Create questions table
CREATE TABLE questions (
    id SERIAL PRIMARY KEY,
    lesson_id INTEGER REFERENCES lessons(id) ON DELETE CASCADE,
    type VARCHAR(255) NOT NULL,
    prompt TEXT NOT NULL,
    prompt_type VARCHAR(255) DEFAULT 'text',
    options JSONB,
    correct_answers JSONB NOT NULL,
    hint TEXT,
    position INTEGER DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- Create user_lessons table
CREATE TABLE user_lessons (
    id SERIAL PRIMARY KEY,
    user_id INTEGER REFERENCES users(id) ON DELETE CASCADE,
    lesson_id INTEGER REFERENCES lessons(id) ON DELETE CASCADE,
    completed BOOLEAN DEFAULT FALSE,
    mistakes_count INTEGER DEFAULT 0,
    current_streak INTEGER DEFAULT 0,
    xp_earned INTEGER DEFAULT 0,
    progress INTEGER DEFAULT 0,
    started_at TIMESTAMP,
    completed_at TIMESTAMP,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- Create user_hearts table
CREATE TABLE user_hearts (
    id SERIAL PRIMARY KEY,
    user_id INTEGER REFERENCES users(id) ON DELETE CASCADE,
    lesson_id INTEGER REFERENCES lessons(id) ON DELETE CASCADE,
    mistakes_count INTEGER DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    UNIQUE(user_id, lesson_id)
);

-- Insert sample lessons
INSERT INTO lessons (title, description, level, xp_reward, icon, icon_color, is_active, position, created_at, updated_at)
VALUES
('Perkenalan Dasar', 'Belajar cara memperkenalkan diri dalam bahasa Inggris dan mengetahui ungkapan-ungkapan dasar yang sering digunakan.', 1, 10, 'star', '#58CC02', true, 1, NOW(), NOW()),
('Salam dan Sapaan', 'Belajar berbagai ungkapan untuk menyapa dan mengucapkan salam dalam bahasa Inggris.', 1, 15, 'hand-sparkles', '#1CB0F6', true, 2, NOW(), NOW()),
('Angka dan Hitungan', 'Belajar angka-angka dalam bahasa Inggris dan cara menghitung dasar.', 1, 15, 'calculator', '#9370DB', true, 3, NOW(), NOW()),
('Ujian Unit 1', 'Tes kemampuanmu dalam materi-materi dasar yang telah dipelajari.', 1, 25, 'trophy', '#FFD700', true, 4, NOW(), NOW());
