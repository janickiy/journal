<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->truncate();

        DB::table('permissions')->insert([
              ['id' => '1', 'name' => 'manage_user', 'display_name' => 'Управление пользователями', 'description' => 'Управление пользователями'],
              ['id' => '2', 'name' => 'add_user', 'display_name' => 'Добавить пользователя', 'description' => 'Добавить пользователя'],
              ['id' => '3', 'name' => 'edit_user', 'display_name' => 'Редактировать пользователя', 'description' => 'Редактировать пользователя'],
              ['id' => '4', 'name' => 'delete_user', 'display_name' => 'Удалить пользователя', 'description' => 'Удалить пользователя'],
              ['id' => '5', 'name' => 'manage_role', 'display_name' => 'Управление ролями', 'description' => 'Управление ролями'],
              ['id' => '6', 'name' => 'add_role', 'display_name' => 'Добавить роль', 'description' => 'Добавить рольe'],
              ['id' => '7', 'name' => 'edit_role', 'display_name' => 'Изменить роль', 'description' => 'Изменить роль'],
              ['id' => '8', 'name' => 'delete_role', 'display_name' => 'Удалить роль', 'description' => 'Удалить роль'],
              ['id' => '9', 'name' => 'manage_cards', 'display_name' => 'Управление картами', 'description' => 'Управление картами'],
              ['id' => '10', 'name' => 'add_card', 'display_name' => 'Добавлять бонусную карты', 'description' => 'Добавлять бонусную карты'],
              ['id' => '11', 'name' => 'edit_card', 'display_name' => 'Редактировать бонусную карты', 'description' => 'Редактировать бонусную карты'],
              ['id' => '12', 'name' => 'delete_card', 'display_name' => 'Удалять бонусную карты', 'description' => 'Удалять бонусную карты']
        ]);
    }
}
