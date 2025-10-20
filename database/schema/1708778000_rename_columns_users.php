<?php

use Core\Database\Migration;
use Core\Database\Schema;
use Core\Database\Table;

return new class implements Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Table $table) {
            if ($table->checkColumn('nama')) {
                $table->changeColumn(function ($table) {
                    $table ->string('name', 50)->nullable();
                });
            }
        });
    }

    /**
     * Kembalikan seperti semula.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Table $table) {
            if ($table->checkColumn('name')) {
                $table->changeColumn(function ($table) {
                    $table ->string('nama', 50)->nullable();
                });
            }
        });
    }
};
