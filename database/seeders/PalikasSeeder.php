<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use League\Csv\Reader;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PalikasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Define the path to your CSV file containing all palikas data.
        $csvPath = database_path('data/palikas.csv');

        if (!file_exists($csvPath)) {
            $this->command->error("CSV file not found at: $csvPath");
            return;
        }

        // Read CSV file using League\Csv (make sure to install league/csv via composer)
        $csv = Reader::createFromPath($csvPath, 'r');
        $csv->setHeaderOffset(0); // Assumes the first row contains headers

        // Get CSV records as an iterator
        $records = $csv->getRecords();

        foreach ($records as $record) {
            // Get details from each CSV record
            $districtName = trim($record['district_name']);
            $palikaName   = trim($record['palika_name']);
            $population   = (int) $record['population'];
            $totalArea    = (float) $record['total_area'];

            // Fetch the corresponding district from the database
            $district = DB::table('districts')->where('name', $districtName)->first();

            if (!$district) {
                // If the district is not found, log a warning and skip this record.
                $this->command->warn("District '{$districtName}' not found. Skipping palika '{$palikaName}'.");
                continue;
            }

            // Insert the palika record into the database
            DB::table('palikas')->insert([
                'name'        => $palikaName,
                'slug'        => Str::slug($palikaName),
                'district_id' => $district->id,
                'population'  => $population,
                'total_area'  => $totalArea,
                'status'      => 'active',
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
