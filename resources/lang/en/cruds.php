<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'profile_image'            => 'Profile Image',
            'profile_image_helper'     => ' ',
        ],
    ],
    'package' => [
        'title'          => 'Package',
        'title_singular' => 'Package',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'package_name'           => 'Package Name',
            'package_name_helper'    => ' ',
            'price_monthly'          => 'Price Monthly',
            'price_monthly_helper'   => ' ',
            'price_yearly'           => 'Price Yearly',
            'price_yearly_helper'    => ' ',
            'options'                => 'Options',
            'options_helper'         => ' ',
            'status'                 => 'Status',
            'status_helper'          => ' ',
            'yearly_discount'        => 'Yearly Discount',
            'yearly_discount_helper' => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
            'stripe_plan'            => 'Stripe Plan',
            'stripe_plan_helper'     => ' ',
            'scene_limit'            => 'Scene Limit',
            'scene_limit_helper'     => ' ',
            'item_limit'             => 'Item Limit',
            'item_limit_helper'      => ' ',
            'google_ads_free'        => 'Google Ads Free',
            'google_ads_free_helper' => ' ',
            'description'            => 'Description',
            'description_helper'     => ' ',
        ],
    ],

];
