<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    private $gender = ['pria', 'wanita'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'hcp user',
            'email' => 'hcp@test.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);
        Profile::create([
            'user_id'               => $user->id,
            'photo'                 => 'plugin/images/1__home-page/u15-fixed.jpg',
            'NPK'                   => $this->_generateRandomNPK(),
            'gender'                => $this->gender[rand(0, 1)],
            'namaJabatan'           => 'HCP',
            'unitKerja'             => 'BPJS',
            'tanggalLahir'          => '1990-01-01',
            'tanggalMulaiJabatan'   => '2017-01-01',
        ]);
        $user->assignRole('HCP');

        $user = User::create([
            'name' => 'kuk user',
            'email' => 'kuk@test.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);
        Profile::create([
            'user_id'               => $user->id,
            'photo'                 => 'plugin/images/1__home-page/u15-fixed.jpg',
            'NPK'                   => $this->_generateRandomNPK(),
            'gender'                => $this->gender[rand(0, 1)],
            'namaJabatan'           => 'Kepala Unit Kerja',
            'unitKerja'             => 'BPJS',
            'tanggalLahir'          => '1990-01-01',
            'tanggalMulaiJabatan'   => '2017-01-01',
        ]);
        $user->assignRole('Kepala Unit Kerja');

        $user = User::create([
            'name' => 'al user',
            'email' => 'al@test.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);
        Profile::create([
            'user_id'               => $user->id,
            'photo'                 => 'plugin/images/1__home-page/u15-fixed.jpg',
            'NPK'                   => $this->_generateRandomNPK(),
            'gender'                => $this->gender[rand(0, 1)],
            'namaJabatan'           => 'Atasan Langsung',
            'unitKerja'             => 'BPJS',
            'tanggalLahir'          => '1990-01-01',
            'tanggalMulaiJabatan'   => '2017-01-01',
        ]);
        $user->assignRole('Atasan Langsung');

        $user = User::create([
            'name' => 'karyawan user',
            'email' => 'karyawan@test.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);
        Profile::create([
            'user_id'               => $user->id,
            'photo'                 => 'plugin/images/1__home-page/u15-fixed.jpg',
            'NPK'                   => $this->_generateRandomNPK(),
            'gender'                => $this->gender[rand(0, 1)],
            'namaJabatan'           => 'Karyawan',
            'unitKerja'             => 'BPJS',
            'tanggalLahir'          => '1990-01-01',
            'tanggalMulaiJabatan'   => '2017-01-01',
        ]);
        $user->assignRole('Karyawan');
    }

    function _generateRandomNPK($length = 9)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
