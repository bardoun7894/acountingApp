<?php

namespace Database\Seeders;

use App\Models\AccountSetting;
use Illuminate\Database\Seeder;

class AccountSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $data=[
          ["id"=>1,"account_head_id"=>4,"account_control_id"=>10,"account_sub_control_id"=>39,"account_activity_id"=>6,"branch_id"=>1,"created_at"=>"2022-02-07 13:51:13","updated_at"=> "2022-02-10 22:26:27"],
          ["id"=>2,"account_head_id"=>3,"account_control_id"=>6,"account_sub_control_id"=>25,"account_activity_id"=>1,"branch_id"=>1,"created_at"=>"2022-02-07 13:51:58","updated_at"=> "2022-02-10 22:28:24"],
          ["id"=>3,"account_head_id"=>4,"account_control_id"=>8,"account_sub_control_id"=>31,"account_activity_id"=>4,"branch_id"=>1,"created_at"=>"2022-02-07 13:55:51","updated_at"=> "2022-02-10 22:31:37"],
          ["id"=>4,"account_head_id"=>3,"account_control_id"=>6,"account_sub_control_id"=>24,"account_activity_id"=>2,"branch_id"=>1,"created_at"=>"2022-02-07 13:58:13","updated_at"=> "2022-02-07 14:00:02"],
          ["id"=>6,"account_head_id"=>4,"account_control_id"=>8,"account_sub_control_id"=>29,"account_activity_id"=>3,"branch_id"=>1,"created_at"=>"2022-02-07 14:57:54","updated_at"=> "2022-02-10 22:32:25"],
          ["id"=>7,"account_head_id"=>4,"account_control_id"=>10,"account_sub_control_id"=>36,"account_activity_id"=>5,"branch_id"=>1,"created_at"=>"2022-02-10 22:33:53","updated_at"=> "2022-02-10 22:33:53"],
          ["id"=>8,"account_head_id"=>2,"account_control_id"=>4,"account_sub_control_id"=>18,"account_activity_id"=>8,"branch_id"=>1,"created_at"=>"2022-02-11 11:51:15","updated_at"=> "2022-02-11 11:51:15"],
          ["id"=>9,"account_head_id"=>1,"account_control_id"=>1,"account_sub_control_id"=>2,"account_activity_id"=>9,"branch_id"=>1,"created_at"=>"2022-02-11 11:52:56","updated_at"=> "2022-02-11 11:52:56"],
          ["id"=>10,"account_head_id"=>1,"account_control_id"=>1,"account_sub_control_id"=>1,"account_activity_id"=>9,"branch_id"=>1,"created_at"=>"2022-02-11 11:52:56","updated_at"=> "2022-02-11 11:52:56"]
         ];
   AccountSetting::insert($data);
    }
}
