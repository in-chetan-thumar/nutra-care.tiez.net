<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Hashing\BcryptHasher as Hasher;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        \App\Models\News::creating(function ($object) {
            $object->created_by = \Auth::user()->id;
        });

        \App\Models\News::updating(function ($object) {
            $object->updated_by = \Auth::user()->id;
        });

        \App\Models\NewsCategory::creating(function ($object) {
            $object->created_by = \Auth::user()->id;
        });
        \App\Models\NewsCategory::updating(function ($object) {
            $object->updated_by = \Auth::user()->id;
        });

        \App\Models\Notification::creating(function ($object) {
            $object->created_by = \Auth::user()->id;
        });

        \App\Models\Notification::creating(function ($object) {
            $object->created_by = \Auth::user()->id;
        });

        //Validate current password
        \Validator::extend('match_current_password', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, auth()->user()->password);
        },__('messages.Current password does not match with existing password.'));

        //Validate captcha
        \Validator::extend('is_valid_captcha', function($attribute, $value, $parameters, $validator){

            if (!\Session::has('captcha')) {
                return false;
            }

            $key = \Session::get('captcha.key');
            $sensitive = \Session::get('captcha.sensitive');

            if (!$sensitive) {
                $value = Str::lower($value);
            }
            $hasher = new Hasher();
            $check = $hasher->check($value, $key);

            return $check;
        });

        //Share languages data
        \View::share('confirm_delete', __('messages.confirm_delete'));
        \View::share('dont_revert_deleted_record', __('messages.dont_revert_deleted_record'));
        \View::share('record_not_found', __('messages.record_not_found'));
        \View::share('please_wait', __('messages.please_wait'));

        Paginator::defaultView('vendor.pagination.bootstrap-4');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
