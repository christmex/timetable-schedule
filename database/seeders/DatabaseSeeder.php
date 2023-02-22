<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'Super Admin',
            'email' => 'super@admin.com',
            'password' => bcrypt('mantapjiwa00')
        ]);

        \App\Models\SchoolYear::create([
            'school_year_name' => '2022/2023',
            'is_active' => 1,
            
        ]);
        
        \App\Models\Day::create([
            'day_name' => 'Monday',
            'another_name' => 'Senin',
        ]);
        \App\Models\Day::create([
            'day_name' => 'Tuesday',
            'another_name' => 'Selasa',
        ]);
        \App\Models\Day::create([
            'day_name' => 'Wednesday',
            'another_name' => 'Rabu',
        ]);
        \App\Models\Day::create([
            'day_name' => 'Thursday',
            'another_name' => 'Kamis',
        ]);
        \App\Models\Day::create([
            'day_name' => 'Friday',
            'another_name' => 'Jumat',
        ]);


        \App\Models\Classroom::create([
            "classname" => "Matthew 1",
        ]);
        \App\Models\Classroom::create([
            "classname" => "Matthew 2",
        ]);
        \App\Models\Classroom::create([
            "classname" => "Matthew 3",
        ]);
        \App\Models\Classroom::create([
            "classname" => "Mark 1",
        ]);
        \App\Models\Classroom::create([
            "classname" => "Mark 2",
        ]);
        \App\Models\Classroom::create([
            "classname" => "Mark 3",
        ]);
        \App\Models\Classroom::create([
            "classname" => "Luke 1",
        ]);
        \App\Models\Classroom::create([
            "classname" => "Luke 2",
        ]);
        \App\Models\Classroom::create([
            "classname" => "Luke 3",
        ]);
        \App\Models\Classroom::create([
            "classname" => "John 1",
        ]);
        \App\Models\Classroom::create([
            "classname" => "John 2",
        ]);
        \App\Models\Classroom::create([
            "classname" => "John 3",
        ]);
        \App\Models\Classroom::create([
            "classname" => "John 4",
        ]);
        \App\Models\Classroom::create([
            "classname" => "Acts 1",
        ]);
        \App\Models\Classroom::create([
            "classname" => "Acts 2",
        ]);
        \App\Models\Classroom::create([
            "classname" => "Acts 3",
        ]);
        \App\Models\Classroom::create([
            "classname" => "Acts 4",
        ]);
        \App\Models\Classroom::create([
            "classname" => "Romans 1",
        ]);
        \App\Models\Classroom::create([
            "classname" => "Romans 2",
        ]);
        \App\Models\Classroom::create([
            "classname" => "Romans 3",
        ]);
        \App\Models\Classroom::create([
            "classname" => "Romans 4"
        ]);

        

        \App\Models\Teacher::create([
            "teacher_name" => "Mrs. Nani",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mrs. Herlina",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mr. Alex",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mrs. Christina",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mr. Eduard",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mrs. Rotua Eva",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Ms. Margaretha",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Ms. Masryana Ikawany",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mrs. Ruth Siagian",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mrs. Hanna Sinaga",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mr. Ranto ",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mr. Salimuddin",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mrs. Karolin",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mrs. Erna Purba",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mrs. Safrika",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mr. Parlan",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mr. Budi Prasetyo",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mrs. Merry Linda",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mrs. Yanthi Sinaga",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mrs. Roida Manullang",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mrs. Roida Niety",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mrs. Pinta",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mrs. Yanny Debora P.",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mr. Beny",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mrs. Rinte Gultom",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mr. Arman",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mrs. Erna Yudi",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Ls. Yenny",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Ls. Ck",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Ls. Suryatni",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mrs. Yulia Ermalita",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mr. Paul Nando",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mr. Markus",
        ]);
        \App\Models\Teacher::create([
            "teacher_name" => "Mr. Mardi"
        ]);



        \App\Models\Timetable::create([
            "subject" => "Homeroom 07:30",
            "start" => "07:30:00",
            "end" => "08:00:00",
        ]);
        \App\Models\Timetable::create([
            "subject" => "Pelajaran 08:00",
            "start" => "08:00:00",
            "end" => "08:35:00",
        ]);
        \App\Models\Timetable::create([
            "subject" => "Pelajaran 08:35",
            "start" => "08:35:00",
            "end" => "09:10:00",
        ]);
        \App\Models\Timetable::create([
            "subject" => "Break KK 09:10",
            "start" => "09:10:00",
            "end" => "09:25:00",
        ]);
        \App\Models\Timetable::create([
            "subject" => "Pelajaran 09:10",
            "start" => "09:10:00",
            "end" => "09:45:00",
        ]);
        \App\Models\Timetable::create([
            "subject" => "Pelajaran 09:45",
            "start" => "09:45:00",
            "end" => "10:00:00",
        ]);
        \App\Models\Timetable::create([
            "subject" => "Break KB 09:45",
            "start" => "09:45:00",
            "end" => "10:00:00",
        ]);
        \App\Models\Timetable::create([
            "subject" => "Pelajaran 10:00",
            "start" => "10:00:00",
            "end" => "10:35:00",
        ]);
        \App\Models\Timetable::create([
            "subject" => "Pelajaran 10:35",
            "start" => "10:35:00",
            "end" => "11:10:00",
        ]);
        \App\Models\Timetable::create([
            "subject" => "Pelajaran 11:10",
            "start" => "11:10:00",
            "end" => "11:45:00",
        ]);
        \App\Models\Timetable::create([
            "subject" => "Pelajaran 11:45",
            "start" => "11:45:00",
            "end" => "12:20:00",
        ]);
        \App\Models\Timetable::create([
            "subject" => "Pelajaran 12:20",
            "start" => "12:20:00",
            "end" => "12:55:00",
        ]);
        \App\Models\Timetable::create([
            "subject" => "Pelajaran 12:55",
            "start" => "12:55:00",
            "end" => "13:30:00",
        ]);
        \App\Models\Timetable::create([
            "subject" => "Pelajaran 13:30",
            "start" => "13:30:00",
            "end" => "13:45:00",
        ]);
        \App\Models\Timetable::create([
            "subject" => "Pelajaran 13:45",
            "start" => "13:45:00",
            "end" => "14:20:00",
        ]);
        \App\Models\Timetable::create([
            "subject" => "Pelajaran 14:20",
            "start" => "14:20:00",
            "end" => "14:45:00",
        ]);
        \App\Models\Timetable::create([
            "subject" => "Pelajaran 14:45",
            "start" => "14:45:00",
            "end" => "15:00:00"
        ]);

        \App\Models\SubjectLesson::create([
            "subject_name" => "Tematik"
        ]);
        \App\Models\SubjectLesson::create([
            "subject_name" => "Maths"
        ]);
        \App\Models\SubjectLesson::create([
            "subject_name" => "Religion"
        ]);
        \App\Models\SubjectLesson::create([
            "subject_name" => "Library"
        ]);
        \App\Models\SubjectLesson::create([
            "subject_name" => "Music"
        ]);
        \App\Models\SubjectLesson::create([
            "subject_name" => "Mandarin"
        ]);
        \App\Models\SubjectLesson::create([
            "subject_name" => "English"
        ]);
        \App\Models\SubjectLesson::create([
            "subject_name" => "Science"
        ]);
        \App\Models\SubjectLesson::create([
            "subject_name" => "Art and Craft"
        ]);
        \App\Models\SubjectLesson::create([
            "subject_name" => "PE"
        ]);
        \App\Models\SubjectLesson::create([
            "subject_name" => "Computer"
        ]);
        \App\Models\SubjectLesson::create([
            "subject_name" => "Matematika"
        ]);

        // last work masukkan semua break dan lunch time agar waktu yg available kelihatan
        // Kendalanya di bagian breaktime yang tiap kelas bisa beda dan jadwal guru semua peraturan ada di kertas
        // \App\Models\Schedule::create([
        //     'school_year_id' => 1,
        //     'classroom_id' => 1,
        //     'timetable_id' => 4,
        //     'teacher_id' => 1,
        //     'day_id' => 1,
        //     'subject_lesson_id' => 1,
        //     'no_lesson' => 0,
        // ]);



        // \App\Models\User::create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
