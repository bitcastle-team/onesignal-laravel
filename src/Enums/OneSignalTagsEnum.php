<?php

namespace Bitcastle\OneSignal\Enums;
use App\Traits\EnumTrait;

/**
 * Class OneSignalTagsEnum
 * @package Services\OneSignal\Enums
 */
class OneSignalTagsEnum
{
    use EnumTrait;

    const FRANCHISE_VIEW = 'franchiseView';
    const PRODUCT_VIEW   = 'productView';
    const PAGE_VIEW      = 'pageView';
}
