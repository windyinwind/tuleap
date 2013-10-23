<?php
/**
 * Copyright (c) Enalean, 2013. All Rights Reserved.
 *
 * Tuleap is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Tuleap is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Tuleap; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

/**
 * Class Rest_Token
 * I'm a token for Rest authentication
 */

class Rest_Token {

    /** @var int */
    private $user_id;

    /** @var  string */
    private $token_value;

    public function __construct($user_id, $token_value) {
        $this->user_id     = $user_id;
        $this->token_value = $token_value;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getTokenValue() {
        return $this->token_value;
    }
}