<?php
namespace Core\Controllers;
include "./Core/Models/Form.php";

use Core\Db\Database;
use Core\Models\Form;
use Core\Models\PinField;
use Core\Models\TextBox;
use Core\Models\EmailField;
use Core\Views\MainPage;

class MainController {
    function Index(array $validateMessage = null) {
        $form = new Form();

        // Вот так просто можно добавлять любые другие поля
        $form->SetField( new TextBox("Name", 'name') );
        $form->SetField( new EmailField('Email', 'email') );
        $form->SetField( new PinField('Pin', 'pin') );

        return new MainPage($form, "Main page", $validateMessage ?? []);
    }

    function Post(array $fields) {

        $validation = [
            'name' => $this->validateField($fields['name'] ?? '', 'string'),
            'pin' => $this->validateField($fields['pin'] ?? '', 'pin'),
            'email' => $this->validateField($fields['email'] ?? '', 'email')
        ];

        $error = false;

        foreach ($validation as $key => $value) {
            $error |= $value;
        }

        if (!$error) {
            // Сохраняем в базу
            // htmlspecialchars лучше вызывать где-нибудь повыше,
            // да и вообще все эти поля лучше сразу запихать в какую-нибудь модель, которая уже работает с базой
            $save = Database::Save([
                'name' => htmlspecialchars($fields['name']),
                'pin' => md5(htmlspecialchars($fields['pin'])),
                'email' => htmlspecialchars($fields['email'])
            ]);
            if (!$save) {
                array_merge($validation, [
                    'db-save' => false
                ]);
            }
        }

        return $validation;
    }

    /**
     * Проверяет поле на валидность, можно возвращать не bool, а объект типа
     * [
     *  validate: bool,
     *  message: string - Сообщение если валидация не удачна, то почему
     * ]
     * @param string $field Значение
     * @param string $type Тип поля
     * @return bool Прошла валидация или нет
     */
    private function validateField(string $field, string $type) :bool {
        if (empty($field)) return false;
        if ($type == 'pin') {
            return strlen($field) == 4;
        }
        // Ну и другие проверки на валидацию в зависимости от $type лучше реализовать через switch/case
        return true;
    }
}