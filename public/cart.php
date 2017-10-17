<?php
class Checkout extends Pricing

	{
	public $price = 0;

	public $total = 0;

	public $pricing_rules;

	function __construct($pricing_rules)
		{
		$this->pricing_rules = $pricing_rules; //
		}

	public

	function scan($cart)
		{ 
		$this->price($cart);
		}
	}

class Pricing

	{
	protected
	function price($cart)
		{
		foreach($cart as $key => $cart_qty)
			{
			$value = $this->pricing_rules[$key]; // Lookup pricing rule array for this cart item 
			$price = ($value['price'] * $cart_qty); // Set default price without rules if no rules
			if ($value['deal_greater_qty'] <= $cart_qty && $value['deal_greater_qty'] != null)
				{
				$price = ($value['deal_price'] * $cart_qty); //use deal price not normal price value
				}

			if ($value['buyOneGetOneFree'] != null && $cart_qty > 1)
				{
				$price = $value['price'] * ceil($cart_qty / 2) * 2 / 2; //incriment a step value of two
				}

			$this->price = $this->price + $price; //Append price value to total global variable
			}
		}
	}

class Pricing_rules

	{
	public
		
	function rules()
		{
		
		/*
		Important: deal_greater_qty and buyOneGetOneFree can not both contain a value
		In the real world the values in this array would be returened per item from a database
		*/
		return array(
			'fr1' => array(
				'price' => 3.11,
				'deal_greater_qty' => null,
				'deal_price' => null,
				'buyOneGetOneFree' => 1
			) ,
			'sr1' => array(
				'price' => 5.00,
				'deal_greater_qty' => 3,
				'deal_price' => 4.50,
				'buyOneGetOneFree' => null
			) ,
			'cf1' => array(
				'price' => 11.23,
				'deal_greater_qty' => null,
				'deal_price' => null,
				'buyOneGetOneFree' => null
			)
		);
		}
	}

$pr = new Pricing_rules(); 
$pricing_rules = $pr->rules();
$co = new Checkout($pricing_rules); //make class rules array global

//$co->scan parameter array represents data request made by a web client 
$co->scan(array(
	'fr1' => 3,
	'sr1' => 1,
	'cf1' => 1
));
echo 'Basket 1 total price expected: ' . $co->price;
echo '<br />';
$cop = new Checkout($pricing_rules);
$cop->scan(array(
	'fr1' => 2
));
echo 'Basket 2 total price expected: ' . $cop->price;
echo '<br />';
$cor = new Checkout($pricing_rules);
$cor->scan(array(
	'fr1' => 2,
	'sr1' => 3
));
echo 'Basket 3 total price expected: ' . $cor->price;
