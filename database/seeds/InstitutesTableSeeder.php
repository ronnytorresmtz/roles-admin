<?php

use Illuminate\Database\Seeder;

class InstitutesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('institutes')->delete();


            Institute::create(array(
                'institute_short_name'    => 'REBSAMEN',
                'institute_long_name'     => 'INSTITUTO BILINGUE REBSAMEN, A.C.',
                'institute_address1'      => 'CAMINO DE LOS ALAMOS 4300',
                'institute_address2'      => 'CORTIJO DEL RIO',
                'institute_city'          => 1,
                'institute_state'         => 1,
                'institute_contry'        => 1,
                'institute_zipcode'      => '64890',
                'institute_phone_number'  => '52 81 0000-0000',
                'institute_email'         => 'email_name@gmail.com',
                'institute_reg_number'    => 'IRE140123EY5',
            ));

		
    }
}
 