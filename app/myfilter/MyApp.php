<?php

namespace App\myfilter;

use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; 

class MyApp implements FilterInterface
{
    public function transform($item)
    {
        if (! $this->isVisible($item)) {
			return false;
		}

		if (isset($item['header'])) {
			$item = $item['header'];
		}

		return $item;
    }

    public function isVisible($item)
	{
        // check if user is a member of specified role(s) 
		if (isset($item['guard'])) {
			if (! (Auth::guard('user'))) {
				// not a member of any valid roles; check if user has been granted explicit permission
				if (isset($item['can']) && (Auth::guard('user'))->can($item['can'])) {
					return true;
				} else {
					return false;
				}
			} else {
				return true;
			}
		} else {
			// valid roles not defined; check if user has been granted explicit permission
			if (isset($item['can'])) {
				// permissions are defined
				if ((Auth::guard('user'))->can($item['can'])) {
					return true;
				} else {
					return false;
				}
			} else {
				// no valid roles or permissions defined; allow for all users
				return true;
			}
		}
	}
}