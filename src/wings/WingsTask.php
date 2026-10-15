<?php

declare(strict_types=1);

namespace Wings;

use pocketmine\color\Color;
use pocketmine\scheduler\Task;
use pocketmine\world\particle\AngryVillagerParticle;
use pocketmine\world\particle\BubbleParticle;
use pocketmine\world\particle\CriticalParticle;
use pocketmine\world\particle\EnchantParticle;
use pocketmine\world\particle\EnchantmentTableParticle;
use pocketmine\world\particle\EntityFlameParticle;
use pocketmine\world\particle\FlameParticle;
use pocketmine\world\particle\HappyVillagerParticle;
use pocketmine\world\particle\HeartParticle;
use pocketmine\world\particle\LavaDripParticle;
use pocketmine\world\particle\LavaParticle;
use pocketmine\world\particle\Particle;
use pocketmine\world\particle\PortalParticle;
use pocketmine\world\particle\RainSplashParticle;
use pocketmine\world\particle\RedstoneParticle;
use pocketmine\world\particle\SmokeParticle;
use pocketmine\world\particle\SporeParticle;
use pocketmine\world\particle\WaterDripParticle;
use pocketmine\world\particle\WaterParticle;

final class WingsTask extends Task{
	public function __construct(private Main $plugin){}

	public function onRun() : void{
		foreach($this->plugin->getServer()->getOnlinePlayers() as $player){
			$effect = $this->plugin->getSelectedEffect($player);
			if($effect === null){
				continue;
			}

			$direction = $player->getDirectionVector();
			$length = sqrt(($direction->x * $direction->x) + ($direction->z * $direction->z));
			if($length < 0.000001){
				continue;
			}

			$backX = -$direction->x / $length;
			$backZ = -$direction->z / $length;
			$rightX = -$backZ;
			$rightZ = $backX;
			$base = $player->getPosition()->add($backX * 0.5, 1.2, $backZ * 0.5);
			$particle = $this->createParticle($effect);

			foreach(WingGeometry::points() as $point){
				$position = $base->add(
					$rightX * $point["lateral"],
					$point["height"],
					$rightZ * $point["lateral"],
				);
				$player->getWorld()->addParticle($position, $particle);
			}
		}
	}

	private function createParticle(string $effect) : Particle{
		return match($effect){
			"angry" => new AngryVillagerParticle(),
			"bubble" => new BubbleParticle(),
			"critical" => new CriticalParticle(1),
			"enchant" => new EnchantmentTableParticle(),
			"flame" => new EntityFlameParticle(),
			"fire" => new FlameParticle(),
			"happy" => new HappyVillagerParticle(),
			"heart" => new HeartParticle(),
			"lava-drip" => new LavaDripParticle(),
			"lava" => new LavaParticle(),
			"mob-spell" => new EnchantParticle(new Color(128, 96, 255)),
			"portal" => new PortalParticle(),
			"rain" => new RainSplashParticle(),
			"redstone" => new RedstoneParticle(1),
			"smoke" => new SmokeParticle(1),
			"spore" => new SporeParticle(),
			"water-drip" => new WaterDripParticle(),
			"water" => new WaterParticle(),
			default => throw new \InvalidArgumentException("Unknown wing particle effect"),
		};
	}
}
