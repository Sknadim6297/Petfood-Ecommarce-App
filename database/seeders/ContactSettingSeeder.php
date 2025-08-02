<?php

namespace Database\Seeders;

use App\Models\ContactSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSettingSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        ContactSetting::create([
            'page_title' => 'Contact Us',
            'page_subtitle' => 'Get in touch with our pet care experts',
            'hero_title' => 'We would love to hear from you.',
            'hero_description' => 'Expert Pet Care with a personal touch',
            'email_title' => 'Email Address.',
            'email_address' => 'info@petnet.com',
            'phone_title' => 'Phone Number.',
            'phone_number' => '+09 121 359 6224',
            'phone_subtitle' => '24/7 Support team',
            'hours_title' => 'Working Hours.',
            'working_hours' => '9:00 AM - 5:00 PM',
            'working_days' => 'Monday - Friday',
            'branch_title' => 'Find a dog walker or pet care',
            'branch_description' => 'Place your trust in We Love Pets, an award-winning dog walking and pet care',
            'branch_placeholder' => 'Enter address or postcode...',
            'office1_title' => 'Head Office United State:',
            'office1_address' => '#201 1218 9th Avenue SE, Calgary, AB T2G 0T1',
            'office2_title' => 'Head Office Canada:',
            'office2_address' => '#201 1218 9th Avenue SE, Calgary, AB T2G 0T1',
            'form_title' => 'Book Your Place or Find out More',
            'form_textarea_placeholder' => 'Please let us know which day package you\'re interested',
            'awards_title' => 'Awards Winning Company',
            'show_awards' => true,
            'is_active' => true,
        ]);
    }
}
