<?php namespace Maherelgamil\Arabicdatetime;

/**
 * Class Arabicdatetime
 * @author Maher El Gamil <maherbusnes@gmail.com>
 * @package Maherelgamil\Arabicdatetime
 */
class Arabicdatetime
{
    /**
     * Using constructor we populate our model from configuration file
     *
     * @param array $config
     */
    public function __construct()
    {
        $this->model = new Model();
    }



    /**
     * Get date in Arabic
     *
     * @param  string $unixtime time
     * @param  int $mode 0 arabic || 1 hijri
     * @param  string  $schema
     * @param  string $numericMode 'arabic' || 'hindi'
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return string contain date
     */
    public function date($unixtime , $mode = 0 , $schema = 'D d / M m / Y' , $numericMode = null)
    {
        if($mode == 0)
        {
            //arabic
            $date = $this->getGregorianDate($unixtime , $schema ,$numericMode);

        }
        elseif($mode == 1)
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
     * Get locale months
     *
     * @return array
     */
    public function getMonths()
    {
        $months = [];
        foreach($this->model->getMonthsList() as $month )
        {
            $months[] = trans("arabicdatetime::months.".strtolower($month));
        }
        return $months ;
    }


    /**
     * Get Arabic Monthes
     *
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return array
     */
    public function getArabicMonths()
    {
        $months = [];
        foreach($this->model->getMonthsList() as $month )
        {
            $months[] = trans("arabicdatetime::months.".strtolower($month) , [] , null , 'ar');
        }
        return $months ;
    }


    /**
     * Get Locales Days.
     *
     * @return array
     */
    public function getDays()
    {
        $days = [];
        foreach($this->model->getDaysList() as $day )
        {
            $days[] = trans("arabicdatetime::days.".strtolower($day));
        }
        return $days ;
    }


    /**
     * Get Arabic Days
     *
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return array
     */
    public function getArabicDays()
    {
        $days = [];
        foreach($this->model->getDaysList() as $day )
        {
            $days[] = trans("arabicdatetime::days.".strtolower($day) , [] , null , 'ar');
        }
        return $days ;
    }


    /**
     * Get Hijri locale days
     * @return array
     */
    public function getHijriMonths()
    {
        $months = [];
        foreach($this->model->getHijriMonths() as $month )
        {
            $months[] = trans("arabicdatetime::hijri_months.".strtolower($month));
        }
        return $months ;
    }


    /**
     * Get Arabic Hijri Months
     *
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return array
     */
    public function getArabicHijriMonths()
    {
        $months = [];
        foreach($this->model->getHijriMonths() as $month )
        {
            $months[] = trans("arabicdatetime::hijri_months.".strtolower($month) , [] , null , 'ar');
        }
        return $months ;
    }


    /**
     * Get Remaining Time
     *
     * @param $unixtime
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return Array $remaining
     */
    public function remainingTime($unixtime)
    {
        $seconds = $unixtime - time();

        //get years
        $remaining['years'] = floor($seconds / 31104000) > 0 ?  floor($seconds / 31104000) : null ;

        //get months
        $seconds %= 31104000;
        $remaining['months'] = floor($seconds / 2592000) > 0 ?  floor($seconds / 2592000) : null ;


        //get weeks
        $seconds %= 2592000;
        $remaining['weeks'] = floor($seconds / 604800) > 0 ?  floor($seconds / 604800) : null ;

        //get days
        $seconds %= 604800;
        $remaining['days'] = floor($seconds / 86400) > 0 ?  floor($seconds / 86400) : null ;

        //get hours
        $seconds %= 86400;
        $remaining['hours'] = floor($seconds / 3600) > 0 ? floor($seconds / 3600) : null ;

        //get minutes
        $seconds %= 3600;
        $remaining['minutes'] = floor($seconds / 60) > 0  ? floor($seconds / 60) : null ;

        //get seconds
        $seconds %= 60;
        $remaining['seconds'] = $seconds > 0 ? $seconds : null  ;

        return $this->generateRemainingStatement($remaining) ;
    }


    /**
     * Get left time
     *
     * @param $unixtime
     * @return string
     */
    public function leftTime($unixtime)
    {
        $seconds = time() - $unixtime ;

        //get years
        $remaining['years'] = floor($seconds / 31104000) > 0 ?  floor($seconds / 31104000) : null ;

        //get months
        $seconds %= 31104000;
        $remaining['months'] = floor($seconds / 2592000) > 0 ?  floor($seconds / 2592000) : null ;


        //get weeks
        $seconds %= 2592000;
        $remaining['weeks'] = floor($seconds / 604800) > 0 ?  floor($seconds / 604800) : null ;

        //get days
        $seconds %= 604800;
        $remaining['days'] = floor($seconds / 86400) > 0 ?  floor($seconds / 86400) : null ;

        //get hours
        $seconds %= 86400;
        $remaining['hours'] = floor($seconds / 3600) > 0 ? floor($seconds / 3600) : null ;

        //get minutes
        $seconds %= 3600;
        $remaining['minutes'] = floor($seconds / 60) > 0  ? floor($seconds / 60) : null ;

        //get seconds
        $seconds %= 60;
        $remaining['seconds'] = $seconds > 0 ? $seconds : null  ;

        return $this->generateLeftStatement($remaining) ;
    }


    /**
     * Get Left Or Remaining Time
     *
     * @param $unixtime
     * @return string
     */
    public function leftRemainingTime($unixtime)
    {
        $seconds = $unixtime - time();

        if($seconds > 0 )
        {
            $remaining = $this->extractSecondsToTimeArray($seconds);

            $statement = $this->generateRemainingStatement($remaining) ;
        }
        else
        {
            $seconds = $seconds*-1 ;

            $remaining = $this->extractSecondsToTimeArray($seconds);

            $statement = $this->generateLeftStatement($remaining) ;
        }

        return $statement ;
    }





    /**
     * Get Gregorian date from unixtime
     *
     * @param string  $unixtime
     * @param  string  $schema
     * @param  string $numericMode 'arabic' || 'hindi'
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return string contain date
     *
     */
    protected function getGregorianDate($unixtime , $schema = 'D d / M m / Y' , $numericMode = null)
    {
        //generate date array
        $currentDateArray = [];
        foreach ($this->model->getFormat() as $formate )
        {
            $currentDateArray[$formate] = date($formate , $unixtime );
        }

        $currentDateArray['D'] = trans("arabicdatetime::days.".strtolower(date('D' , $unixtime)));
        $currentDateArray['M'] = trans("arabicdatetime::months.".strtolower(date('M' , $unixtime)));


        return $this->renderDate($currentDateArray , $schema , $numericMode);
    }


    /**
     * Get hijri date from unixtime
     *
     * @param string $unixtime
     * @param  string  $schema
     * @param  string $numericMode 'arabic' || 'hindi'
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return string contain date
     *
     */
    protected function getHijriDate($unixtime , $schema = 'D d / M m / Y'  , $numericMode = null)
    {
        //generate date array
        $currentDateArray = [];
        foreach ($this->model->getFormat() as $formate )
        {
            $currentDateArray[$formate] = date($formate , $unixtime );
        }


        $hiriDateArray =  $this->model->hjConvert(date('Y' , $unixtime),date('m' , $unixtime),date('j' , $unixtime));


        //get day
        $currentDateArray['d'] = $hiriDateArray['day'];
        $currentDateArray['D'] = trans("arabicdatetime::days.".strtolower(date('D' , $unixtime)));
        $currentDateArray['M'] = trans("arabicdatetime::hijri_months.".$this->model->getHijriMonths()[$hiriDateArray['month'] - 1]);
        $currentDateArray['m'] = $hiriDateArray['month'];
        $currentDateArray['Y'] = $hiriDateArray['year'];
        $currentDateArray['y'] = substr($hiriDateArray['year'] , -2 , 2 );


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
    protected  function renderDate(array $currentDateArray , $schema = 'D d / M m / Y' , $numericMode = null )
    {
        $currentDate = $this->generateDateStatement($currentDateArray , $schema );

        return $numericMode == 'indian' ? $this->model->convertNumbersToIndian($currentDate) : $currentDate ;
    }


    /**
     * Generate Full Date Statement
     *
     * @param array $dateArray
     * @param string $schema
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return mixed
     */
    protected function generateDateStatement(array $dateArray , $schema = 'D d / M m / Y')
    {
        $schemaArray = (str_split($schema));

        foreach($schemaArray as $key => $value )
        {
            if(in_array($value , $this->model->getFormat()) && isset($dateArray[$value]))
            {
                $schemaArray[$key] = $dateArray[$value] ;
            }
        }

        return implode("" , $schemaArray );
    }


    /**
     * Generate Remaining Statement
     *
     * @param array $remaining
     * @author Maher El Gamil <maherbusnes@gmail.com>
     * @return string
     */
    protected function generateRemainingStatement(array $remaining)
    {
        $statement = trans("arabicdatetime::general.remain");
        $statement .= " ";
        $statement .= $this->transTime($remaining);
        return $statement ;
    }


    /**
     * Generate Left Statement
     *
     * @param array $remaining
     * @return string
     */
    protected function generateLeftStatement(array $remaining)
    {
        $statement = trans("arabicdatetime::general.ago");
        $statement .= " ";
        $statement .= $this->transTime($remaining);
        return $statement ;
    }


    /**
     * Trans Time
     *
     * @param array $remaining
     * @return string
     */
    protected function transTime(array $remaining)
    {
        $statement = '' ;

        if(isset($remaining['years']))
        {
            if($remaining['years'] == 1 ) $statement .= " " . trans("arabicdatetime::general.one_year");
            elseif($remaining['years'] == 2 ) $statement .= " " . trans("arabicdatetime::general.two_years");
            elseif($remaining['years'] > 2 &&  $remaining['years'] < 11)
            {
                $statement .= intval($remaining['years']) . " " .  trans("arabicdatetime::general.years");
            }
            else $statement .= intval($remaining['years']) . " " . trans("arabicdatetime::general.year");
            $statement .= " ";
            $statement .= isset($remaining['months']) ? trans("arabicdatetime::general.and") : null ;
            $statement .= " ";
        }


        if(isset($remaining['months']))
        {
            if($remaining['months'] == 1 ) $statement .= " " . trans("arabicdatetime::general.one_month");
            elseif($remaining['months'] == 2 ) $statement .= " " . trans("arabicdatetime::general.two_months");
            elseif($remaining['months'] > 2 &&  $remaining['months'] < 11)
            {
                $statement .= intval($remaining['months']) . " " .  trans("arabicdatetime::general.months");
            }
            else $statement .= intval($remaining['months']) . " " . trans("arabicdatetime::general.month");
            $statement .= " ";
            $statement .= isset($remaining['weeks']) ? trans("arabicdatetime::general.and") : null ;
            $statement .= " ";
        }


        if(isset($remaining['weeks']))
        {
            if($remaining['weeks'] == 1 ) $statement .= " " . trans("arabicdatetime::general.one_week");
            elseif($remaining['weeks'] == 2 ) $statement .= " " . trans("arabicdatetime::general.two_weeks");
            elseif($remaining['weeks'] > 2 &&  $remaining['weeks'] < 11)
            {
                $statement .= intval($remaining['weeks']) . " " .  trans("arabicdatetime::general.weeks");
            }
            else $statement .= intval($remaining['weeks']) . " " . trans("arabicdatetime::general.week");
            $statement .= " ";
            $statement .= isset($remaining['days']) ? trans("arabicdatetime::general.and") : null ;
            $statement .= " ";
        }

        if(isset($remaining['days']))
        {
            if($remaining['days'] == 1 ) $statement .= " " . trans("arabicdatetime::general.one_day");
            elseif($remaining['days'] == 2 ) $statement .= " " . trans("arabicdatetime::general.two_days");
            elseif($remaining['days'] > 2 &&  $remaining['days'] < 11)
            {
                $statement .= intval($remaining['days']) . " " .  trans("arabicdatetime::general.days");
            }
            else $statement .= intval($remaining['days']) . " " . trans("arabicdatetime::general.day");
            $statement .= " ";
            $statement .= isset($remaining['hours']) ? trans("arabicdatetime::general.and") : null ;
            $statement .= " ";
        }

        if(isset($remaining['hours']))
        {
            if($remaining['hours'] == 1 ) $statement .= " " . trans("arabicdatetime::general.one_hour");
            elseif($remaining['hours'] == 2 ) $statement .= " " . trans("arabicdatetime::general.two_hours");
            elseif($remaining['hours'] > 2 &&  $remaining['hours'] < 11)
            {
                $statement .= intval($remaining['hours']) . " " .  trans("arabicdatetime::general.hours");
            }
            else $statement .= intval($remaining['hours']) . " " . trans("arabicdatetime::general.hour");
            $statement .= " ";
            $statement .= isset($remaining['minutes']) ? trans("arabicdatetime::general.and") : null ;
            $statement .= " ";
        }

        if(isset($remaining['minutes']))
        {
            if($remaining['minutes'] == 1 ) $statement .= " " . trans("arabicdatetime::general.one_minute");
            elseif($remaining['minutes'] == 2 ) $statement .= " " . trans("arabicdatetime::general.two_minutes");
            elseif($remaining['minutes'] > 2 &&  $remaining['minutes'] < 11)
            {
                $statement .= intval($remaining['minutes']) . " " .  trans("arabicdatetime::general.minutes");
            }
            else $statement .= intval($remaining['minutes']) . " " . trans("arabicdatetime::general.minute");
            $statement .= " ";
            $statement .= isset($remaining['seconds']) ? trans("arabicdatetime::general.and") : null ;
            $statement .= " ";
        }


        if(isset($remaining['seconds']))
        {
            if($remaining['seconds'] == 1 ) $statement .= " " . trans("arabicdatetime::general.one_second");
            elseif($remaining['seconds'] == 2 ) $statement .= " " . trans("arabicdatetime::general.two_seconds");
            elseif($remaining['seconds'] > 2 &&  $remaining['minutes'] < 11)
            {
                $statement .= intval($remaining['seconds']) . " " .  trans("arabicdatetime::general.seconds");
            }
            else $statement .= intval($remaining['seconds']) . " " . trans("arabicdatetime::general.second");
        }

        return $statement ;
    }


    /**
     * Extract Seconds To Time Array
     *
     * @param $seconds
     * @return mixed
     */
    protected function extractSecondsToTimeArray($seconds)
    {
        //get years
        $remaining['years'] = floor($seconds / 31104000) > 0 ?  floor($seconds / 31104000) : null ;

        //get months
        $seconds %= 31104000;
        $remaining['months'] = floor($seconds / 2592000) > 0 ?  floor($seconds / 2592000) : null ;


        //get weeks
        $seconds %= 2592000;
        $remaining['weeks'] = floor($seconds / 604800) > 0 ?  floor($seconds / 604800) : null ;

        //get days
        $seconds %= 604800;
        $remaining['days'] = floor($seconds / 86400) > 0 ?  floor($seconds / 86400) : null ;

        //get hours
        $seconds %= 86400;
        $remaining['hours'] = floor($seconds / 3600) > 0 ? floor($seconds / 3600) : null ;

        //get minutes
        $seconds %= 3600;
        $remaining['minutes'] = floor($seconds / 60) > 0  ? floor($seconds / 60) : null ;

        //get seconds
        $seconds %= 60;
        $remaining['seconds'] = $seconds > 0 ? $seconds : null  ;

        return $remaining ;
    }

}


