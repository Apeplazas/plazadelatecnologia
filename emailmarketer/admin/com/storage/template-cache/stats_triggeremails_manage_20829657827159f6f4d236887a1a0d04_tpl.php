<?php $IEM = $tpl->Get('IEM'); ?><script>
	Application.Page.StatsTriggerEmailsManage = {
		eventDOMReady: function(event) {
			if($('#triggeremails_statistics_list').size() != 0) {
				Application.Ui.CheckboxSelection(	'table#triggeremails_statistics_list',
													'input.UICheckboxToggleSelector',
													'input.UICheckboxToggleRows');

				$(document.frmPageAction).submit(Application.Page.StatsTriggerEmailsManage.eventSubmitBulkAction);

				$('#triggeremails_statistics_list .StatsTriggerEmails_Row_Action_Delete').click(Application.Page.StatsTriggerEmailsManage.eventActionRow);
			}

			if(document.frmPageAction.cmdAddTrigger) {
				$(document.frmPageAction.cmdAddTrigger).click(Application.Page.StatsTriggerEmailsManage.eventAddTrigger);
			}
		},

		eventActionRow: function(event) {
			event.stopPropagation();
			event.preventDefault();

			var id = this.href.match(/id=(\d+)$/)[1];
			var url = this.href.replace(/&{0,1}id=(\d+)$/, '');
			var action = this.href.match(/SubAction=(\w+)/)[1];

			if (action == 'Delete') {
				if (!confirm('<?php echo GetLang('TriggerEmails_Stats_PromptDelete'); ?>')) return;
			}

			Application.Util.submitPost(url, {'id':id});
		},

		eventSubmitBulkAction: function(event) {
			event.stopPropagation();
			event.preventDefault();

			if (this.ChangeType.selectedIndex == 0) {
				alert("<?php echo GetLang('PleaseChooseAction'); ?>");
				return false;
			}

			var selectedIDs = [];
			var selectedStatsIDs = [];
			var selectedRows = $('#triggeremails_statistics_list input.UICheckboxToggleRows').filter(':checked');

			if(selectedRows.size() == 0) {
				alert('<?php echo GetLang('TriggerEmails_Stats_PromptChoose'); ?>');
				return false;
			}

			var action = $(this.ChangeType).val();
			for(var i = 0, j = selectedRows.size(); i < j; ++i) {
				var temp = selectedRows.get(i).value.split(':');
				selectedIDs.push(temp[0]);
				selectedStatsIDs.push(temp[1]);
			}

			switch (action) {
				case 'print':
					var idstring = 'triggerid[]=' + selectedIDs.join('&triggerid[]=');
					var statidstring = 'stats[]=' + selectedStatsIDs.join('&stats[]=');

					tb_show('<?php echo GetLang('TriggerEmails_Stats_Print'); ?>',
							'remote_stats.php?height=420&width=420&overflow=none&statstype=t&Action=print&' + idstring + '&' + statidstring);
				break;

				case 'delete':
					if(!confirm('<?php echo GetLang('TriggerEmails_Stats_BulkAction_Delete'); ?>')) break;
					Application.Util.submitPost('index.php?Page=Stats&Action=TriggerEmails&SubAction=bulkAction&bulkAction=delete',
												{'id':selectedStatsIDs});
				break;

				default:
					alert("<?php echo GetLang('PleaseChooseAction'); ?>");
				break;
			}
		},

		eventAddTrigger: function(event) {
			event.stopPropagation();
			event.preventDefault();

			document.location.href='index.php?Page=TriggerEmails&Action=Create';
		}
	};

	Application.init.push(Application.Page.StatsTriggerEmailsManage.eventDOMReady);
