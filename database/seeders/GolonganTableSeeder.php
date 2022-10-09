<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GolonganTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('golongan')->delete();
        
        \DB::table('golongan')->insert(array (
            0 => 
            array (
                'id' => 1,
                'golongan' => 'I/A',
                'nama_pangkat' => 'JURU MUDA',
                'deleted_at' => NULL,
                'created_at' => '2022-06-18 18:22:32',
                'updated_at' => '2022-06-18 18:22:32',
            ),
            1 => 
            array (
                'id' => 2,
                'golongan' => 'I/B',
                'nama_pangkat' => 'JURU MUDA TINGKAT I',
                'deleted_at' => NULL,
                'created_at' => '2022-06-18 18:22:45',
                'updated_at' => '2022-06-18 18:22:45',
            ),
            2 => 
            array (
                'id' => 3,
                'golongan' => 'I/C',
                'nama_pangkat' => 'JURU',
                'deleted_at' => NULL,
                'created_at' => '2022-06-18 18:22:55',
                'updated_at' => '2022-06-18 18:22:55',
            ),
            3 => 
            array (
                'id' => 4,
                'golongan' => 'I/D',
                'nama_pangkat' => 'JURU TINGKAT I',
                'deleted_at' => NULL,
                'created_at' => '2022-06-18 18:23:04',
                'updated_at' => '2022-06-18 18:23:04',
            ),
            4 => 
            array (
                'id' => 5,
                'golongan' => 'II/A',
                'nama_pangkat' => 'PENGATUR MUDA',
                'deleted_at' => NULL,
                'created_at' => '2022-06-18 18:23:12',
                'updated_at' => '2022-06-18 18:23:12',
            ),
            5 => 
            array (
                'id' => 6,
                'golongan' => 'II/B',
                'nama_pangkat' => 'PENGATUR MUDA TINGKAT I',
                'deleted_at' => NULL,
                'created_at' => '2022-06-18 18:23:22',
                'updated_at' => '2022-06-18 18:23:22',
            ),
            6 => 
            array (
                'id' => 7,
                'golongan' => 'II/C',
                'nama_pangkat' => 'PENGATUR',
                'deleted_at' => NULL,
                'created_at' => '2022-06-18 18:23:29',
                'updated_at' => '2022-06-18 18:23:29',
            ),
            7 => 
            array (
                'id' => 8,
                'golongan' => 'II/D',
                'nama_pangkat' => 'PENGATUR TINGKAT I',
                'deleted_at' => NULL,
                'created_at' => '2022-06-18 18:23:37',
                'updated_at' => '2022-06-18 18:23:37',
            ),
            8 => 
            array (
                'id' => 9,
                'golongan' => 'III/A',
                'nama_pangkat' => 'PENATA MUDA',
                'deleted_at' => NULL,
                'created_at' => '2022-06-18 18:23:44',
                'updated_at' => '2022-06-18 18:23:44',
            ),
            9 => 
            array (
                'id' => 10,
                'golongan' => 'III/B',
                'nama_pangkat' => 'PENATA MUDA TINGKAT I',
                'deleted_at' => NULL,
                'created_at' => '2022-06-18 18:23:52',
                'updated_at' => '2022-06-18 18:23:52',
            ),
            10 => 
            array (
                'id' => 11,
                'golongan' => 'III/C',
                'nama_pangkat' => 'PENATA',
                'deleted_at' => NULL,
                'created_at' => '2022-06-18 18:24:00',
                'updated_at' => '2022-06-18 18:24:00',
            ),
            11 => 
            array (
                'id' => 12,
                'golongan' => 'III/D',
                'nama_pangkat' => 'PENATA TINGKAT I',
                'deleted_at' => NULL,
                'created_at' => '2022-06-18 18:24:10',
                'updated_at' => '2022-06-18 18:24:10',
            ),
            12 => 
            array (
                'id' => 13,
                'golongan' => 'IV/A',
                'nama_pangkat' => 'PEMBINA',
                'deleted_at' => NULL,
                'created_at' => '2022-06-18 18:24:17',
                'updated_at' => '2022-06-18 18:24:17',
            ),
            13 => 
            array (
                'id' => 14,
                'golongan' => 'IV/B',
                'nama_pangkat' => 'PEMBINA TINGKAT I',
                'deleted_at' => NULL,
                'created_at' => '2022-06-18 18:24:24',
                'updated_at' => '2022-06-18 18:24:24',
            ),
            14 => 
            array (
                'id' => 15,
                'golongan' => 'IV/C',
                'nama_pangkat' => 'PEMBINA UTAMA MUDA',
                'deleted_at' => NULL,
                'created_at' => '2022-06-18 18:24:31',
                'updated_at' => '2022-06-18 18:24:31',
            ),
            15 => 
            array (
                'id' => 16,
                'golongan' => 'IV/D',
                'nama_pangkat' => 'PEMBINA UTAMA MADYA',
                'deleted_at' => NULL,
                'created_at' => '2022-06-18 18:24:38',
                'updated_at' => '2022-06-18 18:24:38',
            ),
            16 => 
            array (
                'id' => 17,
                'golongan' => 'IV/E',
                'nama_pangkat' => 'PEMBINA UTAMA',
                'deleted_at' => NULL,
                'created_at' => '2022-06-18 18:24:45',
                'updated_at' => '2022-06-18 18:24:45',
            ),
        ));
        
        
    }
}