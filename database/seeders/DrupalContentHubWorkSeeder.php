<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Work;

class DrupalContentHubWorkSeeder extends Seeder
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
            'title' => 'Drupal Content Hub',
            'slug' => 'drupal-content-hub',
            'description' => 'A Drupal CMS featuring structured content types, taxonomy-based organization, and dynamic faceted search. Includes custom modules for search query alteration, featured content prioritization, and AJAX-powered filtering with no page reload.',
            'features' => 'Drupal, PHP, MySQL, Search API, Facets, Twig, JavaScript',
            'img_path' => '/images/drupal-content-hub.png',
            'website_url' => 'https://sshrishti.com/drupal-content-hub/web',
            'github_url' => 'https://github.com/ssharma14/drupal-content-hub.git',
            'published_at' => now(),
        ]);
    }
}
