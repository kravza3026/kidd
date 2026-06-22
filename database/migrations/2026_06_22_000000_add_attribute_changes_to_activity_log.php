<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private function table(): string
    {
        return config('activitylog.table_name', 'activity_log');
    }

    public function up(): void
    {
        Schema::table($this->table(), function (Blueprint $table) {
            if (! Schema::hasColumn($this->table(), 'attribute_changes')) {
                $table->json('attribute_changes')->nullable()->after('description');
            }
        });
    }

    public function down(): void
    {
        Schema::table($this->table(), function (Blueprint $table) {
            if (Schema::hasColumn($this->table(), 'attribute_changes')) {
                $table->dropColumn('attribute_changes');
            }
        });
    }
};
