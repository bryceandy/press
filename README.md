# Press

[![Actions Status](https://github.com/bryceandy/press/workflows/Tests/badge.svg)](https://github.com/bryceandy/press/actions)  

This [Laravel](https://laravel.com) package can be used to publish and update your blogs using markdown files.  

✅ Locate where your markdown files are (i.e local file directory, cloud)  
✅ Create or update these files  
✅ Select custom fields for your posts  
✅ Customize how any extra field can be parsed  
✅ Choose when to publish or update the posts by scheduling a command  

## Requirements  

Your project needs to meet the following requirements:  

* PHP version >=7.4   
* Laravel version 7 and above
* ext-json installed  

## Installation  

Run the following command on your terminal to install the package  

```bash
composer require bryceandy/press
```  

## Usage  

### Publish configurations and run migrations   

Run the following artisan command, and the config file `press.php` will be published in the config directory.  

```bash
php artisan vendor:publish --tag=press-config
```

You may require to store your markdown files in a specific driver. But currently this package supports the local file driver.  

Update the configuration option `file.path` in the published file with the directory where you will store your markdown files.  

If you do not update this path make sure you create a `blogs` directory in the root of the project and store your files.  

```bash
php artisan migrate
```  

You should also run the artisan migrate command to add the posts table.

### Markdown files syntax  

The posts of your blog will have one required field **title**, and your own custom fields. The following is a sample syntax for your markdown files:  

```markdown
---
title: Post title  
field1: Additional field  
field2: Another additional field  
---  
The body of your post here  
```  

### Customize parsing of additional fields  

If you wish to customize how an additional field is parsed (saved in the database), or you may wish to override how the title field is parsed:  

Suppose we want to create a **birthday** field that should be parsed as a [Carbon](https://carbon.nesbot.com) instance  

1. Add the birthday field in the mardown file of your post  

```markdown
---
title: An awesome post  
birthday: Jan 20, 2020  
field: Another field  
field2: Yet another field  
---  
The rest of the body  
```  

2. Create a custom class for the field and extend the `FieldContract` class  

3. Inherit the static `process` method and return the value of `$field` in an array  

```php
<?php

namespace App\Fields;

use Bryceandy\Press\Contracts\FieldContract;
use Carbon\Carbon;

class Birthday extends FieldContract
{
    public static function process($field, $value, $data)
    {
        return [
            $field => Carbon::parse($value),
            // or $field => $value,
        ];
    }
}

```  

4. Publish the Press service provider,  

```bash
php artisan vendor:publish --tag=press-provider
```  

Do not forget to register the published service provider and the `Press` facade in the `config/app.php` file  
```php
/*
 * Package Service Providers...
 */
 App\Providers\PressServiceProvider::class,

/**
 * Aliases
 */
 'aliases' => [
    ...
    'Press' => Bryceandy\Press\Facades\Press::class,
 ],
```  

5. Register the field class  

In the service provider you will find the `registerFields` method, and thats where you are required to register custom field classes,  

```php
private function registerFields()
{
    return [
        \App\Fields\Birthday::class,
    ];
}
```  

### Publishing posts  

When you are ready to publish your posts, or update existing an one, you may run the following command or schedule it to run in the background whenever you want  

```bash
php artisan press:process
```  

### Fetching your posts  

If you could successfully run the previous command that means your posts are saved in your posts table.

You may use the `Bryceandy\Press\Post` model to fetch posts.  

#### The custom fields  

When retrieving all custom fields you may use the **extra** field in the following way:  

```php
$post = Bryceandy\Press\Post::all()->first();

// The field that was parsed with the Birthday class
$birthday = $post->extra('birthday');  

// The field that was only written in the markdown file without a custom class to parse
$field = $post->extra('field');   

// Other fields  
$title = $post->title;
$body = $post->body;  
```  

## Upcoming features  

🔘 Support for cloud drivers, specifically Amazon S3.  

## License  

MIT license.

Feel free to submit pull requests to contribute to the package.  

