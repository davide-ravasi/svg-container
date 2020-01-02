<?php
class Log {
    private $logPrefix = 'log_';
    private $logExt = '.txt';
    private $handle;
    private $msg;
    private $date;
    private $user;
    private $mode = 'a';
    private $logLocation = '../admin/logs/';
 
    public function __construct($msg) {
        $this->msg = $msg;
        $this->date = date("Y-m-d", time());
        $this->user = isset($_SESSION['username']) ? $_SESSION['username'] : '';
        $this->handle = fopen($this->logLocation.$this->logPrefix.$this->date.$this->logExt,$this->mode);
              
        if(!$this->handle) {
            throw new Exception('can\'t open log file');
        }
        
        fwrite($this->handle, '['.date("Y/m/d h:i:s", time()).'] by '.$this->user.' : '.$this->msg.PHP_EOL);               
    }
    
    public function __destruct() {
         fclose($this->handle);
    }
}
?>