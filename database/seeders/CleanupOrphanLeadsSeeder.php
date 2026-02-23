<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CleanupOrphanLeadsSeeder extends Seeder
{
    public function run()
    {
        // Delete leads where person_id is null or does not exist in persons table
        DB::table('leads')
            ->whereNull('person_id')
            ->orWhereNotIn('person_id', function ($query) {
                $query->select('id')->from('persons');
            })
            ->delete();
    }
}
