<?php


namespace Models;

class Auth extends \Model {

  protected const TABLE = 'auth';

  public $data = [];
  public $isAuth = false;
  public $isRegister = false;
  
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