<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TanggalLiburTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tanggal_libur')->delete();
        
        \DB::table('tanggal_libur')->insert(array (
            0 => 
            array (
                'id' => 1,
                'tanggal_start' => '2022-07-31 00:00:00',
                'tanggal_end' => '2022-07-31 23:59:59',
                'dalam_rangka' => 'Muharram / Islamic New Year',
                'catatan' => NULL,
                'deleted_at' => '2022-07-12 18:08:15',
                'created_at' => '2022-07-12 18:02:19',
                'updated_at' => '2022-07-12 18:08:15',
            ),
            1 => 
            array (
                'id' => 2,
                'tanggal_start' => '2022-07-31 00:00:00',
                'tanggal_end' => '2022-07-31 23:59:59',
                'dalam_rangka' => 'Muharram / Islamic New Year',
                'catatan' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2022-07-12 18:08:32',
                'updated_at' => '2022-07-12 18:08:32',
            ),
        ));
        
        
    }
}