<?php

namespace App\Class;

use App\Class\User;

class Client{

    private string $url;
//    private string $token;

    function __construct($url){
        $this->url = $url . '/api';
    }

    private function getToken($login, $password):void
    {
        $ch = curl_init($this->url . 'api/login_check');
        $authorization = [
            "username" => $login,
            "password" => $password
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
//        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
//        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        echo $result;
//        return json_decode($result);

    }

    public function setUrl($url){
        $this->url = $url;
    }

    public function getUrl(){
        return $this->url;
    }

    /**
     * @param $id
     * @return bool|string
     */
    public function getPostByUser($id){
        $ch = curl_init($this->url . '/post/getAllPostByUser/' . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    /**
     * @param $name
     * @param $login
     * @param $password
     * @return bool|string
     */
    public function addUser($name, $login, $password){
        $ch = curl_init($this->url . '/user/add');

        $data = [
            "name"=>$name,
            "login"=>$login,
            "password"=>$password
        ];

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    /**
     * @param $head
     * @param $body
     * @param $id
     * @return bool|string
     */
    public function addPost($head, $body, $id){
        $ch = curl_init($this->url . '/user/post/' . $id);

        $data = [
            "head"=>$head,
            "body"=>$body,
        ];

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    /**
     * @param $head
     * @param $body
     * @param $id
     * @return bool|string
     */
    public function updatePost($head, $body, $id){
        $ch = curl_init($this->url . '/user/post/' . $id);

        $data = [
            "head"=>$head,
            "body"=>$body,
        ];

        $data_json = json_encode($data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    /**
     * @param $id
     * @return bool|string
     */
    public function deletePost($id){
        $ch = curl_init($this->url . '/user/post/' . $id);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }


    public function uloadFile(User $user)
    {
        $this->getToken($user->getLogin(), $user->getPassword());
    }
}