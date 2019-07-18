<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            [
                'uuid' => \Uuid::generate(4),
                'username' => 'GL000000',
                'full_name' => 'GOAL21 ADMIN',
                'email' => 'sa@goal21.com',
                'password' => \Hash::make('GLadmin@1337x'),
                'phone_number' => '00000000',
                'gender' => 'O',
                'dob' => \Carbon\Carbon::createFromFormat('d-m-Y', '11-4-1994'),
                'referral_user_id' => null,
                'last_login_ip' => null,
                'pancard' => 'PANCARDXXX',
                'city' => 'Bangalore',
                'district' => 'Bangalore',
                'state' => 'KA',
                'pincode' => '560100',
                'preferred_payment_method' => 'BANK',
                'bank_account_holdername' => 'TEST NAME',
                'bank_account_number' => '0000000000',
                'bank_account_bankname' => 'TEST NATIONAL BANK',
                'bank_account_type' => 'SA',
                'bank_account_ifsc' => 'BOIABCABCA',
                'paytm_number' => '0000000000',
                'is_profile_completed' => true,
                'status' => 1,
                'activated_at' => null,
                'payment_confirmed' => -1,
				'created_at' => \Carbon\Carbon::now(),
                'user_role' => 101,
                'is_kyc' => 1,
                'kyc_request_at' => \Carbon\Carbon::now(),
                'kyc_approved_at' => \Carbon\Carbon::now()
            ]
        ]);
    }
}
