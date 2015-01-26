<?php namespace Maherelgamil\Arabicdatetime;
/**
 *
 * @author maherbusnes@gmail.com
 *
 */
class Arabicdatetime
{

    protected  $months = [

        "Jan" => "يناير",
        "Feb" => "فبراير",
        "Mar" => "مارس",
        "Apr" => "أبريل",
        "May" => "مايو",
        "Jun" => "يونيو",
        "Jul" => "يوليو",
        "Aug" => "أغسطس",
        "Sep" => "سبتمبر",
        "Oct" => "أكتوبر",
        "Nov" => "نوفمبر",
        "Dec" => "ديسمبر"

    ] ;




    protected  $days = [

        "Sat" => 'السبت',
        "Sun" => 'الأحد',
        "Mon" => 'الأثنين',
        "Tue" => 'الثلاثاء',
        "Wed" => 'الأربعاء',
        "Thu" => 'الخميس',
        "Fri" => 'الجمعه'

    ];

    protected  $period = [
        'am' => 'صباحا' ,
        'pm' => 'مساءا'

    ] ;


    protected $hijriMonths = [
        'Muharram'        => 'محرم',
        'Safar'           => 'صفر',
        'Rabi al-Awwal'   => 'ربيع أول',
        'Rabi al-Akhir'   => 'ربيع ثانى',
        'Jamadi al-Awwal' => 'جمادى أول',
        'Jamadi al-Akhir' => 'جمادى ثانى',
        'Rajab'           => 'رجب',
        'Shabaan'         => 'شعبان',
        'Ramadhan'        => 'رمضان',
        'Shawwal'         => 'شوال',
        'Zilqad'          => 'ذو القعدة',
        'Zilhajj'         => 'ذو الحجة',
    ];

    protected  $indianNum = ["٠","١","٢","٣","٤","٥","٦","٧","٨","٩"] ;

    protected  $arabicNum = ["0","1","2","3","4","5","6","7","8","9"];



    /**
     * Get english date from unixtime
     *
     * @param string $unixtime
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return string contain date
     */
    protected function getEnglishDate($unixtime  , $schema = 't p D d / M m / Y' )
    {
        //get day
        $day = date('d', $unixtime);
        $dayName = date('D' , $unixtime);


        //1get month
        $month = date('m', $unixtime);
        $monthName = date("M", $unixtime );


        $year = date('Y', $unixtime) ;

        //get time
        $time = date('H:i' , $unixtime );

        //get am or pm
        $period = date('a' , $unixtime );


        $currentDateArray = [
            'd' => $day ,
            'D' => $dayName ,
            'm' => $month,
            'M' => $monthName,
            'Y' => $year,
            't' => $time,
            'p' => $period
        ];

        return $this->renderDate($currentDateArray , $schema);
    }


    /**
     * Get arabic date from unixtime
     *
     * @param string  $unixtime
     * @param $numericMode ( arabic ||  indian)
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return string contain date
     *
     */
    protected function getArabicDate($unixtime , $schema = 't p D d / M m / Y' , $numericMode = null)
    {
        //get day
        $day = date('d', $unixtime);
        $dayName = $this->days[date('D' , $unixtime)];


        //1get month
        $month = date('m', $unixtime);
        $monthName =  $this->months[date("M", $unixtime )] ;


        $year = date('Y', $unixtime) ;

        //get time
        $time = date('H:i' , $unixtime );

        //get am or pm
        $period = $this->period[date('a' , $unixtime )];


        $currentDateArray = [
            'd' => $day ,
            'D' => $dayName ,
            'm' => $month,
            'M' => $monthName,
            'Y' => $year,
            't' => $time,
            'p' => $period
        ];

        return $this->renderDate($currentDateArray , $schema , $numericMode);


    }


    /**
     * Get hijri date from unixtime
     *
     * @param string $unixtime
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return string contain date
     *
     */
    protected function getHijriDate($unixtime , $schema = 't p D d / M m / Y'  , $numericMode = null)
    {
        $hiriDateArray =  $this->hjConvert(date('Y' , $unixtime),date('m' , $unixtime),date('j' , $unixtime));

        //get day
        $day = $hiriDateArray['day'];
        $dayName = $this->days[date('D' , $unixtime)];



        //get month
        $month = $hiriDateArray['month'] ;
        $monthName = array_values($this->hijriMonths)[$hiriDateArray['month']];

        //get year
        $year = $hiriDateArray['year'];


        //get time
        $time = date('H:i' , $unixtime );

        //get am or pm
        $period = $this->period[date('a' , $unixtime )];


        $currentDateArray = [
            'd' => $day ,
            'D' => $dayName ,
            'm' => $month,
            'M' => $monthName,
            'Y' => $year,
            't' => $time,
            'p' => $period
        ];


        return $this->renderDate($currentDateArray , $schema , $numericMode);

    }


