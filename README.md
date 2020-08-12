# ArabicDateTime
Easy and useful tool to generate arabic or hijri date with multi-language support for laravel .

[![Latest Stable Version](https://poser.pugx.org/maherelgamil/arabicdatetime/v/stable)](https://packagist.org/packages/maherelgamil/arabicdatetime)
[![Total Downloads](https://poser.pugx.org/maherelgamil/arabicdatetime/downloads)](https://packagist.org/packages/maherelgamil/arabicdatetime)
[![Latest Unstable Version](https://poser.pugx.org/maherelgamil/arabicdatetime/v/unstable)](https://packagist.org/packages/maherelgamil/arabicdatetime)
[![License](https://poser.pugx.org/maherelgamil/arabicdatetime/license)](https://packagist.org/packages/maherelgamil/arabicdatetime)
[![Monthly Downloads](https://poser.pugx.org/maherelgamil/arabicdatetime/d/monthly)](https://packagist.org/packages/maherelgamil/arabicdatetime)
[![StyleCI](https://styleci.io/repos/27773486/shield)](https://styleci.io/repos/27773486)


## Installation

### Composer

Add Laravel ArabicDateTime to your `composer.json` file.

    "maherelgamil/arabicdatetime": "4.0.*"

Run `composer install` to get the latest version of the package.


### Manually

It's recommended that you use Composer, however you can download and install from this repository.

### Laravel 5.*

ArabicDateTime comes with a service provider for Laravel 4. You'll need to add it to your `composer.json` as mentioned in the above steps, then register the service provider with your application.

Open `app/config/app.php` and find the `providers` key. Add `Arabicdatetime\ArabicdatetimeServiceProvider` to the array.

```php
	...
	Maherelgamil\Arabicdatetime\ArabicdatetimeServiceProvider::class
	...
```

You can also add an alias to the list of class aliases in the same app.php

```php
	...
	'Arabicdatetime'    => Maherelgamil\Arabicdatetime\Facades\Arabicdatetime::class
	...
```

Now . publish vendor
```
    php artisan vendor:publish
```

## Useage


### Get date from unixtime

```php

    //$arabDateTime->date({unixtime} , {mode} , {schema} , {numericMode});

    //This function take 4 Parameters :

    //1- unixtime : ex '1418123530'

    //2- mode :
        0 for Arabic date
        1 for Hijri date

    //3- schema : as `php` schema , you can read this page for more info. : http://php.net/manual/en/function.date.php

    //4- numericMode takes two types 'indian'  or 'arabic' and 'arabic' is default

    //5 - Create a Arabicdatetime instance
    $arabDateTime = new Arabicdatetime();

    //for Gregorian date with Englsih numbers
    $arabDateTime->date(1418123530 , 0);

    //for Hijri date with indian numbers
    $arabDateTime->date(1418123530 , 1 , 'd / m / y '  ,'indian');

    //for Hijri date, there is an optional correction, You can add or subtract days with plus and minus
    $arabDateTime->setCorrection('+1');
    $arabDateTime->setCorrection('-1');

```



### Get Days with locale language

```PHP
    $arabDateTime->getDays();
```


### Get Arabic Days

```PHP
    $arabDateTime->getArabicDays();
```


### Get Months With locale language

```PHP
    $arabDateTime->getMonths();
```


### Get Arabic Months

```PHP
    $arabDateTime->getArabicMonths();
```


### Get Hijri Months with locale language

```PHP
    $arabDateTime->getHijriMonths();
```



### Get Hijri Months

```PHP
    $arabDateTime->getArabicHijriMonths();
```



### Get remainnig time

```php
    $arabDateTime->remainingTime(1418123530);
```


### Get left  time

```php
    $arabDateTime->leftTime(1418123530);
```

### Get left or remaining  time

```php
    $arabDateTime->leftRemainingTime(1418123530);
```


## License

ArabicDateTime is an open-sourced laravel package licensed under the [MIT](LICENSE) license
