<?php

namespace Database\Seeders;

use App\Models\ClassLevel;
use Illuminate\Database\Seeder;

class SchoolStructureSeeder extends Seeder
{
    public function run(): void
    {
        $structure = [
            'Baby Class' => [
                'code' => 'BABY',
                'order' => 1,
                'sections' => ['General'],
            ],
            'Nursery 1' => [
                'code' => 'NUR1',
                'order' => 2,
                'sections' => ['Green', 'Blue', 'White'],
            ],
            'Nursery 2' => [
                'code' => 'NUR2',
                'order' => 3,
                'sections' => ['Green', 'Blue', 'White'],
            ],
            'Nursery 3' => [
                'code' => 'NUR3',
                'order' => 4,
                'sections' => ['Green', 'Blue', 'White'],
            ],
            'Primary 1' => [
                'code' => 'PRI1',
                'order' => 5,
                'sections' => ['Green', 'Blue', 'White'],
            ],
            'Primary 2' => [
                'code' => 'PRI2',
                'order' => 6,
                'sections' => ['Green', 'Blue', 'White'],
            ],
            'Primary 3' => [
                'code' => 'PRI3',
                'order' => 7,
                'sections' => ['Green', 'Blue', 'White'],
            ],
            'Primary 4' => [
                'code' => 'PRI4',
                'order' => 8,
                'sections' => ['Green', 'Blue', 'White'],
            ],
            'Primary 5' => [
                'code' => 'PRI5',
                'order' => 9,
                'sections' => ['Green', 'Blue', 'White'],
            ],
            'Primary 6' => [
                'code' => 'PRI6',
                'order' => 10,
                'sections' => ['Green', 'Blue', 'White'],
            ],
        ];

        foreach ($structure as $name => $details) {
            $classLevel = ClassLevel::updateOrCreate(
                ['code' => $details['code']],
                [
                    'name' => $name,
                    'sort_order' => $details['order'],
                    'is_active' => true,
                ]
            );

            foreach ($details['sections'] as $sectionName) {
                $classLevel->sections()->firstOrCreate(
                    ['name' => $sectionName],
                    ['is_active' => true]
                );
            }
        }
    }
}
