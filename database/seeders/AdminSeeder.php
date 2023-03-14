<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Staff();

        $admin->first_name = 'main';
        $admin->father_name = 'staff';
        $admin->last_name = 'admin';
        $admin->username = 'Admin';
        $admin->qualifications = 'Admin';
        $admin->password = Hash::make('@Dm!n12E');
        $admin->is_admin = true;

        $admin->save();
    }
}
