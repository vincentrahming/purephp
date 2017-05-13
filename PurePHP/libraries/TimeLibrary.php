<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

    class TimeLibrary extends Controller {
        
        public $time_dayMap         =        array(1    =>  'Monday',
                                                   2    =>  'Tuesday',
                                                   3    =>  'Wednesday',
                                                   4    =>  'Thursday',
                                                   5    =>  'Friday',
                                                   6    =>  'Saturday',
                                                   7    =>  'Sunday');
        
        public $time_daysInMonths   =        array(1   =>  31,
                                                   2   =>  28,
                                                   3   =>  31,
                                                   4   =>  30,
                                                   5   =>  31,
                                                   6   =>  30,
                                                   7   =>  31,
                                                   8   =>  31,
                                                   9   =>  30,
                                                  10   =>  31,
                                                  11   =>  30,
                                                  12   =>  31);
        
        public function __construct() {
        
            parent::__construct();
            
        }
        
        /**
         *  @name       time_toEpoch
         *  @desc       Takes the string time and converts it to Epoch time
         *  @return     integer
         * 
         **/
        
        public function time_toEpoch($argument = false) {
     
            # determine if any arguments are passed.
            # if argument is true, use current date
            # else use argument to present string
            
            if (func_num_args() == 0) {
            
                $output     =   time();
                
            } else {
                
                $output     =   strtotime($argument);
            }
            
            # return output
            return $output;
            
        }
        
        /**
         *  @name       time_timeToSeconds
         *  @desc       Takes a time value and converts it to minutes.  Uses day as default if no agrument is present
         *  @param      TIME $argument
         *  @return     INTEGER $totalSeconds
         * 
         **/
        public function time_timeToSeconds($argument = FALSE) {
            
            if (func_num_args() == 0) {

                list($hour, $mins, $secs) = explode(":", date('H:i:s'));

                $hourToSeconds       = ($hour * 60) * 60;
                $minsToSeconds       = ($mins * 60);

                # tally seconds
                $totalSeconds        = ($hourToSeconds + $minsToSeconds + $secs);
                
            } else {

                list($hour, $mins, $secs) = explode(":", $argument);

                $hourToSeconds       = ($hour * 60) * 60;
                $minsToSeconds       = ($mins * 60);

                # tally seconds
                $totalSeconds        = ($hourToSeconds + $minsToSeconds + $secs);
                
            }

            return $totalSeconds;
            
        }
        
        
        /**
         *  @name       time_dateToSeconds
         *  @desc       Takes a date value and converts it to seconds.  Uses date as default if no agrument is present
         *  @param      DATE $argument
         *  @return     INTEGER $totalSeconds
         * 
         **/
        public function time_dateToSeconds($argument = FALSE) {
            
            if (func_num_args() == 0) {

                list($hour, $mins, $secs) = explode("-", date('Y-m-d'));

                $hourToSeconds       = ($hour * 60) * 60;
                $minsToSeconds       = ($mins * 60);

                # tally seconds
                $totalSeconds        = ($hourToSeconds + $minsToSeconds + $secs);
                
            } else {

                list($hour, $mins, $secs) = explode(":", $argument);

                $hourToSeconds       = ($hour * 60) * 60;
                $minsToSeconds       = ($mins * 60);

                # tally seconds
                $totalSeconds        = ($hourToSeconds + $minsToSeconds + $secs);
                
            }

            return $totalSeconds;
            
        }
        
        
        /**
         *  @name       time_timeToMinutes
         *  @desc       Takes a time value and converts it to minutes
         *  @return     numeric / string
         * 
         **/
        
        public function time_timeToMinutes($argument = FALSE) {
            
            if (func_num_args() == 0) {

                list($hour, $mins, $secs) = explode(":", date('H:i:s'));

                $hourToMinutes       = ($hour * 60);
                
                // tally minutes
                $totalMinutes        = ($hourToMinutes + $mins);
                
            } else {

                list($hour, $mins, $secs) = explode(":", $argument);

                $hourToMinutes       = ($hour * 60);
                
                // tally minutes
                $totalMinutes        = ($hourToMinutes + $mins);
                
            }

            return $totalMinutes;
            
        }
        
        /**
         *  @name       time_showDate
         *  @desc       Takes a date/timestamp and separates the date
         *  @return     string
         * 
         **/
        
        public function time_showDate($argument =  false) {

            if (func_num_args() == 0) {

                // use current date
                return date('Y-m-d');
        
            } else {

                if (sizeof(explode(" ", $argument)) > 2) {

                    // not a properly formatted date
                    return false;
            
                } elseif (sizeof(explode(" ", $argument)) == 2) {

                    // date and time stamp in use
                    list($date, $time) = explode(" ", $argument);

                    return $date;
                    
                } else {
                    
                    return $argument;
                    
                }
                
            }
        
	}
        
        /**
         *  @name       time_showDate
         *  @desc       Takes a date/timestamp and separates the date
         *  @return     string
         * 
         **/
        public function time_showDateFormat($argument, $format = false) {
            
            if (func_num_args() == 1) {

                $output     =   date('F d, Y', $this->time_toEpoch($argument));
                return $output;
                
            } elseif (func_num_args() == 2) {
                
                $output     =   date($format, $this->time_toEpoch($argument));
                return $output;
                
            }
            
        }
        
        /**
         *  @name       time_showDate
         *  @desc       Takes a date/timestamp and separates the date
         *  @return     string
         * 
         **/
        public function time_showDateShortFormat($argument, $format = false) {
            
            if (func_num_args() == 1) {

                $output     =   date('M d, Y', $this->time_toEpoch($argument));
                return $output;
                
            } elseif (func_num_args() == 2) {
                
                $output     =   date($format, $this->time_toEpoch($argument));
                return $output;
                
            }
            
        }
        
        /**
         *  @name       time_showTime
         *  @desc       Takes a date/timestamp and separates the time
         *  @return     string
         * 
         **/
        
        public function time_showTime($argument = FALSE) {
            
            if (func_num_args() == 0) {

                // use current date
                return date('H:i:s');
        
            } else {

                if (sizeof(explode(" ", $argument)) > 2) {

                    // not a properly formatted date
                    return FALSE;
            
                } elseif (sizeof(explode(" ", $argument)) == 2) {

                    // date and time stamp in use
                    list($date, $time) = explode(" ", $argument);

                    return $time;
                    
                } else {
                    
                    return $argument;
                    
                }
                
            }
            
        }
        
       
        public function time_showRegularTime( $argument = FALSE ) {
            
            if ( func_num_args() === 0 ) : # no arguments
                
                return date('H:ia');
                
            else: 
                
                $datetime   =   explode( " ", $argument );
            
                if ( sizeof( $datetime ) > 1 ) :  # date time stamp provided
                    
                    $time   =   explode(":", $datetime[1] );
                    
                else : # only time provided    
                    
                    $time   =   explode(":", $datetime[0] );
                    
                endif;
                
                # if after exploding time, size of array is not equal to 3, then time is invalid
                if ( sizeof( $time ) != 3 ) :
                    
                    return NULL;
                
                else:
                    
                    $timeFormat     =   date('h:i a', mktime( $time[0], $time[1], $time[2], 0, 0, 0) );
                
                    return $timeFormat;
                    
                endif;
                
                
            endif;
            
        }
        
        public function time_showTimeFormat($argument = FALSE) {
            
            if (func_num_args() == 0) :

                // use current date
                return date('H:i:s');
        
            elseif ( func_num_args() > 0 ) :

                if ( sizeof(explode(" ", $argument)) > 2) :

                    // not a properly formatted date
                    return FALSE;
            
                elseif (sizeof(explode(" ", $argument)) == 2) :

                    // date and time stamp in use
                    list($date, $time)  =   explode(" ", $argument);

                    list($h, $m, $s)    =   explode(':', $time);
                    
                    $returnTime         =   date('h:i a', mktime($h, $m, $s, 0, 0, 0));
                    
                    return $returnTime;
                    
                else :
                    
                    return $argument;
                    
                endif;
                
            endif;
            
        }
        
       
        
        /**
         *  @name       time_dateTimeDiff
         *  @desc       Takes a two time values and calculates differences in seconds
         *  @param      DATETIME argument1 (mandatory) / time value eg. 00:00:00
         *  @param      DATETIME argument2 (optional)  / time value eg. 00:00:00
         *  @return     integer
         * 
         */
        
        public function time_dateTimeDiff($MandatoryDate, $OptionalDate = FALSE) {
            
            $mandDate   =   new DateTime( $MandatoryDate );
            
            if ( empty($OptionalDate) ) :
                
                $optDate = new DateTime( date('Y-m-d H:i:s') );
            
            else:
            
                $optDate = new DateTime( $OptionalDate );
                
            endif;
            
            $results    =   $mandDate->diff($optDate); //->format('%m months, %d days');
            
            $setSendResults         =       array();
            
            # setup output for year
            if ($results->format('%y') > 0) :
                
                $total       =  $results->format('%y');
                $setSendResults['years']     =   $total;
                
            endif;
            
            # setup output for month
            if ($results->format('%m') > 0) :
                
                $total       =  $results->format('%m');
                $setSendResults['months']     =   $total;
                
            endif;
            
            # setup output for days
            if ($results->format('%d') > 0) :
                
                $total       =  $results->format('%d');
                $setSendResults['days']     =   $total;
                
            endif;
            
            # setup output for hours
            if ($results->format('%H') > 0) :
                
                $total       =  $results->format('%H');
                $setSendResults['hours']     =   $total;
                
            endif;
            
            # setup output for minutes
            if ($results->format('%i') > 0) :
                
                $total       =  $results->format('%i');
                $setSendResults['minutes']     =   $total;
                
            endif;
            
            # setup output for seconds
            if ($results->format('%s') > 0) :
                
                $total       =  $results->format('%s');
                $setSendResults['seconds']     =   $total;
                
            endif;
            
            return $setSendResults;
            
        }
        
        
        /**
         *  @name       time_dayMonth
         *  @desc       Isolates the day and month from a complete date if the date is passed
         *              as an argument. Otherwise the day and month is isolated from the current
         *              system month.
         *  @param      Accepts one optional argument (can be date/time value or date value)
         *  @return     integer
         * 
         **/
        
        public function time_dayMonth($argument = false) {
            
            if (func_num_args() == 0) {
            
                list ($year, $month, $day)      =       explode('-', $this->time_showDate());
                
            } else {
                
                list ($year, $month, $day)      =       explode('-', $this->time_showDate($argument));
                
            }    
            
            // return month and year
            $output     =   $day .'-'. $month;
            
            return $output;
            
        }
        
        /**
         *  @name       time_monthYear
         *  @desc       Isolates the month and year from a complete date if the date is passed
         *              as an argument. Otherwise the month and year is isolated from the current
         *              system month.
         *  @param      Accepts one optional argument (can be date/time value or date value)
         *  @return     integer
         * 
         **/
        public function time_monthYear($argument = false) {
            
            if (func_num_args() == 0) {
            
                list ($year, $month, $day)      =       explode('-', $this->time_showDate());
                
            } else {
                
                list ($year, $month, $day)      =       explode('-', $this->time_showDate($argument));
                
            }    
            
            // return month and year
            $output     =   $month .'-'. $year;
            
            return $output;
            
        }
        
        /**
         *  @name       time_totalDaysInMonth
         *  @desc       Determines the total days in a month of the year. The total days
         *              for the current month is returned by default if no arguments are
         *              presented.  Otherwise, the total days for the month argument 
         *              provided will be returned.
         *  @param      Accepts one optional argument (can be date/time value or date value)
         *  @return     integer
         * 
         **/
        
        public function time_totalDaysInMonth($argument = false) {
            
            if (func_num_args() == 0) {
		
                $output		=		date('t');
		
            } else {
		
		// argument must be in date format (0000-00-00) 
		list($year, $month, $day)   =	explode('-', $this->time_showDate($argument));
                $output         =		date('t', mktime(0,0,0, $month, $day, $year));
		
            }
	
            return $output;
            
        }
        
        /**
         *  @name       time_daysLeftInMonth
         *  @desc       Only works for current month. Determines total days in the
         *              current month and then determines the current day. It subtracts
         *              the current day from the total amount of days.
         *  @return     integer
         * 
         **/
        
        public function time_daysLeftInMonth() {
            
            $totalDays          =       $this->time_totalDaysInMonth();
            $currentDay         =       $this->time_currentDay();
            
            $output             =       intval($totalDays - $currentDay);
            
            return $output;
            
        }
        
        /**
         *  @name       time_currentMonth
         *  @desc       Determines the current month of the year.  Month is return with
         *              a numeric value, leading zero (eg. 01, 02, 03, 04) etc.
         *  @param      Accepts one optional argument (1 - Full Month, 2 for Abbr Month,
         *                                             3 - For numeric with no leading zero)            
         *  @return     integer
         * 
         **/
        
        public function time_monthsLeftInYear() {
          
            $output     =   intval(12 - $this->time_currentMonth());
            
            return $output;
            
        }  
        
        /**
         *  @name       time_currentMonth
         *  @desc       Determines the current month of the year.  Month is return with
         *              a numeric value, leading zero (eg. 01, 02, 03, 04) etc.
         *  @param      Accepts one optional argument (1 - Full Month, 2 for Abbr Month,
         *                                             3 - For numeric with no leading zero)            
         *  @return     integer
         * 
         **/
        
        public function time_currentMonth($argument = false) {
            
            if (func_num_args() == 0) {
                
                $output         =       date('m');
                
            } else {
                
                if ($argument == 1) {
                    
                    $output         =       date('F');
                    
                } elseif ($argument == 2) {
                    
                    $output         =       date('M');
                    
                } elseif ($argument == 3) {
                    
                    $output         =       date('n');
                    
                } 
                
            }
            
            return $output;
                    
        }
        
        /**
         *  @name       time_currentDay
         *  @desc       Determines the current day of the year.  Day is return with
         *              a numeric value, leading zero (eg. 01, 02, 03, 04) etc.
         *  @param      Accepts one optional argument (1 - Full Day, 2 for Abbr Day,
         *                                             3 - For numeric Day without leading zero)            
         *  @return     integer
         * 
         **/
        
        public function time_currentDay($argument = false) {
            
            if (func_num_args() == 0) {
                
                $output         =       date('d');
                
            } else {
                
                if ($argument == 1) {
                    
                    $output         =       date('l');
                    
                } elseif ($argument == 2) {
                    
                    $output         =       date('D');
                    
                } elseif ($argument == 3) {
                    
                    $output         =       date('j');
                    
                } 
                
            }
            
            return $output;
                    
        }
        
        /**
         *  @name       time_lastMonth
         *  @desc       Determines the current month of the year and then subtracts one month
         *              to it.  Returns last month based on current day if no argument is 
         *              presented
         *  @param      Accepts one optional argument (date/time value or date value)
         *  @return     date
         * 
         **/
        
        public function time_lastMonth($argument = false) {
            
            if (func_num_args() == 0) {
            
                list ($year, $month, $day)      =       explode('-', $this->time_showDate());
                
            } else {
                
                list ($year, $month, $day)      =       explode('-', $this->time_showDate($argument));
                
            }
            
            if ($day >= 28) {
            
                // if the day of the current month is greater than 28
                // check to see if the last month has more than 28 days in it.
                
                if ($month == 1) {
                    
                    $lastMonth  =   12;
                    
                } else {
                    
                    $lastMonth  =   intval($month - 1);
                    
                }  
                
                //get the total amount of days for the next month
                $totalLastMonthDays = $this->time_daysInMonths[$lastMonth];
                
                if ($day > $totalLastMonthDays) {
                    
                    $day = $totalLastMonthDays;
                    
                }
                
                // setup date
                $output     =       date('Y-m-d', mktime(0,0,0, ($month - 1), $day, $year));
                
            } else {
                
                // setup date
                $output     =       date('Y-m-d', mktime(0,0,0, ($month - 1), $day, $year));
            
            }
            
            return $output;
            
        }
        
        /**
         *  @name       time_nextMonth
         *  @desc       Determines the current month of the year and then adds one month
         *              to it.  Returns next month based on current day if no argument is 
         *              presented
         *  @param      Accepts one optional argument (date/time value or date value)
         *  @return     date
         * 
         **/
        
        public function time_nextMonth($argument = false) {
            
            if (func_num_args() == 0) {
            
                list ($year, $month, $day)      =       explode('-', $this->time_showDate());
                
            } else {
                
                list ($year, $month, $day)      =       explode('-', $this->time_showDate($argument));
                
            }
            
            if ($day >= 28) {
            
                // if the day of the current month is greater than 28
                // check to see if the next month has more than 28 days in it.
                
                if ($month == 12) {
                    
                    $nextMonth  =   1;
                    
                } else {
                    
                    $nextMonth  =   intval($month + 1);
                    
                }  
                
                //get the total amount of days for the next month
                $totalNextMonthDays = $this->time_daysInMonths[$nextMonth];
                
                if ($day > $totalNextMonthDays) {
                    
                    $day = $totalNextMonthDays;
                    
                }
                
                // setup date
                $output     =       date('Y-m-d', mktime(0,0,0, ($month + 1), $day, $year));
                
            } else {
                
                // setup date
                $output     =       date('Y-m-d', mktime(0,0,0, ($month + 1), $day, $year));
            
            }
            
            return $output;
            
        }
        
        /**
         *  @name       time_daysInYear
         *  @desc       Determines the current day of the year.  Day is return with
         *              a numeric value, leading zero (eg. 01, 02, 03, 04) etc.
         *  @param      Accepts one optional argument (1 - Full Day, 2 for Abbr Day,
         *                                             3 - For numeric Day without leading zero)            
         *  @return     integer
         * 
         **/
        
        public function time_daysInYear() {
            
            if (date('L') == 1) :
                
                // it is a leap year
                $output     =   366;
                
            else :
                
                $output     =   365;
                
            endif;
            
            return $output;
            
        }
        
        /**
         *  @name       time_daysLeftInYear
         *  @desc       Determines if the current year is a leap year, then 
         *              determines the current day.  Subtracts the current day 
         *              from 366 or 365 days to get results
         *  @return     integer
         * 
         **/
        
        public function time_daysLeftInYear() {
            
            $output             =   intval($this->time_daysInYear() - date('z'));
            
            return $output;
            
        }
        
        /**
         *  @name       time_dayOfWeek
         *  @desc       Determines if the current year is a leap year, then 
         *              determines the current day.  Subtracts the current day 
         *              from 366 or 365 days to get results
         *  @return     integer
         * 
         **/
        
        public function time_dayOfWeek($argument = FALSE) {
            
            if (func_num_args() == 0) :
                
                # if no argument is passed, return default
                $output         =       date('w');
                
            else :
                
                # argument map -   1: Full Day, 2: Abbr Day (Mon, Tue, Wed)
                if ($argument == 1) :
                    
                    //$output     =       $this->time_dayMap[date('w')];
                    $output     =       date('l');
                    
                else :
                    
                 //   $output     =       substr($this->time_dayMap[date('D')], 0, 3);
                    $output     =       date('D');
                    
                endif;
                
            endif;
            
            return $output;
            
        }
        
        /**
         *  @name       time_daysLeftInWeek
         *  @desc       Determines the current day of the week then subtracts
         *              from seven to determine days left in week.
         *  @return     integer
         * 
         **/
        
        public function time_daysLeftInWeek() {
            
            $output     =   intval(7 - $this->time_dayOfWeek());
            
            return $output;
            
        }
        
    }
    
/** 
 * End of TimeLibrary File
 * libraries/TimeLibrary.php
 */ 