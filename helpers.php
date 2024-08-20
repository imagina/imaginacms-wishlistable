<?php

/**
 * Show Add Button List
 */
if (!function_exists('wishlistableShowBtn')) {
    function wishlistableShowBtn($currentRoute)
    {
        $showBtn = true;
        //\Log::info("Current Route: ".$currentRoute);

        //Check View Index List
        $viewIndexList = locale().'.wishlistable.wishlist.indexList';
        if($currentRoute==$viewIndexList) $showBtn = false;


        return $showBtn;
    }
}