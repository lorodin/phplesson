<?php
namespace Core\Models;

include_once "./Core/Models/IFormField.php";

class TextBox implements IFormField
{
    /**
     * @var string Название поля
     */
    private $name = "";
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $title;

    function __construct(string $title, string $name)
    {
        $this->name = $name;
        $this->title = $title;
    }

    function GetName(): string
    {
        return $this->name;
    }

    function GetType():string
    {
        return "simple-string";
    }

    function SetID(string $id)
    {
        $this->id = $id;
    }

    function GetParams(): array
    {
        return [
            "name" => $this->name,
            "type" => $this->GetType(),
            "id" => $this->id,
            "title" => $this->title
        ];
    }
}

