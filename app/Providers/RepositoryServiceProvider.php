<?php
/**
 * Created by PhpStorm.
 * User: ПК
 * Date: 07.11.2020
 * Time: 12:14
 */

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(\App\Repository\BookRepositoryInterface::class,
            \App\Repository\BookRepository::class);

        $this->app->bind(\App\Repository\AuthorRepositoryInterface::class,
            \App\Repository\AuthorRepository::class);
    }
}