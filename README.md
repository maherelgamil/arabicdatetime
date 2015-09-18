# ArabicDateTime



Easy and useful tool to generate arabic or hijri date with multi-language support for laravel .




## Installation

### Composer

Add Laravel ArabicDateTime to your `composer.json` file.

    "maherelgamil/arabicdatetime": "4.0.*"

Run `composer install` to get the latest version of the package.


### Manually

It's recommended that you use Composer, however you can download and install from this repository.

### Laravel 5.1

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

    //Arabicdatetime::date({unixtime} , {mode} , {schema} , {numericMode});

    //This function take 4 Parameters :

    //1- unixtime : ex '1418123530'

    //2- mode :
        0 for arabic date
        1 for hijri date

    //3- schema : as `php` schema , you can read this page for more info. : http://php.net/manual/en/function.date.php

    //4- numericMode take to types 'indian'  or 'arabic' and 'arabic' is default


    
    //for arabic date
    Arabicdatetime::date(1418123530 , 0);
    
    //for arabic date with indian numbers
    Arabicdatetime::date(1418123530 , 1 , 'd / m / y '  ,'indian');
    
    //for hijri date in arabic with indian numbers
    Arabicdatetime::date(1418123530 , 2 , 'd / m / y '  , 'indian');
    
```



### Get Days with locale language

```PHP
    Arabicdatetime::getDays();
```


### Get Arabic Days

```PHP
    Arabicdatetime::getArabicDays();
```


### Get Months With locale language

```PHP
    Arabicdatetime::getMonths();
```


### Get Arabic Months

```PHP
    Arabicdatetime::getArabicMonths();
```


### Get Hijri Months with locale language

```PHP
    Arabicdatetime::getHijriMonths();
```



### Get Hijri Months

```PHP
    Arabicdatetime::getArabicHijriMonths();
```



### Get remainnig time

```php
    Arabicdatetime::remainingTime(1418123530);
```


### Get left  time

```php
    Arabicdatetime::leftTime(1418123530);
```

### Get left or remaining  time

```php
    Arabicdatetime::leftRemainingTime(1418123530);
```


## License

ArabicDateTime is an open-sourced laravel package licensed under the MIT license