<?php $IEM = $tpl->Get('IEM'); ?><script>
	var TabSize = 5;
</script>

<h2 class="Heading1" style="margin:0; padding:0;">Split Test Statistics for &quot;<?php echo $tpl->Get('statsDetails','splitname'); ?>&quot;</h2>

<div>
	<br>

	<ul id="tabnav">
		<li><a href="#" class="active" onClick="ShowTab(1); return false;" id="tab1"><?php print GetLang('NewsletterStatistics_Snapshot'); ?></a></li>
		<li><a href="#" onClick="ShowTab(2); return false;" id="tab2"><?php print GetLang('NewsletterStatistics_Snapshot_OpenStats'); ?></a></li>
		<li><a href="#" onClick="ShowTab(3); return false;" id="tab3"><?php print GetLang('NewsletterStatistics_Snapshot_LinkStats'); ?></a></li>
		<li><a href="#" onClick="ShowTab(4); return false;" id="tab4"><?php print GetLang('NewsletterStatistics_Snapshot_BounceStats'); ?></a></li>
		<li><a href="#" onClick="ShowTab(5); return false;" id="tab5"><?php print GetLang('NewsletterStatistics_Snapshot_UnsubscribeStats'); ?></a></li>
	</ul>

</div>

<div id="div1">
	<br />
	<?php ob_start(); ?>
		<?php if($tpl->Get('statsDetails','campaign_winner_type') == 'None'): ?>
			<div class="FlashError">
				<img src="images/error.gif" width="18" height="18" align="left" class="FlashError" />
				<?php echo GetLang('Addon_splittest_WonNone'); ?>
			</div>
		<?php else: ?>
			<div class="FlashSuccess">
				<img src="images/success.gif" width="18" height="18" align="left" class="FlashSuccess" />
				<?php echo stripslashes($tpl->Get('statsDetails','winner_message')); ?>
			</div>
		<?php endif; ?>
	<?php $tpl->Assign("winner_summary", ob_get_contents()); ob_end_clean(); ?>
	<table border="0" width="100%" cellspacing="0" cellpadding="0">
	  <tr class="Heading3">
	  <td colspan="2" nowrap="nowrap" align="left">
		<?php echo GetLang('Addon_splittest_Campaign_Statistics'); ?>
	  </td>
	</tr>

	<tr>
		<td valign="top">
			<?php echo $tpl->Get('statsDetails','summary_chart'); ?>
			<?php echo $tpl->Get('winner_summary'); ?>
		</td>
	</tr>

	<tr>
		<td width="100%" valign="top">
		  <table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr class="Heading3">
				<td><?php echo GetLang('Addon_splittest_Stats_Snapshot_Heading'); ?></td>
			</tr>
			<tr>
				<td valign="top" rowspan="2">
					<table border="0" class="Text" cellspacing="0" cellpadding="0" width="100%" style="margin:0;">
						<tr class="GridRow">
							<td width="150" height="22" nowrap="nowrap" align="left">
								&nbsp;<?php echo GetLang('Addon_splittest_Stats_SplitName'); ?>
							</td>
							<td width="*" nowrap="nowrap" align="left">
								<?php echo $tpl->Get('statsDetails','splitname'); ?>
							</td>
						</tr>
						<tr class="GridRow">
							<td width="150" height="22" nowrap="nowrap" align="left">
								&nbsp;<?php echo GetLang('Addon_splittest_Stats_SplitType'); ?>
							</td>
							<td>
								<?php if($tpl->Get('statsDetails','splittype') == 'percentage'): ?>
									<span class="HelpText" onMouseOut="HideHelp('active_description');" onMouseOver="ShowQuickHelp('active_description', '<?php echo GetLang('Addon_splittest_Manage_SplitType_Percentage'); ?>', '<?php echo GetLang('HLP_Addon_splittest_Splittype_Percentage'); ?>');"><?php echo GetLang('Addon_splittest_Manage_SplitType_Percentage'); ?></span>
								<?php else: ?>
									<span class="HelpText" onMouseOut="HideHelp('active_description');" onMouseOver="ShowQuickHelp('active_description', '<?php echo GetLang('Addon_splittest_Manage_SplitType_Distributed'); ?>', '<?php echo GetLang('HLP_Addon_splittest_Splittype_Distributed'); ?>');"><?php echo GetLang('Addon_splittest_Manage_SplitType_Distributed'); ?></span>
								<?php endif; ?>
								<div style="font-weight:normal" id="active_description" style="display:none;"></div>
							</td>
						</tr>
						<tr class="GridRow">
							<td width="150" height="22" nowrap="nowrap" align="left" valign="top">
								&nbsp;<?php echo GetLang('Addon_splittest_Stats_ListNames'); ?>
							</td>
							<td width="*" height="22" nowrap="nowrap" align="left" valign="top">
								<?php if(!function_exists("foreach_148564")){ function foreach_148564(&$tpl, $array){ $tpl->Assign(array('sequence', 'iteration'), 0); $tpl->Assign(array('sequence', 'last'), false); $tpl->Assign(array('sequence', 'total'), sizeof($array)); if(is_array($array) || is_object($array)): foreach($array as $__key=>$list): $tpl->Assign('__key', $__key, false); $tpl->Assign('list', $list, false); $tpl->Assign(array('sequence', 'iteration'), $tpl->Get('sequence', 'iteration')+1);if( $tpl->Get('sequence','total') ===  $tpl->Get('sequence','iteration')){ $tpl->Assign(array('sequence','last'), true);} ?>
									<a href="index.php?Page=Subscribers&Action=Manage&Lists[]=<?php echo $tpl->Get('list','listid'); ?>"><?php echo $tpl->Get('list','name'); ?></a><?php if(!$tpl->Get('sequence','last')): ?>, <?php endif; ?>
								 <?php endforeach; endif;}} foreach_148564($tpl, $tpl->Get('statsDetails','lists')); ?>
							</td>
						</tr>
						<tr class="GridRow">
							<td width="150" height="22" nowrap="nowrap" align="left" valign="top">
								&nbsp;<?php echo GetLang('Addon_splittest_Stats_CampaignNames'); ?>
							</td>
							<td width="*" height="22" nowrap="nowrap" align="left" valign="top">
								<?php if(!function_exists("foreach_162106")){ function foreach_162106(&$tpl, $array){ $tpl->Assign(array('sequence', 'iteration'), 0); $tpl->Assign(array('sequence', 'last'), false); $tpl->Assign(array('sequence', 'total'), sizeof($array)); if(is_array($array) || is_object($array)): foreach($array as $__key=>$pair): $tpl->Assign('__key', $__key, false); $tpl->Assign('pair', $pair, false); $tpl->Assign(array('sequence', 'iteration'), $tpl->Get('sequence', 'iteration')+1);if( $tpl->Get('sequence','total') ===  $tpl->Get('sequence','iteration')){ $tpl->Assign(array('sequence','last'), true);} ?>
									<?php ob_start(); ?><?php echo key($tpl->Get('pair')); ?><?php $tpl->Assign("id", ob_get_contents()); ob_end_clean(); ?>
									<?php $tpl->Assign("campaign", $tpl->Get('statsDetails','campaigns',$tpl->Get("id"))); ?>
									<a title="<?php echo GetLang('Addon_splittest_Stats_ViewNewsletterStats'); ?>" href="index.php?Page=Stats&Action=Newsletters&SubAction=ViewSummary&id=<?php echo $tpl->Get('campaign','stats_newsletters','statid'); ?>"><?php echo $tpl->Get('campaign','campaign_name'); ?></a><?php if(!$tpl->Get('sequence','last')): ?>, <?php endif; ?> 
								 <?php endforeach; endif;}} foreach_162106($tpl, $tpl->Get('statsDetails','campaign_statistics','rankings','weighted')); ?>
							</td>
						</tr>
						<tr class="GridRow">
							<td width="150" height="22" nowrap="nowrap" align="left">
								&nbsp;<?php echo GetLang('Addon_splittest_Stats_DateStarted'); ?>
							</td>
							<td width="*" nowrap="nowrap" align="left">
								<?php echo dateformat($tpl->Get('statsDetails','starttime'), $tpl->Get('DateFormat')); ?>
							</td>
						</tr>
						<tr class="GridRow">
							<td width="150" height="22" nowrap="nowrap" align="left">
								&nbsp;<?php echo GetLang('NewsletterStatistics_FinishSending'); ?>
							</td>
							<td width="*" nowrap="nowrap" align="left">
								<?php if($tpl->Get('statsDetails','finishtime') == 0): ?>
									<?php echo GetLang('Addon_splittest_Stats_FinishTime_NotFinished'); ?>
								<?php else: ?>
									<?php echo dateformat($tpl->Get('statsDetails','finishtime'), $tpl->Get('DateFormat')); ?>
								<?php endif; ?>
							</td>
						</tr>
						<tr class="GridRow">
							<td width="150" height="22" nowrap="nowrap" align="left">
								&nbsp;<?php echo GetLang('Addon_splittest_TotalSendSize'); ?>
							</td>
							<td width="*" nowrap="nowrap" align="left">
								<?php echo number_format($tpl->Get('statsDetails','total_recipient_count')); ?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		</td>
	  </tr>
	 </table>
	 <br/>
 </div>


