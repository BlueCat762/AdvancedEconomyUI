?php

declare(strict_types=1);

namespace eco;

use jojoe77777\FormAPI\FormAPI;
use onebone\economyapi\EconomyAPI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class ecoCMD extends Command implements PluginIdentifiableCommand{
	
	public function getPlugin() : Plugin{
}
	
	private $main;
	
	public function __construct(Main $main){
		$this->main = $main;
		parent::__construct("economyui", "EcoUI", "/ecoui", ["ecui", "ecoui", "eui"]);
	}
  //todo
}
