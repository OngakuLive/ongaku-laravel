<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Models\UserRelationship;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //If they have posted to someones wall, ensure they are friends
        if (isset($this['recipient_id'])) {
            $relationship = UserRelationship::where('destination_user_id', Auth::id())
                ->where('source_user_id', $this->input('recipient_id'))
                ->whereHas('type', function($type) {
                    return $type->reference == 'friends';
                })->first();

            if (!isset($relationship)) {
                return false;
            }
        }

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
            'content' => 'string|required',
            'recipient_id' => 'integer|exists:users,id|nullable'
        ];
    }
}
