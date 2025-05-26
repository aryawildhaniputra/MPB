<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Question;
use App\Models\UserHeart;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\AchievementService;

class LessonController extends Controller
{
    /**
     * Display a listing of all lessons.
     */
    public function index()
    {
        $user = Users::find(Auth::id());

        // For testing purposes, include both active and inactive lessons
        // In production, use: Lesson::where('is_active', true)->orderBy('position')->get();
        $lessons = Lesson::orderBy('position')->get();

        // Load questions for each lesson to enable dividing into parts
        foreach ($lessons as $lesson) {
            $lesson->questions = $lesson->questions()->orderBy('position')->get();
            $status = $lesson->getCompletionStatusForUser($user->id);
            $lesson->user_status = $status;
        }

        return view('belajar.index', compact('lessons'));
    }

    /**
     * Display the details for a specific lesson.
     */
    public function show($id)
    {
        $user = Users::find(Auth::id());
        $lesson = Lesson::findOrFail($id);

        // Get lesson status for the user
        $status = $lesson->getCompletionStatusForUser($user->id);
        $lesson->user_status = $status;

        return view('belajar.lesson', compact('lesson'));
    }

    /**
     * Start a lesson session.
     */
    public function start(Request $request, $id)
    {
        $user = Users::find(Auth::id());
        $lesson = Lesson::findOrFail($id);

        // Get the part number (1-6)
        $part = $request->input('part', 1);
        $part = max(1, min(6, intval($part))); // Ensure part is between 1 and 6

        // Check if this part has already been completed
        $status = $lesson->getCompletionStatusForUser($user->id);
        $partFieldName = 'part' . $part . '_completed';
        $partCompleted = $status[$partFieldName] ?? false;

        // If the part is already completed, redirect to view mode instead
        if ($partCompleted) {
            return redirect()->route('belajar.review', ['id' => $id, 'part' => $part])
                             ->with('info', "Bagian ini sudah selesai! Kamu dapat melihat soal dan jawaban, tetapi tidak dapat mengambilnya lagi.");
        }

        // Reset mistake count for this lesson
        UserHeart::resetMistakes($user->id, $lesson->id);

        // Record that the user has started this lesson
        $userLesson = $user->startLesson($lesson->id);

        // Get all questions for this lesson
        $allQuestions = $lesson->questions()->orderBy('position')->get();

        // Divide questions into 6 parts
        $questionCount = $allQuestions->count();
        $questionsPerPart = max(1, ceil($questionCount / 6));

        // Calculate start and end indexes for the requested part
        $startIndex = ($part - 1) * $questionsPerPart;
        $endIndex = min($startIndex + $questionsPerPart, $questionCount);

        // Get the questions for this part
        $partQuestions = $allQuestions->slice($startIndex, $endIndex - $startIndex);

        // Store part information in session
        session(['current_lesson' => $lesson->id]);
        session(['current_lesson_part' => $part]);
        session(['current_questions' => $partQuestions->pluck('id')->toArray()]);
        session(['current_question_index' => 0]);
        session(['mistakes_count' => 0]);

        return redirect()->route('belajar.question');
    }

