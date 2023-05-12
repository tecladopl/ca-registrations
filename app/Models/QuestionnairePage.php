<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class QuestionnairePage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['page', 'title', 'description', 'questionnaire_id'];

    public static function getByPath(Request $request)
    {
        $segments = $request->segments();
        $page = array_pop($segments);
        $questionnaire = Questionnaire::getByPath($request);
        $questionnairePage = NULL;
        if(!empty($questionnairePage)) {
            $pagesCount = self::where('questionnaire_id', $questionnaire->id)->count();
            if (is_numeric($page)) {
                if ((int) $page <= $pagesCount) {
                    $questionnairePage = self::where('questionnaire_id', $questionnaire->id)->where('page', $page)->first();
                }
            }
        }
        
        return $questionnairePage;
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }



}
