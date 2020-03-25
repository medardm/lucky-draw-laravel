<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Prize;

class CreatePrizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prizes', function (Blueprint $table) {
            $table->id();
            $table->text('prize');
            $table->integer('num_of_winners')->default(1);
            $table->timestamps();
        });

        Schema::create('prize_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->unsignedBigInteger('prize_id');
            $table->foreign('prize_id')
                ->references('id')
                ->on('prizes');
            $table->unsignedBigInteger('draw_ticket_id');
            $table->foreign('draw_ticket_id')
                ->references('id')
                ->on('draw_tickets')
                ->onDelete('cascade');
            $table->timestamps();
        });

        // Default prizes
        $prizes = [
            [
                'prize' => 'Grand Prize'
            ],
            [
                'prize' => 'Second Prize',
                'num_of_winners' => 2
            ],
            [
                'prize' => 'Third Prize',
                'num_of_winners' => 3
            ]
        ];
        foreach ($prizes as $prize) {
            Prize::firstOrCreate($prize);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prizes');
        Schema::dropIfExists('prize_user');
    }
}
