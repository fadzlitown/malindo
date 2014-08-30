<?php

/**
 * Author       : Rifki Yandhi
 * Date Created : May 10, 2014 8:06:27 PM
 * File         : app/models/Address.php
 * Copyright    : rifkiyandhi@gmail.com
 * Function     : 
 */

namespace App\Models;

class Address extends \Eloquent
{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $guarded	 = array('id');
	protected $table	 = 'addresses';
	public $rules		 = array(
		"address" => "required|max:50"
	);

}

/* End of file Address.php */
/* Location: ./app/models/Address.php */
