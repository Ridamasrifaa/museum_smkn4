<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Super Admin (Akses Semua Jurusan)
        User::create([
            'name'     => 'Super Admin',
            'email'    => 'superadmin@gmail.com',
            'password' => Hash::make('superadmin123'),
            'role'     => 0,
            'jurusan'  => null,
        ]);

        // 2. Admin PPLG
        User::create([
            'name'     => 'Admin PPLG',
            'email'    => 'admin.pplg@gmail.com',
            'password' => Hash::make('admin123'),
            'role'     => 1,
            'jurusan'  => 'PPLG',
        ]);

        // 3. Admin DKV
        User::create([
            'name'     => 'Admin DKV',
            'email'    => 'admin.dkv@gmail.com',
            'password' => Hash::make('admin123'),
            'role'     => 1,
            'jurusan'  => 'DKV',
        ]);

        // 4. Admin TOI
        User::create([
            'name'     => 'Admin TOI',
            'email'    => 'admin.toi@gmail.com',
            'password' => Hash::make('admin123'),
            'role'     => 1,
            'jurusan'  => 'TOI',
        ]);
        // 5. Admin TKJ
        User::create([
            'name'     => 'Admin TKJ',
            'email'    => 'admin.tkj@gmail.com',
            'password' => Hash::make('admin123'),
            'role'     => 1,
            'jurusan'  => 'TKJ',
        ]);
        // 6. Admin TSM
        User::create([
            'name'     => 'Admin TSM',
            'email'    => 'admin.tsm@gmail.com',
            'password' => Hash::make('admin123'),
            'role'     => 1,
            'jurusan'  => 'TSM',
        ]);

        // 7. Siswa Test
        User::create([
            'name'     => 'Siswa Test PPLG',
            'email'    => 'siswa1@gmail.com',
            'password' => Hash::make('siswa123'),
            'role'     => 2,
            'jurusan'  => 'PPLG',
        ]);

        $this->command->info('✓ Akun Super Admin, Admin PPLG/DKV/TOI, dan Siswa berhasil di-seed!');
        $this->command->info('✓ Admin dan 2 test students berhasil di-seed!');
        $this->command->info('');
        $this->command->info('Login Credentials:');
        $this->command->info('Super Admin:   superadmin@gmail.com / superadmin123');
        $this->command->info('Admin PPLG:  admin.pplg@gmail.com / admin123');
        $this->command->info('Admin DKV:  admin.dkv@gmail.com / admin123');
        $this->command->info('Admin TOI:  admin.toi@gmail.com / admin123');
        $this->command->info('Admin TKJ:  admin.tkj@gmail.com / admin123');
        $this->command->info('Admin TSM:  admin.tsm@gmail.com / admin123');
        $this->command->info('Siswa 1: siswa1@gmail.com / siswa123');
    }
}
