<?php

include_once('../conf/config.php');
ini_set('session.use_trans_sid', 1);

class Admin {

    // This will hold the PDO object.
    protected $sql;
    // This is the connection details for the database where you store your messages.     
    private $config;

    public function __construct() {

        $this->config = new Config();

        // Try to connect to the SQL database
        try {
            $sql = new PDO(
                    $this->config->DB_TYPE . ':' .
                    'host=' . $this->config->DB_HOST .
                    ';port=' . $this->config->DB_PORT .
                    ';dbname=' . $this->config->DB_DATABASE .
                    ';charset=' . $this->config->DB_CHARSET, $this->config->DB_USER, $this->config->DB_PASSWORD, array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES "utf8"',
                PDO::ATTR_EMULATE_PREPARES => false
                    )
            );

            $this->sql = $sql;

            $this->sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $pe) {
            die($this->lang['core']['classes']['core']['mysql_error']);
        }

        session_start();

        if (!empty($_POST['request'])) {
            $this->delete($_POST['request']);
        }
    }

    private function delete($request) {

        $sqlstmt = '';
        $checkvalue = null;
        switch ($request) {
            case "clear_data_all":
                $sqlstmt = 'DELETE FROM `chat`';
                break;
            case "clear_data_user":
                $sqlstmt = 'DELETE FROM `chat` WHERE `by` = :checkvalue';
                $checkvalue = $_POST["user"];
                break;

            case "clear_data_last":
                $sqlstmt = 'DELETE FROM `chat` LIMIT :checkvalue ';
                $checkvalue = $_POST["n"];
                break;
        }

        if ($sqlstmt != '') {
            $stmt = $this->sql->prepare($sqlstmt);
            $stmt->bindValue(':checkvalue', $checkvalue, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();
            header('Location: ../index.php');
        }
    }

}
$admin = new Admin();
?>