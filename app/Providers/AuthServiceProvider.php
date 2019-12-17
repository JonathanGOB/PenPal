<?php

namespace App\Providers;

use App\Models\Chatroom;
use App\Models\Country;
use App\Models\Nationality;
use App\Models\Occupation;
use App\Models\Tag;
use App\Policies\ChatroomPolicy;
use App\Policies\CountryPolicy;
use App\Policies\NationalityPolicy;
use App\Policies\OccupationPolicy;
use App\Policies\TagPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
         Tag::class => TagPolicy::class,
         Occupation::class => OccupationPolicy::class,
         Country::class => CountryPolicy::class,
         Nationality::class => NationalityPolicy::class,
         Chatroom::class => ChatroomPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
    }
}