<!-- Email Open Rates -->
<div id="div2" style="display:none;">
	<br/>
	<table border="0" cellspacing="0" cellpadding="0" width="100%" class="Text">
		<tr class="Heading3">
		  <td colspan="2" nowrap="nowrap" align="left">
				<?php echo GetLang('Addon_splittest_SplittestTitle'); ?> <?php echo GetLang('NewsletterStatistics_Snapshot_OpenStats'); ?>
			</td>
		</tr>

		<tr>
			<td width="100%" valign="top">
				<?php echo $tpl->Get('statsDetails','openrate_chart'); ?>
				<?php echo $tpl->Get('winner_summary'); ?>
			</td>
		</tr>

		<tr>
		  <td valign="top" width="100%">
			  <table border="0" cellspacing="0" cellpadding="0" width="100%" class="Text">
				<tr class="Heading3">
					<td width="200" height="22" align="left" valign="top">
						<b><?php echo GetLang('Addon_splittest_Stats_EmailCampaigns'); ?></b>
					</td>
					<td align="center"><?php echo GetLang('Addon_splittest_Stats_TotalOpens'); ?></td>
					<td align="center"><?php echo GetLang('Addon_splittest_Stats_UniqueOpens'); ?></td>
					<td align="center" style="border-right: 2px solid #EDECEC;"><?php echo GetLang('Addon_splittest_Stats_UniqueOpens'); ?> (%)</td>
					<td align="center"><?php echo GetLang('Addon_splittest_Stats_TotalRecipients'); ?></td>
					<td align="center"><?php echo GetLang('Addon_splittest_Stats_TotalRecipients'); ?> (%)</td>
					<td align="center"><?php echo GetLang('Addon_splittest_TotalSendSize'); ?></td>
				</tr>
				<?php $array = $tpl->Get('statsDetails','campaign_statistics','rankings','emailopens'); if(is_array($array) || is_object($array)): foreach($array as $__key=>$pair): $tpl->Assign('__key', $__key, false); $tpl->Assign('pair', $pair, false);  ?>
				<tr class="GridRow">
					<?php ob_start(); ?><?php echo key($tpl->Get('pair')); ?><?php $tpl->Assign("id", ob_get_contents()); ob_end_clean(); ?>
					<?php $tpl->Assign("campaign", $tpl->Get('statsDetails','campaigns',$tpl->Get("id"))); ?>
					<td>
						&nbsp;<a href="index.php?Page=Stats&Action=Newsletters&SubAction=ViewSummary&id=<?php echo $tpl->Get('campaign','stats_newsletters','statid'); ?>&tab=3" target="_blank"><?php echo $tpl->Get('campaign','campaign_name'); ?></a>
					</td>
					<td align="center"><?php echo $tpl->Get('campaign','stats_newsletters','emailopens'); ?></td>
					<td align="center"><?php echo $tpl->Get('campaign','stats_newsletters','emailopens_unique'); ?></td>
					<td align="center" style="border-right: 2px solid #EDECEC;"><?php echo $tpl->Get('campaign','stats_newsletters','percent_emailopens_unique'); ?></td>
					<td align="center"><?php echo number_format($tpl->Get('campaign','stats_newsletters','recipients')); ?></td>
					<td align="center"><?php echo $tpl->Get('campaign','stats_newsletters','final_percent_emailopens_unique'); ?></td>
					<td align="center"><?php echo number_format($tpl->Get('statsDetails','total_recipient_count')); ?> <?php echo GetLang('Addon_splittest_Stats_Recipient_s'); ?></td>
				</tr>
				 <?php endforeach; endif; ?>
			  </table>
			</td>
		 </tr>
	</table>
