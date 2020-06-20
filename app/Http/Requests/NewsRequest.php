<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'title'  => 'required',
                    'body' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                $rules = [];
                if (request()->has('title')) {
                    $rules = array_merge($rules, ['title' => 'required']);
                }
                if (request()->has('body')) {
                    $rules = array_merge($rules, ['title' => 'required']);
                }
                return $rules;
            }
            default:
                break;
        }
    }
}
