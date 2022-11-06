<?php
/**
 * href() - возвращает АДРЕС для кнопки авторизации
 * getToken() - token и id пользователя
 * getData() - массив данных пользователя
 * 
 * Настройка битры:
 * Разработчикам -> Другое -> Локальное приложение -> Только API -> 
 * Путь обработчика = это страница НА которой выводим данные аккаунта
 * Путь для первоначальной установки = это страница авторизации с кнопкой
 * Права -> Пользователи (user)
 * 
 * Далее создаём входящий вебхук:
 * Метод = user.current
 * Права -> Пользователи (user)
 * 
 * На странице авторизации создаем тег <a href="">Войти через Bitrix24</a>, в href передаем href()
 * На главной странице выводим getData()
 */

class OAuth_Bitrix24{

    private const CLIENT_ID = 'local.айди';
    private const CLIENT_SECRET = 'Секрет';
    private const YOUR_BITRIX24 = 'Поддомен вашего битрикса'; // https://Поддомен вашего битрикса.bitrix24.ru

    public function href(){
        return "https://".self::YOUR_BITRIX24.".bitrix24.ru/oauth/authorize/?client_id=" . self::CLIENT_ID;
    }

    private function getToken(){
        $codeArray = $_REQUEST;
        $code = $codeArray['code'];

        $params = array(
            'grant_type'    => 'authorization_code',
            'client_id'     => self::CLIENT_ID,
            'client_secret' => self::CLIENT_SECRET,
            'code'          => $code
        );

        return file_get_contents("https://oauth.bitrix.info/oauth/token/?" . http_build_query($params));
    }

    public function getData(){
        $access_tokenArray = self::getToken();

        $access_tokenArray = json_decode($access_tokenArray);
        $access_token = $access_tokenArray->access_token;

        return file_get_contents('https://'.self::YOUR_BITRIX24.'.bitrix24.ru/rest/user.current?auth='. $access_token);
    }
}
