<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Client;
use App\Models\Company;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $clients = Client::factory(3)->create();

        $companies = Company::factory(3)->create();

        Project::factory(5)->create([
            'client_id' => $clients->random()->id,
        ]);

        Project::factory(5)->create([
            'company_id' => $companies->random()->id,
        ]);

        $projects = Project::all();

        Task::factory(50)->create([
            'project_id' => function () use ($projects) {
                return $projects->random()->id;
            },
        ]);

        $projects->each(function ($project) {
            $project->calculateDuration();
            $project->updateStatus();
        });
    }
}
