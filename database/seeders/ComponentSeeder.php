<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema; // <-- ¡Añade esta línea!

class ComponentSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        // Limpiamos las tablas antes de insertar
        DB::table('processors')->truncate();
        DB::table('motherboards')->truncate();
        DB::table('ram_modules')->truncate();
        DB::table('ssds')->truncate();
        DB::table('assemblies')->truncate(); // <-- También es buena idea limpiar esta
        DB::table('test_results')->truncate(); // <-- Y esta

        Schema::enableForeignKeyConstraints();

        // 1. Insertar Procesadores
        DB::table('processors')->insert([
            ['name' => 'Core i5-13600K', 'brand' => 'Intel', 'cores' => 14, 'clock_speed_ghz' => 3.50, 'stock' => 55],
            ['name' => 'Core i7-13700K', 'brand' => 'Intel', 'cores' => 16, 'clock_speed_ghz' => 3.40, 'stock' => 40],
            ['name' => 'Core i9-13900K', 'brand' => 'Intel', 'cores' => 24, 'clock_speed_ghz' => 3.00, 'stock' => 25],
            ['name' => 'Ryzen 5 7600X', 'brand' => 'AMD', 'cores' => 6, 'clock_speed_ghz' => 4.70, 'stock' => 60],
            ['name' => 'Ryzen 7 7700X', 'brand' => 'AMD', 'cores' => 8, 'clock_speed_ghz' => 4.50, 'stock' => 45],
            ['name' => 'Ryzen 9 7950X', 'brand' => 'AMD', 'cores' => 16, 'clock_speed_ghz' => 4.50, 'stock' => 30],
            ['name' => 'Ryzen 5 5600G', 'brand' => 'AMD', 'cores' => 6, 'clock_speed_ghz' => 3.90, 'stock' => 90],
            ['name' => 'Core i5-12400F', 'brand' => 'Intel', 'cores' => 6, 'clock_speed_ghz' => 2.50, 'stock' => 110],
            ['name' => 'Ryzen 7 5800X3D', 'brand' => 'AMD', 'cores' => 8, 'clock_speed_ghz' => 3.40, 'stock' => 35],
            ['name' => 'Core i3-12100F', 'brand' => 'Intel', 'cores' => 4, 'clock_speed_ghz' => 3.30, 'stock' => 80],
        ]);

        // 2. Insertar Placas Madre
        DB::table('motherboards')->insert([
            ['name' => 'ASUS ROG STRIX Z790-E GAMING', 'form_factor' => 'ATX', 'chipset' => 'Intel Z790', 'stock' => 30],
            ['name' => 'MSI MPG B650 CARBON WIFI', 'form_factor' => 'ATX', 'chipset' => 'AMD B650', 'stock' => 45],
            ['name' => 'Gigabyte Z790 AORUS ELITE AX', 'form_factor' => 'ATX', 'chipset' => 'Intel Z790', 'stock' => 40],
            ['name' => 'ASRock B650M PG RIPTIDE', 'form_factor' => 'Micro-ATX', 'chipset' => 'AMD B650', 'stock' => 60],
            ['name' => 'ASUS TUF GAMING B550-PLUS', 'form_factor' => 'ATX', 'chipset' => 'AMD B550', 'stock' => 80],
            ['name' => 'MSI PRO B660M-A WIFI DDR4', 'form_factor' => 'Micro-ATX', 'chipset' => 'Intel B660', 'stock' => 95],
            ['name' => 'Gigabyte B550 AORUS PRO AC', 'form_factor' => 'ATX', 'chipset' => 'AMD B550', 'stock' => 55],
            ['name' => 'ASRock X670E Steel Legend', 'form_factor' => 'ATX', 'chipset' => 'AMD X670', 'stock' => 25],
            ['name' => 'ASUS Prime Z790-P WIFI', 'form_factor' => 'ATX', 'chipset' => 'Intel Z790', 'stock' => 70],
            ['name' => 'MSI MAG B760 TOMAHAWK WIFI', 'form_factor' => 'ATX', 'chipset' => 'Intel B760', 'stock' => 50],
        ]);

        // 3. Insertar Memorias RAM
        DB::table('ram_modules')->insert([
            ['name' => 'Corsair Vengeance DDR5 32GB Kit', 'type' => 'DDR5', 'capacity_gb' => 32, 'speed_mhz' => 5600, 'stock' => 70],
            ['name' => 'G.Skill Trident Z5 RGB 32GB Kit', 'type' => 'DDR5', 'capacity_gb' => 32, 'speed_mhz' => 6000, 'stock' => 60],
            ['name' => 'Kingston FURY Beast 16GB', 'type' => 'DDR5', 'capacity_gb' => 16, 'speed_mhz' => 5200, 'stock' => 90],
            ['name' => 'Corsair Vengeance LPX 16GB Kit', 'type' => 'DDR4', 'capacity_gb' => 16, 'speed_mhz' => 3200, 'stock' => 150],
            ['name' => 'G.Skill Ripjaws V 16GB Kit', 'type' => 'DDR4', 'capacity_gb' => 16, 'speed_mhz' => 3600, 'stock' => 120],
            ['name' => 'Kingston FURY Renegade 64GB Kit', 'type' => 'DDR5', 'capacity_gb' => 64, 'speed_mhz' => 6400, 'stock' => 30],
            ['name' => 'TeamGroup T-Force Delta RGB 32GB', 'type' => 'DDR5', 'capacity_gb' => 32, 'speed_mhz' => 6000, 'stock' => 75],
            ['name' => 'Crucial Ballistix 32GB Kit', 'type' => 'DDR4', 'capacity_gb' => 32, 'speed_mhz' => 3200, 'stock' => 100],
            ['name' => 'Patriot Viper Steel 16GB', 'type' => 'DDR4', 'capacity_gb' => 16, 'speed_mhz' => 4400, 'stock' => 50],
            ['name' => 'Crucial Pro 32GB Kit', 'type' => 'DDR5', 'capacity_gb' => 32, 'speed_mhz' => 5600, 'stock' => 85],
        ]);

        // 4. Insertar Discos SSD
        DB::table('ssds')->insert([
            ['name' => 'Samsung 980 Pro 1TB', 'interface' => 'NVMe 4.0', 'capacity_gb' => 1000, 'read_speed_mbps' => 7000, 'write_speed_mbps' => 5000, 'stock' => 60],
            ['name' => 'WD Black SN850X 1TB', 'interface' => 'NVMe 4.0', 'capacity_gb' => 1000, 'read_speed_mbps' => 7300, 'write_speed_mbps' => 6300, 'stock' => 50],
            ['name' => 'Crucial P3 Plus 1TB', 'interface' => 'NVMe 4.0', 'capacity_gb' => 1000, 'read_speed_mbps' => 5000, 'write_speed_mbps' => 3600, 'stock' => 80],
            ['name' => 'Samsung 970 Evo Plus 1TB', 'interface' => 'NVMe 3.0', 'capacity_gb' => 1000, 'read_speed_mbps' => 3500, 'write_speed_mbps' => 3300, 'stock' => 90],
            ['name' => 'Kingston NV2 1TB', 'interface' => 'NVMe 4.0', 'capacity_gb' => 1000, 'read_speed_mbps' => 3500, 'write_speed_mbps' => 2100, 'stock' => 120],
            ['name' => 'Samsung 870 Evo 500GB', 'interface' => 'SATA III', 'capacity_gb' => 500, 'read_speed_mbps' => 560, 'write_speed_mbps' => 530, 'stock' => 150],
            ['name' => 'Crucial MX500 1TB', 'interface' => 'SATA III', 'capacity_gb' => 1000, 'read_speed_mbps' => 560, 'write_speed_mbps' => 510, 'stock' => 130],
            ['name' => 'WD Blue SA510 500GB', 'interface' => 'SATA III', 'capacity_gb' => 500, 'read_speed_mbps' => 560, 'write_speed_mbps' => 510, 'stock' => 160],
            ['name' => 'Seagate FireCuda 530 2TB', 'interface' => 'NVMe 4.0', 'capacity_gb' => 2000, 'read_speed_mbps' => 7300, 'write_speed_mbps' => 6900, 'stock' => 40],
            ['name' => 'Samsung 990 Pro 2TB', 'interface' => 'NVMe 4.0', 'capacity_gb' => 2000, 'read_speed_mbps' => 7450, 'write_speed_mbps' => 6900, 'stock' => 35],
        ]);
    }
}