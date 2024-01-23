<?php

namespace App\Http\Requests\Api;

use App\Interface\Entities\AllocationInterface;
use Illuminate\Foundation\Http\FormRequest;

class AllocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $maxLimit = 'max:' . AllocationInterface::POCKET_MAX_LIMIT;
        return [
            'pocket1' => ['required', 'integer', 'min:0', $maxLimit],
            'pocket2' => ['required', 'integer', 'min:0', $maxLimit],
            'pocket3' => ['required', 'integer', 'min:0', $maxLimit],
        ];
    }
}
