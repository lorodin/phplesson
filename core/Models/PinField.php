<?php


namespace Core\Models;

include_once "./Core/Models/IFormField.php";

class PinField implements IFormField
{

    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $title;

    public function __construct(string $title, string $fieldName)
    {
        $this->name = $fieldName;
        $this->title = $title;
    }

    function GetName(): string
    {
        return $this->name;
    }

    function GetType(): string
    {
        return "pin";
    }

    function SetID(string $id)
    {
        $this->id = $id;
    }

    function GetParams(): array
    {
        return [
            'id' => $this->id,
            'length' => 4,
            'type' => $this->GetType(),
            'name' => $this->GetName(),
            'title' => $this->title
        ];
    }
}