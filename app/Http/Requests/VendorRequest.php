<?php

namespace App\Http\Requests\Settings;

use App\Models\Vendor;
use App\Rules\AlphaSpace;
use App\Rules\AlphaSpaceNumbers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class VendorRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if (!array_key_exists('enterprise_id', $this->all())) {
            $this->merge([
                'enterprise_id' => auth()->user()->department->enterprise_id
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('PUT')) {
            $personOfContacts = $this->vendor->personOfContacts->pluck('id')->toArray();
        }else
        {
            $personOfContacts = [];
        }

        $vendors = Vendor::query()->whereRelation('market', 'enterprise_id', $this->enterprise_id)->get()->pluck('id')->toArray();
        return [
            'name' => ['required',
                'min:' . self::$minStringLength,
                'max:' . self::$maxStringLength,
                Rule::unique('vendors', 'name')
                    ->whereIn('id', $vendors)
                    ->ignore(optional($this->vendor)->id)
            ],
            'email' => ['required', 'unique:vendors,email,' . optional($this->vendor)->id],
            'vat_number' => ['required', 'unique:vendors,vat_number,' . optional($this->vendor)->id],
            'names' => ['required', 'array', 'filled'],
            'names.*' => ['required', 'distinct'],
            'emails' => ['required', 'array', 'filled'],
            'emails.*' => ['required', 'distinct', Rule::unique('person_of_contacts', 'email')->whereNotIn('id', $personOfContacts)],
            'phones' => ['required', 'array', 'filled'],
            'phones.*' => ['required', 'distinct', validatePhoneNumber(), Rule::unique('person_of_contacts', 'phone')->whereNotIn('id', $personOfContacts)],
            'category_id' => ['sometimes', 'nullable', 'exists:categories,id'],
            'market_id' => ['required', 'exists:markets,id'],
            'country_id' => ['required', 'exists:countries,id'],
            'city_id' => ['required', 'exists:cities,id']
        ];
    }

//    public function messages()
//    {
//        return [
//            'names.*.distinct' => 'Please provide different names for poc #:position',
//            'emails.*.unique' => 'Please provide unique emails',
//        ];
//    }
}
