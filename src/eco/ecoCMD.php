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
use pocketmine\utils\TextFormat as T;

class ecoCMD extends Command implements PluginIdentifiableCommand{
	
	public function getPlugin() : Plugin{
}
	
	private $main;
	
	public function __construct(Main $main){
		$this->main = $main;
		parent::__construct("economyui", "EcoUI", "/ecoui", ["ecui", "ecoui", "eu"]);
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
public function memberForm(Player $sender){
	        $api = $this->main->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createSimpleForm(function(Player $sender, ?int $data){
			if(!isset($data)) return;
			switch($data){
			case 0:
                            $this->mymoney($sender);
			    break;
                        case 1:
                            $this->pay($sender);
                            break;
                        case 2:
                            $this->see($sender);
                            break;
                        case 3:
                            $this->top($sender);
                            break;
            }
          });
       $form->setTitle(T::GREEN . "EconomyUI");
       $form->addButton(T::AQUA . "See your money");
       $form->addButton(T::YELLOW . "Pay");
       $form->addButton(T::GOLD . "See other player money");
       $form->addButton(T::AQUA . "Top money");  
       $form->addButton(T::RED . "EXIT");
       $form->sendToPlayer($sender);
     }

public function mymoney(Player $sender){
                $api = $this->main->getServer()->getPluginManager()->getPlugin("FormAPI");
		$f = $api->createCustomForm(function(Player $player, ?array $data){
		});
                $economy = EconomyAPI::getInstance();
                $mny = $economy->myMoney($sender);
		$f->setTitle(T::GREEN . "EconomyUI");
		$f->addLabel(T::YELLOW . "Your money: $mny");
		$f->sendToPlayer($sender);
	     }
public function pay(Player $sender){
               $api = $this->main->getServer()->getPluginManager()->getPlugin("FormAPI");
	       $f = $api->createCustomForm(function(Player $sender, ?array $data){
                if(!isset($data)) return;
		 $this->main->getServer()->getCommandMap()->dispatch($sender, "pay $data[0] $data[1]");
	    });
		$f->setTitle(T::GREEN . "EconomyUI");
		$f->addInput("Player name", "Bumbumkill");
                $f->addInput("Amount", "1000");
		$f->sendToPlayer($sender);
	     }
public function see(Player $sender){
                $api = $this->main->getServer()->getPluginManager()->getPlugin("FormAPI");
		$f = $api->createCustomForm(function(Player $player, ?array $data){
		});
		$f->setTitle(T::GREEN . "EconomyUI");
		$f->addLabel("");
		$f->sendToPlayer($sender);
	     }
}
