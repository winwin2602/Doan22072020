<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//user
        DB::table('permissions')->insert([
        	'name'=>'create_user',
        	'display_name'=>'Create user',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
        	'name'=>'edit_user',
        	'display_name'=>'Edit user',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
        	'name'=>'view_user',
        	'display_name'=>'View user',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
        	'name'=>'detail_user',
        	'display_name'=>'Detail user',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //brand
        DB::table('permissions')->insert([
        	'name'=>'create_brand',
        	'display_name'=>'Create brand',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
        	'name'=>'edit_brand',
        	'display_name'=>'Edit brand',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
        	'name'=>'view_brand',
        	'display_name'=>'View brand',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
        	'name'=>'detail_brand',
        	'display_name'=>'Detail brand',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //category
        DB::table('permissions')->insert([
        	'name'=>'create_category',
        	'display_name'=>'Create category',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
        	'name'=>'edit_category',
        	'display_name'=>'Edit category',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
        	'name'=>'view_category',
        	'display_name'=>'View category',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
        	'name'=>'detail_category',
        	'display_name'=>'Detail category',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //product
        DB::table('permissions')->insert([
        	'name'=>'create_product',
        	'display_name'=>'Create product',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
        	'name'=>'edit_product',
        	'display_name'=>'Edit product',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
        	'name'=>'view_product',
        	'display_name'=>'View product',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
        	'name'=>'detail_product',
        	'display_name'=>'Detail product',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //order
        DB::table('permissions')->insert([
        	'name'=>'create_order',
        	'display_name'=>'Create order',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
        	'name'=>'edit_order',
        	'display_name'=>'Edit order',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
        	'name'=>'view_order',
        	'display_name'=>'View order',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
        	'name'=>'detail_order',
        	'display_name'=>'Detail order',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //slide
        DB::table('permissions')->insert([
        	'name'=>'create_slide',
        	'display_name'=>'Create slide',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
        	'name'=>'edit_slide',
        	'display_name'=>'Edit slide',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
        	'name'=>'view_slide',
        	'display_name'=>'View slide',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
        	'name'=>'detail_slide',
        	'display_name'=>'Detail slide',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //role
        DB::table('permissions')->insert([
        	'name'=>'create_role',
        	'display_name'=>'Create role',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
        	'name'=>'edit_role',
        	'display_name'=>'Edit role',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
        	'name'=>'view_role',
        	'display_name'=>'View role',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('permissions')->insert([
        	'name'=>'detail_role',
        	'display_name'=>'Detail role',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
