<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class StateService
{
    public function addMigrateState(int $id, string $name): void
    {
        $state = DB::table('states')
            ->where('id', $id)
            ->first();
        if ($state) {
            DB::table('states')
                ->where('id', $id)
                ->update([
                    'name' => $name,
                    'updated_at' => now()->toDateTimeString(),
                ]);
        } else {
            DB::table('states')
                ->insert([
                    'id' => $id,
                    'name' => $name,
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString(),
                ]);
        }
    }
}
