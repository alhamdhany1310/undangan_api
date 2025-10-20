<?php

use Core\Database\Migration;
use Core\Database\Schema;
use Core\Database\Table;
use Core\Database\DB; // tambahkan ini jika class DB tersedia

return new class implements Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('likes', function (Table $table) {

            // Tambahkan kolom user_id jika belum ada
            if ($table->checkColumn('user_id') === false) {
                $table->addColumn(function (Table $table) {
                    $table->integer('user_id')->nullable();
                });
            }
        });

        // Tambahkan foreign key dengan SQL manual
        try {
            DB::statement('ALTER TABLE likes ADD CONSTRAINT FK_likes_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE');
        } catch (\Throwable $e) {
            // Jika constraint sudah ada, abaikan
            // error_log($e->getMessage());
        }
    }

    /**
     * Kembalikan seperti semula.
     *
     * @return void
     */
    public function down()
    {
        // Hapus constraint & kolom dengan SQL manual juga
        try {
            DB::statement('ALTER TABLE likes DROP FOREIGN KEY FK_likes_user_id');
        } catch (\Throwable $e) {
            // Abaikan jika belum ada
        }

        Schema::table('likes', function (Table $table) {
            if ($table->checkColumn('user_id')) {
                $table->dropColumn('user_id');
            }
        });
    }
};
