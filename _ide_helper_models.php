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
 * App\Models\Approval
 *
 * @property int $id
 * @property int $user_id
 * @property string $approvable_type
 * @property int $approvable_id
 * @property string $comment
 * @property string $type
 * @property string|null $action
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $approvable
 * @property-read \App\Models\User $creator
 * @method static \Illuminate\Database\Eloquent\Builder|Approval newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Approval newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Approval query()
 * @method static \Illuminate\Database\Eloquent\Builder|Approval whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Approval whereApprovableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Approval whereApprovableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Approval whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Approval whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Approval whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Approval whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Approval whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Approval whereUserId($value)
 */
	class Approval extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BiilItem
 *
 * @property int $id
 * @property string $bill_id
 * @property int $product_id
 * @property int $quantity
 * @property string $measure
 * @property string $unit_price
 * @property string $discount
 * @property string $total
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|BiilItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BiilItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BiilItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|BiilItem whereBillId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BiilItem whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BiilItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BiilItem whereMeasure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BiilItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BiilItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BiilItem whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BiilItem whereUnitPrice($value)
 */
	class BiilItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Bill
 *
 * @property string $id
 * @property string $sale_id
 * @property int $client_id
 * @property string $type
 * @property string $serie
 * @property string $number
 * @property string $currency
 * @property string $igv_percent
 * @property string $total_grabada
 * @property string $total_inafecta
 * @property string $total_exonerada
 * @property string $total_igv
 * @property string $total
 * @property string $observations
 * @property string $emition_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client $client
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillItem> $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|Bill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bill query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereEmitionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereIgvPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereObservations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereSerie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereTotalExonerada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereTotalGrabada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereTotalIgv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereTotalInafecta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereUpdatedAt($value)
 */
	class Bill extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BillItem
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BillItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillItem query()
 */
	class BillItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Client
 *
 * @property int $id
 * @property string $document_type
 * @property string $document_number
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
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereDocumentNumber($value)
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
 * @property string|null $action
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
 * App\Models\InputType
 *
 * @property int $id
 * @property string $name
 * @property string $alias
 * @method static \Illuminate\Database\Eloquent\Builder|InputType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InputType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InputType query()
 * @method static \Illuminate\Database\Eloquent\Builder|InputType whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InputType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InputType whereName($value)
 */
	class InputType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Justification
 *
 * @property int $id
 * @property int $user_id
 * @property string $justifiable_type
 * @property int $justifiable_id
 * @property string $justification
 * @property string|null $action
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $creator
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $justifiable
 * @method static \Illuminate\Database\Eloquent\Builder|Justification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Justification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Justification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Justification whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Justification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Justification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Justification whereJustifiableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Justification whereJustifiableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Justification whereJustification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Justification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Justification whereUserId($value)
 */
	class Justification extends \Eloquent {}
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
 * App\Models\Order
 *
 * @property int $id
 * @property string $status
 * @property int $supplier_id
 * @property string $date
 * @property string $cost
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Approval> $approvals
 * @property-read int|null $approvals_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Comment> $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrderDetail> $details
 * @property-read int|null $details_count
 * @property-read mixed $cost_formated
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Approval> $justifications
 * @property-read int|null $justifications_count
 * @property-read \App\Models\Supplier $supplier
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderDetail
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $packages
 * @property int $quantity_per_packages
 * @property int $total
 * @property string $cost
 * @property-read mixed $cost_formated
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail wherePackages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereQuantityPerPackages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereTotal($value)
 */
	class OrderDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OutputType
 *
 * @property int $id
 * @property string $name
 * @property string $alias
 * @method static \Illuminate\Database\Eloquent\Builder|OutputType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OutputType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OutputType query()
 * @method static \Illuminate\Database\Eloquent\Builder|OutputType whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OutputType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OutputType whereName($value)
 */
	class OutputType extends \Eloquent {}
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Warehouse> $warehouses
 * @property-read int|null $warehouses_count
 * @method static \Database\Factories\ProductFactory factory($count = null, $state = [])
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
 * @property int $package_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $package_name
 * @property-read \App\Models\ProductPackage $package
 * @method static \Illuminate\Database\Eloquent\Builder|ProductType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductType query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductType whereAlias($value)
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
 * App\Models\STMovementDetail
 *
 * @property int $id
 * @property int $movement_id
 * @property int $product_id
 * @property int $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\StoreMovement $parent
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|STMovementDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|STMovementDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|STMovementDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|STMovementDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|STMovementDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|STMovementDetail whereMovementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|STMovementDetail whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|STMovementDetail whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|STMovementDetail whereUpdatedAt($value)
 */
	class STMovementDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Sale
 *
 * @property string $id
 * @property string $number
 * @property string $status
 * @property int $client_id
 * @property int $store_id
 * @property int $user_id
 * @property int $has_discount
 * @property string $currency
 * @property int|null $discount_percent
 * @property string|null $total_discount
 * @property string $sub_total
 * @property string $total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client $client
 * @property-read mixed $total_formated
 * @property-read \App\Models\SaleJustification|null $justification
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SaleProduct> $products
 * @property-read int|null $products_count
 * @property-read \App\Models\Store $store
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Sale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereDiscountPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereHasDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereSubTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereTotalDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereUserId($value)
 */
	class Sale extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SaleJustification
 *
 * @property int $id
 * @property string $sale_id
 * @property int $user_id
 * @property string $justification
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|SaleJustification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleJustification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleJustification query()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleJustification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleJustification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleJustification whereJustification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleJustification whereSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleJustification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleJustification whereUserId($value)
 */
	class SaleJustification extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SaleProduct
 *
 * @property int $id
 * @property string $sale_id
 * @property int $product_id
 * @property int $type_id
 * @property int $quantity_type
 * @property int $quantity_total
 * @property string $unit_price
 * @property string $total
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\SaleType $type
 * @method static \Illuminate\Database\Eloquent\Builder|SaleProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleProduct whereQuantityTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleProduct whereQuantityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleProduct whereSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleProduct whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleProduct whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleProduct whereUnitPrice($value)
 */
	class SaleProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SaleType
 *
 * @property int $id
 * @property string $name
 * @property string $alias
 * @property int $quantity
 * @method static \Illuminate\Database\Eloquent\Builder|SaleType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleType query()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleType whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleType whereQuantity($value)
 */
	class SaleType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Store
 *
 * @property int $id
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StoreMovement> $movements
 * @property-read int|null $movements_count
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
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereDepartamentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereId($value)
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
 * App\Models\StoreMovement
 *
 * @property int $id
 * @property string $type
 * @property int|null $input_type_id
 * @property int|null $output_type_id
 * @property string|null $type_action
 * @property int $store_id
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\STMovementDetail> $details
 * @property-read int|null $details_count
 * @property-read \App\Models\InputType|null $input
 * @property-read \App\Models\OutputType|null $output
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\Store $store
 * @method static \Illuminate\Database\Eloquent\Builder|StoreMovement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreMovement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreMovement query()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreMovement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreMovement whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreMovement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreMovement whereInputTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreMovement whereOutputTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreMovement whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreMovement whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreMovement whereTypeAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreMovement whereUpdatedAt($value)
 */
	class StoreMovement extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Supplier
 *
 * @property int $id
 * @property string $status
 * @property string $ruc
 * @property string $name
 * @property string|null $address
 * @property string|null $phone_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier query()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereRuc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereUpdatedAt($value)
 */
	class Supplier extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Transfer
 *
 * @property int $id
 * @property string $status
 * @property int $warehouse_id
 * @property int $store_id
 * @property int $requested_by
 * @property string|null $approved_at
 * @property string|null $rejected_at
 * @property string|null $canceled_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Approval> $approvals
 * @property-read int|null $approvals_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Comment> $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Justification> $justifications
 * @property-read int|null $justifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @property-read \App\Models\User $requested
 * @property-read \App\Models\Store $store
 * @property-read \App\Models\Warehouse $warehouse
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereCanceledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereRejectedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereRequestedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereWarehouseId($value)
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

