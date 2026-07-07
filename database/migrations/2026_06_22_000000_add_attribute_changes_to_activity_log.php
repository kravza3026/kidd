<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * activitylog v5 stores tracked changes in an `attribute_changes` column (cast to a
     * collection on the Activity model), but the published create migration predates it.
     *
     * Uses Postgres' native idempotent DDL instead of Schema::hasColumn(): on some local
     * databases the column-introspection query Schema::hasColumn runs inside the migration
     * transaction aborts that transaction, which made the plain Schema::table() form fail.
     */
    public function up(): void
    {
        DB::statement('alter table "'.$this->table().'" add column if not exists attribute_changes json null');
    }

    public function down(): void
    {
        DB::statement('alter table "'.$this->table().'" drop column if exists attribute_changes');
    }

    private function table(): string
    {
        return DB::getTablePrefix().config('activitylog.table_name', 'activity_log');
    }
};
