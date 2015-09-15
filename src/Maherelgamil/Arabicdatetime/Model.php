<?php namespace Maherelgamil\Arabicdatetime;

/**
 * Class Model
 * @author Maher El Gamil <maherbusnes@gmail.com>
 * @package Maherelgamil\Arabicdatetime
 */
class Model {



    private  $months = [
        "jan" ,
        "feb" ,
        "mar" ,
        "apr" ,
        "may" ,
        "jun" ,
        "jul" ,
        "aug" ,
        "sep" ,
        "nov" ,
        "dec" ,
    ] ;


    private  $days = ["sat" , "sun" , "mon" , "tue" , "wed" , "thu" , "fri"];

    private  $period = ['am' , 'pm'] ;


    private $hijriMonths = [
        'muharram',
        'safar',
        'rabi_al_awwal',
        'rabi_al_akhir',
        'jamadi_al_awwal',
        'jamadi_al_akhir',
        'rajab',
        'shabaan',
        'ramadhan',
        'shawwal',
        'zilqad',
        'zilhajj' ,
    ];

    private  $indianNum = ["٠","١","٢","٣","٤","٥","٦","٧","٨","٩"] ;

    private  $arabicNum = ["0","1","2","3","4","5","6","7","8","9"];

    private  $formates = ["d","D","j","l","L","N","S","w","z","W","F","M","m","n","t","L","o","Y","y","a","A","B","g","G","h","H","i","s","u","e","O","P","T","Z","c","r","U"];


    /**
     * Populating model variables from configuation file
     */
    public function __construct(){}


    /**
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return array
     */
    public function getMonthsList()
    {
        return $this->months ;
    }

    /**
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return array
     */
    public function getDaysList()
    {
        return $this->days ;
    }

    /**
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return array
     */
    public function getPeriodList()
    {
        return $this->period ;
    }

    /**
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return array
     */
    public function getHijriMonths()
    {
        return $this->hijriMonths ;
    }

    /**
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return array
     */
    public function getIndianNumbersList()
    {
        return $this->indianNum ;
    }

    /**
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return array
     */
    public function getArabicNumbersList()
    {
        return $this->arabicNum ;
    }

    /**
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return array
     */
    public function getFormat()
    {
        return $this->formates ;
    }



    /**
     * Convert Numbers To Indian Numbers
     *
     * @param $date
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return mixed
     */
    public function convertNumbersToIndian($date)
    {
        return str_replace($this->arabicNum , $this->indianNum , $date);
    }



    public function getPreventWords()
    {
        return array_merge($this->months , $this->hijriMonths , $this->days , $this->period );
    }


    /**
     * Convert given Gregorian date into Hijri date
     *
     * @param integer $Y Year Gregorian year
     * @param integer $M Month Gregorian month
     * @param integer $D Day Gregorian day
     *
     * @return array Hijri date [int Year, int Month, int Day](Islamic calendar)
     * @author Khaled Al-Sham'aa <khaled@ar-php.org> @editedBy : MaherElGamil <maherbusnes@gmail.com>
     */
    public function hjConvert($Y, $M, $D)
    {
        if (function_exists('GregorianToJD')) {
            $jd = GregorianToJD($M, $D, $Y);
        } else {
            $jd = $this->gregToJd($M, $D, $Y);
        }

        list($year, $month, $day) = $this->jdToIslamic($jd);

        return [
            'year' => $year ,
            'month' => $month ,
            'day' => $day
        ];
    }

    /**
     * Convert given Julian day into Hijri date
     *
     * @param integer $jd Julian day
     *
     * @return array Hijri date [int Year, int Month, int Day](Islamic calendar)
     * @author Khaled Al-Sham'aa <khaled@ar-php.org>
     */
    public function jdToIslamic($jd)
    {
        $l = (int)$jd - 1948440 + 10632;
        $n = (int)(($l - 1) / 10631);
        $l = $l - 10631 * $n + 354;
        $j = (int)((10985 - $l) / 5316) * (int)((50 * $l) / 17719)
            + (int)($l / 5670) * (int)((43 * $l) / 15238);
        $l = $l - (int)((30 - $j) / 15) * (int)((17719 * $j) / 50)
            - (int)($j / 16) * (int)((15238 * $j) / 43) + 29;
        $m = (int)((24 * $l) / 709);
        $d = $l - (int)((709 * $m) / 24);
        $y = (int)(30 * $n + $j - 30);

        return array($y, $m, $d);
    }

    /**
     * Converts a Gregorian date to Julian Day Count
     *
     * @param integer $m The month as a number from 1 (for January)
     *                    to 12 (for December)
     * @param integer $d The day as a number from 1 to 31
     * @param integer $y The year as a number between -4714 and 9999
     *
     * @return integer The julian day for the given gregorian date as an integer
     * @author Khaled Al-Sham'aa <khaled@ar-php.org>
     */
    public function gregToJd ($m, $d, $y)
    {
        if ($m < 3) {
            $y--;
            $m += 12;
        }

        if (($y < 1582) || ($y == 1582 && $m < 10)
            || ($y == 1582 && $m == 10 && $d <= 15)
        ) {
            // This is ignored in the GregorianToJD PHP function!
            $b = 0;
        } else {
            $a = (int)($y / 100);
            $b = 2 - $a + (int)($a / 4);
        }

        $jd = (int)(365.25 * ($y + 4716)) + (int)(30.6001 * ($m + 1))
            + $d + $b - 1524.5;

        return round($jd);
    }

    /**
     * Convert given Hijri date into Julian day
     *
     * @param integer $year  Year Hijri year
     * @param integer $month Month Hijri month
     * @param integer $day   Day Hijri day
     *
     * @return integer Julian day
     * @author Khaled Al-Sham'aa <khaled@ar-php.org>
     */
    public function islamicToJd($year, $month, $day)
    {
        $jd = (int)((11 * $year + 3) / 30) + (int)(354 * $year) + (int)(30 * $month)
            - (int)(($month - 1) / 2) + $day + 1948440 - 385;
        return $jd;
    }


}