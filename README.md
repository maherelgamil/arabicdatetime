# ArabicDateTime



Easy and useful tool to get arabic date with arabic characters for laravel >= 5.1.0  .




## Installation

### Composer

Add Laravel ArabicDateTime to your `composer.json` file.

    "maherelgamil/arabicdatetime": "dev-master"

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

## Useage


### Get date from unixtime

```php

    //Arabicdatetime::date({unixtime} , {mode} , {schema} , {numericMode});

    //This function take 4 Parameters :

    //1- unixtime : ex '1418123530'

    //2- mode :
        0 for english date
        1 for arabic date
        2 for hijri date

    //3- schema : as `php` schema , you can read this page for more info. : http://php.net/manual/en/function.date.php

    //4- numericMode take to types 'indian'  or 'arabic' and 'arabic' is default


    //for english date
    Arabicdatetime::date(1418123530); // or Arabicdatetime::date(1418123530 , 0);
    
    //for arabic date
    Arabicdatetime::date(1418123530 , 1);
    
    //for arabic date with indian numbers
    Arabicdatetime::date(1418123530 , 1 , 'd / m / y '  ,'indian');
    
    //for hijri date in arabic with indian numbers
    Arabicdatetime::date(1418123530 , 2 , 'd / m / y '  , 'indian');
    
```



### Get Arabic Monthes

```PHP
    Arabicdatetime::getArabicMonthes();
```

### Get Arabic Days

```PHP
    Arabicdatetime::getArabicDays();
```


### Get Hijri Months

```PHP
    Arabicdatetime::getHijriMonths();
```


### Get remainnig time

```php
    Arabicdatetime::remainnigTime(1418123530);
```


## License

ArabicDateTime is an open-sourced laravel package licensed under the MIT license