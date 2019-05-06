<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'service_items';

    const CARD_GAME_VCOIN = 1;
    const CARD_GAME_GATE = 1;
    const CARD_GAME_GARENA = 1;
    const CARD_GAME_ZING = 1;
    const CARD_MOBILE_VIETTEL = 1;
    const CARD_MOBILE_MOBIFONE = 1;
    const CARD_MOBILE_VINAPHONE = 1;
    const CARD_MOBILE_SFONE = 1;
    const CARD_MOBILE_GMOBILE = 1;
    const CARD_MOBILE_VIETNAMMOBILE = 1;
    const TOPUP_VIETTEL = 1;
    const TOPUP_MOBIFONE = 1;
    const TOPUP_VINAPHONE = 1;
    const TOPUP_SFONE = 1;
    const TOPUP_GMOBILE = 1;
}
