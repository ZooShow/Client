<?php

class Listener{

    private $url = "http://127.0.0.1:8000";

    public function getPostByUser($id){
        $ch = curl_init($this->url . '/post/getAllPostByUser/' . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

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

    public function deletePost($id){
        $ch = curl_init($this->url . '/user/post/' . $id);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}


$list = new Listener();
// echo ($list->getPostByUser(1));
//echo ($list->addUser("user", "login", "password"));
//echo ($list->updatePost("head", "body", 3));
echo ($list->deletePost(3));