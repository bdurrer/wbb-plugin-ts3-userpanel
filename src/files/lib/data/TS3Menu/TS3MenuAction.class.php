<?php
namespace wcf\data\TS3Menu;

use wcf\data\AbstractDatabaseObjectAction;
use wcf\system\database\util\PreparedStatementConditionBuilder;
use wcf\system\WCF;
use wcf\data\teamspeak3viewer\TeamSpeak3Viewer;
use wcf\system\cache\builder\TeamSpeak3ViewerCacheBuilder;

/*
namespace wcf\data\conversation;
use wcf\data\conversation\label\ConversationLabel;
use wcf\data\conversation\message\ConversationMessageAction;
use wcf\data\conversation\message\ConversationMessageList;
use wcf\data\conversation\message\SimplifiedViewableConversationMessageList;
use wcf\data\AbstractDatabaseObjectAction;
use wcf\data\IClipboardAction;
use wcf\data\IVisitableObjectAction;
use wcf\system\clipboard\ClipboardHandler;
use wcf\system\conversation\ConversationHandler;
use wcf\system\database\util\PreparedStatementConditionBuilder;
use wcf\system\exception\PermissionDeniedException;
use wcf\system\exception\UserInputException;
use wcf\system\log\modification\ConversationModificationLogHandler;
use wcf\system\request\LinkHandler;
use wcf\system\user\notification\object\ConversationUserNotificationObject;
use wcf\system\user\notification\UserNotificationHandler;
use wcf\system\user\storage\UserStorageHandler;
use wcf\system\WCF;
*/

/**
 * AJAX Action for fetching TS Data without blocking the page loading.
 * 
 * @author	Beat Durrer
 * @copyright	2015, Beat Durrer
 * @license	Creative Commons <by> https://creativecommons.org/licenses/by/4.0/legalcode.txt
 * @package	ch.nana.usermenu.ts3
 */
class TS3MenuAction extends AbstractDatabaseObjectAction{

    /**
     * @see	\wcf\data\AbstractDatabaseObjectAction::$className
     */
	protected $className = 'wcf\data\teamspeak3viewer\TeamSpeak3ViewerEditor';

    /**
     * @see	\wcf\data\AbstractDatabaseObjectAction::$requireACP
     */
    protected $requireACP = array();
	
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$allowGuestAccess
	 */
	protected $allowGuestAccess = array('getTsDataList');	


    public function validateGetTsDataList() {
		// does nothing but required by WCF
    }

    public function getTsDataList() {
		$clientCount = 0;
		
		$servers = TeamSpeak3ViewerCacheBuilder::getInstance()->getData();		
		foreach ($servers as $key => &$server) {
			$clientCount += count($server['clients']);
			
			usort($server['clients'], function($a, $b) {
				if ($a['channel'] == $b['channel']) {
					return strcmp($a['name'], $b['name']);
				}
				return ($a['channel'] < $b['channel']) ? -1 : 1;
			});
		}
		
		WCF::getTPL()->assign(array(
            'ts3servers' => $servers,
			'ts3clientsTotal' => $clientCount
        ));
		
		return array(
			'template' => WCF::getTPL()->fetch('__userMenuTS3MenuDropDown'),
			'totalCount' => $clientCount
		);
    }

}

