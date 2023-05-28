<?php

namespace app\core\form;

use app\core\Model;

class InputField extends BaseField
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';
    public const TYPE_DROPDOWN = 'dropdown'; // New constant for dropdown field
    public string $type;
    public Model $model;
    public string $attribute;
    private array $options;
    private ?string $value = null;
    /**
     * @param Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model, $attribute);
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function dropdown(array $options)
    {
        $this->type = self::TYPE_DROPDOWN;
        $this->options = $options;
        return $this;
    }

    public function renderInput(): string
    {
        if ($this->type === self::TYPE_DROPDOWN) {
            return sprintf(
                '<select name="%s" class="form-control%s">%s</select>',
                $this->attribute,
                $this->model->hasError($this->attribute) ? ' is-invalid' : '',
                $this->renderDropdownOptions()
            );
        }

        return sprintf('<input type="%s" name="%s" value="%s" class="form-control%s">',
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
        );
    }


    // New method to render the dropdown options
    protected function renderDropdownOptions(): string
    {
        $optionsHtml = '';
        foreach ($this->options as $value => $label) {
            $selected = $this->model->{$this->attribute} === $value ? 'selected' : '';
            $optionsHtml .= sprintf('<option value="%s" %s>%s</option>', $value, $selected, $label);
        }
        return $optionsHtml;
    }

    public function select($value)
    {
        $this->model->{$this->attribute} = $value;
        var_dump($value);
        return $this;
    }

    public function value()
    {
        return $this->value;
    }

    public function options(array $options)
    {
        $this->options = $options;
        return $this;
    }



    protected function getValue(): string
    {
        // Use the value property if set, otherwise use the model's value
        return $this->value !== null ? $this->value : $this->model->{$this->attribute};
    }

}
