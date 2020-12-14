<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class PolicyForUser extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'policy_for_users';

    const PREMIUM_INTERVAL_SELECT = [
        '1' => 'monthly',
        '2' => 'yearly',
        '3' => 'one time',
    ];

    const STATUS_SELECT = [
        '1' => 'active',
        '2' => 'on hold',
        '3' => 'all premium paid',
        '4' => 'matured',
    ];

    protected $dates = [
        'date_of_purchase',
        'date_of_maturity',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'issuer_name',
        'name',
        'policy_no',
        'premium_amount',
        'no_of_premium',
        'premium_interval',
        'date_of_purchase',
        'date_of_maturity',
        'amount_paid',
        'amount_received',
        'rate_intrest',
        'ref_contact_no',
        'ref_contact_name',
        'note',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function holders()
    {
        return $this->belongsToMany(HoldersForAdmin::class);
    }

    public function nominees()
    {
        return $this->belongsToMany(NomineesForAdmin::class);
    }

    public function getDateOfPurchaseAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateOfPurchaseAttribute($value)
    {
        $this->attributes['date_of_purchase'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDateOfMaturityAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateOfMaturityAttribute($value)
    {
        $this->attributes['date_of_maturity'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
