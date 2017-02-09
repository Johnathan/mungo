<?php

namespace App;

class FormBuilder extends \Collective\Html\FormBuilder {

    public function buildLabel( $name, $label, $required = null )
    {
        return '<label for="' . $name . '" class="label">' . $label . ( $required ? '<span class="is-danger"> *</span>' : '' ) . '</label>';
    }

    public function textField( string $name, string $label = null, string $value = null, array $attributes = null, bool $required = null, $error = null, $type = 'text' )
    {
        $html = '';
        if( $label ) $html .= $this->buildLabel( $name, $label, $required );

        $html .= '<p class="control">';
            $html .= $this->input( $type, $name, $value, [ 'class' => 'input ' . ( $error ? 'is-danger' : '' ) ] );
        $html .= '</p>';

        if( $error ) $html .= '<span class="help is-danger">' . $error . '</span>';

        return $html;
    }

    public function passwordField( string $name, string $label = null, string $value = null, array $attributes = null, bool $required = null, $error = null, $type = 'password' )
    {
        return $this->textField( $name, $label, $value, $attributes, $required, $error, $type );
    }

    public function emailField( string $name, string $label = null, string $value = null, array $attributes = null, bool $required = null, $error = null, $type = 'email' )
    {
        return $this->textField( $name, $label, $value, $attributes, $required, $error, $type );
    }

}