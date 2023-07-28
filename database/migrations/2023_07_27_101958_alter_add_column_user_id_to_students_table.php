<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddColumnUserIdToStudentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    private $table = 'students';
    private $column = 'user_id';
    public function up(): void
    {
        if (!Schema::hasColumn($this->table, $this->column)) {
            Schema::table($this->table, function (Blueprint $table) {
                // phải có nullable
                $table->foreignId($this->column)->nullable()->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
                // $table->unsignedBigInteger($this->column)->nullable();
                // $table->foreign($this->column)->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            
            });

        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn($this->table, $this->column)) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropForeign([$this->column]);
                $table->dropColumn($this->column);

            });

        }
    }
};
