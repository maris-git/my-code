<?
    class User{
        public $id;
        public $username;
        public $password;

        // Authenticate username
        public static function authenticate($conn, $username, $password){
            $sql = "select * from users where username=:username";
            $stmt = $conn->prepare($sql);    // avoid sql injection
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            $stmt->execute();
            $user = $stmt->fetch();
            if ($user) {
                $hash = $user->password;
                return password_verify($password, $hash);
            }
        }
        // Kiem tra thong tin nhap
        private function validate() {
            return $this->username != '' &&
                $this->password != '';
        }
        // Them moi user
        public function addUser($conn) {
            if ($this->validate()) {
                $sql = "insert into users(username, password) 
                        values (:username, :password)";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':username', $this->$username,
                                PDO::PARAM_STR);
                $hash = password_hash($this->password, PASSWORD_DEFAULT);
                $stmt->bindValue(':password', $hash,
                                PDO::PARAM_STR);   
                return $stmt->execute();             
            } else {
                return fasle;
            }
        }
    }
?>