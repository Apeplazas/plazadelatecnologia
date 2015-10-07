<?php $IEM = $tpl->Get('IEM'); ?><script>
	var PAGE = {
		init: function() {
			Application.Ui.CheckboxSelection(
				'table#SplittestStatisticList',
				'input.UICheckboxToggleSelector',
				'input.UICheckboxToggleRows'
			);

			$('.disabledlink').click(function() {
				alert('<?php echo GetLang('Addon_splittest_Stats_NotFinished'); ?>');
				return false;
			});

			$('.StatsDisplayDeleteStat').click(PAGE.deleteSplittestStat);
			$('.StatsDisplayExportStat').click(PAGE.exportSplittestStat);
			$('#StatsForm').submit(PAGE.selectSplittestAction);
		},

		selectSplittestAction: function(e) {
			var subAction = $('#SelectAction').val();
			var selected = 	$('.statsSelection:checked');

			if (selected.length < 1) {
				alert("<?php echo GetLang('Addon_splittest_Multi_SelectFirst'); ?>");
				return false;
			}

			switch (subAction) {
				case 'MultiDelete':
					if (!confirm('<?php echo GetLang('Addon_splittest_Delete_ConfirmMessage'); ?>')) {
						return false;
					}
					// flow through to standard form submission
					break;

				case 'MultiPrint':
					var jobids = $('.jobid:checked').map(function() {
						return 'jobids[]=' + $(this).val();
					});
					var statids = $('.jobid:checked').map(function() {
						return 'statids[]=' + $(this).next('.statid').val();
					});
					var job_stats = $.makeArray(jobids).join('&') + '&' + $.makeArray(statids).join('&');
					var url = 'addons/splittest/print_stats_options.php?height=270&width=420&overflow=none&path=addons/splittest/&statstype=splittest&Action=printsubaction=print&' + job_stats + '&options[]=snapshot&options[]=open&options[]=click&options[]=bounce&options[]=unsubscribe';
					tb_show('<?php echo GetLang('Addon_splittest_PrintSplitTestStatistics'); ?>', url, '');
					return false;
					break;

				case 'MultiExport':
					// flow through to standard form submission
					break;

				default :
					alert('<?php echo GetLang('PleaseChooseAction'); ?>');
					return false;
					break;
			}
		},

		deleteSelected: function() {
			var selected = 	$('.statsSelection:checked');

			if (selected.length < 1) {
				alert("<?php echo GetLang('Addon_splittest_Delete_SelectFirst'); ?>");
				return false;
			}

			if (!confirm("<?php echo GetLang('Addon_splittest_Delete_ConfirmMessage'); ?>")) {
				return;
			}

			var selectedIds = [];
			for(var i = 0, j = selected.length; i < j; ++i) {
				selectedIds.push(selected[i].value);
			}

			Application.Util.submitPost('<?php echo $tpl->Get('AdminUrl'); ?>&Action=Stats&Step=40', {statids: selectedIds});
			e.stopPropagation();
			e.preventDefault();
		},

		deleteSplittestStat: function(e) {
			if (confirm('Are you sure you want to delete the selected Split Test Statistics?')) {
				var jobID = $(this).attr('id').match(/hrefStatsDisplayDeleteJob_(\d*)/);
				var splitID = $(this).attr('splitid').match(/hrefStatsDisplayDeleteJob_(\d*)/);
				Application.Util.submitPost('index.php?Page=Addons&Addon=splittest&Action=Stats',
					{SubAction : 'Delete', jobid: jobID[1], splitid: splitID[1]}
				);
			}
			e.stopPropagation();
			e.preventDefault();
		},

		exportSplittestStat: function(e) {
			var jobID = $(this).attr('id').match(/hrefStatsDisplayExportJob_(\d*)/);
			var splitID = $(this).attr('splitid').match(/hrefStatsDisplayExportJob_(\d*)/);
			Application.Util.submitPost('index.php?Page=Addons&Addon=splittest&Action=Stats',
				{SubAction : 'Export', jobid: jobID[1], splitid: splitID[1]}
			);
			e.stopPropagation();
			e.preventDefault();
		}
	};

	$(function() {
		PAGE.init();
	});

	function DelSplitTest(id, status)
	{
		if (id < 1) {
			return false;
		}

		if (status == 'i' || status == 'r') {
			alert('<?php echo GetLang('Addon_splittest_Manage_Delete_Disabled_Alert'); ?>');
			return false;
		}

		if (!confirm('<?php echo GetLang('Addon_splittest_DeleteOne_Confirm'); ?>')) {
			return false;
		}

		Application.Util.submitPost('<?php echo $tpl->Get('AdminUrl'); ?>&Action=Stats&Step=40', {statid: id});
		return true;
	}
</script>


