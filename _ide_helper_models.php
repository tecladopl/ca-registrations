<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Answer
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Answer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Answer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Answer query()
 */
	class Answer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Applicant
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $surname
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Applicant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Applicant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Applicant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Applicant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Applicant whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Applicant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Applicant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Applicant whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Applicant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Applicant whereUuid($value)
 */
	class Applicant extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ApplicantEntry
 *
 * @property int $id
 * @property int $applicant_id
 * @property int $category_value_id
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantEntry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantEntry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantEntry query()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantEntry whereApplicantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantEntry whereCategoryValueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantEntry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantEntry whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantEntry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantEntry whereUpdatedAt($value)
 */
	class ApplicantEntry extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Assembly
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Assembly newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Assembly newQuery()
 * @method static \Illuminate\Database\Query\Builder|Assembly onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Assembly query()
 * @method static \Illuminate\Database\Eloquent\Builder|Assembly whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assembly whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assembly whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assembly whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assembly whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assembly whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Assembly withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Assembly withoutTrashed()
 */
	class Assembly extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property int $priority
 * @property int $assembly_id
 * @property int $category_type_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CategoryType $category_type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CategoryValue[] $category_values
 * @property-read int|null $category_values_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Query\Builder|Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereAssemblyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCategoryTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Category withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Category withoutTrashed()
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CategoryType
 *
 * @property int $id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryType query()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryType whereUpdatedAt($value)
 */
	class CategoryType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CategoryValue
 *
 * @property int $id
 * @property string|null $value
 * @property int|null $min
 * @property int|null $max
 * @property int $amount
 * @property int $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryValue whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryValue whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryValue whereMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryValue whereMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryValue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryValue whereValue($value)
 */
	class CategoryValue extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Composition
 *
 * @property int $id
 * @property int $category_value_id
 * @property int $amount
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Composition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Composition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Composition query()
 * @method static \Illuminate\Database\Eloquent\Builder|Composition whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Composition whereCategoryValueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Composition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Composition whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Composition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Composition whereUpdatedAt($value)
 */
	class Composition extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Groups
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Groups newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Groups newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Groups query()
 */
	class Groups extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Localization
 *
 * @property int $id
 * @property string $locale
 * @property string $locale_name
 * @property string $icon_suffix
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Localization newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Localization newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Localization query()
 * @method static \Illuminate\Database\Eloquent\Builder|Localization whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Localization whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Localization whereIconSuffix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Localization whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Localization whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Localization whereLocaleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Localization whereUpdatedAt($value)
 */
	class Localization extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Membership
 *
 * @property int $id
 * @property int $team_id
 * @property int $user_id
 * @property string|null $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Membership newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership query()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereUserId($value)
 */
	class Membership extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Participant
 *
 * @property int $id
 * @property int $applicant_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Participant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereApplicantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereUpdatedAt($value)
 */
	class Participant extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Question
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Question query()
 */
	class Question extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\QuestionType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionType query()
 */
	class QuestionType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Questionnaire
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Questionnaire newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Questionnaire newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Questionnaire query()
 */
	class Questionnaire extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\QuestionnairePage
 *
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionnairePage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionnairePage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionnairePage query()
 */
	class QuestionnairePage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\QuestionnaireParticipant
 *
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionnaireParticipant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionnaireParticipant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionnaireParticipant query()
 */
	class QuestionnaireParticipant extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Team
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property bool $personal_team
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $owner
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team wherePersonalTeam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUserId($value)
 */
	class Team extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property int|null $current_assembly_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Team|null $currentTeam
 * @property-read string $profile_photo_url
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Team[] $ownedTeams
 * @property-read int|null $owned_teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Team[] $teams
 * @property-read int|null $teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentAssemblyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