</div>

<!-- Click Rates -->
<div id="div3" style="display:none;">
	<br/>
	<table border="0" width="100%">
	  <tr>
		<td valign="top" width="100%">
		  <table border="0" cellspacing="0" cellpadding="0" width="100%" class="Text">
			<tr class="Heading3">
				<td colspan="4" nowrap="nowrap" align="left">
					<?php echo GetLang('Addon_splittest_SplittestTitle'); ?> <?php echo GetLang('NewsletterStatistics_Snapshot_LinkStats'); ?>
				</td>
			</tr>

			<tr>
				<td valign="top">
					<?php echo $tpl->Get('statsDetails','clickrate_chart'); ?>
					<?php echo $tpl->Get('winner_summary'); ?>
				</td>
			</tr>

			<tr>
			  <td width="100%">
				<table border="0" cellspacing="0" cellpadding="0" width="100%" class="Text">
					<tr class="Heading3">
						<td width="200" height="22" align="left" valign="top">
							<b><?php echo GetLang('Addon_splittest_Stats_EmailCampaigns'); ?></b>
						</td>
						<td align="center"><?php echo GetLang('Addon_splittest_Stats_UniqueClicks'); ?></td>
						<td align="center"><?php echo GetLang('Addon_splittest_Stats_UniqueClicks'); ?> (%)</td>
						<td align="center" style="border-right: 2px solid #EDECEC;"><?php echo GetLang('Addon_splittest_Stats_TotalClicks'); ?></td>
						<td align="center"><?php echo GetLang('Addon_splittest_Stats_TotalRecipients'); ?></td>
						<td align="center"><?php echo GetLang('Addon_splittest_Stats_TotalRecipients'); ?> (%)</td>
						<td align="center"><?php echo GetLang('Addon_splittest_TotalSendSize'); ?></td>
					</tr>
					<?php $array = $tpl->Get('statsDetails','campaign_statistics','rankings','linkclicks'); if(is_array($array) || is_object($array)): foreach($array as $__key=>$pair): $tpl->Assign('__key', $__key, false); $tpl->Assign('pair', $pair, false);  ?>
					<tr class="GridRow">
						<?php ob_start(); ?><?php echo key($tpl->Get('pair')); ?><?php $tpl->Assign("id", ob_get_contents()); ob_end_clean(); ?>
						<?php $tpl->Assign("campaign", $tpl->Get('statsDetails','campaigns',$tpl->Get("id"))); ?>
						<td>
							&nbsp;<a href="index.php?Page=Stats&Action=Newsletters&SubAction=ViewSummary&id=<?php echo $tpl->Get('campaign','stats_newsletters','statid'); ?>&tab=3" target="_blank"><?php echo $tpl->Get('campaign','campaign_name'); ?></a>
						</td>
						<td align="center"><?php echo $tpl->Get('campaign','stats_newsletters','linkclicks_unique'); ?></td>
						<td align="center"><?php echo $tpl->Get('campaign','stats_newsletters','percent_linkclicks_unique'); ?></td>
						<td align="center" style="border-right: 2px solid #EDECEC;"><?php echo $tpl->Get('campaign','stats_newsletters','linkclicks'); ?></td>
						<td align="center"><?php echo number_format($tpl->Get('campaign','stats_newsletters','recipients')); ?></td>
						<td align="center"><?php echo $tpl->Get('campaign','stats_newsletters','final_percent_linkclicks_unique'); ?></td>
						<td align="center"><?php echo number_format($tpl->Get('statsDetails','total_recipient_count')); ?> <?php echo GetLang('Addon_splittest_Stats_Recipient_s'); ?></td>
					</tr>
					 <?php endforeach; endif; ?>
				</table>
			  </td>
		  </table>
		</td>
	  </tr>
	</table>
