<?php

namespace App;

use App\Filters\CompanyFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'cvr',
        'attention',
        'address',
        'postcode',
        'city',
        'segment',
        'branch',
        'expires_at',
        'terminates_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'expires_at',
        'terminates_at'
    ];

    /**
     * @var array
     */
    public static $elasticFields = [
        'name' => 'Vrvirksomhed.virksomhedMetadata.nyesteNavn.navn',
        'cvr' => 'Vrvirksomhed.cvrNummer',
        'attention' => 'Vrvirksomhed.virksomhedMetadata.nyesteBeliggenhedsadresse.conavn',
        'address' => 'Vrvirksomhed.virksomhedMetadata.nyesteBeliggenhedsadresse.vejnavn',
        'number' => 'Vrvirksomhed.virksomhedMetadata.nyesteBeliggenhedsadresse.husnummerFra',
        'postcode' => 'Vrvirksomhed.virksomhedMetadata.nyesteBeliggenhedsadresse.postnummer',
        'city' => 'Vrvirksomhed.virksomhedMetadata.nyesteBeliggenhedsadresse.bynavn',
        'branch' => 'Vrvirksomhed.hovedbranche.branchekode'
    ];

    /**
     * Scope a query to only include companies that are not expired (Active).
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->whereDate('expires_at', '>', now()->startOfDay());
    }

    /**
     * Process filters
     *
     * @param Builder $builder
     * @param $request
     *
     * @return Builder $builder
     */
    public function scopeFilter(Builder $builder, $request)
    {
        return (new CompanyFilter($request))->filter($builder);
    }

    /**
     * @return string
     */
    public function getTooltipText()
    {
        $difference = now()->startOfDay()->diffInDays($this->expires_at, false);

        if ($difference > 0) {
            return 'Udløber om ' . $difference . ' ' . trans_choice('messages.day', $difference);
        }

        $difference = now()->startOfDay()->diffInDays($this->terminates_at, false);

        return 'Udløbet. Slettes om ' . $difference . ' ' . trans_choice('messages.day', $difference) . '. Vil ekskluderes i export';
    }

    /**
     * @return string
     */
    public function getTooltipColor()
    {
        $difference = now()->startOfDay()->diffInDays($this->expires_at, false);

        if ($difference > 5) {
            return 'text-success';
        } else if ($difference > 0) {
            return 'text-warning';
        }

        return 'text-danger';
    }
}
