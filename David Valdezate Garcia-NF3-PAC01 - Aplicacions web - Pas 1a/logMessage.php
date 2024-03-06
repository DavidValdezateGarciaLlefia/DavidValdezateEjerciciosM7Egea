<?php

const DEBUG = 100;
const INFO = 75;
const NOTICE = 50;
const WARNING = 25;
const ERROR = 10;
const CRITICAL = 5;

function levelToString($loglevel){
    switch($loglevel){
        case DEBUG:
            return 'DEBUG';
            break;
        case INFO:
            return 'INFO';
            break;
        case NOTICE:
            return 'NOTICE';
            break;
        case WARNING:
            return 'WARNING';
            break;
        case ERROR:
            return 'ERROR';
            break;
        case CRITICAL:
            return 'CRITICAL';
            break;
        default:
            return '[NOLEVEL]';
            break;
    }
}

function logMessage($message, $loglevel){

    $LOGLEVEL = 100;
    if($loglevel<=$LOGLEVEL){
        $LOGDIR = 'tmp/';
        $logname = $LOGDIR .'registerLogMessagePHP.log';

        $file = fopen($logname, 'a+');

        if(!is_resource($file)){
            printf("No se puede abrir el fichero %s", $logname);
            return false;
        }

        date_default_timezone_set('America/New_York');
        $formatterDate = DateTimeImmutable::createFromFormat('U',time());
        $time = $formatterDate->format('Y-m-d H:i:s');

        $message = str_replace("\t","", $message);
        $message = str_replace("\n","", $message);


        $loglevel = levelToString($loglevel);

        $message = $time."\t". $loglevel ."\t".$message."\n";

        fwrite($file, $message);
        fclose($file);
        return true;
    }else{
        return false;
    }
    



}

