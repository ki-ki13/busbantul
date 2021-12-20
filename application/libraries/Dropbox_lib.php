<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxApp;
use Kunnu\Dropbox\DropboxFile;

class DropBox_lib{
    public $drop_object;
    public $drop_file;
    public $drop_mode;
    
    public function __construct()
    {
        require './vendor/autoload.php';

        //Configure Dropbox Application
        $app = new DropboxApp("kunci", "kunci", "kunci");

        //Configure Dropbox service
        $this->drop_object = new Dropbox($app);
    }

    public function set_mode_file($mode){
        if($mode == 1){
            $mode = DropboxFile::MODE_READ;
            $this->drop_mode = $mode;
        }else{
            $mode = DropboxFile::MODE_READ;
            $this->drop_mode = $mode;
        }
    }

    public function set_drop_file($pathlocal){
        $dropboxFile = new DropboxFile($pathlocal, $this->drop_mode);
        $this->drop_file = $dropboxFile;
    }
}

?>
