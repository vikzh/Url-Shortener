<?php

namespace App;

use App\Helpers\Math;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\CodeGenerationException;

class Link extends Model
{
    protected $fillable = [
        'original_url',
        'code'
    ];

    public function getCode()
    {

        if ($this->id === null) {
            throw new CodeGenerationException();
        }

        return (new Math())->toBase($this->id);
    }

    public static function byCode($code)
    {
        return static::where('code', $code);
    }

    public function shortenedUrl()
    {
        if ($this->code === null) {
            return null;
        }

        return env('APP_URL') . "/{$this->code}";
    }
}
