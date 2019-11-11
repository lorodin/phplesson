<?php
namespace Core\Models;

include_once "./Core/Models/TextBox.php";
include_once './Core/Models/EmailField.php';
include_once "./Core/Models/IFormField.php";
include_once "./Core/Models/PinField.php";
include_once "./Core/View/MainPage.php";

class Form {
    /**
     * @var IFormField[]
     */
    private $fields;
    /**
     * @var string
     */
    public $title;

    function __constructor(string $title)
    {
        $this->title = $title;
        $this->fields = [];
    }

    function SetField(IFormField $field) {
        $this->fields[] = $field;
    }

    function GetFields(): array
    {
        $id = 0;

        // Не совсем правильное распределение ID, но пока покатит
        foreach ($this->fields as $field) {
            $field->SetID($id++);
        }

        return $this->fields;
    }
}