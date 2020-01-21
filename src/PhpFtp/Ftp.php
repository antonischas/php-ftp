<?php

namespace PhpFtp;

class Ftp {

    private $connection;

    /**
     * Ftp constructor.
     * @param string $host
     * @param string $user
     * @param string $password
     * @param array $options
     */
    public function __construct (string $host, string $user,string $password, Array $options = []){

        $this->connection = ftp_connect($host);

        if(ftp_login($this->connection, $user, $password)){
            ftp_pasv($this->connection, true);
        }else{
            throw new \Error('Invalid connection');
        }

    }

    /**
     * @param string $path
     * @return array|string
     */
    public function fileList($path = '.'){

        $filelist = ftp_nlist($this->connection,$path);

        if(!$filelist){
            return 'Empty or path not found.';
        }

        return $filelist;

    }

    /**
     * @param string $path
     * @return bool
     */
    public function changeDirectory($path = ''){

        return ftp_chdir($this->connection, $path);

    }

    /**
     * @param $localFile
     * @param $remoteFile
     * @param int $mode
     * @return bool
     */
    public function uploadFile($remoteFile, $localFile, $mode = FTP_BINARY){

        return ftp_put($this->connection, $remoteFile, $localFile, $mode);

    }

    /**
     * @param $remoteFile
     * @return bool
     */
    public function deleteFile($remoteFile){

        return ftp_delete($this->connection, $remoteFile);

    }

    /**
     * @param $remoteFile
     * @param string $localFile
     * @param int $mode
     * @return bool|string
     */
    public function getFile($remoteFile, $localFile = '', $mode = FTP_BINARY){


        if($localFile === ''){

            $temp = tmpfile();
            $meta_data = stream_get_meta_data($temp);
            $filename = $meta_data["uri"];

            if(ftp_get($this->connection, $filename, $remoteFile, $mode)){
                return file_get_contents($filename);
            }else{
                return false;
            }

        }else{

            return ftp_get($this->connection, $localFile, $remoteFile, $mode);

        }

    }

    /**
     * @return string
     */
    public function getPath(){

        return ftp_pwd($this->connection);

    }
}