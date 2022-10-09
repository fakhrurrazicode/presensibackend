<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HariJamKerjaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('hari_jam_kerja')->delete();

        DB::table('hari_jam_kerja')->insert(array(
            0 =>
            array(
                'id' => 1,
                'hari_id' => 0,
                'nama_hari' => 'minggu',
                'jam_masuk_start' => '07:45:00',
                // 'jam_masuk' => '08:00:00',
                'jam_masuk_end' => '08:15:00',
                'jam_keluar_start' => '16:45:00',
                // 'jam_keluar' => '17:00:00',
                'jam_keluar_end' => '17:15:00',
                'libur' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array(
                'id' => 2,
                'hari_id' => 1,
                'nama_hari' => 'senin',
                'jam_masuk_start' => '07:45:00',
                // 'jam_masuk' => '08:00:00',
                'jam_masuk_end' => '08:15:00',
                'jam_keluar_start' => '16:45:00',
                // 'jam_keluar' => '17:00:00',
                'jam_keluar_end' => '17:15:00',
                'libur' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 =>
            array(
                'id' => 3,
                'hari_id' => 2,
                'nama_hari' => 'selasa',
                'jam_masuk_start' => '07:45:00',
                // 'jam_masuk' => '08:00:00',
                'jam_masuk_end' => '08:15:00',
                'jam_keluar_start' => '16:45:00',
                // 'jam_keluar' => '17:00:00',
                'jam_keluar_end' => '17:15:00',
                'libur' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 =>
            array(
                'id' => 4,
                'hari_id' => 3,
                'nama_hari' => 'rabu',
                'jam_masuk_start' => '07:45:00',
                // 'jam_masuk' => '08:00:00',
                'jam_masuk_end' => '08:15:00',
                'jam_keluar_start' => '16:45:00',
                // 'jam_keluar' => '17:00:00',
                'jam_keluar_end' => '17:15:00',
                'libur' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 =>
            array(
                'id' => 5,
                'hari_id' => 4,
                'nama_hari' => 'kamis',
                'jam_masuk_start' => '07:45:00',
                // 'jam_masuk' => '08:00:00',
                'jam_masuk_end' => '08:15:00',
                'jam_keluar_start' => '16:45:00',
                // 'jam_keluar' => '17:00:00',
                'jam_keluar_end' => '17:15:00',
                'libur' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 =>
            array(
                'id' => 6,
                'hari_id' => 5,
                'nama_hari' => 'jumat',
                'jam_masuk_start' => '07:45:00',
                // 'jam_masuk' => '08:00:00',
                'jam_masuk_end' => '08:15:00',
                'jam_keluar_start' => '16:15:00',
                // 'jam_keluar' => '16:30:00',
                'jam_keluar_end' => '16:45:00',
                'libur' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => '2022-06-29 20:46:37',
            ),
            6 =>
            array(
                'id' => 7,
                'hari_id' => 6,
                'nama_hari' => 'sabtu',
                'jam_masuk_start' => '07:45:00',
                // 'jam_masuk' => '08:00:00',
                'jam_masuk_end' => '08:15:00',
                'jam_keluar_start' => '16:45:00',
                // 'jam_keluar' => '17:00:00',
                'jam_keluar_end' => '17:15:00',
                'libur' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
    }
}