</div>

<!-- Bounce Count -->
<div id="div4" style="display:none;">
	<br/>
	<table border="0" cellspacing="0" cellpadding="0" width="100%" class="Text">
		<tr class="Heading3">
			<td colspan="4" nowrap="nowrap" align="left">
				<?php echo GetLang('Addon_splittest_SplittestTitle'); ?> <?php echo GetLang('NewsletterStatistics_Snapshot_BounceStats'); ?>
			</td>
		</tr>

		<tr>
			<td width="100%" valign="top">
				<?php echo $tpl->Get('statsDetails','bouncerate_chart'); ?>
				<?php echo $tpl->Get('winner_summary'); ?>
			</td>
		</tr>

		<tr>
			<td>
			  <table border="0" cellspacing="0" cellpadding="0" width="100%" class="Text">
				<tr class="Heading3">
					<td width="200" height="22" align="left" valign="top">
						<b><?php echo GetLang('Addon_splittest_Stats_EmailCampaigns'); ?></b>
					</td>
					<td align="center"><?php echo GetLang('BounceSoft'); ?></td>
					<td align="center"><?php echo GetLang('BounceHard'); ?></td>
					<td align="center"><?php echo GetLang('BounceUnknown'); ?></td>
					<td align="center" style="border-right: 2px solid #EDECEC;"><?php echo GetLang('Addon_splittest_Stats_TotalBounces'); ?> (%)</td>
					<td align="center"><?php echo GetLang('Addon_splittest_Stats_TotalRecipients'); ?></td>
					<td align="center"><?php echo GetLang('Addon_splittest_Stats_TotalRecipients'); ?> (%)</td>
					<td align="center"><?php echo GetLang('Addon_splittest_TotalSendSize'); ?></td>
				</tr>
				<?php $array = $tpl->Get('statsDetails','campaign_statistics','rankings','bouncecount_total'); if(is_array($array) || is_object($array)): foreach($array as $__key=>$pair): $tpl->Assign('__key', $__key, false); $tpl->Assign('pair', $pair, false);  ?>
				<tr class="GridRow">
					<?php ob_start(); ?><?php echo key($tpl->Get('pair')); ?><?php $tpl->Assign("id", ob_get_contents()); ob_end_clean(); ?>
					<?php $tpl->Assign("campaign", $tpl->Get('statsDetails','campaigns',$tpl->Get("id"))); ?>
					<td>
						&nbsp;<a href="index.php?Page=Stats&Action=Newsletters&SubAction=ViewSummary&id=<?php echo $tpl->Get('campaign','stats_newsletters','statid'); ?>&tab=4" target="_blank"><?php echo $tpl->Get('campaign','campaign_name'); ?></a>
					</td>
					<td align="center"><?php echo $tpl->Get('campaign','stats_newsletters','bouncecount_soft'); ?></td>
					<td align="center"><?php echo $tpl->Get('campaign','stats_newsletters','bouncecount_hard'); ?></td>
					<td align="center"><?php echo $tpl->Get('campaign','stats_newsletters','bouncecount_unknown'); ?></td>
					<td align="center" style="border-right: 2px solid #EDECEC;"><?php echo $tpl->Get('campaign','stats_newsletters','percent_bouncecount_total'); ?></td>
					<td align="center"><?php echo number_format($tpl->Get('campaign','stats_newsletters','recipients')); ?></td>
					<td align="center"><?php echo $tpl->Get('campaign','stats_newsletters','final_percent_bouncecount_total'); ?></td>
					<td align="center"><?php echo number_format($tpl->Get('statsDetails','total_recipient_count')); ?> <?php echo GetLang('Addon_splittest_Stats_Recipient_s'); ?></td>
				</tr>
				 <?php endforeach; endif; ?>
		    </table>
		</td>
	  </tr>
	</table>
