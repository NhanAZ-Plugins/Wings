<?php

declare(strict_types=1);

namespace Wings;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

final class Main extends PluginBase implements Listener{
	/** @var array<string, string> */
	private const EFFECTS = [
		"angry" => "Angry villager",
		"bubble" => "Bubble",
		"critical" => "Critical",
		"enchant" => "Enchantment table",
		"flame" => "Entity flame",
		"fire" => "Flame",
		"happy" => "Happy villager",
		"heart" => "Heart",
		"lava-drip" => "Lava drip",
		"lava" => "Lava",
		"mob-spell" => "Mob spell",
		"portal" => "Portal",
		"rain" => "Rain splash",
		"redstone" => "Redstone",
		"smoke" => "Smoke",
		"spore" => "Spore",
		"water-drip" => "Water drip",
		"water" => "Water",
	];

	/** @var array<string, string> */
	private const LEGACY_COMMANDS = [
		"wingangry" => "angry",
		"wingbubble" => "bubble",
		"wingcritical" => "critical",
		"wingenchant" => "enchant",
		"wingflame" => "flame",
		"wingfire" => "fire",
		"winghappy" => "happy",
		"wingheart" => "heart",
		"winglavadrip" => "lava-drip",
		"winglava" => "lava",
		"wingmobspell" => "mob-spell",
		"wingportal" => "portal",
		"wingrain" => "rain",
		"wingredstone" => "redstone",
		"wingsmoke" => "smoke",
		"wingspore" => "spore",
		"wingwaterdrip" => "water-drip",
		"wingwater" => "water",
	];

	/** @var array<string, string> */
	private array $activeEffects = [];

	protected function onEnable() : void{
		$this->saveDefaultConfig();
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$configuredPeriod = $this->getConfig()->get("update-period", 1);
		$period = is_int($configuredPeriod) ? $configuredPeriod : 1;
		$period = max(1, min(20, $period));
		$this->getScheduler()->scheduleRepeatingTask(new WingsTask($this), $period);
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		if(!$sender instanceof Player){
			$sender->sendMessage("Use this command in game.");
			return true;
		}

		$label = strtolower($label);
		$effect = self::LEGACY_COMMANDS[$label] ?? null;
		if($label === "wings"){
			$requested = strtolower($args[0] ?? "");
			if($requested === "off"){
				unset($this->activeEffects[$sender->getName()]);
				$sender->sendMessage("Your wing effect is off.");
				return true;
			}
			$effect = isset(self::EFFECTS[$requested]) ? $requested : null;
		}

		if($effect === null){
			$sender->sendMessage("Effects: " . implode(", ", array_keys(self::EFFECTS)) . ". Use /wings <effect|off>.");
			return true;
		}

		$name = $sender->getName();
		if(($this->activeEffects[$name] ?? null) === $effect){
			unset($this->activeEffects[$name]);
			$sender->sendMessage("Your wing effect is off.");
			return true;
		}

		$this->activeEffects[$name] = $effect;
		$sender->sendMessage("Wing effect: " . self::EFFECTS[$effect] . ".");
		return true;
	}

	public function getSelectedEffect(Player $player) : ?string{
		return $this->activeEffects[$player->getName()] ?? null;
	}

	public function onPlayerQuit(PlayerQuitEvent $event) : void{
		unset($this->activeEffects[$event->getPlayer()->getName()]);
	}
}
