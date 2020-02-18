Wordpress Laravel Eloquent Models
===========================

<p align="center">
<img src="http://drewjbartlett.com/images/github/logo-laravel.svg">
<img src="http://drewjbartlett.com/images/github/wordpress-logo.png">
</p>

A library that converts converts wordpress tables into [Laravel Eloquent Models](https://laravel.com/docs/5.4/eloquent). This is can be helpful for any wordpress project where maybe you'd rather use the awesome features of Laravel's Eloquent.

Or maybe you're building a project using Laravel and Roots Bedrock/Sage/etc and want to access WordPress data within Laravel. Or maybe you're writing an API with something like [Slim](https://www.slimframework.com/) or better yet [Lumen](https://lumen.laravel.com/) don't want to increase your load time by loading the entire WP core.

This is a great boiler plate based off [Eloquent](https://laravel.com/docs/5.4/eloquent) by Laravel to get you going.

*Note:* This is documentation for additional functionality on top of Eloquent. For documentation on all of Eloquent's features you visit the [documentation](https://laravel.com/docs/5.4/eloquent).

# Overview
 - [Installation](#installing-wpeloquent)
 - [Setup](#setup---common)
 - [Setup with Laravel](#setup-with-laravel)
 - [Posts](#posts)
 - [Comments](#comments)
 - [Terms](#terms)
 - [Users](#users)
 - [Meta](#meta)
 - [Options](#options)
 - [Links](#links)
 - [Extending your own models](#extending-your-own-models)
 - [Query Logs](#query-logs)

## Installing WPEloquent

The recommended way to install WPEloquent is through
[Composer](https://getcomposer.org/).

```bash
composer require mallardduck/wp-eloquent-models
```

## Version Guidance

| Version     | Status     | Packagist     | Namespace     | Repo     | illuminate/database     | PHP Version     |
|-------------|------------|---------------|---------------|----------|-------------------------|-----------------|
| v0.2.1    | Upstream | `drewjbartlett/wordpress-eloquent` | `WPEloquent` | [v0.2.1][upstream-latest-repo] | `5.4.*`    | `>= 5.6.4`      |
| 0.3.x    | Maintained | `mallardduck/wp-eloquent-models` | `WPEloquent` | [0.3.0][wpeloquent-0.3.0]  | `5.5`   | `>= 7.1`      |

[upstream-latest-repo]: https://github.com/drewjbartlett/wordpress-eloquent/tree/v0.2.1
[wpeloquent-0.3.0]: https://github.com/mallardduck/wp-eloquent-models/tree/v0.3.0

## Setup - Common

```php
require_once('vendor/autoload.php');

\WPEloquent\Core\Laravel::connect([
    'global' => true,

    'config' => [

        'database' => [
            'user'     => 'user',
            'password' => 'password',
            'name'     => 'database',
            'host'     => '127.0.0.1',
            'port'     => '3306'
        ],

        // your wpdb prefix
        'prefix' => 'wp_',
    ],

    // enable events
    'events' => false,

    // enable query log
    'log'    => true
]);

```

If you wanted to enable this on your entire WP install you could create a file with the above code to drop in the `mu-plugins` folder.

## Setup with Laravel

These directions are for when you want to work with WordPress database using Eloqent inside Laravel. The easiest mehtod is making a new config inside Laravel's `config/database.php`. For example:

```php
    'wordpress' => [
        'driver' => 'mysql',
        'url' => env('DATABASE_URL'),
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_NAME', 'wordpress'),
        'username' => env('DB_USER', 'forge'),
        'password' => env('DB_PASSWORD', ''),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => env('DB_PREFIX', 'wp_'),
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => null,
        'options' => extension_loaded('pdo_mysql') ? array_filter([
            PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
        ]) : [],
    ],
```
*Note:* In this example the WordPress database and Laravel database can be accessed on the same server by the same MySQL user. The laravel `.env` of your project may need to be adjusted to match this example.

Then in your `AppServiceProvider` add the following line:
```php
BaseModel::setDefaultConnection('wordpress');
```

## Supported Models

### Posts

```php

use \WPEloquent\Model\Post;

// getting a post
$post = Post::find(1);

// available relationships
$post->author;
$post->comments;
$post->terms;
$post->tags;
$post->categories;
$post->meta;

```

***Statuses***

By default, the `Post` returns posts with all statuses. You can however override this with the [local scope](https://laravel.com/docs/5.3/eloquent#query-scopes) `published` to return only published posts.

```php
Post::published()->get();
```

Or if you need a specific status you can override with defined status via [local scope](https://laravel.com/docs/5.3/eloquent#query-scopes).

```php
Post::status('draft')->get();
```

***Post Types***

By default, the `Post` returns posts with all post types. You can however override this by defining a post type via [local scope](https://laravel.com/docs/5.3/eloquent#query-scopes).

```php
Post::type('page')->get();
```

### Comments

```php

use \WPEloquent\Model\Comment;

// getting a comment
$comment = Comment::find(12345);

// available relationships
$comment->post;
$comment->author;
$comment->meta

```

### Terms

In this version `Term` is still accesible as a model but is only leveraged through posts.

```php
$post->terms()->where('taxonomy', 'country');
```

### Users

```php

use \WPEloquent\Model\User;

// getting a comment
$user = User::find(123);

// available relationships
$user->posts;
$user->meta;
$user->comments

```

### Meta

The models `Post`, `User`, `Comment`, `Term`, all implement the `HasMeta`. Therefore they meta can easily be retrieved by the `getMeta` and set by the `setMeta` helper functions:

```php
$post = Post::find(1);
$post->setMeta('featured_image', 'my-image.jpg');
$post->setMeta('breakfast', ['waffles' => 'blueberry', 'pancakes' => 'banana']);

// or all in one call
$featured_image = Post::find(1)->getMeta('featured_image');
Post::find(1)->setMeta('featured_image', 'image.jpg');

// same applies for all other models

$user = User::find(1)
$facebook = $user->getMeta('facebook');
$user->setMeta('social', ['facebook' => 'facebook.com/me', 'instagram' => 'instagram.com/me']);

$comment = Comment::find(1);
$meta = $comment->getMeta('some_comment_meta');

$term = Term::find(123);
$meta = $term->getMeta('some_term_meta');

// delete meta
$post = Post::find(123)->deleteMeta('some_term_meta');
```

### Options

In wordpress you can use `get_option`. Alternatively, if you don't want to load the wordpress core you can use helper function `getValue`.

```php
use \WPEloquent\Model\Post;

$siteurl = Option::getValue('siteurl');
```

Or of course, the long form:

```php
use \WPEloquent\Model\Options;

$siteurl = Option::where('option_name', 'siteurl')->value('option_value');
```


### Links

```php
use \WPEloquent\Model\Link;

$siteurl = Link::find(1);
```

## Extending your own models

If you want to add your own functionality to a model, for instance a `User` you can do so like this:

```php
namespace App\Model;

class User extends \WPEloquent\Model\User {

    public function orders() {
        return $this->hasMany('\App\Model\User\Orders');
    }

    public function current() {
        // some functionality to get current user
    }

    public function favorites() {
        return $this->hasMany('Favorites');
    }

}
```

Another example would be for custom taxonomies on a post, say `country`

```php
namespace App\Model;

class Post extends \WPEloquent\Model\Post {

    public function countries() {
        return $this->terms()->where('taxonomy', 'country');
    }

}

Post::with(['categories', 'countries'])->find(1);
```

Or maybe you need to access a custom post type, like:

```php
namespace App\Model;

class CustomPostType extends \WPEloquent\Model\Post {
    protected $post_type  = 'custom_post_type';

    public static function getBySlug(string $slug): self
    {
        return self::where('post_name', $slug)->firstOrfail();
    }
}

CustomPostType::with(['categories', 'countries'])->find(1);
```

## Query Logs

Sometimes it's helpful to see the query logs for debugging. You can enable the logs by passing `log` is set to `true` (see [setup](#setup)) on the `Laravel::connect` method. Logs are retrieved by running.

```php
use \WPEloquent\Core\Laravel;

print_r(Laravel::queryLog());

```
