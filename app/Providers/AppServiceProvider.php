<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//brand
use App\Repositories\Brand\BrandInterface;
use App\Repositories\Brand\BrandRepository;
//slide
use App\Repositories\Slide\SlideInterface;
use App\Repositories\Slide\SlideRepository;
//category
use App\Repositories\Category\CategoryInterface;
use App\Repositories\Category\CategoryRepository;
//product
use App\Repositories\Product\ProductInterface;
use App\Repositories\Product\ProductRepository;
//user
use App\Repositories\User\UserInterface;
use App\Repositories\User\UserRepository;
//role
use App\Repositories\Role\RoleInterface;
use App\Repositories\Role\RoleRepository;
//permission
use App\Repositories\Permission\PermissionInterface;
use App\Repositories\Permission\PermissionRepository;
//permission role
use App\Repositories\PermissionRole\PermissionRoleInterface;
use App\Repositories\PermissionRole\PermissionRoleRepository;
//role user
use App\Repositories\RoleUser\RoleUserInterface;
use App\Repositories\RoleUser\RoleUserRepository;
//order
use App\Repositories\Order\OrderInterface;
use App\Repositories\Order\OrderRepository;
//customer
use App\Repositories\Customer\CustomerInterface;
use App\Repositories\Customer\CustomerRepository;
//order detail
use App\Repositories\OrderDetail\OrderDetailInterface;
use App\Repositories\OrderDetail\OrderDetailRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            BrandInterface::class,
            BrandRepository::class
        );
		$this->app->bind(
            SlideInterface::class,
            SlideRepository::class
        );
        $this->app->bind(
            CategoryInterface::class,
            CategoryRepository::class
        );
        $this->app->bind(
            ProductInterface::class,
            ProductRepository::class
		);
        $this->app->bind(
            UserInterface::class,
            UserRepository::class
        );
        $this->app->bind(
            RoleInterface::class,
            RoleRepository::class
        );
        $this->app->bind(
            PermissionInterface::class,
            PermissionRepository::class
        );
        $this->app->bind(
            PermissionRoleInterface::class,
            PermissionRoleRepository::class
        );
        $this->app->bind(
            RoleUserInterface::class,
            RoleUserRepository::class
        );
        $this->app->bind(
            OrderInterface::class,
            OrderRepository::class
        );
        $this->app->bind(
            CustomerInterface::class,
            CustomerRepository::class
        );
        $this->app->bind(
            OrderDetailInterface::class,
            OrderDetailRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
