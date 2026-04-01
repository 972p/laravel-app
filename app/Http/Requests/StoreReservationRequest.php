<?php

namespace App\Http\Requests;

use App\Models\Shoe;
use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'shoe_id'    => 'required|exists:shoes,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date'   => 'required|date|after:start_date',
        ];
    }

    /**
     * Custom validation after the basic rules.
     */
    public function after(): array
    {
        return [
            function ($validator) {
                $shoe = Shoe::find($this->shoe_id);
                
                if ($shoe && !$shoe->isAvailable($this->start_date, $this->end_date)) {
                    $validator->errors()->add(
                        'start_date',
                        'La chaussure n\'est pas disponible pour cette période.'
                    );
                }
            }
        ];
    }
}
