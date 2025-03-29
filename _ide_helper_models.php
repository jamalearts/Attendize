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
 * App\Models\Account
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property int|null $timezone_id
 * @property int|null $date_format_id
 * @property int|null $datetime_format_id
 * @property int|null $currency_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $name
 * @property string|null $last_ip
 * @property string|null $last_login_date
 * @property string|null $address1
 * @property string|null $address2
 * @property string|null $city
 * @property string|null $state
 * @property string|null $postal_code
 * @property int|null $country_id
 * @property string|null $email_footer
 * @property int $is_active
 * @property int $is_banned
 * @property int $is_beta
 * @property string|null $stripe_access_token
 * @property string|null $stripe_refresh_token
 * @property string|null $stripe_secret_key
 * @property string|null $stripe_publishable_key
 * @property string|null $stripe_data_raw
 * @property int $payment_gateway_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountPaymentGateway[] $account_payment_gateways
 * @property-read int|null $account_payment_gateways_count
 * @property-read \App\Models\AccountPaymentGateway|null $active_payment_gateway
 * @property-read \App\Models\Currency|null $currency
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountPaymentGateway[] $gateways
 * @property-read int|null $gateways_count
 * @property-read \Illuminate\Support\Collection|mixed|static $stripe_api_key
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account newQuery()
 * @method static \Illuminate\Database\Query\Builder|Account onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Account query()
 * @method static \Illuminate\Database\Eloquent\Builder|MyBaseModel scope($accountId = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereDateFormatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereDatetimeFormatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereEmailFooter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereIsBanned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereIsBeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereLastIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereLastLoginDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account wherePaymentGatewayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereStripeAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereStripeDataRaw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereStripePublishableKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereStripeRefreshToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereStripeSecretKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereTimezoneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Account withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Account withoutTrashed()
 */
	class Account extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AccountPaymentGateway
 *
 * @property int $id
 * @property int $account_id
 * @property int $payment_gateway_id
 * @property mixed $config
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Account $account
 * @property-read \App\Models\PaymentGateway $payment_gateway
 * @method static \Illuminate\Database\Eloquent\Builder|AccountPaymentGateway newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountPaymentGateway newQuery()
 * @method static \Illuminate\Database\Query\Builder|AccountPaymentGateway onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountPaymentGateway query()
 * @method static \Illuminate\Database\Eloquent\Builder|MyBaseModel scope($accountId = false)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountPaymentGateway whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountPaymentGateway whereConfig($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountPaymentGateway whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountPaymentGateway whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountPaymentGateway whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountPaymentGateway wherePaymentGatewayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountPaymentGateway whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AccountPaymentGateway withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AccountPaymentGateway withoutTrashed()
 */
	class AccountPaymentGateway extends \Eloquent {}
}

namespace App\Models{
/**
 * Description of Activity.
 *
 * @author Dave
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity query()
 */
	class Activity extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Affiliate
 *
 * @property int $id
 * @property string $name
 * @property int $visits
 * @property int $tickets_sold
 * @property string $sales_volume
 * @property string $last_visit
 * @property int $account_id
 * @property int $event_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate query()
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate whereLastVisit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate whereSalesVolume($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate whereTicketsSold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate whereVisits($value)
 */
	class Affiliate extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Attendee
 *
 * @property bool is_cancelled
 * @property Order order
 * @property string first_name
 * @property string last_name
 * @property int $id
 * @property int $order_id
 * @property int $event_id
 * @property int $ticket_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $private_reference_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property bool $is_cancelled
 * @property int $has_arrived
 * @property \Illuminate\Support\Carbon|null $arrival_time
 * @property int $account_id
 * @property int $reference_index
 * @property bool $is_refunded
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuestionAnswer[] $answers
 * @property-read int|null $answers_count
 * @property-read \App\Models\Event $event
 * @property-read string $full_name
 * @property-read string $reference
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\Ticket $ticket
 * @method static \Illuminate\Database\Eloquent\Builder|Attendee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attendee newQuery()
 * @method static \Illuminate\Database\Query\Builder|Attendee onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Attendee query()
 * @method static \Illuminate\Database\Eloquent\Builder|MyBaseModel scope($accountId = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendee whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendee whereArrivalTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendee whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendee whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendee whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendee whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendee whereHasArrived($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendee whereIsCancelled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendee whereIsRefunded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendee whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendee whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendee wherePrivateReferenceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendee whereReferenceIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendee whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendee whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Attendee withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Attendee withoutCancelled()
 * @method static \Illuminate\Database\Query\Builder|Attendee withoutTrashed()
 */
	class Attendee extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Category
 *
 * @property int $id
 * @property int $event_id
 * @property int $account_id
 * @property int $user_id
 * @property string $name
 * @property string $status
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Conference[] $conferences
 * @property-read int|null $conferences_count
 * @property-read \App\Models\Event $event
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|MyBaseModel scope($accountId = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUserId($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Conference
 *
 * @property int $id
 * @property int $event_id
 * @property int $account_id
 * @property int $user_id
 * @property string $name
 * @property string $status
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read \App\Models\Event $event
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Profession[] $professions
 * @property-read int|null $professions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Conference newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conference newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conference query()
 * @method static \Illuminate\Database\Eloquent\Builder|MyBaseModel scope($accountId = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Conference whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conference whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conference whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conference whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conference whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conference whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conference whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conference whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conference whereUserId($value)
 */
	class Conference extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Country
 *
 * @property int $id
 * @property string|null $capital
 * @property string|null $citizenship
 * @property string $country_code
 * @property string|null $currency
 * @property string|null $currency_code
 * @property string|null $currency_sub_unit
 * @property string|null $full_name
 * @property string $iso_3166_2
 * @property string $iso_3166_3
 * @property string $name
 * @property string $region_code
 * @property string $sub_region_code
 * @property int $eea
 * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCapital($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCitizenship($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCurrencyCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCurrencySubUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereEea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereIso31662($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereIso31663($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereRegionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereSubRegionCode($value)
 */
	class Country extends \Eloquent {}
}

namespace App\Models{
/**
 * Description of Currency.
 *
 * @author Dave
 * @property int $id
 * @property string $title
 * @property string $symbol_left
 * @property string $symbol_right
 * @property string $code
 * @property int $decimal_place
 * @property float $value
 * @property string $decimal_point
 * @property string $thousand_point
 * @property int $status
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\Models\Event $event
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereDecimalPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereDecimalPoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereSymbolLeft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereSymbolRight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereThousandPoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereValue($value)
 */
	class Currency extends \Eloquent {}
}

namespace App\Models{
/**
 * Description of DateFormat.
 *
 * @author Dave
 * @property int $id
 * @property string $format
 * @property string $picker_format
 * @property string $label
 * @method static \Illuminate\Database\Eloquent\Builder|DateFormat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DateFormat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DateFormat query()
 * @method static \Illuminate\Database\Eloquent\Builder|DateFormat whereFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DateFormat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DateFormat whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DateFormat wherePickerFormat($value)
 */
	class DateFormat extends \Eloquent {}
}

namespace App\Models{
/**
 * Description of DateTimeFormat.
 *
 * @author Dave
 * @property int $id
 * @property string $format
 * @property string $picker_format
 * @property string $label
 * @method static \Illuminate\Database\Eloquent\Builder|DateTimeFormat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DateTimeFormat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DateTimeFormat query()
 * @method static \Illuminate\Database\Eloquent\Builder|DateTimeFormat whereFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DateTimeFormat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DateTimeFormat whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DateTimeFormat wherePickerFormat($value)
 */
	class DateTimeFormat extends \Eloquent {}
}

namespace App\Models{
/**
 * Description of DiscountCode.
 *
 * @author Dave
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscountCode query()
 */
	class DiscountCode extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DynamicFormField
 *
 * @property int $id
 * @property int $registration_id
 * @property string $label
 * @property string $name
 * @property string $type
 * @property array|null $options
 * @property bool $is_required
 * @property int $sort_order
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Registration $registration
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DynamicFormFieldValue[] $values
 * @property-read int|null $values_count
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicFormField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicFormField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicFormField query()
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicFormField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicFormField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicFormField whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicFormField whereIsRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicFormField whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicFormField whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicFormField whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicFormField whereRegistrationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicFormField whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicFormField whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicFormField whereUpdatedAt($value)
 */
	class DynamicFormField extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DynamicFormFieldValue
 *
 * @property int $id
 * @property int $registration_user_id
 * @property int $dynamic_form_field_id
 * @property string|null $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DynamicFormField $field
 * @property-read \App\Models\RegistrationUser $registrationUser
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicFormFieldValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicFormFieldValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicFormFieldValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicFormFieldValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicFormFieldValue whereDynamicFormFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicFormFieldValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicFormFieldValue whereRegistrationUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicFormFieldValue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DynamicFormFieldValue whereValue($value)
 */
	class DynamicFormFieldValue extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Event
 *
 * @property int start_date
 * @property int $id
 * @property string $title
 * @property string|null $location
 * @property string $bg_type
 * @property string $bg_color
 * @property string|null $bg_image_path
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property string|null $on_sale_date
 * @property int $account_id
 * @property int $user_id
 * @property int|null $currency_id
 * @property string $organiser_fee_fixed
 * @property string $organiser_fee_percentage
 * @property int $organiser_id
 * @property string $venue_name
 * @property string|null $venue_name_full
 * @property string|null $location_address
 * @property string|null $location_address_line_1
 * @property string|null $location_address_line_2
 * @property string|null $location_country
 * @property string|null $location_country_code
 * @property string|null $location_state
 * @property string|null $location_post_code
 * @property string|null $location_street_number
 * @property string|null $location_lat
 * @property string|null $location_long
 * @property string|null $location_google_place_id
 * @property string|null $pre_order_display_message
 * @property string|null $post_order_display_message
 * @property string|null $social_share_text
 * @property int $social_show_facebook
 * @property int $social_show_linkedin
 * @property int $social_show_twitter
 * @property int $social_show_email
 * @property int $location_is_manual
 * @property int $is_live
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string $barcode_type
 * @property string $ticket_border_color
 * @property string $ticket_bg_color
 * @property string $ticket_text_color
 * @property string $ticket_sub_text_color
 * @property string|null $google_tag_manager_code
 * @property int $social_show_whatsapp
 * @property string $questions_collection_type
 * @property int $checkout_timeout_after
 * @property int $is_1d_barcode_enabled
 * @property int $enable_offline_payments
 * @property string|null $offline_payment_instructions
 * @property string|null $event_image_position
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventAccessCodes[] $access_codes
 * @property-read int|null $access_codes_count
 * @property-read \App\Models\Account $account
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Affiliate[] $affiliates
 * @property-read int|null $affiliates_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Attendee[] $attendees
 * @property-read int|null $attendees_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Conference[] $conferences
 * @property-read int|null $conferences_count
 * @property-read \App\Models\Currency|null $currency
 * @property-read string $bg_image_url
 * @property-read \Illuminate\Support\Collection $currency_code
 * @property-read \Illuminate\Support\Collection $currency_symbol
 * @property-read string $embed_html_code
 * @property-read mixed $embed_url
 * @property-read string $event_url
 * @property-read mixed $fixed_fee
 * @property-read bool $happening_now
 * @property-read mixed $map_address
 * @property-read mixed $percentage_fee
 * @property-read \Illuminate\Support\Collection|mixed|static $sales_and_fees_voulme
 * @property-read mixed $slug
 * @property-read array $survey_answers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Message[] $messages
 * @property-read int|null $messages_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \App\Models\Organiser $organiser
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions
 * @property-read int|null $questions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions_with_trashed
 * @property-read int|null $questions_with_trashed_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Registration[] $registrations
 * @property-read int|null $registrations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventStats[] $stats
 * @property-read int|null $stats_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ticket[] $tickets
 * @property-read int|null $tickets_count
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Query\Builder|Event onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|MyBaseModel scope($accountId = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereBarcodeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereBgColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereBgImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereBgType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCheckoutTimeoutAfter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEnableOfflinePayments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEventImagePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereGoogleTagManagerCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereIs1dBarcodeEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereIsLive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereLocationAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereLocationAddressLine1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereLocationAddressLine2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereLocationCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereLocationCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereLocationGooglePlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereLocationIsManual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereLocationLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereLocationLong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereLocationPostCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereLocationState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereLocationStreetNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereOfflinePaymentInstructions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereOnSaleDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereOrganiserFeeFixed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereOrganiserFeePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereOrganiserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event wherePostOrderDisplayMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event wherePreOrderDisplayMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereQuestionsCollectionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereSocialShareText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereSocialShowEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereSocialShowFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereSocialShowLinkedin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereSocialShowTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereSocialShowWhatsapp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereTicketBgColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereTicketBorderColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereTicketSubTextColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereTicketTextColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereVenueName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereVenueNameFull($value)
 * @method static \Illuminate\Database\Query\Builder|Event withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Event withoutTrashed()
 */
	class Event extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EventAccessCodes
 *
 * @property int $id
 * @property int $event_id
 * @property string $code
 * @property int $usage_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Event $event
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ticket[] $tickets
 * @property-read int|null $tickets_count
 * @method static \Illuminate\Database\Eloquent\Builder|EventAccessCodes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventAccessCodes newQuery()
 * @method static \Illuminate\Database\Query\Builder|EventAccessCodes onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EventAccessCodes query()
 * @method static \Illuminate\Database\Eloquent\Builder|MyBaseModel scope($accountId = false)
 * @method static \Illuminate\Database\Eloquent\Builder|EventAccessCodes whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventAccessCodes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventAccessCodes whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventAccessCodes whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventAccessCodes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventAccessCodes whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventAccessCodes whereUsageCount($value)
 * @method static \Illuminate\Database\Query\Builder|EventAccessCodes withTrashed()
 * @method static \Illuminate\Database\Query\Builder|EventAccessCodes withoutTrashed()
 */
	class EventAccessCodes extends \Eloquent {}
}

namespace App\Models{
/**
 * Description of EventImage.
 *
 * @author Dave
 * @property int $id
 * @property string $image_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $event_id
 * @property int $account_id
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|EventImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|MyBaseModel scope($accountId = false)
 * @method static \Illuminate\Database\Eloquent\Builder|EventImage whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventImage whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventImage whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventImage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventImage whereUserId($value)
 */
	class EventImage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EventStats
 *
 * @property int $id
 * @property string $date
 * @property int $views
 * @property int $unique_views
 * @property int $tickets_sold
 * @property string $sales_volume
 * @property string $organiser_fees_volume
 * @property int $event_id
 * @method static \Illuminate\Database\Eloquent\Builder|EventStats newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventStats newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventStats query()
 * @method static \Illuminate\Database\Eloquent\Builder|EventStats whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventStats whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventStats whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventStats whereOrganiserFeesVolume($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventStats whereSalesVolume($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventStats whereTicketsSold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventStats whereUniqueViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventStats whereViews($value)
 */
	class EventStats extends \Eloquent {}
}

namespace App\Models{
/**
 * Description of Message.
 *
 * @author Dave
 * @property int $id
 * @property string $message
 * @property string $subject
 * @property string|null $recipients
 * @property int $account_id
 * @property int $user_id
 * @property int $event_id
 * @property int $is_sent
 * @property \Illuminate\Support\Carbon|null $sent_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Event $event
 * @property-read string $recipients_label
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|MyBaseModel scope($accountId = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereIsSent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereRecipients($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereSentAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUserId($value)
 */
	class Message extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MyBaseModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|MyBaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MyBaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MyBaseModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|MyBaseModel scope($accountId = false)
 */
	class MyBaseModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $account_id
 * @property int $order_status_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string|null $business_name
 * @property string|null $business_tax_number
 * @property string|null $business_address_line_one
 * @property string|null $business_address_line_two
 * @property string|null $business_address_state_province
 * @property string|null $business_address_city
 * @property string|null $business_address_code
 * @property string|null $ticket_pdf_path
 * @property string $order_reference
 * @property string|null $transaction_id
 * @property string|null $discount
 * @property string|null $booking_fee
 * @property string|null $organiser_booking_fee
 * @property string|null $order_date
 * @property string|null $notes
 * @property int $is_deleted
 * @property int $is_cancelled
 * @property bool $is_partially_refunded
 * @property bool $is_refunded
 * @property string $amount
 * @property string|null $amount_refunded
 * @property int $event_id
 * @property int|null $payment_gateway_id
 * @property int $is_payment_received
 * @property bool $is_business
 * @property float $taxamt
 * @property string $payment_intent
 * @property-read \App\Models\Account $account
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Attendee[] $attendees
 * @property-read int|null $attendees_count
 * @property-read \App\Models\Event $event
 * @property-read string $full_name
 * @property-read \Illuminate\Support\Collection|mixed|static $organiser_amount
 * @property-read \Illuminate\Support\Collection|mixed|static $total_amount
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderItem[] $orderItems
 * @property-read int|null $order_items_count
 * @property-read \App\Models\OrderStatus $orderStatus
 * @property-read \App\Models\PaymentGateway|null $payment_gateway
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ticket[] $tickets
 * @property-read int|null $tickets_count
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Query\Builder|Order onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|MyBaseModel scope($accountId = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAmountRefunded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBookingFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBusinessAddressCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBusinessAddressCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBusinessAddressLineOne($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBusinessAddressLineTwo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBusinessAddressStateProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBusinessName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBusinessTaxNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereIsBusiness($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereIsCancelled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereIsPartiallyRefunded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereIsPaymentReceived($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereIsRefunded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrganiserBookingFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaymentGatewayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaymentIntent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTaxamt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTicketPdfPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Order withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Order withoutTrashed()
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * Description of OrderItems.
 *
 * @author Dave
 * @property int $id
 * @property string $title
 * @property int $quantity
 * @property string $unit_price
 * @property string|null $unit_booking_fee
 * @property int $order_id
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|MyBaseModel scope($accountId = false)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereUnitBookingFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereUnitPrice($value)
 */
	class OrderItem extends \Eloquent {}
}

namespace App\Models{
/**
 * Description of OrderStatus.
 *
 * @author Dave
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|OrderStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderStatus whereName($value)
 */
	class OrderStatus extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Organiser
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $account_id
 * @property string $name
 * @property string|null $about
 * @property string $email
 * @property string|null $phone
 * @property string $confirmation_key
 * @property string|null $facebook
 * @property string|null $twitter
 * @property string|null $logo_path
 * @property int $is_email_confirmed
 * @property int $show_twitter_widget
 * @property int $show_facebook_widget
 * @property string $page_header_bg_color
 * @property string $page_bg_color
 * @property string $page_text_color
 * @property int $enable_organiser_page
 * @property string|null $google_analytics_code
 * @property string|null $google_tag_manager_code
 * @property string|null $tax_name
 * @property string|null $tax_value
 * @property string|null $tax_id
 * @property int $charge_tax
 * @property-read \App\Models\Account $account
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Attendee[] $attendees
 * @property-read int|null $attendees_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
 * @property-read int|null $events_count
 * @property-read mixed|string $full_logo_path
 * @property-read mixed|number $organiser_sales_volume
 * @property-read string $organiser_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser query()
 * @method static \Illuminate\Database\Eloquent\Builder|MyBaseModel scope($accountId = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser whereAbout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser whereChargeTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser whereConfirmationKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser whereEnableOrganiserPage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser whereGoogleAnalyticsCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser whereGoogleTagManagerCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser whereIsEmailConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser whereLogoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser wherePageBgColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser wherePageHeaderBgColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser wherePageTextColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser whereShowFacebookWidget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser whereShowTwitterWidget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser whereTaxId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser whereTaxName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser whereTaxValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser whereTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organiser whereUpdatedAt($value)
 */
	class Organiser extends \Eloquent implements \Illuminate\Contracts\Auth\Authenticatable {}
}

namespace App\Models{
/**
 * Class PaymentGateway
 *
 * @package App\Models
 * @property int $id
 * @property string $provider_name
 * @property string $provider_url
 * @property int $is_on_site
 * @property int $can_refund
 * @property string $name
 * @property int $default
 * @property string $admin_blade_template
 * @property string $checkout_blade_template
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway query()
 * @method static \Illuminate\Database\Eloquent\Builder|MyBaseModel scope($accountId = false)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway whereAdminBladeTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway whereCanRefund($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway whereCheckoutBladeTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway whereDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway whereIsOnSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway whereProviderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGateway whereProviderUrl($value)
 */
	class PaymentGateway extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Profession
 *
 * @property int $id
 * @property int $conference_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Conference $conference
 * @method static \Illuminate\Database\Eloquent\Builder|Profession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profession query()
 * @method static \Illuminate\Database\Eloquent\Builder|MyBaseModel scope($accountId = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Profession whereConferenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profession whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profession whereUpdatedAt($value)
 */
	class Profession extends \Eloquent {}
}

namespace App\Models{
/**
 * Description of Questions.
 *
 * @author Dave
 * @property int $id
 * @property string $title
 * @property int $question_type_id
 * @property int $account_id
 * @property int $is_required
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $sort_order
 * @property int $is_enabled
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuestionAnswer[] $answers
 * @property-read int|null $answers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
 * @property-read int|null $events_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuestionOption[] $options
 * @property-read int|null $options_count
 * @property-read \App\Models\QuestionType $question_type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ticket[] $tickets
 * @property-read int|null $tickets_count
 * @method static \Illuminate\Database\Eloquent\Builder|Question isEnabled()
 * @method static \Illuminate\Database\Eloquent\Builder|Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Question newQuery()
 * @method static \Illuminate\Database\Query\Builder|Question onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Question query()
 * @method static \Illuminate\Database\Eloquent\Builder|MyBaseModel scope($accountId = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereIsEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereIsRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereQuestionTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Question withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Question withoutTrashed()
 */
	class Question extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\QuestionAnswer
 *
 * @property int $id
 * @property int $attendee_id
 * @property int $event_id
 * @property int $question_id
 * @property int $account_id
 * @property string $answer_text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Attendee $attendee
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $event
 * @property-read int|null $event_count
 * @property-read \App\Models\Question $question
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionAnswer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionAnswer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionAnswer query()
 * @method static \Illuminate\Database\Eloquent\Builder|MyBaseModel scope($accountId = false)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionAnswer whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionAnswer whereAnswerText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionAnswer whereAttendeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionAnswer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionAnswer whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionAnswer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionAnswer whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionAnswer whereUpdatedAt($value)
 */
	class QuestionAnswer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\QuestionOption
 *
 * @property int $id
 * @property string $name
 * @property int $question_id
 * @property-read \App\Models\Question $question
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|MyBaseModel scope($accountId = false)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionOption whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionOption whereQuestionId($value)
 */
	class QuestionOption extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\QuestionType
 *
 * @property int $id
 * @property string $alias
 * @property string $name
 * @property int $has_options
 * @property int $allow_multiple
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionType query()
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionType whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionType whereAllowMultiple($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionType whereHasOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuestionType whereName($value)
 */
	class QuestionType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Registration
 *
 * @property int $id
 * @property int $user_id
 * @property int $account_id
 * @property int $event_id
 * @property int $category_id
 * @property string $name
 * @property string|null $image
 * @property int|null $max_participants
 * @property string $start_date
 * @property string $end_date
 * @property string $approval_status
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DynamicFormField[] $dynamicFormFields
 * @property-read int|null $dynamic_form_fields_count
 * @property-read \App\Models\Event $event
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RegistrationUser[] $registrationUsers
 * @property-read int|null $registration_users_count
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Registration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Registration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Registration query()
 * @method static \Illuminate\Database\Eloquent\Builder|MyBaseModel scope($accountId = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Registration whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registration whereApprovalStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registration whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registration whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registration whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registration whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registration whereMaxParticipants($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registration whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registration whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registration whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registration whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registration whereUserId($value)
 */
	class Registration extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RegistrationUser
 *
 * @property int $id
 * @property int $registration_id
 * @property int|null $user_id
 * @property int $category_id
 * @property int $conference_id
 * @property int $profession_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string|null $phone
 * @property string $status
 * @property bool $is_new
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\Conference $conference
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DynamicFormFieldValue[] $formFieldValues
 * @property-read int|null $form_field_values_count
 * @property-read \App\Models\Profession $profession
 * @property-read \App\Models\Registration $registration
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationUser whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationUser whereConferenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationUser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationUser whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationUser whereIsNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationUser whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationUser wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationUser whereProfessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationUser whereRegistrationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationUser whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationUser whereUserId($value)
 */
	class RegistrationUser extends \Eloquent {}
}

namespace App\Models{
/**
 * Description of ReservedTickets.
 *
 * @author Dave
 * @property int $id
 * @property int $ticket_id
 * @property int $event_id
 * @property int $quantity_reserved
 * @property string $expires
 * @property string $session_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ReservedTickets newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservedTickets newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservedTickets query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservedTickets whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservedTickets whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservedTickets whereExpires($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservedTickets whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservedTickets whereQuantityReserved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservedTickets whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservedTickets whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservedTickets whereUpdatedAt($value)
 */
	class ReservedTickets extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Ticket
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $edited_by_user_id
 * @property int $account_id
 * @property int|null $order_id
 * @property int $event_id
 * @property string $title
 * @property string $description
 * @property string $price
 * @property int|null $max_per_person
 * @property int|null $min_per_person
 * @property int|null $quantity_available
 * @property int $quantity_sold
 * @property \Illuminate\Support\Carbon|null $start_sale_date
 * @property \Illuminate\Support\Carbon|null $end_sale_date
 * @property string $sales_volume
 * @property string $organiser_fees_volume
 * @property int $is_paused
 * @property int|null $public_id
 * @property int $user_id
 * @property int $sort_order
 * @property int $is_hidden
 * @property-read \App\Models\Event $event
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventAccessCodes[] $event_access_codes
 * @property-read int|null $event_access_codes_count
 * @property-read float|int $booking_fee
 * @property-read bool $is_free
 * @property-read float|int $organiser_booking_fee
 * @property-read \Illuminate\Support\Collection|int|mixed|static $quantity_remaining
 * @property-read mixed $quantity_reserved
 * @property-read int $sale_status
 * @property-read array $ticket_max_min_rang
 * @property-read float|int $total_booking_fee
 * @property-read float|int $total_price
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions
 * @property-read int|null $questions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newQuery()
 * @method static \Illuminate\Database\Query\Builder|Ticket onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder|MyBaseModel scope($accountId = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket soldOut()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereEditedByUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereEndSaleDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereIsHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereIsPaused($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereMaxPerPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereMinPerPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereOrganiserFeesVolume($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket wherePublicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereQuantityAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereQuantitySold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereSalesVolume($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereStartSaleDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Ticket withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Ticket withoutTrashed()
 */
	class Ticket extends \Eloquent {}
}

namespace App\Models{
/**
 * Description of TicketStatuses.
 *
 * @author Dave
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketStatus whereName($value)
 */
	class TicketStatus extends \Eloquent {}
}

namespace App\Models{
/**
 * Description of Timezone.
 *
 * @author Dave
 * @property int $id
 * @property string $name
 * @property string $location
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone query()
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereName($value)
 */
	class Timezone extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property int $account_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $phone
 * @property string $email
 * @property string $password
 * @property string $confirmation_code
 * @property int $is_registered
 * @property int $is_confirmed
 * @property int $is_parent
 * @property string|null $remember_token
 * @property string|null $api_token
 * @property-read \App\Models\Account $account
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Activity[] $activity
 * @property-read int|null $activity_count
 * @property-read string $full_name
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereConfirmationCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsRegistered($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

