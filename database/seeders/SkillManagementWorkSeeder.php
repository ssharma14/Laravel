<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Work;
use Illuminate\Support\Str;

class SkillManagementWorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Work::create([
            'user_id' => 1,
            'title' => 'Skill Management',
            'slug' => 'skill-management',
            'description' => 'A Drupal-based application that enables users to track and manage their professional skills with experience levels. Features an autocomplete interface for discovering skills, automatic proficiency classification (Beginner, Intermediate, Advanced, Expert), and a REST API for skill management operations.',
            'features' => 'Drupal, React, PHP, MySQL, REST API',
            'img_path' => '/images/skill-management.png',
            'website_url' => 'https://sshrishti.com/skills',
            'github_url' => 'https://github.com/ssharma14/skill-management.git',
            'published_at' => now(),
        ]);
    }
}