</script>
<div class="PageBodyContainer">
	<div class="Page_Header">
		<div class="Heading1"><?php echo GetLang('TriggerEmails_Stats_Title'); ?></div>
		<div class="Intro"><?php echo GetLang('TriggerEmails_Stats_Intro'); ?></div>
		<?php if(trim($tpl->Get('PAGE','messages')) != ''): ?>
			<div style="margin-top: 5px;"><?php echo $tpl->Get('PAGE','messages'); ?></div>
		<?php endif; ?>

		<div class="Page_Action">
			<div style="<?php if(trim($tpl->Get('PAGE','messages')) == ''): ?>padding-top: 10px;<?php endif; ?> padding-bottom: 10px;">
				
				<?php if($tpl->Get('listCount') != 0 && $tpl->Get('newsletterCount') != 0): ?>
					<?php if($tpl->Get('permissions','create')): ?>
						<form name="frmCreateTrigger" action="index.php" method="GET">
							<input type="hidden" name="Page" value="TriggerEmails" />
							<input type="hidden" name="Action" value="Create" />
							<input type="submit" value="<?php echo GetLang('TriggerEmails_Manage_AddButton'); ?>" class="SmallButton" style="width:150px;" />
						</form>
					<?php endif; ?>

				
				<?php else: ?>
					<?php if($tpl->Get('listCount') == 0 && $tpl->Get('permissions','createList')): ?>
						<form name="frmCreateList" action="index.php" method="GET">
							<input type="hidden" name="Page" value="Lists" />
							<input type="hidden" name="Action" value="Create" />
							<input type="submit" value="<?php echo GetLang('TriggerEmails_Manage_AddListButton'); ?>" class="SmallButton" style="width:150px;" />
						</form>
					<?php endif; ?>
					<br />
					<?php if($tpl->Get('newsletterCount') == 0 && $tpl->Get('permissions','createNewsletter')): ?>
						<form name="frmCreateNewsletter" action="index.php" method="GET">
							<input type="hidden" name="Page" value="Newsletters" />
							<input type="hidden" name="Action" value="Create" />
							<input type="submit" value="<?php echo GetLang('TriggerEmails_Manage_AddCampaignButton'); ?>" class="SmallButton" style="width:150px;" />
						</form>
					<?php endif; ?>
				<?php endif; ?>
			</div>

			<form name="frmPageAction" method="POST" action="index.php?Page=Stats&Action=TriggerEmails&SubAction=BulkAction">
				<div class="Page_Action_Top"></div>
				
				<?php if(count($tpl->Get('records')) != 0): ?>
					
						<div>
							<select name="ChangeType">
								<option value="" selected="selected"><?php echo GetLang('ChooseAction'); ?></option>
								<option value="delete"><?php echo GetLang('Delete'); ?></option>
								<option value="print"><?php echo GetLang('Print_Stats_Selected'); ?></option>
							</select>
							<input type="submit" name="cmdChangeType" class="Text" value="<?php echo GetLang('Go'); ?>" />
						</div>
					

					<div><?php $tmpTplFile = $tpl->GetTemplate();
			$tmpTplData = $tpl->TemplateData;
			$tpl->ParseTemplate("Paging");
			$tpl->SetTemplate($tmpTplFile);
			$tpl->TemplateData = $tmpTplData; ?></div>
				<?php endif; ?>

				<div class="Page_Action_Bottom"></div>
			</form>
		</div>
	</div>

	<div class="Page_Contents">
		<?php if(count($tpl->Get('records')) != 0): ?>
			
			<table id="triggeremails_statistics_list" border="0" cellspacing="0" cellpadding="2" width="100%" class="Text">
				<tr class="Heading3">
					<td width="5" nowrap align="center"><input type="checkbox" class="UICheckboxToggleSelector" /></td>
					<td width="5">&nbsp;</td>
					<td width="70%"><?php echo GetLang('TriggerEmails_Manage_Column_TriggerName'); ?>&nbsp;<a href="index.php?Page=Stats&Action=TriggerEmails&SortBy=Name&Direction=Up"><img src="images/sortup.gif" border="0" /></a>&nbsp;<a href="index.php?Page=Stats&Action=TriggerEmails&SortBy=Name&Direction=Down"><img src="images/sortdown.gif" border="0" /></a></td>
					<td width="10%"><?php echo GetLang('TriggerEmails_Manage_Column_TriggeredBy'); ?>&nbsp;<a href="index.php?Page=Stats&Action=TriggerEmails&SortBy=TriggerType&Direction=Up"><img src="images/sortup.gif" border="0" /></a>&nbsp;<a href="index.php?Page=Stats&Action=TriggerEmails&SortBy=TriggerType&Direction=Down"><img src="images/sortdown.gif" border="0" /></a></td>
					<td width="10%"><?php echo GetLang('TriggerEmails_Manage_Column_TriggerHours'); ?>&nbsp;<a href="index.php?Page=Stats&Action=TriggerEmails&SortBy=TriggerHours&Direction=Up"><img src="images/sortup.gif" border="0" /></a>&nbsp;<a href="index.php?Page=Stats&Action=TriggerEmails&SortBy=TriggerHours&Direction=Down"><img src="images/sortdown.gif" border="0" /></a></td>
					<td width="130"><?php echo GetLang('Action'); ?></td>
				</tr>
				<?php $array = $tpl->Get('records'); if(is_array($array) || is_object($array)): foreach($array as $__key=>$each): $tpl->Assign('__key', $__key, false); $tpl->Assign('each', $each, false);  ?>
					<?php ob_start(); ?><?php echo intval($tpl->Get('each','triggeremailsid')); ?><?php $tpl->Assign("recordID", ob_get_contents()); ob_end_clean(); ?>
					<?php ob_start(); ?><?php echo intval($tpl->Get('each','statid')); ?><?php $tpl->Assign("statID", ob_get_contents()); ob_end_clean(); ?>
					<?php ob_start(); ?><?php echo $tpl->Get('each','triggeremailsname'); ?><?php $tpl->Assign("recordName", ob_get_contents()); ob_end_clean(); ?>
					<tr class="GridRow">
						<td align="center">
							<input type="checkbox" class="UICheckboxToggleRows" value="<?php echo $tpl->Get('recordID'); ?>:<?php echo $tpl->Get('statID'); ?>" title="<?php echo $tpl->Get('recordName'); ?>" />
						</td>
						<td><img src="images/m_triggeremails.gif" /></td>
						<td><?php echo $tpl->Get('recordName'); ?></td>
						<td>
							<?php if($tpl->Get('each','triggeremailstype') == 'f'): ?>
								<?php echo GetLang('TriggerEmails_Manage_Column_TriggeredBy_CustomField'); ?>
							<?php elseif($tpl->Get('each','triggeremailstype') == 'n'): ?>
								<?php echo GetLang('TriggerEmails_Manage_Column_TriggeredBy_CampaignOpen'); ?>
							<?php elseif($tpl->Get('each','triggeremailstype') == 'l'): ?>
								<?php echo GetLang('TriggerEmails_Manage_Column_TriggeredBy_LinkClicked'); ?>
							<?php elseif($tpl->Get('each','triggeremailstype') == 's'): ?>
								<?php echo GetLang('TriggerEmails_Manage_Column_TriggeredBy_StaticDate'); ?>
							<?php else: ?>
								-
							<?php endif; ?>
						</td>
						<td>
							<?php ob_start(); ?><?php echo abs($tpl->Get('each','triggeremailshours')); ?><?php $tpl->Assign("temp", ob_get_contents()); ob_end_clean(); ?>
							<?php if($tpl->Get('each','triggeremailshours') == 0): ?>
								<?php echo GetLang('TriggerEmails_Manage_Column_TriggerDays_Immediate'); ?>
							<?php elseif($tpl->Get('each','triggeremailshours') == -1): ?>
								<?php echo GetLang('TriggerEmails_Manage_Column_TriggerDays_OneHourBefore'); ?>
							<?php elseif($tpl->Get('each','triggeremailshours') < -1): ?>
								<?php echo sprintf(GetLang('TriggerEmails_Manage_Column_TriggerDays_HoursBefore'), $tpl->Get('temp')); ?>
							<?php elseif($tpl->Get('each','triggeremailshours') == 1): ?>
								<?php echo GetLang('TriggerEmails_Manage_Column_TriggerDays_OneHourAfter'); ?>
							<?php elseif($tpl->Get('each','triggeremailshours') < 1): ?>
								<?php echo sprintf(GetLang('TriggerEmails_Manage_Column_TriggerDays_HoursAfter'), $tpl->Get('temp')); ?>
							<?php else: ?>
								<?php echo GetLang('N/A'); ?>
							<?php endif; ?>
						</td>
						<td style="white-space:nowrap;">
							<a href="index.php?Page=Stats&Action=TriggerEmails&SubAction=view&id=<?php echo $tpl->Get('recordID'); ?>"><?php echo GetLang('ViewSummary'); ?></a>&nbsp;
							<a href="remote_stats.php?height=420&width=420&overflow=none&statstype=t&Action=print&stats[]=<?php echo $tpl->Get('statID'); ?>&triggerid[]=<?php echo $tpl->Get('recordID'); ?>" class="thickbox" title="<?php echo GetLang('TriggerEmails_Stats_Print'); ?>"><?php echo GetLang('Print_Stats_Selected'); ?></a>&nbsp;
							<a href="index.php?Page=Stats&Action=TriggerEmails&SubAction=Delete&id=<?php echo $tpl->Get('statID'); ?>" title="<?php echo GetLang('TriggerEmails_Stats_Delete'); ?>" class="StatsTriggerEmails_Row_Action_Delete"><?php echo GetLang('Delete'); ?></a>
						</td>
					</tr>
				 <?php endforeach; endif; ?>
			</table>
		<?php else: ?>
			
		<?php endif; ?>
	</div>

	<div class="Page_Footer">
		
		<?php if(count($tpl->Get('records')) != 0): ?><?php $tmpTplFile = $tpl->GetTemplate();
			$tmpTplData = $tpl->TemplateData;
			$tpl->ParseTemplate("Paging_Bottom");
			$tpl->SetTemplate($tmpTplFile);
			$tpl->TemplateData = $tmpTplData; ?><?php endif; ?>
	</div>
</div>