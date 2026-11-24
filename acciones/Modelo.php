<?php
require_once 'config.php';
/*define('DB_HOST','127.0.0.1:3307');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_NAME','rh');
define('DB_CHARSET','utf-8'); */
class Modelo{
        protected $_db;
        public function __construct(){
                $this->_db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                if ( $this->_db->connect_errno ){
                    echo "Fallo al conectar a MySQL ". $this->_db->connect_error;
                    return;
                }
                //  $this->_db->set_charset('utf-8');
                $this->_db->query("SET NAMES UTF8");
        }
        protected function desconectar(){
                mysqli_close ($this->_db);
        }
}
?>  