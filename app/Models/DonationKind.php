<?php

namespace W4P\Models;

class DonationKind
{
    public static function all()
    {
        return ['manpower', 'material', 'coaching', 'currency'];
    }
}