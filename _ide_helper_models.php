<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\BaseModel
 *
 * @mixin IdeHelperBaseModel
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel query()
 */
	class BaseModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Cycle
 *
 * @mixin IdeHelperCycle
 * @property int $id
 * @property int $user_id
 * @property string $date_debut
 * @property string $date_fin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $longueur_cycle
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\CycleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Cycle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cycle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cycle query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cycle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cycle whereDateDebut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cycle whereDateFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cycle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cycle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cycle whereUserId($value)
 */
	class Cycle extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OpeningHours
 *
 * @mixin IdeHelperOpeningHours
 * @property int $id
 * @property int $pharmacy_id
 * @property string $day
 * @property string|null $opening_time
 * @property string|null $closing_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Pharmacy $pharmacy
 * @method static \Database\Factories\OpeningHoursFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|OpeningHours newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OpeningHours newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OpeningHours query()
 * @method static \Illuminate\Database\Eloquent\Builder|OpeningHours whereClosingTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpeningHours whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpeningHours whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpeningHours whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpeningHours whereOpeningTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpeningHours wherePharmacyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpeningHours whereUpdatedAt($value)
 */
	class OpeningHours extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order
 *
 * @mixin IdeHelperOrder
 * @property int $id
 * @property int $user_id
 * @property int|null $request_number
 * @property float $priceTotal
 * @property \App\Models\Enums\OrderStatus $status
 * @property string|null $adresLivraison
 * @property string|null $lat
 * @property string|null $lng
 * @property int $current_radius
 * @property string|null $answered_at
 * @property array|null $notified_pharmacies
 * @property \App\Models\Enums\PayementType|null $modePayement
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrderDetail> $details
 * @property-read int|null $details_count
 * @property-read int $request_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrderPharmacy> $orderPharmacies
 * @property-read int|null $order_pharmacies_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pharmacy> $pharmacies
 * @property-read int|null $pharmacies_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\OrderFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAdresLivraison($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAnsweredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCurrentRadius($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereModePayement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereNotifiedPharmacies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePriceTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereRequestNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderDetail
 *
 * @mixin IdeHelperOrderDetail
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property \App\Models\Enums\OrderdetailStatus $status
 * @property int $quantity
 * @property float $priceUnitaire
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $path_url
 * @property-read mixed $product_name
 * @property-read mixed $sub_total
 * @property-read \App\Models\Order $order
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrderPharmacyDetail> $pharmacyDetails
 * @property-read int|null $pharmacy_details_count
 * @property-read \App\Models\Product $product
 * @method static \Database\Factories\OrderDetailFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail wherePriceUnitaire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail whereUpdatedAt($value)
 */
	class OrderDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderPharmacy
 *
 * @property int $id
 * @property int $order_id
 * @property int $pharmacy_id
 * @property \App\Models\Enums\OrderPharmacyStatus $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read int $treated_count
 * @property-read \App\Models\Order $order
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrderPharmacyDetail> $orderpharmacydetails
 * @property-read int|null $orderpharmacydetails_count
 * @property-read \App\Models\Pharmacy $pharmacy
 * @method static \Database\Factories\OrderPharmacyFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPharmacy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPharmacy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPharmacy query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPharmacy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPharmacy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPharmacy whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPharmacy wherePharmacyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPharmacy whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPharmacy whereUpdatedAt($value)
 */
	class OrderPharmacy extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderPharmacyDetail
 *
 * @property int $id
 * @property int $order_pharmacy_id
 * @property int $order_detail_id
 * @property bool $available
 * @property int $quantity
 * @property float $price
 * @property float $total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\OrderDetail $orderDetail
 * @property-read \App\Models\OrderPharmacy $orderPharmacy
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPharmacyDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPharmacyDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPharmacyDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPharmacyDetail whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPharmacyDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPharmacyDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPharmacyDetail whereOrderDetailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPharmacyDetail whereOrderPharmacyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPharmacyDetail wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPharmacyDetail whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPharmacyDetail whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPharmacyDetail whereUpdatedAt($value)
 */
	class OrderPharmacyDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Payement
 *
 * @mixin IdeHelperPayement
 * @property int $id
 * @property int $order_id
 * @property int $user_id
 * @property int $amount
 * @property \App\Models\Enums\PayementType $methodPayement
 * @property \App\Models\Enums\PayementStatus $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\PayementFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Payement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereMethodPayement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereUserId($value)
 */
	class Payement extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Pharmacy
 *
 * @mixin IdeHelperPharmacy
 * @property int $id
 * @property int|null $pharmacien_id
 * @property string $name
 * @property string $adresse
 * @property string $phone
 * @property string|null $lat
 * @property string|null $lng
 * @property int $is_on_duty
 * @property string|null $socket_channel
 * @property string|null $groupe
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $is_open_now
 * @property-read mixed $pharmacien_name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OpeningHours> $openingHours
 * @property-read int|null $opening_hours_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrderPharmacy> $orderPharmacies
 * @property-read int|null $order_pharmacies_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Order> $orders
 * @property-read int|null $orders_count
 * @property-read \App\Models\User|null $pharmacien
 * @method static \Database\Factories\PharmacyFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy nearby($lat, $lng, $radiusKm = 2)
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy whereAdresse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy whereGroupe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy whereIsOnDuty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy wherePharmacienId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy whereSocketChannel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pharmacy whereUpdatedAt($value)
 */
	class Pharmacy extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PharmacyGarde
 *
 * @mixin IdeHelperPharmacyGarde
 * @property int $id
 * @property string $date_debut
 * @property string $date_fin
 * @property string $groupe
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\PharmacyGardeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacyGarde newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacyGarde newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacyGarde query()
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacyGarde whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacyGarde whereDateDebut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacyGarde whereDateFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacyGarde whereGroupe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacyGarde whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacyGarde whereUpdatedAt($value)
 */
	class PharmacyGarde extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Pilrember
 *
 * @property int $id
 * @property int $user_id
 * @property string $medicine_name
 * @property \Illuminate\Support\Carbon $start_date
 * @property string $reminder_time
 * @property string $form
 * @property string $frequency
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\PilremberFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Pilrember newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pilrember newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pilrember query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pilrember whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pilrember whereForm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pilrember whereFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pilrember whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pilrember whereMedicineName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pilrember whereReminderTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pilrember whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pilrember whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pilrember whereUserId($value)
 */
	class Pilrember extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @mixin IdeHelperProduct
 * @property int $id
 * @property string|null $image
 * @property string $name
 * @property string $description
 * @property float $price
 * @property \App\Models\Enums\ProductType $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $image_url
 * @method static \Database\Factories\ProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Tip
 *
 * @mixin IdeHelperTip
 * @property int $id
 * @property string|null $title
 * @property string|null $icon
 * @property string $content
 * @property string|null $date_for
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\TipFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Tip newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tip newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tip query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tip whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tip whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tip whereDateFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tip whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tip whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tip whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tip whereUpdatedAt($value)
 */
	class Tip extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @mixin IdeHelperUser
 * @property int $id
 * @property string|null $google_id
 * @property string|null $userName
 * @property string|null $lastName
 * @property string|null $firstName
 * @property string|null $phone
 * @property \Illuminate\Support\Carbon|null $birthDate
 * @property string|null $birthPlace
 * @property string|null $email
 * @property mixed|null $password
 * @property \App\Models\Enums\UserType $type
 * @property \App\Models\Enums\ModelStatus $status
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $pharmacie_name
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Pharmacy|null $pharmacie
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User notAdmin()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBirthPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGoogleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserName($value)
 */
	class User extends \Eloquent {}
}

