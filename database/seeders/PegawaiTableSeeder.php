<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('pegawai')->delete();

        DB::table('pegawai')->insert(array(
            0 =>
            array(
                'id' => 1,
                'nip' => '19630403 200701 1 021',
                'nama' => 'Z A M R A N',
                'jenis_kelamin' => 1,
                'tempat_lahir' => 'MAMBORO',
                'tanggal_lahir' => '2022-06-03',
                'golongan_id' => 6,
                'jabatan' => 'Staf Sub.Bagian Kepegawaian dan Umum',
                'bidang_id' => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-06-21 07:33:43',
                'updated_at' => '2022-06-21 07:33:43',
            ),
            1 =>
            array(
                'id' => 2,
                'nip' => '19820802 200112 1 006',
                'nama' => 'WAHYU AGUS PRATAMA , S.STP.M.AP',
                'jenis_kelamin' => 1,
                'tempat_lahir' => 'PALU',
                'tanggal_lahir' => '1982-08-02',
                'golongan_id' => 13,
                'jabatan' => 'KEPALA BIDANG PERENCANAAN SOSIAL DAN BUDAYA',
                'bidang_id' => 12,
                'deleted_at' => NULL,
                'created_at' => '2022-06-26 04:11:02',
                'updated_at' => '2022-06-26 04:26:40',
            ),
            2 =>
            array(
                'id' => 3,
                'nip' => '99999999 999999 9 999',
                'nama' => 'FAKHRURRAZI',
                'jenis_kelamin' => 1,
                'tempat_lahir' => '',
                'tanggal_lahir' => '2022-06-03',
                'golongan_id' => 6,
                'jabatan' => NULL,
                'bidang_id' => 1,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
    }
}
