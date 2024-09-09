<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\hospitalisation\Doctor;
use App\Models\invoicing\Invoice;
use App\Models\Scopes\ExcludeZeroStatusScope;
use App\Models\stock\Depot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_activity',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pos_session(): HasMany
    {
        return $this->hasMany(PosSession::class);
    }

    public function current_session($date = null)
    {
        $pos_session = $this->pos_session()
            ->where('is_active', 1)
            ->whereDate('created_at', $date ?? today())->latest()->first();
        return $pos_session;
    }

    public function last_closed_seesions($date = null)
    {
        return $this->pos_session()
            ->where('is_active', 0)
            ->whereDate('created_at', $date ?? today());

    }

    public function sum_last_closes_sessions($date = null)
    {
        $sum = 0;
        if ($this->last_closed_seesions($date)->count()) {
            foreach ($this->last_closed_seesions($date)->get() as $session) {
                $sum += $session->total;
            }

        }

        return $sum;
    }

    public function getIsSuperAdminAttribute(): bool
    {
        return $this->hasRole('superuser');
    }

    public function depot(): HasOne
    {
        return $this->hasOne(Depot::class, 'responsable_id');
    }

    public function doctor(): HasOne
    {
        return $this->hasOne(Doctor::class);
    }

    public function closeCurrentSession(): void
    {
        $current_session = $this->pos_session()->where('is_active', 1)->first();
        if ($current_session) {
            $current_session->is_active = 0;
            $current_session->closed_date = now();
            $current_session->save();
        }
    }

    public function is_part_of_treasury(): bool
    {
        return auth()->user()->hasRole('admin_treasury') || auth()->user()->hasRole('user_treasury');
    }

    public function is_part_of_accounting(): bool
    {
        return auth()->user()->hasRole('accountant') || auth()->user()->hasRole('user_accountant');
    }

    public function getRedirectRouteAttribute()
    {
        $user_role = $this->roles()->first();
        //dd($user_role);
        if ($user_role) {
            if ($user_role->redirect_url) {
                return $user_role->redirect_url;
            }
        }
    }

    public function is_part_of_stock(): bool
    {
        return auth()->user()->hasRole('admin_stock') || auth()->user()->hasRole('user_stock');
    }

    //short name : remove after @
    public function getShortNameAttribute()
    {
        return explode('@', $this->email)[0];
    }

    public function recus(): HasMany
    {
        return $this->hasMany(Invoice::class, 'payer_id')->where('is_regular_invoice', 0);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'payer_id')->where('is_regular_invoice', 1);
    }

    public function devis()
    {
        return Invoice::query()->withoutGlobalScope(ExcludeZeroStatusScope::class)->where('user_id', $this->id)->where('stage', 0);
    }


}
