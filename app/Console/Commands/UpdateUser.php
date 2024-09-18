<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UpdateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Update User's First Name, Last Name And Timezone to Random Values";

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $users = User::all();
        $faker = \Faker\Factory::create();
        $bar = $this->output->createProgressBar($users->count());

        foreach ($users as $user) {
            $user->update([
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'timezone' => $faker->randomElement(['CET', 'CST', 'GMT+1']),
            ]);
            $bar->advance();
        }
        $bar->finish();
        $this->line('');
        $this->info('Users Updated Successfully');
    }
}
