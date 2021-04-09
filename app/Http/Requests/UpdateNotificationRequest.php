<?php

namespace App\Http\Requests;

use App\Models\Notification;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNotificationRequest extends FormRequest
{

    public function authorize(): bool
    {
        return $this->route('notification')->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'zip' => ['required'],
            'radius' => ['required'],
        ];
    }
}
