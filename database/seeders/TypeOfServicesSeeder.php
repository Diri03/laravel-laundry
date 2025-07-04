<?php

namespace Database\Seeders;

use App\Models\TypeOfServices;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeOfServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        TypeOfServices::insert([
            [
                'service_name' => 'Hanya Cuci',
                'price'=> 5000,
                'description'=> 'Service hanya cuci reguler'
            ],
            [
                'service_name' => 'Hanya Gosok',
                'price'=> 4500,
                'description'=> 'Service hanya gosok reguler'
            ],
            [
                'service_name' => 'Cuci dan Gosok',
                'price'=> 7000,
                'description'=> 'Service cuci dan gosok reguler'
            ],
            [
                'service_name' => 'Laundry Besar',
                'price'=> 10000,
                'description'=> 'Service laundry barang besar'
            ]
        ]);
    }
}
