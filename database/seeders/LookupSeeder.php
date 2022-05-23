<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LookupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lookups')->insert([
            [
                'key' => 'TYPE',
                'value' => 'Bookshelves'
            ],
            [
                'key' => 'TYPE',
                'value' => 'Chairs'
            ],
            [
                'key' => 'TYPE',
                'value' => 'Tables'
            ],
            [
                'key' => 'TYPE',
                'value' => 'Rugs'
            ],
            [
                'key' => 'TYPE',
                'value' => 'Lighting'
            ],
            [
                'key' => 'TYPE',
                'value' => 'Sofas'
            ],
            [
                'key' => 'TYPE',
                'value' => 'Accessories'
            ],
            [
                'key' => 'VENDOR',
                'value' => 'Box + Cask'
            ],
            [
                'key' => 'VENDOR',
                'value' => 'DIME Design'
            ],
            [
                'key' => 'COLOR',
                'value' => 'Black'
            ],
            [
                'key' => 'COLOR',
                'value' => 'White'
            ],
            [
                'key' => 'COLOR',
                'value' => 'Red'
            ],
            [
                'key' => 'COLOR',
                'value' => 'Blue'
            ],
            [
                'key' => 'COLOR',
                'value' => 'Green'
            ],
            [
                'key' => 'COLOR',
                'value' => 'Yellow'
            ],
            [
                'key' => 'COLOR',
                'value' => 'Orange'
            ],
            [
                'key' => 'COLOR',
                'value' => 'Purple'
            ],
            [
                'key' => 'COLOR',
                'value' => 'Pink'
            ],
            [
                'key' => 'COLOR',
                'value' => 'Brown'
            ],
            [
                'key' => 'COLOR',
                'value' => 'Grey'
            ],
            [
                'key' => 'COLOR',
                'value' => 'Silver'
            ],
            [
                'key' => 'COLOR',
                'value' => 'Gold'
            ],
            [
                'key' => 'COLOR',
                'value' => 'Copper'
            ],
            [
                'key' => 'COLOR',
                'value' => 'Bronze'
            ],
            [
                'key' => 'COLOR',
                'value' => 'Multi'
            ],
            [
                'key' => 'COLOR',
                'value' => 'Metallic'
            ],
            [
                'key' => 'COLOR',
                'value' => 'Cherry'
            ],
            [
                'key' => 'COLOR',
                'value' => 'Framboise'
            ],
            [
                'key' => 'COLOR',
                'value' => 'Beige'
            ],
            [
                'key' => 'COLOR',
                'value' => 'Cream'
            ],
            [
                'key' => 'SETTINGS',
                'value' => 'Living Room'
            ],
            [
                'key' => 'SETTINGS',
                'value' => 'Bedroom'
            ],
            [
                'key' => 'SETTINGS',
                'value' => 'Dining Room'
            ],
            [
                'key' => 'SETTINGS',
                'value' => 'Kitchen'
            ],
            [
                'key' => 'SETTINGS',
                'value' => 'Office'
            ],
            [
                'key' => 'DESIGNER',
                'value' => 'Gal Samari'
            ],
            [
                'key' => 'DESIGNER',
                'value' => 'Linda L. Smith'
            ],
            [
                'key' => 'DESIGNER',
                'value' => 'Jordan Peretz'
            ],
            [
                'key' => 'DESIGNER',
                'value' => 'Kendall Mahdavi'
            ],
            [
                'key' => 'DESIGNER',
                'value' => 'Ash Quintana'
            ],
            [
                'key' => 'DESIGNER',
                'value' => 'Hikaru Kubo-Kingsley'
            ],
            [
                'key' => 'DESIGNER',
                'value' => 'Kelly Sall'
            ],
            [
                'key' => 'DESIGNER',
                'value' => 'Skyler Xu'
            ],
            [
                'key' => 'DESIGNER',
                'value' => 'Kerry Lam'
            ],
            [
                'key' => 'DESIGNER',
                'value' => 'Jaime Ziya'
            ],
            [
                'key' => 'DESIGNER',
                'value' => 'Karen S. Smith'
            ],
            [
                'key' => 'DESIGNER',
                'value' => 'Paris Fotiou'
            ],
            [
                'key' => 'DESIGNER',
                'value' => 'Lee Szabo'
            ],
            [
                'key' => 'DESIGNER',
                'value' => 'Jac Argent'
            ],
            [
                'key' => 'MATERIAL',
                'value' => 'Leather'
            ],
            [
                'key' => 'MATERIAL',
                'value' => 'Metal'
            ],
            [
                'key' => 'MATERIAL',
                'value' => 'Dark Wood'
            ],
            [
                'key' => 'MATERIAL',
                'value' => 'Light Wood'
            ],
            [
                'key' => 'MATERIAL',
                'value' => 'Reclaimed Wood'
            ],
            [
                'key' => 'MATERIAL',
                'value' => 'Cotton'
            ],
            [
                'key' => 'MATERIAL',
                'value' => 'Silk'
            ],
            [
                'key' => 'MATERIAL',
                'value' => 'Wool'
            ],
            [
                'key' => 'MATERIAL',
                'value' => 'Viscose'
            ],
            [
                'key' => 'MATERIAL',
                'value' => 'Leather Cowhide'
            ],
            [
                'key' => 'MATERIAL',
                'value' => 'Indian Wool'
            ],
            [
                'key' => 'MATERIAL',
                'value' => 'Lacquered Ash'
            ],
            [
                'key' => 'MATERIAL',
                'value' => 'Linen Shade'
            ]
        ]);
    }
}
