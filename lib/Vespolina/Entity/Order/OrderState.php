<?php

namespace Vespolina\Entity\Order;

class OrderState
{
    const OPEN = 'open';          //Available for change
    const LOCKED = 'locked';      //Locked for processing
    const CLOSED = 'closed';      //Closed after processing
    const EXPIRED = 'expired';    //Not processed and expired
    const ABANDONED = 'abandoned'; //Order was abandoned
    const CONVERTED = 'converted'; //Order was converted into a purchase
} 