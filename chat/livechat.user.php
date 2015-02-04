<?php

include_once('../conf/config.php');
ini_set('session.use_trans_sid', 1);

class User {

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

        if (!empty($_POST["register"]) && $_POST["register"] == true) {
            $this->createUser($_POST["username"], $_POST["password"]);
        }

        if (!empty($_POST["login"]) && $_POST["login"] == true) {
            $this->login($_POST["username"], $_POST["password"]);
        }

        if (!empty($_POST["logout"]) && $_POST["logout"] == true) {
            $this->logout();
        }
    }

    public function createUser($user, $password) {

        $salt = $this->rand_string(10);
        $username = $this->sanitize($user, 'purestring');
        $password = hash('sha256', $this->sanitize($password, 'purestring') . $salt) . $salt;

        $stmt = $this->sql->prepare('INSERT INTO chat_users(`username`, `salt`, `password`) VALUES(:username, :salt, :password)');
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':salt', $salt, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);

        $stmt->execute();

        $stmt->closeCursor();

        echo json_encode(array(
            'status' => true
                )
        );
    }

    private function login($user, $password) {

        $messages = array(
            'LoggedIn' => false
        );

        $username = $this->sanitize($user, 'purestring');

        $stmt = $this->sql->prepare('SELECT salt FROM chat_users WHERE username = :username');
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $salt = null;
        if ($stmt->rowCount() > 0) {

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $salt = $row['salt'];
        }

        $stmt->closeCursor();

        if ($salt != null) {
            $password = hash('sha256', $this->sanitize($password, 'purestring') . $salt) . $salt;

            $stmt = $this->sql->prepare('SELECT username, userid FROM chat_users WHERE username = :username AND password = :password');
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->bindValue(':password', $password, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $messages['LoggedIn'] = true;
                $_SESSION['username'] = $row['username'];
                $_SESSION['userid'] = $row['userid'];
                $_SESSION['LoggedIn'] = 1;
            } else {
                $_SESSION['username'] = null;
                $_SESSION['userid'] = null;
                $_SESSION['LoggedIn'] = 0;
                unset($_SESSION["chat"]);
            }
            $stmt->closeCursor();
        }
        echo json_encode($messages);
        exit;
    }

    private function logout() {
        $messages = array(
            'LoggedIn' => true
        );
        $_SESSION['username'] = null;
        $_SESSION['userid'] = null;
        $_SESSION['LoggedIn'] = 0;
        unset($_SESSION["chat"]);
        $messages['LoggedIn'] = false;
        echo json_encode($messages);
        exit;
    }

    /* random string */

    private function rand_string($length) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $size = strlen($chars);
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $size - 1)];
        }
        return $str;
    }

    /**
     * Value sanitation. Sanitize input and output with ease using one of the sanitation types below.
     * 
     * @param  string $data the string/value you wish to sanitize
     * @param  string $type the type of sanitation you wish to use.
     * @return string       the sanitized string
     */
    public function sanitize($data, $type = '') {
        ## Use the HTML Purifier, as it help remove malicious scripts and code. ##
        ##       HTML Purifier 4.4.0 - Standards Compliant HTML Filtering       ##
        require_once('htmlpurifier/HTMLPurifier.standalone.php');

        $purifier = new HTMLPurifier();
        $config = HTMLPurifier_Config::createDefault();
        $config->set('Core.Encoding', 'UTF-8');

        // If no type if selected, it will simply run it through the HTML purifier only.
        switch ($type) {
            // Remove HTML tags (can have issues with invalid tags, keep that in mind!)
            case 'purestring':
                $data = strip_tags($data);
                break;

            // Only allow a-z (H & L case)
            case 'atoz':
                $data = preg_replace('/[^a-zA-Z]+/', '', $data);
                break;

            // Integers only - Remove any non 0-9 and use Intval() to make sure it is an integer which comes out.
            case 'integer':
                $data = intval(preg_replace('/[^0-9]+/', '', $data));
                break;
        }

        /* HTML purifier to help prevent XSS in case anything slipped through. */
        $data = $purifier->purify($data);

        return $data;
    }

}

$user = new User();
?>