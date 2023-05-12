<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Assembly;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'current_assembly_id', 'current_questionnaire_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function setCurrentAssembly(int $id) {
        $assembly = Assembly::findOrfail($id);
        $this->current_assembly_id = $id;
        $this->save();
        return $assembly;
    }

    public function getCurrentAssembly() {
        return $this->current_assembly_id;
    }

    public function setCurrentQuestionnaire($id)
    {
        if (!empty($id)) {
            $questionnaire = Questionnaire::findOrfail($id);
            $this->current_questionnaire_id = $id;
            $this->save();
        } else {
            $questionnaire = null;
        }

        return $questionnaire;
    }

    public function getCurrentQuestionnaire() {
        $current_questionnaire_id = $this->current_questionnaire_id;
        if (empty($current_questionnaire_id) || Questionnaire::where('id', $current_questionnaire_id)->get()->isEmpty()){
            if (!empty(Questionnaire::first())) {
                $current_questionnaire_id = Questionnaire::first()->id;
            } else {
                $current_questionnaire_id = null;
            }

            $this->setCurrentQuestionnaire($current_questionnaire_id);
        }
        return $this->current_questionnaire_id;
    }


}