<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $fillable = ["shopify_url", "parent_id", "name", "options", "description"];
    protected $casts = [
        "options" => "array"
    ];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        return [
            'name' => 'required',
        ];
    }

    /*
    |------------------------------------------------------------------------------------
    | Relations
    |------------------------------------------------------------------------------------
    */
    public function parent()
    {
        return $this->belongsTo(DefaultTemplate::class,"parent_id");
    }
    /*
    |------------------------------------------------------------------------------------
    | Scopes
    |------------------------------------------------------------------------------------
    */

    /*
    |------------------------------------------------------------------------------------
    | Attributes
    |------------------------------------------------------------------------------------
    */
}
