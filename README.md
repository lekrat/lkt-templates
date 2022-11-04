# LKT Templates

It's simple. It's fast. It's LKT Templates!

Are you tired of complex PHP template engine?

Would you like to code just like in regular PHP?

Then this lib is for you!

## Installation

```shell
composer require lkt/templates
```

## Usage

### The layout file

LKT Templates works with PHTML/PHP files.

In a PHTML file you can do anything you can do with PHP, just remember the colon syntax.

For example, take this `layout.phtml` file:

```php
<div><?php echo $title; ?></div>

<?php foreach ($data as $datum): ?>
    <div><?php echo $datum; ?></div>
<?php endforeach; ?>

<?php if(isset($favouriteDrink)): ?>
    <div>Favourite drink: <?php echo $favouriteDrink; ?></div>
<? endif; ?>


```

You may be asking where the data came from? That's what follows

### The Template instance: Access to the layout

This is how you access to `layout.phtml`:

```php

use Lkt\Templates\Template;

// Create a template instance:
$template = Template::file('layout.phtml'); // You can set a relative path, but absolute path it's allowed too

// Feed the data
$template->setData([
    'title' => 'Hello from LKT Templates!',
    'data' => [1,2]
]);

// If you want to, you can add more data with:
$template->set('favouriteDrink', 'Apple juice'); // PEGI 3+ example

// Parse the layout
$html = $template->parse(); // String returned

// And now you can just print the html or do whatever you want to do with that string
echo $html;

// Alternatively, you can just print the template, and it will be automatically parsed:
echo $template; // equal to echo $template->parse();
```

### The generated HTML

The layout used in this readme feed with data as shown in the PHP example will print something like this:

```html
<div>Hello from LKT Templates!</div>
<div>1</div>
<div>2</div>
<div>Favourite drink: Apple juice</div>
```

## Additional notes

### Access a template file with constant path:
```php
$template = Template::file(__DIR__ . '/path/to/layout.phtml');
```