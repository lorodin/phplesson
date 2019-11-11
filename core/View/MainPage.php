<?php
namespace Core\Views;

use Core\Models\Form;

include_once './Core/Models/Form.php';
include_once './Core/View/IView.php';

class MainPage implements IView
{
    /**
     * @var Form
     */
    private $form;
    /**
     * @var string
     */
    private $title;
    /**
     * @var array
     */
    private $validation;

    function __construct(Form $form, string $title, array $validation = [])
    {
        $this->form = $form;
        $this->title = $title;
        $this->validation = $validation;
    }

    function Render(): string
    {
        $html = "<form method='post'><div class='form'>";
        $html .= "<h2>" . $this->title . "</h2>";
        if (count($this->validation) != 0) {
            $errors = '';
            foreach ($this->validation as $key => $value) {
                if (!$value) {
                    $errors .= '<li>'.$key.'</li>';
                }
            }
            if ($errors != '') {
                $html .= '<ul class="errors-list">'.$errors.'</ul>';
            }
        }
        // Этот харкор тоже лучше распределить по отдельным классам
        // Т.е. создать отдельный View для каждого типа контрола и отрисовать его отдельно
        foreach ($this->form->GetFields() as $field) {
            $params = $field->GetParams();
            switch ($params['type']) {
                case "simple-string":
                    $html .= "<div class='controls-group'>".
                                "<label for='" . $params['id'] . "'>" . $params['title'] . ": </label>" .
                                "<input type='text' name='" . $params['name'] . "' id='" . $params['id'] . "' />".
                            "</div>";
                    break;
                case 'email':
                    $html .= "<div class='controls-group'>".
                        "<label for='" . $params['id'] . "'>" . $params['title'] . ": </label>" .
                        "<input placeholder='email@mail.com' type='text' name='" . $params['name'] . "' id='" . $params['id'] . "' />".
                        "</div>";
                    break;
                case 'pin':
                    $html .= "<div class='controls-group'>".
                        "<label for='" . $params['id'] . "'>" . $params['title'] . ": </label>" .
                        "<input placeholder='****' type='password' maxlength='4' name='" . $params['name'] . "' id='" . $params['id'] . "' />".
                        "</div>";
                    break;
            }
        }
        $html .= "<div class='controls-group'>" .
                 "<input name='submit' type='submit' value='submit' />".
                 "</div>";

        $html .= "</div></form>";
        return $html;
    }
}