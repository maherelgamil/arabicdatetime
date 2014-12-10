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

    protected  $indianNum = ["٠","١","٢","٣","٤","٥","٦","٧","٨","٩"] ;

    protected  $arabicNum = ["0","1","2","3","4","5","6","7","8","9"];

    protected  $hourArabicTitle = 'الساعه' ;


    /**
     * Get english date from unixtime
     *
     * @param unixtime $unixtime
     *
     * @return string contain date
     *
     */
    protected function getEnglishDate($unixtime)
    {
        return date("F j, Y, g:i a" , $unixtime ); ;
    }


    /**
     * Get arabic date from unixtime
     *
     * @param unixtime $unixtime
     * @param $numericMode ( arabic ||  indian)
     *
     * @return string contain date
     *
     */
    protected function getArabicDate($unixtime , $numericMode = null)
    {
        //1get month
        $month =  $this->months[date("M", $unixtime )] ;

        //get day
        $day = $this->days[date('D' , $unixtime)];

        //get time
        $time = date('H:i' , $unixtime );

        //get am or pm
        $period = $this->period[date('a' , $unixtime )];

        $fullTime = $this->hourArabicTitle . " ($time)" . ' ' . $period ;

        //get full date
        $current_date = $fullTime . ' - ' . $day . ' ' . date('d') . ' / ' . $month . ' / ' .date('Y');


        $date = $numericMode == 'indian' ? str_replace($this->arabicNum , $this->indianNum , $current_date) : $current_date ;

        return $date ;


    }


    /**
     * Get hijri date from unixtime
     *
     * @param unixtime $unixtime
     *
     * @return string contain date
     *
     */
    protected function getHijriDate($unixtime)
    {
        return "hijri-date-suppoted-comming-soon";
    }

    /**
     * Get date in Arabic
     *
     * @param string $unixtime time
     * @param int $mode 0 english || 1 arabic || 2 hijri
     *
     * @author maherbusnes@gmail.com
     *
     *
     * @return string contain date
     */
    public  function  date($unixtime , $mode = 0 , $numericMode = null)
    {
        if($mode == 0){
            //english
            $date =  $this->getEnglishDate($unixtime);
        }elseif($mode == 1){
            //arabic
            $date = $this->getArabicDate($unixtime,$numericMode);

        }elseif($mode == 2){
            //hijri
            $date = $this->getHijriDate($unixtime,$numericMode);
        }


        return $date ;
    }


    public function getArabicMonthes()
    {
        return $this->arabicMonths ;
    }

    public function getArabicDays()
    {
        return $this->arabicDay ;
    }

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



?>