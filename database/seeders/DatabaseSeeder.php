<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Donatur;
use App\Models\Korban;
use App\Models\Volunteer;
use App\Models\ProgramBantuan;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        Admin::create([
            'nama_admin' => 'Rizqi',
            'username'   => 'admin_rizqi',
            'password'   => Hash::make('12345678'),
            'role'       => 'super_admin',
        ]);

        // Create Donatur
        Donatur::create([
            'nama_donatur' => 'Muthia',
            'alamat'       => 'Jl. Sudirman No. 123, Jakarta',
            'no_hp'        => '081234567890',
            'email'        => 'muthia@gmail.com',
            'password'     => Hash::make('12345678'),
        ]);

        Donatur::create([
            'nama_donatur' => 'rizu',
            'alamat'       => 'Jl. Gatot Subroto No. 45, Bandung',
            'no_hp'        => '082345678901',
            'email'        => 'rizu@gmail.com',
            'password'     => Hash::make('12345678'),
        ]);

        // Create Korban
        Korban::create([
            'nama_korban'       => 'amru',
            'email'             => 'amru@gmail.com',
            'alamat'            => 'Desa Sukamaju, Kec. Cianjur, Jawa Barat',
            'jenis_bencana'     => 'Gempa Bumi',
            'keterangan'        => 'Rumah rusak total akibat gempa',
            'no_hp'             => '083456789012',
            'password'          => Hash::make('12345678'),
            'status_verifikasi' => 'terverifikasi',
        ]);

        Korban::create([
            'nama_korban'       => 'kipli',
            'email'             => 'kipli@gmail.com',
            'alamat'            => 'Kampung Mekar, Kec. Garut, Jawa Barat',
            'jenis_bencana'     => 'Banjir',
            'keterangan'        => 'Kehilangan harta benda akibat banjir bandang',
            'no_hp'             => '084567890123',
            'password'          => Hash::make('12345678'),
            'status_verifikasi' => 'terverifikasi',
        ]);

        // Create Volunteer
        Volunteer::create([
            'nama_volunteer' => 'Ahnaf',
            'alamat'         => 'Jl. Merdeka No. 67, Yogyakarta',
            'no_hp'          => '085678901234',
            'email'          => 'ahnaf@gmail.com',
            'password'       => Hash::make('12345678'),
            'status'         => 'aktif',
        ]);

        Volunteer::create([
            'nama_volunteer' => 'ozzie',
            'alamat'         => 'Jl. Pemuda No. 89, Semarang',
            'no_hp'          => '086789012345',
            'email'          => 'ozzie@gmail.com',
            'password'       => Hash::make('12345678'),
            'status'         => 'aktif',
        ]);

        // Create Program Bantuan
        ProgramBantuan::create([
            'nama_program'    => 'Bantuan Gempa Cianjur 2026',
            'jenis_bantuan'   => 'Tunai',
            'tanggal_mulai'   => '2026-01-01',
            'tanggal_selesai' => '2026-03-31',
            'keterangan'      => 'Program bantuan untuk korban gempa bumi di Cianjur',
            'target_dana'     => 100000000,
            'dana_terkumpul'  => 0,
            'status'          => 'aktif',
        ]);

        ProgramBantuan::create([
            'nama_program'    => 'Bantuan Banjir Bandang Garut',
            'jenis_bantuan'   => 'Sembako',
            'tanggal_mulai'   => '2026-01-10',
            'tanggal_selesai' => '2026-02-28',
            'keterangan'      => 'Penyaluran sembako untuk korban banjir bandang',
            'target_dana'     => 50000000,
            'dana_terkumpul'  => 0,
            'status'          => 'aktif',
        ]);

        ProgramBantuan::create([
            'nama_program'    => 'Renovasi Rumah Korban Bencana',
            'jenis_bantuan'   => 'Tempat Tinggal',
            'tanggal_mulai'   => '2026-02-01',
            'tanggal_selesai' => '2026-06-30',
            'keterangan'      => 'Program renovasi rumah untuk korban bencana alam',
            'target_dana'     => 200000000,
            'dana_terkumpul'  => 0,
            'status'          => 'aktif',
        ]);
    }
}
