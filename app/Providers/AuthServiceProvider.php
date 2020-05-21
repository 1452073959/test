<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Post;
use App\Policies\PostPolicy;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *应用的策略映射.
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
                Post::class => PostPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *注册任意认证/授权服务.
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
