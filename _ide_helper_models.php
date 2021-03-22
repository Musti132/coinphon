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
 * App\Models\Order
 *
 * @property int $id
 * @property string $order_id
 * @property int $wallet_id
 * @property string $amount
 * @property string $amount_fiat
 * @property string $address
 * @property int $status
 * @property string $expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Transaction|null $transaction
 * @property-read \App\Models\Wallet $wallet
 * @method static \Database\Factories\OrderFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAmountFiat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereWalletId($value)
 * @mixin \Eloquent
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PhoneNumber
 *
 * @property int $id
 * @property string $number
 * @property int $country_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\PhoneNumberFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber query()
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class PhoneNumber extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Server
 *
 * @property int $id
 * @property string $label
 * @property string $host
 * @property int $port
 * @property int $region_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ServerRegion|null $region
 * @method static \Database\Factories\ServerFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Server newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Server newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Server query()
 * @method static \Illuminate\Database\Eloquent\Builder|Server whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Server whereHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Server whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Server whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Server wherePort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Server whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Server whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Server extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ServerRegion
 *
 * @property int $id
 * @property int $region
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ServerRegionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ServerRegion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServerRegion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServerRegion query()
 * @method static \Illuminate\Database\Eloquent\Builder|ServerRegion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServerRegion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServerRegion whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServerRegion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ServerRegion extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property string $txid
 * @property string $received
 * @property string $received_fiat
 * @property int $confirmations
 * @property string $from_address
 * @property int $order_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Order $order
 * @method static \Database\Factories\TransactionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereConfirmations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereFromAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereReceived($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereReceivedFiat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTxid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Transaction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property string $id
 * @property string $email
 * @property string $first
 * @property string $last
 * @property int $country_id
 * @property int $is_business
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $business_id
 * @property int|null $phone_id
 * @property-read \App\Models\Business|null $business
 * @property-read \App\Models\Country|null $country
 * @property-read mixed $country_name
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \App\Models\PhoneNumber|null $phone
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Wallet[] $wallets
 * @property-read int|null $wallets_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsBusiness($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLast($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent implements \Tymon\JWTAuth\Contracts\JWTSubject {}
}

namespace App\Models{
/**
 * App\Models\Wallet
 *
 * @property int $id
 * @property string $uuid
 * @property string $label
 * @property string $full_label
 * @property int $type_id
 * @property int $status
 * @property string $user_id
 * @property int $server_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $owner
 * @property-read \App\Models\WalletPublicKey $publicKey
 * @property-read \App\Models\Server|null $server
 * @property-read \App\Models\WalletType|null $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Webhook[] $webhooks
 * @property-read int|null $webhooks_count
 * @method static \Database\Factories\WalletFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereFullLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereServerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereUuid($value)
 * @mixin \Eloquent
 */
	class Wallet extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WalletType
 *
 * @property int $id
 * @property string $short
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @method static \Database\Factories\WalletTypeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WalletType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WalletType query()
 * @method static \Illuminate\Database\Eloquent\Builder|WalletType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletType whereShort($value)
 * @mixin \Eloquent
 */
	class WalletType extends \Eloquent {}
}

