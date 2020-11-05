<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Faculty;
use App\Models\User;
use App\Models\FeedbackType;
use App\Models\Admin;
use App\Models\Feedback;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->seedRole();
        $this->seedFaculty();
        $this->seedUser();
        $this->seedFeedbackType();
        $this->seedAdmin();
        $this->seedFeedback();
    }

    private function seedRole(){
        Role::create([
            'role_type' => 'Public',
            'privilege_level' => 1,
        ])->save();

        Role::create([
            'role_type' => 'Student',
            'privilege_level' => 2,
        ])->save();

        Role::create([
            'role_type' => 'Lecturer',
            'privilege_level' => 2,
        ])->save();

        Role::create([
            'role_type' => 'Staff',
            'privilege_level' => 2,
        ])->save();

        Role::create([
            'role_type' => 'Management',
            'privilege_level' => 3,
        ])->save();

        Role::create([
            'role_type' => 'Admin',
            'privilege_level' => 4,
        ])->save();

        Role::create([
            'role_type' => 'Super Admin',
            'privilege_level' => 5,
        ])->save();
    }

    private function seedFaculty(){
        Faculty::create([
            'faculty_id' => 'BUR',
            'faculty_name' => 'Bursary',
        ])->save();

        Faculty::create([
            'faculty_id' => 'FAFB',
            'faculty_name' => 'Faculty of Accountancy, Finance And Business',
        ])->save();

        Faculty::create([
            'faculty_id' => 'FOAS',
            'faculty_name' => 'Faculty of Applied Sciences',
        ])->save();

        Faculty::create([
            'faculty_id' => 'FOBE',
            'faculty_name' => 'Faculty of Built Environment',
        ])->save();

        Faculty::create([
            'faculty_id' => 'FCCI',
            'faculty_name' => 'Faculty of Communication And Creative Industries',
        ])->save();

        Faculty::create([
            'faculty_id' => 'FOCS',
            'faculty_name' => 'Faculty of Computing And Information Technology',
        ])->save();

        Faculty::create([
            'faculty_id' => 'FOET',
            'faculty_name' => 'Faculty of Engineering And Technology',
        ])->save();

        Faculty::create([
            'faculty_id' => 'FSSH',
            'faculty_name' => 'Faculty of Social Science And Humanities',
        ])->save();

        Faculty::create([
            'faculty_id' => 'CO',
            'faculty_name' => 'Office of The Chairman',
        ])->save();
    }

    private function seedUser(){
        User::create([
            'user_id' => '19WMR09572',
            'email' => 'chongks-wm17@student.tarc.edu.my',
            'password' => Hash::make('abc123456'),
            'name' => 'Chong Ken Shen',
            'gender' => 'M',
            'nric_no' => '990809-10-5911',
            'birth_date' => '11/11/1999',
            'mobile_no' => '011-26618518',
            'home_address' => 'test',
            'correspondence_address' => 'test',
            'session_join' => '201905',
            'status' => 'Active',
            'uuid' => NULL,
            'role_id' => 2,
            'faculty_id' => 'FOCS',
        ])->save();

        User::create([
            'user_id' => '19WMR09562',
            'email' => 'pohreng1999@gmail.com',
            'password' => Hash::make('abc123456'),
            'name' => 'Cheah Poh Reng',
            'gender' => 'M',
            'nric_no' => '000101-10-1235',
            'birth_date' => '01/01/2000',
            'mobile_no' => '15155',
            'home_address' => 'test',
            'correspondence_address' => 'test',
            'session_join' => '201905',
            'status' => 'Active',
            'uuid' => NULL,
            'role_id' => 2,
            'faculty_id' => 'FOCS',
        ])->save();

        User::create([
            'user_id' => 'p12345',
            'email' => 'cheahpr-wm17@student.tarc.edu.my',
            'password' => Hash::make('abc123456'),
            'name' => 'Cheah Poh Reng',
            'gender' => 'M',
            'nric_no' => '000101-10-1234',
            'birth_date' => '01/01/2000',
            'mobile_no' => '011-1234567',
            'home_address' => 'test',
            'correspondence_address' => 'test',
            'session_join' => NULL,
            'status' => 'Active',
            'uuid' => NULL,
            'role_id' => 3,
            'faculty_id' => 'FOCS',
        ])->save();

        User::create([
            'user_id' => 'p11111',
            'email' => 'kenshencu99@gmail.com',
            'password' => Hash::make('abc123456'),
            'name' => 'Test',
            'gender' => 'M',
            'nric_no' => '000101-10-1236',
            'birth_date' => '01/01/1996',
            'mobile_no' => '011-1234567',
            'home_address' => 'test',
            'correspondence_address' => 'test',
            'session_join' => NULL,
            'status' => 'Active',
            'uuid' => NULL,
            'role_id' => 3,
            'faculty_id' => 'FOCS',
        ])->save();

        User::create([
            'user_id' => 'p456789',
            'email' => 'yewhz-wm17@student.tarc.edu.my',
            'password' => Hash::make('imsohai1'),
            'name' => 'Yew Hsiu Zheng',
            'gender' => 'F',
            'nric_no' => '991210-10-0487',
            'birth_date' => '10/12/1999',
            'mobile_no' => '017-3641234',
            'home_address' => 'test',
            'correspondence_address' => 'test',
            'session_join' => '201905',
            'status' => 'Active',
            'uuid' => NULL,
            'role_id' => 4,
            'faculty_id' => 'FOCS',
        ])->save();

        User::create([
            'user_id' => 'S10001',
            'email' => 'ngjj-wm17@student.tarc.edu.my',
            'password' => Hash::make('abc123'),
            'name' => NULL,
            'gender' => NULL,
            'nric_no' => NULL,
            'birth_date' => NULL,
            'mobile_no' => NULL,
            'home_address' => NULL,
            'correspondence_address' => NULL,
            'session_join' => NULL,
            'status' => 'Active',
            'uuid' => NULL,
            'role_id' => 5,
        ])->save();

        // User::create([
        //     'user_id' => 'admin1',
        //     'email' => 'chancp-wm17@student.tarc.edu.my',
        //     'password' => Hash::make('abc123'),
        //     'name' => NULL,
        //     'gender' => NULL,
        //     'nric_no' => NULL,
        //     'birth_date' => NULL,
        //     'mobile_no' => NULL,
        //     'home_address' => NULL,
        //     'correspondence_address' => NULL,
        //     'session_join' => NULL,
        //     'status' => 'Active',
        //     'uuid' => NULL,
        //     'role_id' => 6,
        //     'faculty_id' => NULL,
        // ])->save();

        // User::create([
        //     'user_id' => 'admin2',
        //     'email' => 'chukb-wm17@student.tarc.edu.my',
        //     'password' => Hash::make('abc123'),
        //     'name' => NULL,
        //     'gender' => NULL,
        //     'nric_no' => NULL,
        //     'birth_date' => NULL,
        //     'mobile_no' => NULL,
        //     'home_address' => NULL,
        //     'correspondence_address' => NULL,
        //     'session_join' => NULL,
        //     'status' => 'Active',
        //     'uuid' => NULL,
        //     'role_id' => 7,
        //     'faculty_id' => NULL,
        // ])->save();
    }

    private function seedFeedbackType(){
        FeedbackType::create([
            'type' => 'Campus Facility Feedback',
        ])->save();

        FeedbackType::create([
            'type' => 'Canteen Food Feedback',
        ])->save();

        FeedbackType::create([
            'type' => 'Education Quality Feedback',
        ])->save();

        FeedbackType::create([
            'type' => 'Service Attitude Feedback',
        ])->save();
    }

    private function seedAdmin(){
        Admin::create([
            'username' => 'admin1',
            'password' => Hash::make('abc123'),
            'role_id' => '6',
        ])->save();

        Admin::create([
            'username' => 'admin2',
            'password' => Hash::make('abc123'),
            'role_id' => '7',
        ])->save();
    }

    private function seedFeedback(){
        Feedback::create([
            'feedbackType_id' => '1',
            'choice' => 'Block B',
            'comment' => 'Comment 1',
            'attachment' => 'default.png',
            'creator_id' => '19WMR09572',
            'anonymous' => true,
            'priority' => 1,
            'status' => 'pending',
        ])->save();

        Feedback::create([
            'feedbackType_id' => '2',
            'choice' => 'Canteen 1',
            'comment' => 'Comment 2',
            'attachment' => 'default.png',
            'creator_id' => '19WMR09572',
            'anonymous' => false,
            'priority' => 2,
            'status' => 'pending',
        ])->save();

        Feedback::create([
            'feedbackType_id' => '3',
            'choice' => 'Lecture 1',
            'comment' => 'Comment 3',
            'attachment' => 'default.png',
            'creator_id' => '19WMR09572',
            'handler_id' => 'S10001',
            'anonymous' => true,
            'priority' => 3,
            'status' => 'approved',
            'approved_date' => '2020-10-23 08:31:06',
        ])->save();

        Feedback::create([
            'feedbackType_id' => '3',
            'choice' => 'Lecture 1',
            'comment' => 'Comment 5',
            'attachment' => 'default.png',
            'creator_id' => '19WMR09572',
            'handler_id' => 'S10001',
            'anonymous' => true,
            'priority' => 3,
            'status' => 'urgent',
            'approved_date' => '2020-10-23 08:31:06',
        ])->save();

        Feedback::create([
            'feedbackType_id' => '2',
            'choice' => 'Lecture 1',
            'comment' => 'Comment 5',
            'attachment' => 'default.png',
            'creator_id' => 'p12345',
            'handler_id' => 'S10001',
            'anonymous' => false,
            'priority' => 5,
            'status' => 'approved',
            'approved_date' => '2020-10-23 08:31:06',
        ])->save();

        Feedback::create([
            'feedbackType_id' => '4',
            'choice' => 'Lecture 1',
            'comment' => 'Comment 5',
            'attachment' => 'default.png',
            'creator_id' => 'p456789',
            'handler_id' => 'S10001',
            'anonymous' => true,
            'priority' => 1,
            'status' => 'urgent',
            'approved_date' => '2020-10-23 08:31:06',
        ])->save();

        Feedback::create([
            'feedbackType_id' => '1',
            'choice' => 'Lecture 1',
            'comment' => 'Comment 5',
            'attachment' => 'default.png',
            'creator_id' => 'p12345',
            'handler_id' => 'S10001',
            'anonymous' => true,
            'priority' => 2,
            'status' => 'approved',
            'approved_date' => '2020-10-23 08:31:06',
        ])->save();

        Feedback::create([
            'feedbackType_id' => '1',
            'choice' => 'Lecture 1',
            'comment' => 'Comment 5',
            'attachment' => 'default.png',
            'creator_id' => 'p12345',
            'handler_id' => 'S10001',
            'anonymous' => true,
            'priority' => 2,
            'status' => 'solved',
            'approved_date' => '2020-10-23 08:31:06',
        ])->save();

        Feedback::create([
            'feedbackType_id' => '1',
            'choice' => 'Lecture 1',
            'comment' => 'Comment 5',
            'attachment' => 'default.png',
            'creator_id' => 'p456789',
            'handler_id' => 'S10001',
            'anonymous' => true,
            'priority' => 4,
            'status' => 'solved',
            'approved_date' => '2020-10-23 08:31:06',
        ])->save();

        Feedback::create([
            'feedbackType_id' => '4',
            'comment' => 'Comment 4',
            'creator_id' => '19WMR09572',
            'handler_id' => 'S10001',
            'anonymous' => true,
            'priority' => 4,
            'status' => 'dismissed',
            'dismiss_date' => '2020-10-23 08:31:06',
        ])->save();

        Feedback::create([
            'feedbackType_id' => '2',
            'comment' => 'Comment 4',
            'creator_id' => 'p12345',
            'handler_id' => 'S10001',
            'anonymous' => true,
            'priority' => 4,
            'status' => 'dismissed',
            'dismiss_date' => '2020-10-23 08:31:06',
        ])->save();

        Feedback::create([
            'feedbackType_id' => '2',
            'comment' => 'Comment 4',
            'creator_id' => 'p456789',
            'handler_id' => 'S10001',
            'anonymous' => true,
            'priority' => 4,
            'status' => 'dismissed',
            'dismiss_date' => '2020-10-23 08:31:06',
        ])->save();
    }
}
