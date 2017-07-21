<?php

namespace KilroyWeb\Coordinates\Seeds;

use Illuminate\Database\Seeder;

class CoordinatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filePath = __DIR__.'/../SampleData/zipcodes/US.txt';
        $file = file_get_contents($filePath);
        $lines = preg_split ('/$\R?^/m', $file);
        foreach($lines as $line){
            $this->createZipcodeFromString($line);
        }
    }

    private function createZipcodeFromString($string){
        $columns = $this->getColumnsFromTabDelimitedString($string);
        if(count($columns) == 12){
            $zipcode = $columns[1];
            $existingCoordinate = \KilroyWeb\Coordinates\Models\Coordinate::where('zipcode',$zipcode)->first();
            if(!$existingCoordinate){
                $coordinate = \KilroyWeb\Coordinates\Models\Coordinate::create([
                    'city' => $columns[2],
                    'state' => $columns[4],
                    'zipcode' => $zipcode,
                    'county' => $columns[5],
                    'latitude' => $columns[9],
                    'longitude' => $columns[10],
                ]);
            }
            dump('Seeding: '.$zipcode);
        }
    }

    private function getColumnsFromTabDelimitedString($string){
        $columns = explode("\t",$string);
        return $columns;
    }
}
