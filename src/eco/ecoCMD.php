<?php

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

public function execute(CommandSender $sender, string $label, array $args){
		if(!$sender instanceof Player){
			$sender->sendMessage("§crun command in game!");
			return false;
		}
		if(!isset($args[0]) || $args[0] !== "op"){
			if($sender->hasPermission("eco.cmd.use")){
				$this->memberForm($sender);
				return true;
			}else{
				$sender->sendMessage("§eYou don't have permission");
				return false;
			}
		}
		if($args[0] === "op"){
			if($sender->hasPermission("factionui.use.admin")){
				$this->opForm($sender);
			}else{
				$sender->sendMessage("§cYou don't have permission!");
				return false;
			}
		}
		return false;
	}
  //todo
}
