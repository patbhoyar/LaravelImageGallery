<?php

//class ERROR_ENUM Extends SplEnum{
//    const __default = self::LOGIN;
//    
//    const LOGIN = 'You must be logged on to continue!';
//    const NOALBUMACCESS = 'Sorry, You do not have access to the requested Album!';
//}
//
//class Position Extends SplEnum{
//    const __default = self::TOP;
//    
//    const TOP = 'top';
//    const MIDDLE = 'middle';
//    const BOTTOM = 'bottom';
//}

class ENG{
    static $ERROR = array(
        'LOGIN'             =>  'You must be logged on to continue!',
        'NOALBUMACCESS'     =>  'Sorry, You do not have access to the requested Album!',
        'WREMAILPASS'       =>  'Wrong Email, Password!'
    );
    
    static $POSITION = array(
        'TOP'       =>  'top',
        'MIDDLE'    =>  'middle',
        'BOTTOM'    =>  'bottom'
    );
}
    

?>
