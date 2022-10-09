<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BidangTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('bidang')->delete();

        \DB::table('bidang')->insert(array(
            0 =>
            array(
                'id' => 1,
                'kode' => 'SEK',
                'nama' => 'SEKRETARIAT',
                'singkatan' => 'SEK',
                'created_at' => NULL,
                'updated_at' => '2022-06-18 05:25:50',
            ),
            1 =>
            array(
                'id' => 2,
                'kode' => 'BID.I',
                'nama' => 'BIDANG PERENCANAAN EKONOMI',
                'singkatan' => 'BID.I',
                'created_at' => '2022-06-17 09:01:11',
                'updated_at' => '2022-06-17 09:01:11',
            ),
            2 =>
            array(
                'id' => 9,
                'kode' => 'BID.II',
                'nama' => 'BIDANG PERENCANAAN SOSIAL BUDAYA',
                'singkatan' => 'BID.II',
                'created_at' => '2022-06-18 17:58:37',
                'updated_at' => '2022-06-18 17:58:37',
            ),
            3 =>
            array(
                'id' => 10,
                'kode' => 'BID.III',
                'nama' => 'BIDANG PERENCANAAN INFRASTUKTUR & PENGEMB.WILAYAH',
                'singkatan' => 'BID.III',
                'created_at' => '2022-06-18 17:58:54',
                'updated_at' => '2022-06-18 17:58:54',
            ),
            4 =>
            array(
                'id' => 11,
                'kode' => 'BID.IV',
                'nama' => 'BIDANG PERENCANAAN MAKRO DAN DALMONEV',
                'singkatan' => 'BID.IV',
                'created_at' => '2022-06-18 17:59:10',
                'updated_at' => '2022-06-18 17:59:10',
            ),
            5 =>
            array(
                'id' => 12,
                'kode' => 'UPTB',
                'nama' => 'UPTB PUSAT ANALISIS & VISUALISASI DATA DAERAH',
                'singkatan' => 'UPTB',
                'created_at' => '2022-06-18 17:59:21',
                'updated_at' => '2022-06-18 17:59:21',
            ),
        ));
    }
}
