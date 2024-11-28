<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // 1st year, 1st semester
       Subject::factory()->create([
           'subject_code' => 'CC111',
           'description' => 'Introduction to Computing',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'CS111',
           'description' => 'Discrete Structures 1',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'CC112',
           'description' => 'Fundamentals of Programming',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'GE701',
           'description' => 'Mathematics in the Modern World',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'GE706',
           'description' => 'Art Appreciation',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'GE713',
           'description' => 'Kontekstwalisadong Komunikasyon sa Filipino (KOMFIL)',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'NSTP101',
           'description' => 'National Service Training Program 1',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'PE101',
           'description' => 'Physical Fitness and Self-Testing Activities',
           'units' => 2,
       ]);
       // 1st year, 2nd semester
       Subject::factory()->create([
           'subject_code' => 'CS121',
           'description' => 'Intermediate Programming',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'CS122',
           'description' => 'Discrete Structures 2',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'GE708',
           'description' => 'Understanding the Self',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'GE702',
           'description' => 'Purposive Communication',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'GE715',
           'description' => 'Filipino sa Iba\'t ibang Disiplina (FILDIS)',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'MATH005',
           'description' => 'Analytical Geometry',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'NSTP102',
           'description' => 'National Service Training Program 2',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'PE102',
           'description' => 'Rhythmic Activities',
           'units' => 2,
       ]);
       // 2nd year, 1st semester
         Subject::factory()->create([
              'subject_code' => 'CS211',
              'description' => 'Data Structures and Algorithms',
              'units' => 3,
         ]);

         Subject::factory()->create([
              'subject_code' => 'AI215',
              'description' => 'Artificial Intelligence',
              'units' => 3,
         ]);

         Subject::factory()->create([
              'subject_code' => 'AR214',
              'description' => 'Architecture and Organization',
              'units' => 3,
         ]);

         Subject::factory()->create([
              'subject_code' => 'GE703	',
              'description' => 'Ethics',
              'units' => 3,
         ]);

         Subject::factory()->create([
              'subject_code' => 'GE705',
              'description' => 'The Contemporary World',
              'units' => 3,
         ]);

         Subject::factory()->create([
              'subject_code' => 'MATH110',
              'description' => 'Calculus',
              'units' => 3,
         ]);

         Subject::factory()->create([
              'subject_code' => 'PE103',
              'description' => 'Recreational Activities',
              'units' => 3,
         ]);

         Subject::factory()->create([
              'subject_code' => 'PF211',
              'description' => 'Object-Oriented Programming',
              'units' => 3,
         ]);

       // 2nd year, 2nd semester
       Subject::factory()->create([
           'subject_code' => 'AC221',
           'description' => 'Algorithms and Complexity',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'CC115',
           'description' => 'Information Management',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'GE704',
           'description' => 'Science, Technology and Society',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'GE709',
           'description' => 'The Life and Works of Jose Rizal',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'NC225',
           'description' => 'Networks and Communications',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'OS223',
           'description' => 'Operating Systems',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'PE104',
           'description' => 'Team Sports',
           'units' => 2,
       ]);

       Subject::factory()->create([
           'subject_code' => 'PL222',
           'description' => 'Programming Languages',
           'units' => 3,
       ]);
       // 3rd year, 1st semester
       Subject::factory()->create([
           'subject_code' => 'ALT312',
           'description' => 'Automata Theory and Formal Languages',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'AT316',
           'description' => 'Digital Design',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'CC116',
           'description' => 'Application Development and Emerging Technologies',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'CSELECT1',
           'description' => 'System Fundamentals',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'ENG001',
           'description' => 'Advanced Technical Writing',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'HCI316',
           'description' => 'Human Computer Interaction',
           'units' => 1,
       ]);

       Subject::factory()->create([
           'subject_code' => 'SE314',
           'description' => 'Software Engineering 1',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'STAT003',
           'description' => 'Statistics with Computer Application',
           'units' => 3,
       ]);
       // 3rd year, 2nd semester
       Subject::factory()->create([
           'subject_code' => 'CSELECT2',
           'description' => 'Computational Science',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'CSELECT3',
           'description' => 'Intelligent Systems',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'FTS',
           'description' => 'Field Trips and Seminars',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'IAS327',
           'description' => 'Information Assurance and Security',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'RES111',
           'description' => 'CS Research Methods',
           'units' => 3,
       ]);

       Subject::factory()->create([
           'subject_code' => 'SE324',
           'description' => 'Software Engineering 2',
           'units' => 3,
       ]);
       // 3rd year, Summer
        Subject::factory()->create([
            'subject_code' => 'CS300',
            'description' => 'Practicum (162 hours)',
            'units' => 3,
        ]);
        // 4th year, 1st semester
        Subject::factory()->create([
            'subject_code' => 'CS400',
            'description' => 'CS Thesis Writing 1',
            'units' => 3,
        ]);

        Subject::factory()->create([
            'subject_code' => 'CSELECT4	',
            'description' => 'Parallel and Distributed Computing',
            'units' => 3,
        ]);

        Subject::factory()->create([
            'subject_code' => 'GE712',
            'description' => 'Gender and Society',
            'units' => 3,
        ]);

        Subject::factory()->create([
            'subject_code' => 'GE707',
            'description' => 'Readings in Philippine History',
            'units' => 3,
        ]);

        Subject::factory()->create([
            'subject_code' => 'GE711',
            'description' => 'Culture of Mindanao',
            'units' => 3,
        ]);
        // 4th year, 2nd semester
        Subject::factory()->create([
            'subject_code' => 'SPI411',
            'description' => 'Social Issues and Professional Practice',
            'units' => 3,
        ]);

        Subject::factory()->create([
            'subject_code' => 'CS450',
            'description' => 'CS Thesis Writing 2',
            'units' => 3,
        ]);
    }
}
