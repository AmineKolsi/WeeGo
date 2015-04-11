<?php

namespace BestTrip\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BestTripUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }  
}

