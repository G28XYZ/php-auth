<?php


namespace Models;

class Auth {
  public $isAuth = false;
  public $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function setAuth($bool) {
    $this->isAuth = $bool;
  }
  
  public function createUser(array $data) {
    if(isset($data['name']) && isset($data['password'])) {
      $data['password'] = password_hash($data['password'] . 'JWT_SECRET', PASSWORD_DEFAULT);
      $email = $data['email'];
      $password = $data['password'];
      $name = $data['name'];
      $sql = "INSERT
              INTO users(email,password,full_name)
              VALUES(
              '$email',
              '$password',
              '$name'
            );";

      $this->db->execute($sql,[]);
    }
  }
  
  public function findUserByEmail($email) {
    $sql = "SELECT * FROM users WHERE email='$email'";
    return $this->db->query($sql)[0] ?? false;
  }
  
  protected function _generateToken($userData) {
    $key = 'JWT_SECRET';
    $dataEncoded = base64_encode(json_encode($userData));
    $signatureEncode = base64_encode(hash_hmac('sha256', $dataEncoded, $key, true));
    $jwt = $dataEncoded . '.' . $signatureEncode;
    return $jwt;
  }
  
  public function verifyToken($token) {
    $key = 'JWT_SECRET';
    $dataEncoded = explode('.', $token)[0];
    $signature = hash_hmac('sha256', $dataEncoded, $key, true);
    $signatureDecode = base64_decode(explode('.', $token)[1]);
    if(hash_equals($signature, $signatureDecode)) {
      $dataDecode = json_decode(base64_decode($dataEncoded));
      return ['payload'=> ['name' => $dataDecode->full_name, 'email'=>$dataDecode->email, 'id'=>$dataDecode->user_id]];
    }
    return [];
  }
  
  public function login($email, $password) {
    $user =$this->findUserByEmail($email);
    if($user) {
      $passwordVerify = password_verify($password . 'JWT_SECRET', $user['password']);
      if($passwordVerify) {
        $token = $this->_generateToken($user);
        return ['token' => $token];
      } else {
        return ['message'=>'Неверный пароль'];
      }
    } else {
      return ['message'=>'Пользователь не зарегистрирован'];
    }
  }
}