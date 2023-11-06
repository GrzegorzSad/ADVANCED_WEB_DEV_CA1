<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DatePicker extends Component
{
    public $name;
    public $field;
    public $value;

    public function __construct($name, $field, $value = null)
    {
        $this->name = $name;
        $this->field = $field;
        $this->value = $value;
    }

    public function render()
    {
        return view('components.date-picker');
    }
}
