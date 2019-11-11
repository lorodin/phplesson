<?php


namespace Core\Models;

include_once "./Core/Models/IFormField.php";

class EmailField implements IFormField
{

    /**
     * @var string
     */
    private $name;

    private $id;
    /**
     * @var string
     */
    private $title;

    public function __construct(string $title, string $name)
    {
        $this->title = $title;
        $this->name = $name;
    }

    function GetName(): string
    {
        return $this->name;
    }

    function GetType(): string
    {
        return "email";
    }

    function SetID(string $id)
    {
        $this->id = $id;
    }

    function GetParams(): array
    {
        return [
            'type' => $this->GetType(),
            'id' => $this->id,
            'name' => $this->name,
            'title' => $this->title
        ];
    }
}