namespace App\Models{
/**
 * App\Models\WRMovementDetail
 *
 * @property int $id
 * @property int $movement_id
 * @property int $product_id
 * @property int|null $packages
 * @property int|null $quantity_per_packages
 * @property int $total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\WareHouseMovement $parent
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|WRMovementDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WRMovementDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WRMovementDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|WRMovementDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WRMovementDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WRMovementDetail whereMovementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WRMovementDetail wherePackages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WRMovementDetail whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WRMovementDetail whereQuantityPerPackages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WRMovementDetail whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WRMovementDetail whereUpdatedAt($value)
 */
	class WRMovementDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WareHouseMovement
 *
 * @property int $id
 * @property string $type
 * @property int|null $input_type_id
 * @property int|null $output_type_id
 * @property string|null $type_action
 * @property int $warehouse_id
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WRMovementDetail> $details
 * @property-read int|null $details_count
 * @property-read \App\Models\InputType|null $input
 * @property-read \App\Models\OutputType|null $output
 * @property-read \App\Models\Warehouse $warehouse
 * @method static \Illuminate\Database\Eloquent\Builder|WareHouseMovement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WareHouseMovement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WareHouseMovement query()
 * @method static \Illuminate\Database\Eloquent\Builder|WareHouseMovement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WareHouseMovement whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WareHouseMovement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WareHouseMovement whereInputTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WareHouseMovement whereOutputTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WareHouseMovement whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WareHouseMovement whereTypeAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WareHouseMovement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WareHouseMovement whereWarehouseId($value)
 */
	class WareHouseMovement extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Warehouse
 *
 * @property int $id
 * @property string $name
 * @property string $departament_id
 * @property string $province_id
 * @property string $district_id
 * @property string $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Departament $departament
 * @property-read \App\Models\District $district
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WareHouseMovement> $movements
 * @property-read int|null $movements_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @property-read \App\Models\Province $province
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse query()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereDepartamentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereProvinceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereUpdatedAt($value)
 */
	class Warehouse extends \Eloquent {}
}

