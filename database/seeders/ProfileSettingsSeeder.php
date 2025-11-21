<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProfileSetting;
use App\Models\Skill;
use App\Models\Project;

class ProfileSettingsSeeder extends Seeder
{
    public function run(): void
    {
        // Profile Settings
        $settings = [
            // Hero Section
            ['key' => 'hero_title', 'value' => 'Pradhika Setyawan', 'group' => 'hero'],
            ['key' => 'hero_role', 'value' => 'Engineer · Web Developer', 'group' => 'hero'],
            ['key' => 'hero_tagline', 'value' => 'Building reliable systems and beautiful web experiences — JavaScript, PHP, Laravel, and modern UX.', 'group' => 'hero'],
            
            // Badges
            ['key' => 'badges', 'value' => json_encode(['Engineer', 'Web Developer', 'UI/UX']), 'type' => 'json', 'group' => 'hero'],
            
            // Overview
            ['key' => 'overview_title', 'value' => 'What I do', 'group' => 'overview'],
            ['key' => 'overview_description', 'value' => 'Design and implement scalable web apps, APIs, and tooling. I enjoy working across the stack and improving developer workflows.', 'group' => 'overview'],
        ];

        foreach ($settings as $setting) {
            ProfileSetting::create($setting);
        }

        // Skills
        $skills = [
            ['name' => 'Laravel', 'slug' => 'laravel', 'data_tech' => 'laravel', 'category' => 'backend', 'show_in_grid' => true, 'sort_order' => 1],
            ['name' => 'Node.js', 'slug' => 'nodejs', 'data_tech' => 'nodejs', 'category' => 'backend', 'show_in_grid' => true, 'sort_order' => 2],
            ['name' => 'CodeIgniter', 'slug' => 'codeigniter', 'data_tech' => 'codeigneter', 'category' => 'backend', 'show_in_grid' => true, 'sort_order' => 3],
            ['name' => 'IoT', 'slug' => 'iot', 'data_tech' => 'iot', 'category' => 'iot', 'show_in_grid' => true, 'sort_order' => 4],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        // Projects
        $projects = [
            // Laravel Projects
            [
                'title' => 'API IoT Device Management',
                'description' => 'API integration for IoT device management and data collection',
                'technology' => 'laravel',
                'project_url' => '#',
                'code_url' => 'https://github.com/prdhk2/API_Integration_IoT-Laravel12',
                'meta' => 'Laravel, MySQL',
                'sort_order' => 1,
            ],
            [
                'title' => 'Admin Dashboard',
                'description' => 'Comprehensive admin panel with real-time analytics',
                'technology' => 'laravel',
                'project_url' => '#',
                'code_url' => '#',
                'meta' => 'Laravel, Livewire',
                'sort_order' => 2,
            ],
            [
                'title' => 'Blog Platform',
                'description' => 'Multi-user blogging platform with rich text editing and SEO features',
                'technology' => 'laravel',
                'project_url' => '#',
                'code_url' => '#',
                'meta' => 'Laravel, Vue.js',
                'sort_order' => 3,
            ],
            
            // Node.js Projects
            [
                'title' => 'Realtime Catalog',
                'description' => 'Product catalog with real-time updates using Socket.io',
                'technology' => 'nodejs',
                'project_url' => '#',
                'code_url' => '#',
                'meta' => 'Node.js, Socket.io',
                'sort_order' => 1,
            ],
            
            // CodeIgniter Projects
            [
                'title' => 'Toko Online "Bakul Sayur"',
                'description' => 'Project Toko Online untuk penjualan sayur secara online, Dilengkap dengan API Payment gateway (Midtrans)',
                'technology' => 'codeigneter',
                'project_url' => '#',
                'code_url' => 'https://github.com/prdhk2/toko-online-codeigniter3',
                'meta' => 'CodeIgniter 3, MySQL',
                'sort_order' => 1,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}