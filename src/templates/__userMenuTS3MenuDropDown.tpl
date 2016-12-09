{foreach from=$ts3servers item=$server key=$key}
	<div class="interactiveDropdownHeader">
		<span class="interactiveDropdownTitle">{$server.serverInfo.name}</span>
		{if $server.status == 'online'}
			<ul class="interactiveDropdownLinks">
				<li>
					{$server.clients|count} {lang}wcf.ts3usermenu.users{/lang}
				</li>
			</ul>
		{/if}
	</div>
	<div class="interactiveDropdownItemsContainer">
		<ul class="interactiveDropdownItems">
			{if $server.status == 'online'}
				{foreach from=$server.clients item=$client key=$key}
					<li class="tsClient">
						{if $client.output_muted}
							<img src="{$__wcf->getPath()}images/teamspeak3/output_muted.png" alt="{lang}wcf.teamspeak3viewer.output_muted{/lang}" title="{lang}wcf.teamspeak3viewer.output_muted{/lang}" />
						{elseif $client.input_muted}
							<img src="{$__wcf->getPath()}images/teamspeak3/input_muted.png" alt="{lang}wcf.teamspeak3viewer.input_muted{/lang}" title="{lang}wcf.teamspeak3viewer.input_muted{/lang}" />
						{else}
							<img src="{$__wcf->getPath()}images/teamspeak3/player_off.png" alt="{lang}wcf.teamspeak3viewer.client{/lang}" title="{lang}wcf.teamspeak3viewer.client{/lang}" />
						{/if}
						<span class="tsName">{$client.name}</span>
						
						{foreach from=$server.channels item=$chan key=$key}
							{if $client.channel == $chan.id}
								<span class="tsChannel tsChannel{$chan.id}">{$chan.name}</span>
							{/if}
						{/foreach}
					</li>
				{/foreach}
			{else}
				<li>
					<span class="icon icon16 icon-ban-circle"></span> 
					<a href="{link controller='TeamSpeak3Viewer'}{/link}"><span>{lang}wcf.teamspeak3viewer.offline{/lang}</span></a>
				</li>
			{/if}
		</ul>
{/foreach}
