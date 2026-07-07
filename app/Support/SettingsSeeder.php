<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;

/**
 * Seeds default spatie-settings rows with a single, JSON-cast insert.
 *
 * The spatie migrator writes one exists()+insert per property; batched in a migration
 * transaction, the second bound statement aborts the connection on some local Postgres
 * setups (pooler + server-side prepared statements). A single cast insert avoids it.
 */
class SettingsSeeder
{
    /**
     * @param  array<string, mixed>  $values  name => value (stored JSON-encoded)
     */
    public static function seed(string $group, array $values): void
    {
        if ($values === []) {
            return;
        }

        $now = now();
        $placeholders = [];
        $bindings = [];

        foreach ($values as $name => $value) {
            $placeholders[] = '(?, ?, ?::json, ?, ?, ?)';
            array_push($bindings, $group, $name, json_encode($value), false, $now, $now);
        }

        $table = DB::getTablePrefix().'settings';

        DB::statement(
            'insert into "'.$table.'" ("group", "name", "payload", "locked", "created_at", "updated_at") values '.implode(', ', $placeholders),
            $bindings,
        );
    }
}
