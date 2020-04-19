```
Для разворачивания проекта:
1. Пример nginx файла распложен в /environments/config/test.conf
2. Создать БД, настроить
3. composer install
4. php yii migrate
5. В базе будет пользователь с username - "test" и паролем - "121212"
```

```
Домены сайта:
1. test.local
2. backend.test.local
3. api.test.local
```

```
Два варианта получения Token:
1.Авторизация по нику (api.test.local/v1/login-by-username | api.test.local/v2/login-by-username)
2.Авторизация по почте (api.test.local/v1/login-by-email | api.test.local/v2/login-by-username)
```
