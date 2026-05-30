<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hasil_kepribadians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained()->onDelete('cascade');
            $table->integer('ipa')->default(0);
            $table->integer('ips')->default(0);
            $table->integer('tkj')->default(0);
            $table->integer('dkv')->default(0);
            $table->integer('akuntansi')->default(0);
            $table->integer('pondok_pesantren')->default(0);
            $table->string('hasil')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_kepribadians');
    }
};