    /**
     * Render Date
     *
     * @param array $currentDateArray
     * @param string $schema
     * @param null $numericMode
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return mixed
     */
    protected  function renderDate(array $currentDateArray , $schema = 't p D d / M m / Y' , $numericMode = null )
    {
        $currentDate = $this->generateFullDateStatment($currentDateArray , $schema );

        return $numericMode == 'indian' ? $this->convertNumbersToIndian($currentDate) : $currentDate ;
    }


    /**
     * Generate Full Date Statment
     *
     * @param array $dateArray
     * @param string $schema
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return mixed
     */
    protected function generateFullDateStatment(array $dateArray , $schema = 't p D d / M m / Y')
    {
        $dataStatement = str_replace('t',$dateArray['t'],$schema);
        $dataStatement = str_replace('p',$dateArray['p'],$dataStatement);
        $dataStatement = str_replace('D',$dateArray['D'],$dataStatement);
        $dataStatement = str_replace('d',$dateArray['d'],$dataStatement);
        $dataStatement = str_replace('M',$dateArray['M'],$dataStatement);
        $dataStatement = str_replace('m',$dateArray['m'],$dataStatement);
        $dataStatement = str_replace('Y',$dateArray['Y'],$dataStatement);

        return $dataStatement ;
    }


    /**
     * Convert Numbers To Indian Numbers
     *
     * @param $date
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return mixed
     */
    protected function convertNumbersToIndian($date)
    {
        return str_replace($this->arabicNum , $this->indianNum , $date);
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
    protected function hjConvert($Y, $M, $D)
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
    protected function jdToIslamic($jd)
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
    protected function gregToJd ($m, $d, $y)
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
    protected function islamicToJd($year, $month, $day)
    {
        $jd = (int)((11 * $year + 3) / 30) + (int)(354 * $year) + (int)(30 * $month)
            - (int)(($month - 1) / 2) + $day + 1948440 - 385;
        return $jd;
    }


    /**
     * Get islamic data from unix time
     * @ToDo will delete it
     * @param $unixtime
     * @param string $separator
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return string
     */
    public function AHDateFromUnix($unixtime , $separator = '-')
    {
        $hiriDateArray =  $this->hjConvert(date('Y' , $unixtime),date('m' , $unixtime),date('j' , $unixtime));

        return $hiriDateArray['day'].$separator.$hiriDateArray['month'].$separator.$hiriDateArray['year'];
    }

    /**
     * Get date in Arabic
     *
     * @param string $unixtime time
     * @param int $mode 0 english || 1 arabic || 2 hijri
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return string contain date
     */
    public  function  date($unixtime , $mode = 0 , $schema = 't p D d / M m / Y' , $numericMode = null)
    {
        if($mode == 0){
            //english
            $date =  $this->getEnglishDate($unixtime , $schema);
        }
        elseif($mode == 1)
        {
            //arabic
            $date = $this->getArabicDate($unixtime , $schema ,$numericMode);

        }
        elseif($mode == 2)
        {
            //hijri
            $date = $this->getHijriDate($unixtime , $schema ,$numericMode);
        }
        else
        {
            $date = 'Undefined MOD !!';
        }


        return $date ;
    }

    /**
     * Get Arabic Monthes
     *
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return array
     */
    public function getArabicMonthes()
    {
        return $this->months ;
    }

    /**
     * Get Arabic Days
     *
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return array
     */
    public function getArabicDays()
    {
        return $this->days ;
    }

    /**
     * Get Hijri Months
     *
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return array
     */
    public function getHijriMonths()
    {
        return $this->hijriMonths ;
    }


    /**
     * Get Remainnig Time
     *
     * @param $unixtime
     * @param string $locale
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return string
     */
    public function remainnigTime($unixtime , $locale = 'ar')
    {
        $seconds = $unixtime - time();

        $days = floor($seconds / 86400);
        $seconds %= 86400;

        $hours = floor($seconds / 3600);
        $seconds %= 3600;

        $minutes = floor($seconds / 60);
        $seconds %= 60;

        if($locale == 'ar')
        {

            $remaining = ($days    > 0 ? $days    .' يوم و'   : '' ) .
                ($hours   > 0 ? $hours   .' ساعه و'  : '' ) .
                ($minutes > 0 ? $minutes .' دقيقة و' : '' ) .
                ($seconds > 0 ? $seconds .' ثانيه '  : '' ) ;
        }else{
            $remaining = ($days    > 0 ? $days    .' days and'   : '' ) .
                ($hours   > 0 ? $hours   .' hours and'  : '' ) .
                ($minutes > 0 ? $minutes .' minutes and' : '' ) .
                ($seconds > 0 ? $seconds .' seconds'  : '' ) ;
        }


        return $remaining ;
    }



}


