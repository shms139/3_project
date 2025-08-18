<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\PStudentController;
use App\Http\Controllers\StudentController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  //  /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, Notifiable ,HasFactory ;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

  /*  protected $fillable = [
        'username',
        'mobile',
        'password',
    ];
*/
    public function admin()
    {
        return $this->hasOne(AdminController::class);
    }

    public function director()
    {
        return $this->hasOne(DirectorController::class);
    }

 public function p_student()
    {
        return $this->hasOne(PStudentController::class);
    }

    public function student()
    {
        return $this->hasOne(StudentController::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
        //    'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
