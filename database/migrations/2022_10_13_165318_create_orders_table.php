<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable(); //Chính là username/phone bên USERS. Nếu khách đặt mua mà chưa Login => Không có giá trị
            $table->string('name'); // Tên người nhận.
            $table->string('phone'); // Số điện thoại
            $table->string('address'); // Địa chỉ nhận hàng.
            $table->integer('shipping_fee'); // Tiền ship
            $table->integer('sub_total'); // Tiền hàng
            $table->integer('total'); // Tổng tiền = shipping_fee + sub_total
            $table->string('status'); // Trạng thái: WAITING(Chờ xác nhận), DELIVERING(Đang giao), REJECT(Hủy đơn), DONE(Thành công)
            $table->string('reject_reason')->nullable(); // Lý do hủy đơn
            $table->string('note')->nullable(); // Ghi chú của Khách hàng.
            $table->string('method_payment')->nullable(); //Options làm thêm Phương thức chuyển khoảng: CASH(Tiển mặt), TRANSFER(Chuyển tiền)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
