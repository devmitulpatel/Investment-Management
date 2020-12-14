<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class BranchOfBanksForAdmin extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'branch_of_banks_for_admins';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'bank_id',
        'ifsc_code',
        'city',
        'area',
        'pincode',
        'ref_contact_name',
        'ref_contact_no',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function bank()
    {
        return $this->belongsTo(BankForAdmin::class, 'bank_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