    /**
     * Show the current question in the lesson.
     */
    public function showQuestion()
    {
        $user = Users::find(Auth::id());

        // Check if there's an active lesson
        if (!session('current_lesson') || !session('current_questions')) {
            return redirect()->route('belajar.index')->with('error', 'Tidak ada pelajaran aktif');
        }

        $lessonId = session('current_lesson');
        $questionIds = session('current_questions');
        $questionIndex = session('current_question_index');
        $lessonPart = session('current_lesson_part', 1);

        // Check if we've gone through all questions
        if ($questionIndex >= count($questionIds)) {
            // Part completed
            $mistakesCount = session('mistakes_count', 0);

            // Get the user lesson record
            $userLesson = $user->lessons()->where('lesson_id', $lessonId)->first();

            if ($userLesson) {
                // Set part-specific completion flag based on which part was completed
                $partField = '';
                $partPointsField = '';
                if ($lessonPart == 1) {
                    $partField = 'part1_completed';
                    $partPointsField = 'part1_points_awarded';
                    $progress = 16;
                } elseif ($lessonPart == 2) {
                    $partField = 'part2_completed';
                    $partPointsField = 'part2_points_awarded';
                    $progress = 33;
                } elseif ($lessonPart == 3) {
                    $partField = 'part3_completed';
                    $partPointsField = 'part3_points_awarded';
                    $progress = 50;
                } elseif ($lessonPart == 4) {
                    $partField = 'part4_completed';
                    $partPointsField = 'part4_points_awarded';
                    $progress = 66;
                } elseif ($lessonPart == 5) {
                    $partField = 'part5_completed';
                    $partPointsField = 'part5_points_awarded';
                    $progress = 83;
                } elseif ($lessonPart == 6) {
                    $partField = 'part6_completed';
                    $partPointsField = 'part6_points_awarded';
                    $progress = 100;
                }

                // Update the specific part's completion status
                if (!empty($partField)) {
                    // Update the specific part completion
                    $userLesson->pivot->$partField = true;

                    // Record the timestamp when this part was completed
                    $partCompletedAtField = 'part' . $lessonPart . '_completed_at';
                    $userLesson->pivot->$partCompletedAtField = now();

                    // Debug logs for part completion timing
                    $startTime = $userLesson->pivot->started_at;
                    $completionTime = $userLesson->pivot->$partCompletedAtField;
                    $durationSeconds = \Carbon\Carbon::parse($completionTime)->diffInSeconds(\Carbon\Carbon::parse($startTime));

                    \Illuminate\Support\Facades\Log::info("Part completion: Lesson {$lessonId}, Part {$lessonPart}");
                    \Illuminate\Support\Facades\Log::info("  Started at: {$startTime}");
                    \Illuminate\Support\Facades\Log::info("  Completed at: {$completionTime}");
                    \Illuminate\Support\Facades\Log::info("  Duration: {$durationSeconds} seconds");

                    // Award 15 points if not already awarded for this part
                    $pointsAwarded = 0;
                    if (!empty($partPointsField) && !$userLesson->pivot->$partPointsField) {
                        $userLesson->pivot->$partPointsField = true;
                        $pointsAwarded = 15;

                        // Update user's total points
                        $user->total_points = ($user->total_points ?? 0) + $pointsAwarded;
                        $user->save();
                    }

                    // Store example answers for this part
                    $partAnswers = [];
                    foreach ($questionIds as $qId) {
                        $q = Question::find($qId);
                        if ($q) {
                            $correctAnswers = is_string($q->correct_answers)
                                ? json_decode($q->correct_answers, true)
                                : $q->correct_answers;

                            if (is_array($correctAnswers) && !empty($correctAnswers)) {
                                $partAnswers[] = $correctAnswers[0];
                            }
                        }
                    }

                    // Store the first answer as an example
                    $answerField = 'part' . $lessonPart . '_example';
                    if (!empty($partAnswers)) {
                        $userLesson->pivot->$answerField = $partAnswers[0];
                    }

                    // Only update progress if it would increase the progress value
                    if ($progress > $userLesson->pivot->progress) {
                        $userLesson->pivot->progress = $progress;
                    }

                    $userLesson->pivot->save();

                    // Log that we successfully saved the part completion
                    \Illuminate\Support\Facades\Log::info("  Part completion saved: {$partField} = true, {$partCompletedAtField} = {$completionTime}");

                    // Check for speed achievement specifically after part completion
                    try {
                        \Illuminate\Support\Facades\Log::info("Checking speed achievements immediately after part completion");
                        $achievementService = app(AchievementService::class);
                        $speedAchievements = $achievementService->checkSpeedAchievements($user);
                        if (!empty($speedAchievements)) {
                            \Illuminate\Support\Facades\Log::info("Unlocked " . count($speedAchievements) . " speed achievements");
                            foreach ($speedAchievements as $achievementData) {
                                \Illuminate\Support\Facades\Log::info("Speed achievement unlocked: " . $achievementData['achievement']->name);
                            }
                        } else {
                            \Illuminate\Support\Facades\Log::info("No new speed achievements unlocked");
                        }
                    } catch (\Exception $e) {
                        \Illuminate\Support\Facades\Log::error("Error checking speed achievements: " . $e->getMessage());
                    }

                    // Store the awarded points in session for display
                    session(['last_awarded_points' => $pointsAwarded]);
                }
            }

            // If this is the final part (part 6), mark the lesson as completed
            if ($lessonPart == 6) {
                $user->completeLesson($lessonId, $mistakesCount);
            }

            // Retrieve the lesson object from the database
            $lesson = Lesson::find($lessonId);

            // Check for achievements after completing any part
            $this->checkAchievements($user, $lesson, $lessonPart);

            // Clear session data
            session()->forget([
                'current_lesson',
                'current_lesson_part',
                'current_questions',
                'current_question_index',
                'mistakes_count'
            ]);

            if ($lessonPart == 6) {
                return redirect()->route('belajar.complete', $lessonId);
            } else {
                $pointsMsg = $pointsAwarded > 0 ? " Kamu mendapatkan {$pointsAwarded} poin!" : "";
                $partCompletionMsg = "Hebat! Kamu telah menyelesaikan Bagian {$lessonPart}.{$pointsMsg}";

                // Flash the message for display on both pages
                session()->flash('learning_completed', $partCompletionMsg);

                return redirect()->route('belajar.index')
                    ->with('success', $partCompletionMsg);
            }
        }

        // Get the current question
        $question = Question::findOrFail($questionIds[$questionIndex]);

        // Get remaining attempts for this lesson
        $remainingAttempts = UserHeart::getRemainingAttempts($user->id, $lessonId);

        return view('belajar.question', compact('question', 'questionIndex', 'questionIds', 'remainingAttempts'));
    }

