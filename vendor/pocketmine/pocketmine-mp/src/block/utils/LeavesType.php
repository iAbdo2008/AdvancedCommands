<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
 */

declare(strict_types=1);

namespace pocketmine\block\utils;

use pocketmine\utils\EnumTrait;

/**
 * This doc-block is generated automatically, do not modify it manually.
 * This must be regenerated whenever registry members are added, removed or changed.
 * @see build/generate-registry-annotations.php
 * @generate-registry-docblock
 *
 * @method static LeavesType ACACIA()
 * @method static LeavesType AZALEA()
 * @method static LeavesType BIRCH()
 * @method static LeavesType DARK_OAK()
 * @method static LeavesType FLOWERING_AZALEA()
 * @method static LeavesType JUNGLE()
 * @method static LeavesType MANGROVE()
 * @method static LeavesType OAK()
 * @method static LeavesType SPRUCE()
 */
final class LeavesType{
	use EnumTrait {
		register as Enum_register;
		__construct as Enum___construct;
	}

	protected static function setup() : void{
		self::registerAll(
			new self("oak", "Oak"),
			new self("spruce", "Spruce"),
			new self("birch", "Birch"),
			new self("jungle", "Jungle"),
			new self("acacia", "Acacia"),
			new self("dark_oak", "Dark Oak"),
			new self("mangrove", "Mangrove"),
			new self("azalea", "Azalea"),
			new self("flowering_azalea", "Flowering Azalea")
		);
	}

	private function __construct(
		string $enumName,
		private string $displayName
	){
		$this->Enum___construct($enumName);
	}

	public function getDisplayName() : string{
		return $this->displayName;
	}
}
