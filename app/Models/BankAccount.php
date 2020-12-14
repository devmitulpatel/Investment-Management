<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class BankAccount extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'bank_accounts';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'bank_id',
        'branch_id',
        'opening_balance',
        'note',
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

    public function branch()
    {
        return $this->belongsTo(BranchOfBanksForAdmin::class, 'branch_id');
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
