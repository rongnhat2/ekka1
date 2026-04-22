<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Tài khoản quản trị mặc định (mật khẩu tương ứng hash sẵn trong cột password).
     */
    public function run(): void
    {
        if (DB::table('admin')->where('email', 'admin@gmail.com')->exists()) {
            return;
        }

        DB::table('admin')->insert([
            'secret_key' => 3745821,
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$pmNHwQhyhP.dmPUxVMXzQOtB9IUo3q5NYqJSpaAvGEMI8aK5eyVx6',
            'verify_code' => null,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