</div>


<!-- Unsubscribes -->
<div id="div5" style="display:none;">
	<br/>
	<table border="0" cellspacing="0" cellpadding="0" width="100%" class="Text">
		<tr class="Heading3">
			<td colspan="4" nowrap="nowrap" align="left">
				<?php echo GetLang('Addon_splittest_SplittestTitle'); ?> <?php echo GetLang('Newsletter_Summary_Graph_unsubscribechart'); ?>
			</td>
		</tr>

		<tr>
			<td width="65%" valign="top">
				<?php echo $tpl->Get('statsDetails','unsubscribes_chart'); ?>
				<?php echo $tpl->Get('winner_summary'); ?>
			</td>
		</tr>

		<tr>
			<td>
				<table border="0" cellspacing="0" cellpadding="0" width="100%" class="Text">
					<tr class="Heading3">
						<td width="200" height="22" align="left" valign="top">
							<b><?php echo GetLang('Addon_splittest_Stats_EmailCampaigns'); ?></b>
						</td>
						<td align="center"><?php echo GetLang('UnsubscribeCount'); ?></td>
						<td align="center" style="border-right: 2px solid #EDECEC;"><?php echo GetLang('Stats_TotalUnsubscribes'); ?> (%)</td>
						<td align="center"><?php echo GetLang('Addon_splittest_Stats_TotalRecipients'); ?></td>
						<td align="center"><?php echo GetLang('Addon_splittest_Stats_TotalRecipients'); ?> (%)</td>
						<td align="center"><?php echo GetLang('Addon_splittest_TotalSendSize'); ?></td>
					</tr>
					<?php $array = $tpl->Get('statsDetails','campaign_statistics','rankings','unsubscribes'); if(is_array($array) || is_object($array)): foreach($array as $__key=>$pair): $tpl->Assign('__key', $__key, false); $tpl->Assign('pair', $pair, false);  ?>
						<?php ob_start(); ?><?php echo key($tpl->Get('pair')); ?><?php $tpl->Assign("id", ob_get_contents()); ob_end_clean(); ?>
						<?php $tpl->Assign("campaign", $tpl->Get('statsDetails','campaigns',$tpl->Get("id"))); ?>
						<tr class="GridRow">
							<td>
								&nbsp;<a href="index.php?Page=Stats&Action=Newsletters&SubAction=ViewSummary&id=<?php echo $tpl->Get('campaign','stats_newsletters','statid'); ?>&tab=5" target="_blank"><?php echo $tpl->Get('campaign','campaign_name'); ?></a>
							</td>
							<td align="center"><?php echo $tpl->Get('campaign','stats_newsletters','unsubscribecount'); ?></td>
							<td align="center" style="border-right: 2px solid #EDECEC;"><?php echo $tpl->Get('campaign','stats_newsletters','percent_unsubscribecount'); ?></td>
							<td align="center"><?php echo number_format($tpl->Get('campaign','stats_newsletters','recipients')); ?></td>
							<td align="center"><?php echo $tpl->Get('campaign','stats_newsletters','final_percent_unsubscribecount'); ?></td>
							<td align="center"><?php echo number_format($tpl->Get('statsDetails','total_recipient_count')); ?> <?php echo GetLang('Addon_splittest_Stats_Recipient_s'); ?></td>
						</tr>
					 <?php endforeach; endif; ?>
		  		</table>
			</td>
	  	</tr>
	</table>
</div>
