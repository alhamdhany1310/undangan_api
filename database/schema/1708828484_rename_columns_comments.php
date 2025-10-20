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
        Schema::table('comments', function (Table $table) {
            if ($table->checkColumn('nama')) {
                $table->changeColumn(function ($table) {
                    $table ->string('name', 255)->nullable();
                });
            }
        });

        Schema::table('comments', function (Table $table) {
            if ($table->checkColumn('hadir')) {
                $table->changeColumn(function ($table) {
                    $table ->boolean('presence')->default(false);
                });
            }
        });

        Schema::table('comments', function (Table $table) {
            if ($table->checkColumn('komentar')) {
                $table->changeColumn(function ($table) {
                    $table ->text('comment')->nullable();
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
        Schema::table('comments', function (Table $table) {
            if ($table->checkColumn('name')) {
                $table->changeColumn(function ($table) {
                    $table ->string('nama', 255)->nullable();
                });
            }
        });

        Schema::table('comments', function (Table $table) {
            if ($table->checkColumn('presence')) {
                $table->changeColumn(function ($table) {
                    $table ->string('hadir', 10)->nullable();
                });
            }
        });

        Schema::table('comments', function (Table $table) {
            if ($table->checkColumn('comment')) {
                $table->changeColumn(function ($table) {
                    $table ->text('komentar')->nullable();
                });
            }
        });
    }
};
