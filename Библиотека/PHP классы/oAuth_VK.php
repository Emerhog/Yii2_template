<?php
/**
 * href() - возвращает АДРЕС для кнопки авторизации
 * getToken() - token и id пользователя
 * getData() - массив данных пользователя
 * 
 * На странице авторизации создаем тег <a href="">Войти через ВК</a>, в href передаем href()
 * На главной странице выводим getData()
 */

class OAuth_VK{

    private const CLIENT_ID = 'айди'; // ID приложения
    private const CLIENT_SECRET = 'секрет'; // Защищённый ключ
    private const REDIRECT_URL = 'http://мой сайт.site/authorize.php'; // Адрес, на который будет переадресован пользователь после прохождения авторизации

    public function href(){
        session_start();
        $params = array(
            'client_id'     => self::CLIENT_ID,
            'redirect_uri'  => self::REDIRECT_URL,
            'response_type' => 'code',
            'v'             => '5.131', // Версия API, которую вы используете https://vk.com/dev/versions
            'scope'         => 'photos,offline', // Если указать "offline", полученный access_token будет "вечным"
        );
        
        return 'http://oauth.vk.com/authorize?' . http_build_query($params);
    }

    private function getToken(){
        $params = array(
            'client_id'     => self::CLIENT_ID,
            'client_secret' => self::CLIENT_SECRET,
            'code'          => $_GET['code'],
            'redirect_uri'  => self::REDIRECT_URL
        );
        
        $content = file_get_contents('https://oauth.vk.com/access_token?' . http_build_query($params));
        
        $response = json_decode($content);
        $token = $response->access_token;
        $userId = $response->user_id;

        return [$token, $userId];
    }

    public function getData(){

        $array = self::getToken();
        $token = $array[0];
        $userId = $array[1];
        // Формируем запрос
        $params = array(
            'v' => '5.131',
            'access_token' => $token,
            'user_ids' => $userId,
            'fields' => 'photo_100,about' // Список опциональных полей https://vk.com/dev/objects/user
        );

        $content = file_get_contents('https://api.vk.com/method/users.get?' . http_build_query($params));
        $response = json_decode($content);

        $id = $response->response[0]->id;
        $firstName = $response->response[0]->first_name;
        $lastName = $response->response[0]->last_name;
        $photo = $response->response[0]->photo_100;

        return [$id, $firstName, $lastName, $photo];
    }
}


