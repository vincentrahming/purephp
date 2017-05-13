<?php

    /**
     * @name    Bean Stalk Framework Image Processing Class
     * @author  Vincent Rahming <vincentrahming@gmail.com>
     * @desc    Responsible for handling image related processes for Framework
     * @since   July 9th, 2013
     */
    class ImageLibrary extends Controller {
        
        public function __construct() {
            parent::__construct();
        }
        
        /**
         * 
         * @param STRING $setImage
         * @param INT $setTarget
         * @param MIXED $setExtras
         * @param STRING $setPath
         * @return string
         */
        public function scale_image($setImage = FALSE, $setTarget, $setExtras = FALSE, $setPath = FALSE) {
            
            if ( sizeof( @getimagesize( $setImage ) ) == 1) :
                
                $setImage  =   _URL_PATH . IMGS_PATH . 'nophoto.png';
                
            endif;
            
            if ( empty( $setImage ) ) :
                
                $setImage  =   _URL_PATH . IMGS_PATH . 'nophoto.png';
            
            endif;
            
            list($imgWidth, $imgHeight, $imgAtt)  =   getimagesize($setImage);
            
            $this->setTarget = $setTarget;
            $this->setAttrib = $imgAtt;
            
            if ($imgWidth > $this->setTarget) :
                
                # if width exceeds target, scale by calculated percentate
                $scaleBy   =	($this->setTarget / $imgWidth);
					
            elseif($imgHeight >	$this->setTarget) :
				
                # if height exceeds target, scale by calculated percentage
                $scaleBy   =	($this->setTarget / $imgWidth);
					
            else :
				
                # else do not scale
                $scaleBy   =	1;
					
            endif;
				
            # set scaled image widths and heights
            $scaleWidth   =    round($imgWidth  * $scaleBy);
            $scaleHeight  =    round($imgHeight * $scaleBy);

            # setup image 
            $output       =    '<img ';
	    $output	 .=    ' src    = "'. $setImage .'" ';
            $output	 .=    ' width  = "'. $scaleWidth .'" ';
	    $output	 .=    ' height = "'. $scaleHeight .'" ';
            
            # extras will be include in an associative array
            
            if ( ( !empty( $setExtras ) )  AND ( sizeof( $setExtras )  > 0 ) ):
                
                foreach ($setExtras as $attr => $value) :
                
                    $output    .=   $attr .' = "'. $value .'" ';
                
                endforeach;
                
            endif;
            
	    $output      .=    ' />';
            
            return $output;
            
        }
        
        /**
         * @name Move_File
         * @param type $setSource
         * @param type $setDest
         * @return boolean
         */
        public function move_file($setSource, $setDest) {
            
            # determine if rules are inforced
            if (is_uploaded_file($setSource)) :
                
                # move uploaded file
                move_uploaded_file($setSource, $setDest);
                
            else:
                
                return FALSE;
                
            endif;
            
        }
        
        /**
         * @name Resize_Image
         * @param type $setWidth
         * @param type $setHeight
         * @param type $setSource
         * @param type $setDest
         */
        public function resize_image($setWidth, $setHeight, $setSource, $setDest) {
                    
            $this->imageWidth       =    $setWidth;
            $this->imageHeight      =    $setHeight;
            $this->fetchSizeInfo    =    getimagesize($setSource);                
    
            if ($this->fetchSizeInfo[0] >= $this->fetchSizeInfo[1]) : 
            
                $setOrientation     =   0;
                    
            else :
                    
                $setOrientation     =   1;
                $this->imageHeight  =   $setHeight;
                $this->imageWidth   =   $setWidth;
                     
            endif;

            
            if (($this->fetchSizeInfo[0] > $this->imageWidth) || ($this->fetchSizeInfo[1] > $this->imageHeight)) :
                        
                if (($this->fetchSizeInfo[0] - $this->imageWidth) >= ($this->fetchSizeInfo[1] - $this->imageHeight)) :
                      
                    $iw = $this->imageWidth;
                    $ih = ($this->imageWidth / $this->fetchSizeInfo[0]) * $this->fetchSizeInfo[1];
                      
                else : 
                      
                    $ih = $this->imageHeight;
                    $iw = ( $ih / $this->fetchSizeInfo[1] ) * $this->fetchSizeInfo[0];
                      
                endif;
                      
                $t = 1;
                      
            else:
                        
                $iw = $this->fetchSizeInfo[0];
                $ih = $this->fetchSizeInfo[1];
                $t = 2;
                        
            endif;
                    
            ini_set('memory_limit', '100M');
                    
            if ($t == 1) :
                    	
                if (($this->fetchSizeInfo['mime'] == "image/pjpeg") || ($this->fetchSizeInfo['mime'] == "image/jpeg")) :
						
                    $source =  imagecreatefromjpeg($setSource);
						
		elseif (($this->fetchSizeInfo['mime'] == "image/x-png") || ($this->fetchSizeInfo['mime'] == "image/png")) :
						
                    $source = imagecreatefrompng($setSource);
						
		elseif ($this->fetchSizeInfo['mime'] == "image/gif") :
						
                    $source = imagecreatefromgif($setSource);
						
		endif;
                    	
		$destination = imagecreatetruecolor($iw, $ih);
                
                imagecopyresampled($destination, $source, 0, 0, 0, 0, $iw, $ih, $this->fetchSizeInfo[0], $this->fetchSizeInfo[1]);
                 
                if (!imagejpeg($destination, $setDest, 100)) :
                    
                    exit();
                
                endif;
                        
            elseif ( $t == 2 ) :
                        
                copy($setSource, $setDest);
                        
            endif;
                    
          }
        
    }

/** 
 * End of ImageLibrary File
 * libraries/ImageLibrary.php
 */ 