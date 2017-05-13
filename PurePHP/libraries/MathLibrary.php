<?php

    /**
     * @name    Framework Math Class
     * @author  Vincent Rahming <vincentrahming@gmail.com>
     * @desc    Responsible for handling mathematical processes for Framework
     * @since   July 9th, 2013
     */

    class MathLibrary extends Controller {
        
        public function __construct() {        
            parent::__construct();            
        }
    
        /**
         *  @name   Math_Add
         *  @param  MIXED/STRING $argument
         *  @desc   Accepts a comma delimited string or an array of values and calculates the sum value of all numbers when added together
         *  @return INT $output
         * 
         **/
        public function math_add( $argument ) {
            
            # if argument is a comma delimited string, pass values into an array
            if ( is_string( $argument ) ) :
                
                $addValues      =   explode(",", trim($argument, ","));
                
                # set result value to zero
                $result         =   0;
                
                # process add values
                foreach ($addValues as $value) :
                    
                    # increment result value
                    $result     =   ($result + $value);
                    
                endforeach;
                
                $output         =   $result;
                
            endif;
            
            # if argument is an array, process 
            if (is_array($argument)) :
                
                // set result value to zero
                $result         =   0;
                
                // process add values
                foreach($argument as $value) :
                    
                    // increment result value
                    $result     =   ($result + $value);
                    
                endforeach;
                
                $output         =   $result;
                
            endif;
            
            return $output;
            
        }
        
        /**
         *  @name   Math_Subtract
         *  @param  MIXED/STRING $argument
         *  @desc   Accepts a comma delimited string or an array of values and calculates the value of numbers.  It uses the first number in the array/string as the base value
         *  @return INT $output
         **/
        public function math_subtract($argument) {
            
            # if argument is a comma delimited string, pass values into an array
            if (is_string($argument)) :
                
                $addValues      =   explode(",", trim($argument, ","));
                
                # set first/base result value to zero
                $cycle         =   0;
                
                # process add values
                foreach ($addValues as $value) :
                    
                    if ($cycle == 0) :
                        
                        # first number to use in equation
                        $result   =   $value;
                        
                    else :
                    
                        # increment result value
                        $result     =   ($result - $value);
                        
                    endif;
                    
                    # increment cycle
                    $cycle++;
                    
                endforeach;
                
                $output         =   $result;
                
            endif;
            
            # if argument is an array, process 
            if (is_array($argument)) :
                
                # set first/base result value to zero
                $cycle         =   0;
                
                # process add values
                foreach($argument as $value) :
                    
                    if ($cycle == 0) :
                        
                        # first number to use in equation
                        $result   =   $value;
                        
                    else :
                    
                        # increment result value
                        $result     =   ($result - $value);
                        
                    endif;
                    
                    # increment cycle
                    ++$cycle;
                    
                endforeach;
                
                $output         =   $result;
                
            endif;
            
            return $output;
            
        }
        
        /**
         *  @name  Math_Product
         *  @param MIXED/STRING $argument Comma Delimited String Or Array
         *  @desc  Accepts a comma delimited string or an array of values and multiples them it uses the first number in the array/string as the base value
         *  @return INT $outupt;
         **/
        public function math_product( $argument) {
            
            # if argument is a comma delimited string, pass values into an array
            if (is_string($argument)) :
                
                $addValues      =   explode(",", trim($argument, ","));
                
                # set first/base result value to zero
                $cycle         =   0;
                
                # process add values
                foreach ($addValues as $value) :
                    
                    if ($cycle == 0) :
                        
                        # first number to use in equation
                        $result   =   $value;
                        
                    else :
                    
                        # increment result value
                        $result     =   ($result * $value);
                        
                    endif;
                    
                    # increment cycle
                    $cycle++;
                    
                endforeach;
                
                $output         =   $result;
                
            endif;
            
            # if argument is an array, process 
            if (is_array($argument)) :
                
                # set first/base result value to zero
                $cycle         =   0;
                
                # process add values
                foreach($argument as $value) :
                    
                    if ($cycle == 0) :
                        
                        # first number to use in equation
                        $result   =   $value;
                        
                    else :
                    
                        # increment result value
                        $result     =   ($result * $value);
                        
                    endif;
                    
                    # increment cycle
                    $cycle++;
                    
                endforeach;
                
                $output         =   $result;
                
            endif;
            
            return $output;
            
        }
        
        /**
         *  @name   Math_Divide
         *  @param  INT $argument1
         *  @param  INT $argument2
         *  @desc   Accepts a two values and then divides
         *  @return INT $output
         * 
         **/
        public function math_divide($argument1, $argument2) {
            
            # base number is $argument2
            # top number is $argument1
            $result     =   ($argument1 / $argument2);
            $output     =   $result;
            return $output;
            
        }
        
        /**
         *  @name   Math_Absolute
         *  @param  INT $argument 
         *  @desc   Accepts a signed integer and returns and absolute value
         *  @return INT $output
         * 
         **/
        public function math_absolute($argument) {
            
            // returns the absolute value of number
            $output     =   abs($argument);
            
            return $output;
            
        }
        
        /**
         *  @name       Math_Percentage
         *  @desc       Calculates percentage of two values (top/base) * 100 - aka traditional
         *              Calculates requested percentage of a base value alone
         *  @return     double
         * 
         **/
        public function math_percentage($argument1, $argument2, $argument3) {
    
            # determines the implementation and then acts accordingly
            if ($argument1 == 1) :
                
                # if option is equal to one, calculate traditional percentage
                # argument 2 = base/denominator
                # argument 3 = top/numerator
                
                $result     =       (($argument3 / $argument2) * 100);
                $output     =       $result;
                
            elseif ($argument1 == 2) :
                
                # if option is equal to two, calculate requested percentage
                # argument 2 = base/denominator
                # argument 3 = requested percentage amount
                
                $result     =       ($argument2 * ($argument3 / 100));
                $output     =       $result;
                
            endif;
            
            return $output;
            
        }
        
        /**
         *  @name   Math_Mean
         *  @param  MIXED/STRING $argument Array or Comma Delimited String
         *  @desc   Calculates average of two or more values  Accepts values in an Array or in a String
         *  @return INT/DOUBLE $output;
         **/            
        public function math_mean($argument) {
            
            # if argument is a comma delimited string, pass values into an array
            if (is_string($argument)) :
                
                $addValues      =   explode(",", trim($argument, ","));
                
                # set result value to zero
                $result         =   0;
                
                # process add values
                foreach ($addValues as $value) :
                    
                    # increment result value
                    $result     =   ($result + $value);
                    
                endforeach;
                
                # determine the amount to average results by
                $valueCount     =   sizeof($addValues);
                
                $output         =   ($result/$valueCount);
                
            endif;
            
            # if argument is an array, process 
            if (is_array($argument)) :
                
                # set result value to zero
                $result         =   0;
                
                # process add values
                foreach($argument as $value) :
                    
                    # increment result value
                    $result     =   ($result + $value);
                    
                endforeach;
                
                $valueCount     =   sizeof($argument);
                
                $output         =   ($result/$valueCount);
                
            endif;
            
            return $output;
            
        }
        
        /**
         *  @name   Math_Median
         *  @desc   Determines the middle number in a set of numbers
         *  @return integer
         * 
         **/      
        public function math_median($argument) {
            
            // if argument is a comma delimited string, pass values into an array
            if (is_string($argument)) {
                
                $setValues      =   explode(",", trim($argument, ","));
                
                $holdValues     =   array();
                
                // process add values
                foreach ($setValues as $singleValue) {
                    
                    // increment result value
                    array_push($holdValues, $singleValue);
                    
                }
                
                // sort array, use SORT_NUMERIC flag
                sort($holdValues, SORT_NUMERIC);
                
                
                // determine size of array
                $medianPos      =   $this->math_divide($this->math_add(array(sizeof($holdValues), 1)), 2);
                
                if ($medianPos % 2) {
                
                    $priValue   =   $holdValues[$this->math_floor($medianPos)];
                    $secValue   =   $holdValues[$this->math_ceil($medianPos)];
                    
                    
                    $output     =   $this->math_mean(array($priValue, $secValue));                    
                    
                } else {
                    
                    $output     =    $holdValues[$medianPos];
                    
                }
                
                //return $medianPos;
                
            }
            
            // if argument is an array, process 
            if (is_array($argument)) {
                
                // set result value to zero
                $result         =   0;
                
                // process add values
                foreach($argument as $value) {
                    
                    // increment result value
                    $result     =   ($result + $value);
                    
                }
                
                $valueCount     =   sizeof($argument);
                
                $output         =   ($result/$valueCount);
                
            }
            
            return $output;            
            
        }
        
        /**
         *  @name       math_mode
         *  @desc       Calculates percentage of two values (top/base) * 100 - aka traditional
         *              Calculates requested percentage of a base value alone
         *  @return     double
         * 
         **/            
        public function math_mode() {
            
        }
        
        /**
         *  @name       math_cosine
         *  @desc       Calculates percentage of two values (top/base) * 100 - aka traditional
         *              Calculates requested percentage of a base value alone
         *  @return     double
         * 
         **/            
        public function math_cos($argument) {
            
            return cos($argument);            
            
        }
        
        /**
         *  @name       math_sine
         *  @desc       Calculates percentage of two values (top/base) * 100 - aka traditional
         *              Calculates requested percentage of a base value alone
         *  @return     double
         * 
         **/            
        public function math_sin($argument) {
            
            return sin($argument);            
            
        }
        
        /**
         *  @name       math_tangent
         *  @desc       Calculates percentage of two values (top/base) * 100 - aka traditional
         *              Calculates requested percentage of a base value alone
         *  @return     double
         * 
         **/            
        public function math_tan($argument) {
           
            return tan($argument);            
            
        }
        
        /**
         *  @name       math_power
         *  @desc       Calculates percentage of two values (top/base) * 100 - aka traditional
         *              Calculates requested percentage of a base value alone
         *  @return     double
         * 
         **/            
        public function math_power($argument1, $argument2) {
            
            return pow($argument1, $argument2);
            
        }
        
        /**
         *  @name       math_exponent
         *  @desc       Calculates percentage of two values (top/base) * 100 - aka traditional
         *              Calculates requested percentage of a base value alone
         *  @return     double
         * 
         **/            
        public function math_exp($argument) {
            
            return exp($argument);
            
        }
        
        /**
         *  @name       math_squareroot
         *  @desc       Determines the Square Root of a value.
         *  @return     double
         * 
         **/            
        public function math_sqrt($argument) {
         
            // ensure absolute value is used
            $absValue   =   $this->math_absolute($argument);
            
            // determine square root of number
            $result     =   sqrt($absValue);
            
            $output     =   $result;
            return $output;
            
        }
        
        /**
         *  @name       math_pi
         *  @desc       Returns the pi value
         *  @return     float
         * 
         **/            
        public function math_pi() {
            
            $output     =   pi();
            return $output;
            
        }
        
        /**
         *  @name       math_floor
         *  @desc       Determines the floor value and returns it
         *  @return     integer
         * 
         **/            
        public function math_floor($argument) {
            
            $output     =   floor($argument);
            return $output;
            
        }
        
        /**
         *  @name       math_ceil
         *  @desc       Determines the ceiling value and returns it
         *  @return     integer
         * 
         **/            
        public function math_ceil($argument) {
            
            $output     =   ceil($argument);
            return $output;
            
        }
        
    }
    
/** 
 * End of MathLibrary File
 * libraries/MathLibrary.php
 */     