    /**
     * Process the answer to a question.
     */
    public function answerQuestion(Request $request)
    {
        $user = Users::find(Auth::id());

        // Validate the request
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'answer' => 'required',
        ]);

        $questionId = $request->question_id;
        $answer = $request->answer;
        $lessonId = session('current_lesson');

        // Get the question and check if the answer is correct
        $question = Question::findOrFail($questionId);
        $isCorrect = $question->isCorrectAnswer($answer);

        if (!$isCorrect) {
            // User got it wrong, record the mistake
            $userHeart = UserHeart::firstOrCreate(
                ['user_id' => $user->id, 'lesson_id' => $lessonId],
                ['mistakes_count' => 0]
            );

            $attemptAvailable = $userHeart->addMistake($lessonId);

            // Increment mistakes count in session
            session(['mistakes_count' => session('mistakes_count', 0) + 1]);

            if (!$attemptAvailable) {
                // No more attempts left, end the lesson
                session()->forget([
                    'current_lesson',
                    'current_lesson_part',
                    'current_questions',
                    'current_question_index',
                    'mistakes_count'
                ]);

                return redirect()->route('belajar.index')
                                ->with('error', 'Kamu gagal menyelesaikan pelajaran! Silakan coba lagi nanti.');
            }

            // Get the correct answer to display
            $correctAnswers = is_string($question->correct_answers)
                ? json_decode($question->correct_answers, true)
                : $question->correct_answers;

            $correctAnswer = '';
            if (is_array($correctAnswers) && count($correctAnswers) > 0) {
                // For multiple choice, show the text of the correct option
                if (in_array($question->type, ['multiple_choice', 'select_image', 'image_choice'])) {
                    $correctAnswer = $correctAnswers[0];
                } else {
                    // For text input and translation, join all possible correct answers
                    $correctAnswer = implode(' / ', $correctAnswers);
                }
            }

            // Get remaining attempts
            $remainingAttempts = UserHeart::getRemainingAttempts($user->id, $lessonId);

            // Custom message based on attempts left
            $attemptMessage = '';
            if ($remainingAttempts > 1) {
                $attemptMessage = 'Jawaban salah! Kamu punya ' . $remainingAttempts . ' kesempatan lagi.';
            } else {
                $attemptMessage = 'Jawaban salah! Ini kesempatan terakhir kamu.';
            }

            // Show wrong answer notification and redirect back to question
            return redirect()->back()
                            ->with('status', 'wrong')
                            ->with('message', $attemptMessage)
                            ->with('correct_answer', $correctAnswer);
        }

        // Move to the next question
        session(['current_question_index' => session('current_question_index') + 1]);

        // Show success notification and proceed to next question
        return redirect()->route('belajar.question')
                        ->with('status', 'correct')
                        ->with('message', 'Jawaban benar!');
    }

    /**
     * Show the lesson completion screen.
     */
    public function complete($id)
    {
        $user = Users::find(Auth::id());
        $lesson = Lesson::findOrFail($id);

        // Check if the lesson is actually completed by the user
        if (!$lesson->isCompletedByUser($user->id)) {
            return redirect()->route('belajar.index')->with('error', 'Pelajaran belum selesai');
        }

        // Get lesson status for the user
        $userLesson = $user->lessons()->where('lesson_id', $id)->first();
        $status = $lesson->getCompletionStatusForUser($user->id);

        // Get the points awarded for the most recently completed part
        $pointsAwarded = session('last_awarded_points', 0);

        // If session doesn't have points, calculate total from all parts
        if ($pointsAwarded == 0 && $userLesson) {
            $totalPoints = 0;
            // Check each part's points_awarded field
            for ($i = 1; $i <= 6; $i++) {
                $fieldName = "part{$i}_points_awarded";
                if (isset($userLesson->pivot->$fieldName) && $userLesson->pivot->$fieldName) {
                    $totalPoints += 15; // Each part awards 15 points
                }
            }
            $pointsAwarded = $totalPoints;
        }

        // Check for achievements after completing a lesson
        $this->checkAchievements($user, $lesson);

        // Store a learning completion message that will be displayed on dashboard
        session()->flash('learning_completed', "Hebat! Kamu telah menyelesaikan pelajaran \"{$lesson->title}\".");

        return view('belajar.complete', compact('lesson', 'status', 'userLesson', 'pointsAwarded'));
    }

    /**
     * Check user achievements after completion
     */
    private function checkAchievements($user, $lesson = null, $part = null)
    {
        // Get the achievement service
        $achievementService = app(AchievementService::class);

        // Log for debugging
        \Illuminate\Support\Facades\Log::info("Checking achievements for user {$user->id}");
        if ($lesson) {
            \Illuminate\Support\Facades\Log::info("After completing lesson {$lesson->id} part {$part}");
        }

        // Check all achievement types
        $unlockedAchievements = $achievementService->checkAchievements($user);

        // Add a separate direct check for speed achievements which needs fresh database data
        if ($lesson && $part) {
            \Illuminate\Support\Facades\Log::info("Directly checking speed achievements for lesson {$lesson->id} part {$part}");
            $speedAchievements = $achievementService->checkSpeedAchievements($user);

            // Merge any speed achievements into the results
            if (!empty($speedAchievements)) {
                $unlockedAchievements = array_merge($unlockedAchievements, $speedAchievements);
                \Illuminate\Support\Facades\Log::info("Unlocked " . count($speedAchievements) . " speed achievements");
            }
        }

        // Flash newly unlocked achievements to the session for notification modal
        if (!empty($unlockedAchievements)) {
            session()->flash('achievement_unlocked', $unlockedAchievements);
        }

        // Return unlocked achievements
        return $unlockedAchievements;
    }

    /**
     * Review a completed lesson (view the questions and answers).
     */
    public function reviewLesson($id, $part = 1)
    {
        $user = Users::find(Auth::id());
        $lesson = Lesson::findOrFail($id);
        $part = max(1, min(6, intval($part))); // Ensure part is between 1 and 6

        // Get lesson status for the user
        $status = $lesson->getCompletionStatusForUser($user->id);

        // Check if this part has been completed
        $partFieldName = 'part' . $part . '_completed';
        $partCompleted = $status[$partFieldName] ?? false;

        if (!$partCompleted) {
            return redirect()->route('belajar.index')
                             ->with('error', 'Kamu belum menyelesaikan bagian ini!');
        }

        // Get all questions for this lesson
        $allQuestions = $lesson->questions()->orderBy('position')->get();

        // Divide questions into 6 parts
        $questionCount = $allQuestions->count();
        $questionsPerPart = max(1, ceil($questionCount / 6));

        // Calculate start and end indexes for the requested part
        $startIndex = ($part - 1) * $questionsPerPart;
        $endIndex = min($startIndex + $questionsPerPart, $questionCount);

        // Get the questions for this part
        $partQuestions = $allQuestions->slice($startIndex, $endIndex - $startIndex);

        // For each question, get the correct answer
        foreach ($partQuestions as $question) {
            $correctAnswers = is_string($question->correct_answers)
                ? json_decode($question->correct_answers, true)
                : $question->correct_answers;

            $question->correct_answer_display = '';
            if (is_array($correctAnswers) && count($correctAnswers) > 0) {
                // For multiple choice, show the text of the correct option
                if (in_array($question->type, ['multiple_choice', 'select_image', 'image_choice'])) {
                    $question->correct_answer_display = $correctAnswers[0];
                } else {
                    // For text input and translation, join all possible correct answers
                    $question->correct_answer_display = implode(' / ', $correctAnswers);
                }
            }
        }

        return view('belajar.review', compact('lesson', 'part', 'partQuestions', 'status'));
    }
}
