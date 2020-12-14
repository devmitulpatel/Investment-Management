<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class NscForUser extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'nsc_for_users';

    const STATUS_SELECT = [
        '0' => 'Unmatured',
        '1' => 'Matured',
    ];

    protected $dates = [
        'date_purchase',
        'date_maturity',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'date_purchase',
        'date_maturity',
        'certificate_no',
        'amount_paid',
        'amount_received',
        'purchase_from',
        'ref_contact_name',
        'ref_contact_no',
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

    public function getDatePurchaseAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDatePurchaseAttribute($value)
    {
        $this->attributes['date_purchase'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDateMaturityAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateMaturityAttribute($value)
    {
        $this->attributes['date_maturity'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function holders()
    {
        return $this->belongsToMany(HoldersForAdmin::class);
    }

    public function nominees()
    {
        return $this->belongsToMany(NomineesForAdmin::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
