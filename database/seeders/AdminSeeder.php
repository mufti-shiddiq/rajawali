<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new \App\Models\User;
        $admin->username = "admin";
        $admin->name = "Admininstrator";
        $admin->email = "admin@rajawali.test";
        $admin->role = json_encode(["ADMIN"]);
        $admin->password = \Hash::make("admin");
        $admin->save();
        $this->command->info("User Admin berhasil diinsert");
    }
}
