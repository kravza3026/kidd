<?php /** @noinspection PhpExpressionResultUnusedInspection */

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'company_id' => 1,
            'first_name' => 'Edward',
            'last_name' => 'Zed',
            'phone' => '+37360558845',
            'email' => 'edward@kidd.md',
            'password' => bcrypt('testerer'),

            'phone_verified_at' => now(),
            'email_verified_at' => now(),

            'email_marketing' => 1,
            'sms_marketing' => 1,

            'default_locale' => 'ro',
        ]);

        $admin->assignRole('admin');

        User::factory(5)->create();
    }
}
