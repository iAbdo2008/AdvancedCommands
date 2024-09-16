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

namespace pocketmine\block;

use pocketmine\event\block\BlockGrowEvent;
use pocketmine\item\Item;
use pocketmine\math\Facing;
use function array_rand;
use function mt_rand;

abstract class Stem extends Crops{

	abstract protected function getPlant() : Block;

	public function onRandomTick() : void{
		if(mt_rand(0, 2) === 1){
			$world = $this->position->getWorld();
			if($this->age < self::MAX_AGE){
				$block = clone $this;
				++$block->age;
				$ev = new BlockGrowEvent($this, $block);
				$ev->call();
				if(!$ev->isCancelled()){
					$world->setBlock($this->position, $ev->getNewState());
				}
			}else{
				$grow = $this->getPlant();
				foreach(Facing::HORIZONTAL as $side){
					if($this->getSide($side)->hasSameTypeId($grow)){
						return;
					}
				}

				$side = $this->getSide(Facing::HORIZONTAL[array_rand(Facing::HORIZONTAL)]);
				if($side->getTypeId() === BlockTypeIds::AIR && $side->getSide(Facing::DOWN)->hasTypeTag(BlockTypeTags::DIRT)){
					$ev = new BlockGrowEvent($side, $grow);
					$ev->call();
					if(!$ev->isCancelled()){
						$world->setBlock($side->position, $ev->getNewState());
					}
				}
			}
		}
	}

	public function getDropsForCompatibleTool(Item $item) : array{
		return [
			$this->asItem()->setCount(mt_rand(0, 2))
		];
	}
}
