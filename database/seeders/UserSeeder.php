<?php /** @noinspection PhpExpressionResultUnusedInspection */

namespace Database\Seeders;

use App\Models\User;
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

            'newsletter' => 1,
            'new_order_to_email' => 1,
            'new_order_to_sms' => 1,
            'order_status_email' => 1,
            'order_status_sms' => 1,

            'email_marketing' => 1,
            'sms_marketing' => 1,

            'default_locale' => 'ro',
        ]);

        $admin->assignRole('admin');

        User::factory(5)->create();
    }
}
