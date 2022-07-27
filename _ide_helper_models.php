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
 * App\Models\Breakfast
 *
 * @method static find(int $breakfast_id)
 * @method static create(array $array)
 * @property mixed $rates
 * @property mixed $users
 * @property mixed $created_at
 * @property mixed $description
 * @property mixed $name
 * @property mixed $id
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $rates_count
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Breakfast newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Breakfast newQuery()
 * @method static \Illuminate\Database\Query\Builder|Breakfast onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Breakfast query()
 * @method static \Illuminate\Database\Eloquent\Builder|Breakfast whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Breakfast whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Breakfast whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Breakfast whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Breakfast whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Breakfast whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Breakfast withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Breakfast withoutTrashed()
 */
	class Breakfast extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Rate
 *
 * @method static create(array $array)
 * @property mixed $id
 * @property mixed $rate
 * @property mixed $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @property int $breakfast_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Breakfast $breakfast
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Rate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate newQuery()
 * @method static \Illuminate\Database\Query\Builder|Rate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereBreakfastId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Rate withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Rate withoutTrashed()
 */
	class Rate extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property mixed $is_admin
 * @property mixed $id
 * @property mixed $breakfasts
 * @property mixed $avatar
 * @property mixed $created_at
 * @property mixed $name
 * @property mixed $email
 * @property mixed $password
 * @method static find(int $id)
 * @method static create(array $array)
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int|null $breakfasts_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Rate[] $rates
 * @property-read int|null $rates_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

