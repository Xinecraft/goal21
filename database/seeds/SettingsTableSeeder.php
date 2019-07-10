<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('site_settings')->insert([
            [
                'setting' => 'dashboard_filler_1',
                'setting_display' => 'Dashboard Filler 1',
                'value' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'setting' => 'dashboard_filler_2',
                'setting_display' => 'Dashboard Filler 2',
                'value' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'setting' => 'dashboard_marquee_1',
                'setting_display' => 'Dashboard Marquee Announcement',
                'value' => 'Hell this is a marquee announcement for Sitexxxx',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'setting' => 'kyc_request_status',
                'setting_display' => 'Accept KYC Request',
                'value' => 'yes',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'setting' => 'payout_request_status',
                'setting_display' => 'Accept Payout Request',
                'value' => 'yes',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'setting' => 'golisttasks_filler_1',
                'setting_display' => 'GoTasks Filler 1',
                'value' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'setting' => 'golisttasks_filler_2',
                'setting_display' => 'GoTasks Filler 2',
                'value' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'setting' => 'dashboard_ad_banner_1',
                'setting_display' => 'Dashboard Banner 1 (300x250)',
                'value' => 'https://via.placeholder.com/300x250?text=300x250+ADV',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'setting' => 'dashboard_ad_banner_2',
                'setting_display' => 'Dashboard Banner 2 (300x250)',
                'value' => 'https://via.placeholder.com/300x250?text=300x250+ADV',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'setting' => 'dashboard_ad_banner_3',
                'setting_display' => 'Dashboard Banner 3 (300x250)',
                'value' => 'https://via.placeholder.com/300x250?text=300x250+ADV',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'setting' => 'dashboard_ad_banner_4',
                'setting_display' => 'Dashboard Banner 4 (300x250)',
                'value' => 'https://via.placeholder.com/300x250?text=300x250+ADV',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'setting' => 'golisttask_ad_banner_1',
                'setting_display' => 'GoListTask Banner 1 (300x600)',
                'value' => 'https://via.placeholder.com/300x600?text=300x600+Half+Page+Ad',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'setting' => 'golisttask_ad_banner_2',
                'setting_display' => 'GoListTask Banner 2 (300x600)',
                'value' => 'https://via.placeholder.com/300x600?text=300x600+Half+Page+Ad',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'setting' => 'listtask_ad_banner_1',
                'setting_display' => 'ListTask Banner 1 (728x90)',
                'value' => 'https://via.placeholder.com/728x91?text=728x90+Leaderboard',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'setting' => 'listtask_ad_banner_2',
                'setting_display' => 'ListTask Banner 2 (350x90)',
                'value' => 'https://via.placeholder.com/350x90?text=350x90+Half +Banner',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
