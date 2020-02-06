<?php

namespace LinkAcademy\Gadgets\Commons\Services;

class Products
{
	public function getAll(): array
	{
		return [
			1 => [
				'name' => 'PlayStation 4 PRO',
				'price' => 1799.99,
				'numberInStock' => 5
			],
			2 => [
				'name' => 'Xbox One - Scorpio Edition',
				'price' => 2500.00,
				'numberInStock' => 7
			]
		];
	}
}