<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DefaultValuesUserTableRemovePassword extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        $customers = \App\User::all();
        foreach ($customers as $customer) {
            $customer->auth()
                     ->save(\App\Authenticable::make([
                                                         'email'      => $customer->email,
                                                         'password'   => $customer->password,
                                                         'created_at' => $customer->created_at,
                                                         'updated_at' => $customer->updated_at,
                                                         'active'     => 1
                                                     ]));
        }

        $admins = \App\Employee::all();
        foreach ($admins as $admin) {
            $admin->auth()
                  ->save(\App\Authenticable::make([
                                                      'email'      => $admin->email,
                                                      'password'   => $admin->password,
                                                      'created_at' => $customer->created_at,
                                                      'updated_at' => $customer->updated_at,
                                                      'active'     => $admin->active
                                                  ]));
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('password');
            $table->dropColumn('remember_token');
            $table->string('vat_number', 20)
                  ->nullable()
                  ->change();
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('password');
            $table->dropColumn('active');
            $table->dropColumn('remember_token');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password');
            $table->string('remember_token');
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->string('password');
            $table->string('remember_token');
            $table->string('active');
        });

        $authenticables = \App\Authenticable::all();

        foreach ($authenticables as $authenticable) {
            $authenticable->authenticable->password = $authenticable->password;

            if (!is_null($authenticable->remember_token)) {
                $authenticable->authenticable->remember_token = $authenticable->remember_token;
            }

            if ($authenticable->authenticable instanceof \App\Employee) {
                $authenticable->authenticable->active = $authenticable->active;
            }

            $authenticable->authenticable->save();
        }
    }
}
