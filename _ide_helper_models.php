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
 * App\Models\Client
 *
 * @property int $id
 * @property string $document_type
 * @property string $name
 * @property string|null $address
 * @property string|null $phone_office
 * @property string|null $phone_celular
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereDocumentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePhoneCelular($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePhoneOffice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUpdatedAt($value)
 */
	class Client extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Comment
 *
 * @property int $id
 * @property int $user_id
 * @property string $commentable_type
 * @property int $commentable_id
 * @property string $comment
 * @property string $type
 * @property string $action
 * @property bool $done 0: N0, 1: Si
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $commentable
 * @property-read \App\Models\User $creator
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCommentableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCommentableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereDone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUserId($value)
 */
	class Comment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Departament
 *
 * @property string $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|Departament newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Departament newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Departament query()
 * @method static \Illuminate\Database\Eloquent\Builder|Departament whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departament whereName($value)
 */
	class Departament extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\District
 *
 * @property string $id
 * @property string $departament_id
 * @property string $province_id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|District newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|District newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|District query()
 * @method static \Illuminate\Database\Eloquent\Builder|District whereDepartamentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereProvinceId($value)
 */
	class District extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Module
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $route
 * @property string $permission_to_access
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Module newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Module newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Module query()
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module wherePermissionToAccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereRoute($value)
 */
	class Module extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @property int $id
 * @property int $status 0: Inactivo, 1: Activo
 * @property int $type_id
 * @property string $code
 * @property string $description
 * @property int $minimun_stock
 * @property int $measure_id
 * @property string $price
 * @property string $cost
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $alert_stock
 * @property-read mixed $cost_formated
 * @property-read mixed $full_name
 * @property-read mixed $full_stock
 * @property-read mixed $full_stock_formated
 * @property-read mixed $price_formated
 * @property-read \App\Models\ProductMeasure $measure
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Store> $stores
 * @property-read int|null $stores_count
 * @property-read \App\Models\ProductType $type
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMeasureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMinimunStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductMeasure
 *
 * @property int $id
 * @property string $name
 * @property string $alias
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMeasure newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMeasure newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMeasure query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMeasure whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMeasure whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMeasure whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMeasure whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMeasure whereUpdatedAt($value)
 */
	class ProductMeasure extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductPackage
 *
 * @property int $id
 * @property string $name
 * @property string $alias
 * @method static \Illuminate\Database\Eloquent\Builder|ProductPackage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductPackage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductPackage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductPackage whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductPackage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductPackage whereName($value)
 */
	class ProductPackage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductType
 *
 * @property int $id
 * @property string $name
 * @property string $alias
 * @property string $category
 * @property int $package_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $package_name
 * @property-read \App\Models\ProductPackage $package
 * @method static \Illuminate\Database\Eloquent\Builder|ProductType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductType query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductType whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductType whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductType wherePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductType whereUpdatedAt($value)
 */
	class ProductType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Province
 *
 * @property string $id
 * @property string $departament_id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|Province newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Province newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Province query()
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereDepartamentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereName($value)
 */
	class Province extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Store
 *
 * @property int $id
 * @property string $code
 * @property bool $is_principal
 * @property string $name
 * @property string $departament_id
 * @property string $province_id
 * @property string $district_id
 * @property string $address
 * @property int $phone_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Departament $departament
 * @property-read \App\Models\District $district
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @property-read \App\Models\Province $province
 * @method static \Illuminate\Database\Eloquent\Builder|Store hasNestedUsingJoins($relations, $operator = '>=', $count = 1, $boolean = 'and', ?\Closure $callback = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Store joinNestedRelationship(string $relationships, $callback = null, $joinType = 'join', $useAlias = false, bool $disableExtraConditions = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Store joinRelation($relationName, $callback = null, $joinType = 'join', $useAlias = false, bool $disableExtraConditions = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Store joinRelationship($relationName, $callback = null, $joinType = 'join', $useAlias = false, bool $disableExtraConditions = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Store joinRelationshipUsingAlias($relationName, $callback = null, bool $disableExtraConditions = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Store leftJoinRelation($relation, $callback = null, $useAlias = false, bool $disableExtraConditions = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Store leftJoinRelationship($relation, $callback = null, $useAlias = false, bool $disableExtraConditions = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Store leftJoinRelationshipUsingAlias($relationName, $callback = null, bool $disableExtraConditions = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Store newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Store newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Store onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Store orderByLeftPowerJoins($sort, $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Store orderByLeftPowerJoinsAvg($sort, $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Store orderByLeftPowerJoinsCount($sort, $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Store orderByLeftPowerJoinsMax($sort, $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Store orderByLeftPowerJoinsMin($sort, $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Store orderByLeftPowerJoinsSum($sort, $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Store orderByPowerJoins($sort, $direction = 'asc', $aggregation = null, $joinType = 'join')
 * @method static \Illuminate\Database\Eloquent\Builder|Store orderByPowerJoinsAvg($sort, $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Store orderByPowerJoinsCount($sort, $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Store orderByPowerJoinsMax($sort, $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Store orderByPowerJoinsMin($sort, $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Store orderByPowerJoinsSum($sort, $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Store powerJoinDoesntHave($relation, $boolean = 'and', ?\Closure $callback = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Store powerJoinHas($relation, $operator = '>=', $count = 1, $boolean = 'and', $callback = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Store powerJoinWhereHas($relation, $callback = null, $operator = '>=', $count = 1)
 * @method static \Illuminate\Database\Eloquent\Builder|Store query()
 * @method static \Illuminate\Database\Eloquent\Builder|Store rightJoinRelation($relation, $callback = null, $useAlias = false, bool $disableExtraConditions = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Store rightJoinRelationship($relation, $callback = null, $useAlias = false, bool $disableExtraConditions = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Store rightJoinRelationshipUsingAlias($relationName, $callback = null, bool $disableExtraConditions = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereDepartamentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereIsPrincipal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereProvinceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Store withoutTrashed()
 */
	class Store extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Transfer
 *
 * @property int $id
 * @property string $status
 * @property int $origin
 * @property int $destination
 * @property int $requested_by
 * @property string|null $approved_at
 * @property string|null $rejected_at
 * @property string|null $canceled_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Comment> $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @property-read \App\Models\Store $storeDestination
 * @property-read \App\Models\Store $storeOrigin
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereCanceledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereDestination($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereOrigin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereRejectedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereRequestedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereUpdatedAt($value)
 */
	class Transfer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property bool $status 0: Inactivo, 1: Activo
 * @property string $dni
 * @property string $name
 * @property string $username
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $created_by
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $role_name
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Store> $stores
 * @property-read int|null $stores_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDni($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

