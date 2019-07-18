<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->unique();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('full_name');
            $table->enum('gender', ['M', 'F', 'O']);
            $table->date('dob')->nullable();
            $table->string('photo')->nullable();
            $table->string('pancard')->nullable();
            $table->string('addr_line1')->nullable();
            $table->string('addr_line2')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode')->nullable();
            $table->string('phone_number')->nullable();
            $table->tinyInteger('user_role')->default(0);
            $table->ipAddress('last_login_ip')->nullable();

            $table->string('preferred_payment_method')->nullable();
            $table->string('paytm_number')->nullable();
            $table->string('phonepe_id')->nullable();
            $table->string('upi_id')->nullable();
            $table->string('bank_account_holdername')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_account_bankname')->nullable();
            $table->string('bank_account_type')->nullable();
            $table->string('bank_account_ifsc')->nullable();

            $table->unsignedBigInteger('referral_user_id')->nullable();                      // Matrix Plan Referral Id
            $table->unsignedBigInteger('referral_user_id_autofill')->nullable();             // Autofill Plan Referral Id
            $table->boolean('is_banned')->default(false);
            $table->boolean('is_protected')->default(false);
            $table->boolean('is_profile_completed')->default(false);
            $table->tinyInteger('status')->default(0);           // 0-inactive 1-active
            $table->integer('total_referrals')->default(0);
            $table->integer('total_referrals_autofill')->default(0);

            $table->integer('total_registration_task_pending')->default(10);
            $table->integer('total_task_pending')->default(40);
            $table->integer('total_apps_downloaded')->default(0);
            $table->integer('total_adv_seen')->default(0);
            $table->integer('total_videos_seen')->default(0);

            $table->double('total_income')->default(0);
            $table->double('wallet_one')->default(0);
            $table->double('wallet_two')->default(0);
            // Wallet 3 in Wallet System

            $table->dateTime('payment_applied_at')->nullable();
            $table->double('payment_amount')->default(149);
            $table->string('payment_screenshot')->nullable();
            $table->string('payment_method')->nullable();
            $table->tinyInteger('payment_confirmed')->default(-1); // -1 not applied , 0 - applied and pending , 1 - approved
            $table->dateTime('activated_at')->nullable();

            $table->string('aadhaarid')->nullable();
            $table->string('pancard_photo')->nullable();
            $table->string('aadhaar_photo')->nullable();
            $table->string('bank_account_photo')->nullable();
            $table->smallInteger('is_kyc')->default(-1);
            $table->dateTime('kyc_request_at')->nullable();
            $table->dateTime('kyc_approved_at')->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('referral_user_id')->references('id')->on('users');
            $table->foreign('referral_user_id_autofill')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
