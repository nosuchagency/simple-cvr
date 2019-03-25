<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'blacklisted_words',
        'whitelisted_words',
        'reject_duplicates'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'reject_duplicates' => 'boolean',
    ];

    /**
     * Lower case black listed words
     *
     * @param  string $value
     *
     * @return void
     */
    public function setBlacklistedWordsAttribute($value)
    {
        $this->attributes['blacklisted_words'] = strtolower($value);
    }

    /**
     * Lower case white listed words
     *
     * @param  string $value
     *
     * @return void
     */
    public function setWhitelistedWordsAttribute($value)
    {
        $this->attributes['whitelisted_words'] = strtolower($value);
    }

    /**
     * @return array
     */
    public function getBlacklistAsArray()
    {
        return explode(',', $this->blacklisted_words);
    }

    /**
     * @return array
     */
    public function getWhitelistAsArray()
    {
        return explode(',', $this->whitelisted_words);
    }

    /**
     * @return bool
     */
    public function rejectDuplicates()
    {
        return $this->reject_duplicates;
    }
}
