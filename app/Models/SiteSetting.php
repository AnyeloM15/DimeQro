<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $table = 'site_settings';
    protected $fillable = ['logo', 'email', 'address', 'phone', 'facebook', 'twitter', 'whatsapp', 'instagram', 'youtube',
                            'terms',
                            'refund_policy',
                            'shipping_policy',
                            'cookie_policy',
                            'warranty_policy',
                            'payment_methods',
                            'security_policy','promotions'];
}