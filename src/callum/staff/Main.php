<?php 

namespace callum\staff;

use pocketmine\{Player, Server};
use pocketmine\command\{Command, CommandSender};
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener{

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("StaffList has been activated");
    }
    	public function onDisable(){
            $this->getLogger()->info("StaffList has been deactivated");
        }
        public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
            switch($cmd->getName()){
                case "stafflist":
                if(($sender instanceof Player and $sender->hasPermission("view.staff"))
                or $sender instanceof ConsoleCommandSender or $sender->isOp()) {
                $staff = file_get_contents("staff.txt");
                    $sender->sendMessage("§a-------------------------");//25 "-"s
                    $sender->sendMessage("§6Staff List:");
                    $sender->sendMessage("§9" . $staff);
                    $sender->sendMessage("§a-------------------------");//25 "-"s
                }else{
                    $sender->sendMessage("§cYou don't have permission to use this command!");
                }
                break;
            }
              return true;
        }
    }
