<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldMetodeToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('metode', [0,1])->nullable()->comment('0 Kasir, 1 Transfer')->after('status');
            $table->string('name_rekening')->nullable()->after('metode');
            $table->string('no_rekening')->nullable()->after('name_rekening');
            $table->string('bank')->nullable()->after('no_rekening');
            $table->text('bukti_pembayaran')->nullable()->after('bank');
            $table->enum('konfirmasi_pembayaran', [0,1])->nullable()->comment('0 belum, 1 konfirmasi')->after('bukti_pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
