<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('settings')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'section_title' => 'HOME PAGE SETUP',
                    'section_sort_no' => 1,
                    'field_title' => 'Meta Tag',
                    'sort_no' => 1,
                    'column' => 'meta_tag',
                    'value' => '',
                    'input_type' => 'text',
                    'rules' => 'required',
                ),
            1 =>
                array(
                    'id' => 2,
                    'section_title' => 'HOME PAGE SETUP',
                    'section_sort_no' => 1,
                    'field_title' => 'Meta Description',
                    'sort_no' => 2,
                    'column' => 'meta_descriptio',
                    'value' => '',
                    'input_type' => 'text',
                    'rules' => 'required',
                ),
            2 =>
                array(
                    'id' => 3,
                    'section_title' => 'Site Info',
                    'section_sort_no' => 2,
                    'field_title' => 'address 1',
                    'sort_no' => 1,
                    'column' => 'address_1',
                    'value' => '',
                    'input_type' => 'textarea',
                    'rules' => 'required',
                ),
            3 =>
                array(
                    'id' => 4,
                    'section_title' => 'Site Info',
                    'section_sort_no' => 2,
                    'field_title' => 'address 2',
                    'sort_no' => 2,
                    'column' => 'address_2',
                    'value' => '',
                    'input_type' => 'textarea',
                    'rules' => '',
                ),
            4 =>
                array(
                    'id' => 5,
                    'section_title' => 'Site Info',
                    'section_sort_no' => 2,
                    'field_title' => 'address 3',
                    'sort_no' => 3,
                    'column' => 'address_3',
                    'value' => '',
                    'input_type' => 'textarea',
                    'rules' => '',
                ),
            5 =>
                array(
                    'id' => 6,
                    'section_title' => 'Site Info',
                    'section_sort_no' => 2,
                    'field_title' => 'Contact Number',
                    'sort_no' => 4,
                    'column' => 'contact_number',
                    'value' => '',
                    'input_type' => 'text',
                    'rules' => 'required|number|digits:10',
                ),
            6 =>
                array(
                    'id' => 7,
                    'section_title' => 'Site Info',
                    'section_sort_no' => 2,
                    'field_title' => 'Google Analytics',
                    'sort_no' => 5,
                    'column' => 'google_analytics',
                    'value' => '',
                    'input_type' => 'text',
                    'rules' => '',
                )
        ));
    }
}
