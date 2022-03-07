<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'HCP']);
        Role::create(['name' => 'Kepala Unit Kerja']);
        Role::create(['name' => 'Atasan Langsung']);
        Role::create(['name' => 'Karyawan']);

        // Melihat, membuat dan mengedit indikator KPI (2, 2.1)
        $permission = Permission::create(['name' => 'indikator KPI']);
        $permission->assignRole('HCP');

        // Menyusun dan mengedit KPI bawahan
        // kemudian mengajukan review ke atasan (3, 3.1, 3.2)
        $permission = Permission::create(['name' => 'mengajukan review ke atasan']);
        $permission->syncRoles(['Kepala Unit Kerja', 'Atasan Langsung']);

        // Mereview draft penyusunan KPI (4, 4.1)
        $permission = Permission::create(['name' => 'draft penyusunan KPI']);
        $permission->syncRoles(['Kepala Unit Kerja', 'HCP']);

        // Melihat dan memberi penilaian KPI pribadi (5, 5.1)
        $permission = Permission::create(['name' => 'penilaian KPI pribadi']);
        $permission->syncRoles(['Karyawan', 'Atasan Langsung', 'Kepala Unit Kerja']);

        // Memberi penilaian KPI bawahan (6, 6.1)
        $permission = Permission::create(['name' => 'penilaian KPI bawahan']);
        $permission->syncRoles(['Atasan Langsung', 'Kepala Unit Kerja']);

        // Mereview draft penilaian KPI (7, 7.1)
        $permission = Permission::create(['name' => 'draft penilaian KPI']);
        $permission->syncRoles(['HCP', 'Kepala Unit Kerja']);
    }
}
