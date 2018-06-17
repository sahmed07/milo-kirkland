<?php

use Illuminate\Database\Seeder;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'user_management_access',],
            ['id' => 2, 'title' => 'permission_access',],
            ['id' => 3, 'title' => 'permission_create',],
            ['id' => 4, 'title' => 'permission_edit',],
            ['id' => 5, 'title' => 'permission_view',],
            ['id' => 6, 'title' => 'permission_delete',],
            ['id' => 7, 'title' => 'role_access',],
            ['id' => 8, 'title' => 'role_create',],
            ['id' => 9, 'title' => 'role_edit',],
            ['id' => 10, 'title' => 'role_view',],
            ['id' => 11, 'title' => 'role_delete',],
            ['id' => 12, 'title' => 'user_access',],
            ['id' => 13, 'title' => 'user_create',],
            ['id' => 14, 'title' => 'user_edit',],
            ['id' => 15, 'title' => 'user_view',],
            ['id' => 16, 'title' => 'user_delete',],
            ['id' => 17, 'title' => 'pet_access',],
            ['id' => 18, 'title' => 'pet_edit',],
            ['id' => 19, 'title' => 'pet_view',],
            ['id' => 20, 'title' => 'pet_delete',],
            ['id' => 21, 'title' => 'pet_create',],
            ['id' => 23, 'title' => 'profile_access',],
            ['id' => 24, 'title' => 'profile_create',],
            ['id' => 25, 'title' => 'profile_edit',],
            ['id' => 26, 'title' => 'profile_view',],
            ['id' => 27, 'title' => 'profile_delete',],
            ['id' => 28, 'title' => 'pet_management_access',],
            ['id' => 29, 'title' => 'payment_access',],
            ['id' => 30, 'title' => 'payment_create',],
            ['id' => 31, 'title' => 'payment_edit',],
            ['id' => 32, 'title' => 'payment_view',],
            ['id' => 33, 'title' => 'payment_delete',],
            ['id' => 34, 'title' => 'user_action_access',],
            ['id' => 35, 'title' => 'user_action_create',],
            ['id' => 36, 'title' => 'user_action_edit',],
            ['id' => 37, 'title' => 'user_action_view',],
            ['id' => 38, 'title' => 'user_action_delete',],
            ['id' => 39, 'title' => 'faq_management_access',],
            ['id' => 40, 'title' => 'faq_management_create',],
            ['id' => 41, 'title' => 'faq_management_edit',],
            ['id' => 42, 'title' => 'faq_management_view',],
            ['id' => 43, 'title' => 'faq_management_delete',],
            ['id' => 44, 'title' => 'faq_category_access',],
            ['id' => 45, 'title' => 'faq_category_create',],
            ['id' => 46, 'title' => 'faq_category_edit',],
            ['id' => 47, 'title' => 'faq_category_view',],
            ['id' => 48, 'title' => 'faq_category_delete',],
            ['id' => 49, 'title' => 'faq_question_access',],
            ['id' => 50, 'title' => 'faq_question_create',],
            ['id' => 51, 'title' => 'faq_question_edit',],
            ['id' => 52, 'title' => 'faq_question_view',],
            ['id' => 53, 'title' => 'faq_question_delete',],
            ['id' => 54, 'title' => 'internal_notification_access',],
            ['id' => 55, 'title' => 'internal_notification_create',],
            ['id' => 56, 'title' => 'internal_notification_edit',],
            ['id' => 57, 'title' => 'internal_notification_view',],
            ['id' => 58, 'title' => 'internal_notification_delete',],
            ['id' => 59, 'title' => 'content_management_access',],
            ['id' => 60, 'title' => 'content_management_create',],
            ['id' => 61, 'title' => 'content_management_edit',],
            ['id' => 62, 'title' => 'content_management_view',],
            ['id' => 63, 'title' => 'content_management_delete',],
            ['id' => 64, 'title' => 'content_category_access',],
            ['id' => 65, 'title' => 'content_category_create',],
            ['id' => 66, 'title' => 'content_category_edit',],
            ['id' => 67, 'title' => 'content_category_view',],
            ['id' => 68, 'title' => 'content_category_delete',],
            ['id' => 69, 'title' => 'content_tag_access',],
            ['id' => 70, 'title' => 'content_tag_create',],
            ['id' => 71, 'title' => 'content_tag_edit',],
            ['id' => 72, 'title' => 'content_tag_view',],
            ['id' => 73, 'title' => 'content_tag_delete',],
            ['id' => 74, 'title' => 'content_page_access',],
            ['id' => 75, 'title' => 'content_page_create',],
            ['id' => 76, 'title' => 'content_page_edit',],
            ['id' => 77, 'title' => 'content_page_view',],
            ['id' => 78, 'title' => 'content_page_delete',],
            ['id' => 79, 'title' => 'city_access',],
            ['id' => 80, 'title' => 'city_create',],
            ['id' => 81, 'title' => 'city_edit',],
            ['id' => 82, 'title' => 'city_view',],
            ['id' => 83, 'title' => 'city_delete',],
            ['id' => 84, 'title' => 'city_management_access',],
            ['id' => 85, 'title' => 'breed_access',],
            ['id' => 86, 'title' => 'breed_create',],
            ['id' => 87, 'title' => 'breed_edit',],
            ['id' => 88, 'title' => 'breed_view',],
            ['id' => 89, 'title' => 'breed_delete',],
            ['id' => 90, 'title' => 'payments_rate_access',],
            ['id' => 91, 'title' => 'payments_rate_create',],
            ['id' => 92, 'title' => 'payments_rate_edit',],
            ['id' => 93, 'title' => 'payments_rate_view',],
            ['id' => 94, 'title' => 'payments_rate_delete',],

        ];

        foreach ($items as $item) {
            \App\Permission::create($item);
        }
    }
}
