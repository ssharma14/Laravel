<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Work;

class FraminghamRiskCalculatorWorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Work::updateOrCreate(
            ['slug' => 'framingham-risk-calculator'],
            [
                'user_id' => 1,
                'title' => 'Framingham Risk Calculator',
                'description' => "A full-stack, AI-enabled rebuild of a legacy ASP.NET Web Forms app that estimates a patient's 10-year cardiovascular disease risk using the Framingham score. A unit-tested C# domain library does the medical scoring, an ASP.NET Core minimal API exposes it, and a React + TypeScript SPA drives it — with an LLM that turns each result into a plain-language explanation. Assessments are persisted with EF Core, and the Dockerised API runs on a container host while the SPA is served from Firebase Hosting.",
                'features' => 'C# / .NET, ASP.NET Core, React, TypeScript, EF Core, Docker, REST API, AI / LLM',
                'img_path' => '/images/framingham-risk-calculator.png',
                'website_url' => 'https://framingham-risk-calculator.web.app/',
                'github_url' => 'https://github.com/ssharma14/framingham-risk-calculator-asp.git',
                'published_at' => now(),
            ]
        );
    }
}