<table width="100%" border="0">
	<tr>
		<td class="Heading1"><?php echo GetLang('Addon_splittest_Stats_Heading'); ?></td>
	</tr>
	<tr>
		<td class="body pageinfo"><p><?php echo GetLang('Addon_splittest_Stats_Intro'); ?></p></td>
	</tr>
	<tr>
		<td>
			<?php echo $tpl->Get('FlashMessages'); ?>
		</td>
	</tr>
	<tr>
		<td class="body">
			<form name="StatsForm" id="StatsForm" method="post" action="<?php echo $tpl->Get('AdminUrl'); ?>&Action=Stats">
			<!--<form name="mystatsform" method="post">-->
				<table width="100%" border="0">
					<tr>
						<td valign="top">
							<select id="SelectAction" name="SubAction">
								<option value="" selected="selected"><?php echo GetLang('Addon_splittest_Stats_ChooseAction'); ?></option>
								<option value="MultiDelete"><?php echo GetLang('Addon_splittest_Stats_DeleteSelected'); ?></option>
								<option value="MultiPrint"><?php echo GetLang('Addon_splittest_Stats_PrintSelected'); ?></option>
								<option value="MultiExport"><?php echo GetLang('Addon_splittest_Stats_ExportSelected'); ?></option>
							</select>
							<input type="submit" name="cmdChangeType" class="Text" value="<?php echo GetLang('Go'); ?>" />
						</td>
						<td align="right">
							<?php echo $tpl->Get('Paging'); ?>
						</td>
					</tr>
				</table>
				<table border="0" cellspacing="0" cellpadding="0" width="100%" class="Text" id="SplittestStatisticList">
					<tr class="Heading3">
						<td width="5"><input type="checkbox" name="toggle" class="UICheckboxToggleSelector"></td>
						<td width="5">&nbsp;</td>
						<td width="15%" nowrap="nowrap">
							<?php echo GetLang('Addon_splittest_Stats_SplitName'); ?>&nbsp;<a href='<?php echo $tpl->Get('AdminUrl'); ?>&Action=Stats&SortBy=splitname&Direction=asc'><img src="<?php echo $tpl->Get('ApplicationUrl'); ?>images/sortup.gif" border="0"></a>&nbsp;<a href='<?php echo $tpl->Get('AdminUrl'); ?>&Action=Stats&SortBy=splitname&Direction=desc'><img src="<?php echo $tpl->Get('ApplicationUrl'); ?>images/sortdown.gif" border="0"></a>
						</td>
						<td width="10%" nowrap="nowrap">
							<?php echo GetLang('Addon_splittest_Stats_SplitType'); ?>&nbsp;<a href='<?php echo $tpl->Get('AdminUrl'); ?>&Action=Stats&SortBy=splittype&Direction=asc'><img src="<?php echo $tpl->Get('ApplicationUrl'); ?>images/sortup.gif" border="0"></a>&nbsp;<a href='<?php echo $tpl->Get('AdminUrl'); ?>&Action=Stats&SortBy=splittype&Direction=desc'><img src="<?php echo $tpl->Get('ApplicationUrl'); ?>images/sortdown.gif" border="0"></a>
						</td>
						<td width="%15" nowrap="nowrap">
							<?php echo GetLang('Addon_splittest_Stats_ListNames'); ?>&nbsp;<a href='<?php echo $tpl->Get('AdminUrl'); ?>&Action=Stats&SortBy=list&Direction=asc'><img src="<?php echo $tpl->Get('ApplicationUrl'); ?>images/sortup.gif" border="0"></a>&nbsp;<a href='<?php echo $tpl->Get('AdminUrl'); ?>&Action=Stats&SortBy=list&Direction=desc'><img src="<?php echo $tpl->Get('ApplicationUrl'); ?>images/sortdown.gif" border="0"></a>
						</td>
						<td width="33%">
							<?php echo GetLang('Addon_splittest_Stats_CampaignNames'); ?>&nbsp;<a href='<?php echo $tpl->Get('AdminUrl'); ?>&Action=Stats&SortBy=list&Direction=asc'><img src="<?php echo $tpl->Get('ApplicationUrl'); ?>images/sortup.gif" border="0"></a>&nbsp;<a href='<?php echo $tpl->Get('AdminUrl'); ?>&Action=Stats&SortBy=list&Direction=desc'><img src="<?php echo $tpl->Get('ApplicationUrl'); ?>images/sortdown.gif" border="0"></a>
						</td>
						<td width="12%" nowrap="nowrap">
							<?php echo GetLang('Addon_splittest_Winner'); ?>
						</td>
						<td width="10%" nowrap="nowrap">
							<?php echo GetLang('Addon_splittest_Stats_DateFinished'); ?>&nbsp;<a href='<?php echo $tpl->Get('AdminUrl'); ?>&Action=Stats&SortBy=finishtime&Direction=asc'><img src="<?php echo $tpl->Get('ApplicationUrl'); ?>images/sortup.gif" border="0"></a>&nbsp;<a href='<?php echo $tpl->Get('AdminUrl'); ?>&Action=Stats&SortBy=finishtime&Direction=desc'><img src="<?php echo $tpl->Get('ApplicationUrl'); ?>images/sortdown.gif" border="0"></a>
						</td><!--
						<td width="100" nowrap="nowrap">
							<?php echo GetLang('Addon_splittest_Stats_TotalRecipients'); ?>&nbsp;<a href='<?php echo $tpl->Get('AdminUrl'); ?>&Action=Stats&SortBy='><img src="<?php echo $tpl->Get('ApplicationUrl'); ?>images/sortup.gif" border="0"></a>&nbsp;<a href='<?php echo $tpl->Get('AdminUrl'); ?>&Action=Stats&SortBy='><img src="<?php echo $tpl->Get('ApplicationUrl'); ?>images/sortdown.gif" border="0"></a>
						</td>
						td width="110" nowrap>
							<?php echo GetLang('Addon_splittest_Stats_TotalUnsubscribes'); ?>
							&nbsp;<a href='<?php echo $tpl->Get('AdminUrl'); ?>&Action=Stats&SortBy='><img src="<?php echo $tpl->Get('ApplicationUrl'); ?>images/sortup.gif" border="0"></a>
							<a href='<?php echo $tpl->Get('AdminUrl'); ?>&Action=Stats&SortBy='><img src="<?php echo $tpl->Get('ApplicationUrl'); ?>images/sortdown.gif" border="0"></a>
						</td>
						<td width="90" nowrap>
							<?php echo GetLang('Addon_splittest_Stats_TotalBounces'); ?>
							&nbsp;<a href='<?php echo $tpl->Get('AdminUrl'); ?>&Action=Stats&SortBy='><img src="<?php echo $tpl->Get('ApplicationUrl'); ?>images/sortup.gif" border="0"></a>
							<a href='<?php echo $tpl->Get('AdminUrl'); ?>&Action=Stats&SortBy='><img src="<?php echo $tpl->Get('ApplicationUrl'); ?>images/sortdown.gif" border="0"></a>
						</td -->
						<td width="5%">
							<?php print GetLang('Action'); ?>
						</td>
					</tr>
					<?php $array = $tpl->Get('Statistics'); if(is_array($array) || is_object($array)): foreach($array as $statid=>$statsDetails): $tpl->Assign('statid', $statid, false); $tpl->Assign('statsDetails', $statsDetails, false);  ?>
						<tr class="GridRow">
							<td>
								<input type="checkbox" value="<?php echo $tpl->Get('statsDetails','jobid'); ?>" name="jobids[]" class="UICheckboxToggleRows statsSelection jobid" />
								<input type="hidden" id="statid_<?php echo $tpl->Get('statsDetails','jobid'); ?>" name="statids[]" value="<?php echo $tpl->Get('statsDetails','splitid'); ?>" class="statid" />
							</td>
							<td>
								<img src="<?php echo $tpl->Get('ApplicationUrl'); ?>addons/splittest/images/m_splittests.gif" height="16" width="16" border="0" />
							</td>
							<td>
								<?php echo $tpl->Get('statsDetails','splitname'); ?>
							</td>
							<td>
								<?php if($tpl->Get('statsDetails','splittype') == 'distributed'): ?>
									<?php echo GetLang('Addon_splittest_Manage_SplitType_Distributed'); ?>
								<?php elseif($tpl->Get('statsDetails','splittype') == 'percentage'): ?>
									<?php echo GetLang('Addon_splittest_Manage_SplitType_Percentage'); ?>
									
								<?php endif; ?>
							</td>
							<td>
								<?php if(!function_exists("foreach_52375")){ function foreach_52375(&$tpl, $array){ $tpl->Assign(array('sequence', 'iteration'), 0); $tpl->Assign(array('sequence', 'last'), false); $tpl->Assign(array('sequence', 'total'), sizeof($array)); if(is_array($array) || is_object($array)): foreach($array as $__key=>$list): $tpl->Assign('__key', $__key, false); $tpl->Assign('list', $list, false); $tpl->Assign(array('sequence', 'iteration'), $tpl->Get('sequence', 'iteration')+1);if( $tpl->Get('sequence','total') ===  $tpl->Get('sequence','iteration')){ $tpl->Assign(array('sequence','last'), true);} ?>
									<?php echo $tpl->Get('list','name'); ?><?php if(!$tpl->Get('sequence','last')): ?>, <?php endif; ?>
								 <?php endforeach; endif;}} foreach_52375($tpl, $tpl->Get('statsDetails','lists')); ?>
							</td>
							<td>
								<?php echo $tpl->Get('statsDetails','campaign_names'); ?>
							</td>
							<td>
								<?php if($tpl->Get('statsDetails','finishtime') > 0): ?>
									<?php if($tpl->Get('statsDetails','campaign_winner_type') == 'None'): ?>
										<span class="HelpToolTip HelpText">
											<span class="HelpToolTip_Title" style="display:none;"><?php echo GetLang('Addon_splittest_Stats_WinningCampaign'); ?></span>
											<span class="HelpToolTip_Contents" style="display:none;"><?php echo GetLang('Addon_splittest_WonNone'); ?> <?php echo GetLang('Addon_splittest_ViewMore'); ?></span>
											<?php echo GetLang('Addon_splittest_None'); ?>
										</span>
									<?php else: ?>
										<span class="HelpToolTip HelpText">
											<span class="HelpToolTip_Title" style="display:none;"><?php echo GetLang('Addon_splittest_Stats_WinningCampaign'); ?></span>
											<span class="HelpToolTip_Contents" style="display:none;"><?php echo $tpl->Get('statsDetails','winner_message'); ?> <?php echo GetLang('Addon_splittest_ViewMore'); ?></span>
											<?php echo $tpl->Get('statsDetails','campaign_winner_name'); ?>
										</span>
									<?php endif; ?>
								<?php else: ?>
									<span class="HelpToolTip HelpText">
										<span class="HelpToolTip_Title" style="display:none;"><?php echo GetLang('Addon_splittest_Stats_StillSending'); ?></span>
										<span class="HelpToolTip_Contents" style="display:none;"><?php echo GetLang('Addon_splittest_Stats_StillSending_Tip'); ?></span>
										<?php echo GetLang('Addon_splittest_Stats_StillSending'); ?>
									</span>
								<?php endif; ?>
								<div style="font-weight:normal" id="active_<?php echo $tpl->Get('statid'); ?>" style="display:none;"></div>
							</td>
							<td>
								<?php if($tpl->Get('statsDetails','finishtime') == 0): ?>
									<?php echo GetLang('Addon_splittest_Stats_FinishTime_NotFinished'); ?>
								<?php else: ?>
									<?php echo dateformat($tpl->Get('statsDetails','finishtime'), $tpl->Get('DateFormat')); ?>
								<?php endif; ?>
							</td><!--
							<td align="center">
								
								
								<?php echo $tpl->Get('statsDetails','total_recipient_count'); ?>
							</td>-->
							<td nowrap="nowrap">
								<!-- actions here -->
								<?php if($tpl->Get('statsDetails','finishtime') == 0): ?>
									<?php ob_start(); ?>disabledlink<?php $tpl->Assign("active_status", ob_get_contents()); ob_end_clean(); ?>
								<?php endif; ?>
								<a class="<?php echo $tpl->Get('active_status'); ?>" href="index.php?Page=Addons&Addon=splittest&Action=Stats&splitid=<?php echo $tpl->Get('statsDetails','splitid'); ?>&jobid=<?php echo $tpl->Get('statsDetails','jobid'); ?>"><?php echo GetLang('Addon_splittest_Stats_View'); ?></a>
								
								&nbsp;<a class="<?php echo $tpl->Get('active_status'); ?> StatsDisplayExportStat" id="hrefStatsDisplayExportJob_<?php echo $tpl->Get('statsDetails','jobid'); ?>" splitid="hrefStatsDisplayExportJob_<?php echo $tpl->Get('statsDetails','splitid'); ?>" href="#"><?php echo GetLang('Addon_splittest_Stats_Export'); ?></a>
								
								&nbsp;<a class="<?php echo $tpl->Get('active_status'); ?> thickbox" href="addons/splittest/print_stats_options.php?height=290&width=420&overflow=none&statstype=splittest&Action=print&statids=<?php echo $tpl->Get('statsDetails','splitid'); ?>&jobids=<?php echo $tpl->Get('statsDetails','jobid'); ?>&path=addons/splittest/" title="<?php echo GetLang('Addon_splittest_PrintSplitTestStatistics'); ?>"><?php echo GetLang('Addon_splittest_Stats_Print'); ?></a>
								
								&nbsp;<a id="hrefStatsDisplayDeleteJob_<?php echo $tpl->Get('statsDetails','jobid'); ?>" splitid="hrefStatsDisplayDeleteJob_<?php echo $tpl->Get('statsDetails','splitid'); ?>" class="StatsDisplayDeleteStat" href="#"><?php echo GetLang('Addon_splittest_Stats_Delete'); ?></a>
								&nbsp;
								<?php ob_start(); ?><?php $tpl->Assign("active_status", ob_get_contents()); ob_end_clean(); ?>
							</td>
						</tr>
					 <?php endforeach; endif; ?>
				</table>
			</form>
		</td>
	</tr>
</table>
