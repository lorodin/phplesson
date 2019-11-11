<?php
namespace Core\Models;

interface IFormField
{
    function GetName(): string;
    function GetType(): string;
    function SetID( string $id );
    function GetParams(): array;
}