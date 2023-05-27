<?php

namespace Database\Seeders;

use App\Models\WbsRecipient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class WBSRecipientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wbs_recipients = [
            [
                'name' => 'Deputi A',
                'email' => 'taufi2@mailer.com',
                'phone' => '08123123123',
                'division' => '',
                'email_verified_at' => null,
                'status' => 'active',
                'url_token' => (function () {
                    $uuid = Str::orderedUuid();
                    $epoch = Carbon::now()->timestamp;
                    return Str::slug($epoch . '-' . str_shuffle($uuid));
                })(),
            ],
            [
                'name' => 'Deputi B',
                'email' => 'kuru@gmail.com',
                'phone' => '08123123435',
                'division' => '',
                'email_verified_at' => null,
                'status' => 'active',
                'url_token' => (function () {
                    $uuid = Str::orderedUuid();
                    $epoch = Carbon::now()->timestamp;
                    return Str::slug($epoch . '-' . str_shuffle($uuid));
                })(),
            ],
            [
                'name' => 'ASDEP',
                'email' => 'taufiq@gmaill.com',
                'phone' => '0812343245',
                'division' => '',
                'email_verified_at' => null,
                'status' => 'active',
                'url_token' => (function () {
                    $uuid = Str::orderedUuid();
                    $epoch = Carbon::now()->timestamp;
                    return Str::slug($epoch . '-' . str_shuffle($uuid));
                })(),
            ],
        ];
        foreach ($wbs_recipients as $recipient) {
            WbsRecipient::create([
                'name' => $recipient['name'],
                'email' => $recipient['email'],
                'phone' => $recipient['phone'],
                'division' => $recipient['division'],
                'email_verified_at' => $recipient['email_verified_at'],
                'status' => $recipient['status'],
                'url_token' => $recipient['url_token'],
            ]);
        }
    }
}
