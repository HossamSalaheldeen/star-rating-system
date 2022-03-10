<?php

namespace App\Http\Requests\Settings;

use App\Rules\AlphaNumbers;
use App\Rules\AlphaSpace;
use App\Rules\CheckManagerExists;
use App\Rules\CheckPasswordDictionaryWords;
use App\Rules\CheckPasswordHistory;
use App\Rules\CheckPasswordUsernameWords;
use App\Rules\ComplexPasswordPattern;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\Self_;

class UserRequest extends FormRequest
{
    protected static int $minStringLength = 2;
    protected static int $maxStringLength = 100;
    protected static int $minCodeLength = 2;
    protected static int $maxCodeLength = 10;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', new AlphaSpace(), 'min:' . self::$minStringLength, 'max:' . self::$maxStringLength],
            'email' => ['required', 'unique:users,email,' . optional($this->user)->id],
            'role_id' => ['required', 'exists:roles,id'],
            'password' => [Rule::requiredIf($this->isMethod('POST')), Rule::when($this->isMethod('PUT'), ['nullable']), 'confirmed', new ComplexPasswordPattern(), new CheckPasswordHistory(), new CheckPasswordUsernameWords(), new CheckPasswordDictionaryWords()],
            'initial_job_code' => [
                Rule::when(request('initial_job_code'),
                ['integer', 'min:0'])],
            'manager_id' => ['nullable', new CheckManagerExists()],
            'enterprise_id' => ['required', Rule::exists('enterprises', 'id')->where('is_active', true)],
            'branch_id' => ['required', Rule::exists('branches', 'id')->where('is_active', true)],
            'department_id' => ['required', Rule::exists('departments', 'id')->where('is_active', true)],
            'code' => ['required', 'unique:users,code,' . optional($this->user)->id, 'min:' . self::$minCodeLength, 'max:' . self::$maxCodeLength, new AlphaNumbers()],
            'is_viewer' => ['nullable'],
            'users_ids'   => [ 'nullable', 'array', 'filled', 'distinct' ],
            'users_ids.*' => [ 'nullable', 'exists:users,id'],
        ];
    }
}
