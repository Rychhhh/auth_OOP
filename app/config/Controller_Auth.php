<?php 
/**
  
 * Di sini saya akan menampung fungsi untuk login dan register 
 * 
 
 */

    class Auth {

        private $db; // Menyimpan koneksi database

        private $error; // Menyimpan Error Message

        // Contruct auth, need parameter untuk terhubung ke database
        
        public function __construct( $conn) 
        {

            $this->db = $conn;

            // Mulai session

            session_start();
        }

        // Start : Register user baru 

        public function register($nama, $email, $password  )
        {
            try {

                // buat hash password yang dimasukan user

                $hash_password = password_hash($password, PASSWORD_DEFAULT);

                // Masukan user baru kedalam database

                $stmt = $this->db->prepare("INSERT INTO users(nama, email, password) VALUES (:nama, :email, :pass)"); 
                
                $stmt->bindParam(":nama", $nama);

                $stmt->bindParam(":email", $email);

                $stmt->bindParam(":pass", $hash_password);

                $stmt->execute();

                return true;

            } catch (PDOException $e) {

                // Jika terjadi error maka

                if ($e->errorInfo[0] == 23000) {

                    // errorInfo berisi informasi error tentang query sql yang  baru dijalankan
                    
                    // 23000 adalah kode error ketika data yang sama pada kolom yang di set unique

                    $this->error = "Email sudah digunakan";

                    return false;

                } else {

                    echo $e->getMessage();

                    return false;
                }
            }
        }

            // End : Register user baru

            // Start : Login user 

         public function login($email, $password) {
                
            try  {

                 // Cek apakah ada user di dalam database

                 $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");

                 $stmt->bindParam(":email", $email);

                 $stmt->execute();
 
                 $data = $stmt->fetch();
 
                 // jika baris > 0

                 if($stmt->rowCount() > 0) {
                     
                     // Jika password yang dimasukan sesuai dengan yang ada di database

                     if(password_verify($password, $data['password'])) {

                         $_SESSION['user_session'] = $data['id'];
 
                         return true;
                         
                     } else {
 
                         $this->error = "Email atau Password Salah";
 
                         return false;

                     }
                 } else {

                    $this->error = "Email atau Password Salah";
                    
                    return false;
                 }

            } catch (PDOException  $e){

                echo $e->getMessage();

                return false;
            }
        }

        // End : Login user

        // Start : Fungsi cek login user 

        public function isLoggedIn() {
            
            // Cek apakah user session sudah ada di session

            if(isset($_SESSION['user_session'])) {

                return true;
                
            }
        
        }
        // End : Fungsi cek login user

        // Start : Fungsi ambil data user yang sudah login 
        
        public function getUser() {

            // Cek apakah sudah login 

            if(!$this->isLoggedIn()) {

                return false;
            } 

            try {
                $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
                
                $stmt->bindParam(":id", $_SESSION['user_session']);

                $stmt->execute();

                return $stmt->fetch();

            } catch (PDOException $e) {

                echo $e->getMessage();

                return false;
            }
        }

        // End : fungsi mengambil data user yang login

        // Start : fungsi log out user 

        public function logout() {

            // Hapus session
            session_destroy();

            // Hapus user session
            unset($_SESSION['user_session']);

            return true;
        }

        // End : fungsi log out user
        
        // Start : fungsi ambil error dari variable error

        public function getLastError() {
            return $this->error;
        }

        // End : fungsi ambil error dari variable error 
        
    }
