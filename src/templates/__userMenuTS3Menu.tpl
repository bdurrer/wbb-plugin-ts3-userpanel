{if $__wcf->user->userID && $__wcf->session->getPermission('user.board.teamspeak3viewer.canView')}
	<li id="TS3Menu" class="ts3menu">
		<a class="togglelink" href="{link controller='TeamSpeak3Viewer'}{/link}">
			<img src="{$__wcf->getPath()}/images/teamspeak3/ts-3icon.png" class="ts3menu-icon icon icon16">
			<span>{lang}wcf.ts3usermenu.teamSpeakMenuName{/lang}</span> 
		</a>
		<div class="interactiveDropdown interactiveDropdownStatic interactiveDropdownTS3Menu">
			<a class="interactiveDropdownShowAll" href="{link controller='TeamSpeak3Viewer'}{/link}" onclick="WCF.Dropdown.Interactive.Handler.close('TS3Menu')">{lang}wcf.ts3usermenu.gotoTeamSpeakPage{/lang}</a>			
		</div>
		<script data-relocate="true">
			$(function() {
				new WCF.User.Panel.TS3Menu();
			});
		</script>
	</li>
{/if}